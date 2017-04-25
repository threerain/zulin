<style>
#jqaddlink{display:none!important;}
[class^="icon-"], [class*=" icon-"]{width:auto!important;}
.tree li span{text-indent:0px!important;}
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
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/css/admin/js/table-managed.js',CClientScript::POS_END);
  Yii::app()->clientScript->registerScript("","
    App.init();
    TableManaged.init();");
?>

<link rel="stylesheet" type="text/css" href="/css/admin/treestyle.css">
<script type="text/javascript" src="/css/admin/js/jquery-1.7.2.min.js"></script>  
  <!-- End PAGE LEVEL SCRIPTS -->

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

            <div class="caption"><i class="icon-globe"></i>部门列表</div>
            <div class="tools">
<!--               <a href="javascript:;" class="collapse"></a>
              <a href="#portlet-config" data-toggle="modal" class="config"></a>
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a> -->
            </div>
          </div>
          <div class="portlet-body">
            <div id="sample_1_wrapper" class="dataTables_wrapper form-inline" role="grid">
                  <div class="btn-group pull-right">
                    <?php if(AdminPositionModul::has_modul("002_04")) {?>
                      <div class="btn-group pull-right">
                        <a href="/admin/department/add">
                          <button id="sample_editable_1" class="btn btn-primary">
                          新建 <i class="icon-plus"></i>
                          </button>
                        </a>
                      </div>
                    <?php }?>
                  </div>
              <div class="row-fluid">
            
                <div class="tree well">

                    <ul id="rootUL">

                    </ul>
                </div>
              </div>



              <div class="row-fluid">
                <div class="span4">
                  <div class="dataTables_info" id="sample_1_info"></div>
                </div>

                <div class="modal fade" id="about-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" id="modal-label">本站点提示...</h4>
                          </div>
                          <div class="modal-body">
                              <p>确定要删除吗?</p>
                          </div>
                          <div class="modal-footer">
                               <a id="left" class="btn btn-primary" href="" onclick="javascript:return true;">确定</a>
                               <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
                          </div>
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
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-label">本站点提示...</h4>
                </div>
                <div class="modal-body">
                    <p>确定要删除吗?</p>
                </div>
                <div class="modal-footer">
                     <a id="left" class="btn btn-primary"  href="" onclick="javascript:return true;">确定</a>

                     <a type="button" class="btn btn-default" data-dismiss="modal">取消</a>
                </div>
            </div>
      </div>
</div>
<style>
</style>

<script>
  $(function () {

    var json='';
    $.post('/admin/department/test',function(msg){
      json = eval(msg)  ;
      tree(json) ;
      $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', '关闭');
      $('.tree li.parent_li > span').on('click', function (e) {
          var children = $(this).parent('li.parent_li').find(' > ul > li');
          if (children.is(":visible")) {
              children.hide('fast');
              $(this).attr('title', '展开').find(' > i').addClass('icon-pencil-sign').removeClass('icon-minus-sign');
          } else {
              children.show('fast');
              $(this).attr('title', '关闭').find(' > i').addClass('icon-minus-sign').removeClass('icon-pencil-sign');
          }
          e.stopPropagation();
      });

      $(".action1").hide();

      $(".cz").click(function(){
        $(this).parent('a').siblings('a').toggle();
      })

    $(".del_contract").click(function(){
      $("#left").attr('href',$(this).attr('address'));
    })
  })



    function tree(data) {

        for (var i = 0; i < data.length; i++) {
            var data2 = data[i];
            if (data[i].icon == "icon-th") {
                $("#rootUL").append("<li data-name='" + data[i].code + "'><span><i class='" + data[i].icon + "'></i> " + data[i].name + "</span><a><i class='icon-pencil cz'></i></a><a class='action1 show1' href='/admin/department/sub/id/"+data[i].code +"'>添加子部门</a><a class='action1 show1' href='/admin/department/edit/id/"+data[i].code +"'>编辑</a><a target='_blank' class='action1 show1' href='/admin/admin/index/department_id/"+data[i].code +"'>查看部门人员</a><a class='del_contract action1 show1' data-toggle='modal' data-target='#about-modal' href=''  address ='/admin/department/delete/id/"+data[i].code +"'>删除</a></li>");
            } else {
                var children = $("li[data-name='" + data[i].parentCode + "']").children("ul");
                if (children.length == 0) {
                    $("li[data-name='" + data[i].parentCode + "']").append("<ul></ul>")
                }
                $("li[data-name='" + data[i].parentCode + "'] > ul").append(
                    "<li data-name='" + data[i].code + "'>" +
                    "<span>" +
                    "<i class='" + data[i].icon + "'></i> " +
                    data[i].name +
                    "</span>" +
                    "<a><i class='icon-pencil cz'></i></a><a class='action1 show1' href='/admin/department/sub/id/"+ data[i].code +"'>添加子部门</a><a class='action1 show1' href='/admin/department/edit/id/"+data[i].code +"'>编辑</a><a target='_blank' class='action1 show1' href='/admin/admin/index/department_id/"+data[i].code +"'>查看部门人员</a><a class='del_contract action1 show1' data-toggle='modal' data-target='#about-modal' href=''  address ='/admin/department/delete/id/"+data[i].code +"'>删除</a></li>")
            }

            for (var j = 0; j < data[i].child.length; j++) {
                var child = data[i].child[j];
                var children = $("li[data-name='" + child.parentCode + "']").children("ul");
                if (children.length == 0) {
                    $("li[data-name='" + child.parentCode + "']").append("<ul></ul>")
                }
                $("li[data-name='" + child.parentCode + "'] > ul").append(
                    "<li data-name='" + child.code + "'>" +
                    "<span>" +
                    "<i class='" + child.icon + "'></i> " +
                    child.name +
                    "</span>" +
                    "<a><i class='icon-pencil cz'></i></a><a class='action1 show1' href='/admin/department/sub/id/"+child.code +"'>添加子部门</a><a class='action1 show1' href='/admin/department/edit/id/"+child.code +"'>编辑</a><a target='_blank' class='action1 show1' href='/admin/admin/index/department_id/"+child.code +"'>查看部门人员</a><a class='del_contract action1 show1' data-toggle='modal' data-target='#about-modal' href=''  address ='/admin/department/delete/id/"+child.code +"'>删除</a></li>")
                var child2 = data[i].child[j].child;
                tree(child2)
            }
            tree(data[i]);
        }
    }
  });
</script>

