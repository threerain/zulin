<style>
#jqaddlink{display:none!important;}
#loginpage{width:300px;float:right;margin-right:15%;margin-top:10%;background:#fff;padding-left:60px;border-radius:15px;height:400px;}
#youshititle{height:40px;margin-top:-80px;line-height:40px;position:absolute;font-size:30px;color:#fff;letter-spacing: 1px;font-size:30px}
.form-title{letter-spacing: 10px;text-align:center;margin-left:-60px;margin-top:30px;font-size:26px;}
#username,#password{border-left-width:0px;border-right-width:0px;border-top-width:0px;border-bottom:1px solid #aaa;}
</style>
      <form class="form-vertical login-form" method="POST" action="/admin/login" id="loginpage" name="Form1">
      <h3 id="youshititle"  >幼狮租赁管理平台</h3>
      <h3 class="form-title">登录</h3>

      <div class="alert alert-error hide">

        <button class="close" data-dismiss="alert"></button>

        <span>输入用户名、密码</span>

      </div>

      <div class="alert alert-error2 hide" style="margin-bottom:-40px;">

        <button class="close" data-dismiss="alert"></button>

        <span>用户名或密码错误</span>

      </div>

      <div class="alert alert-error1 hide" style="margin-bottom:-40px;">

        <button class="close" data-dismiss="alert"></button>

        <span>用户名不存在</span>

      </div>

      <div class="control-group" style="margin-top:50px;">

        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

        <label class="control-label visible-ie8 visible-ie9">用户名</label>

        <div class="controls">

          <div class="input-icon left">

            <i class="icon-user"></i>

            <input class="m-wrap placeholder-no-fix" type="text" placeholder="请输入用户名" name="username" id="username" style="border-left-width:0px;border-right-width:0px;border-top-width:0px;"/>

          </div>

        </div>

      </div>

      <div class="control-group" style="margin-top:50px;">

        <label class="control-label visible-ie8 visible-ie9">密码</label>

        <div class="controls">

          <div class="input-icon left">

            <i class="icon-lock"></i>

            <input class="m-wrap placeholder-no-fix" type="password" placeholder="请输入密码" name="password" id="password" onkeydown="KeyDown()"/>

          </div>

        </div>

      </div>

      <div class="form-actions" style="margin-top:40px;">

        <label class="checkbox">

        <!-- <input type="checkbox" name="remember" value="1"/> Remember me -->

        </label>

        <button type="submit" class="btn green" style="width:250px;height:33px;border-radius:10px;text-align:center;" name="btnsubmit">

       <b> 登&nbsp;&nbsp;&nbsp;录 </b>

        </button>            

      </div>

      <!-- <div class="forget-password">

        <h4>Forgot your password ?</h4>

        <p>

          no worries, click <a href="javascript:;" class="" id="forget-password">here</a>

          to reset your password.

        </p>

      </div>

      <div class="create-account">

        <p>

          Don't have an account yet ?&nbsp; 

          <a href="javascript:;" id="register-btn" class="">Create an account</a>

        </p>

      </div> -->

    </form>

