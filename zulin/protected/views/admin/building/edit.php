<style>
	input{border:1px solid #aaa!important;height:20px!important;}
	select,textarea{border:1px solid #aaa!important;}
	.control-group{margin-left:50px;}
	.control-label{margin-top:8px;font-weight:bold;}
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
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END); 
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-building.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-building.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();");
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

                                <div class="caption"><i class="icon-reorder"></i>系列-编辑</div>

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
                                <form action="/admin/building/editsave" id="form_edit"  method="post"  class="form-horizontal js-submit">
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
                                    <div class="control-group">
										<label class="control-label">品牌<span class="required">*</span></label>
										<div class="controls">   
											<!-- <input type="text" class="span6" disabled="" placeholder="<?php //echo $model==null?"":$model->estate_id;?>" class="m-wrap medium"> -->
                                            <input type="hidden" name="estate_id" id="estate_id" class="span3 select2" value="<?php echo $model==null?"":$model->estate_id;?>" 
                                            title="<?php $item=BaseEstate::model()->find("id='$model->estate_id'"); echo $item?$item->name:"";  ?>"/>
										</div>
									</div>
                                     <div class="control-group">
                                        <label class="control-label">系列名<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="name" type="text" maxlength="20" class="span3 m-wrap" value="<?php echo $model==null?"":$model->name;?>"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">产品类型<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="room_type" required class="span3 m-wrap">
                                                <option value="">请选择</option>
                                                <option value="1" <?php echo $model->room_type==1?"selected":""?> >轿车</option>
                                                <option value="2" <?php echo $model->room_type==2?"selected":""?> >客车</option>
                                                <option value="3" <?php echo $model->room_type==3?"selected":""?> >SUV</option>
                                                <option value="4" <?php echo $model->room_type==4?"selected":""?> >商务</option>
                                                <option value="5" <?php echo $model->room_type==5?"selected":""?> >商务</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">项目属性</label>
                                        <div class="controls">
                                            <select name="type"  class="span3 m-wrap">
                                                <option value="">请选择</option>
                                                <option value="1" <?php echo $model->type==1?"selected":""; ?>>A1</option>
                                                <option value="2" <?php echo $model->type==2?"selected":""; ?>>A2</option>
                                                <option value="3" <?php echo $model->type==3?"selected":""; ?>>A3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <?php  foreach(explode("或",$model->room_number_rule) as $key=>$value){?>
                                    <div class="control-group">
                                        <label class="control-label">编号规则<span class="required">*</span></label>
                                        <div class="controls">
                                        <input name="room_number_rule[]" maxlength="15" class="span3 m-wrap" required placeholder="只能是A或0或-，A:表示字母,0:表示数字" value="<?php echo $model==null?"":$value;?>" onkeyup="value=value.replace(/[^\A-\Z0\-]/g,'')" type="text"/>
                                        <?php if($key==0){?>
                                            <input name="" type="button" class="span1 m-wrap add_rule" style="width:60px;" value="添加"/>
                                        <?php }else{ ?>
                                            <input name="" type="button" class="span1 m-wrap del_rule" style="width:60px;" value="删除"/>
                                        <?php }?>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="rule_box"></div>
                                    <script>
                                        $(".add_rule").click(function(){
                                            var html = $("#all_rule").clone();
                                            html.removeAttr('id');
                                            html.show();
                                            $(".rule_box").append(html)
                                            $(".del_rule").click(function(){
                                                $(this).parent().parent().remove();
                                            })
                                        })
                                        $(".del_rule").click(function(){
                                           $(this).parent().parent().remove();
                                        })
                                    </script>
                                    <!-- <div class="control-group">
                                        <label class="control-label">重复密码</label>
                                        <div class="controls">
                                            <input name="r_password" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div> -->
                                   
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary submit js-btnadd">保存</button>
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
<div class="control-group" id="all_rule" style="display:none">
    <label class="control-label">编号规则<span class="required">*</span></label>
    <div class="controls">
        <input name="room_number_rule[]" maxlength="15" required type="text" placeholder="只能是A或0或-，A:表示字母,0:表示数字" onkeyup="value=value.replace(/[^\A-\Z0\-]/g,'')" class="span3 m-wrap"/>
        <input name="" type="button" class="span1 m-wrap del_rule" style="width:60px;" value="删除"/>
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