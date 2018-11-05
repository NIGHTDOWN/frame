/**
 * 展示消息框
 * @param msg
 * @param href
 */
function show_msg_box(msg,href){
    var window_height = $(window).height();
    $('#show_alert').height(window_height);
    $("#show_alert h5").text(msg);
    //var margin_top = (parseInt(window_height)-parseInt($('#show_alert .show').height()))/2;
    var margin_top = (parseInt(window_height)-parseInt(210))/2;
    $('#show_alert .show').css('margin-top',margin_top);
    $("#show_alert").show();
    if(href){
        $("#show_alert").attr('data-href',href);
        setTimeout(function(){
            if(href == 'self'){
                window.location.reload();
            }else{
                window.location.href = href;
            }
        }, 3000);
    }

}

/**
 * 关闭消息框
 */
function close_msg_box(){
    $("#show_alert h5").text("");
    $("#show_alert").hide();
    var href = $("#show_alert").attr('data-href');
    if(href){
        if(href == 'self'){
            window.location.reload();
        }else{
            window.location.href = href;
        }

    }
}

/**
 * 发送验证码
 * @param obj
 * @param mobile
 */
function send_code(obj){
    var url = '/index.php/User/Register/sendMobileCode';
    var param = {
        mobile : $('#mobile').val(),
        type : obj.attr('data-type')
    };
    var reg = /^[1]\d{10}$/;
    if(param.mobile == ''){
        show_msg_box('手机号码不能为空！');return;
    }
    if(!reg.test(param.mobile)){
        show_msg_box('手机号码格式错误！');return;
    }
    $.post(url,param,function(data){
        //var  data = JSON.parse(data);
        if(data.status){
            show_msg_box("发送成功！");
            send_code_timer(obj,'send_code($(this))');
        }else{
            show_msg_box(data.errMsg);
        }
    })
}

/**
 * 重发倒计时
 * @param obj
 * @param fun
 */
function send_code_timer(obj,fun){
    var old_str = obj.text();
    var timer = obj.attr('data-timer');
    var setintervalTimer = setInterval(function(){
        var timer1 = obj.attr('data-timer');
        if(timer1>=0){
            obj.removeAttr('onclick');
            var str = '（'+timer1+'s）重发';
            obj.text(str);
            timer1 --;
            obj.attr('data-timer',timer1)
        }else{
            obj.attr('onclick',fun);
            obj.text(old_str);
            obj.attr('data-timer',timer)
            clearInterval(setintervalTimer);
        }
    },1000);
}

/**
 * 页面跳转
 */
$('.page-to-other').click(function(){
    var obj = $(this);
    window.location.href = obj.attr('data-href');
});

/**
 * 上传截图预览
 */
function preview_img(id){
    if(id > 0){
        var preview = document.getElementById('preview_'+id);
        var upload_img = document.getElementById('path_'+id);
        preview.src = window.URL.createObjectURL(upload_img.files[0]);
        $('#preview_'+id).show();
    }else{
        var preview = document.getElementById('preview');
        var upload_img = document.getElementById('path');
        preview.src = window.URL.createObjectURL(upload_img.files[0]);
        $('.upload_img').show();
        $('#preview_box').show();
    }
}

/**
 * 订单倒计时
 */
function order_count_down(){
    var objs = $('.count-down');
    objs.each(function(i){
        var obj = $(this);
        var str = '';
        var count_down_time = parseInt(obj.attr('data-count-down'));
        if(count_down_time > 0){
            var hours       = Math.floor(count_down_time/3600);
            var minutes     = Math.floor(count_down_time%3600/60);
            var seconds     = Math.floor(count_down_time%3600%60);
            str = hours+'小时'+minutes+'分钟'+seconds+'秒';
        }else{
            str = '--';
        }
        count_down_time --;
        if(count_down_time < 0) count_down_time = 0;
        obj.attr('data-count-down',count_down_time);
        obj.text(str);
    })
}
setInterval('order_count_down()',1000);

/**
 * 自动匹配
 */
function autoMatching(){
    var url = "/index.php/OfferApply/Index/index";
    $.post(url);
}

/**
 * 账户自动封号
 */
function autoFreezeUser(){
    var url = "/index.php/OfferApply/Freeze/index";
    $.post(url);
}