<style>
	input{border:1px solid #aaa!important;height:20px!important;}
	select,textarea{border:1px solid #aaa!important;}
	.control-group{margin-left:50px;}
</style>
  <!-- BEGIN PAGE LEVEL STYLES -->
<?php
  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
?>
  <!-- END PAGE LEVEL STYLES -->

  <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>
  <!-- END PAGE LEVEL PLUGINS -->

  <!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/base_estate.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormValidation.init();");
?>
  <!-- END PAGE LEVEL SCRIPTS -->

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

                                <div class="caption"><i class="icon-reorder"></i>品牌管理-编辑</div>

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
                                <form action="/admin/estate/editsave" id="form_edit"  method="post"  class="form-horizontal js-submit">
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
                                    <!-- <div class="control-group">
                                        <label class="control-label">商圈ID</label>
                                        <div class="controls">
                                            <select name="area_id">
                                                <?php //$aa=BaseArea::model()->findAll("deleted=0");  foreach ($aa as $key => $value) {
                                                    
                                                ?>
                                                <option value="<?php //echo $value->id?>" <?php //echo $model->area_id==$value->id?"selected":""?>><?php //echo $value->name?></option>
                                                <?php //}?>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="control-group">
                                        <label class="control-label">组团ID</label>
                                        <div class="controls">
                                            <select name="estate_group_id" class="span3 m-wrap">
                                                <?php $aa=BaseEstateGroup::model()->findAll("deleted=0");  foreach ($aa as $key => $value) {
                                                    
                                                ?>
                                                <option value="<?php echo $value->id?>" <?php echo $model->estate_group_id==$value->id?"selected":""?>><?php echo $value->name?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">品牌名称<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="name" type="text" maxlength="20" required class="span3 m-wrap" value="<?php echo $model==null?"":$model->name;?>"/>
                                        </div>
                                    </div>
<!--                                     <div class="control-group">
                                        <label class="control-label">经度</label>
                                        <div class="controls">
                                            <input name="long" type="text" class="span3 m-wrap" onblur="check(this.value,this);" value="<?php //echo $model==null?"":$model->long;?>"/>
                                            <input name="lat" type="text" class="span3 m-wrap" onblur="check(this.value,this);" value="<?php //echo $model==null?"":$model->lat;?>"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">地址</label>
                                        <div class="controls">
                                            <input name="address" type="text" class="span6 m-wrap" maxlength="50" value="<?php //echo $model==null?"":$model->address;?>"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">简介</label>
                                        <div class="controls">
                                            <textarea name="introduce" class="span6 m-wrap" rows="8"><?php //echo $model==null?"":$model->introduce;?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">均价</label>
                                        <div class="controls">
                                            <input name="average_price" type="text" onblur="check(this.value,this);" class="span6 m-wrap" value="<?php //echo $model==null?"":$model->average_price;?>"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">停车位</label>
                                        <div class="controls">
                                            <input name="parking_space" type="text" maxlength="10" class="span6 m-wrap" value="<?php //echo $model==null?"":$model->parking_space;?>"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">建筑年代</label>
                                        <div class="controls">
                                            <input name="building_age" type="text" maxlength="10" class="span6 m-wrap" value="<?php //echo $model==null?"":$model->building_age;?>"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">物业费</label>
                                        <div class="controls">
                                            <input name="property_fee" type="text" maxlength="10" class="span6 m-wrap" value="<?php //echo $model==null?"":$model->property_fee;?>"/>
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