<style>
	.power{border:1px solid #aaa;padding:10px;width:95%;margin-bottom:10px;}
	.power h3{font-size:14px;font-weight:bold;}
	.radio{display:inline-block;}
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
  // Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/multi-select-metro.css');
  //<!-- END PAGE LEVEL STYLES -->
?>

<?php //script
  //<!-- BEGIN PAGE LEVEL PLUGINS -->
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.multi-select.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/module.js',CClientScript::POS_END);

  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();");
?>

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

                                <div class="caption"><i class="icon-reorder"></i>职务-权限</div>

                                <div class="tools">
<!--
                                    <a href="javascript:;" class="collapse"></a>

                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>

                                    <a href="javascript:;" class="reload"></a>

                                    <a href="javascript:;" class="remove"></a> -->

                                </div>

                            </div>

                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="/admin/position/modulsave" id="form_sample_3"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="id" value="<?php echo $model->id ?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="control-group" style="margin:30px 10px;">
                                        <label class="control-label"><b>职务名</b></label>
                                        <div class="controls">
                                            <label ><?php echo $model==null?"":$model->name;?></label>
                                        </div>
                                    </div>


                                    <div class="control-group" style="max-height:4000px;">

                                        <label class="control-label"><b>权限</b></label>

                                        <div class="controls">
<div class="power">
 		<input type="checkbox"  id="checkall" name="linkcheck">全选
 		<input type="checkbox"  id="deleteall" name="linkcheck">全不选
  </div>
	<div class="power">
																								 <span label="公告">
																									 <h3><input type="checkbox" name="my_multi_select[]" class="checkboxes" value="">公告管理</h3>
																										 <?php
																												 $models=AdminModul::model()->findAll(" t.type='公告'");
																												 foreach ($models as $key => $value) {

																										 ?>
																												 <input type='checkbox' name="my_multi_select2[]" class="checkboxes" value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

																										 <?php
																												 }
																										 ?>
																								 </span>
	 </div>                                  <!-- <select multiple="multiple" id="my_multi_select2" name="my_multi_select2[]"> -->
 <div class="power">

                                                <span label="基础数据">
																												<h3><input type="checkbox" name="my_multi_select[]"  class="checkboxes" value="">基础数据</h3>
                                                    <?php
                                                        $models=AdminModul::model()->findAll(" t.type='基础数据'");
                                                        foreach ($models as $key => $value) {

                                                    ?>
                                                        <label class="radio"><input type="checkbox"  name="my_multi_select2[]"  class="checkboxes" value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?> ><?php echo $value->name;?></label>

                                                    <?php
                                                        }
                                                    ?>
                                                </span>
 </div>
  <div class="power">
                                                <span label="幼狮合同">
																										<h3><input type="checkbox"  name="my_multi_select[]" class="checkboxes" value="">幼狮合同</h3>
                                                    <?php
                                                        $models=AdminModul::model()->findAll(" t.type='幼狮合同'");
                                                        foreach ($models as $key => $value) {

                                                    ?>
                                                        <input type="checkbox" name="my_multi_select2[]" class="checkboxes6" value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

                                                    <?php
                                                        }
                                                    ?>
                                                </span>
   </div>
	 <div class="power">
																								 <span label="合同查看权限">
																										<h3><input type="checkbox"  name="my_multi_select[]" class="checkboxes" value="">幼狮收房合同列表/详情查看权限</h3>
																										 <?php
																												 $models=AdminModul::model()->findAll(" t.type='收房合同查看权限'");
																												 foreach ($models as $key => $value) {

																										 ?>
																												 <input type="checkbox" name="my_multi_select2[]" class="checkboxes3" value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

																										 <?php
																												 }
																										 ?>
																								 </span>
		</div>
		<div class="power">
																									<span label="合同查看权限">
																										 <h3><input type="checkbox"  name="my_multi_select[]" class="checkboxes4" value="">幼狮出车合同列表/详情查看权限</h3>
																											<?php
																													$models=AdminModul::model()->findAll(" t.type='出车合同查看权限'");
																													foreach ($models as $key => $value) {

																											?>
																													<input type="checkbox" name="my_multi_select2[]" class="checkboxes4" value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

																											<?php
																													}
																											?>
																									</span>
		 </div>
     <div class="power">
                                                <span label="用户管理">
																										<h3><input type="checkbox" name="my_multi_select[]" class="checkboxes" value="">用户管理</h3>
                                                    <?php
                                                        $models=AdminModul::model()->findAll(" t.type='用户管理'");
                                                        foreach ($models as $key => $value) {

                                                    ?>
                                                        <input type="checkbox" name="my_multi_select2[]" class="checkboxes" value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

                                                    <?php
                                                        }
                                                    ?>
                                                </span>
   </div>
 <div class="power">
                                                <span label="销售管理">
																									<h3><input type="checkbox" name="my_multi_select[]" class="checkboxes" value="">数据管理</h3>
                                                    <?php
                                                        $models=AdminModul::model()->findAll(" t.type='数据管理'");
                                                        foreach ($models as $key => $value) {

                                                    ?>
                                                        <input  type="checkbox" name="my_multi_select2[]" class="checkboxes"  value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

                                                    <?php
                                                        }
                                                    ?>
    </div>
		<div class="power">
	                                                <span label="佣金管理">
																											<h3><input type="checkbox"  name="my_multi_select[]" class="checkboxes" value="">佣金管理</h3>
	                                                    <?php
	                                                        $models=AdminModul::model()->findAll(" t.type='佣金管理'");
	                                                        foreach ($models as $key => $value) {

	                                                    ?>
	                                                        <input type="checkbox" name="my_multi_select2[]" class="checkboxes6" value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

	                                                    <?php
	                                                        }
	                                                    ?>
	                                                </span>
	   </div>                                          </span>
   <div class="power">
																								<span label="客服管理">
																											<h3><input type="checkbox" name="my_multi_select[]" class="checkboxes" value="">资产管理部</h3>
                                                    <?php
                                                        $models=AdminModul::model()->findAll(" t.type='资产管理部'");
                                                        foreach ($models as $key => $value) {

                                                    ?>
                                                        <input type="checkbox" name="my_multi_select2[]"  class="checkboxes" value="<?php echo $value->id;?>" <?php echo  AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

                                                    <?php
                                                        }
                                                    ?>
                                                </span>
 </div>
 <div class="power">
																								<sapn label="产品质量管理">
																											<h3><input type="checkbox" name="my_multi_select[]" class="checkboxes" value="">幼狮装饰</h3>
                                                    <?php
                                                        $models=AdminModul::model()->findAll(" t.type='幼狮装饰'");
                                                        foreach ($models as $key => $value) {

                                                    ?>
                                                        <input type="checkbox" name="my_multi_select2[]"  class="checkboxes2" value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

                                                    <?php
                                                        }
                                                    ?>
                                                </span>
 </div>

   <div class="power">
                                                <span label="收购管理">
																										<h3><input type="checkbox" name="my_multi_select[]" class="checkboxes5" value="">收购管理</h3>
                                                    <?php
                                                        $models=AdminModul::model()->findAll(" t.type='收购管理'");
                                                        foreach ($models as $key => $value) {

                                                    ?>
                                                        <input type="checkbox" name="my_multi_select2[]" class="checkboxes1" value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

                                                    <?php
                                                        }
                                                    ?>
                                                </span>
  </div>
<div class="power">
                                                <span label="统计">
																									<h3><input type="checkbox" name="my_multi_select[]" class="checkboxes" value="">统计管理</h3>
                                                    <?php
                                                        $models=AdminModul::model()->findAll(" t.type='统计'");
                                                        foreach ($models as $key => $value) {

                                                    ?>
                                                        <input type="checkbox" name="my_multi_select2[]" class="checkboxes" value="<?php echo $value->id;?>" <?php echo AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>
                                                    <?php
                                                        }
                                                    ?>
                                                </span>
  </div>
  <div class="power">
																								<span label="财务管理">
																												<h3><input type="checkbox" name="my_multi_select[]" class="checkboxes" value="">财务管理</h3>
																										<?php
																												$models=AdminModul::model()->findAll(" t.type='财务管理'");
																												foreach ($models as $key => $value) {

																										?>
																												<input type="checkbox" name="my_multi_select2[]" class="checkboxes" value="<?php echo $value->id;?>" <?php echo  AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

																										<?php
																												}
																										?>
																								</span>
                                            <!-- </select> -->
</div>

<div class="power">
																							<span label="消息提醒">
																											<h3><input type="checkbox" name="my_multi_select[]" class="checkboxes" value="">消息提醒</h3>
																									<?php
																											$models=AdminModul::model()->findAll(" t.type='消息提醒'");
																											foreach ($models as $key => $value) {

																									?>
																											<input type="checkbox" name="my_multi_select2[]" class="checkboxes" value="<?php echo $value->id;?>" <?php echo  AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

																									<?php
																											}
																									?>
																							</span>
																					<!-- </select> -->
</div>
<div class="power">
                                                                                            <span label="短信提醒">
                                                                                                            <h3><input type="checkbox" name="my_multi_select[]" class="checkboxes" value="">短信提醒</h3>
                                                                                                    <?php
                                                                                                            $models=AdminModul::model()->findAll(" t.type='短信提醒'");
                                                                                                            foreach ($models as $key => $value) {

                                                                                                    ?>
                                                                                                            <input type="checkbox" name="my_multi_select2[]" class="checkboxes" value="<?php echo $value->id;?>" <?php echo  AdminPositionModul::model()->find("modul_id='$value->id' and position_id='$model->id'")?'checked':''?>><?php echo $value->name;?>

                                                                                                    <?php
                                                                                                            }
                                                                                                    ?>
                                                                                            </span>
                                                                                    <!-- </select> -->
</div>

                                        </div>

                                    </div>






                                    <div class="form-actions">
                                        <button id='sdf' type="submit" class="btn blue submit js-btnadd">保存</button>
                                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                                    </div>
                                </form>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>
                <!-- END PAGE CONTENT-->
            </div>
            <!-- END PAGE CONTAINER-->
        </div>

<style>
    .theFont{font-size: 20px;}
</style>

<!-- 不懂什么意思,县注释掉<script type="text/javascript">
var ids = [<?php echo $array_select ?>];
$('#my_multi_select2').val(ids);
$('#my_multi_select2').multiselect("refresh");
</script> -->


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
$(function() {

   $("input[name='my_multi_select[]']").live('click',function(){

		 if( $(this).parents('.power').find('input').attr('checked')) {
			 	$(this).parents('.power').find('input').attr('checked','checked');
		 }else{
			 $(this).parents('.power').find('input').attr('checked',false);

		 }
			$("#deleteall").eq(1).attr('checked',true);
				$('.checkboxes1').eq(7).attr('checked',false);

   })


$('#checkall').click(function(){
$("input[name='my_multi_select[]']").attr('checked','checked');
   	  $("input[name='my_multi_select2[]']").attr('checked','checked');
$("#deleteall").eq(1).attr('checked',true);

	$('.checkboxes1').eq(7).attr('checked',false);

	$('.checkboxes3').eq(4).attr('checked',false);
	$('.checkboxes3').eq(6).attr('checked',false);
	$(".checkboxes3").eq(7).attr('checked',false);
	$('.checkboxes4').eq(5).attr('checked',false);
	// $('.checkboxes4').eq(6).attr('checked',false);
	$(".checkboxes4").eq(7).attr('checked',false);
	// $(".checkboxes4").eq(5).attr('checked',false);
	// $(".checkboxes4").eq(6).attr('checked',false);
	// $(".checkboxes4").eq(7).attr('checked',false);
	// $(".checkboxes4").eq(8).attr('checked',false);
	$(".checkboxes5").eq(6).attr('checked',false);
$("#deleteall").attr("checked",false);


})
$(".checkboxes1").eq(5).click(function(){

	$('.checkboxes1').eq(6).attr('checked','checked');

})
	$(".checkboxes6").eq(0).click(function(){

		$('.checkboxes3').eq(5).attr('checked','checked');

	})
	$(".checkboxes6").eq(15).click(function(){

		$('.checkboxes4').eq(6).attr('checked','checked');

	})

 $(".checkboxes1").eq(1).click(function() {

	 $('.checkboxes1').eq(7).attr('checked',false);

 });
 $(".checkboxes1").eq(7).click(function() {

	 $('.checkboxes1').eq(1).attr('checked',false);

 })

$('#deleteall').click(function(){

 $("input[name='my_multi_select[]']").attr('checked',false);
   	  $("input[name='my_multi_select2[]']").attr('checked',false);
   	   $("#checkall").attr('checked',false);
})
$('.checkboxes3').eq(4).click(function() {
	$('.checkboxes3').eq(5).attr('checked',false);
	$('.checkboxes3').eq(6).attr('checked',false);

});

$('.checkboxes3').eq(5).click(function() {
	$('.checkboxes3').eq(4).attr('checked',false);
	$('.checkboxes3').eq(6).attr('checked',false);

});

$('.checkboxes3').eq(6).click(function() {
	$('.checkboxes3').eq(4).attr('checked',false);
	$('.checkboxes3').eq(5).attr('checked',false);

});
$('.checkboxes4').eq(7).click(function() {
	$('.checkboxes4').eq(5).attr('checked',false);
	$('.checkboxes4').eq(6).attr('checked',false);

});

$('.checkboxes4').eq(5).click(function() {
	$('.checkboxes4').eq(7).attr('checked',false);
	$('.checkboxes4').eq(6).attr('checked',false);

});

$('.checkboxes4').eq(6).click(function() {
	$('.checkboxes4').eq(7).attr('checked',false);
	$('.checkboxes4').eq(5).attr('checked',false);

});

   });


</script>
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
