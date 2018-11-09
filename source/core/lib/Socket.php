<?php


namespace ng169\lib;
checktop();

class Socket extends Y
{
  const LISTEN_SOCKET_NUM = 100000;
  const CHECK_REFLASH_TIME = 30;//广播间隔时间30秒；
  public static $sockets = [];
  public static $master;
  public static $stop = false;
  public static $userlogin = [];//记录刷新的用户id；防止重复广播
  private static $type = "tcp";
  //[uid=>time]
  /*检测是否已经开启了该端口服务
  */
  public static function check_sock_open($ip,$port)
  {
    $port   = $port?$port:DB_SOCKPOST;
    $type   = self::$type;
    $socket = @stream_socket_client("$type://$ip:$port", $errno, $errstr);

    if (gettype($socket) != 'resource') {
      return false;
    }
    fclose($socket);
    unset($socket);
    return true;
  }
  private static function reset_client()
  {
    /*    T('sock_client')->update(array('online'=>0,'handshake'=>0),array('online'=>1,'handshake'=>1));*/
    T('sock_client')->del();
  }
  private static function generate_password($length = 8)
  {
    $chars    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0;$i < $length;$i++) {
      $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }return $password;
  }
  private static function reset_system_code()
  {
    $code = self::generate_password();
    T('sock_type')->update(array('password'=>$code,'addtime' =>time()),array('type'=>3));
    return true;
  }
  private static function reset_admin_code()
  {
    $code = self::generate_password();
    T('sock_type')->update(array('password'=>$code,'addtime' =>time()),array('type'=>2));
    return true;
  }

  public static function start($host, $port)
  {

    if (self::check_sock_open($host,$port)) {
      error('已绑定监听');
    }



    //检测是否已经监听；
    //数据库用户表下线
    self::reset_client();
    //重置管理密码
    self::reset_system_code();
    self::reset_admin_code();
    $type = self::$type;

    //重置系统密码
    try {

      if ($type = 'tcp') {

        self::$master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        // 设置IP和端口重用,在重启服务器后能重新使用此端口;
        socket_set_option(self::$master, SOL_SOCKET, SO_REUSEADDR, 1);
        // 将IP和端口绑定在服务器socket上;
        socket_bind(self::$master, $host, $port);
        // listen函数使用主动连接套接口变为被连接套接口，使得一个进程可以接受其它进程的请求，从而成为一个服务器进程。在TCP服务器编程中listen函数把进程变为一个服务器，并指定相应的套接字变为被动连接,其中的能存储的请求不明的socket数目。
        socket_listen(self::$master, self::LISTEN_SOCKET_NUM);


      }
      if ($type = 'udp') {

        self::$master = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        socket_bind(self::$master, $host, $port);

        /* $r = socket_recvfrom($socket, $buf, 512, 0, $remote_ip, $remote_port);
        $this->info("$remote_ip : $remote_port -- " . $buf);
        //Send back
        socket_sendto($socket, "OK " . $buf, 100, 0, $remote_ip, $remote_port);*/


      }





    } catch (\Exception $e) {

      $err_code = socket_last_error();
      $err_msg  = socket_strerror($err_code);

      self::error([
          'error_init_server',
          $err_code,
          $err_msg
        ]);
    }


    self::$sockets["-1"] = ['resource' => self::$master];
    $pid = get_current_user();
    /*self::debug(["server: {self::$master} started,pid: {$pid}"]);*/

    while (!self::$stop) {
      try {

        @self::doServer();
      } catch (\Exception $e) {
        self::error([
            'error_do_server',
            $e->getCode(),
            $e->getMessage()
          ]);
      }
    }
  }

  private static function doServer()
  {
    $write = $except= NULL;
    $sockets = array_column(self::$sockets, 'resource');
    $read_num= socket_select($sockets, $write, $except, NULL);
    // select作为监视函数,参数分别是(监视可读,可写,异常,超时时间),返回可操作数目,出错时返回false;
    if (false === $read_num) {
      self::error([
          'error_select',
          $err_code = socket_last_error(),
          socket_strerror($err_code)
        ]);
      return;
    }

    foreach ($sockets as $socket) {
      // 如果可读的是服务器socket,则处理连接逻辑

      if ($socket == self::$master) {
        $client = socket_accept(self::$master);
        // 创建,绑定,监听后accept函数将会接受socket要来的连接,一旦有一个连接成功,将会返回一个新的socket资源用以交互,如果是一个多个连接的队列,只会处理第一个,如果没有连接的话,进程将会被阻塞,直到连接上.如果用set_socket_blocking或socket_set_noblock()设置了阻塞,会返回false;返回资源后,将会持续等待连接。
        if (false === $client) {
          self::error([
              'err_accept',
              $err_code = socket_last_error(),
              socket_strerror($err_code)
            ]);
          continue;
        }
        else {
          self::connect($client);
          continue;
        }
      }
      else {
        // 如果可读的是其他已连接socket,则读取其数据,并处理应答逻辑
        $bytes = @socket_recv($socket, $buffer, 10000, 0);
        //长度限制10000个字符
        if ($bytes < 9) {
          $recv_msg = self::disconnect($socket);

        }
        else {

          if (!self::$sockets[self::getindex($socket)]['handshake']) {

            $bool = self::handShake($socket, $buffer);
            //这里不成功可能是后台直接推送的信息；要直接执行。

            if (!$bool) {

              self::systemdeal($buffer);
              self::disconnect($socket);
              break;
            }

          }
          else {


            $recv_msg = self::parse($buffer);

            self::dealMsg($socket, $recv_msg);

          }
        }



      }
    }
  }
  public static function getindex($socket)
  {
    $sockets = array_column(self::$sockets,'resource','clientid');
    $index   = array_keys($sockets,$socket);
    return $index[0];
  }
  /**
  * 将socket添加到已连接列表,但握手状态留空;
  *
  * @param $socket
  */
  public static function connect($socket)
  {
    socket_getpeername($socket, $ip, $port);

    $socket_info = [
      'resource' => $socket,
      'uname' => '',
      'handshake' => false,
      'ip' => $ip,
      'port' => $port,
      'type'=>'',
      'check'=>'',
      'clientid'=>'',
      'online'=>1,
      'addtime'=>time(),
    ];
    $insert = $socket_info;
    $insert['resource'] = serialize($socket);
    $id = T('sock_client')->add($insert);
    $socket_info['clientid'] = $id;
    self::$sockets[$id] = $socket_info;
    /*self::broadcast($msg);*/

  }

  //检测用户是否刷新
  public static function reflash($uid)
  {
    $time = (int)self::$userlogin[$uid];

    $go_time = time() - $time;

    self::$userlogin[$uid] = time();

    if ($go_time > self::CHECK_REFLASH_TIME)return true;
    return false;
  }
  /**
  * 客户端关闭连接
  *
  * @param $socket
  *
  * @return array
  */
  private static function disconnect($socket)
  {

    /*$recv_msg = [
    'type' => 'logout',
    'content' => self::$sockets[self::getindex($socket)]['uname'],
    ];*/
    T('sock_client')->update(array('online'   =>0,'handshake'=>0),array('clientid'=>self::getindex($socket)));

    unset(self::$sockets[self::getindex($socket)]);
    /*self::broadcast($msg);*/
    return true;
  }

  /**
  * 用公共握手算法握手
  *
  * @param $socket
  * @param $buffer
  *
  * @return bool
  */
  public static function handShake($socket, $buffer)
  {

    // 获取到客户端的升级密匙
    $line_with_key = substr($buffer, strpos($buffer, 'Sec-WebSocket-Key:') + 18);
    $key           = trim(substr($line_with_key, 0, strpos($line_with_key, "\r\n")));
    if (!$key)return false;
    // 生成升级密匙,并拼接websocket升级头
    $upgrade_key = base64_encode(sha1($key . "258EAFA5-E914-47DA-95CA-C5AB0DC85B11", true));// 升级key的算法
    $upgrade_message = "HTTP/1.1 101 Switching Protocols\r\n";
    $upgrade_message .= "Upgrade: websocket\r\n";
    $upgrade_message .= "Sec-WebSocket-Version: 13\r\n";
    $upgrade_message .= "Connection: Upgrade\r\n";
    $upgrade_message .= "Sec-WebSocket-Accept:" . $upgrade_key . "\r\n\r\n";

    socket_write($socket, $upgrade_message, strlen($upgrade_message));// 向socket里写入升级信息
    T('sock_client')->update(array('handshake'=>1),array('clientid'=>self::getindex($socket)));
    self::$sockets[self::getindex($socket)]['handshake'] = true;

    socket_getpeername($socket, $ip, $port);

    return true;
  }

  /**
  * 解析数据
  *
  * @param $buffer
  *
  * @return bool|string
  */
  private  static function parse($buffer)
  {
    $decoded = '';
    $len     = ord($buffer[1]) & 127;
    if ($len === 126) {
      $masks = substr($buffer, 4, 4);
      $data  = substr($buffer, 8);
    }
    else
    if ($len === 127) {
      $masks = substr($buffer, 10, 4);
      $data  = substr($buffer, 14);
    }
    else {
      $masks = substr($buffer, 2, 4);
      $data  = substr($buffer, 6);
    }
    for ($index = 0; $index < strlen($data); $index++) {
      $decoded .= $data[$index] ^ $masks[$index % 4];
    }
    return $decoded;
    return unserialize($decoded, true);
  }

  /**
  * 将普通信息组装成websocket数据帧
  *
  * @param $msg
  *
  * @return string
  */
  private  static function build($msg)
  {
    $frame = [];
    $frame[0] = '81';
    $len = strlen($msg);
    if ($len < 126) {
      $frame[1] = $len < 16 ? '0' . dechex($len) : dechex($len);
    }
    else
    if ($len < 65025) {
      $s = dechex($len);
      $frame[1] = '7e' . str_repeat('0', 4 - strlen($s)) . $s;
    }
    else {
      $s = dechex($len);
      $frame[1] = '7f' . str_repeat('0', 16 - strlen($s)) . $s;
    }

    $data = '';
    $l    = strlen($msg);
    for ($i = 0; $i < $l; $i++) {
      $data .= dechex(ord($msg{$i}));
    }
    $frame[2] = $data;

    $data = implode('', $frame);

    return pack("H*", $data);
  }
  private  static function checksystem($code)
  {

    $bool = T('sock_type')->get_one(array('type'    =>3,'password'=>$code));

    return $bool;
  }
  private static  function checkadmin($code)
  {
    return T('sock_type')->get_one(array('type'    =>2,'password'=>$code));
  }
  /**
  * 拼装信息
  *
  * @param $socket
  * @param $recv_msg
  *          [
  *          'stype'=>''2管理，3系统，1或则空是用户
  *       'code'=>''管理效验码，3系统效验码，空是用户
  *          'type'=>user/login  //用户登入信息
  *          'data'=>content   //数据base64压缩
  *          ]
  *
  * @return string
  */
  public static function socksend($socket,$msg)
  {

    if (is_string($msg)) {
      $msg = self::build($msg);
    }
    else {

      $msg = json_encode($msg);

      $msg = self::build($msg);
    }

    socket_write($socket, $msg, strlen($msg));
  }
  private static  function dealMsg($socket, $recv_msg)
  {

    $recv_msg = (json_decode($recv_msg,1));

    $type     = $recv_msg['stype'];
    $code     = $recv_msg['code'];


    switch ($type) {
      case 2:
      if (self::checkadmin()) {
        self::admindeal($socket,$recv_msg);
      }
      break;

      default:self::userdeal($socket,$recv_msg);

    }
    return 1;

    /*  return self::build(serialize($response));*/
  }
  //用户发来信息
  private static function userdeal($socket, $recv_msg)
  {

    return self::sockdoing($socket,'user',$recv_msg['action'],$recv_msg['data']);

  }
  //
  public static function phps($action,$datacontent = null)
  {
    $systemcode = T('sock_type')->set_field(array('password'))->get_one(array('type'=>3));
    if (!$systemcode) {
      YLog::txt('system结构密码丢失');
      return false;
    }
    $ip   = getip();
    $port = DB_SOCKPOST;
    $data['action'] = $action;
    $data['data'] = $datacontent;
    $send['code'] = $systemcode['password'];

    $send['data'] = self::yscode(serialize($data));
    $msg    = serialize($send);
    $client = stream_socket_client("tcp://$ip:$port", $errno, $errmsg, 1);

    fwrite($client, $msg."\n");
    fclose($client);
    return true;
  }
  public static function yscode($data)
  {
    /*YLog::txt($data);
    YLog::txt(sizeof($data));*/
    $ysdata = gzcompress(base64_encode($data));
    /*YLog::txt($ysdata);
    YLog::txt(strlen($ysdata));*/
    return $ysdata;
  }
  public static function unyscode($data)
  {

    $ysdata = unserialize(base64_decode(gzuncompress($data)));

    return $ysdata;
  }
  //data包含action 以及执行所需要的所有数据所组成的数组
  public static function phpsend($ip,$port,$data)
  {
    $systemcode = T('sock_type')->set_field(array('password'))->get_one(array('type'=>3));
    if (!$systemcode) {
      YLog::txt('system结构密码丢失');
      return false;
    }
    $send['code'] = $systemcode['password'];
    $send['data'] = self::yscode(serialize($data));
    $msg    = serialize($send);
    $client = stream_socket_client("tcp://$ip:$port", $errno, $errmsg, 1);

    fwrite($client, $msg."\n");
    fclose($client);
    return true;
  }
  //系统发来信息
  private static  function systemdeal($data)
  {
    //检测发信息的端口是否同一个ip；
    //检测系统密码正确；

    $data = unserialize($data);


    if (!$data)return false;
    $code   = $data['code'];

    $recv   = self::unyscode($data['data']);

    $action = $recv['action'];
    $bool   = self::checksystem($code);

    $type   = 'system';
    if ($bool) {

      $bool2 = self::get_typea_ction_file($type,$recv['action']);
      /*try{*/
      if ($bool2) {
        $classname = "Sock_{$type}_".$action;

        if (!class_exists($classname)) {
          self::error($type.'下执行文件类错误');
          return true;
        }

        $class = new $classname();

        if (method_exists($class, 'run') ) {


          $class->run($recv);
          return true;
        }
        else {
          self::error($type.'下'.$action.'执行文件错误');
          return false;

        }

      }
      /*}catch(\Exception $e){

      self::error($e);
      }*/

    }

    return true;
  }
  //管理员发来信息
  private static function admindeal()
  {
    return self::sockdoing($socket,'admin',$recv_msg['action'],$recv_msg['data']);
  }

  public static function send($clentid,$data)
  {
    $client = self::$sockets[$clentid];
    if (isset($client)) {
      self::socksend($client['resource'],$data);
      return true;
    }
    return false;
  }
  /**
  * 广播消息
  *
  * @param $data
  */
  public static function broadcast($data)
  {
    /*if(!is_string($data)){
    $data=serialize($data);
    }*/
    foreach (self::$sockets as $k=>$socket) {
      if ($k != '-1') {
        $d['action'] = 'login';
        $d['data'] = $data;
        $d2['data'] = $d;
        self::socksend($socket['resource'],$d2);

      }


    }
  }


  /**
  * 记录错误信息
  *
  * @param array $info
  */
  private static function error($info)
  {
    /*$time = date('Y-m-d H:i:s');
    array_unshift($info, $time);*/

    /* $info = array_map('serialize', $info);*/
    /* file_put_contents(self::LOG_PATH . 'websocket_error.log', implode(' | ', $info) . "\r\n", FILE_APPEND);*/

    YLog::txt($info,LOG.'websocket_error.log');
  }
  private static function get_typea_ction_file($type,$action)
  {
    $sockfile = SOURCE."/sock/{$type}Sock.php";

    im($sockfile);

    $file     = SOURCE."sock/{$type}/$action.php";

    if (file_exists($file)) {
      /* require_once ($file);*/
      include_once ($file);
      return true;
    }
    else {
      self::error($type.'下'.$action.'执行文件'.$file.'不存在');
      return false;
      /*  d('API '.$apiname. ' IS NOT EXIST',1);*/
    }
    return true;
  }
  private function sockdoing($sock,$type,$action,$data)
  {

    $data = base64_decode($data);
    $data = urldecode($data);
    $data = json_decode($data);


    $bool = self::get_typea_ction_file($type,$action);

    if ($bool) {

      $classname = "Sock_{$type}_".$action;
      $class     = new $classname();
      if (!class_exists($classname)) {
        self::error($type.'下执行文件类错误');
        return true;
      }
      if (method_exists($class, 'run') ) {

        $class->run($sock,$data);
        return true;
      }
      else {

        self::error($type.'下'.$action.'执行文件错误');
        return false;

      }
      unset($control);
    }
  }
}





?>
