<?php






class mysqlClass
{
    var $querynum = 0;
    var $link;
    var $charset;
    public function __construct($dbhost, $dbuser, $dbpw, $dbname = '', $dbcharset =
        'utf8', $pconnect = 1, $halt = true)
    {
	
	if (!$this->link = @mysqli_connect($dbhost, $dbuser, $dbpw)) {
                
                $halt && $this->halt('Can not connect to MySQL server');
            }
	
	
	
	/*if(function_exists(mysql_pconnect)){
		
	
	
	
        if ($pconnect == 1) {
            if (!$this->link = @mysql_pconnect($dbhost, $dbuser, $dbpw)) {
                $halt && $this->halt('Can not connect to MySQL server');
            }
        } 
else {
            if (!$this->link = @mysql_connect($dbhost, $dbuser, $dbpw, true)) {
                
                $halt && $this->halt('Can not connect to MySQL server');
            }
        }}
else{
			 if (!$this->link = @mysqli_connect($dbhost, $dbuser, $dbpw)) {
                
                $halt && $this->halt('Can not connect to MySQL server');
            }
			
			
		}*/
  
        if ($this->version() > '4.1') {
        	
            if (!empty($dbcharset)) {
            	
            	
               /* @mysqli_query("SET character_set_connection=$dbcharset, character_set_results=$dbcharset, character_set_client=binary",
                    $this->link);*/
                    $this->___query("SET character_set_connection=$dbcharset, character_set_results=$dbcharset, character_set_client=binary");
            }
          
            if ($this->version() > '5.0.1') {
            	
            	$this->___query("SET sql_mode=''");
            	
               /* @mysqli_query("SET sql_mode=''", $this->link);*/
            }
        }
        if ($dbname) {
            /*@mysqli_select_db($dbname, $this->link);*/
            $this->select_db($dbname);
        }
		
    }

    public function select_db($dbname)
    {
        return mysqli_select_db($this->link,$dbname);
    }
    public function fetch_array($query, $result_type = MYSQLI_ASSOC)
    {
        return mysqli_fetch_array($query, $result_type);
    }
    public function fetch_first($sql, $master = false)
    {
        $resource = $this->query($sql, $master);
        if ($resource) {
            $row = mysqli_fetch_array($resource, MYSQLI_ASSOC);
            $this->free_result($resource);
            return $row;
        } else {
            return null;
        }
        
    }
    public function result_first($sql)
    {
        return $this->result($this->query($sql), 0);
    }
    private function ___query($sql, $type = ''){
		 $func = $type == 'UNBUFFERED' && @function_exists('mysqli_unbuffered_query') ?
            'mysqli_unbuffered_query' : 'mysqli_query';
            
         $query = $func($this->link,$sql);
         return   $query; 
	}
    public function query($sql, $type = '')
    {
     
       
    /* d($func);
     d($sql);*/
     $query=$this->___query($sql, $type);
        if (!($query)) {
           
            if (in_array($this->errno(), array(2006, 2013)) && substr($type, 0, 5) !=
                'RETRY') {
               
                return $this->query($sql, 'RETRY' . $type);
            } elseif ($type != 'SILENT' && substr($type, 5) != 'SILENT') {
                
                if (strpos($sql, "ADD INDEX") || strpos($sql, "DROP INDEX")) {
                } else {
                    if (G_DEBUG) {
                        $this->halt('MySQL Query Error', $sql);
                    } else {
                        d('查询错误，如需查看具体错误信息，请开启调试模式', '');
                    }
                }
            }
        }
        $this->querynum++;
        
        return $query;

    }
    public function affected_rows()
    {
        return mysqli_affected_rows($this->link);
    }
    public function error()
    {
        return (($this->link) ? mysqli_error($this->link) : mysqli_error());
    }
    public function errno()
    {
        return intval(($this->link) ? mysqli_errno($this->link) : mysqli_errno());
    }
    public function result($query, $row = 0)
    {
    	/*d($query);*/
    	/*mysqli_use_result();*/
    	if(function_exists(mysqli_result)){
			$query = @mysqli_result($query, $row);
        return $query;
		}else{
		return MYSQLI_STORE_RESULT($this->link,$row);
		}
    	
        
    }
    public function num_rows($query)
    {
        $query = mysqli_num_rows($query);
        return $query;
    }
    public function num_fields($query)
    {
        return mysqli_num_fields($query);
    }
    public function free_result($resource)
    {
        if (is_resource($resource)) {
            mysqli_free_result($resource);
        }
    }
    public function insert_id()
    {
        return ($id = mysqli_insert_id($this->link)) >= 0 ? $id : $this->result($this->
            query("SELECT last_insert_id()"), 0);
    }
    public function fetch_row($query)
    {
        $query = mysqli_fetch_row($query);
        return $query;
    }
    public function fetch_fields($query)
    {
        return mysqli_fetch_field($query);
    }
    public function version()
    {
    	
    	if(empty($this->version) && function_exists(mysqli_get_server_info)){
			 $this->version = mysqli_get_server_info($this->link);
			  return $this->version;
		}
        if (empty($this->version) && function_exists(mysql_get_server_info)) {
            $this->version = mysql_get_server_info($this->link);
             return $this->version;
            
            
        }
        
		
       
    }
    public function close()
    {
        return mysqli_close($this->link);
    }
    public function halt($message = '', $sql = '')
    {
        
        if (G_DEBUG) {
            $dberror = $this->error();
           /* $dberrno = $this->errno();*/
            echo "<meta http-equiv='Content-Type' content='text/html;charset=" .
            G_CHARSET . "' /><div style=\"position:absolute;font-size:11px;font-family:verdana,arial;background:#EBEBEB;padding:0.5em;\"><b>MySQL Error</b><br><b>Message</b>: $message<br><b>SQL</b>: $sql<br><b>Error</b>: $dberror<br><b>Errno.</b>: $dberrno<br></div>";
            exit();
        } else {
            d($message);
        }
    }
    public function getall($sql, $iscache = true)
    {
        $res = $this->query($sql);
        
        if ($res !== false) {
            $arr = array();
            while ($row = mysqli_fetch_assoc($res)) {
               
                $arr[] = $row;
            }
            $this->free_result($res);
        } else {
            return false;
        }
        return $arr;
    }
    public function insert($table, $array, $auto = 1, $is = 0)
    {
        $fields = $values = array();
        
        if (empty($array))
            return false;
        $sql_array = array();
        if ($is) {
            foreach ($array[0] as $key => $val) {
                
                if (strstr($key, '`')) {
                    $fields[] = $key;
                } else {
                    $fields[] = '`' . $key . '`';
                }
            }
            foreach ($array as $arr) {
                foreach ($arr as $key => $val) {
                    $values[] = $this->encode($val);
                }
                $sql_array[] = '(\'' . implode('\',\'', $values) . '\')';
                $values = array();
            }
        } else {
            foreach ($array as $key => $val) {
                
                if (strstr($key, '`')) {
                    $fields[] = $key;
                } else {
                    $fields[] = '`' . $key . '`';
                }
                $values[] = $this->encode($val);
            }
            $sql_array[] = '(\'' . implode('\',\'', $values) . '\')';
        }
        $sql = 'INSERT INTO ' . $table . ' (' . implode(',', $fields) . ') VALUES ';
        $sql .= implode(',', $sql_array) . ';';
     
        if ($this->query($sql)) {
            if ($auto == 1) {
                
                return $this->insert_id();
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    
    public function update($table, $array, $where = null, $bool = true)
    {
     
        $fields = $values = array();
        foreach ($array as $key => $val) {
            if (strstr($key, '`')) {
            } else {
                $key = '`' . $key . '`';
            }
            if (strlen($val) > 50 || $bool) {
                $values[] = $key . '="' . $this->encode($val) . '"';
            } else {
                $values[] = preg_match("/\+|\-|\*/", $val) ? $key . '=' . $this->encode($val) :
                    $key . '="' . $this->encode($val) . '"';
            }
        }
       
        $sql = 'UPDATE ' . $table . ' SET ' . implode(',', $values) . (empty($where) ?
            ';' : ' WHERE ' . $where . ';');

        if ($this->query($sql)) {
           
           return true;
        } else {
           return false;
        }
        
      
          
     
    }
    public function encode($s)
    {
    	
        if (MAGIC_QUOTES_GPC) {
            $s = stripslashes($s);
        }
        return addslashes($s);
    }
    public function fetch_newid($sql, $startid)
    {
        $n_id = 0;
       
       
        $result = $this->query($sql);
        
        $ns = $this->result($result, 0);
        if (empty($ns) || $ns == "") {
            $n_id = $startid;
        } else {
            $n_id = ($ns + 1);
        }
        return $n_id;
    }
    public function fetch_count($sql)
    {
        return $this->result($this->query($sql), 0);
    }
    public function check_data($sql)
    {
        $returnflag = false;
        $result = $this->query($sql);
        if ($this->num_rows($result) == 0) {
            $returnflag = false;
        } else {
            $returnflag = true;
        }
        return $returnflag;
    }

    
    public function create_table($tabname, $sql)
    {
        $sql_strings = "CREATE TABLE IF NOT EXISTS {$tabname} ({$sql}) ENGINE=MyISAM  CHARSET=" .
            DB_CHARSET . ";";
        $this->query($sql_strings);
    }

    
    public function alter_table($tableName, $sql)
    {
        $this->query("ALTER TABLE {$tableName} {$sql};");
    }

    
    public function table_exist($table)
    {
        $status = false;
        $rs = $this->query("SHOW TABLE STATUS LIKE '" . DB_PREFIX . "%'");
        while ($dbList = $this->fetch_assoc($rs)) {
            $db_tabls[] = $dbList['Name'];
        }
        unset($rs);
        if (in_array(DB_PREFIX . $table, $db_tabls)) {
            $status = true;
        }
        return $status;
    }

    
    public function get_one($SQL)
    {
        $query = $this->query($SQL, 'UNBUFFERED');
        	
        $rs = mysqli_fetch_array($query, MYSQLI_ASSOC);
      
        return $rs;
    }

    public function fetch_assoc($query)
    {
        return mysqli_fetch_assoc($query);
    }

    public function get_row($sql, $limited = false)
    {
        if ($limited == true) {
            $sql = trim($sql . ' LIMIT 1');
        }
        $res = $this->query($sql);
        if ($res !== false) {
            return mysqli_fetch_assoc($res);
        } else {
            return false;
        }
    }
}

?>
