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
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/app.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/urs_goods.js',CClientScript::POS_END);
// Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
Yii::app()->clientScript->registerScript("","
   App.init();
  FormValidation.init();
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
                  <form action="/admin/ursgoods/goodsindex" style="margin:30px" >
                      <div class="dataTables_filter" style="margin-bottom:30px;margin-top:30px;" id="">
                        <span>名称：<input type="text" value="<?php echo $keyword_goods ?>" name="keyword_goods"></span>

                        <span>操作人：<input type="text" value="<?php echo $keyword_admin_uname ?>" name="keyword_admin_uname"></span>

                        <span>申请时间：<input type="text" id="datepicker3" value="<?php echo $keyword_signing_date1 ?>" name="keyword_signing_date1"/>至<input type="text" id="datepicker4" value="<?php echo $keyword_signing_date2 ?>" name="keyword_signing_date2"/></span>
                        <button id="sample_editable_1_new" class="btn btn-primary" type="submit">
                            搜索 <i class="icon-search"></i>
                          </button>
                            </div>
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
                  </form>

                </div>

                  <div class="btn-group pull-right" style="clear:both;">
                    <?php if(AdminPositionModul::has_modul("604_02")) {?>
                      <button id="sample_editable_1" class="btn btn-primary"  data-toggle="modal" data-target="#myModal1" style="margin-right:30px;">
                      新建 <i class="icon-plus"></i>
                      </button>
                    <?php }?>
                    <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                          新增礼品
                          </div>
                          <form action="/admin/ursgoods/dogoodsadd" id="form_add3"  method="post"   class="form-horizontal js-submit">
                              <div class="modal-body" style=" padding: 0px;">
                                  <div class="control-group" >
                                      <label class="control-label" style="text-align:right;">礼品名称<span class="required" style="color:red">*</span>
                                      <input type="text"  name="goods_name" id="goods_name"  required readmin="请申请正确的数量"></label>
                                      <div class="controls">
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-body" style=" padding: 0px;">
                                  <div class="control-group">
                                      <label class="control-label" style="text-align:right;">单&nbsp;&nbsp;位<span class="required" style="color:red">*</span>
                                       <input type="text" name="goods_unit" id="goods_unit"  required ></label>
                                      <div class="controls">
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-body" style=" padding: 0px;">
                                  <div class="control-group">
                                      <label class="control-label" style="text-align:right;">价&nbsp;&nbsp;格<span class="required" style="color:red">*</span>
                                       <input type="text" name="goods_price" id="goods_price"  required ></label>
                                      <div class="controls">
                                      </div>
                                  </div>
                              </div>
                              <div class="modal-footer">
                                  <button  type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                              </div>

                              <script type="text/javascript">
                                      //声明全局变量
                                      var goods_name = false;
                                      var goods_unit = false;
                                      //input标签获取焦点事件
                                      $('input').focus(function(){
                                          //获取属性 提示信息
                                          var text = $(this).attr('readmin');
                                          //给span设置文本
                                          $(this).next().html(text).css('color','green');
                                          //设置样式
                                          $(this).css('border','1px solid green');
                                      })

                                      //商品
                                      $('input[name=goods_name]').blur(function(){
                                          var goods_name = $(this).val();
                                          var  lengths = length(goods_name);
                                          if(goods_name != null && lengths<11 ){
                                              goods_name = true;
                                          }
                                      })
                                      //单位
                                      $('input[name=goods_unit]').blur(function(){
                                          var goods_unit = $(this).val();
                                          if(goods_name != null){
                                              goods_name = true;
                                          }
                                      })
                                      //绑定表单事件
                                      $('#form_add3').submit(function(){
                                          //触发丧失焦点事件
                                          $('input').trigger('blur');
                                          //检测所有字段是否正确
                                          if(goods_name && goods_unit){
                                              return true;
                                          }
                                          //阻止默认行为
                                          return false;
                                      })
                              </script>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                <table class="table table-striped table-bordered table-hover" id="sample" ><!-- ID sample_1目前没用,js中控制显示效果 -->
                  <thead >
                    <tr class="yj-title-th">
                      <th class="hidden-480">物品</th>
                      <th class="hidden-480">价格</th>
                      <th class="hidden-480">已购</th>
                      <th class="hidden-480">单位</th>
                      <th class="hidden-480">最近操作时间</th>
                      <th class="hidden-480">操作人</th>
                      <th >操作</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($list)){
                        foreach($list as $k => $v ){ ?>
                          <tr class="odd gradeX deleted" sid="<?php echo $v['id']?>">
                              <td class="hidden-480"><?php echo $v['goods_name']?></td>
                              <td class="hidden-480"><?php echo $v['goods_price']?>元</td>
                              <td class="hidden-480" style="width:100px;"></i><input type="number" data="<?php echo $v['id']?>" style="width:100px;" value="<?php echo $v['goods_storge']?>" name ="goods_storge" ></td>
                              <td class="hidden-480"><?php echo $v['goods_unit']?></td>
                              <td class="hidden-480"><?php echo date('Y-m-d H:i:s',$v['ctime'])?></td>
                              <td class="hidden-480"><?php echo $v['create_user_id']?></td>
                              <td >

                              <div class="btn-operation">
                                <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                                  操作
                                  <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" style="left: -38px;width:140px !important;">

                                  <?php if(AdminPositionModul::has_modul("604_11")) {?>
                                    <a href="/admin/ursgoods/record/id/<?php echo $v['id'] ?>">详情</a>
                                        
                                  <?php }?>
                                  </ul>
                                </div>
                              </td>

                          </tr>
                    <?php } } ?>
                  </tbody>
                </table>
                              <script>
                              $("input[name='goods_storge']").blur(function(){
                                var id = 
                                $.post('/admin/ursgoods/SaveStorge/id/'+$(this).attr('data')+'',{goods_storge:$(this).val()},function(msg){
                                  if(msg!=''){
                                    alert('修改失败')
                                  }
                                })
                              })
                              </script>

                              


                <div class="row-fluid">
                  <div class="span4">
                    <div class="dataTables_info" id="sample_1_info"></div>
                  </div>
                  <div class="span8">
                    <div class="dataTables_paginate paging_bootstrap pagination" style="margin:30px auto;width:99%;text-align:center;">

                    <?php
                      // $ps = Yii::app()->params['pageSetting'];
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

<!-- </div> -->
