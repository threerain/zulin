<style>
	.left{float:left;height:630px;width:12%;border:1px solid #999;margin-right:1%;margin-left:2%;padding-top:20px;text-align:center;}
	.left p{font-size:18px;margin-top:15px;text-align:left;padding-left:40px;}
	.right{float:left;height:650px;width:82%;border:1px solid #999;text-align:center;}
	.right h5{text-align:left;text-indent:2em;border-bottom:1px solid #dddddd;padding-bottom:10px;}
	.portlet-body{padding-top:15px;}
	#pageform{width:100%;padding-top:30px;overflow: hidden;min-width:1200px;}
	#pageform span:first-child{float:left;width:100px;}
	#pageform span{float:left;margin-left:20px;}
	td{text-align:left!important;}
  input{
    width:120px;
  }
</style>
<?php

  $this->PAGE_LEVEL_STYLES='<link href="/css/admin/select2_metro.css" rel="stylesheet" type="text/css"/>'."\r\n";
  $this->PAGE_LEVEL_STYLES.='  <link href="/css/admin/DT_bootstrap.css" rel="stylesheet" type="text/css"/>';

  $this->PAGE_LEVEL_PLUGINS.='<script type="text/javascript" src="/css/admin/js/select2.min.js"></script>'."\r\n";
  $this->PAGE_LEVEL_PLUGINS.='  <script type="text/javascript" src="/css/admin/js/jquery.dataTables.js"></script>'."\r\n";
  $this->PAGE_LEVEL_PLUGINS.='  <script type="text/javascript" src="/css/admin/js/DT_bootstrap.js"></script>'."\r\n";
  $this->PAGE_LEVEL_SCRIPTS.='<script type="text/javascript" src="/css/admin/js/app.js"></script>'."\r\n";

  $this->PAGE_LEVEL_SCRIPTS.='  <script type="text/javascript" src="/css/admin/js/table-managed.js"></script>'."\r\n";

  Yii::app()->clientScript->registerScript("","
    App.init();
     
    TableManaged.init();");
?>
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>

<div class="page-content">
  <!-- BEGIN PAGE CONTAINER-->
  <!-- <div class="container-fluid"> -->
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid" style="min-height:10px;"></div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey">
          <div class="portlet-title">
            
            <div class="caption"><i class="icon-globe"></i>消息列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <?php if(!empty($alert_error)){ ?>
              <div class="alert alert-error hide" style="display: block;">
                  <button class="close" data-dismiss="alert"></button>
                  <?php 
                    $arrs =[1=>'请选择要删除的数据',2=>"信息已不存在",4=>"该合同已失效",6=>"该合同已失效",7=>"该车源已下销控",8=>"该车源已不在幼狮车源",9=>"已找到收款人或已不存在",10=>"该信息已被删除",11=>"请选择标记的信息",12=>"该公告已失效"];
                    foreach ($arrs as $key => $value) {
                        if($alert_error == $key){
                            echo $value;
                        }
                    }

                   ?>
              </div>
          <?php } unset($alert_error); ?>
            <div class="portlet-body">
              <div  style="border-color:#dddddd" class='left'>

          <?php foreach ($news_list as $key => $value) { ?>
             <p style="font-size:15px;<?php echo $value['news_type'] == $news_type ? 'background-color:#C1C0BE' : ''?>"><a href='<?php  echo  $value['url'] ?>'><?php echo $key ?><span ><?php echo $value['unread'] == 0 ? '' :'('.$value['unread'].')'  ?><span></a></p>
          <?php } ?>
          
              </div>
              <div class='right' style="border-color:#dddddd">
          <form action="/admin/usernews/del" id="forms">
          <h5><a href="/admin/usernews?">所有消息</a><?php echo  empty($news_type_name) ? '': "<span > >> ".$news_type_name.'</span>' ?></h5>
          <div class="dataTables_filter" id="pageform">
                       <span class="test"><button type="submit" class="btn btn-primary">删除</button></span>
                       <span class="test sign"><button type="submit" class="btn btn-primary">标为已读</button></span>
                        <span class="test">状态：
                        <select name="news" style=" width:120px;">
                            <option value="0" <?php echo $news == 0 ? "selected" : ''  ?>>全部</option>
                            <option value="1" <?php echo $news == 1 ? "selected" : ''  ?>>已读</option>
                            <option value="2" <?php echo $news == 2 ? "selected" : ''  ?>>未读</option>
    
                        </select></span>
                      <input type="hidden" name="news_type" value="<?php echo $news_type; ?>">
                      <span class="test">时间：<input type="text" id="datepicker3" value="<?php echo $keyword_signing_date1  ?>" name="keyword_signing_date1"/>至<input type="text" id="datepicker4" value="<?php echo $keyword_signing_date2  ?>" name="keyword_signing_date2"/></span>
                    <span class=""><button type="submit" class="btn btn-primary" id="search">搜索</button></span>
                    <script type="text/javascript">
                        $("#search").click(function(){
                            $("#forms").attr('action','/admin/usernews');
                            var a = $("#forms").attr('action');
                        })
                        $(".sign").click(function(){
                            $("#forms").attr('action','/admin/usernews/sign');
                            var a = $("#forms").attr('action');
                        })

                    </script>
                    <script type="text/javascript">
                          var picker = new Pikaday({
                              field: document.getElementById('datepicker3'),
                              firstDay: 1,
                              minDate: new Date('2010-01-01'),
                              maxDate: new Date('2030-12-31'),
                              yearRange: [2000,2030]
                          });

                          var picker = new Pikaday({
                              field: document.getElementById('datepicker4'),
                              firstDay: 1,
                              minDate: new Date('2010-01-01'),
                              maxDate: new Date('2030-12-31'),
                              yearRange: [2000,2030]
                          });
                      </script>
                    </div>
                    <table class="table table-striped table-bordered " id="sample" style="margin-top:70px">
                    <thead>
                      <tr>
                        <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th>
                        <th>消息内容</th>

                        <th>制单人</th>
                        <th class="hidden-480">时间</th>
                      </tr>
                    </thead>  
                    <tbody>
            <?php foreach ($list as $key => $value) { ?>
                 <?php if ($value['status'] == 1) { ?>
                      <tr>
                        <td style="width:8px;"><input type="checkbox" class="checkboxes" name="ids[]" value="<?php echo CHtml::encode($value->id); ?>" /></td>
                        <td style='background:url(/css/admin/image/weidu.png) no-repeat left center;background-size:18px 70%;padding-left:10px;background-origin: content-box;text-indent:40px;'><a href='<?php foreach ($arr as $k => $v) {
                          if ($v[1] == $value['news_type']) {
                              echo $v[3].'&news_content_id='.$value['news_content_id'].'&news_id='.$value['id'];  
                          }
                      } ?>' style='color:#aaa;'><?php echo $value['news_title'] ?></a></td>
                        <td style="text-align:center !important"><?php $admin = AdminUser::model()->find("id = '{$value['action_user_id']}'"); $AdminDepartment = AdminDepartment::model()->find("id = '{$admin['department_id']}'")['name'] ;echo $AdminDepartment.'/'.$admin['nickname'] ?></td>
                        <td style="text-align:center !important"><?php echo date('Y-m-d H:i:s',$value['ctime']) ?></td>
                      </tr>
                 <?php }else{ ?>
                    <tr>
                      <td style="width:8px;"><input type="checkbox" class="checkboxes" name="ids[]" value="<?php echo CHtml::encode($value->id); ?>" /></td>
                      <td style='background:url(/css/admin/image/yidu.png) no-repeat left center;background-size:18px 60%;padding-left:10px;background-origin: content-box;text-indent:40px;'><a href='<?php foreach ($arr as $k => $v) {
                          if ($v[1] == $value['news_type']) {
                              echo $v[3].'&news_content_id='.$value['news_content_id'].'&news_id='.$value['id'];  
                          }
                      } ?>'><?php echo $value['news_title'] ?></a></td>
                      <td style="text-align:center !important;"><?php $admin = AdminUser::model()->find("id = '{$value['action_user_id']}'"); $AdminDepartment = AdminDepartment::model()->find("id = '{$admin['department_id']}'")['name'] ;echo $AdminDepartment.'/'.$admin['nickname'] ?></td>
                      <td style="text-align:center !important"><?php echo date('Y-m-d H:i:s',$value['ctime']) ?></td>
                    </tr>
            <?php }} ?>
                    </tbody>            
                 </table>
                 </form>
	            </div>
              <div class="dataTables_paginate paging_bootstrap pagination" style="margin:30px auto;width:99%;text-align:center;">
                    <?php
                    // $ps = Yii::app()->params['pageSetting'];
                    $this->widget('NewLinkPager', array(
                      'pages' => $pages,
                      ));
                      ?>
                    </div>
            </div>
          </div>
          <!-- END EXAMPLE TABLE PORTLET-->
        </div>
      </div>
    </div>
    <!-- END PAGE CONTENT-->
  </div>
  <!-- END PAGE CONTAINER-->
<!-- </div> -->

<script type="text/javascript">
            jQuery('#sample .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                    } else {
                        $(this).attr("checked", false);
                    }
                });
                jQuery.uniform.update(set);
            });

            jQuery('#sample .group-checkable').change(function () {
                var set = jQuery(this).attr("data-set");
                var checked = jQuery(this).is(":checked");
                jQuery(set).each(function () {
                    if (checked) {
                        $(this).attr("checked", true);
                    } else {
                        $(this).attr("checked", false);
                    }
                });
                jQuery.uniform.update(set);
            });
</script>

<div id="errModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">

    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

        <h3 id="myModalLabel2">错误</h3>

    </div>

    <div class="modal-body">

        <p>Body goes here...</p>

    </div>

    <div class="modal-footer">

        <button data-dismiss="modal" class="btn green">OK</button>

    </div>

</div>
<script type="text/javascript">
  
   
</script>