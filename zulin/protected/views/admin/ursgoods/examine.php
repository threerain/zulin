<?php

  $this->PAGE_LEVEL_STYLES='<link href="/css/admin/select2_metro.css" rel="stylesheet" type="text/css"/>'."\r\n";
  $this->PAGE_LEVEL_STYLES.='  <link href="/css/admin/DT_bootstrap.css" rel="stylesheet" type="text/css"/>';

  $this->PAGE_LEVEL_PLUGINS.='<script type="text/javascript" src="/css/admin/js/select2.min.js"></script>'."\r\n";
  $this->PAGE_LEVEL_PLUGINS.='  <script type="text/javascript" src="/css/admin/js/jquery.dataTables.js"></script>'."\r\n";
  $this->PAGE_LEVEL_PLUGINS.='  <script type="text/javascript" src="/css/admin/js/DT_bootstrap.js"></script>'."\r\n";
  $this->PAGE_LEVEL_SCRIPTS.='<script type="text/javascript" src="/css/admin/js/app.js"></script>'."\r\n";
  $this->PAGE_LEVEL_SCRIPTS.='  <script type="text/javascript" src="/css/admin/js/table-managed.js"></script>'."\r\n";

  Yii::app()->clientScript->registerScript("","
    App.init();
    TableManaged.init();");
?>

<div class="page-content">
    <div class="container-fluid">
      <div class="row-fluid" style="min-height:20px;"></div>
           <div class="control-group">
               <label class="control-label" style="display:block;width:400px;">合同&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;id &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list['contract_id']?></label><br>
           </div>
           <div class="control-group">
              <?php foreach ($list['house_no'] as $k => $v){ if($k ==0){?>
                  <label class="control-label" style="display:block;width:400px;">申请品牌&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list['estate_id'].' '.$list['building_id'].' '.$v?></label>
              <?php }else{ ?>
                  <label class="control-label" style="display:block;width:400px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list['estate_id'].' '.$list['building_id'].' '.$v?></label>
              <?php }} ?>
           </div>
           <div class="control-group">
               <br><label class="control-label" style="display:block;width:400px;">部&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;门&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list['department']?></label><br>
           </div>
           <div class="control-group">
               <label class="control-label" style="display:block;width:400px;">组&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list['department_group']?></label><br>
           </div> 
           <div class="control-group">
               <label class="control-label" style="display:block;width:400px;">负责&nbsp;&nbsp;&nbsp;&nbsp;人&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list['department_principal']?></label><br>
           </div> 
           <div class="control-group" style="display:block;width:400px;"> 
              <?php foreach ($_goods as $k => $v){ if($k == 0){?>
                  <label class="control-label">申请物品&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v?></label>
              <?php }else{ ?>
                  <label class="control-label" style="display:block;width:400px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $v ?></label>
              <?php }} ?>
           </div>
          
           <div class="control-group">
               <label class="control-label" style="display:block;width:400px;">渠道公司&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list['channel_id']?></label><br>
           </div>
           <div class="control-group">
               <label class="control-label" style="display:block;width:400px;">渠道人员&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list['channel_manager_id']?></label><br>
           </div>
           <div class="control-group">
               <label class="control-label" style="display:block;width:400px;">备&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;注&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $list['remark']?></label><br>
           </div>
          <!--一审 -->
          <?php if($list['status'] == 1){ ?>    
              <div style="float:left;margin:30px">
                <form action="/admin/ursgoods/ExamineSave" method="post" class="formaddress">
                    <input type="hidden" name="status" value="2">
                    <input type="hidden" name="id" value="<?php echo $list['id'] ?>">
                    <input  type="submit" value="通过"  class="btn btn-primary yishen" id="abtn">
                </form>
              </div>
              <div style="float:left;margin:30px">
                      <input  type="submit" value="不通过" id="pass" class="btn btn-primary">
              </div>
              <script type="text/javascript">
                  $("#pass").click(function(){
                      $(".one").css("display","block");
                  })
                  $("#yishen").click(function(){
                      $(".one").css("display","none");
                  })
              </script>
              <div style="clear:both"></div>
              <div style="float:left;display:none" class="one">
                  <form action="/admin/ursgoods/ExamineSave" method="post" class="formaddress">
                      <input type="hidden" name="status" value="3">
                      <input type="hidden" name="id" value="<?php echo $list['id']?>">
                      不通过原因:<textarea value="" name="reason" ></textarea><br>
                      <input  type="submit" value="提交"  class="btn btn-primary">
                  </form>
              </div>
          <?php } ?>
           <!--二审 -->
          <?php if($list['status'] == 2){ ?>
               <div class="control-group">
                   <label class="control-label">销售经理:已审核</label><br>
               </div>
               <div class="control-group">
                   <label class="control-label"><?php echo $list['department_principal'] ?>&nbsp;&nbsp;&nbsp;:<?php echo $list['department_principal']?></label><br>
               </div> 
               <div class="control-group">
                   <label class="control-label">财务是否收齐一期款:&nbsp;&nbsp;&nbsp;&nbsp;是&nbsp;&nbsp;写死的数据</label><br>
               </div>  
              <div style="float:left;margin:30px">
                <form action="/admin/ursgoods/ExamineSave" method="post" class="formaddress">
                    <input type="hidden" name="status" value="4">
                    <input type="hidden" name="id" value="<?php echo $list['id'] ?>">
                    <input  type="submit" value="通过"  class="btn btn-primary ershen">
                </form>
              </div>
              <div style="float:left;margin:30px">
                      <input  type="submit" value="不通过" id="pass" class="btn btn-primary">
              </div>
              <script type="text/javascript">
                  $("#pass").click(function(){
                      $(".two").css("display","block");
                  })
                  $("#ershen").click(function(){
                      $(".two").css("display","none");
                  })
              </script>
              <div style="clear:both"></div>
              <div style="float:left;display:none" class="two">
                  <form action="/admin/ursgoods/ExamineSave" method="post" class="formaddress">
                      <input type="hidden" name="status" value="5">
                      <input type="hidden" name="id" value="<?php echo $list['id']?>">
                      不通过原因:<textarea value="" name="reason"></textarea><br>
                      <input  type="submit" value="提交"  class="btn btn-primary">
                  </form>
              </div>
          <?php } ?>
           <!--财务审核 -->
          <?php if($list['status'] == 6){ ?>
               <div class="control-group">
                   <label class="control-label">销售经理:已审核</label><br>
               </div>
               <div class="control-group">
                   <label class="control-label"><?php echo $list['department_principal'] ?>&nbsp;&nbsp;&nbsp;:<?php echo $list['department_principal']?></label><br>
               </div> 
               <div class="control-group">
                   <label class="control-label">财务是否收齐一期款:&nbsp;&nbsp;&nbsp;&nbsp;是&nbsp;&nbsp;写死的数据</label><br>
               </div>  
               <div class="control-group">
                   <label class="control-label">综合支持部(<?php echo $list['check_two'] ?>):已审核</label><br>
               </div>  
              <div style="float:left;margin:30px">
                <form action="/admin/ursgoods/ExamineSave" method="post" class="formaddress">
                    <input type="hidden" name="status" value="7">
                    <input type="hidden" name="id" value="<?php echo $list['id'] ?>">
                    <input  type="submit" value="通过"  class="btn btn-primary caiwu">
                </form>
              </div>
              <div style="float:left;margin:30px">
                    <input  type="submit" value="不通过" id="pass" class="btn btn-primary">
              </div>

              <script type="text/javascript">
                  $("#pass").click(function(){
                      $(".three").css("display","block");
                  })
                  $("#caiwu").click(function(){
                      $(".three").css("display","none");
                  })
              </script>
              <div style="clear:both"></div>
              <div style="float:left;display:none" class="three">
                  <form action="/admin/ursgoods/ExamineSave" method="post" class="formaddress">
                      <input type="hidden" name="status" value="no">
                      <input type="hidden" name="id" value="<?php echo $list['id']?>">
                      不通过原因:<textarea value="" name="reason"></textarea><br>
                      <input  type="submit" value="提交"  class="btn btn-primary">
                  </form>
              </div>
          <?php } ?>
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
</script>

<style>
  .btn{height:31px!important;}
 #pass{height:31px!important;}
</style>




