<style>

	.test{width:20%;margin:1% 2%!important;}
	.test b{display:inline-block;width:6%;text-align:right;}
	.test select{margin-left:-3px;}
	.line3{width:40%;margin-left:3.5%;}
	.line4{width:40%;margin-left:7%;}
	input,select{border:1px solid #aaa!important;}
	#sample_editable_1_new{height:31px;margin-left:-5px;font-size:15px;line-height:15px;}
  td a{margin-top:8px;}
#footer{float:left!important;width:300px;}
input{width:150px;}
select{width:150px;}
}
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);

?>
</style>
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

            <div class="caption"><i class="icon-globe"></i>跟进列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <form action="/admin/salescontrol/lookfollow" style="margin:30px" >
                  <div class="dataTables_filter" style="margin-bottom:30px" id="">
                    <input type="hidden" name="id" value="<?php echo $property_id?>">
                    <span class="test">带看日期：<input type="text" id="datepicker" value="<?php echo $signing_date1?>" name="keyword_signing_date1" />&nbsp至&nbsp;<input type="text" id="datepicker1" value="<?php echo $signing_date2?>" name="keyword_signing_date2" /></span>
                    <span class="test">渠道公司：<input type="text" value="<?php echo $channel_id?>" name="keyword_channel_id"></span>
                    <span class="test">渠道负责人：<input type="text" value="<?php echo $channel_manager_id?>" name="keyword_channel_manager_id" ></span>
                  </div>
                  <div class="dataTables_filter" style="margin-bottom:10px" id="">
                    <!-- <span class="test">所搜区域：<input type="text" value="" name="keyword_id"></span> -->
                    <span class="test">搜索组别：<input type="text" value="<?php echo $department_id?>" name="keyword_department_id"></span>
                    <span class="test">带看人姓名：<input type="text" value="<?php echo $creater_id?>" name="keyword_creater_id"></span>
                    <button id="sample_editable_1_new" class="btn btn-primary" type="submit">
                      搜索 <i class="icon-search"></i>
                    </button>
                  </div>
                  <div class="dataTables_filter" style="margin-bottom:10px">
                   <script type="text/javascript">
                        var picker = new Pikaday({
                          field: document.getElementById('datepicker'),
                          firstDay: 1,
                          minDate: new Date('2010-01-01'),
                          maxDate: new Date('2030-12-31'),
                          yearRange:[2000,2030]
                        });
                        var picker = new Pikaday({
                            field: document.getElementById('datepicker1'),
                            firstDay: 1,
                            minDate: new Date('2010-01-01'),
                            maxDate: new Date('2030-12-31'),
                            yearRange: [2000,2030]
                        });


                    </script>

              </form>

          </div>


              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                  <thead>
                    <tr class="yj-title-th">
                      <th class="hidden-480">幼狮带看人员</th>
                      <th class="hidden-480">渠道公司</th>
                      <th class="hidden-480">渠道公司人员</th>
                      <th class="hidden-480">是否负责人</th>
                      <th class="hidden-480">客户业态</th>
                      <th class="hidden-480">需求面积</th>
                      <th class="hidden-480">预算</th>
                      <th class="hidden-480">需求区域</th>
                      <th class="hidden-480">订房时间</th>
                      <th class="hidden-480">跟进日期</th>
                      <th class="hidden-480">跟进详情</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- 遍历查看跟进表 -->
                    <?php
                    if($list){
                      foreach($list as $key=>$user){
                    ?>
                      <tr class="odd gradeX">
                        <td class="hidden-480"><?php $item=AdminUser::model()->find("id='$user->creater_id'"); echo $item?$item->nickname:""; ?></td>
                        <td class="hidden-480"><?php $item=CmsChannel::model()->find("id='$user->channel_id'"); echo $item?$item->name:"";?></td>
                        <td class="hidden-480"><?php $item=CmsChannelManager::model()->find("id='$user->channel_manager_id'"); echo $item?$item->name:"";?></td>
                        <td class="hidden-480"><?php
                            if($user->responsible_person==1){
                                echo '是';
                            }else if($user->responsible_person==2) {
                                echo '否';
                            }
                        ?></td>
                        <td class="hidden-480"><?php echo $user->customer_business;?></td>
                        <td class="hidden-480"><?php echo $user->demand_area/100;?></td>
                        <td class="hidden-480"><?php echo $user->budget;?></td>
                        <td class="hidden-480"><?php echo $user->demand_district;?></td>
                        <td class="hidden-480"><?php echo date("Y.m.d ",$user->room_time);?></td>
                        <td class="hidden-480"><?php echo date("Y.m.d H:i:s",$user->ctime);?></td>
                        <td class="hidden-480"><?php echo $user->follow_detail;?></td>
                      </tr>
                  <?php
                      }
                    }
                  ?>
                  </tbody>

              </table>
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
								<button  class="btn" type="button" onclick="history.go(-1)">
									返回
								</button>
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
