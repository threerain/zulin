  <style>
  #btn{position:fixed; right:10px; bottom:10px; width:40px; height:40px; background:url(/css/admin/image/icon1.png) no-repeat left top;} 
  #btn:hover{background:url(/css/admin/image/icon1.png) no-repeat 0 -39px!important;}
  </style>
  <div class="footer">

    <div class="footer-inner">

      2017 &copy;  by lizhaohui.

    </div>

    <div class="footer-tools">

      <span class="go-top">

      <a href="javascript:;" id="btn" title="返回顶部"></a>
      
      </span>

    </div>

  </div>
  <script type="text/javascript">
    var oBtn = document.getElementById('btn');
    oBtn.onclick = function(){

      timer = setInterval( function(){
        var oTop = document.documentElement.scrollTop || document.body.scrollTop;
        var oSpeed = Math.floor(-(oTop/6)) ;  // 实现非匀速返回顶部，并取整为了减少计算量（内存损耗）；取负值为了能够取消定时--器；
        document.documentElement.scrollTop = document.body.scrollTop = oTop + oSpeed ;

        if( oTop == 0 ){
          clearInterval(timer);
        }

        isTop = true;
      } , 30)
    }
  </script>