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
<link rel="stylesheet" type="text/css" href="/css/admin/pikaday.css"/>
<script type="text/javascript" src="/css/admin/js/pikaday.min.js"></script>
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

                        <div class="portlet box ">

                            <div class="portlet-title">
                                <div class="caption"><i class="icon-reorder"></i>销控编辑</div>
                                <div class="tools">
                                </div>
                            </div>
                            <style>
                                .control{width:300px;float:left;margin-left:30px;}
                                .gift{width:80px;float:left;margin-left:30px;}

                            </style>
                            <div class="control-group">
                                <div class="control">类型：<?php if($property->room_type){echo $arrproperty['room_type']["$property->room_type"]; }?></div>
                                <div class="control">属性：<?php $item=BaseBuilding::model()->find("id='$property->building_id'");echo $item?str_replace([1,2,3],['A1','A2','A3'],$item->type):""; ?></div>
                            </div>

                            <div class="control-group"  >
                                <div class="control">品牌：<?php $item=BaseEstate::model()->find("id='$property->estate_id'"); echo $item?$item->name:""; ?></div>
                                <div class="control">编号：<?php echo $property->house_no; ?></div>
                            </div>
                            <form action="/admin/salescontrol/doedit"   method="post"  class="form-horizontal js-submit">
                            <div class="control-group"  >
                                <div class="control">系列：<?php $item=BaseBuilding::model()->find("id='$property->building_id'"); echo $item?$item->name:""; ?></div>
                                <div class="control">报价：
                                  <input type="text" name="unit_price" value="<?php
                                          $item=UrsSalesControl::model()->find("property_id='$property->id' and deleted=0");
                                          echo $item?$item->unit_price/100:"";
                                        ?>">

                                </div>
                            </div>

                            </div>



                            <?php
                                      $item=UrsSalesControl::model()->find("property_id='$property->id' and deleted=0");

                            if($item->name!=null) {

                                        $name = explode(',',$item->name);
                                        $phone = explode(',',$item->phone);
                                        foreach($name as $k=>$v) {?>
                                          <div class="control-group" >
                                              <div class="control">联系人：
                                                <input type="text" name="name[]" value="<?php
                                                  echo $v;
                                                  ?>">
                                            </div>
                                            <?php if($k==0) {?>
                                              <button class="btn red addqudao" type="button" style="margin-top:1px;">增加</button>
                                            <?php }else {?>
                                              <button class="btn red delqudao" type="button" style="margin-top:1px;">删除</button>
                                          <?php  }

                                            ?>
                                            <div class="control">电话：
                                              <input type="text" name="phone[]" value="<?php echo $phone[$k]; ?>">
                                            </div>
                                          </div>
                                        <?php
                                      }

                            }else {?>
                              <div class="control-group" >
                                  <div class="control">联系人：
                                    <input type="text" name="name[]" value="">
                                </div>
                                <button class="btn red addqudao" type="button" style="margin-top:1px;">增加</button>

                                <div class="control">电话：
                                  <input type="text" name="phone[]" value="">
                                </div>
                              </div>
                          <?php  }
                              ?>
                            <div class='test' id="qudaorenyuan"></div>

                              <div class="" id="qudao" style="display:none">
                                <div class="control-group" >
                                    <div class="control">联系人：
                                      <input type="text" name="name[]" value="">
                                  </div>
                                  <button class="btn red delqudao" type="button" style="margin-top:1px;">删除</button>

                                    <div class="control">电话：
                                      <input type="text" name="phone[]" value="">
                                    </div>
                                </div>
                              </div>
                            <div class="control-group"  >
                                <div class="control">月租金：
                                  <?php
                                    $item=UrsSalesControl::model()->find("property_id='$property->id' and deleted=0");
                                    if($item->area!=null) {
                                      echo $item?round($item->unit_price/100*$item->area*365/12,2):"";
                                    }else {
                                      echo $item?round($item->unit_price/100*$property->area*365/12,2):"";
                                    }
                                  ?>
                                </div>
                                <div class="control" style="width:800px">可出车时间：
                                  <input type="text" name="live_date" id="datepicker" value="<?php
                                    $item=UrsSalesControl::model()->find("property_id='$property->id' and deleted=0");
                                      echo $item->live_date?date("Y-m-d", $item->live_date):''; ?>">
                                </div>
                            </div>
                            <?php
                             $res=UrsSalesControl::model()->findAll("property_id='$property_id' and deleted='0'");
                             $numbers=[];
                             $acq_brokers=[];
                            if($res){
                                foreach ($res as $key => $value) {
                                    $item=UrsGoodsDetail::model()->find("property_id='$property_id'  and deleted = 0")['json'];
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
                                }

                            }
                            ?>
                            <div class="portlet-body form" style="float:left;">
                                <form action="/admin/salescontrol/doedit"   method="post"  class="form-horizontal js-submit">
                                    <style>
                                        .control{float:left;};
                                    </style>
                                    <input type="hidden" name="property_id" value="<?php echo $property_id ?>">
                                    <input type="hidden" name="contract_id" value="<?php echo $contract_id ?>">
                                    <input type="hidden" name="referer" value="<?php echo $referer ?>">
                                      <div class="control-group" style="margin-bottom:0px !important;margin-left:0px;">
                                        <div class="controls control" style="width:1200px !important;margin:40px !important">
                                          <label style="float:left">礼品编辑<span class="required" style="color:red">*</span></label>
                                          <input type="number" min="0" value = '<?php echo $numbers[0]?$numbers[0]:0 ?>' name="number[]"  required  style="width:60px;float:left"><span style="float:left">-</span>
                                          <input type="number" min="1" value = '<?php echo $numbers[1]?$numbers[1]:9 ?>'   name="number[]"required  style="width:60px;float:left"><span style="float:left">天</span>
                                          <input type="hidden" name="acq_broker[]" required id="channel_manager_id" class="span6 select2" style="width:220px"
                                                value="<?php echo $acq_brokers[0];?>"  title="<?php
                                                $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[0]'");
                                                echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                              ?>"
                                          >
                                          <input type="hidden" name="acq_broker[]" required id="channel_manager_id1" class="span6 select2" style="width:220px"
                                                  value="<?php echo $acq_brokers[1];?>"  title="<?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[1]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>"
                                          >

                                          <div style="clear:both"></div>
                                          <div style="margin:10px 0"></div>
                                          <input type="number" min="1" value = '<?php echo $numbers[2]?$numbers[2]:10?>'   name="number[]"  required  style="width:60px;margin-left:63px;float:left"><span style="float:left">-</span>
                                          <input type="number" min="1" value = '<?php echo $numbers[3]?$numbers[3]:20 ?>'  name="number[]"  required  style="width:60px;float:left"><span style="float:left">天</span>
                                          <input type="hidden" name="acq_broker[]" required id="channel_manager_id2" class="span6 select2" style="width:220px"
                                                  value="<?php echo $acq_brokers[2];?>"  title="<?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[2]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>"
                                          >
                                          <input type="hidden" name="acq_broker[]" required id="channel_manager_id3" class="span6 select2" style="width:220px"
                                                  value="<?php echo $acq_brokers[3];?>"  title="<?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[3]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>"
                                           >

                                          <div style="clear:both"></div>
                                          <div style="margin:10px 0"></div>
                                          <input type="number" min="1" value = '<?php echo $numbers[4]?$numbers[4]:21 ?>' name="number[]"  required  style="width:60px;margin-left:63px;float:left"><span style="float:left">-</span>
                                          <input type="number" min="1" value = '<?php echo $numbers[5]?$numbers[5]:35 ?>' name="number[]"  required  style="width:60px;float:left"><span style="float:left">天</span>
                                          <input type="hidden" name="acq_broker[]" required id="channel_manager_id4" class="span6 select2" style="width:220px"
                                                  value="<?php echo $acq_brokers[4];?>"  title="<?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[4]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>"
                                          >
                                          <input type="hidden" name="acq_broker[]" required id="channel_manager_id5" class="span6 select2" style="width:220px"
                                                  value="<?php echo $acq_brokers[5];?>"  title="<?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[5]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>"
                                           >

                                          <div style="clear:both" ></div>
                                          <div style="margin:10px 0"></div>
                                          <input type="number" min="1" value = '<?php echo $numbers[6]?$numbers[6]:36 ?>'  name="number[]" id="number[]" required  style="width:60px;margin-left:60px;float:left"><span style="float:left">-</span>
                                          <input type="number" min="1" value = '<?php echo $numbers[7]?$numbers[7]:199 ?>' name="number[]" id="number[]" required  style="width:60px;float:left"><span style="float:left">天</span>
                                          <input type="hidden" name="acq_broker[]" required id="channel_manager_id6" class="span6 select2" style="width:220px"
                                                  value="<?php echo $acq_brokers[6];?>"  title="<?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[6]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>"
                                          >
                                          <input type="hidden" name="acq_broker[]" required id="channel_manager_id7" class="span6 select2" style="width:220px"
                                                  value="<?php echo $acq_brokers[7];?>"  title="<?php
                                                  $goods = UrsGoodsStorage::model()->find("id = '$acq_brokers[7]'");
                                                  echo $goods['goods_name'].'('.$goods['goods_unit'].')';
                                                ?>"
                                          >
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
                                                  $("#channel_manager_id").select2({
                                                      placeholder: "",
                                                      minimumInputLength: 1,
                                                      ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                                          url: "/admin/ursproperty/ajaxlists",
                                                          dataType: 'json',
                                                          data: function (term, page) {
                                                              return {
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
                                                              $.ajax("/admin/ursproperty/ajaxitem", {
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
                                                  $("#channel_manager_id1").select2({
                                                      placeholder: "",
                                                      minimumInputLength: 1,
                                                      ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                                          url: "/admin/ursproperty/ajaxlists",
                                                          dataType: 'json',
                                                          data: function (term, page) {
                                                              return {
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
                                                              $.ajax("/admin/ursproperty/ajaxitem", {
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
                                                  $("#channel_manager_id2").select2({
                                                      placeholder: "",
                                                      minimumInputLength: 1,
                                                      ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                                          url: "/admin/ursproperty/ajaxlists",
                                                          dataType: 'json',
                                                          data: function (term, page) {
                                                              return {
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
                                                              $.ajax("/admin/ursproperty/ajaxitem", {
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
                                                  $("#channel_manager_id3").select2({
                                                      placeholder: "",
                                                      minimumInputLength: 1,
                                                      ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                                          url: "/admin/ursproperty/ajaxlists",
                                                          dataType: 'json',
                                                          data: function (term, page) {
                                                              return {
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
                                                              $.ajax("/admin/ursproperty/ajaxitem", {
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
                                                  $("#channel_manager_id4").select2({
                                                      placeholder: "",
                                                      minimumInputLength: 1,
                                                      ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                                          url: "/admin/ursproperty/ajaxlists",
                                                          dataType: 'json',
                                                          data: function (term, page) {
                                                              return {
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
                                                              $.ajax("/admin/ursproperty/ajaxitem", {
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
                                                  $("#channel_manager_id5").select2({
                                                      placeholder: "",
                                                      minimumInputLength: 1,
                                                      ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                                          url: "/admin/ursproperty/ajaxlists",
                                                          dataType: 'json',
                                                          data: function (term, page) {
                                                              return {
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
                                                              $.ajax("/admin/ursproperty/ajaxitem", {
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
                                                  $("#channel_manager_id6").select2({
                                                      placeholder: "",
                                                      minimumInputLength: 1,
                                                      ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                                          url: "/admin/ursproperty/ajaxlists",
                                                          dataType: 'json',
                                                          data: function (term, page) {
                                                              return {
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
                                                              $.ajax("/admin/ursproperty/ajaxitem", {
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
                                                  $("#channel_manager_id7").select2({
                                                      placeholder: "",
                                                      minimumInputLength: 1,
                                                      ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                                                          url: "/admin/ursproperty/ajaxlists",
                                                          dataType: 'json',
                                                          data: function (term, page) {
                                                              return {
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
                                                              $.ajax("/admin/ursproperty/ajaxitem", {
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
                                          <div style="clear:both" class="add_type"></div>
                                          <div style="margin:10px 0"></div>
                                        </div>
                                      </div>
                                      <div style="margin-left:250px;margin-top:25px;">
                                        <button  type="submit" class="btn btn-primary">确定</button>
                                        <button type="button" style="border-radius:0!important;" onclick="javascript:history.go(-1)">取消</button>
                                      </div>
                                      <div class="control-group" id="closemodels" >
                                                       ×
                                       </div>
                                </form>

                            </div>
                        <!-- END VALIDATION STATES-->
                      </div>

                    </div>

                </div>
                <!-- END PAGE CONTENT-->

            </div>
            <!-- END PAGE CONTAINER-->
        </div>

<style>
    .theFont{font-size: 20px;}
</style>

  <script type="text/javascript">
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
    <script type="text/javascript">
    $(".addqudao").live('click',function(){

         var qudao = $("#qudao").clone();

         qudao.removeAttr('id');
         qudao.show();
       var num = $(".addqudao").length;
       // qudao.find("#channel_manager_id").attr('id','channel_manager_id'+num)
       $("#qudaorenyuan").append(qudao);
       $("#qudaorenyuan").find(".addqudao").remove();
       $("#qudaorenyuan").find(".delqudao").show();
        })

        $(".delqudao").live('click',function(){
           $(this).parent().remove();
        })
    </script>
