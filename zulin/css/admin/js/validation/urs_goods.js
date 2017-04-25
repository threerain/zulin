var FormValidation = function () {


    return {
        //main function to initiate the module
        init: function () {
            // // for more info visit the official plugin documentation: 
            // // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#form_add');
            var error1 = $('.alert-error', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    number: {
                        required: true
                    },
                    name: {
                        required: true,
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.help-inline').removeClass('ok'); // display OK icon
                    $(element)
                        .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change dony by hightlight
                    $(element)
                        .closest('.control-group').removeClass('error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();

                    var el = form1.parents(".page-content");//jQuery(this).parents(".page-content");
                    App.blockUI(el);

                    setTimeout(function(){
                    $.post(form1.attr("action"), form1.serialize(),function(data){
                            if(data.code==301){
                                location.href = data.data;
                            }
                            else if(data.code!=1){ 
                                App.unblockUI(el);
                                $('#errModal').modal();
                                $('#errModal .modal-body').html("<p>"+data.msg+"</p>");
                            }
                            else
                            {
                                App.unblockUI(el);
                                $('#errModal').modal();
                                $('#errModal .modal-body').html("<p>"+"成功"+"</p>");
                                _btnadd.attr('disabled', 'disabled');
                            }       
                        },'json')
                        .fail(function() {
                            $('#errModal').modal();
                            $('#errModal .modal-body').html("<p>发生错误，请重试</p>");
                            App.unblockUI(el);
                          });
                    },500);
                }
            });
            var formaa = $('.formaa');
            var erroraa = $('.alert-error', formaa);
            var successaa = $('.alert-success', formaa);

            formaa.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    way: {
                        required: true
                    },
                    harvest_user: {
                        required: true,
                    }

                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    successaa.hide();
                    erroraa.show();
                    App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.help-inline').removeClass('ok'); // display OK icon
                    $(element)
                        .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change dony by hightlight
                    $(element)
                        .closest('.control-group').removeClass('error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                },

                submitHandler: function (form) {
                    successaa.show();
                    erroraa.hide();

                    var eaa = formaa.parents(".page-content");//jQuery(this).parents(".page-content");
                    App.blockUI(eaa);

                    setTimeout(function(){
                    $.post(form1.attr("action"), form1.serialize(),function(data){
                            if(data.code==301){
                                location.href = data.data;
                            }
                            else if(data.code!=1){ 
                                App.unblockUI(eaa);
                                $('#errModal').modal();
                                $('#errModal .modal-body').html("<p>"+data.msg+"</p>");
                            }
                            else
                            {
                                App.unblockUI(eaa);
                                $('#errModal').modal();
                                $('#errModal .modal-body').html("<p>"+"成功"+"</p>");
                                _btnadd.attr('disabled', 'disabled');
                            }       
                        },'json')
                        .fail(function() {
                            $('#errModal').modal();
                            $('#errModal .modal-body').html("<p>发生错误，请重试</p>");
                            App.unblockUI(eaa);
                          });
                    },500);
                }
            });


            var form3 = $('#form_add3');
            var error3 = $('.alert-error', form3);
            var success3 = $('.alert-success', form3);

            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    goods_name: {
                        required: true
                    },
                    goods_unit: {
                        required: true,
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success3.hide();
                    error3.show();
                    App.scrollTo(error3, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.help-inline').removeClass('ok'); // display OK icon
                    $(element)
                        .closest('.control-group').removeClass('success3').addClass('error3'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change dony by hightlight
                    $(element)
                        .closest('.control-group').removeClass('error3'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error3').addClass('success3'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success3.show();
                    error3.hide();

                    var e3 = form3.parents(".page-content");//jQuery(this).parents(".page-content");
                    App.blockUI(e3);

                    setTimeout(function(){
                    $.post(form3.attr("action"), form3.serialize(),function(data){
  
                            if(data.code==301){
                                location.href = data.data;
                            }
                            else if(data.code!=1){ 
                      
                                App.unblockUI(e3);
                                $('#errModal').modal();
                                $('#errModal .modal-body').html("<p>"+data.msg+"</p>");
                            }
                            else
                            {
                                App.unblockUI(e3);
                                $('#errModal').modal();
                                $('#errModal .modal-body').html("<p>"+"成功"+"</p>");
                                _btnadd.attr('disabled', 'disabled');
                            }       
                        },'json')
                        .fail(function() {
                            $('#errModal').modal();
                            $('#errModal .modal-body').html("<p>发生错误，请重试</p>");
                            App.unblockUI(e3);
                          });
                    },500);
                }
            });

            var form2 = $('#form_edit');
            var error2 = $('.alert-error', form2);
            var success2 = $('.alert-success', form2);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success2.hide();
                    error2.show();
                    App.scrollTo(error2, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.help-inline').removeClass('ok'); // display OK icon
                    $(element)
                        .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change dony by hightlight
                    $(element)
                        .closest('.control-group').removeClass('error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success2.show();
                    error2.hide();

                    var e2 = form2.parents(".page-content");//jQuery(this).parents(".page-content");
                    App.blockUI(e2);

                    setTimeout(function(){
                    $.post(form2.attr("action"), form2.serialize(),function(data){
                            if(data.code==301){
                                location.href = data.data;
                            }
                            else if(data.code!=1){ 
                                App.unblockUI(e2);
                                $('#errModal').modal();
                                $('#errModal .modal-body').html("<p>"+data.msg+"</p>");
                            }
                            else
                            {
                                App.unblockUI(e2);
                                $('#errModal').modal();
                                $('#errModal .modal-body').html("<p>"+"成功"+"</p>");
                                _btnadd.attr('disabled', 'disabled');
                            }       
                        },'json')
                        .fail(function() {
                            $('#errModal').modal();
                            $('#errModal .modal-body').html("<p>发生错误，请重试</p>");
                            App.unblockUI(e2);
                          });
                    },500);
                }
            });
            //apply validation on chosen dropdown value change, this only needed for chosen dropdown integration.
            $('.chosen, .chosen-with-diselect', form2).change(function () {
                form2.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });

             //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('.select2', form2).change(function () {
                form2.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });

        }

    };

}();
