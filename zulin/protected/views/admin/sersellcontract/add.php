<style>
	.dataTables_filter{padding-left:10px;margin-top:40px!important;}
	label{display:inline;}
	div>b{font-size:19px;margin-left:30px;font-weight:bold;}
	b{font-weight:normal;}
	.form-horizontal .control-group {
	    margin-bottom: 0px;
	}
	.control-group {
	    padding-bottom: 0px;
	    margin-right:120px
	}
	.control-label{
		width:110px!important;
		text-align:right
	}
	.controls{
		padding-left:35px
	}
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
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/service.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/ser_pur_contract.js',CClientScript::POS_END);

  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/service.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
    ");
?>
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
      
        <div class="page-content">

            <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

            <div id="portlet-config" class="modal hide">

                <div class="modal-header">

                    <button data-dismiss="modal" class="close" type="button"></button>

                    <h3>portlet Settings</h3>

                </div>

                <div class="modal-body">

                    <p>Here will be a configuration form</p>

                </div>

            </div>

            <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

            <!-- BEGIN PAGE CONTAINER-->

            <div class="container-fluid">

                <!-- BEGIN PAGE HEADER-->   

                <div class="row-fluid" style="min-height:10px;"></div>

                <!-- END PAGE HEADER-->



                <!-- BEGIN PAGE CONTENT-->

                <div class="row-fluid">

                    <div class="span12">

                        <!-- BEGIN VALIDATION STATES-->

                        <div class="portlet box blue">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder"></i>客服交房-新增</div>

                                    <div class="tools">
                                    </div>
                            </div>

                        </div>
			                         <form action="/admin/sersellcontract/addsave"  id="form_add"  method="post"  class="form-horizontal js-submit">
                        <div class="portlet-body form" style="overflow:hidden;">
                                <!-- BEGIN FORM-->
			                    <div class="alert alert-error hide">
	                                <button class="close" data-dismiss="alert"></button>
	                                输入格式有误，请检查输入的数据.
	                            </div>
	                            <div class="alert alert-success hide">
	                                <button class="close" data-dismiss="alert"></button>
	                                数据输入验证成功!
	                                
	                            </div>
	                            <input type="hidden" value="<?php echo $model['id'] ?>" name="id">
	                        	<div class="span8" style="margin-top:20px;margin-bottom:0px;"><b>基本信息</b></div>
	                            <div class="span8" >
	                            	<div class="control-group" style="float:left;">
	                            	    <label class="control-label" >客服外勤人员：</label>
	                            	    <div class="controls" style="padding-left:35px">
	                            	    	<input type="text" disabled="true" value="<?php echo AdminUser::model()->find("id='{$_SESSION['admin_uid']}' and deleted=0")['nickname']  ?>">
	                            	    </div>
	                            	</div> 
	                            	<div class="control-group" style="float:left;">
	                            	    <label class="control-label" style="">实际交房日期<span class="" style="color:red">*</span>：</label>
	                            	    <div class="controls" style="padding-left:35px">
	                            	    	<input type="text" id="actual_date" value="" name="actual_date" required>
	                            	    </div>
	                            	</div>
	                                <script type="text/javascript">
	                                	var picker = new Pikaday({
	                                	  field: document.getElementById('actual_date'),
	                                	  firstDay: 1,
	                                	  minDate: new Date('2010-01-01'),
	                                	  maxDate: new Date('2030-12-31'),
	                                	  yearRange: [2000,2030]
	                                	});
	                                </script>
	                            	<div style="clear:both"></div>
	                               	<?php foreach ($data as $key => $value) { ?>
        	                            <div class="control-group" style="float:left;margin-bottom: 0px;height:53px" >
        	                                <label class="control-label" >品牌<span class="" style="color:red">*</span>：</label>
        	                                <div class="controls">
        	                                    <input type="text" disabled="true" value="<?php echo $value['estate_id']  ?>">
        	                                </div>
    	                               </div>
        	                            <div class="control-group"  style="float:left;margin-bottom: 0px;height:53px">
        	                                <label class="control-label">系列<span class="" style="color:red">*</span>：</label>
        	                                <div class="controls">
        	                                    <input type="text" disabled="true" value="<?php echo $value['building_id']  ?>">
        	                                </div>
        	                            </div>
	    	                            <div class="control-group" style="float:left;margin-bottom: 0px;margin-right:0px;height:53px"  id="qwe">
	    	                                <label class="control-label">编号<span class="" style="color:red">*</span>：</label>
	    	                                 <div class="controls">
	    	                                    <input type="text" disabled="true" value="<?php echo $value['house_no']  ?>">
	    	                                 </div>
	    	                            </div>
	                                <?php } ?>
									<div style="clear:both"></div>
									<div class="control-group" style="height:40px">
									    <label class="control-label">交房到场人员<span class="" style="color:red">*</span>：</label>
									    <div class="controls">
									        <label class="radio">
									            <input type="radio" name="information_type" value ="1"   onclick="tab1()" checked="checked" >
									            租户本人
									        </label>
									        <label class="radio">
									           <input type="radio" name="information_type" value ="2"  onclick="tab2()" >
									            代理人
									        </label>
									    </div>
									</div>

								 	<!-- <div class="control-group" style="float:left;margin-right: 0px;">
								 	    <label class="control-label" >租户本人：</label>
								 	    <div class="controls" >
								 	    	<input type="radio" name="information_type" value ="1"  style="margin:0" onclick="tab1()" checked="checked" >
								 	    </div>
								 	</div>
								 	<div class="control-group" style="float:left;">
								 	    <label class="control-label" >代理人：</label>
								 	    <div class="controls" >
								 	    	<input type="radio" name="information_type" value ="2" style="margin:0" onclick="tab2()" >
								 	    </div>
								 	</div> -->
				         
	                         		
									<div style="clear:both"></div>
	  								<div class="" id="zuhu">
	  									<div class="control-group" style="float:left;">
	  									    <label class="control-label" >租户姓名<span class="" style="color:red">*</span>：</label>
	  									    <div class="controls" >
	  									    	<input type="text" name="tenant" required>
	  									    </div>
	  									</div>
	  									<div class="control-group" style="float:left;">
	  									    <label class="control-label" >电话1<span class="" style="color:red">*</span>：</label>
	  									    <div class="controls" >
	  									    	<input type="text" name ="tenant_phone" onblur="check_phone(this.value,this);" required>
	  									    </div>
	  									</div>
	  									<div class="control-group" style="float:left;">
	  									    <label class="control-label" >电话2：</label>
	  									    <div class="controls" >
	  									    	<input type="text" name ="tenant_phone2" onblur="check_phone(this.value,this);" >
	  									    </div>
	  									</div>
					                </div> 
									<div style="clear:both"></div>
									<div class="" id="dailiren" style="display:none;">
										<div class="control-group" style="float:left;">
										    <label class="control-label" style="width:90px">代理人类型<span class="" style="color:red">*</span>：</label>
										    <div class="controls" style="padding-left:30px">
										    	<select name="agent_type" id="agent_type">
													<option value="1">朋友</option>
													<option value="2">华亮</option> 
													<option value="3">物业公司</option> 
													<option value="4">职员</option> 
													<option value="5">亲戚</option> 
						                        </select>
										    </div>
										</div>
										<div class="control-group" style="float:left;">
										    <label class="control-label" >代理人姓名<span class="" style="color:red">*</span>：</label>
										    <div class="controls" style="padding-left:30px">
										    	<input name ="agent" type="text">
										    </div>
										</div>
										<div class="control-group" style="float:left;">
										    <label class="control-label" >电话1<span class="" style="color:red">*</span>：</label>
										    <div class="controls" >
										    	<input name="agent_phone" type="text" onblur="check_phone(this.value,this);">
										    </div>
										</div>
										<div class="control-group" style="float:left;">
										    <label class="control-label" >电话2：</label>
										    <div class="controls" >
										    	<input name="agent_phone2" type="text" onblur="check_phone(this.value,this);">
										    </div>
										</div>
									</div> 
	                        
		                            <div style="clear:both"></div>             
			                        <div class="">
		                                <div class="control-group" style="margin-top:30px;margin-left: 0px;padding-bottom: 0px;">
		                                    <div class="controls">
		                                        <span>
		                                            <input type="hidden" name="list_photo" />
		                                            <span id="PlaceHolder_list_photo"></span>
		                                        </span>
		                                        <span>
		                                             <input type="button" class="btn red" value="编辑图片" style="margin-top:-18px;height:32px!important;">
		                                        </span>
		                                    </div>
		                                </div>
		                                <div class="control-group" style="margin:0;">
		                                    <div class="controls">
		                                        <div class="upload_progress">
		                                            <span class="localname"></span>
		                                        </div>
		                                        <div class="fieldset flash" id="fsUploadProgress_list_photo">
		                                            <span class="legend"></span>
		                                        </div>
		                                        <div id="list_photo_div" style="float:left;100%;height:200px;display: none;">
		                                            <img name="list_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
		                                        </div>
		                                    </div>
		                                </div>   
		                            </div>
				                </div>  

			                    <div class="span8" style="margin-top:20px;"><b>水电费记录</b></div> 
			                    <div class="span8" > 
				                    <div class=" dellhydropower" > 
					                    <div class="control-group" style="float:left;">
					                        <label class="control-label" >类型：</label>
					                        <div class="controls">
							                        <select name="hydropower_type[]" id="" >
														<option value="">请选择类型</option>
														<option value="1" >总表</option> 
														<option value="2">分表</option> 
							                        </select>
							                      </span> 
					                        </div>
					                    </div>
					                    <div style="clear:both"></div>
					                    <div class="control-group" style="float:left;margin-right:0px">
					                        <label class="control-label">热水：</label>
					                        <div class="controls">
					                            <input type="text"  value=""  name="hot_water[]" onblur="check_next(this.value,this);">
						                        <select name="hot_unit[]" id="" style="width:120px">
													<option value="">请选择单位</option>
													<option value="1" >立方</option> 
													<option value="2">元</option> 
						                        </select>
					                        </div>
					                    </div> 
					                    <div class="control-group" style="float:left;margin-right:0px">
					                        <label class="control-label">中水：</label>
					                        <div class="controls">
					                            <input type="text"  value=""  name="middle_water[]" onblur="check_next(this.value,this);">
						                        <select name="middle_unit[]" id="" style="width:120px">
													<option value="">请选择单位</option>
													<option value="1" >立方</option> 
													<option value="2">元</option> 
						                        </select>
					                        </div>
					                    </div>
					                    <div class="control-group" style="float:left;margin-right:0px">
					                        <label class="control-label">冷水：</label>
					                        <div class="controls">
					                            <input type="text"  value=""  name="cold_water[]" onblur="check_next(this.value,this);" >
						                        <select name="cold_unit[]" id="" style="width:120px">
													<option value="">请选择单位</option>
													<option value="1" >立方</option> 
													<option value="2">元</option> 
						                        </select>
					                        </div>
					                    </div> 
					                    <div class="control-group" style="float:left;margin-right:0px">
					                        <label class="control-label">表底数/电费余额：</label>
					                        <div class="controls">
					                            <input type="text"  value=""  name="electricity_fees[]" onblur="check_next(this.value,this);">
					                            <select name="electricity_unit[]" id="" style="width:120px">
													<option value="">请选择单位</option>
													<option value="1" >度</option> 
													<option value="2">元</option> 
						                        </select>
					                        </div>
					                    </div>
					                    <div class="control-group" style="float:left;margin-right:0px">
					                        <label class="control-label" style="width:80px">燃气表：</label>
					                        <div class="controls">
					                            <input type="text"  value=""  name="gas_meter[]" onblur="check_next(this.value,this);"> 
						                        <select name="gas_unit[]" id="" style="width:120px">
													<option value="">请选择单位</option>
													<option value="1" >立方</option> 
													<option value="2">元</option> 
						                        </select>
					                        </div>
					                    </div>
					                    <div class="control-group" style="float:left;">
					                        <label class="control-label"></label>
					                        <div class="controls">
					                            <button class="btn red addser_hydropower" type="button" style="margin-top:-7px;">添加</button>
								                      <button class="btn red delser_hydropower" type="button" style="margin-top:-7px;">删除 </button> 
					                        </div>
					                    </div>
					                    <div style="clear:both"></div>
							     	</div>
						     	
				                    <div style="clear:both"></div>
				                    <div class="control-group" style="float:left;">
				                        <label class="control-label" style="width:80px">支付方式：</label>
				                        <div class="controls">
				                           <input type="text"  value=""  name="pay_method" > 
				                        </div>
				                    </div> 
				                    <div class="control-group" style="float:left;">
				                        <label class="control-label" style="width:80px">实际收款：</label>
				                        <div class="controls">
				                           <input type="text"  value=""  name="actual_payment" onblur="check(this.value,this);">元
				                        </div>
				                    </div>
						    	</div>
				                <script type="text/javascript">
				                	//添加
				                	$(".addser_hydropower").click(function(){
				                		mores =$("#ser_hydropower").clone();
				                		mores.show();
				                		mores.addClass('moreser_hydropower');
				                		mores.removeAttr('id');
				                		mores.css("float",'none');
				                		$('.dellhydropower').after(mores);
				                	})
				                	//删除
				                	$(".delser_hydropower").click(function(){
				                		var delmore = $('.moreser_hydropower');
				                		$('.moreser_hydropower').eq(delmore.length-1).remove();
				                	})
				                </script>
				        
	<!-- /////////////////////////////////////////////////// -->

	                            <div class="span8" style="margin-top:20px;margin-bottom:0px;"><b>特殊费用</b></div>     
	                     
	                           	<div class="span8 dellspecial" >
	       		                    <div class="control-group" style="float:left;">
	       		                        <label class="control-label" >编号：</label>
	       		                        <div class="controls">
       				                        <select name="house_no[]" class="house_no">
       				                        	<?php foreach ($data as $key => $value){ ?>
       				                        		<option value="<?php echo $value['property_id'] ?>"><?php echo $value['house_no'] ?></option>
       				                        	<?php } ?>
						                    </select>
	       		                        </div>
	       		                    </div>
									<div class="control-group" style="float:left;">
	       		                        <label class="control-label" >类型：</label>
	       		                        <div class="controls">
	       				                       <select name="type[]" id="">
													<option value="1">费用预留</option> 
													<option value="2">费用缴纳</option> 
						                        </select>
	       		                        </div>
	       		                    </div>
	       		                    <div class="control-group" style="float:left;">
	       		                        <label class="control-label">费用金额：</label>
	       		                        <div class="controls">
	       				                    <input type="text"  value=""  name="amount[]" onblur="check(this.value,this);">元
	       		                        </div>
	       		                    </div>
	       		                    <div style="clear:both"></div>
	       		                    <div class="control-group" style="float:left;">
	       		                        <label class="control-label" style="width:80px">费用详情：</label>
	       		                        <div class="controls">
	       		                        	<textarea   value="" name="details[]" class="span6 m-wrap" style="resize: none;width:300px" ></textarea>
	       		                        </div>
	       		                    </div>
	       		                    <div class="control-group" style="float:left;">
	       		                        <label class="control-label" style="width:80px"></label>
	       		                        <div class="controls">
	       				                    <button class="btn red addser_special_cost" type="button" style="margin-top:-7px;">添加 </button>
	       				                    <button class="btn red delser_special_cost" type="button" style="margin-top:-7px;">删除 </button>
	       		                        </div>
	       		                    </div>
				                </div>
				      
								<script type="text/javascript">
									//添加
									$(".addser_special_cost").click(function(){
										mores =$("#addspecial").clone();
										mores.show();
										mores.addClass('morespecial');
										mores.removeAttr('id');
										mores.css("float",'none');
										$('.dellspecial').after(mores);
									})
									//删除
									$(".delser_special_cost").click(function(){
										var delmore = $('.morespecial');
										$('.morespecial').eq(delmore.length-1).remove();
									})
								</script>
				         
	                           
	                            <div class="span8" style="margin-top:20px;"><b>隐患记录</b></div> 
	                                <!-- 添加开始 -->
	                                
		                        <div class = "span8  hiddens" >
		   		                    <div class="control-group" style="float:left;">
		   		                        <label class="control-label" >编号：</label>
		   		                        <div class="controls">
		   				                    <select name="house_no_hidden[]" class="house_no">
		   				                    	<?php foreach ($data as $key => $value){ ?>
		   				                    		<option value="<?php echo $value['property_id'] ?>"><?php echo $value['house_no'] ?></option>
		   				                    	<?php } ?>
					                        </select>
		   		                        </div>
		   		                    </div>
		   		                    <div class="control-group" style="float:left;">
		   		                        <label class="control-label" >维修方：</label>
		   		                        <div class="controls">
		   				                    <select name="service_type[]" id="">
						                        <option value="2">幼狮</option> 
						                        <option value="1">车主</option>
						                        <option value="3">租户</option> 
					                        </select>
		   		                        </div>
		   		                    </div>
				                    <div class="control-group" style="float:left;">
				                        <label class="control-label" >费用承担方：</label>
					                        <div class="controls" >
							                    <select name="bear_type[]" id="">
							                      <option value="2">幼狮</option> 
							                      <option value="1">车主</option>
							                      <option value="3">前租户</option> 
							                      <option value="4">租户</option> 
							                    </select>
				                        	</div>
				                    </div>
		   		                    <div class="control-group" style="float:left">
		   		                        <label class="control-label" >客服外勤人员：</label>
		   		                        <div class="controls">
		   		                        	<input type="text" disabled="true" value="<?php echo AdminUser::model()->find("id='{$_SESSION['admin_uid']}' and deleted=0")['nickname']  ?>">
		   		                        </div>
		   		                    </div>
		   		                    <div class="control-group" style="float:left">
		   		                        <label class="control-label" >报修隐患：</label>
		   		                        <div class="controls" >
		   		                        	<input type="text"  value=""  name="hidden[]">
		   		                        </div>
		   		                    </div>
		   		                    <div class="control-group" style="float:left">
		   		                        <label class="control-label" >隐患预计花费：</label>
		   		                        <div class="controls" >
		   		                        	<input type="text"  value=""  name="hidden_cost[]" onblur="check(this.value);">
		   		                        </div>
		   		                    </div>
		   		                    <div class="control-group" style="float:left">
		   		                        <label class="control-label" >隐患详情：</label>
		   		                        <div class="controls" >
		   		                        	<textarea   value="" name="hidden_infor[]" class="span6 m-wrap" style="resize: none;width:300px" ></textarea>
		   		                        </div>
		   		                    </div>
		   		                    <div class="control-group" style="float:left">
		   		                        <label class="control-label"></label>
		   		                        <div class="controls" >
		   		                        	<button class="btn red addhiddens" type="button" style="margin-top:-7px;">添加</button>
		   		                        	<button class="btn red delhidden" type="button" style="margin-top:-7px;">删除 </button>
		   		                        </div>
		   		                    </div>
		   		                    <div style="clear:both"></div>
		   		                    <!-- 图片开始 -->
		   		                    <div class="control-group">
		   		                    	<label class="control-label"></label>
		   		                        <div class="controls" style="">
		   		                            <span style="float:left;">
		   		                                <input type="hidden" name="property_photo[]" />
		   		                                <span id="PlaceHolder_property_photo"></span>
		   		                            </span>
		   		                            <span style="margin:60px">
		   		                               <input type="button" class="btn red" value="编辑图片" style="height:32px!important;">
		   		                          </span>
		   		                        </div>
		   		                    </div>
		   		                    <div class="control-group" >
		   		                    	<label class="control-label"></label>
		   		                        <div class="controls">
		   		                            <div class="upload_progress">
		   		                                <span class="localname"></span>
		   		                            </div>
		   		                            <div class="fieldset flash" id="fsUploadProgress_property_photo">
		   		                                <span class="legend"></span>
		   		                            </div>
		   		                            <div id="property_photo_div" style="float:left;100%;height:200px;display: none;">
		   		                                <img name="property_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
		   		                            </div>
		   		                        </div>
		   		                    </div>
		   		                     <!-- 图片结束 -->   
		                        </div><br>	
										
	                           <!-- 添加结束 -->
	                            <div class="span8" id="contenttab1">
	                            	<div class="control-group" style="float:left">
	                            	    <label class="control-label">车主电话1：</label>
	                            	    <div class="controls" >
	                            	    	<input type="text"  value=""  name="hidden_phone" onblur="check_phone(this.value,this);">
	                            	    </div>
	                            	</div>
	                            	<div class="control-group" style="float:left">
	                            	    <label class="control-label" >车主电话2：</label>
	                            	    <div class="controls" >
	                            	    	<input type="text"  value=""  name="hidden_phone2" onblur="check_phone(this.value,this);">
	                            	    </div>
	                            	</div>
	                            	<div class="control-group" style="float:left">
	                            	    <label class="control-label" >约定维修结束日期：</label>
	                            	    <div class="controls">
	                            	    	<input type="text" id="hope_end_time" value="" name="hope_end_time" /><span style="color:red">(维修方为幼狮时不填写)</span>
	                            	    </div>
	                            	</div>
					            </div>  
				

	                            <script type="text/javascript">
	                                	var picker = new Pikaday({
	                                	  field: document.getElementById('hope_end_time'),
	                                	  firstDay: 1,
	                                	  minDate: new Date('2010-01-01'),
	                                	  maxDate: new Date('2030-12-31'),
	                                	  yearRange: [2000,2030]
	                                	});
	                            </script>   
	                               
			                
					            <script type="text/javascript">
										
										//删除
										$(".delhidden").click(function(){
											var delmore = $('.morehidden');
											$('.morehidden').eq(delmore.length-1).remove();
										})
							    </script>
					            <div class="span8" style="text-align:center;margin-bottom:20px;margin-top:10px;">
				                    	<button  type="submit" class="btn btn-primary submit js-btnadd ">保存</button>
	                                    <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>

	                                 </div>
	                            </div>
                        </div>
                      </form>
                    </div>
                    </div>
                    </div>
                    </div>
             
<style>
    .theFont{font-size: 20px;}
</style>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<script>
// 上传收房清单图片
var swf_list_photo;
// window.onload = function() {
    var settings_list_photo = {
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
            progressTarget : "fsUploadProgress_list_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_list_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">上传交房清单</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 5,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_list_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_list_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_list_photo = new SWFUpload(settings_list_photo);
                            
// };
function uploadSuccess_list_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;

//        document.getElementsByName("list_photo_show")[0].src=file_url;
    var oo = document.getElementsByName("list_photo_show")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("src",file_url);
    $("#list_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
    document.getElementsByName("list_photo")[0].value=document.getElementsByName("list_photo")[0].value+','+file_url;
    $("#list_photo_div").show();
}

function fileQueued_list_photo(file){

    var stats = swf_list_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}

</script>





				            <!-- ///////// -->
				            <div class="span8" id = "addspecial" style="display:none">	                     
       		                    <div class="control-group" style="float:left;">
       		                        <label class="control-label" >编号：</label>
       		                        <div class="controls">
       				                    <select name="house_no[]" class="house_no">
       				                    	<?php foreach ($data as $key => $value){ ?>
       				                    		<option value="<?php echo $value['property_id'] ?>"><?php echo $value['house_no'] ?></option>
       				                    	<?php } ?>
					                    </select>
       		                        </div>
       		                    </div>
								<div class="control-group" style="float:left;">
       		                        <label class="control-label" >类型：</label>
       		                        <div class="controls">
	                                    <select name="type[]" id="">
	            							<option value="1">费用预留</option> 
	            							<option value="2">费用缴纳</option> 
	                                    </select>
       		                        </div>
       		                    </div>
       		                    <div class="control-group" style="float:left;">
       		                        <label class="control-label">费用金额：</label>
       		                        <div class="controls">
       				                    <input type="text"  value=""  name="amount[]" onblur="check(this.value,this);">元
       		                        </div>
       		                    </div>
       		                    <div style="clear:both"></div>
       		                    <div class="control-group" style="float:left;">
       		                        <label class="control-label" >费用详情：</label>
       		                        <div class="controls">
       		                        	<textarea   value="" name="details[]" class="span6 m-wrap" style="resize: none;width:300px" ></textarea>
       		                        </div>
       		                    </div>
       		                    <div style="clear:both"></div>
			                </div>
			                <!-- ///////////// -->
			                <div id="addroom" style="display:none">
                               <!-- <div class="dataTables_filter" style="margin-top:30px;margin-left:-10px">                      -->
				                    <div class="control-group" style="float:left;margin-bottom: 0px;height:53px" >
				                        <label class="control-label" >品牌<span class="" style="color:red">*</span>：</label>
				                        <div class="controls">
				                             <input type="text"  disabled="true" class="estates"   >
				                        </div>
				                   </div>
				                    <div class="control-group"  style="float:left;margin-bottom: 0px;height:53px">
				                        <label class="control-label">系列<span class="" style="color:red">*</span>：</label>
				                        <div class="controls">
				                            <input type="text" disabled="true"  class="buildings"   >
				                        </div>
				                    </div>
					                <div class="control-group" style="float:left;margin-bottom: 0px;margin-right:0px;height:53px"  id="qwe">
					                    <label class="control-label">编号<span class="" style="color:red">*</span>：</label>
					                     <div class="controls">
					                        <input type="text"  disabled="true" class="rooms"   >
					                     </div>
					                </div>
               	                 
                                <!-- </div>     -->
                            </div>
							<!--///////////  -->
	                        <div id = "hidden" style="display:none">
	   		                    <div class="control-group" style="float:left;">
	   		                        <label class="control-label" >编号：</label>
	   		                        <div class="controls">
	   				                    <select name="house_no_hidden[]" class="house_no">
	   				                    	<?php foreach ($data as $key => $value){ ?>
	   				                    		<option value="<?php echo $value['property_id'] ?>"><?php echo $value['house_no'] ?></option>
	   				                    	<?php } ?>
				                        </select>
	   		                        </div>
	   		                    </div>
	   		                    <div class="control-group" style="float:left;">
	   		                        <label class="control-label" >维修方：</label>
	   		                        <div class="controls">
	   				                    <select name="service_type[]" id="">
	                                        <option value="2">幼狮</option> 
	                                        <option value="1">车主</option>
	                                        <option value="3">租户</option> 
	                                    </select>
	   		                        </div>
	   		                    </div>
			                    <div class="control-group" style="float:left;">
			                        <label class="control-label" >费用承担方：</label>
				                        <div class="controls" >
						                    <select name="bear_type[]" id="">
                                              <option value="2">幼狮</option> 
                                              <option value="1">车主</option>
                                              <option value="3">前租户</option> 
                                              <option value="4">租户</option> 
                                            </select>
			                        	</div>
			                    </div>
	   		                    <div class="control-group" style="float:left">
	   		                        <label class="control-label">客服外勤人员：</label>
	   		                        <div class="controls" >
	   		                        	<input type="text" disabled="true" value="<?php echo AdminUser::model()->find("id='{$_SESSION['admin_uid']}' and deleted=0")['nickname']  ?>">
	   		                        </div>
	   		                    </div>
	   		                    <div class="control-group" style="float:left">
	   		                        <label class="control-label">报修隐患：</label>
	   		                        <div class="controls" >
	   		                        	<input type="text"  value=""  name="hidden[]">
	   		                        </div>
	   		                    </div>
	   		                    <div class="control-group" style="float:left">
	   		                        <label class="control-label" >隐患预计花费：</label>
	   		                        <div class="controls">
	   		                        	<input type="text"  value=""  name="hidden_cost[]" onblur="check(this.value,this);">
	   		                        </div>
	   		                    </div>
	   		                    <div class="control-group" style="float:left">
	   		                        <label class="control-label" >隐患详情：</label>
	   		                        <div class="controls">
	   		                        	<textarea   value="" name="hidden_infor[]" class="span6 m-wrap" style="resize: none;width:300px" ></textarea>
	   		                        </div>
	   		                    </div>
	   		                    <div style="clear:both"></div>
	   		                    <!-- 图片开始 -->
	   		                    <div class="control-group">
                                    <div class="controls" style="margin-top:20px;">
                                        <span style="float:left;">
                                            <input type="hidden" name="property_photo[]" />
                                            <span id="PlaceHolder_property_photo"></span>
                                        </span>
                                        <span style="margin:60px">
		                                     <input type="button" class="btn red" value="编辑图片" style="height:32px!important;">
		                                </span>
                                    </div>
                                </div>
                                <div class="control-group" style="margin:0;">
                                    <div class="controls">
                                        <div class="upload_progress">
                                            <span class="localname"></span>
                                        </div>
                                        <div class="fieldset flash" id="fsUploadProgress_property_photo">
                                            <span class="legend"></span>
                                        </div>
                                        <div id="property_photo_div" style="float:left;100%;height:200px;display: none;">
                                            <img name="property_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                        </div>
                                    </div>
                                </div>
	   		                     <!-- 图片结束 --> 
	                             
	                        </div>
                            <!--  -->
                            <div class=" " id="ser_hydropower" style="display:none">
			                    <div class="control-group" style="float:left;">
			                        <label class="control-label" >类型：</label>
			                        <div class="controls">
					                       <select name="hydropower_type[]" id=""  >
                                               <option value="">请选择类型</option>
                                               <option value="1" >总表</option> 
                                               <option value="2">分表</option> 
                                           </select>
					                      </span> 
			                        </div>
			                    </div>
			                    <div style="clear:both"></div>
			                    <div class="control-group" style="float:left;margin-right:0px">
			                        <label class="control-label">热水：</label>
			                        <div class="controls">
			                            <input type="text"  value=""  name="hot_water[]" onblur="check_next(this.value,this);">
                                        <select name="hot_unit[]" id="" style="width:120px">
                                            <option value="">请选择单位</option>
                                            <option value="1" >立方</option> 
                                            <option value="2">元</option> 
                                        </select>
			                        </div>
			                    </div> 
			                    <div class="control-group" style="float:left;margin-right:0px">
			                        <label class="control-label">中水：</label>
			                        <div class="controls">
			                            <input type="text"  value=""  name="middle_water[]" onblur="check_next(this.value,this);">
                                        <select name="middle_unit[]" id="" style="width:120px">
                                            <option value="">请选择单位</option>
                                            <option value="1" >立方</option> 
                                            <option value="2">元</option> 
                                        </select>
			                        </div>
			                    </div>
			                    <div class="control-group" style="float:left;margin-right:0px">
			                        <label class="control-label">冷水：</label>
			                        <div class="controls">
			                            <input type="text"  value=""  name="cold_water[]" onblur="check_next(this.value,this);">
                                        <select name="cold_unit[]" id="" style="width:120px">
                                            <option value="">请选择单位</option>
                                            <option value="1" >立方</option> 
                                            <option value="2">元</option> 
                                        </select>
			                        </div>
			                    </div> 
			                    <div class="control-group" style="float:left;margin-right:0px">
			                        <label class="control-label">表底数/电费余额：</label>
			                        <div class="controls">
			                            <input type="text"  value=""  name="electricity_fees[]" onblur="check_next(this.value,this);">
                                        <select name="electricity_unit[]" id="" style="width:120px">
                                            <option value="">请选择单位</option>
                                            <option value="1" >度</option> 
                                            <option value="2">元</option> 
                                        </select>
			                        </div>
			                    </div>
			                    <div class="control-group" style="float:left;margin-right:0px">
			                        <label class="control-label" style="width:80px">燃气表：</label>
			                        <div class="controls">
			                            <input type="text"  value=""  name="gas_meter[]" onblur="check_next(this.value,this);">
	                                    <select name="gas_unit[]" id="" style="width:120px">
	                                        <option value="">请选择单位</option>
	                                        <option value="1" >立方</option> 
	                                        <option value="2">元</option> 
	                                    </select>
			                        </div>
			                    </div>
			                    <div style="clear:both"></div>
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
<script>
      function tab1(){
          $("#zuhu").css("display","block")
          $("#dailiren").css("display","none")
          $("input[name=tenant]").attr("required",true);
          $("input[name=tenant_phone]").attr("required",true);
          $("#agent_type").removeAttr("required",false);
          $("input[name=agent]").removeAttr("required",false);
          $("input[name=agent_phone]").removeAttr("required",false);
      }
        function tab2(){
            $("#zuhu").css("display","none")
            $("#dailiren").css("display","block")
            $("#agent_type").attr("required",true);
            $("input[name=agent]").attr("required",true);
            $("input[name=agent_phone]").attr("required",true);
            $("input[name=tenant]").removeAttr("required");
            $("input[name=tenant_phone]").removeAttr("required");
        }


</script>
<!-- 隐患图片开始 -->
                                    <script>
                                    // 添加多个类型
                                    var nummore =$('.morehidden');
                                    $(".addhiddens").live("click",function(e){
                                    mores =$("#hidden").clone();
                                    mores.show();
                                    mores.addClass('morehidden');
                                    mores.removeAttr('id');
                                    mores.css("float",'none');
                                    $('.hiddens').append(mores);
                                   
                                    nummore =$('.morehidden');
                                    mores.find("#PlaceHolder_property_photo").attr('id','PlaceHolder_property_photo'+nummore.length);
                                    mores.find("#fsUploadProgress_property_photo").attr('id','fsUploadProgress_property_photo'+nummore.length);
                                    mores.find("#property_photo_div").attr('id','property_photo_div'+nummore.length);
                                    //mores.find(".property_photo_show").attr('class','property_photo_show'+nummore.length);
                                    // $('#propertys').append(mores);
                                    //添加图片
                                      //console.log(mores);
                                        var swf_property_photo;
                                        //alert('swf_property_photo'+nummore.length);
                                        // window.onload = function() {
                                            var settings_property_photo = {
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
                                                    progressTarget : 'fsUploadProgress_property_photo'+nummore.length,
                                                    cancelButtonId : "btnCancel"
                                                },
                                                debug: false,
                                    // Button settings
                                                button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
                                                button_width: "200",
                                                button_height: "30",
                                                button_placeholder_id: 'PlaceHolder_property_photo'+nummore.length,
                                                button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
                                                button_disabled : false,

                                                button_text: '<span class="theFont">上传隐患图片</span>',
                                                button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
                                                button_text_left_padding: 6,
                                                button_text_top_padding: 6,
                                    // The event handler functions are defined in handlers.js
                                                file_queued_handler : fileQueued_property_photo,
                                                file_queue_error_handler : fileQueueError,
                                                file_dialog_complete_handler : fileDialogComplete,
                                                upload_start_handler : uploadStart,
                                                upload_progress_handler : uploadProgress,
                                                upload_error_handler : uploadError,
                                                upload_success_handler : uploadSuccess_property_photo,
                                                upload_complete_handler : uploadComplete,
                                                queue_complete_handler : queueComplete  // Queue plugin event
                                            };
                                     // alert(nummore.length);
                                            swf_property_photo = new SWFUpload(settings_property_photo);
                                                                    
                                        // };
                                        function uploadSuccess_property_photo(fileObj, server_data){
                                            $(".progressWrapper").hide();
                                            var json=JSON.parse(server_data);
                                            if (json.code==0)
                                            {
                                                alert(json.message);
                                                return;
                                            }
                                            var file_name=json.data.file_name;
                                            var file_url=json.data.file_url;
                                    // alert(nummore.length);
                                    //        document.getElementsByName("property_photo_show")[0].src=file_url;
                                            var oo = document.getElementsByName("property_photo_show")[0];
                                            var new_img = $(oo).clone();
                                            $(new_img).show();
                                            $(new_img).attr("src",file_url);
                                            $('#property_photo_div'+nummore.length).append(new_img);
                                             $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
                                            document.getElementsByName("property_photo[]")[nummore.length].value=document.getElementsByName("property_photo[]")[nummore.length].value+','+file_url;
                                            $('#property_photo_div'+nummore.length).show();

                                        }

                                        function fileQueued_property_photo(file){

                                            var stats = swf_property_photo.getStats();
                                            stats.successful_uploads--;
                                            this.setStats(stats);
                                    // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
                                        }

                                        //alert(nummore.length);

                                    });   

                                    // //添加图片
                                        var swf_property_photo;

                                        window.onload = function() {
                                            var settings_property_photo = {
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
                                                    progressTarget : "fsUploadProgress_property_photo",
                                                    cancelButtonId : "btnCancel"
                                                },
                                                debug: false,
                                    // Button settings
                                                button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
                                                button_width: "200",
                                                button_height: "30",
                                                button_placeholder_id: "PlaceHolder_property_photo",
                                                button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
                                                button_disabled : false,

                                                button_text: '<span class="theFont">上传隐患图片</span>',
                                                button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
                                                button_text_left_padding: 6,
                                                button_text_top_padding: 6,

                                    // The event handler functions are defined in handlers.js
                                                file_queued_handler : fileQueued_property_photo,
                                                file_queue_error_handler : fileQueueError,
                                                file_dialog_complete_handler : fileDialogComplete,
                                                upload_start_handler : uploadStart,
                                                upload_progress_handler : uploadProgress,
                                                upload_error_handler : uploadError,
                                                upload_success_handler : uploadSuccess_property_photo,
                                                upload_complete_handler : uploadComplete,
                                                queue_complete_handler : queueComplete  // Queue plugin event
                                            };

                                            swf_property_photo = new SWFUpload(settings_property_photo);
                                                                    
                                        };
                                        function uploadSuccess_property_photo(fileObj, server_data){
                                            $(".progressWrapper").hide();
                                            var json=JSON.parse(server_data);
                                            if (json.code==0)
                                            {
                                                alert(json.message);
                                                return;
                                            }
                                            var file_name=json.data.file_name;
                                            var file_url=json.data.file_url;

                                    //        document.getElementsByName("property_photo_show")[0].src=file_url;
                                            var oo = document.getElementsByName("property_photo_show")[0];
                                            var new_img = $(oo).clone();
                                            $(new_img).show();
                                            $(new_img).attr("src",file_url);
                                            $("#property_photo_div").append(new_img);
                                             $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
                                            document.getElementsByName("property_photo[]")[0].value=document.getElementsByName("property_photo[]")[0].value+','+file_url;
                                            $("#property_photo_div").show();
                                        }

                                        function fileQueued_property_photo(file){

                                            var stats = swf_property_photo.getStats();
                                            stats.successful_uploads--;
                                            this.setStats(stats);
                                    // document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
                                        }

                                    </script>

<!-- 隐患图片结束 -->
<!-- 图片删除 -->
<script>
    $(function(){
        $('.red').live('click',function(){

            $(this).parent().parent().parent().next().find('.del_photo').toggle();
            $('.del_photo').click(function(){
                var del_photo_url = $(this).prev().children().attr('src');
                var dataStr = $(this).parent().parent().parent().prev().find("input[type='hidden']").val();
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
                $(this).parent().parent().parent().prev().find("input[type='hidden']").val(','+str);
                $(this).prev().remove();
                $(this).remove();
            })
        })
    })
</script>
