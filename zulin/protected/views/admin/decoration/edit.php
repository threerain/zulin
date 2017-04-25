<style>	
	.modal-body{font-size:18px;text-indent: 20px;}
	#modal-label{text-align:center;font-size:22px;}
	#about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
	#left{background:#167bcd;color:#fff;margin-right:10px;}
	#left:hover{background:#0160cb!important;}
	#table input{border:0 none!important;color:#222;font-weight:bold;text-align:center;}
  #table{margin-left:-70px;}
  #table,#testtr{overflow:auto!important;}
   #table .yj-title-th th input{width:150px!important;}
    #table .testtd td input{width:150px!important;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/quality_decoration.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/quality_decoration.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
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
            <div class="caption"><i class="icon-reorder"></i><?php if($model->status!=2){echo '装修管理-编辑';}else{echo '装修管理-添加预算信息';}?></div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">            	
                <div style="margin-left:40px;margin-bottom:500px;">
                  <form  action="/admin/decoration/EditSave" style="margin:0;height:120px;margin-top:30px;" id="form_add"  method="post"  class="form-horizontal js-submit">
                    <div class="alert alert-error hide">
                      <button class="close" data-dismiss="alert"></button>
                      输入格式有误，请检查输入的数据.
                    </div>
                    <div class="alert alert-success hide">
                      <button class="close" data-dismiss="alert"></button>
                      数据输入验证成功!
                    </div>
                    <input type="hidden" name="id" value="<?php echo $model->id; ?>">
                    <div class="dataTables_filter" style="margin-bottom:20px;">
                      <span style="margin-left:52px;">
                       录入人：<?php $item=AdminUser::model()->find("id='$model->creater_id'"); echo $item?$item->nickname:"无";?>
                      </span>                                                               
                    </div>
                    <?php foreach ($allinfo as $key => $value): ?>
                    <div class="dataTables_filter" style="margin-bottom:20px;margin-left:65px;clear:both;">
                        <div style="float:left;">
                          品牌：<?php echo $value['estate_name'] ;?>
                        </div>
                        <div style="margin-left:30px;float:left;">
                          系列：<?php echo $value['building_name']  ?>
                        </div>
                        <div style="margin-left:30px;float:left;">
                          编号：<?php echo $value['house_no'] ?>
                        </div> 
                        <div style="clear:both;"></div> 
                    </div> 
                    <?php endforeach ?> 
                    <div  class="dataTables_filter" style="margin-bottom:20px;margin-left:28px;">
                      建筑总面积：<?php echo $sum_area['sum_area'].'㎡'; ?>
                    </div>
                  <?php //if($model->status!=2):?>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span style="margin-left:38px;">
                        工程工长：<input type="text" maxlength="5" value="<?php echo $model->foreman;?>" name="foreman" class="m-wrap">
                      </span>
                      <span>
                        工程管理部人员：<input type="text" value="<?php echo $model==null?"":$model->supervisor;?>"  name="supervisor" id="supervisor" class="select2" style="width:220px">
                      </span>
                      <span>
                        施工管理部人员：<input type="text"  value="<?php echo $model==null?"":$model->docking_people;?>" id="docking_people" name="docking_people" class="select2" style="width:220px">
                      </span>                                          
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span style="line-height:33px;">整体工程起止日:<input type="text" id="datepicker" value="<?php echo $model->project_start_time?date('Y-m-d',$model->project_start_time):""?>" name="project_start_time" class="m-wrap"/>&nbsp;至&nbsp;<input type="text" id="datepicker1" value="<?php echo $model->project_end_time?date('Y-m-d',$model->project_end_time):""?>" name="project_end_time" class="m-wrap"/></span>  
	                      <span style="line-height:33px;">施工管理部与工程对接方案日期：<input type="text" id="datepicker2" value="<?php echo $model->docking_date?date('Y-m-d',$model->docking_date):""?>" name="docking_date" class="m-wrap"/></span>                                         
                    </div>
                    <!-- 上传附件 -->
                    <div class="dataTables_filter" style="clear:both;">
                      <div class="control-group">
                        <div class="controls">
                          <span style="float:left;">
                              <input type="hidden" name="attachment_photo" value="<?php $a =  ','.implode(',',$attachment_photo);echo $attachment_photo?$a:'' ?>" />
                              <span id="PlaceHolder_attachment_photo"></span>
                          </span>
                          <span>
                            <input type="button" class="btn red" value="删除附件" style="height:30px!important;">
                          </span>
                        </div>
                      </div>
                      <div class="control-group" style="margin:0;">
                        <div class="controls">
                            <div class="upload_progress">
                                <span class="localname"></span>
                            </div>
                            <div class="fieldset flash" id="fsUploadProgress_attachment_photo">
                                <span class="legend"></span>
                            </div>
                            <div id="attachment_photo_div" style="float:left;height:130px;<?php echo $attachment==null?'display: none':''; ?>">
                              <input type="text" name="attachment_photo_show[]" src="" style='display:none;float:left;margin-left:10px'/>
                                <?php if ($attachment): ?>
                                  <?php foreach ($attachment as $key => $value): ?>
                                <span><input type="text" name="attachment_photo_show[]" value="<?php echo $value;?>" src="<?php echo $attachment_photo[$key] ?>" style='float:left;margin-left:10px';/></span>
                                <img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                                    <?php  endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!--上传附件结束 -->
                    <!-- 上传CAD图片 -->
                    <div class="control-group" style="margin-top:30px" style="clear:both;"> 
                      <div class="controls">
                        <span style="float:left;">
                            <input type="hidden" name="list_photo" value="<?php $a =  ','.implode(',',$list_photo);echo $list_photo?$a:'' ?>"/>
                            <span id="PlaceHolder_list_photo"></span>
                        </span>
                        <!-- <span><input type="button" class="btn red" value="下载"></span> -->
                        <span style="float:left;">
                          <input type="button" class="btn red" value="编辑图片" style="height:32px!important;">
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
                        <div id="list_photo_div" style="float:left;height:130px;<?php echo $list_photo==null?'display: none':''; ?>">
                          <img name="list_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                          <?php if ($list_photo): ?>
                          <?php foreach ($list_photo as $key => $value): ?>
                            <a target="_Blank" href="<?php echo $value ?>"><img name="list_photo_show" src="<?php echo $value ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a>
                            <img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                          <?php  endforeach ?>
                          <?php endif ?>
                        </div>
                      </div>
                    </div>
                    <!-- 上传CAD图片结束 -->
   
                    <div class="btn-group pull-left">  
                      <h4>价格预算</h4>
                    </div> 
                    <!-- 上传价格预算扫描件 -->
                    <div class="dataTables_filter" style="clear:both;">
                      <div class="control-group">
                        <div class="controls">
                          <span style="float:left;">
                              <input type="hidden" name="budget_photo" value="<?php $a =  ','.implode(',',$budget_photo);echo $list_photo?$a:'' ?>"/>
                              <span id="PlaceHolder_budget_photo"></span>
                          </span>
                          <span>
                            <input type="button" class="btn red" value="编辑图片" style="height:30px!important;">
                          </span>
                        </div>
                      </div>
                      <div class="control-group" style="margin:0;">
                        <div class="controls">
                            <div class="upload_progress">
                              <span class="localname"></span>
                            </div>
                            <div class="fieldset flash" id="fsUploadProgress_budget_photo">
                              <span class="legend"></span>
                            </div>
                            <div id="budget_photo_div" style="float:left;;height:130px;<?php echo $budget_photo==null?'display: none':''; ?>">
                              <img name="budget_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'>
                              <?php if ($budget_photo): ?>
                              <?php foreach ($budget_photo as $key => $value): ?> 
                                <a target="_Blank" href="<?php echo $value ?>"><img name="budget_photo_show" src="<?php echo $value ?>" style='max-width:100px;max-height:120px;float:left;margin-left:10px'/></a>
                                <img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                              <?php  endforeach ?>
                              <?php endif ?>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- 上传价格预算扫描件 -->
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>注明：若工期延期，按照延期天数，视情节轻重给予工长500--1000元/天处罚。若装修材料规格及品牌未按照公司规定标准与上述报表不符有弄虚作行为，则视情节轻重给予工长5000--50000元处罚，并承担因工程施工质量及材料质量问题所造成的一切后续安全责任。若工长在工程装修报价时漏项，则按照漏项部分总金额的50%给予工长处罚，若情况特别严重者，将给予总工程款的50%给予处罚。（如有特殊情况需幼狮装饰总经理签字，方可降低处罚或避免处罚。）</span>
                    </div> 
                    <div class="span8">
  	                  <div class="btn-group pull-right">	
  	                    <button id="add" class="btn btn-primary" type="button" style="float:right">
  	                        新增<i class="icon-plus"></i>
  	                    </button>
  	                  </div> 
                      <table class="table table-striped table-bordered table-hover" id="table"><!-- ID sample_1目前没用,js中控制显示效果 -->
             			<thead>
			                <tr class="yj-title-th">
        			            <th><input type="text" value="序号"></th>
								<th><input type="text" value="施工清单及材料"></th>
								<th><input type="text" value="单位"></th>
								<th><input type="text" value="材料规格及品牌"></th>
								<th><input type="text" value="数量"></th>
								<th><input type="text" value="单价"></th>
								<th><input type="text" value="预算合计"></th>
			                </tr>
             			</thead>
                        <?php
                            if($quality_budget){
                        ?>
                        <tbody id="testtr"> 
                        <?php 
                          $count=1;
                          foreach ($quality_budget as $key => $value){
                        ?>                  
		                	<tr class="testtd">
			                 	<td><input type="text"  class="xuhao" value="<?php echo $count;?>"></td>
			                 	<td><input type="text" maxlength="127" name="list_material[]" value="<?php echo $value->list_material;?>"></td>
			                 	<td><input type="text" maxlength="25" name="unit[]" value="<?php echo $value->unit;?>"></td>
			                 	<td><input type="text" maxlength="127" name="material_brands[]" value="<?php echo $value->material_brands;?>"></td>
			                 	<td><input type="text" maxlength="7" onblur="check(this.value,this);" name="number[]" value="<?php echo $value->number?$value->number/100:"";?>"></td>
			                 	<td><input type="text" maxlength="7" onblur="check(this.value,this);" name="unit_price[]" value="<?php echo $value->unit_price?$value->unit_price/100:"";?>"></td>
			                 	<td><input type="text" maxlength="7" onblur="check(this.value,this);" name="total[]" value="<?php echo $value->total?$value->total/100:"";?>"></td>
			               </tr>
                        <?php
                            $count++;
                          }
                        ?>
                        <input type="hidden" value="<?php echo $count-1?>" name="the_count"/> 
                        <script>
                            $(function(){
                              var i=$("input[name='the_count']").val();
                              $("#add").click(function(){
                                i++;
                                $("#testtr").append($('.testtd').eq(0).clone()).find('tr').last().find('input').val('');
                                $(".xuhao").last().val(i);
                              })
                            })
                        </script>
                        </tbody>
                        <?php }else{?>
                            <tbody id="testtr">
                                <input type="hidden" name="status" value="2">                   
                                <tr class="testtd">
                                    <td><input type="text"  class="xuhao" value="1"></td>
                                    <td><input type="text" maxlength="127" name="list_material[]"></td>
                                    <td><input type="text" maxlength="25" name="unit[]"></td>
                                    <td><input type="text" maxlength="127" name="material_brands[]"></td>
                                    <td><input type="text" maxlength="7" onblur="check(this.value,this);" name="number[]"></td>
                                    <td><input type="text" maxlength="7" onblur="check(this.value,this);" name="unit_price[]"></td>
                                    <td><input type="text" maxlength="7" onblur="check(this.value,this);" name="total[]"></td>
                               </tr>
                           </tbody>
                            <script>
                            $(function(){
                              var i=1;
                              $("#add").click(function(){
                                i++;
                                $("#testtr").append($('.testtd').eq(0).clone()).find('tr').last().find('input').val('');
                                $(".xuhao").last().val(i);
                              })
                            })
                            </script>
                        <?php }?>
                	  </table>
                    </div>
                    <?php 
                      if($quality_settlement || $settlement_photo):
                    ?>
                      <div class="btn-group pull-left">  
                        <h4>价格结算</h4>
                      </div> 
                      <!-- 上传价格结算扫描件 -->
                      <div class="control-group" style="clear:both;">
                        <div class="controls" style="margin-top:20px;">
                          <span style="float:left;">
                              <input type="hidden" name="settlement_photo" value="<?php $a =  ','.implode(',',$budget_photo);echo $list_photo?$a:'' ?>" />
                              <span id="PlaceHolder_settlement_photo"></span>
                          </span>
                          <span>
                            <input type="button" class="btn red" value="编辑图片" style="height:30px!important;">
                          </span>
                        </div>
                      </div>
                      <div class="control-group" style="margin:0;">
                        <div class="controls">
                            <div class="upload_progress">
                                <span class="localname"></span>
                            </div>
                            <div class="fieldset flash" id="fsUploadProgress_settlement_photo">
                                <span class="legend"></span>
                            </div>
                            <div id="settlement_photo_div" style="float:left;100%;height:130px;<?php echo $settlement_photo==null?'display: none':''; ?>">
                                <img name="settlement_photo_show" src="" style='display:none;max-width:100px;max-height:120px;float:left;margin-left:10px'/>
                                <?php if ($settlement_photo): ?>
                                  <?php foreach ($settlement_photo as $key => $value): ?>   
                                    <a target="_Blank" href="<?php echo $value ?>"><img name="settlement_photo_show" src="<?php echo $value ?>" style='max-width:100px;max-height:120px;float:left;margin-left:10px'/></a>
                                    <img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                                  <?php  endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                      </div>
                      <!-- 上传价格结算扫描件 -->
                      <div class="span8">
                        <div class="btn-group pull-right">  
                          <button id="add2" class="btn btn-primary" type="button" style="float:right">
                              新增<i class="icon-plus"></i>
                          </button>
                        </div> 
                        <table class="table table-striped table-bordered table-hover" id="table"><!-- ID sample_1目前没用,js中控制显示效果 -->
                          <thead >
                            <tr class="yj-title-th">
                              <th><input type="text" value="序号"></th>
                              <th><input type="text" value="施工清单及材料"></th>
                              <th><input type="text" value="单位"></th>
                              <th><input type="text" value="材料规格及品牌"></th>
                              <th><input type="text" value="数量"></th>
                              <th><input type="text" value="单价"></th>
                              <th><input type="text" value="预算合计"></th>
                            </tr>
                          </thead>
                          <tbody id="testtr2">
                          <?php 
                            $count=1;
                            foreach ($quality_settlement as $key => $value){
                          ?>
                            <tr class="testtd2">
                              <td><input type="text"  class="xuhao2" value="<?php echo $count;?>"></td>
                              <td><input type="text" maxlength="127" name="set_list_material[]" value="<?php echo $value->list_material;?>"></td>
                              <td><input type="text" maxlength="25" name="set_unit[]" value="<?php echo $value->unit;?>"></td>
                              <td><input type="text" maxlength="127" name="set_material_brands[]" value="<?php echo $value->material_brands;?>"></td>
                              <td><input type="text" maxlength="7" onblur="check(this.value,this);" name="set_number[]" value="<?php echo $value->number?$value->number/100:"";?>"></td>
                              <td><input type="text" maxlength="7" onblur="check(this.value,this);" name="set_unit_price[]" value="<?php echo $value->unit_price?$value->unit_price/100:"";?>"></td>
                              <td><input type="text" maxlength="7" onblur="check(this.value,this);" name="set_total[]" value="<?php echo $value->total?$value->total/100:"";?>"></td>
                           </tr>
                          <?php
                              $count++;
                            }
                          ?>
                          </tbody>
                          <input type="hidden" value="<?php echo $count-1?>" name="the_number"/> 
                        </table>
                      </div>
                    <?php //endif ?>
                  <?php endif ?>
                    <div class="form-actions" style="clear:both;margin-top:100px;text-align:center;">
                      <button type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                      <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                    </div> 
                  </form> 
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
                     <a id="left" class="btn btn-primary" href="" onclick="javascript:return true;">确定</a>
                     <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
                </div>
            </div>
        </div>
</div>      
<script>
$(".delete").click(function(){
    var id =  $(this).attr('address');
    //点击确定时传值到控制器
    $("#left").attr('href',id);
})
</script>
<!-- 隐藏的品牌系列编号 -->
<div style="display:none;clear:both;" class="select">
  <div class="dataTables_filter" style="margin-bottom:20px;">
    <span>
      品牌：<input type="hidden" name="estate_id[]" id="estate_id" class="select2" style="width:230px">
    </span>
    <span>
      系列：<input type="hidden" name="building_id[]" id="building_id" class="select2" style="width:230px">
    </span>
    <span>
      编号：<input type="hidden" name="room_number[]" id="room_number" class="select2" style="width:230px">
            <input type="hidden" name="property_id[]" id="property_id">
    </span>                                          
  </div>
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
<script>
  //日期
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
</script>

<!-- 图片 -->
<style>
    .theFont{font-size: 20px;}
</style>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<script>
var swf_list_photo;
var swf_budget_photo;
var swf_attachment_photo;
window.onload = function() {
    // 上传上传CAD图
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

        button_text: '<span class="theFont">添加CAD图</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 10,
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
    // 上传上传预算扫描件
    var settings_budget_photo = {
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
            progressTarget : "fsUploadProgress_budget_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_budget_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">添加扫描件</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 10,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_budget_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_budget_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_budget_photo = new SWFUpload(settings_budget_photo);

    //上传附件
    var settings_attachment_photo = {
        flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
        upload_url: "/upload/avatar", //pdf
        file_post_name:"filename",
        post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
        file_size_limit : "2 MB",
        file_types : "*.dwg",
        file_types_description : "图片文件",
        file_upload_limit : 0,
        file_queue_limit : 0,
        custom_settings : {
            progressTarget : "fsUploadProgress_attachment_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_attachment_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">上传附件</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 10,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_attachment_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_attachment_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_attachment_photo = new SWFUpload(settings_attachment_photo);
                            
};
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

function uploadSuccess_budget_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;

//        document.getElementsByName("budget_photo_show")[0].src=file_url;
    var oo = document.getElementsByName("budget_photo_show")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("src",file_url);
    $("#budget_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
    document.getElementsByName("budget_photo")[0].value=document.getElementsByName("budget_photo")[0].value+','+file_url;
    $("#budget_photo_div").show();
}

function fileQueued_budget_photo(file){

    var stats = swf_budget_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}
//上传附件
function uploadSuccess_attachment_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var old_file_name=json.data.old_file_name;
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;
    var oo = document.getElementsByName("attachment_photo_show[]")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("value",old_file_name);
    $("#attachment_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');
    document.getElementsByName("attachment_photo")[0].value=document.getElementsByName("attachment_photo")[0].value+','+file_url;
    $("#attachment_photo_div").show();
}

function fileQueued_attachment_photo(file){

    var stats = swf_attachment_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}
</script>
<!-- 图片删除 -->
<script>
    $(function(){
        $('.red').live('click',function(){
            $(this).parent().parent().parent().next().find('.del_photo').show();
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
                $(this).parent().parent().parent().prev().find("input[type='hidden']").val(','+str);
                $(this).prev().remove();
                $(this).remove();
            })
        })
    })
</script>    
<script>
  var m=$("input[name='the_number']").val();
  $("#add2").click(function(){
    m++;
    $("#testtr2").append($('.testtd2').eq(0).clone()).find('tr').last().find('input').val('');
    $(".xuhao2").last().val(m);
  })

</script>