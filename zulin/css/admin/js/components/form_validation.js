function check(v,b){//验证是数字的 小数点后两位的 onblur="check(this.value,this);"
    var a=/^[0-9]*(\.[0-9]{1,2})?$/;
    if(!a.test(v)){
         b.placeholder = "最多保留两位小数";
         b.value = '' ;
    }
}
function check_phone(v,b){//手机号验证 onblur="check_phone(this.value,this);"
    var a=/^1[3|4|5|7|8]\d{9}$/;
    if(!a.test(v)){
        b.placeholder = "请输入正确的手机号";
        b.value = '' ;
    }
}
function check_next(v,b){//验证是数字的  小数点后两位的  然后给后面的添加属性required 使用方法-> onblur="check_next(this.value,this);"
    var a=/^[0-9]*(\.[0-9]{1,2})?$/;
    if(!a.test(v)){
         b.placeholder = "最多保留两位小数";
         b.value = '' ;
    }else{
        if(b.value != ''){
            $(b).next().attr("required",true);
        }else{
            $(b).next().attr("required",false);
        }
    }
}
