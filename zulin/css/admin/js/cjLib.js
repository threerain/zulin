
    /*
    表单验证，基于jQuery
    data-url
    data-check 规则，是一个数组格式 [{p:'正则匹配',tip:'错误提示'},{},{}]
    */

    var cjForm ={
        
        /*对多个元素进行验证*/
        checkInputs : function(els,callback){
    			var r = true;
                var ob = this;
                callback = callback || function(){};

    			els.each(function(){
                    var el=$(this);
                    if(!ob.inputCheck(el,callback))
                    {
                        r=false;
                    }
                    ob.inputTipsShow(el);
    			});
    			
    			return r;
    	    },
        /*对多个元素进行验证事件绑定*/
        inputAction : function(els){        
    			var ob = this;
    			els.each(function(){
                    var el=$(this);
                   
                    el.focus(function(){
                        ob.inputTipsHide(el);
                    });
                    el.blur(function(){
                        ob.inputCheck(el);
                        ob.inputTipsShow(el);
                    });
    			});
    	    },
        /*对单独一个input进行验证*/
        inputCheck : function(el,callback){
                        var c = el.attr("data-check"),  r = true;
                        callback = callback || function(){};
                        if(!c) return r;
                        var v = $.trim(el.val());
                        var fd; 
                        eval("c = "+c);
                        if(!$.isArray(c)){c=[c];}
                        
                        var _this=this;                    
                        
                        for(i in c)
                        {                        
                            if(c[i].p && c[i].tip)
                            {
                                if(c[i].p && !c[i].p.test(v)){
                                    r = false;
                                    break;
                                }
                            }
                            else if(c[i].u)
                            {
                               
                                var url = c[i].u;
                                _this.inputTips(el, "loading");
                                
                                $.ajax({
                                    type: "GET",
                                    url: url+v,
                                    dataType: "json",
                                    success:function(data){
                                        //alert(data);
                                        if(data.status==1)
                                        {
                                            _this.inputTips(el, "success");
                                            callback();
                                        }
                                        else
                                        {
                                            _this.inputTips(el, "error", c[i].tip);
                                        }
                                    },
                                    error:function(XmlHttpRequest,textStatus, errorThrown)
                                    {
                                        alert("保存失败;"+XmlHttpRequest.responseText);
                                    }
                                });
                                
                                return false;                            
                            }
                        }
                       
                        if(r) {
                                this.inputTips(el, "success");
                                
                        }else{
                                this.inputTips(el, "error", c[i].tip);
                        }
                        return r;
                },
        /*提示信息*/
        inputTips : function(el, type, text){
                text = text || "";
                if(!el) return;
                var objMsg;
                if(el.siblings(".input-tips").length>0){
                    objMsg = $(el.siblings(".input-tips")[0]);
                    objMsg.removeClass().addClass("input-tips input-tips-"+type);
                    objMsg.html('<i>&lt;</i>'+text);                            
                }
                else{
                    objMsg = el.after('<em class="input-tips input-tips-'+type+'"><i>&lt;</i>'+text+'</em>');
                }
                el.css("float","left");
                objMsg.css("margin-top",el.css)

    	    },
        inputTipsShow:function(el){
                var objMsg;
                if(el.siblings(".input-tips").length>0){
                    objMsg = $(el.siblings(".input-tips")[0]);
                    objMsg.show();
                }
            },
        inputTipsHide:function(el){
                var objMsg;
                if(el.siblings(".input-tips").length>0){
                    objMsg = $(el.siblings(".input-tips")[0]);
                    objMsg.hide();
                }
            } 
        
    }

    var cjWindow = {
        success:function(msg){        
            this.lock();
            //alert(msg);
            //this.unlock();
            
            var cjWindow_success = $(".cjwindow_success");
            if(cjWindow_success.length==0){
                $("body").append("<div class='cjwindow_success'><i></i></div>");
                cjWindow_success = $(".cjwindow_success");
            }
            
            var bH=$("body").height();
            var bW=$("body").width();
        
            cjWindow_success.css("top", (($(window).height() - cjWindow_success.outerHeight()) / 2) + $(window).scrollTop() + "px");
            cjWindow_success.css("left", (($(window).width() - cjWindow_success.outerWidth()) / 2) + $(window).scrollLeft() + "px");
        
            cjWindow_success.append('<em>'+msg+'</em>');
            
        },
        successClose:function(){
            var cjWindow_success = $(".cjwindow_success");
            if(cjWindow_success.length>0){
                cjWindow_success.remove();
            }
            this.unlock();
        },    
        lock:function(){
            var maskWin = $(".maskWin");
            if(maskWin.length==0){
                $("body").append("<div class='maskWin'></div>");
                maskWin = $(".maskWin");
            }
            var bH=$(document).height();
            var bW=$("body").width();
            maskWin.css({width:bW,height:bH});
            maskWin.show();
        },
        unlock:function(){
            var maskWin = $(".maskWin");
            if(maskWin.length>0){
               $(".maskWin").remove();
            }
        },
        
        confirm:function(msg){        
            return confirm(msg);
            
        }
    }



    /**
    提交表单
    @formName 表单的id
    */

    function ajaxSubmitForm(){
        //console.log(arguments);

        var formname = arguments[0];
        var btn_submit_class = ".js-btnadd";

        if(arguments[1]!=undefined){
            btn_submit_class = arguments[1];
        }

        cjForm.inputAction($("#"+formname+" :input"));
        $("#"+formname+" "+btn_submit_class).click(function(e){
            e.preventDefault();        
            var _form = $("#"+formname);
            var r = true;
            var _btnadd = $(this);
            
            r= cjForm.checkInputs($("#"+formname+" :input"));  //r= cjForm.checkInputs($("#"+formname+" input[type=text]"));
            if(r)
            {

                //cjWindow.success("正在处理中...");
                cjForm.inputTipsHide(_btnadd);
                //setTimeout(function(){_form.submit();},2000);
                //_btnadd.
                cjForm.inputTips(_btnadd,'process',"正在处理中");
                setTimeout(function(){
                    $.post(_form.attr("action"), _form.serialize(),function(data){
                            //cjWindow.successClose();
                            cjForm.inputTipsShow(_btnadd);
                            if(data.code==301){
                                cjForm.inputTips(_btnadd,'success',data.msg);
                                location.href = data.data;
                            }
                            else if(data.code!=200){ 
                                cjForm.inputTips(_btnadd,'error',data.msg);
                            }
                            else
                            {
                                cjForm.inputTips(_btnadd,'success',data.msg);
                                _btnadd.attr('disabled', 'disabled');
                            }       
                        },'json')
                        .fail(function() {
                            //cjWindow.successClose();
                            cjForm.inputTips(_btnadd,'error','发生错误，请重试');
                          });
                    },2000);
            }
            
        });
    }

    //删除
    function ajaxConfirmUrl(){

        $("a.js-delete,a.js-confirm").bind("click",function(e){
            e.preventDefault();
            var thisobj = $(this);
            var href    = thisobj.attr("href");
            var tips=thisobj.attr("data-tip");
            if(tips==undefined || tips==""){
                tips="确定要进行此操作吗？";
            }
            /*
            jConfirmFull("确定要进行此操作吗？","title",function(confirm){
               if(confirm)
               {
                    location.href = href;
               }               
            }); 
    */

            $.layer({
                
                shade: [0.5, '#000'],
                area: ['auto','auto'],
                dialog: {
                    msg: tips,
                    btns: 2,                    
                    type: 10,
                   
                    yes: function(){
                        //layer.msg('重要', 1, 1);
                        $.get(href, function(data){
                            if(data && data.code==200){

                                layer.msg(data.msg,2,{type:1},function(){
                                    location.href=location.href;
                                });
                            }
                            else{
                                if(data.msg){
                                    layer.msg(data.msg);
                                }
                                else{
                                    layer.msg("发生错误，请重试");
                                }
                            }
                        }
                        ,
                        "json"
                        );

                    }, no: function(){
                        //layer.msg('奇葩', 1, 13);
                    }
                }
            });




        });

    }



    //
    function ajaxOpenurl(){

        $(".js-openurl").click(function(e){
            e.preventDefault();
            var url = $(this).attr("href");
            var width_big = ($(window).width() - 200) +'px',
                height_big = ($(window).height() - 50) +'px',
                width_middle = ($(window).width() - 400) +'px',
                height_middle = ($(window).height() - 100) +'px',
                width_small = '600px',
                height_small = '320px';

            var width  = width_middle,
                height = height_middle;

            if($(this).hasClass("js-openurl-big")){
                width  = width_big,
                height = height_big;
            }
            else if($(this).hasClass("js-openurl-small")){
                width  = width_small,
                height = height_small;
            }

            $.layer({
                type: 2,
                shadeClose: true,
                title: false,
                closeBtn: [1, true],
                shade: [0.5, '#000'],
                border: [0],
                move: '.move',
                moveType:0 ,           
                area: [width, height],
                iframe: {src: url,scrolling: 'auto'}
            }); 
        });

    }