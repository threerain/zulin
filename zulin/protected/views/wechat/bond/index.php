<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <meta content="telephone=no" name="format-detection">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <title>ERP绑定</title>
    <link rel="stylesheet" href="/css/wechat/mlogin.min.css">
</head>
<body>
<header id="header" style="display:block;">
    <span class="icon icon-goback"></span>
    ERP绑定
</header>
<section class="page">
    <div class="wrap loginPage">
        <div class="input-container">
            <input id="username" class="acc-input username txt-input J_ping" type="text" placeholder="ERP登陆账号" autocomplete="off"  report-eventid="MLoginRegister_Username">
            <i class="icon icon-clear"></i>
        </div>
        <div class="input-container">
            <input id="password" type="password" class="acc-input password txt-input J_ping" placeholder="请输入密码" autocomplete="off" report-eventid="MLoginRegister_Password" >
            <i class="icon icon-clear"></i>
        </div>
        <input type="hidden" id="openid" value="<?php echo $openid ?>">
        <input type="hidden" id="nickname" value="<?php echo $nickname ?>">
        <input type="hidden" id="headimgurl" value="<?php echo $headimgurl ?>">
        <div class="notice">&nbsp;</div>
        <a href="javascript:;" id="loginBtn" class="btn J_ping" >绑定申请</a>
    </div>
</section>
<script src="/css/admin/js/jquery-1.8.3.min.js"></script>
<script>
var username;
$("#username").blur(function(){
    username = $(this).val();
    if($(this).val()==''){
        alert('不能为空')
    }
})
var password;
$("#password").blur(function(){
    password = $(this).val();
    if($(this).val()==''){
        alert('不能为空')
    }
})
$("#loginBtn").click(function(){ 
    var openid = $("#openid").val();
    var nickname = $("#nickname").val();
    var headimgurl = $("#headimgurl").val();


    $.ajax({
        type: "POST",
        url: "/wechat/bond/valid",
        dataType:'json',
        data: { username:username, password:password, openid:openid, nickname:nickname, headimgurl:headimgurl},
        success: function(msg){
        if(msg['code']!=200){
            alert(msg['msg']);
        }else{
            window.location.href=msg['href'];
        }
       }
    });  
})

</script>
</body></html>