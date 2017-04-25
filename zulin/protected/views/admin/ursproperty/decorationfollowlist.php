<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
<div class="page-content">
  <!-- BEGIN PAGE CONTAINER-->
  <div class="container-fluid">
    <!-- BEGIN PAGE HEADER-->
    <div class="row-fluid" style="min-height:10px;"></div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey">
          <div class="portlet-title">

            <div class="caption"><i class="icon-globe"></i>装修跟进列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">
                <div class="span8">
                  <form action="/admin/ursproperty/DecorationFollow" style="margin:30px;" >
                    <div class="dataTables_filter" style="margin-bottom:10px">
                      <input type="hidden"  value="<?php echo $keyword_property_id;?>" name="id" />
                      <span>
                        装修状态：
                        <select name="keyword_decoration_status" id="">
                          <option value="0">请选择</option>
                          <?php foreach ($ursarr['decoration_status'] as $key => $value) {?>
                          <option value="<?php echo $key?>"  <?php echo $keyword_decoration_status==$key? "selected":""?>><?php echo $value ?></option>
                          <?php } ?>
                        </select>
                      </span>
                      <span style="margin-right:80px">日期：<input type="text" id="datepicker" value="<?php echo $keyword_start_time;?>" name="keyword_start_time" />至<input type="text" id="datepicker1" value="<?php echo $keyword_end_time;?>" name="keyword_end_time" /></span>
                      <button id="sample_editable_1_new" class="btn btn-primary" type="submit">搜索 <i class="icon-search"></i></button>
                    </div>
                  </form>
                </div>
              </div>
              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                  <thead>
                    <tr class="yj-title-th">
                      <th class="hidden-480">日期</th>
                      <th class="hidden-480">跟进人</th>
                      <th class="hidden-480">装修状态</th>
                      <th class="hidden-480">装修队</th>
                      <th class="hidden-480">产品质量区域负责人</th>
                      <th class="hidden-480">花费金额</th>
                      <th class="hidden-480">操作</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($list){
                      foreach($list as $user){
                    ?>
                      <tr class="odd gradeX">
                        <td class="hidden-480"><?php echo $user->ctime?date("Y.m.d H:i:s",$user->ctime):""; ?></td>
                        <td class="hidden-480"><?php $item=AdminUser::model()->find("id='$user->creater_id'"); echo $item?$item->nickname:""; ?></td>
                        <td class="hidden-480"><?php echo $user->decoration_status?$ursarr['decoration_status']["$user->decoration_status"]:'未装修'; ?></td>
                        <td class="hidden-480"><?php echo $user->decoration_team; ?></td>
                        <td class="hidden-480"><?php $item=AdminUser::model()->find("id='$user->responsible_people'"); echo $item?$item->nickname:""; ?></td>
                        <td class="hidden-480"><?php echo $user->money/100; ?></td>
                        <td class="hidden-480">
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
                              <a href="/admin/ursproperty/decorationdetail/id/<?php echo $user->id;?>">详情</a>
                              <?php
                                  $user = Yii::app()->session["admin_uid"];
                                  $name = AdminUser::model()->find("id='$user'");
                              if($name->type==0) {?>
                                <a href="/admin/ursproperty/decorationdelete/id/<?php echo $user->id;?>">删除</a>
                              <?php }?>
                            </ul>
                          </div>
                        </td>
                      </tr>
                  <?php
                      }
                    }
                  ?>
                  </tbody>
              </table>
              <button type="button" class="btn" onClick="javascript:history.go(-1)" style="margin-top:30px;">返回</button>
              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination">
                    <?php
                    // $ps = Yii::app()->params['pageSetting'];
                    $this->widget('NewLinkPager', array(
                      'pages' => $pages,
                      ));
                      ?>
                  </div>
                </div>
              </div>
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
</div>
<script type="text/javascript">
  var picker = new Pikaday({
    field: document.getElementById('datepicker'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });

  var picker = new Pikaday({
    field: document.getElementById('datepicker1'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
</script>
