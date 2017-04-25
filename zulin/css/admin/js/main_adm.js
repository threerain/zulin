// JavaScript Document
var sh=parseInt($(window).height());
var sw=parseInt($(window).width());

function initPlaceHolders(){
    if('placeholder' in document.createElement('input')){ //如果浏览器原生支持placeholder
        return ;
    }
    function target (e){
        var e=e||window.event;
        return e.target||e.srcElement;
    };
    function _getEmptyHintEl(el){
        var hintEl=el.hintEl;
        return hintEl && g(hintEl);
    };
    function blurFn(e){
        var el=target(e);
        if(!el || el.tagName !='INPUT' && el.tagName !='TEXTAREA') return;//IE下，onfocusin会在div等元素触发 
        var    emptyHintEl=el.__emptyHintEl;
        if(emptyHintEl){
            //clearTimeout(el.__placeholderTimer||0);
            //el.__placeholderTimer=setTimeout(function(){//在360浏览器下，autocomplete会先blur再change
                if(el.value) emptyHintEl.style.display='none';
                else emptyHintEl.style.display='';
            //},600);
        }
    };
    function focusFn(e){
        var el=target(e);
        if(!el || el.tagName !='INPUT' && el.tagName !='TEXTAREA') return;//IE下，onfocusin会在div等元素触发 
        var emptyHintEl=el.__emptyHintEl;
        if(emptyHintEl){
            //clearTimeout(el.__placeholderTimer||0);
            emptyHintEl.style.display='none';
        }
    };
    if(document.addEventListener){//ie
        document.addEventListener('focus',focusFn, true);
        document.addEventListener('blur', blurFn, true);
    }
    else{
        document.attachEvent('onfocusin',focusFn);
        document.attachEvent('onfocusout',blurFn);
    }

    var elss=[document.getElementsByTagName('input'),document.getElementsByTagName('textarea')];
    for(var n=0;n<2;n++){
        var els=elss[n];
        for(var i =0;i<els.length;i++){
            var el=els[i];
            var placeholder=el.getAttribute('placeholder'),
                emptyHintEl=el.__emptyHintEl;
            if(placeholder && !emptyHintEl){
                emptyHintEl=document.createElement('span');
                emptyHintEl.innerHTML=placeholder;
                emptyHintEl.className='emptyhint';
                emptyHintEl.onclick=function (el){return function(){try{el.focus();}catch(ex){}}}(el);
                if(el.value) emptyHintEl.style.display='none';
                el.parentNode.insertBefore(emptyHintEl,el);
                el.__emptyHintEl=emptyHintEl;
            }
        }
    }
}

initPlaceHolders();



function conth(){
    var sh=parseInt($(window).height());
    var sw=parseInt($(window).width());
    $(".contain > div.right").width(sw-200);
    $(".picscoll").width(sw-280);
    $(".picscoll .sly").width(sw-300);
    $(".cliscoll").width(sw-260);
    $(".cliscoll .sly").width(sw-280);


    $(".newscoll").height(sh-50)
    $(".newscoll .sly").height(sh-70);
    $(".newscoll .scrollbar").height(sh-90);
    $(".cliscoll .sly").height(sh-190);
    $(".cliscoll .scrollbar").height(sh-190);
    var rh=$(".contain > div.right").height();
    var bh=$("body").height();
    if(bh<sh)
    {
        //$(".contain > div.right").height(sh-82);
        $(".contain > div.right").css("min-height",(sh-82)+"px");
    }
    else{
        //$(".contain > div.right").height(bh-81);
        $(".contain > div.right").css("min-height",(bh-81)+"px");
        }
     /*      */
    //setTimeout(conth,100);
}
conth();

//模拟下拉菜单select
$(".sebox").on("change", function() {
    var o;
    var opt = $(this).find('option');
    opt.each(function(i) {
    if (opt[i].selected == true) {
    o = opt[i].innerHTML;
    }
    })
    $(this).find('label').html(o);
}).trigger('change');

$(function(){
	$(".submenu a.icoopen").click(function(){
	    //$(".overlay").addClass("cur")
	})

    //模拟复选框 checkbox
    $("p.checkbox span").each(function(index, element) {
        $(this).find("label").click(function(){
		    $(this).toggleClass("cur");
            $(this).siblings("input[type=checkbox]").trigger('click');
		})
    });
	$(".overbox input.submit,.overbox input.concal").click(function(){
	$(this).parents(".overlay").removeClass("cur")
	})
	$(".newshead a.graybtn").click(function(){
	$(this).parents(".overlay").removeClass("cur")
	})
	$(".newspub .addbtn").click(function(){
	$(".overlay2").addClass("cur");
	})
	$(".addpop input.submit,.addpop input.concal").click(function(){
	$(this).parents(".overlay2").removeClass("cur");
	})
})


$(function(){
    var ph=$(".overbox").height();
	    if(ph>450){
		$(".overlay").css({"position":"absolute"})
		var bh=$("body").height();
		$(".overlay").height(bh)
		$(".overbox").css({"top":"20px","margin-top":"0"})
		}
})


$(".sebox2").on("change", function() {
var o;
var opt = $(this).find('option');
opt.each(function(i) {
if (opt[i].selected == true) {
o = opt[i].innerHTML;
}
})
$(this).find('label').html(o);
}).trigger('change');

$(function(){
    $(".picscoll .sly li").each(function(index, element) {
        $(this).find("a.edit").click(function(){
		$(this).parent("li").find("p.editbox").toggle();
	})
    });
	$(".picscoll .sly li p.editbox a").click(function(){
		$(this).parent("p.editbox").hide();
	})
})



