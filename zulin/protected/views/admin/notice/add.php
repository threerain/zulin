<style>
	.portlet-title{background:font-size:22px;background:url(/css/admin/image/changetext.png) no-repeat center left #167ac7!important;
	background-position:10px 6px!important;padding-left:40px!important;}
	.portlet-body{border:1px solid #167ac7!important;border-top-width:0!important;}
	.form-actions{background:#fff;border:0;}
	.controls{margin-top:7px;}
	#btn{color:#fff;background:#167ac7;margin-left:-90px;}
	.control-group{margin-top:12px;margin-bottom:-5px;}
	input,textarea{border:1px solid #aaa!important;}
	#sdf{margin-left:-70px!important;margin-right:10px;background:#167ac7;}
	#sdf:hover{background:#0160cb!important;}
	.btn{height:34px;width:76px;font-size:16px;}
	#reset{color:#167ac7;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-district.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    ");
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

                                <div class="caption"><i class="icon-reorder"></i>公告-新增</div>

                                <div class="tools">

                                </div>

                            </div>

                            <div class="portlet-body form">

                                <!-- BEGIN FORM-->
                                <form action="/admin/notice/addsave" id="form_sample_2"  method="post"  class="form-horizontal js-submit">
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">标题<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="title" type="text" class="span6 m-wrap"/>
                                            
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">类型<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="type" id="">
                                                <option value="1">公司公告</option>
                                                <option value="2">业务公告</option>
                                                <option value="3">温馨提示</option>
                                            </select>
                                        </div>
                                    </div>                                    

                                    <div class="control-group">
                                        <label class="control-label">内容<span class="required">*</span></label>
                                        <div class="controls">
                                                                                <!-- 加载编辑器的容器 -->
                                        <script id="container"  name="content" type="text/plain"></script>
                                        <!-- 配置文件 -->

                                        <script type="text/javascript" src="/css/editor/ueditor.config.js"></script>
                                        <!-- 编辑器源码文件 -->
                                        <script type="text/javascript" src="/css/editor/ueditor.all.min.js"></script>
                                        <!-- 实例化编辑器 -->
                                        <script type="text/javascript">
                                        var ue = UE.getEditor('container', {
                                        toolbars: [
                                            [
                                                'undo', //撤销
                                                'redo', //重做
                                                'bold', //加粗
                                                'indent', //首行缩进
                                                'snapscreen', //截图
                                                'italic', //斜体
                                                'underline', //下划线
                                                'strikethrough', //删除线
                                                'blockquote', //引用
                                                'pasteplain', //纯文本粘贴模式
                                                'print', //打印
                                                'preview', //预览
                                                'horizontal', //分隔线
                                                'time', //时间
                                                'date', //日期
                                                'inserttitle', //插入标题
                                                'fontfamily', //字体
                                                'fontsize', //字号
                                                'paragraph', //段落格式
                                                ],
                                                [
                                                'simpleupload', //单图上传
                                                'insertimage', //多图上传
                                                'emotion', //表情
                                                'spechars', //特殊字符
                                                'searchreplace', //查询替换
                                                'map', //Baidu地图
                                                'help', //帮助
                                                'justifyleft', //居左对齐
                                                'justifyright', //居右对齐
                                                'justifycenter', //居中对齐
                                                'justifyjustify', //两端对齐
                                                'forecolor', //字体颜色
                                                'backcolor', //背景色
                                                'directionalityltr', //从左向右输入
                                                'imagenone', //默认
                                                'imagecenter', //居中
                                                'lineheight', //行间距
                                                'customstyle', //自定义标题
                                                'autotypeset', //自动排版
                                                'template', //模板
                                                'inserttable', //插入表格
                                                'charts', // 图表
                                            ]
                                        ]
                                        });
                                        </script>
                                        </div>
                                    </div>
                                    
                                      
                                    <div class="form-actions">
                                        <button id='sdf' type="submit" class="btn green submit js-btnadd">保存</button>
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