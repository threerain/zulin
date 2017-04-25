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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();");
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

                        <div class="portlet box">

                            <div class="portlet-title">
                                <div class="caption"><i class="icon-reorder"></i>幼狮车源-详情</div>
                                <div class="tools">
                                </div>
                            </div>

                            <div class="portlet-body form" style="float:left;">
                                <!-- BEGIN FORM-->
                                <form action="/admin/ursproperty/editsave" id="form_edit"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="id" value="<?php echo $ursproperty==null?"":$ursproperty->id;?>">
                                    <input type="hidden" name="property_id" value="<?php echo $property_id;?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <div class="control-group">
                                        <label class="control-label">收购合同ID：</label>
                                        <div class="controls" style="line-height:40px;">
                                            <a href="/admin/purchasecontract/detail/id/<?php echo $contract_id==null?"":$contract_id;?>">
                                            <?php          
                                                echo $contract_id==null?"":$contract_id;
                                            ?>
                                            </a>
                                        </div>                                       
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">出售合同ID：</label>
                                        <div class="controls">
                                            <?php
                                                $purchaseproperty=CmsPurchaseProperty::model()->find("property_id='$property_id' and type='1' and deleted='0'");
                                                $purchasecontract=CmsPurchaseContract::model()->find("id='$purchaseproperty->contract_id' and type='1' and status='0' and deleted='0'");
                                            ?>
                                            <a href="/admin/salecontract/detail/id/<?php echo $purchasecontract==null?"":$purchasecontract->id;?>">
                                            <?php          
                                                    echo $purchasecontract==null?"":$purchasecontract->id;
                                            ?>
                                            </a>
                                        </div>                                     
                                    </div>
                                    <style>
                                        .control{width:200px;float:left;margin-left:30px;}
                                        .gift{width:130px;float:left;margin-left:30px;line-height:60px;}
                                    </style>
                                    <div class="control-group">
                                        <div class="control">产品类型：<?php if($property->room_type){echo $arrproperty['room_type']["$property->room_type"]; }?></div>
                                        <div class="control">项目属性：<?php $item=BaseBuilding::model()->find("id='$property->building_id'");echo $item?str_replace([1,2,3],['A1','A2','A3'],$item->type):""; ?></div>                                      
                                    </div>  
                                    <div class="control-group"  >
                                        <div class="control">区域：<?php $item=BaseDistrict::model()->find("id='$property->district_id'"); echo $item?$item->name:""; ?></div>
                                        <div class="control">组团：<?php $item=BaseEstateGroup::model()->find("id='$property->estate_group_id'"); echo $item?$item->name:""; ?></div>
                                    </div> 
                                    <div class="control-group"  >
                                        <div class="control">品牌：<?php $item=BaseEstate::model()->find("id='$property->estate_id'"); echo $item?$item->name:""; ?></div>
                                        <div class="control">编号：<?php echo $property->house_no; ?></div>
                                    </div> 
                                    <div class="control-group"  >
                                        <div class="control">系列：<?php $item=BaseBuilding::model()->find("id='$property->building_id'"); echo $item?$item->name:""; ?></div>
                                        <div class="control">单价：                          
                                      <?php 
                                        $item=CmsPurchaseProperty::model()->findAll("property_id='$property->id' and deleted=0");
                                        if($item){
                                          foreach($item as $key => $value){
                                            $time=time();
                                            $purchase=CmsPurchaseContract::model()->find("id='$value->contract_id' and lease_term_start<='$time' and lease_term_end>='$time' and status='0' and type='0' and deleted='0'");
                                            if($purchase){
                                              $data=CmsPurchasePayRule::model()->find("contract_id='$purchase->id' and start_time<='$time' and end_time>='$time'");
                                              echo $data?$data->price_per_meter/100:"";
                                            }
                                          }
                                        } 
                                      ?>
                                        </div>
                                    </div> 
                                    <div class="control-group"  >
                                        <div class="control">面积：<?php echo $property->area; ?></div>
                                        <div class="control">朝向：<?php echo $property->orientation; ?></div>
                                    </div> 
                                    <div class="control-group"  >
                                        <div class="control">月租金：
                                        <?php 
                                            $item=CmsPurchaseProperty::model()->findAll("property_id='$property->id' and deleted=0");
                                            if($item){
                                              foreach($item as $key => $value){
                                                $time=time();
                                                $purchase=CmsPurchaseContract::model()->find("id='$value->contract_id' and lease_term_start<='$time' and lease_term_end>='$time' and status='0' and type='0' and deleted='0'");
                                                if($purchase){
                                                  $data=CmsPurchasePayRule::model()->find("contract_id='$purchase->id' and start_time<='$time' and end_time>='$time'");
                                                  echo $data?$data->monthly_rent/100:"";
                                                }
                                              }
                                            }  
                                        ?>  
                                        </div>
                                        <div class="control">底价：
                                            <?php echo $ursproperty==null?"":$ursproperty->base_price/100;?>元/㎡/天  
                                        </div>                                       
                                    </div>                                      
                                    <div class="control-group" style="margin-left:83px !important;">
                                        <div style="">礼品：</div>
                                        <?php
                                         $numbers=[];
                                         $acq_brokers=[];
                                        $item1=UrsGoodsDetail::model()->find("property_id='$property_id' and contract_id='$contract_id' and deleted = 0")['json'];
                                        $item2=UrsGoodsDetail::model()->find("property_id='$property_id' and contract_id='$contract_id' and deleted = 2")['json'];
                                        if($item2){
                                          $item=$item2;
                                        }else{
                                          $item=$item1;
                                        }
                                        if($item){
                                        $item=(Array)json_decode($item);
                                        foreach ($item as $key_item => $value_item) {
                                            $key_item = explode('-',$key_item);
                                            foreach ($key_item as $k => $v) {
                                                $numbers[] = $v;
                                            }
                                            $value_items = explode(',',$value_item);
                                            foreach ($value_items as $k => $v) {
                                                $acq_brokers[] = $v;
                                            }
                                        }
                                        ?>
                                        <?php echo $numbers[0]?$numbers[0]:0 ?>-<?php echo $numbers[1]?$numbers[1]:7 ?>天&nbsp;<?php
                                                $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[0]'");
                                                echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                              ?>
                                              <?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[1]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>
                                          <div style="clear:both"></div>
                                          <div style="margin:10px 0"></div>
                                          <?php echo $numbers[2]?$numbers[2]:8?>-<?php echo $numbers[3]?$numbers[3]:20 ?>天
                                          <?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[2]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>
                                          <?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[3]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>                                        
                                          <div style="clear:both"></div>
                                          <div style="margin:10px 0"></div>
                                          <?php echo $numbers[4]?$numbers[4]:21 ?>-<?php echo $numbers[5]?$numbers[5]:35 ?>天
                                          <?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[4]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>
                                            <?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[5]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>                                       
                                          <div style="clear:both" ></div>
                                          <div style="margin:10px 0"></div>
                                          <?php echo $numbers[6]?$numbers[6]:36 ?>-<?php echo $numbers[7]?$numbers[7]:199 ?>天
                                          <?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[6]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>
                                            <?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[7]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>
                                       <?php }?>
                                    </div> 
                                    <?php 
                                        $decoration_id=QualityDecorationProperty::model()->find("property_id='$property_id' order by ctime desc")['decoration_id'];
                                        $list_photo=QualityDecorationPhoto::model()->findAll("decoration_id='$decoration_id' and photo_type=1 order by ctime");
                                        if ($list_photo): 
                                    ?>
                                    <div class="control-group">
                                        <label class="control-label">CAD图：</label>
                                        <div class="control-group" style="margin:0;">
                                          <div class="controls">
                                            <div class="upload_progress">
                                                <span class="localname"></span>
                                            </div>
                                            <div class="fieldset flash" id="fsUploadProgress_list_photo">
                                                <span class="legend"></span>
                                            </div>
                                            <div id="list_photo_div" style="float:left;height:130px;">
                                              <img name="list_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                              <?php foreach ($list_photo as $key => $value): ?>
                                                <a target="_Blank" href="<?php echo $value->url; ?>"><img name="list_photo_show" src="<?php echo $value->url; ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a>
                                                <a class="download" style="float:left;width:30px;height:20px;background:#d84a38;color:#fff;text-align:center;margin-left:10px" href="/admin/decoration/download?url=<?php echo $value->url;?>">下载</a>
                                              <?php  endforeach ?>
                                            </div>
                                          </div>
                                        </div>                                                                    
                                    </div> 
                                    <?php endif;?>
                                    <br>
                                    <div id="propertys">
<!--图片-->                         <?php 
                                        if($photo){
                                            foreach ($photo as $k => $v){
                                                
                                                if ($v){
                                                    $a='';
                                                    foreach ($v as $k1 => $v1){
                                                        if ($k1==0){
                                                            $a=",".$v1->url;
                                                        }
                                                        else{
                                                            $a.=",".$v1->url;
                                                        }
                                                        
                                                    }
                                                }      
                                    ?>
                                        <div class="control-group">
                                            <label class="control-label">添加房间照片</label>
                                            <div class="controls">
                                                <select name="type_photo[]" disabled=true>
                                                  <?php foreach ($arr['type_photo'] as $key => $value) {
                                                  ?>
                                                    <option value="<?php echo $key?>"  <?php echo $key==$k? "selected":""?>><?php echo $value ?></option>
                                                  <?php
                                                  }?>   
                                                </select> 
                                            </div>
                                        </div>  
                                        <div class="control-group" style="margin:0;">
                                            <div class="controls">
                                                <div class="upload_progress">
                                                    <span class="localname"></span>
                                                </div>
                                                <div class="fieldset flash" id="fsUploadProgress_property_photo<?php echo $k?>">
                                                    <span class="legend"></span>
                                                </div>
                                                <div id="property_photo_div<?php echo $k?>" style="float:left;100%;height:200px;<?php echo $k==null?'display: none':''; ?>">
                                                    <img name="property_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                                                    <?php 
                                                        if ($v):?>
                                                        <?php foreach ($v as $k1 => $v1):?>                       
                                                            <a target="_Blank" href="<?php echo $v1->url; ?>"><img name="property_photo_show" src="<?php echo $v1->url; ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a>
                                                            <a class="download" style="float:left;width:30px;height:20px;background:#d84a38;color:#fff;text-align:center;margin-left:10px" href="/admin/property/download?url=<?php echo $v1->url;?>">下载</a>                                                        
                                                        <?php endforeach; ?>
                                                    <?php endif ?>                                
                                                </div>
                                            </div>
                                        </div>                     
                                    <?php 
                                            }
                                        }
                                    ?> 
                                    </div>                                                                                            
                                </form>
                                <button type="button" class="btn" onClick="javascript:history.go(-1)">返回</button>  
                                <!-- END FORM-->
                            </div>

                            <!-- 调取车源管理的图片 -->
                            <div  style="float:left;margin-left:15px;margin-top:23px;width:400px;">
                                <span style="font-size:16px;font-weight:bold;margin-left:30px;">车源图片：</span>
                                <?php 
                                    $count=0;
                                    if($property_photo){
                                        foreach ($property_photo as $k => $v){
                                            
                                            if ($v){
                                                $a='';
                                                foreach ($v as $k1 => $v1){
                                                    if ($k1==0){
                                                        $a=",".$v1->url;
                                                    }
                                                    else{
                                                        $a.=",".$v1->url;
                                                    }
                                                    
                                                }
                                            }      
                                        
                                ?>
                                    <div class="control-group">
                                        <!-- <label class="control-label">车源图片</label> -->
                                        <div class="controls">
                                            <select name="type_photo[]" disabled=true>
                                                <option value="">请选择图片类型</option>
                                                <option value="1" <?php echo $k==1? "selected":""?> >楼梯外观</option>
                                                <option value="2" <?php echo $k==2? "selected":""?>>交通图</option>
                                                <option value="3" <?php echo $k==3? "selected":""?>>格局图</option>
                                                <option value="4" <?php echo $k==4? "selected":""?>>平面图</option>
                                                <option value="5" <?php echo $k==5? "selected":""?>>外景图</option>
                                                <option value="6" <?php echo $k==6? "selected":""?>>办公室内(地面)</option>
                                                <option value="7" <?php echo $k==7? "selected":""?>>办公室内(室内吊顶)</option>
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="control-group" style="margin:0;">
                                        <div class="controls">
                                            <div id="property_photo_div<?php echo $k?>" style="float:left;100%;height:200px;<?php echo $k==null?'display: none':''; ?>">
                                                <?php 
                                                    if ($v):?>
                                                    <?php foreach ($v as $k1 => $v1):?>                       
                                                        <a target="_Blank" href="<?php echo $v1->url; ?>"><img name="property_photo_show" src="<?php echo $v1->url; ?>" style='max-width:100px;max-height:100px;float:left;margin-left:10px'/></a><img style="float:left;display:none;"  class="del_photo" src="/css/image/delete.jpg" width="25px" alt="" />
                                                        <a class="download" style="float:left;width:30px;height:20px;background:#d84a38;color:#fff;text-align:center;margin-left:10px" href="/admin/property/download?url=<?php echo $v1->url;?>">下载</a>   
                                                    <?php endforeach; ?>
                                                <?php endif ?>                                
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                            $count++;
                                        }
                                    }else{
                                        echo "<span style='font-size:16px;font-weight:bold;'>没有车源图片</span>";
                                    }
                                ?> 
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