
var FormValidation = function () {


    return {
        //main function to initiate the module
        init: function () {

            var formcreate = $('#form_create');
            var errorcreate = $('.alert-error', formcreate);
            var successcreate = $('.alert-success', formcreate);

            formcreate.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                },

                messages: { // custom messages for radio buttons and checkboxes
                    membership: {
                        required: "Please select a Membership type"
                    },
                    service: {
                        required: "Please select  at least 2 types of Service",
                        minlength: jQuery.format("Please select  at least {0} types of Service")
                    }
                },
                invalidHandler: function (event, validator) { //display error alert on form submit   
                    successcreate.hide();
                    errorcreate.show();
                    App.scrollTo(errorcreate, -200);
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
                submitHandler: function (form) {
                    successcreate.show();
                    errorcreate.hide();
                    $(".select").remove();
                    var el = formcreate.parents(".page-content");//jQuery(this).parents(".page-content");
                    App.blockUI(el);

                    setTimeout(function(){
                        
                      $.post(formcreate.attr("action"), formcreate.serialize(),function(data){

                            if(data.code==301){
                                location.href = data.data;
                            }
                            else if(data.code!=200){ 
                                App.unblockUI(el);
                                $('#errModal').modal();
                                $('#errModal .modal-body').html("<p>"+data.msg+"</p>");
                            }
                            else
                            {
                                $('#errModal').modal();
                                $('#errModal .modal-body').html("<p>"+"成功"+"</p>");
                                _btnadd.attr('disabled', 'disabled');
                                App.unblockUI(el);
                            }
                            App.unblockUI(el);

                        },'json')
                        .fail(function(jqXHR, textStatus) {
                            App.unblockUI(el);
                            $('#errModal').modal();
                            $('#errModal .modal-body').html("<p>错误"+jqXHR.status+" "+jqXHR.responseText);
                          });

                    },500);
                    App.unblockUI(el);
                }

            });

            var formedit = $('#form_edit');
            var erroredit = $('.alert-error', formedit);
            var successedit = $('.alert-success', formedit);

            formedit.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    estate_id: {
                        required: true
                    },

                    building_id: {
                        required: true
                    },

                    room_number: {
                        required: true,
                        maxlength: 50
                    },

                    area: {
                        required: true,
                        number: true
                    },

                    lessee: {
                        required: true,
                    },


                    // owner: {
                    //     required: true,
                    // },

                    deposit: {
                        number: true
                    },

                    deposit_month: {
                        digits: true
                    },

                    pay_month: {
                        digits: true
                    },

                    monthly_rent: {
                        number: true
                    },

                    day_meter_rent: {
                        number: true
                    },

                    advance_days: {
                        digits: true
                    },

                    commission: {
                        number: true
                    },

                    monthly_rent: {
                        required: true,
                    },

                    deposit_month: {
                        required: true,
                    },

                    pay_month: {
                        required: true,
                    },

                    lease_term_start: {
                        required: true,
                    },

                    lease_term_end: {
                        required: true,
                    },

                },
                messages: { // custom messages for radio buttons and checkboxes
                    membership: {
                        required: "Please select a Membership type"
                    },
                    service: {
                        required: "Please select  at least 2 types of Service",
                        minlength: jQuery.format("Please select  at least {0} types of Service")
                    }
                },
                invalidHandler: function (event, validator) { //display error alert on form submit   
                    successedit.hide();
                    erroredit.show();
                    App.scrollTo(erroredit, -200);
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

                submitHandler: function (form) {
                    successedit.show();
                    erroredit.hide();
                    //form.submit();
                $(".select").remove();

                    var el = formedit.parents(".page-content");//jQuery(this).parents(".page-content");
                    App.blockUI(el);

                    setTimeout(function(){
                    $.post(formedit.attr("action"), formedit.serialize(),function(data){
                            if(data.code==301){
                                location.href = data.data;
                            }
                            else if(data.code!=200){ 
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
                        .fail(function(jqXHR, textStatus) {
                            App.unblockUI(el);
                            $('#errModal').modal();
                            $('#errModal .modal-body').html("<p>错误"+jqXHR.status+" "+jqXHR.responseText);
                          });
                    },500);
                }

            });

        }

    };

}();

