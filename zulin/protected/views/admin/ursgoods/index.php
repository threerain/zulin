<style>
#jqaddlink{display:none!important;}
input{width:150px;}
</style>
<!-- BEGIN PAGE LEVEL STYLES -->
<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/select2_metro.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin/DT_bootstrap.css');
?>
<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/select2.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.dataTables.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/DT_bootstrap.js',CClientScript::POS_END);
?>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
// Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript("","
  App.init();
  ");
?>
<!-- End PAGE LEVEL SCRIPTS -->
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>

<div class="page-content">
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

          <div class="caption"><i class="icon-globe"></i>礼品管理</div>
          <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
            <a href="#portlet-config" data-toggle="modal" class="config"></a>
            <a href="javascript:;" class="reload"></a>
            <a href="javascript:;" class="remove"></a> -->
          </div>
        </div>
        <div class="portlet-body">
          <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
            <div class="row-fluid">
              <div class="">
                <form action="/admin/ursgoods/index" style="margin:30px;margin-bottom:15px" >
                    <div class="dataTables_filter" style="margin-bottom:10px" id="">
                      <span >合同ID：<input type="text" value="<?php echo $keyword_contract_id?>" name="keyword_contract_id"></span>

                      <span>申请人：<input type="text" value="<?php echo $keyword_admin_uname?>" name="keyword_admin_uname"></span>

                      <span>状态：
                        <select name="keyword_status" id="" style="width:150px">
                          <option value="0" <?php echo $keyword_status==0?'selected=selected':'' ?> >全部</option>
                          <option value="1"  <?php echo $keyword_status==1 ?'selected=selected':''  ?> >未审核</option>
                          <option value="2"  <?php echo $keyword_status==2 ?'selected=selected':''  ?> >一审审核</option>
                          <option value="3"  <?php echo $keyword_status==3 ?'selected=selected':''  ?> >一审不通过</option>
                          <option value="4"  <?php echo $keyword_status==4 ?'selected=selected':''  ?> >二审通过</option>
                          <option value="5"  <?php echo $keyword_status==5 ?'selected=selected':''  ?> >二审不通过</option>
                          <option value="6"  <?php echo $keyword_status==6 ?'sel ected=selected':''  ?> >财务审核中</option>
                          <option value="6"  <?php echo $keyword_status=="no" ?'selected=selected':''  ?> >财务审核不通过</option>
                          <option value="7"  <?php echo $keyword_status==7 ?'selected=selected':''  ?> >财务已放款</option>
                          <option value="8"  <?php echo $keyword_status==8 ?'selected=selected':''  ?> >已确认收款</option>
                          <option value="9"  <?php echo $keyword_status==9 ?'selected=selected':''  ?> >已购买</option>
                          <option value="aa"  <?php echo $keyword_status=='aa' ?'selected=selected':''  ?> >已发放</option>
                        </select>
                      </span>
                      <span>申请时间：<input type="text" id="datepicker3" value="<?php echo $keyword_signing_date1 ?>" name="keyword_signing_date1"/>至<input type="text" id="datepicker4" value="<?php echo $keyword_signing_date2 ?>" name="keyword_signing_date2"/></span>
                      <button id="sample_editable_1_new" class="btn btn-primary" type="submit">
                          搜索 <i class="icon-search"></i>
                        </button>
                      <script type="text/javascript">
                          var picker = new Pikaday({
                              field: document.getElementById('datepicker3'),
                              firstDay: 1,
                              minDate: new Date('2010-01-01'),
                              maxDate: new Date('2030-12-31'),
                              yearRange: [2000,2030]
                          });

                          var picker = new Pikaday({
                              field: document.getElementById('datepicker4'),
                              firstDay: 1,
                              minDate: new Date('2010-01-01'),
                              maxDate: new Date('2030-12-31'),
                              yearRange: [2000,2030]
                          });
                      </script>
                    </div>
                </form>

            </div>

                <div class="btn-group pull-right" style="clear:both;">
                  <?php if(AdminPositionModul::has_modul("604_03")) {?>
                    <a href="/admin/ursgoods/add">
                    <button id="sample_editable_1" class="btn btn-primary" style="margin-right:30px;">
                    新建 <i class="icon-plus"></i>
                    </button>
                    </a>
                <?php  }?>

                </div>

            <table class="table table-striped table-bordered table-hover" id="sample" ><!-- ID sample_1目前没用,js中控制显示效果 -->
              <thead >
                <tr class="yj-title-th">
                  <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                  <th class="hidden-480">合同id</th>
                  <th class="hidden-480">品牌</th>
                  <th class="hidden-480">系列</th>
                  <th class="hidden-480">编号</th>
                  <th class="hidden-480">申请人</th>
                  <th class="hidden-480">申请物品</th>
                  <th class="hidden-480">数量</th>
                  <th class="hidden-480">申请时间</th>
                  <th class="hidden-480">状态</th>
                  <th >操作</th>
                </tr>
              </thead>
              <tbody >
                <?php if($list){
                    foreach($list as $k => $v){ ?>
                      <tr class="odd gradeX deleted" sid="<?php echo $v['id']?>" style="vertical-align: middle">
                          <td style="vertical-align: middle" class="hidden-480"><?php echo $v['contract_id']?></td>
                          <td style="vertical-align: middle" class="hidden-480"><?php echo $v['estate_id']?></td>
                          <td style="vertical-align: middle" class="hidden-480"><?php echo $v['building_id']?></td>
                          <td style="vertical-align: middle" class="hidden-480"><?php echo $v['house_no']?></td>
                          <td style="vertical-align: middle" class="hidden-480"><?php echo $v['admin_uname']?></td>
                          <td style="vertical-align: middle" class="hidden-480"><?php echo $v['names'] ?></td>
                          <td style="vertical-align: middle" class="hidden-480"><?php  echo $v['num_unit']?></td>
                          <td style="vertical-align: middle" class="hidden-480"><?php echo date('Y-m-d H:i:s', $v['ctime'])?></td>
                          <td style="vertical-align: middle" class="hidden-480"><?php echo str_replace([1,2,3,4,5,6,7,8,9,'aa'],['未审核','一审通过','一审不通过','二审通过','二审不通过','财务审核','财务已放款','已确认收款','已购买','已发放'],$v['status'])?></td>
                          <td >
                            <div class="btn-operation">
                              <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                                操作
                                <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu" style="left: -38px;width:140px !important;">

                              <?php if(AdminPositionModul::has_modul("604_12")) {?>
                                <a href="/admin/ursgoods/detail/id/<?php echo $v['id'] ?>">详情</a>

                              <?php }?>
                               <?php if(AdminPositionModul::has_modul("604_04")) {?>
                                 <a href="/admin/ursgoods/edit/id/<?php echo $v['id'] ?>">修改</a>
                              <?php }?>
                              <?php if(AdminPositionModul::has_modul("604_05")) {?>
                                <div class="dels"><a href="">删除</a></div>
                              <?php }?>
                              <?php
                                  // if($v['status'] ==1 | $v['status'] == 2 | $v['status'] == 6){  当财务开始做的时候把下面的删除 把这一行打开
                                  if($v['status'] ==1 | $v['status'] == 2 && AdminPositionModul::has_modul("604_06")){
                              ?>
                                  <a href="/admin/ursgoods/examine/id/<?php echo $v['id'] ?>">审核</a>
                              <?php }?>
                              <?php
                                  if($v['status'] ==4){
                              ?>
                                  <!-- <a href="">提支出单</a> -->
                                  <?php if(AdminPositionModul::has_modul("604_06")) {?>
                                    <a href="/admin/ursgoods/totalss/id/<?php echo $v['id'] ?>">提支出单</a>
                                  <?php }?>

                              <?php }?>
                              <?php
                                  if($v['status'] ==7){
                              ?>
                                  <a href="/admin/ursgoods/cheques/id/<?php echo $v['id'] ?>">确认收款</a>
                              <?php }?>
                              <?php
                                  if($v['status'] ==8){
                              ?>
                                  <a href="/admin/ursgoods/information/id/<?php echo $v['id'] ?>">添加购买信息</a>
                              <?php }?>

                              <?php
                                  if($v['status'] == 9){
                              ?>
                                  <a href="/admin/ursgoods/harvest/id/<?php echo $v['id'] ?>">确认发放</a>
                                  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                        </div>
                                        <div class="modal-body" style=" text-align: left;">
                                            <form action="/admin/ursgoods/ursgoodstime">
                                                <!-- 隐藏域(申请礼品的id) -->
                                                <input type="hidden" name="id" value="<?php echo  $v['id']; ?>">
                                                <div class="control-group">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="control-label">发放人:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="harvest_user" id="house_no" ></label>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">发放方式</label>
                                                    <div class="controls">
                                                        <label class="radio goods_">
                                                            <div class="radio"><span><input name="way" value="1" class="span2 m-wrap" type="radio"></span></div>自取
                                                        </label>
                                                        <label class="radio goods_">
                                                            <div class="radio"><span><input name="way" value="2" class="span2 m-wrap" type="radio"></span></div>邮寄到家
                                                        </label>
                                                        <label class="radio goods_daiqu">
                                                            <div class="radio"><span><input name="way" value="3" class="span2 m-wrap" type="radio"></span></div>代取
                                                        </label>
                                                        <script type="text/javascript">
                                                            $('.goods_daiqu').click(function(){
                                                                $('.daiqu').show();
                                                            })
                                                            $('.goods_').click(function(){
                                                                $('.daiqu').hide();
                                                            })
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="control-group daiqu" style="display:none">
                                                   &nbsp;&nbsp;&nbsp;&nbsp;<label class="control-label">代取人姓名:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="_name" id="house_no" ></label>
                                                </div>
                                                <div class="control-group daiqu" style="display:none">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;<label class="control-label">代取人电话:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="_phone" id="house_no" ></label>
                                                </div>
                                                <div class="control-group daiqu" style="display:none">
                                                    <label class="control-label">代取人身份证:&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="_card" id="house_no" ></label>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="submit" class="btn btn-primary">确认提交</button>
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                                </div>
                                            </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div><br>

                              <?php }?>
                                </ul>
                              </div>
                          </td>
                      </tr>
                <?php } } ?>
              </tbody>
            </table>



            <div class="row-fluid">
              <div class="span4">
                <div class="dataTables_info" id="sample_1_info"></div>
              </div>
              <div class="span8" style="width:500px">
                <div class="dataTables_paginate paging_bootstrap pagination">
                  <?php
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
<!-- //////////////////////////////// -->
<div class="page-content">
    <div class="container-fluid">


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
    //删除
    $('.dels').click(function(){
        //获取id
        var id = $(this).parents('.deleted').attr('sid');
        var td = $(this);
        $.get('/admin/ursgoods/deleted',{id:id},function(data){
            if(data == 1){
                td.parents('.deleted').remove();
            }
        })
        //阻止默认行为
        return false;
    })

</script>
