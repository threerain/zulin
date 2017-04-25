<style>
#jqaddlink{display:none!important;}
  .modal-body{font-size:18px;text-indent: 20px;}
  #modal-label{text-align:center;font-size:22px;}
  #about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
  #left{background:#167bcd;color:#fff;margin-right:10px;}
  #left:hover{background:#0160cb!important;}
  input{width:150px;}
  select{width:150px;}
  b{font-weight:normal;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
  App.init();
  FormValidation.init();
  FormComponents.init();
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
        <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey">
          <div class="portlet-title">

            <div class="caption"><i class="icon-globe"></i>交房列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid" style="min-height:120px;">
                
               
                  <form  style="margin:0;margin-top:30px;" action="/admin/sersellcontract/index">


                    <div class="dataTables_filter" style="">

                         <span style='margin-left:30px;'>
                        <b>     商圈：</b><input type="text" value="<?php echo $keyword_area;?>" name="keyword_area">
                          </span style='margin-left:10px;'>
                          <span style='margin-left:10px;'>
                        <b>     品牌：</b><input type="text" value="<?php echo $keyword_estates;?>" name="keyword_estates">
                          </span>
                          <span style='margin-left:10px;'>
                          <b>   系列：</b><input type="text"  value="<?php echo $keyword_building;?>" name="keyword_building">
                          </span>
                          <input type="hidden" value="<?php echo $search ?>" name="search">
                          <span style='margin-left:10px;'>
                          <b>编号：</b><input type="text" value="<?php echo $keyword_room_number;?>" name="keyword_room_number">
                          <input type="checkbox" id="highsearch">高级搜索
                            <button id="sample_editable_1_new" class="btn btn-primary" type="submit">
                            搜索 <i class="icon-search"></i></button>
                          </span>
                          <span>
                          </span>
                    </div>
                      <div id="content" style="display:none;">
                          <div class="dataTables_filter" style="margin-bottom:20px;margin-top:20px">

                            <span class="test line21" style='margin-left:30px;'><b>规定交房日期：</b>
                             <input type="text" id="datepicker3" value="<?php echo $keyword_ctime3;?>" name="keyword_ctime3" /><b>&nbsp;&nbsp;至&nbsp;
                             </b><input type="text" id="datepicker4" value="<?php echo $keyword_ctime4;?>" name="keyword_ctime4" />
                            </span>
                            <span style="margin-left:30px;" class="line3"><b>实际交房日期：</b>
                            <input type="text" id="datepicker5" value="<?php echo $keyword_ctime5;?>" name="keyword_ctime5" />
                            <b>&nbsp;至&nbsp;&nbsp;</b><input type="text" id="datepicker6" value="<?php echo $keyword_ctime6;?>" name="keyword_ctime6" /></span>

                         </div>


                          <div class="dataTables_filter" style="margin-bottom:20px;margin-top:20px">

                            <!-- <span class="line4" style='margin-left:30px;'><b>规定车主维修结束日期：</b> -->
                            <!-- <input type="text" id="datepicker7" value="<?php echo $keyword_ctime7;?>" name="keyword_ctime7" /> -->
                            <!-- <b>&nbsp;至&nbsp;&nbsp;</b><input type="text" id="datepicker8" value="<?php echo $keyword_ctime8;?>" name="keyword_ctime8" /></span> -->
                                                <span class="test line21" style='margin-left:30px;'><b>外勤人员：</b>
                            <input type="text" id="" value="<?php echo $keyword_admin;?>" name="keyword_admin">
                            <span class="test line21" style='margin-left:30px;'><b>来源：</b>
                            <select name="k_source">
                            <option value="null" selected>请选择</option>
                            <option value="车主" <?php echo $k_source==车主?'selected=selected':''?>>车主</option>
                            <option value="租户" <?php echo $k_source==租户?'selected=selected':''?>>租户</option>
                          </select> 
                          </span>
                          </div>
                          </div>  <!--隐藏部分结束-->
                    <script type="text/javascript">
                        var bb = $("input[name=search]").val();
                         if(bb == 2){
                            $("#content").css("display","block")
                            $("#highsearch").attr("checked",true)
                         }
                    </script>
                  </form>
             </div>

              
              <table class="table table-striped table-bordered table-hover" id="sample" ><!-- ID sample_1目前没用,js中控制显示效果 -->
              <thead >
                <tr class="yj-title-th">
                  <!-- <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample .checkboxes" /></th> -->
                  <th class="hidden-480">出车合同</th>
                  <th class="hidden-480">商圈</th>
                  <th class="hidden-480">品牌</th>
                  <th class="hidden-480">系列</th>
                  <th class="hidden-480">编号</th>
                  <th class="hidden-480">客服外勤人员</th>
                  <th class="hidden-480">规定交房日期</th>
                  <th class="hidden-480">实际交房日期</th>
                  <th class="hidden-480">来源</th>
                  <th class="hidden-480">状态</th>
                  <th >操作</th>
                </tr>
              </thead>
              <tbody>
                  <?php foreach ($list as $k => $v){ ?>
                      <tr class="deleted" sid="<?php echo $v['id']?>">
                          <td><a href="/admin/purchasecontract/detail/id/<?php echo $v['contract_id'] ?>"><?php echo $v['contract_id'] ?></a></td>
                          <td><?php echo $v['area'] ?></td>
                          <td><?php echo $v['estate'] ?></td>
                          <td><?php echo $v['building'] ?></td>
                          <td><?php echo $v['house_no'] ?></td>
                          <td><?php echo  AdminUser::model()->find("id = '{$v['creater_id']}' and deleted = 0")['nickname'] ?></td>
                          <td><span class ="<?php echo $v['id'].'1'?>" style="display:block"><?php echo !empty($v['set_date']) ? date('Y-m-d',$v['set_date']) :'' ?></span>
                          <span class="<?php echo $v['id'].'2'?>" style="display:none">
                              <form action="/admin/sersellcontract/edits" style="margin: 0 ;" method="post">
                                  <input type="text" id="<?php echo $v['id'] ?>" value="" name="set_date" required >
                                  <input type="hidden"  value="<?php echo $v['id'] ?>" name="id" required >
                                  <input type="submit" value="确认">
                              </form>
                          </span></td>
                          <script type="text/javascript">
                            var picker = new Pikaday({
                              field: document.getElementById('<?php echo $v['id'] ?>'),
                              firstDay: 1,
                              minDate: new Date('2010-01-01'),
                              maxDate: new Date('2030-12-31'),
                              yearRange: [2000,2030]
                            });
                          </script>
                          <td><?php echo $v['actual_date'] ? date('Y-m-d ', $v['actual_date']) :'' ?></td>
                          <td><?php echo str_replace([0,1], ['车主','租户'], $v['source']) ?></td>
                          <td><?php echo $v['actual_date'] ? '已交房' :'未交房' ?></td>
                          <td>
                          <div class="btn-operation">
                            <a class="btn-oper dropdown-toggle" data-toggle="dropdown" href="#">
                              操作
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" style="left: -38px;width:140px !important;">
								<?php if(!empty($v['actual_date'])) {?>
                              <a href="/admin/sersellcontract/detail/id/<?php echo $v['id'] ?>">详情</a>
                               <?php  }?>
                               <?php if(AdminPositionModul::has_modul("702_02") && empty($v['actual_date'])) {?>
                                    <a href="/admin/sersellcontract/add/id/<?php echo $v['id'] ?>">交房</a>
                              <?php  }?>
                            <?php if(AdminPositionModul::has_modul("702_03")  && !empty($v['actual_date'])) {?>
                               <a href="/admin/sersellcontract/edit/id/<?php echo $v['id'] ?>">编辑</a>
                            <?php }?>
                            <?php if(AdminPositionModul::has_modul("702_04")) {?>
                              <a href="" address="/admin/sersellcontract/deleted/id/<?php echo $v['id'];?>" class= "delete" data-toggle="modal" data-target="#about-modal">删除</a>
                            <?php }?>
                            <?php if(AdminPositionModul::has_modul("702_05")) {?>
                              <a href="#" class = "<?php echo $v['id'];?>" address="<?php echo $v['id'];?>">编辑规定交房日期</a>
                              <script type="text/javascript">
                                    $(".<?php echo $v['id'];?>").click(function(){
                                        var id =  $(this).attr('address');
                                        // alert($)
                                        $(".<?php echo $v['id'];?>1").toggle();
                                        $(".<?php echo $v['id'];?>2").toggle();
                                    })

                              </script>

                            <?php }?>
                              </ul>
                            </div>
                          </td>
                      </tr>

                  <?php } ?>
              </tbody>
            </table>

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

<div class="modal fade" id="about-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label"
         aria-hidden="true" style="margin-top:90px">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-label">本站点提示...</h4>
                </div>
                <div class="modal-body">
                    <p>确定要删除吗?</p>
                </div>
                <div class="modal-footer">
                     <a id="left" class="btn btn-primary dels">确定</a>

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
<script type="text/javascript">

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



<script type="text/javascript">
  $('#btnn').click(function(){
    document.getElementById("sales").style.display = "none";
  })
  $('#btnn1').click(function(){
    document.getElementById("follow").style.display = "none";
  })
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
  var picker = new Pikaday({
    field: document.getElementById('datepicker5'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
  var picker = new Pikaday({
    field: document.getElementById('datepicker6'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
 
</script>

<script>

  $(function(){
    $("#highsearch").click(function(){
        var aa = $("input[name=search]").val();
    console.log(aa);
        $("#content").toggle();
        if(aa == 1 || aa == ''){
            $("input[name=search]").val(2);
        }else{
            $("input[name=search]").val(1);
        }
    })

  })

</script>
