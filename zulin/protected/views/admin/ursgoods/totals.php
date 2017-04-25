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

                                <div class="caption"><i class="icon-reorder"></i>礼品-支出单</div>

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
                                  <div class="modal-body" style=" text-align: left; max-height: 800px;">
                                      <form action="/admin/ursgoods/totalssave" method="post"class="formaa">
                                          <!-- 隐藏域(申请礼品的id) -->
                                          <input type="hidden" name="id" value="<?php echo$list['id'] ?>">
                                          <div class="control-group">
                                              <label class="control-label" style="display:block;width:400px;">合同id:&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $list['id'] ?></label>
                                          </div>
                                          <div class="control-group">
                                              <label class="control-label" style="display:block;width:400px;">申请品牌:&nbsp;&nbsp;&nbsp;&nbsp;<sapn style="margin: 0 30px 0 0 "><?php  echo $list['estate_id'] ?></sapn><sapn style="margin: 0 30px 0 0 "><?php  echo $list['building_id'] ?></sapn><sapn style="margin: 0 30px 0 0 "><?php  echo $list['room_number'] ?></sapn></label>
                                          </div>
                                          <?php foreach ($goods as $k => $v){ ?>
                                              <div class="control-group">
                                                  <label class="control-label" style="display:block;width:400px;">申请物品:&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $v['ys_goods_storage_id'] ?></label>
                                              </div>
                                              <div class="control-group">
                                                  <label class="control-label" style="display:block;width:400px;">数量:&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $v['number'] ?></label>
                                              </div>
                                          <?php } ?>
                                          <div class="control-group " >
                                              &nbsp;&nbsp;&nbsp;&nbsp;<label class="control-label" style="display:block;width:400px;">金额:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" min='0' id="number"  required onblur="check(this.value);" name="_totals" id="house_no" ></label>
                                          </div>
                                          <script type="text/javascript">
                                              function check(v){
                                                  var a=/^[0-9]*(\.[0-9]{1,2})?$/;
                                                  if(!a.test(v)){
                                                      alert("格式不正确");
                                                      $("#number").attr("value","");
                                                  }
                                              }


                                          </script>
                                          <div class="control-group">
                                              <label class="control-label" style="display:block;width:400px;">放款方式</label>
                                              <div class="controls">
                                                  <label class="radio goods_yinlian">
                                                      <div class="radio"><span><input name="way" required value="1" class="span2 m-wrap" type="radio"></span></div>银行转账
                                                  </label>
                                                  <label class="radio zhifubao">
                                                      <div class="radio"><span><input name="way" required value="2" class="span2 m-wrap" type="radio"></span></div>支付宝
                                                  </label>
                                                  <label class="radio weixin">
                                                      <div class="radio"><span><input name="way" required value="3" class="span2 m-wrap" type="radio"></span></div>微信
                                                  </label>
                                                  <label class="radio xianjin">
                                                      <div class="radio"><span><input name="way" required value="4" class="span2 m-wrap" type="radio"></span></div>现金
                                                  </label>
                                                  <script type="text/javascript">
                                                      $('.goods_yinlian').click(function(){
                                                          $('.daiqu').show();
                                                          $("input[name=_name]").attr(required);
                                                          $("input[name=_banks]").attr(required);
                                                          $("input[name=_number]").attr(required);
                                                      })
                                                      $('.zhifubao').click(function(){
                                                           $('.shoukuan').show();
                                                           $('.zhanghao').show();
                                                           $('.kaihuhang').hide();
                                                           $("input[name=_name]").attr(required);
                                                          $("input[name=_banks]").attr(required);
                                                          $("input[name=_number]").removeAttr(required);
                                                      })
                                                      $('.weixin').click(function(){
                                                           $('.shoukuan').show();
                                                           $('.zhanghao').show();
                                                           $('.kaihuhang').hide();
                                                           $("input[name=_name]").attr(required);
                                                          $("input[name=_banks]").attr(required);
                                                          $("input[name=_number]").removeAttr(required);
                                                      })
                                                      $('.xianjin').click(function(){
                                                           $('.daiqu').hide().removeAttr(required);
                                                      })
                                                  </script>     
                                              </div>
                                          </div>
                                          <div class="control-group daiqu kaihuhang" style="display:none">
                                             &nbsp;&nbsp;&nbsp;&nbsp;<label class="control-label">开户行:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  name="_banks" id="" ></label>
                                          </div>
                                          <div class="control-group daiqu shoukuan" style="display:none">
                                              &nbsp;&nbsp;&nbsp;&nbsp;<label class="control-label">收款人名:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text"  name="_name" id="house_no" ></label>
                                          </div>
                                          <div class="control-group daiqu zhanghao" style="display:none">
                                              &nbsp;&nbsp;&nbsp;&nbsp;<label class="control-label">账号:&nbsp;&nbsp;&nbsp;&nbsp;<input type="number"  name="_number" id="house_no" ></label>
                                          </div>
                                          <div class="modal-footer" style="text-align:center;">
                                            <button type="submit" class="btn btn-primary">确认提交</button>
                                            <a type="button" href="<?php  echo $referer; ?>" class="btn btn-default" data-dismiss="modal">取消</a>
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