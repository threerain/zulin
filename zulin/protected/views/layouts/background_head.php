<head>

  <meta charset="utf-8" />

  <title>ERP系统</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <meta content="" name="description" />

  <meta content="" name="author" />

  <!-- BEGIN GLOBAL MANDATORY STYLES -->

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap.min.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/font-awesome.min.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style-metro.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/style-responsive.css" rel="stylesheet" type="text/css"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/default.css" rel="stylesheet" type="text/css" id="style_color"/>

  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/uniform.default.css" rel="stylesheet" type="text/css"/>

  <!-- END GLOBAL MANDATORY STYLES -->

  <!-- BEGIN PAGE LEVEL STYLES -->

  <?php echo isset($this->PAGE_LEVEL_STYLES)?$this->PAGE_LEVEL_STYLES:"";?>


  <!-- END PAGE LEVEL STYLES -->

  <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin/image/favicon.ico" />

<style>
  th,td{text-align:center!important;vertical-align: middle!important;}

  .portlet-title{background:font-size:22px;background:no-repeat center left #167ac7!important;
  background-position:10px 6px!important;}
  .portlet-body{border-top-width:0!important;}
  .form-actions{background:#fff;border:0;}
  .controls{margin-top:7px;}
  #btn{color:#fff;background:#167ac7;margin-left:-90px;}
  #btn:hover{background:#0160cb!important;}
  .control-group{margin-top:12px;margin-bottom:-5px;}
  .btn{font-size:16px;}
  

	input{border:1px solid #aaa!important;height:20px!important;border-radius:5px!important;}
	button{height:33px!important;border-radius:5px!important;margin-left:5px!important;}
	select,textarea{border-color:#aaa!important;}
	.control-group{margin-left:50px;margin-top:-8px;padding-bottom:20px;}
	.control-label{margin-top:8px;width:100px;}
.brand img{margin-top:-5px;margin-left:30px;}
.brand{padding-left:30px;}
#sdf{background:#4D90FE;}
#lease_term_list{padding-left:30PX;}

/*有下拉的滚动条*/.control-group{overflow:auto;max-height:280px;margin-top:5px;}
/*避免布局显示*/.portlet-body{overflow:hidden;}
.tj-3y .control-group{clear:none;}
div.pull-right button{margin-right:10px;}

/*以下是设置的关闭响应式布局*/
/*.footer{width:100%!important;}*/
html{background:#fff;padding-right:0px;}
.page-content{background:#fff;}
.container-fluid{}
.span8 #add,#add2,#sample_editable_1{margin-right:40px;}
table td a{display:block;}
.btn-operation {
  position: relative;
  display: inline-block;
  font-size: 0;
  white-space: nowrap;
  vertical-align: middle;
  border-radius: 6px;
  background-color: #f5f5f5;
  background-image: linear-gradient(to bottom,#fff,#e6e6e6);
  background-repeat: repeat-x;
  border: 1px solid #ccc;
  border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
  border-bottom-color: #b3b3b3;
  box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
}
.btn-oper{
  display: inline-block;
  padding: 4px 10px;
  margin-bottom: 0;
  font-size: 14px;
  line-height: 20px;
  color: #333;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  border:0px !important;
  background-color: #f5f5f5;
  background-image: linear-gradient(to bottom,#fff,#e6e6e6);
  background-repeat: repeat-x;
  border: 1px solid #ccc;
  border-color: rgba(0,0,0,0.1) rgba(0,0,0,0.1) rgba(0,0,0,0.25);
  border-bottom-color: #b3b3b3;
  box-shadow: inset 0 1px 0 rgba(255,255,255,0.2),0 1px 2px rgba(0,0,0,0.05);
}
.dropdown-menu>li>a {
    display: block;
    padding: 3px 10px;
    clear: both;
    font-weight: normal;
    line-height: 20px;
    color: #333;
    white-space: nowrap;
}
.dropdown-menu{min-width:50px !important;}
.btn-oper .caret {
  margin-top: 10px;
  margin-left: 0;
}
a:link{
text-decoration:none;
}
.dataTables_wrapper{margin-left:40px;margin-right:40px;margin-bottom:132px;}
.page-content{margin-bottom:25px !important;}

/*这里是分页导航居中样式*/
.pagination li a{padding:8px 20px!important;text-indent:0px;}
/*下拉弹出导航的间隔*/
.dropdown-menu a{margin-top:5px;}
.dropdown-menu{padding-bottom:5px;}
</style>
</head>
<script>
  $(function(){
    var linklist="<a href='#' id='jqaddlink' style='margin-top:10px;display:inline-block;font-size:16px;font-weight:bold;color:#167AC7;text-indent:20px' onClick='javascript:history.go(-1)'>&lt;&lt;返回列表</a>";
    $(".container-fluid").eq(1).prepend(linklist);
  })
</script>