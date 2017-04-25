<style>
    /*.control-label{display:block;width:400px;}*/
</style>
<style>
 
  .control-group{
      float: left;
      width:300px;
      padding-bottom: 10px;
  }
  .control-label{
       float: left;
       padding-right:10px!important;
       text-align:right;
       min-width:120px!important;
  }
  .controls{
       float: left
  }

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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/urs_goods.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/urs_goods.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);


// 
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
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

                                <div class="caption"><i class="icon-reorder"></i>礼品-详情</div>

                                <div class="tools">
<!-- 
                                    <a href="javascript:;" class="collapse"></a>

                                    <a href="#portlet-config" data-toggle="modal" class="config"></a>

                                    <a href="javascript:;" class="reload"></a>

                                    <a href="javascript:;" class="remove"></a> -->

                                </div>

                            </div>

                            <div class="portlet-body form">
                                    <div class="control-group">
                                        <label class="control-label">申请人: </label>
                                        <div class="controls">
                                            <span><?php echo  $model['admin_uname']; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">部门: </label>
                                        <div class="controls">
                                            <span><?php echo $list['department']; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">组别: </label>
                                        <div class="controls">
                                            <span><?php echo  $list['department_group']; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">负责人: </label>
                                        <div class="controls">
                                            <span><?php echo  $list['department_principal']; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">品牌: </label>
                                        <div class="controls">
                                            <span><?php echo $list['estate_id'] ?></span>
                                        </div>
                                        
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">系列: </label>
                                        <div class="controls">
                                            <span><?php echo $list['building_id'] ?></span>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="control-group"  >
                                        <label class="control-label">编号: </label>
                                        <div class="controls">
                                            <span><?php echo $list['house_no']   ?></span>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <div class="control-group"  >
                                        <label class="control-label">渠道公司: </label>
                                        <div class="controls">
                                            <span><?php echo  $list['channel_id']; ?></span>
                                        </div>
                                    </div>
                                    <div class="control-group"  >
                                        <label class="control-label">渠道人员: </label>
                                        <div class="controls">
                                            <span><?php echo  $list['channel_manager_id']; ?></span>
                                        </div>
                                    </div>
                                    <div style="clear:both"></div>
                                    <?php foreach ($goods as $k=> $v){ 

                                        $contents .= $v['ys_goods_storage_id'].'/'. $v['number'].'/'.$v['unit'];
                                        ?> 
                                        <div class="control-group" style="min-width: 300px;" >
                                            <label class="control-label">申请的礼品: </label>
                                            <div class="controls">
                                                <span style="margin-right:40px"><?php echo  $contents; ?></span>
                                            </div>
                                        </div>   
                                    <?php } ?>
                                    <div style="clear:both;"></div>
                                    <!-- 未审核 -->
                                    <?php if($list['status'] == 1 ){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">审核状态: </label>
                                            <div class="controls">
                                                <span>未审核</span>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!-- 一审通过 -->
                                    <?php if(($list['status']>1 && $list['status'] != 3)  || $list['status'] == "aa" ){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">一审通过/审核人: </label>
                                            <div class="controls">
                                                <span><?php echo $list['department_principal']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  >
                                            <label class="control-label">审核时间: </label>
                                            <div class="controls">
                                                <span><?php echo date('Y-m-d H:i:s',$model['check_one_time']) ?></span>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?>
                                    <!-- 一审不通过 -->
                                    <?php if($list['status'] == 3){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">一审不通过/审核人: </label>
                                            <div class="controls">
                                                <span><?php echo $list['department_principal']; ?></span>
                                            </div>
                                        </div>
                                         <div class="control-group"  >
                                            <label class="control-label">不通过原因: </label>
                                            <div class="controls">
                                                <span><?php echo  $model['check_one_reason']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  >
                                            <label class="control-label">审核时间: </label>
                                            <div class="controls">
                                                <span><?php echo date('Y-m-d H:i:s',$model['check_one_time']) ?></span>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?> 
                                    <!-- 二审通过 -->
                                    <?php if(($list['status'] > 3 && $list['status'] != 5)  || $list['status'] == "aa"){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">二审通过/审核人: </label>
                                            <div class="controls">
                                                <span><?php echo  $list['check_two']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  >
                                            <label class="control-label">审核时间: </label>
                                            <div class="controls">
                                                <span><?php echo date('Y-m-d H:i:s',$model['check_two_time']) ?></span>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?>
                                    <!-- 二审不通过 -->
                                    <?php if($list['status'] == 5){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">二审不通过/审核人: </label>
                                            <div class="controls">
                                                <span><?php echo  $list['check_two']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  >
                                            <label class="control-label">不通过原因: </label>
                                            <div class="controls">
                                                <span><?php echo  $model['check_two_reason']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  >
                                            <label class="control-label">审核时间: </label>
                                            <div class="controls">
                                                <span><?php echo date('Y-m-d H:i:s',$model['check_two_time']) ?></span>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?>
                                    <!-- 财务审核中 -->
                                    <?php if($list['status'] == 6){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">财务审核中</label>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?>
                                    <!-- 财务审核不通过 -->
                                    <?php if($list['status'] == "no"){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">财务审核不通过/审核人: </label>
                                            <div class="controls">
                                                <span><?php echo  $list['check_finance']; ?></span>
                                            </div>
                                        </div>
                                         <div class="control-group"  >
                                            <label class="control-label">不通过原因: </label>
                                            <div class="controls">
                                                <span><?php echo  $model['check_finance_reason']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  >
                                            <label class="control-label">审核时间: </label>
                                            <div class="controls">
                                                <span><?php echo date('Y-m-d H:i:s',$model['check_finance_time'])  ?></span>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?>
                                    <!-- 财务已放款 -->
                                    <?php if($list['status'] > 6 || $list['status'] == "aa"){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">财务已放款/审核人: </label>
                                            <div class="controls">
                                                <span><?php echo  $list['check_finance']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  >
                                            <label class="control-label">审核时间: </label>
                                            <div class="controls">
                                                <span><?php echo date('Y-m-d H:i:s',$model['check_finance_time']) ?></span>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?> 
                                    <!-- 已确认收款 -->
                                    <?php if($list['status'] > 7 || $list['status'] == "aa"){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">已确认收款/收款人: </label>
                                            <div class="controls">
                                                <span><?php echo  $list['cheques_user']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  >
                                            <label class="control-label">收款时间: </label>
                                            <div class="controls">
                                                <span><?php echo date('Y-m-d H:i:s',$model['cheques_user_time']) ?></span>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?> 
                                    <!-- 已确认购买 -->
                                    <?php if($list['status'] > 8 || $list['status'] == "aa"){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">已购买/填写购买信息的人: </label>
                                            <div class="controls">
                                                <span><?php echo  $list['information_user']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  >
                                            <label class="control-label">填写时间: </label>
                                            <div class="controls">
                                                <span><?php echo date('Y-m-d H:i:s',$model['information_time']) ?></span>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?> 
                                    <!-- 已发放 -->
                                    <?php if($list['status'] == "aa" ){ ?>
                                        <div class="control-group"  >
                                            <label class="control-label">已发放/发放人: </label>
                                            <div class="controls">
                                                <span><?php echo  $list['harvest_user']; ?></span>
                                            </div>
                                        </div>
                                        <div class="control-group"  >
                                            <label class="control-label">发放物品的时间: </label>
                                            <div class="controls">
                                                <span><?php echo date('Y-m-d H:i:s',$model['harvest_time']) ?></span>
                                            </div>
                                        </div>
                                        <div style="clear:both"></div>
                                    <?php } ?> 
                                    <div class="control-group" style="margin-top:30px">
                                        <div class="controls">
                                            <a id="" type="button" href="<?php echo $referer ?>"  class="btn btn-primary">返回</a>
                                        </div>
                                    </div>   
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
                                    <script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
                                    <style>
                                        .theFont{font-size: 20px;}
                                    </style>                                    
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
    var districtid=$("select[name='district_id']").val();
    $.ajax("/admin/ajax/getarea", {
        data: {
            id:districtid
        },
        dataType: "json"
    }).done(function (data) {
        var options="";
        if(data.length>0){
            options+="<option value=''></option>";
            for(var i=0;i<data.length;i++){
                options+="<option value="+data[i].id+">"+data[i].title+"</option>";
            }
            $("select[name='area_id']").html(options);
        }
    });

    $("select[name='district_id']").on("change",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示 
        $("select[name='area_id']").empty();
        var districtid=$("select[name='district_id']").val();
        if(null!= districtid && ""!=districtid){
            $.ajax("/admin/ajax/getarea", {
                data: {
                    id:districtid
                },
                dataType: "json"
            }).done(function (data) {
                var options="";
                if(data.length>0){
                    options+="<option value=''></option>";
                    for(var i=0;i<data.length;i++){
                        options+="<option value="+data[i].id+">"+data[i].title+"</option>";
                    }
                    $("select[name='area_id']").html(options);
                }
            });
        }
        else{
            $("#second").hide();
        }
    });

    $("select[name='area_id']").on("change",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示 
        $("select[name='estate_id']").empty();
        var areaid=$("select[name='area_id']").val();
        if(null!= areaid && ""!=areaid){
            $.ajax("/admin/ajax/getestate", {
                data: {
                    id:areaid
                },
                dataType: "json"
            }).done(function (data) {
                var options="";
                if(data.length>0){
                    options+="<option value=''></option>";
                    for(var i=0;i<data.length;i++){
                        options+="<option value="+data[i].id+">"+data[i].title+"</option>";
                    }
                    $("select[name='estate_id']").html(options);
                }
            });
        }
        else{
            $("#second").hide();
        }
    });



    $("#estate_id").on("change",function(e){ 
        alert(1234);
   });

    

</script>


<script>
//日期
  var picker = new Pikaday({
    field: document.getElementById('datepicker'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
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