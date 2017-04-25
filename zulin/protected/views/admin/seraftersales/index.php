
<style>
#jqaddlink{display:none!important;}
  .modal-body{font-size:18px;text-indent: 20px;}
  #modal-label{text-align:center;font-size:22px;}
  #about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
  #left{background:#167bcd;color:#fff;margin-right:10px;}
  #left:hover{background:#0160cb!important;}
  span{font-size:14px}
  .dataTables_filter{margin-top:30px;margin-left:50px;font-size:14px;}
  #sales{background-color:#fff;display:none;z-index:1;position:fixed;width:1200px;height:700px;left:50%;top:50%;overflow:auto;margin-top:-350px;margin-left:-600px;border-top:3px solid #222;border-radius:20px;border-top: 1px solid #167ac7!important;}
  #closemodel{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
  #follow{background-color:#fff;display:none;z-index:1;position:fixed;width:1200px;height:700px;left:50%;top:50%;overflow:auto;margin-top:-350px;margin-left:-300px;border:3px solid #222;border-radius:20px;border: 1px solid #167ac7!important;}
  #closemodel2{font-size:35px;font-weight:bold;position:absolute;top:10px;right:20px;color:#fff;cursor:pointer;}
  input{width:150px;}
  select{width:150px;}
  .table td{padding:3px;}
  .control-group{margin-top:-25px}
</style>

<?php
$this->breadcrumbs=array(
    'Admins'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List admin', 'url'=>array('index')),
    array('label'=>'Manage admin', 'url'=>array('admin')),
);
?>
<?php //css
  //<!-- BEGIN PAGE LEVEL STYLES -->
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
  //<!-- END PAGE LEVEL STYLES -->
?>

<?php //script
  //<!-- BEGIN PAGE LEVEL PLUGINS -->
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery-ui-1.10.2.custom.min.js',CClientScript::POS_END);

  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_outroom_commission.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'css/admin/js/validation/ser_pur_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);

  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
  App.init();
  FormValidation.init();
  FormComponents.init();
  ");
?>
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
<div class="page-content">
  <div id="portlet-config" class="modal hide">

      <div class="modal-header">

          <button data-dismiss="modal" class="close" type="button"></button>

          <h3>portlet Settings</h3>

      </div>

      <div class="modal-body">

          <p>Here will be a configuration form</p>

      </div>

  </div>
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

            <div class="caption"><i class="icon-globe"></i>售后列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid" style='height:120px'>
                <div >
                <form  style="margin-left:50px;margin-top:30px;" action="/admin/seraftersales/index" >
                  <input type="hidden" value="<?php echo $search ?>" name="search">
										<span>
									 商圈：<input type="text"  value="<?php echo $keyword_area?>"  name="keyword_area">
										</span>
										<span>
							               品牌：<input type="text" value="<?php echo $keyword_estates?>" name="keyword_estates">
										</span>
										<span>
										  系列：<input type="text"  value="<?php echo $keyword_building?>" name="keyword_building">
										</span>
										<span>
										编号：<input type="text" value="<?php echo $keyword_room_number?>" name="keyword_room_number">
                      	<!--<button id="highsearch" class="btn red" type="button" style="height:32px;line-height:20px;" onclick="show()">
						高级搜索 </button><input type="checkbox">-->
            <span>
            </button><input type="checkbox" id="highsearch">高级搜索
          </span>
        		<button id="sample_editable_1_new" class="btn btn-primary" type="submit" >
						搜索 <i class="icon-search"></i></button>
                      </span>
                    <br><br>




   <!--高级搜索的隐藏框-->
  <div id="content" style="display:none;">

                      <span >
                       报修时间：<input type="text"  value="<?php echo $keyword_ctime?>" id="datepicker"  name="keyword_ctime">至<input type="text"  id="datepicker1"  value="<?php echo $keyword_ctime1?>"  name="keyword_ctime1">
                      </span>
                      <span >
                        与车主约定维修结束日期：<input type="text"  value="<?php echo $keyword_hope_end_time?>" id="datepicker2"  name="keyword_hope_end_time">至<input type="text"  id="datepicker3"  value="<?php echo $keyword_hope_end_time1?>"  name="keyword_hope_end_time1">
                      </span><br><br>
                      <span>
  										制单人：<input type="text"  id='criter' value="<?php echo $keyword_criter?>"  name="keyword_criter">
  										</span>

                      <span>
  										 报修人(租户)：<input type="text" id='name' value="<?php echo $keyword_name?>"  name="keyword_name">
  										</span>
                      <span>
  										 报修人(幼狮)：<input type="text"  id='urs_user' value="<?php echo $keyword_urs_user?>"  name="keyword_urs_user">
                    </span><br><br>
                    <span class="test line21">维修类型：
                      <select name="keyword_repair_type" id="repair_type">
                              <option>请选择</option>
                        <?php
                              $type = SerAfterSales::model()->arr1();
                              foreach ($type['repair_type'] as $key => $value) {
                          ?>
                            <option value="<?php echo $key?>" <?php echo $keyword_repair_type==$key?"selected":''?> ><?php echo $value ?></option>
                        <?php
                          }?>
                      </select>
                   </span>
                      <span class="test line21">状态：
                        <select name="keyword_evolve_type" id="evolve_type">
                                <option>请选择</option>
                          <?php
                                $type = SerAfterSales::model()->arr1();
                                foreach ($type['evolve_type'] as $key => $value) {
                            ?>
                              <option value="<?php echo $key?>" <?php echo $keyword_evolve_type==$key?"selected":''?> ><?php echo $value ?></option>
                          <?php
                            }?>
                        </select>
                     </span>

  </div>

                <div class="btn-group pull-right">
                  <?php if(AdminPositionModul::has_modul("703_02")) {?>
                        <a href="/admin/seraftersales/neworder"> <button class="btn btn-primary " type="button" style="float:right" >
                     新建报修单 <i class="icon-plus"></i>
                    </button></a>
                  <?php }?>

                </div>
                </form>

                <!-- 高级搜索隐藏 -->
                <script type="text/javascript">
                    var bb = $("input[name=search]").val();
                     if(bb == 2){
                        $("#content").css("display","block")
                        $("#highsearch").attr("checked",true)
                     }
                </script>
                <!-- 高级搜索隐藏结束 -->
                <b style="color:red;float:left">注:"URS-SG-KJ"开头为收房合同ID&nbsp;&nbsp;"URS-XS-KJ"开头为交房合同ID</b>

                </div>
              </div>


              <table class="table table-striped table-bordered table-hover" id="sample"><!-- ID sample_1目前没用,js中控制显示效果 -->
                <thead>
                  <tr >
										<th >合同</th>
                    <th >商圈</th>
                    <th >品牌</th>
                    <th >系列</th>
                    <th >编号</th>
                    <th >报修人</th>
                    <th >制单人</th>
                    <th >报修时间</th>
                    <th >约定车主维修结束日期</th>
                    <th >类型</th>
                    <th >状态</th>
                    <th >操作</th>
                  </tr>
                </thead>
                <tbody>
									<?php foreach($list as $key => $value){
									?>

                    <tr >
											<td ><?php
													$contract_id = [];
													$contract_id = explode(',',$value->contract_id);
													if($contract_id!=null){
														foreach($contract_id as $val){
																	$contract = CmsPurchaseContract::model()->find("id='$val'");
																	if($contract){
																		if($contract->type==0){
																			echo "<a href=/admin/purchasecontract/detail/id/$contract->id target='_blank'>".$contract->id.'</a>';
																		}else{
																			echo "<a href=/admin/salecontract/detail/id/$contract->id target='_blank'>".$contract->id.'</a>';
																		}
																	}

																}
											}?></td>
                      <td ><?php
													$data=CmsProperty::model()->find("id='$value->property_id'");
													if($data){
														$item=BaseArea::model()->find("id='$data->area_id'");
													if($item){
															echo $item->name;
													}
													}

											 ?></td>
                      <td ><?php
													$data=CmsProperty::model()->find("id='$value->property_id'");
													if($data){
														$item=BaseEstate::model()->find("id='$data->estate_id'");
														echo $item->name;
													}

											?></td>
                      <td ><?php
													$data=CmsProperty::model()->find("id='$value->property_id'");
													if($data){
														$item=BaseBuilding::model()->find("id='$data->building_id'");
														echo $item->name;
													}

											?></td>
                      <td ><?php
												  $item=CmsProperty::model()->find("id='$value->property_id'");
													if($item){
														echo $item->house_no;
													}
											?></td>
                      <td ><?php
													if($value->repair_user_type==1){
                            if($value->name!=null) {
                              echo $value->name."(租户)";
                            }else{
                              $user = AdminUser::model()->find("id='$value->urs_user_id'");
                                if($user){
                                  echo $user->nickname."(幼狮)";

                                }
                            }
													}else{
															$user = AdminUser::model()->find("id='$value->urs_user_id'");
																if($user){
																	echo $user->nickname."(幼狮)";

																}
													}
											?></td>
                      <td ><?php
  													$user = AdminUser::model()->find("id='$value->criter_id'");
														echo $user->nickname;
											?></td>
                      <td ><?php
													echo date('Y-m-d H:i:s',$value->ctime);
											?></td>
                      <td><?php
                            if($value->hope_end_time) {
                              echo date("Y-m-d ",$value->hope_end_time);
                            }
                      ?>
                      </td>
                      <td ><?php
														if($value->repair_type==1){
																			echo '收房隐患';
														}else if($value->repair_type==2){
																			echo '交房隐患';
														}else if($value->repair_type==3){
																			echo '咨询开发票';
														}else if($value->repair_type==4){
																			echo '注册迁址';
														}else if($value->repair_type==5){
																			echo '投诉';
														}else if($value->repair_type==6){
																			echo '维修';
														}else if($value->repair_type==7){
															       echo '租户意向装修';
														}else if($value->repair_type==8) {
                                      echo '装修二次升级';
                            }
											?></td>
											<td ><?php
														if($value->evolve_type==1){
																			echo '质管未接单';
														}else if($value->evolve_type==2){
																			echo '质管已接单';
														}else if($value->evolve_type==3){
																			echo '已联系维修方';
														}else if($value->evolve_type==4){
																			echo '已完工';
														}else if($value->evolve_type==5){
																			echo '车主维修';
														}else if($value->evolve_type==6){
																			echo '客服已解决';
														}else if($value->evolve_type==7){
															       echo '客服未解决';
														}else if($value->evolve_type==8){
																		echo '租户维修';
														}
											?></td>
                      <td>
                        <div class="btn-operation">
                          <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                            操作
                            <span class="caret"></span>
                          </a>
                          <ul class="dropdown-menu" style="left:-20px; width:100px !important;">
                          <a href="/admin/seraftersales/details/id/<?php echo $value->id?>"  style="display:block">详情</a>

                        <?php if(AdminPositionModul::has_modul("703_03")) {?>
                          <a href="/admin/seraftersales/edit/id/<?php echo $value->id?>" style="display:block">编辑</a>
                        <?php }?>
                        <?php if(AdminPositionModul::has_modul("703_04")) {?>
                          <a data-toggle="modal" data-target="#about-modal" href="" address="/admin/seraftersales/delete/id/<?php echo $value->id;?>" style='display:block;' class='delete'>删除</a>
                        <?php }?>
                      </ul>
                    </div>
                      </td>
                    </tr>
										<div class="modal fade" id="about-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label"
										         aria-hidden="true">
										        <div class="modal-dialog">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h4 class="modal-title" id="modal-label">本站点提示...</h4>
										                </div>
										                <div class="modal-body">
										                    <p>确定要删除吗?</p>
										                </div>
										                <div class="modal-footer">
										                     <a id="left" class="btn btn-primary add" href="" onclick="javascript:return true;">确定</a>
										                     <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
										                </div>
										            </div>
										        </div>
										    </div>
										<?php }?>
                </tbody>
              </table>

              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>
                <div class="span8">
                  <div class="dataTables_paginate paging_bootstrap pagination" style='margin:30px auto;width:99%;text-align:center;'>
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



<div id="follow" class="portlet-body form" style="width:30%;height:60%">
  <div style="height:50px;background:#167AC7;margin-bottom:30px; "  class="portlet-title">
      <div class="caption" style="line-height:50px;font-size:20px;text-indent:30px;color:#fff">新建报修单</div>
    </div>
  <div class="control-group" style="margin-top:0px!important" id="closemodel2">
         ×
      </div>

<form action="/admin/seraftersales/create"  id="form_add"  method="post"  class="form-horizontal js-submit">
			<input type="hidden" name="solve" value="1">
      <div class="alert alert-error hide">
                  <button class="close" data-dismiss="alert"></button>
                  输入格式有误，请检查输入的数据.
              </div>
              <div class="alert alert-success hide">
                  <button class="close" data-dismiss="alert"></button>
                  数据输入验证成功!
              </div>
    <style>
        .control{float:left;}
    </style>
  <input type="hidden" name="property_id" id="property_id" value="">
  <div class="control-group" >
    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
    <div class="controls control" style="margin-left:10px">
      <label>制单人：<input type="text" value="<?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:'' ?>" disabled=true></label>
    </div>
  </div>
  <div class="control-group">
        <label class="controls control">报修人<span style="color:red">*</span></label>
        <select class="" name="repair_user_type" id="test" required>
            <option value='1'>租户</option>
            <option value='2'>内部报修</option>
        </select>
  </div>
<!--这里是隐藏显示1-->
<div id="content1">
  <div class="control-group" style="margin-left:20px">
    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
    <div class="controls control">
      <label>&nbsp;&nbsp;姓&nbsp;名<span style="color:red">*</span><input type="text" name='name' class='del' maxlength="40" placeholder="请输入租户名40字以内" required="required"></label>
    </div>
  </div>

<!--这里是隐藏显示1结束--></div>

<!--这里是隐藏显示2-->
<div id="content2" style="display:none">
	<div class="control-group" style="margin-left:110px;">
			<label class="control-label">部门<span class="required">*</span></label>
			<div class="controls" style="margin-left:-60px;">
					<input type="hidden" name="department_id" id="department_id" class="span4 select2" style="width:230px">
			</div>
	</div>
	<div class="control-group" style="margin-left:110px;">
			<label class="control-label">姓名<span class="required">*</span></label>
			<div class="controls" style="margin-left:-60px;">
					<input type="hidden" name="urs_user_id" id="urs_user_id" class="span4 select2" style="width:230px">
			</div>
	</div>
<!--这里是隐藏显示2结束--></div>
<script type="text/javascript">
    $("#test").change(function(){
          if($(this).val()==1){
              $("input[name=name]").attr('required','required');
              $("#content1").show();
              $("#content2").hide();
          }
          if($(this).val()==2){
                $("input[name=name]").removeAttr('required');
                $("#content2").show();
                $("#content1").hide();
          }
    })
</script>
<div class="control-group">
	<!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
	<div class="controls control" style="margin-left:60px;">
		<label>&nbsp;&nbsp;电&nbsp;话<span style="color:red">*</span><input type="text" name='phone' maxlength="11" placeholder="请输入纯数字"  required onblur="check_phone(this.value,this);"></label>
	</div>
</div>
  <div class="control-group" style="margin-left:120px;">
      <label class="control-label">品牌<span class="required">*</span></label>
      <div class="controls" style="margin-left:-60px;">
          <input type="hidden" name="estate_id" id="estate_id" class="span4 select2" style="width:230px">
      </div>
  </div>
  <div class="control-group" style="margin-left:120px;">
      <label class="control-label">系列<span class="required">*</span></label>
      <div class="controls" style="margin-left:-60px;">
          <input type="hidden" name="building_id" id="building_id" class="span4 select2" style="width:230px">
      </div>
  </div>
  <div class="control-group" style="margin-left:120px;">
      <label class="control-label">编号<span class="required">*</span></label>
      <div class="controls" style="margin-left:-60px;">
          <input type="hidden" name="room_number" id="room_number" class="span4 select2" style="width:230px">
          <input type="hidden" name="property_id[]" id="property_id">
      </div>
  </div>
  <div class="control-group">
    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
    <div class="controls control" style="margin-left:75px">
      <label>类&nbsp;&nbsp;型<span style="color:red">*</span><select name='repair_type' id='repair' required="required">
								<option value=''>请选择</option>
						<?php
									$type = SerAfterSales::model()->arr();
							  	foreach ($type['repair_type'] as $key => $value) {
							?>
								<option value="<?php echo $key?>"><?php echo $value ?></option>
						<?php
							}?>
			</select>
    </div>
  </div>
  <div class="control-group">
    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
    <div class="controls control" style="margin-left:75px">
      <label>报修隐患<span style="color:red">*</span><textarea name='hidden' maxlength='255' style="height:50px;width:200px" required></textarea></label>
    </div>
  </div>
  <div class="control-group">
    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
    <div class="controls control" style="margin-left:75px">
      <label>隐患详情:<textarea name="hidden_infor" maxlength='255' style="height:100px;width:400px"></textarea>
    </div>
  </div>
	<div class="control-group">
    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
    <div class="controls control">
			费用承担方：
				<label class="radio">
						<input type="radio" name="bear_type" value="1"   />
						车主
				</label>
				<label class="radio">
						<input type="radio" name="bear_type" value="2"   />
						幼狮
				</label>
				<label class="radio">
						<input type="radio" name="bear_type" value="3"   />
						前租户
				</label>
				<label class="radio">
						<input type="radio" name="bear_type" value="4"   />
						租户
				</label>
    </div>
  </div>
   <div class="control-group" style="clear:both;margin-bottom:30px;">
    <!-- <label class="control-label" style="margin-left:-20px;width:100px;"></label> -->
    <div class="controls control">

      <!-- 上传隐患图片开始 -->

                    <div class="controls">
                        <span>
                            <input type="hidden" name="hidden_photo" />
                            <span id="PlaceHolder_hidden_photo">aa</span>
                        </span>
                      <span>
                          <input type="button" class="btn red" value="编辑图片" style="margin-top:-20px;height:32px!important;">
                      </span>
                    </div>

                    <div class="controls">
                        <div class="upload_progress">
                            <span class="localname"></span>
                        </div>
                        <div class="fieldset flash" id="fsUploadProgress_hidden_photo">
                            <span class="legend"></span>
                        </div>
                        <div id="hidden_photo_div" style="float:left;100%;height:200px;display: none;">
                            <img name="hidden_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                        </div>
                    </div>

<!-- 上传隐患图片结束 -->

    </div>
    <div class="control-group" style="clear:both;">
     <div class="controls control" style="margin-top:30px;">

                      <button id="sample_editable_2" class="btn btn-primary" type="submit" onclick="return x()" id="button1">
                      确认派单
                      </button>
                       <button id="sample_editable_3" class="btn btn-primary" type="submit"   onclick='solve_one();' >
                      客服已解决
                      </button>
											<button id="sample_editable_4" class="btn btn-primary" type="submit"   onclick='solve_two();' >
										  客服未解决
										 </button>
                       <button id="quxiao" class="btn"  type="button">
                      取消
                      </button>

    </div>
  </div>
    </div>
  </form>
</div>


<!-- 引入图片上传所需的JS -->
<style>
    .theFont{font-size: 20px;}
</style>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<script>
// 上传隐患图片
var swf_hidden_photo;
// window.onload = function() {
    var settings_hidden_photo = {
        flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
        upload_url: "/upload/avatar", //pdf
        file_post_name:"filename",
        post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
        file_size_limit : "2 MB",
        file_types : "*.jpg;*.jpeg;*.png",
        file_types_description : "图片文件",
        file_upload_limit : 0,
        file_queue_limit : 0,
        custom_settings : {
            progressTarget : "fsUploadProgress_hidden_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_hidden_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">上传隐患图片</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 10,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_hidden_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_hidden_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_hidden_photo = new SWFUpload(settings_hidden_photo);

// };
function uploadSuccess_hidden_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;

//        document.getElementsByName("hidden_photo_show")[0].src=file_url;
    var oo = document.getElementsByName("hidden_photo_show")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("src",file_url);
    $("#hidden_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
    document.getElementsByName("hidden_photo")[0].value=document.getElementsByName("hidden_photo")[0].value+','+file_url;
    $("#hidden_photo_div").show();
}

function fileQueued_hidden_photo(file){

    var stats = swf_hidden_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}

</script>
<!-- 图片删除 -->
<script>
    $(function(){
        $('.red').on('click',function(){
            $(this).parent().parent().next().find('.del_photo').show();
            $('.del_photo').click(function(){
                var del_photo_url = $(this).prev().children().attr('src');
                var dataStr = $(this).parent().parent().prev().find("input[type='hidden']").val();
                var dataStrArr=dataStr.split(",");
                var newarr =[] ;
                for (var i = dataStrArr.length - 1; i >= 0; i--) {
                   if(dataStrArr[i]!=del_photo_url&&dataStrArr[i]!=''){
                        newarr.push(dataStrArr[i]);
                   }
                }
                var str = newarr.join(',');
                str=str.substr(0,str.length);
                console.log(str)
                $(this).parent().parent().prev().find("input[type='hidden']").val(','+str);
                $(this).prev().remove();
                $(this).remove();
            })
        })
    })
</script>


<!-- 新增保修单 -->
<script language="javascript" type="text/javascript">
  //选中元素
  $('.fow').click(function(){
    var property_id=$(this).attr('id');
    document.getElementById("property_id").value=property_id;
    // $("#property_id").value="aa";
    if(document.getElementById("follow").style.display != "block")
    {
      document.getElementById("follow").style.display = "block";
    }
    else
    {
      document.getElementById("follow").style.display = "none";
    }
    $("#quxiao").click(function(){
      $("#follow").css('display','none');
    })
  });
		function solve_one(){
			$("input[name=solve]").val(0);
			// var b= $("#repair").val();
		  // if(b=="")
		  // {
		  //  alert("类型选项不能为空");
		  //  return false;
		  // }
			// document.forms.form_add.action="/admin/seraftersales/create";
			// document.forms.form_add.submit();
		}
		function solve_two(){
			$("input[name=solve]").val(2);
      $("input[name=name]").attr("required","required");
			// var b= $("#repair").val();
			// if(b=="")
			// {
			//  alert("类型选项不能为空");
			//  return false;
			// }
			// document.forms.form_add.action="/admin/seraftersales/create";
			// document.forms.form_add.submit();
		}

</script>
<!-- 选择跳转 -->
<script type="text/javascript">
		$("#repair").change(function(){
			var val = $(this).val();
			if (val == 4){
						var anwser = confirm("是否要跳转到北京市企业信用信息网?");
						if(anwser){
							window.open("http://211.94.187.236/");
						}
			}
		})
$(".delete").click(function(){
		var id =	$(this).attr('address');
		$(".add").attr('href',id);
})
</script>
<!-- 判断类型选项 -->
<script language=javascript>
function x()
{
 var b= $("#repair").val();
 if(b=="")
 {
  alert("类型选项不能为空");
  return false;
 }
}
</script>
<!-- 日期 -->
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
     var picker = new Pikaday({
         field: document.getElementById('datepicker2'),
         firstDay: 1,
         minDate: new Date('2010-01-01'),
         maxDate: new Date('2030-12-31'),
         yearRange: [2000,2030]
     });

     var picker = new Pikaday({
         field: document.getElementById('datepicker3'),
         firstDay: 1,
         minDate: new Date('2010-01-01'),
         maxDate: new Date('2030-12-31'),
         yearRange: [2000,2030]
     });
//
     	$(function(){
         $("#highsearch").click(function(){
             var aa = $("input[name=search]").val();
         console.log(aa);
             $("#content").toggle();
             if(aa == 1 || aa == ''){
                 $("input[name=search]").val(2);
             }else{
                 $("input[name=search]").val(1);
             }
         })

       })
 </script>
<script>
$(function(){
  $("#closemodel2").click(function(){
    $("#follow").hide();
  });
})
</script>
<!-- <script type="text/javascript">
    $(function() {
      $("#follow").draggable();

    })
</script> -->
