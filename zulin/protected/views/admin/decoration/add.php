<style>	
	.modal-body{font-size:18px;text-indent: 20px;}
	#modal-label{text-align:center;font-size:22px;}
	#about-modal{width:300px;height:150px;position:absolute;margin-left:-150px;margin-top:200px;left:50%;right:50%;}
	#left{background:#167bcd;color:#fff;margin-right:10px;}
	#left:hover{background:#0160cb!important;}
	#table input{border:0 none!important;color:#222;font-weight:bold;text-align:center;}
	#table{margin-left:-70px;}
  #table,#testtr{overflow:auto!important;}
   #table .yj-title-th th input{width:150px!important;}
    #table .testtd td input{width:150px!important;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/validation/quality_decoration.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/quality_decoration.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/form_validation.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  // Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/components/admin-usr-property.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    FormComponents.init();
    FormValidation.init();
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
    <!-- END PAGE HEADER-->
    <!-- BEGIN PAGE CONTENT-->
    <div class="row-fluid">
      <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box light-grey">
          <div class="portlet-title">
            <div class="caption"><i class="icon-reorder"></i>装修管理-添加预算单信息</div>
            <div class="tools">
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
              <div class="row-fluid">            	
                <div style="margin-left:40px;margin-bottom:500px;">
                  <form  action="/admin/decoration/AddSave" style="margin:0;height:120px;margin-top:30px;" id="form_add"  method="post"  class="form-horizontal js-submit">
                    <div class="alert alert-error hide">
                      <button class="close" data-dismiss="alert"></button>
                      输入格式有误，请检查输入的数据.
                    </div>
                    <div class="alert alert-success hide">
                      <button class="close" data-dismiss="alert"></button>
                      数据输入验证成功!
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:20px;">
                      <span  style="margin-left:48px;">
                        录入人：<?php $creater_id=Yii::app()->session['admin_uid']; $item = AdminUser::model()->find("id = '$creater_id'"); echo  $item?$item->nickname:''; ?>
                      </span>                                                               
                    </div>
                    <div id="propertys">
                      <div class="dataTables_filter" style="margin-bottom:20px;">
                        <span style="margin-left:58px;">
                          品牌<span style="color:red;">* </span><input type="hidden" name="estate_id[]" id="estate_id" class="select2" required style="width:210px">
                        </span>
                        <span>
                          系列<span style="color:red;">* </span><input type="hidden" name="building_id[]" id="building_id" class="select2" required style="width:210px">
                        </span>
                        <span>
                          编号<span style="color:red;">* </span><input type="hidden" name="room_number[]" id="room_number" class="select2" required style="width:210px">
                                  <input type="hidden" name="property_id[]" id="property_id">
                        </span> 
                        <span>
                          建筑总面积<span style="color:red;">* </span><input name="sum_area" id="sum_area" readonly=true type="text" style="width:200px !important" placeholder="单位：㎡" class="m-wrap"/><span class="radio">㎡</span>
                        </span>                                         
                      </div>
                    </div>  
                    <div class="control-group">
                      <div class="controls">
                        <button id='add_property' type="button" class="btn btn-primary">添加车源</button>
                        <button id='del_property' type="button" class="btn red">删除车源</button>
                      </div>
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span style="margin-left:38px;">
                        工程工长：<input type="text" maxlength="5" value="" name="foreman"  class="m-wrap">
                      </span>
                      <span>
                        工程管理部人员：<input type="text"  value=""  name="supervisor" id="supervisor" class="select2" style="width:220px">
                      </span>
                      <span>
                        施工管理部人员：<input type="text"  value="" id="docking_people" name="docking_people" class="select2" style="width:220px">
                      </span>                                          
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span style="line-height:33px;">整体工程起止日：<input type="text" id="datepicker" value="" class="m-wrap" name="project_start_time"/>&nbsp;至&nbsp;<input type="text" id="datepicker1" value="" class="m-wrap" name="project_end_time"/></span>
	                    <span style="line-height:33px;">施工管理部与工程对接方案日期：<input type="text" id="datepicker2" value="" class="m-wrap" name="docking_date" /></span>                                   
                    </div>
                    <div class="dataTables_filter" style="margin-bottom:3px;">
                      <span style="margin-left:38px;">
                        上传附件：
                      </span>                                       
                    </div>
                    <!-- 上传附件 -->
                    <div class="dataTables_filter">
                      <div class="control-group">
                        <div class="controls" style="margin-top:10px;">
                          <span style="float:left;">
                            <input type="hidden" name="attachment_photo" />
                            <span id="PlaceHolder_attachment_photo"></span>
                          </span>
                          <span>
                            <input type="button" class="btn red" value="删除附件" style="height:30px!important;">
                          </span>
                        </div>
                      </div>
                      <div class="control-group" style="margin:0;">
                        <div class="controls">
                            <div class="upload_progress">
                              <span class="localname"></span>
                            </div>
                            <div class="fieldset flash" id="fsUploadProgress_attachment_photo">
                              <span class="legend"></span>
                            </div>
                            <div id="attachment_photo_div" style="float:left;100%;height:110px;display: none;">
                              <input type="text" name="attachment_photo_show[]" src="" style='display:none;float:left;margin-left:10px'/>
                              <span><input type="text" name="attachment_photo_show[]" disabled=true value="" style='display:none;margin-left:10px' /></span>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!--上传附件结束 -->
                    <!-- 上传CAD图片 -->
                    <div class="dataTables_filter">
                      <div class="control-group">
                          <div class="controls" style="margin-top:10px;">
                            <span style="float:left;">
                                <input type="hidden" name="list_photo" />
                                <span id="PlaceHolder_list_photo"></span>
                            </span>
                            <span>
                              <input type="button" class="btn red" value="编辑图片" style="height:30px!important;">
                            </span>
                          </div>
                      </div>
                      <div class="control-group" style="margin:0;">
                          <div class="controls">
                              <div class="upload_progress">
                                  <span class="localname"></span>
                              </div>
                              <div class="fieldset flash" id="fsUploadProgress_list_photo">
                                  <span class="legend"></span>
                              </div>
                              <div id="list_photo_div" style="float:left;100%;height:130px;display: none;">
                                  <img name="list_photo_show" src="" style='display:none;max-width:100px;max-height:100px;float:left;margin-left:10px'/>
                              </div>
                          </div>
                      </div>
                    </div>
                    <!-- 上传CAD图片结束 -->
   
                    <div class="btn-group pull-left">  
                      <h4>价格预算</h4>
                    </div> 
                    <!-- 上传价格预算扫描件 -->
                    <div class="dataTables_filter" style="clear:both;">
                      <div class="control-group">
                        <div class="controls" style="margin-top:20px;">
                          <span style="float:left;">
                              <input type="hidden" name="budget_photo" />
                              <span id="PlaceHolder_budget_photo"></span>
                          </span>
                          <span>
                            <input type="button" class="btn red" value="编辑图片" style="height:30px!important;">
                          </span>
                        </div>
                      </div>
                      <div class="control-group" style="margin:0;">
                        <div class="controls">
                            <div class="upload_progress">
                                <span class="localname"></span>
                            </div>
                            <div class="fieldset flash" id="fsUploadProgress_budget_photo">
                                <span class="legend"></span>
                            </div>
                            <div id="budget_photo_div" style="float:left;100%;height:130px;display: none;">
                                <img name="budget_photo_show" src="" style='display:none;max-width:100px;max-height:120px;float:left;margin-left:10px'/>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- 上传价格预算扫描件 -->
                    <div class="dataTables_filter" style="margin-bottom:30px;">
                      <span>注明：若工期延期，按照延期天数，视情节轻重给予工长500--1000元/天处罚。若装修材料规格及品牌未按照公司规定标准与上述报表不符有弄虚作行为，则视情节轻重给予工长5000--50000元处罚，并承担因工程施工质量及材料质量问题所造成的一切后续安全责任。若工长在工程装修报价时漏项，则按照漏项部分总金额的50%给予工长处罚，若情况特别严重者，将给予总工程款的50%给予处罚。（如有特殊情况需幼狮装饰总经理签字，方可降低处罚或避免处罚。）</span>
                    </div> 
                    <div class="span8">
  	                  <div class="btn-group pull-right">	
  	                    <button id="add" class="btn btn-primary" type="button" style="float:right">
  	                        新增<i class="icon-plus"></i>
  	                    </button>
  	                  </div> 
                      <table class="table table-striped table-bordered table-hover" id="table" style='float:left;'><!-- ID sample_1目前没用,js中控制显示效果 -->
                 			  <thead >
    			                <tr class="yj-title-th">
            			          <th><input type="text" value="序号"></th>
            								<th><input type="text" value="施工清单及材料"></th>
            								<th><input type="text" value="单位"></th>
            								<th><input type="text" value="材料规格及品牌"></th>
            								<th><input type="text" value="数量"></th>
            								<th><input type="text" value="单价"></th>
            								<th><input type="text" value="预算合计"></th>
    			                </tr>
                 			  </thead>
    			              <tbody id="testtr">                       
    		                	<tr class="testtd">
    			                 	<td><input type="text"  class="xuhao" value="1"></td>
    			                 	<td><input type="text" maxlength="127" name="list_material[]"></td>
    			                 	<td><input type="text" maxlength="25"  name="unit[]"></td>
    			                 	<td><input type="text" maxlength="127" name="material_brands[]"></td>
    			                 	<td><input type="text" maxlength="7" onblur="check(this.value,this);" name="number[]"></td>
    			                 	<td><input type="text" maxlength="7" onblur="check(this.value,this);" name="unit_price[]"></td>
    			                 	<td><input type="text" maxlength="7" onblur="check(this.value,this);" name="total[]"></td>
    			               </tr>
    			              </tbody>
                		  </table>
                      <div class="form-actions" style="clear:both;margin-top:100px;text-align:center;">
                        <button type="submit" class="btn btn-primary submit js-btnadd">保存</button>
                        <button type="button" class="btn"  onclick="javascript:history.go(-1);">取消</button>
                      </div> 
                    </div>
                  </form> 
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
<!-- 隐藏的品牌系列编号 -->
<div style="display:none;clear:both;" class="select">
  <div class="dataTables_filter" style="margin-bottom:20px;">
    <span style="margin-left:58px;">
      品牌<span style="color:red;">* </span><input type="hidden" name="estate_id[]" id="estate_id" class="select2  estate" required style="width:210px">
    </span>
    <span>
      系列<span style="color:red;">* </span><input type="hidden" name="building_id[]" id="building_id" class="select2 building" required style="width:210px">
    </span>
    <span>
      编号<span style="color:red;">* </span><input type="hidden" name="room_number[]" id="room_number" class="select2 room" required style="width:210px">
              <input type="hidden" name="property_id[]" id="property_id">
    </span>                                         
  </div>
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
<script>
  // 品牌系列
  var nummore =$('.more');
  $("button[id='add_property']").live("click",function(e){
  mores =$('.select').clone();
  mores.removeClass('select');
  mores.show();
  mores.addClass('more');
  nummore =$('.more');
  mores.find("#area").attr('id','area'+nummore.length);
  mores.find("#room_type").attr('id','room_type'+nummore.length);
  mores.find("#property_id").attr('id','property_id'+nummore.length);

  //        mores.find("input[name='estate_id']").attr('name','estate_id'+nummore.length);
  //        mores.find("input[name='area']").attr('name','area'+nummore.length);
  //        mores.find("input[name='property_id']").attr('name','property_id'+nummore.length);
  //        mores.find("input[name='room_type']").attr('name','room_type'+nummore.length);
  $('#propertys').append(mores);
  handleSelectEstate();
  handleSelectBuilding();
  handleSelectHouseNo();

  });
  $("button[id='del_property']").live('click',function(){
  var delmore = $('.more');
  $('.more').eq(delmore.length-1).remove();
  if(delmore.length==0){
  alert('最后一个车源不能删除');
  }
  })
var handleSelectEstate = function () {
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
// $.ajax("/admin/ajax/getbuilding", {
//     data: {
//         id:movie.id
//     },
//     dataType: "json"
// }).done(function (data) {
//     var options="";
//     if(data.length>0){
//         options+="<option value=''></option>";
//         for(var i=0;i<data.length;i++){
//             if ($("select[name='building_id']").val()==data[i].id){
//                 options+="<option selected value="+data[i].id+">"+data[i].title+"</option>";
//             }
//             else{
//                 options+="<option value="+data[i].id+">"+data[i].title+"</option>";
//             }

//         }
//         $("select[name='building_id']").html(options);
//     }
// });
//$("#building_id").val("");
/*  $("#building_id").select2("val", "");
$("#room_number").select2("val", "");
$("input[name='area']").val(""); */
return movie.title;
}

mores.find('.estate').select2({
placeholder: "",
minimumInputLength: 1,
ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
url: "/admin/estate/ajaxlist",
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
var id=element.val();
var title=element.attr("title");
if(id!=''&&title!=""){
    callback({id:id,title:title});
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

var handleSelectBuilding = function () {
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
// $.ajax("/admin/ajax/getbuilding", {
//     data: {
//         id:movie.id
//     },
//     dataType: "json"
// }).done(function (data) {
//     var options="";
//     if(data.length>0){
//         options+="<option value=''></option>";
//         for(var i=0;i<data.length;i++){
//             if ($("select[name='house_no']").val()==data[i].id){
//                 options+="<option selected value="+data[i].id+">"+data[i].title+"</option>";
//             }
//             else{
//                 options+="<option value="+data[i].id+">"+data[i].title+"</option>";
//             }

//         }
//         $("select[name='house_no']").html(options);
//     }
// });
/*   $("#room_number").select2("val", "");
$("input[name='area']").val(""); */
return movie.title;
}

mores.find('.building').select2({
placeholder: "",
minimumInputLength: 1,
ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
url: "/admin/building/ajaxlistbyestateid",
dataType: 'json',
data: function (term, page) {
    return {
        q: term, // search term
        estate_id:$("#estate_id").val(),
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
var id=element.val();
var title=element.attr("title");
if(id!=''&&title!=""){
     callback({id:id,title:title});
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

var handleSelectHouseNo = function () {
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

$.ajax("/admin/property/ajaxlistbyid", {
data: {
    id:movie.id
},
dataType: "json"
}).done(function (data) {
//求面积总和
var value=document.getElementById("sum_area").value;
var sum_area=parseFloat(data.area)+parseFloat(value);
$("#sum_area").val(sum_area);
// $("#area"+nummore.length).val(data.area);
$("#property_id"+nummore.length).val(data.property_id);
});

return movie.title;
}

mores.find('.room').select2({
placeholder: "",
minimumInputLength: 1,
ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
url: "/admin/property/ajaxlistbybuildingid",
dataType: 'json',
data: function (term, page) {
    return {
        q: term, // search term
        building_id:$("#building_id").val(),
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
var id=element.val();
var title=element.attr("title");
if(id!=''&&title!=""){
     callback({id:id,title:title});
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

  //日期
  var picker = new Pikaday({
    field: document.getElementById('datepicker'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  }); 

  var picker = new Pikaday({
    field: document.getElementById('datepicker1'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
  var picker = new Pikaday({
    field: document.getElementById('datepicker2'),
    firstDay: 1,
    minDate: new Date('2010-01-01'),
    maxDate: new Date('2030-12-31'),
    yearRange: [2000,2030]
  });
</script>

<!-- 图片 -->
<style>
    .theFont{font-size: 20px;}
</style>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.queue.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/fileprogress.js"></script>
<script charset="utf-8" src="<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/handlers_news.js"></script>
<script>
var swf_list_photo;
var swf_budget_photo;
var swf_attachment_photo;
window.onload = function() {
    // 上传上传CAD图
    var settings_list_photo = {
        flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
        upload_url: "/upload/avatar", //pdf
        file_post_name:"filename",
        post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
        file_size_limit : "2 MB",
        file_types : "*.jpg;*.jpeg;*.png",
        file_types_description : "图片文件",
        file_upload_limit : 0,
        file_queue_limit : 0,
        custom_settings : {
            progressTarget : "fsUploadProgress_list_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_list_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">添加CAD图</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 10,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_list_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_list_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_list_photo = new SWFUpload(settings_list_photo);
    // 上传上传预算扫描件
    var settings_budget_photo = {
        flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
        upload_url: "/upload/avatar", //pdf
        file_post_name:"filename",
        post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
        file_size_limit : "2 MB",
        file_types : "*.jpg;*.jpeg;*.png",
        file_types_description : "图片文件",
        file_upload_limit : 0,
        file_queue_limit : 0,
        custom_settings : {
            progressTarget : "fsUploadProgress_budget_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_budget_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">添加扫描件</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 10,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_budget_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_budget_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_budget_photo = new SWFUpload(settings_budget_photo);

    //上传附件
    var settings_attachment_photo = {
        flash_url : "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/swfupload.swf",
        upload_url: "/upload/avatar", //pdf
        file_post_name:"filename",
        post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
        file_size_limit : "2 MB",
        file_types : ".dwg",
        file_types_description : "图片文件",
        file_upload_limit : 0,
        file_queue_limit : 0,
        custom_settings : {
            progressTarget : "fsUploadProgress_attachment_photo",
            cancelButtonId : "btnCancel"
        },
        debug: false,
// Button settings
        button_image_url: "<?php echo Yii::app()->request->baseUrl; ?>/css/swfupload/btn_upload1.png",
        button_width: "200",
        button_height: "30",
        button_placeholder_id: "PlaceHolder_attachment_photo",
        button_window_mode : SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_disabled : false,

        button_text: '<span class="theFont">上传附件</span>',
        button_text_style: ".theFont { font-size: 14; color:#ffffff; }",
        button_text_left_padding: 10,
        button_text_top_padding: 6,

// The event handler functions are defined in handlers.js
        file_queued_handler : fileQueued_attachment_photo,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        upload_success_handler : uploadSuccess_attachment_photo,
        upload_complete_handler : uploadComplete,
        queue_complete_handler : queueComplete  // Queue plugin event
    };

    swf_attachment_photo = new SWFUpload(settings_attachment_photo);
                            
};
function uploadSuccess_list_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;

//        document.getElementsByName("list_photo_show")[0].src=file_url;
    var oo = document.getElementsByName("list_photo_show")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("src",file_url);
    $("#list_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
    document.getElementsByName("list_photo")[0].value=document.getElementsByName("list_photo")[0].value+','+file_url;
    $("#list_photo_div").show();
}

function fileQueued_list_photo(file){

    var stats = swf_list_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}

function uploadSuccess_budget_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;

//        document.getElementsByName("budget_photo_show")[0].src=file_url;
    var oo = document.getElementsByName("budget_photo_show")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("src",file_url);
    $("#budget_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');$(new_img).wrap('<a target="_Blank" href="' + file_url + '" ></a>');
    document.getElementsByName("budget_photo")[0].value=document.getElementsByName("budget_photo")[0].value+','+file_url;
    $("#budget_photo_div").show();
}

function fileQueued_budget_photo(file){

    var stats = swf_budget_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}
//上传附件
function uploadSuccess_attachment_photo(fileObj, server_data){
    $(".progressWrapper").hide();
    var json=JSON.parse(server_data);
    if (json.code==0)
    {
        alert(json.message);
        return;
    }
    var old_file_name=json.data.old_file_name;
    var file_name=json.data.file_name;
    var file_url=json.data.file_url;
    var oo = document.getElementsByName("attachment_photo_show[]")[0];
    var new_img = $(oo).clone();
    $(new_img).show();
    $(new_img).attr("value",old_file_name);
    $("#attachment_photo_div").append(new_img);
    $(new_img).after('<img src="/css/image/delete.jpg" class="del_photo" width="25px;" style="float:left; display:none;" alt="" />');
    document.getElementsByName("attachment_photo")[0].value=document.getElementsByName("attachment_photo")[0].value+','+file_url;
    $("#attachment_photo_div").show();
}

function fileQueued_attachment_photo(file){

    var stats = swf_attachment_photo.getStats();
    stats.successful_uploads--;
    this.setStats(stats);
// document.getElementById("fsUploadProgress2").innerHTML = "<span class='egend'></span>";
}
</script>
<!-- 图片删除 -->
<script>
    $(function(){
        $('.red').live('click',function(){
            $(this).parent().parent().parent().next().find('.del_photo').show();
            $('.del_photo').click(function(){
                var del_photo_url = $(this).prev().children().attr('src');
                var dataStr = $(this).parent().parent().parent().prev().find("input[type='hidden']").val();
                var dataStrArr=dataStr.split(",");
                var newarr =[] ;
                for (var i = dataStrArr.length - 1; i >= 0; i--) {
                   if(dataStrArr[i]!=del_photo_url&&dataStrArr[i]!=''){
                        newarr.push(dataStrArr[i]);
                   }
                }
                var str = newarr.join(',');
                str=str.substr(0,str.length);
                $(this).parent().parent().parent().prev().find("input[type='hidden']").val(','+str);
                $(this).prev().remove();
                $(this).remove();
            })
        })
    })
</script>       
<script>
$(function(){
  var i=1;
  $("#add").click(function(){
    i++;
    $("#testtr").append($('.testtd').eq(0).clone()).find('tr').last().find('input').val('');
    $(".xuhao").last().val(i);
  })
})
</script>