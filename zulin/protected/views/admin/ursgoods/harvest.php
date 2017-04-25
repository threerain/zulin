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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/urs_goods.js',CClientScript::POS_END);
  //<!-- END PAGE LEVEL PLUGINS -->;

  //<!-- BEGIN PAGE LEVEL SCRIPTS -->;
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/urs_goods.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
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

                                <div class="caption"><i class="icon-reorder"></i>礼品-确认发货</div>

                                <div class="tools">
<!-- 
                                    <a href="javascript:;" class="collapse"></a>

                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>

                                    <a href="javascript:;" class="reload"></a>

                                    <a href="javascript:;" class="remove"></a> -->

                                </div>

                            </div>

                            <div class="portlet-body form">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                  <div class="modal-header">
                                  </div>
                                  <div class="modal-body" style=" text-align: left;">
                                      <form action="/admin/ursgoods/harvestsave" method="post"class="formaa">
                                          <!-- 隐藏域(申请礼品的id) -->
                                          <input type="hidden" name="id" value="<?php echo  $id ?>">
                                          <div class="control-group">
                                              <label class="control-label">发放人:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" required name="harvest_user" id="house_no" ></label>
                                          </div>
                                          <div class="control-group">
                                              <label class="control-label">发放方式</label>
                                              <div class="controls">
                                                  <label class="radio goods_">
                                                      <div class="radio"><span><input name="way" required value="1" class="span2 m-wrap" type="radio"></span></div>自取
                                                  </label>
                                                  <label class="radio goods_">
                                                      <div class="radio"><span><input name="way" required value="2" class="span2 m-wrap" type="radio"></span></div>邮寄到家
                                                  </label>
                                                  <label class="radio goods_daiqu">
                                                      <div class="radio"><span><input name="way" required value="3" class="span2 m-wrap" type="radio"></span></div>代取
                                                  </label>
                                                  <script type="text/javascript">
                                                      $('.goods_daiqu').click(function(){
                                                          $('.daiqu').show();
                                                          $("input[name=_name]").attr(required);
                                                          $("input[name=_phone]").attr(required);
                                                          $("input[name=_card]").attr(required);
                                                      })
                                                      $('.goods_').click(function(){
                                                          $('.daiqu').hide();
                                                          $("input[name=_name]").removeAttr(required);
                                                          $("input[name=_phone]").removeAttr(required);
                                                          $("input[name=_card]").removeAttr(required);
                                                      })
                                                  </script>     
                                              </div>
                                          </div>
                                          <div class="control-group daiqu" style="display:none">
                                             &nbsp;&nbsp;&nbsp;&nbsp;<label class="control-label">代取人姓名:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  name="_name" id="house_no" ></label>
                                          </div>
                                          <div class="control-group daiqu" style="display:none">
                                              &nbsp;&nbsp;&nbsp;&nbsp;<label class="control-label">代取人电话:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  name="_phone" id="house_no" onblur="check(this.value);"></label>
                                          </div>
                                            <script type="text/javascript">
                                                  function check(v){
                                                      var a=/^1[3|4|5|8][0-9]\d{4,8}$/;
                                                      if(!a.test(v)){
                                                          alert("格式不正确");
                                                          $("input[name=_phone]").attr("value","");
                                                      }
                                                  }
                                          </script>
                                          <div class="control-group daiqu" style="display:none">
                                              <label class="control-label">代取人身份证:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  name="_card" id="house_no" onblur="checks(this.value)"></label>
                                          </div>
                                           <script type="text/javascript">
                                                  function checks(v){
                                                      var a=/^[1-9]{1}[0-9]{14}$|^[1-9]{1}[0-9]{16}([0-9]|[xX])$/;
                                                      if(!a.test(v)){
                                                          alert("格式不正确");
                                                          $("input[name=_card]").attr("value","");
                                                      }
                                                  }
                                          </script>
                                          <div class="modal-footer" style="text-align:center;">
                                            <button type="submit" class="btn btn-primary green">确认提交</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                          </div>
                                      </form>
                                  </div>
                                    </div>
                                </div>
                            <br>
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
<script>

</script>
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