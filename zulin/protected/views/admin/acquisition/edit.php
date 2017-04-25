
<style media="screen">
   div{overflow:visible}
   input{width:200px!important}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/admin-property.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/cms_outroom_commission.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/jquery.validate.min.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);

  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);



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

                        <div class="portlet box blue">

                            <div class="portlet-title">

                                <div class="caption"><i class="icon-reorder"></i>修改返佣申请</div>

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
                                <form action="/admin/acquisition/editsave" id="form_edit"  method="post"  class="form-horizontal js-submit">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer; ?>">
                                    <input type="hidden" name='user' value=''>
                                    <div class="alert alert-error hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        输入格式有误，请检查输入的数据.
                                    </div>
                                    <div class="alert alert-success hide">
                                        <button class="close" data-dismiss="alert"></button>
                                        数据输入验证成功!
                                    </div>



                            <div style="clear:both;"></div>

						                 <div class="control-group" style="margin-top:30px">
						                    <label style="margin-left:80px">品牌:
						                        <input type="text" name="estate_id" disabled='disabled'  class="span2 m-wrap" value="<?php echo $property[0]['estate_name'] ?>"
						                    title="<?php echo $property[0]['estate_name']   ?>" >
                              </label>
						                </div>
						                <div class="control-group"  style="margin-top:-30px">
						                    <label style="margin-left:80px">系列:

						                        <input  type="text" name="building_id" disabled='disabled' class="building_id span4 select2" value="<?php echo $property[0]['building_name'] ?>"
						                    title="<?php echo $property[0]['building_name'] ?>  ?>" >
						                    </label>
						                </div>
                            <?php foreach ($property as $key => $value): ?>

						                <div class="control-group"  style="margin-top:-30px" >
						                    <label style="margin-left:65px">编号:</span>

						                        <input  type="text" name="room_number" disabled='disabled' id="room_number<?php echo $key?>" class="room_number span4 select2" value="<?php echo $value['house_no'] ?>"
						                    title="<?php echo $value['house_no'] ?>" >

                              </label>

						                </div>
						                 <div class="control-group"  style="margin-top:-30px">
						                    <label style="margin-left:80px">面积:</span>

						                        <input  type="text" name="room_number" disabled='disabled'  class="span2 m-wrap" id="room_number<?php echo $key?>" class="room_number span4 select2" value="<?php echo $value['area'] ?>"
						                    title="<?php echo $value['area'] ?>" >㎡

                              </label>

						                </div>
						            <?php endforeach ?>
									               <div class="control-group" style="clear:both;margin-top:-30px" >
                                        <label style="margin-left:40px">合同月租金:

                                            <input  type="text" name="monthly_rent" disabled='disabled'  class="span2 m-wrap" value="<?php $pay = CmsPurchasePayRule::model()->find("contract_id = '$model->id' order by the_order");echo $pay['monthly_rent']?$pay['monthly_rent']/100:'';?>
                                                " >
                                        </label>
                                    </div>
                                    <div class="control-group" style="margin-top:-30px">
                                        <label style="margin-left:40px">实际月租金:

                                                <input type="text" name="acq_monthly_rent" placeholder="最多保留两位小数" required maxlength='10' class="span2 m-wrap" value="<?php
                                                  $pay = CmsPurchasePayRule::model()->find("contract_id = '$model->id' order by the_order");echo $list->acq_monthly_rent?$list->acq_monthly_rent/100:$pay['monthly_rent']/100;

                                             ?>"
                                            onblur="check(this.value,this);"><span style="color:red">*</span>
                                        </label>
                                    </div>
                                    <div class="control-group" style="margin-top:-30px">
                                        <label style="margin-left:25px">合同标注佣金:

                                            <input name="house_no" type="text" disabled='disabled'   class="span2 m-wrap" value="<?php echo $model?$model->commission/100:''?>"/>
                                        </label>
                                    </div>
                                    <div class="control-group" style="margin-top:-30px">
                                        <label >车主实际支付佣金:</span>

                                            <input name="acq_real_commission" type="text" placeholder="最多保留两位小数" maxlength='10'  required class="span2 m-wrap" value="<?php echo $list?$list->acq_real_commission/100:$model->commission/100?>"
                                            onblur="check(this.value,this);"
                                            /><span style="color:red">*</span>
                                        </label>
                                    </div>
                                    <div class="control-group" style="margin-top:-30px">
                                        <label style="margin-left:20px">华亮返佣(60%):</span>

                                            <input name="acq_fan" type="text"   class="span2 m-wrap" maxlength='15' placeholder="最多保留两位小数" required value="<?php
                                            $pay = CmsPurchasePayRule::model()->find("contract_id = '$model->id'");
                                            if($pay){
                                                      if($list['acq_fan']) {
                                                          echo $list->acq_fan/100;
                                                      }else{
                                                        $purchase=CmsPurchaseContract::model()->find("id = '$model->id' ");
                                                       if($purchase){
                                                        $data=CmsPurchasePayRule::model()->find("contract_id='$purchase->id' order by the_order");
                                                        echo $data?$data->monthly_rent/100*0.6:"";
                                                      }
                                                    }

                                            }else{
                                                  echo '';
                                            }
                                          ?>"
                                          onblur="check(this.value,this);"
                                              /><span style="color:red">*</span>
                                        </label>
                                    </div>
                                    <script type="text/javascript">
                                        $("input[name=acq_monthly_rent]").blur(function() {
                                          var a = $(this).val();
                                          var b = a*0.6;
                                          var num = b.toFixed(2)

                                          $("input[name=acq_fan]").val(num);

                                        })
                                    </script>
                                    <div class="control-group" style="margin-top:-30px">
                                        <label style="margin-left:55px">其它金额:</span>

                                            <input name="acq_other" type="text"    class="span2 m-wrap" maxlength='7' value="<?php echo $list?$list->acq_other/100:0?>"
                                          onblur="check(this.value,this);" placeholder="最多保留两位小数"
                                            />
                                        </label>
                                    </div>

                                    <!-- <div class="control-group" style="margin-top:-30px">
                                        <label style="margin-left:40px">华亮居间人<span style="color:red">*</span></span>

                                            <input name="acq_broker" type="text"  class="span2 m-wrap" required value="<?php echo $list?$list->acq_broker:''?>"/>
                                        </label>
                                    </div> -->
                                    <div class="control-group" style="margin-top:-40px;margin-left:100px">
                                        <label class="control-label" >渠道公司:</label>
                                        <div class="controls" style="margin-left:75px">
                                            <input type="text" name="channel_id" id="channel_id" value="<?php echo $list->channel_id?>" required class="span6 select2" style="width:220px"
                                            ><span style="color:red">*</span>
                                        </div>
                                    </div>
                                    <div class="control-group <?php
                                          if($key==0 || $broker==null) {
                                              echo 'dellspecial';
                                          }
                                    ?>" style="margin-top:-40px;margin-left:100px">
                                    <?php
                                            $broker = [0];
                                            $num = 1;
                                          if($list->acq_broker) {
                                              $broker = explode(',',$list->acq_broker);
                                              $num = count($broker);
                                          }?>

                                          <?php foreach ($broker as $key => $value) {?>


<div class='test' style='clear:both;'>
                                        <label class="control-label" >渠道人员:</label>
                                        <div class="controls" style="margin-left:75px">
                                           <input type="hidden" name="acq_broker[]" required id="channel_manager_id<?php echo $key?$key:0?>" class="span6 select2" style="width:220px"
                                           value="<?php echo $value;?>"  title="<?php
                                           	    $channel = CmsChannelManager::model()->find("id = '$value'");
       																				  echo $channel->name;
                                              ?>"
                                           >
                                           <?php
                                            if( $key==0 || $broker==null) {?>
                                              <button class="btn red addqudao" type="button" style="margin-top:1px;">增加</button>
                                            <?php }?>
                                              <button class="btn red delqudao" type="button" style="margin-top:1px;">删除</button>
                                        </div>
</div>
<script>
$(function(){
    var handlechannel_manager_id2Selec2 = function () {
        function format(state) {
            if (!state.id) return state.text; // optgroup
            return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
        }
        function movieFormatResult(movie) {
            var markup = "<table class='movie-result'><tr>";
            if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
                markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
            }
            markup += "<td valign='top'><h5>" + movie.title + "</h5>";
            if (movie.critics_consensus !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
            } else if (movie.synopsis !== undefined) {
                markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
            }
            markup += "</td></tr></table>"
            return markup;
        }

        function movieFormatSelection(movie) {
            return movie.title;
        }
        $("#channel_manager_id<?php echo $key ?>").select2({
            placeholder: "",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "/admin/channelmanager/ajaxlist",
                dataType: 'json',
                data: function (term, page) {
                    return {
                        channel_id : $('#channel_id').val(),
                        q: term, // search term
                        page_limit: 10,
                        apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                    };
                },
                results: function (data, page) { // parse the results into the format expected by Select2.
                    // since we are using custom formatting functions we do not need to alter remote JSON data
                    return {
                        results: data.movies
                    };
                }
            },
            initSelection: function (element, callback) {
                // the input tag has a value attribute preloaded that points to a preselected movie's id
                // this function resolves that id attribute to an object that select2 can render
                // using its formatResult renderer - that way the movie name is shown preselected
                var id = $(element).val();
                if (id !== "") {
                    $.ajax("/admin/channelmanager/ajaxitem", {
                        data: {
                            id:id,
                            apikey: "ju6z9mjyajq2djue3gbvv26t"
                        },
                        dataType: "json"
                    }).done(function (data) {
                        callback(data);
                    });
                }
            },
            formatResult: movieFormatResult, // omitted for brevity, see the source of this page
            formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
            dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
            escapeMarkup: function (m) {
                return m;
            } // we do not want to escape markup since we are displaying html in results
        });
    }
    handlechannel_manager_id2Selec2();
})

</script>
                                      <?php
                                            }
                                          ?>
                                          <div class='test' id="qudaorenyuan"></div>
                                          <div  style='clear:both;'></div>
                                        </div>
                                    <div class="control-group" style="margin-top:-30px">
                                        <label style="margin-left:80px">备注:</span>

                                            <textarea style="width:400px; height:100px;" maxlength="255" name='acq_remark'><?php echo $list?$list->acq_remark:''?></textarea>
                                        </label>
                                    </div>
                                    <div class="form-actions">
                                        <button id='sdf' type="submit" class="btn blue submit js-btnadd">保存</button>
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
<style>
    .theFont{font-size: 20px;}
</style>

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
<!-- 隐藏的渠道人员 -->
<div id="qudao" class='test' style="clear:both;display:none;">
  <label class="control-label" >渠道人员:</label>
  <div class="controls" style="margin-left:75px">
            <input type="hidden" name="acq_broker[]"  id="channel_manager_id" class="span6 select2 channel_manager_id"  style="width:220px">
            <button class="btn red delqudao" type="button" style="margin-top:1px;">删除</button>
    </div>
</div>
<script>
    $(function(){
        $(".submit").click(function(){
            $("#qudao").eq(0).remove();
        })
    })
    $(".addqudao").eq(0).show();
    $(".delqudao").eq(0).hide();
    $(".addqudao").live('click',function(){
          var qudao = $("#qudao").clone();
          qudao.removeAttr('id');
          qudao.show();
        var num = $(".addqudao").length;
        // qudao.find("#channel_manager_id").attr('id','channel_manager_id'+num)
        $("#qudaorenyuan").append(qudao);
        $("#qudaorenyuan").find(".addqudao").remove();
        $("#qudaorenyuan").find(".delqudao").show();

        $(".delqudao").click(function(){
            $(this).parent().parent().remove();
        })
        handlechannel_manager_id2Selec3();
    })
    $(".delqudao").click(function(){
        $(this).parent().parent().remove();
    })
        var handlechannel_manager_id2Selec3 = function () {
            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }
            function movieFormatResult(movie) {
                var markup = "<table class='movie-result'><tr>";
                if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
                    markup += "<td valign='top'><img src='" + movie.posters.thumbnail + "'/></td>";
                }
                markup += "<td valign='top'><h5>" + movie.title + "</h5>";
                if (movie.critics_consensus !== undefined) {
                    markup += "<div class='movie-synopsis'>" + movie.critics_consensus + "</div>";
                } else if (movie.synopsis !== undefined) {
                    markup += "<div class='movie-synopsis'>" + movie.synopsis + "</div>";
                }
                markup += "</td></tr></table>"
                return markup;
            }

            function movieFormatSelection(movie) {
                return movie.title;
            }
            $("#qudaorenyuan").find(".channel_manager_id").select2({
                placeholder: "",
                minimumInputLength: 1,
                ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                    url: "/admin/channelmanager/ajaxlist",
                    dataType: 'json',
                    data: function (term, page) {
                        return {
                            channel_id : $('#channel_id').val(),
                            q: term, // search term
                            page_limit: 10,
                            apikey: "ju6z9mjyajq2djue3gbvv26t" // please do not use so this example keeps working
                        };
                    },
                    results: function (data, page) { // parse the results into the format expected by Select2.
                        // since we are using custom formatting functions we do not need to alter remote JSON data
                        return {
                            results: data.movies
                        };
                    }
                },
                initSelection: function (element, callback) {
                    // the input tag has a value attribute preloaded that points to a preselected movie's id
                    // this function resolves that id attribute to an object that select2 can render
                    // using its formatResult renderer - that way the movie name is shown preselected
                    var id = $(element).val();
                    if (id !== "") {
                        $.ajax("/admin/channelmanager/ajaxitem", {
                            data: {
                                id:id,
                                apikey: "ju6z9mjyajq2djue3gbvv26t"
                            },
                            dataType: "json"
                        }).done(function (data) {
                            callback(data);
                        });
                    }
                },
                formatResult: movieFormatResult, // omitted for brevity, see the source of this page
                formatSelection: movieFormatSelection, // omitted for brevity, see the source of this page
                dropdownCssClass: "bigdrop", // apply css that makes the dropdown taller
                escapeMarkup: function (m) {
                    return m;
                } // we do not want to escape markup since we are displaying html in results
            });
        }

</script>
      <script>
      $("select[name='channel_id']").on("change",function(e){ //当第一个下拉列表变动内容时第二个下拉列表将会显示
      $("select[name='acq_broker']").empty();
      var channelid=$("#channel_id").val();
      if(null!= channelid && ""!=channelid){
      $.ajax("/admin/ajax/getchannelmanager", {
      data: {
      id:channelid
      },
      dataType: "json"
      }).done(function (data) {
      var options="";
      if(data.length>0){
      options+="<option value=''></option>";
      for(var i=0;i<data.length;i++){
      options+="<option value="+data[i].id+">"+data[i].title+"</option>";
      }
      $("select[name='acq_broker']").html(options);
      }
      });
      }
      else{
      $("#second").hide();
      }
      });

      <?php
      if ($list->channel_id && $list->acq_broker){
      ?>
      $.ajax("/admin/ajax/getchannelmanager", {
      data: {
      id:'<?php echo $list->channel_id?>'
      },
      dataType: "json"
      }).done(function (data) {
      var options="";
      if(data.length>0){
      options+="<option value=''></option>";
      for(var i=0;i<data.length;i++){
      if (data[i].id=="<?php echo $list->acq_broker?>"){
      options+="<option value="+data[i].id+" selected>"+data[i].title+"</option>";
      }
      else{
      options+="<option value="+data[i].id+" > "+data[i].title+"</option>";
      }
      }
      $("select[name='acq_broker']").html(options);
      }
      });
      <?php
      }
      ?>
      </script>
