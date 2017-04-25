
  <!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);

    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/bootstrap-fileupload.css');
    Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/jquery.fileupload-ui.css');

?>
  <!-- END PAGE LEVEL PLUGINS -->;

  <!-- BEGIN PAGE LEVEL SCRIPTS -->;
<?php
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.ui.widget.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/tmpl.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/load-image.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/canvas-to-blob.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.iframe-transport.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.fileupload.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.fileupload-fp.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.fileupload-ui.js',CClientScript::POS_END);


  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/form-fileupload.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/base_estate.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_purchase_contract.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormFileUpload.init();
    FormValidation.init();
    ");
?>
  <!-- END PAGE LEVEL SCRIPTS -->;
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

                                <div class="caption"><i class="icon-reorder"></i>品牌管理-新增</div>

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
                                <form action="/admin/estate/createsave" id="form_create"  method="post"  class="form-horizontal js-submit">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
<!--                                     <div class="control-group">
                                        <label class="control-label">商圈ID</label>
                                        <div class="controls">
                                            <select name="area_id">
                                                <?php //$aa=BaseArea::model()->findAll("deleted=0");  foreach ($aa as $key => $value) {

                                                ?>
                                                <option value="<?php //echo $value->id?>"><?php //echo $value->name?></option>
                                                <?php //}?>
                                            </select>
                                        </div>
                                    </div> -->
                                    <!-- <div class="control-group">
                                        <label class="control-label">组团ID</label>
                                        <div class="controls">
                                            <select name="estate_group_id" class="span3 m-wrap">
                                                <?php $aa=BaseEstateGroup::model()->findAll("deleted=0");  foreach ($aa as $key => $value) {

                                                ?>
                                                <option value="<?php echo $value->id?>"><?php echo $value->name?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="control-group">
                                        <label class="control-label">品牌名称<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="name" maxlength="20" required type="text" class="span3 m-wrap"/>
                                        </div>
                                    </div>
<!--                                     <div class="control-group">
                                        <label class="control-label">经度</label>
                                        <div class="controls">
                                            <input name="long" type="text" onblur="check(this.value,this);" class="span3 m-wrap"/>
                                            <input name="lat" type="text" onblur="check(this.value,this);" class="span3 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">地址</label>
                                        <div class="controls">
                                            <input name="address" type="text" maxlength="50" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">简介</label>
                                        <div class="controls">
                                            <textarea name="introduce" class="span6 m-wrap" rows="8"></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">均价</label>
                                        <div class="controls">
                                            <input name="average_price" onblur="check(this.value,this);" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">停车位</label>
                                        <div class="controls">
                                            <input name="parking_space" type="text"  maxlength="10" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">建筑年代</label>
                                        <div class="controls">
                                            <input name="building_age" maxlength="10" type="text" class="span6 m-wrap"/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">物业费</label>
                                        <div class="controls">
                                            <input name="property_fee" type="text" maxlength="10" class="span6 m-wrap"/>
                                        </div>
                                    </div>
 -->


                                    <!-- <div class="control-group">
                                        <label class="control-label">商品图片</label>
                                        <div class="controls">
                                            <form2 id="fileupload" action="/upload/filem" method="POST" enctype="multipart/form-data">


                                                <noscript><input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"></noscript>


                                                <div class="row-fluid fileupload-buttonbar">

                                                    <div class="span7">


                                                        <span class="btn green fileinput-button">

                                                        <i class="icon-plus icon-white"></i>

                                                        <span>添加...</span>

                                                        <input type="file" name="files[]" multiple>

                                                        </span>

                                                        <button type="submit" class="btn blue start">

                                                        <i class="icon-upload icon-white"></i>

                                                        <span>上传</span>

                                                        </button>

                                                        <button type="reset" class="btn yellow cancel">

                                                        <i class="icon-ban-circle icon-white"></i>

                                                        <span>取消</span>

                                                        </button>

                                                        <button type="button" class="btn red delete">

                                                        <i class="icon-trash icon-white"></i>

                                                        <span>删除</span>

                                                        </button>

                                                        <input type="checkbox" class="toggle fileupload-toggle-checkbox">

                                                    </div>

                                                </div>

                                                <div class="fileupload-loading"></div>

                                                <br>

                                                <table role="presentation" class="table table-striped">

                                                    <tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>

                                                </table>

                                            </form2>





                                        </div>




                                        <div class="span12">

                                            <script id="template-upload" type="text/x-tmpl">

                                                {% for (var i=0, file; file=o.files[i]; i++) { %}

                                                    <tr class="template-upload fade">

                                                        <td class="preview"><span class="fade"></span></td>

                                                        <td class="name"><span>{%=file.name%}</span></td>

                                                        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>

                                                        {% if (file.error) { %}

                                                            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>

                                                        {% } else if (o.files.valid && !i) { %}

                                                            <td>

                                                                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>

                                                            </td>

                                                            <td class="start">{% if (!o.options.autoUpload) { %}

                                                                <button class="btn">

                                                                    <i class="icon-upload icon-white"></i>

                                                                    <span>上传</span>

                                                                </button>

                                                            {% } %}</td>

                                                        {% } else { %}

                                                            <td colspan="2"></td>

                                                        {% } %}

                                                        <td class="cancel">{% if (!i) { %}

                                                            <button class="btn red">

                                                                <i class="icon-ban-circle icon-white"></i>

                                                                <span>取消</span>

                                                            </button>

                                                        {% } %}</td>

                                                    </tr>

                                                {% } %}

                                            </script>


                                            <script id="template-download" type="text/x-tmpl">

                                                {% for (var i=0, file; file=o.files[i]; i++) { %}

                                                    <tr class="template-download fade">

                                                        {% if (file.error) { %}

                                                            <td></td>

                                                            <td class="name"><span>{%=file.name%}</span></td>

                                                            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>

                                                            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>

                                                        {% } else { %}

                                                            <td class="preview">

                                                            {% if (file.thumbnail_url) { %}

                                                                <a class="fancybox-button" data-rel="fancybox-button" href="{%=file.url%}" title="{%=file.name%}">

                                                                <img src="media/image/{%=file.thumbnail_url%}">

                                                                </a>

                                                            {% } %}</td>

                                                            <td class="name">

                                                                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>

                                                            </td>

                                                            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>

                                                            <td colspan="2"></td>

                                                        {% } %}

                                                        <td class="delete">

                                                            <button class="btn red" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>

                                                                <i class="icon-trash icon-white"></i>

                                                                <span>删除</span>
                                                                <input type="hidden" class="fileupload-checkbox hide" name="photos[]" value="{%=file.url%}">

                                                            </button>

                                                            <input type="checkbox" class="fileupload-checkbox hide" name="delete" value="1">

                                                        </td>

                                                    </tr>

                                                {% } %}

                                            </script>

                                        </div>


                                    </div> -->




<!--                                     <div class="control-group">
                                        <label class="control-label">维度</label>
                                        <div class="controls">
                                            <input name="name" type="text" class="span6 m-wrap"/>
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
