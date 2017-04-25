var FormValidation = function () {


    return {
        //main function to initiate the module
        init: function () {

            // // for more info visit the official plugin documentation: 
            // // http://docs.jquery.com/Plugins/Validation

            // // var form1 = $('#form_sample_1');
            // // var error1 = $('.alert-error', form1);
            // // var success1 = $('.alert-success', form1);

            // // form1.validate({
            // //     errorElement: 'span', //default input error message container
            // //     errorClass: 'help-inline', // default input error message class
            // //     focusInvalid: false, // do not focus the last invalid input
            // //     ignore: "",
            // //     rules: {
            // //         name: {
            // //             minlength: 2,
            // //             required: true
            // //         },
            // //         email: {
            // //             required: true,
            // //             email: true
            // //         },
            // //         url: {
            // //             required: true,
            // //             url: true
            // //         },
            // //         number: {
            // //             required: true,
            // //             number: true
            // //         },
            // //         digits: {
            // //             required: true,
            // //             digits: true
            // //         },
            // //         creditcard: {
            // //             required: true,
            // //             creditcard: true
            // //         },
            // //         occupation: {
            // //             minlength: 5,
            // //         },
            // //         category: {
            // //             required: true
            // //         }
            // //     },

            // //     invalidHandler: function (event, validator) { //display error alert on form submit              
            // //         success1.hide();
            // //         error1.show();
            // //         App.scrollTo(error1, -200);
            // //     },

            // //     highlight: function (element) { // hightlight error inputs
            // //         $(element)
            // //             .closest('.help-inline').removeClass('ok'); // display OK icon
            // //         $(element)
            // //             .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
            // //     },

            // //     unhighlight: function (element) { // revert the change dony by hightlight
            // //         $(element)
            // //             .closest('.control-group').removeClass('error'); // set error class to the control group
            // //     },

            // //     success: function (label) {
            // //         label
            // //             .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
            // //         .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
            // //     },

            // //     submitHandler: function (form) {
            // //         success1.show();
            // //         error1.hide();
            // //     }
            // // });

            // //Sample 2
            // $('#form_2_select2').select2({
            //     placeholder: "Select an Option",
            //     allowClear: true
            // });

            var form2 = $('#form_sample_2');
            var error2 = $('.alert-error', form2);
            var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                   // 车主
                    owner: {
                        required: true
                    },
                    // 收款人
                    payee: {
                        required: true
                    },
                    // 手机号
                    phone: {
                        required: true
                    },
                    // 联系方式类型 1=联系车主 2=联系代理人
                    contact_information_type: {
                        required: true
                    },
                    // 开户行
                    bank: {
                        required: true
                    },
                    // 银行账号
                    bank_account: {
                        required: true
                    },
                    // 租期开始时间
                    lease_term_start: {
                        required: true
                    },
                    // 租期结束时间
                    lease_term_end: {
                        required: true
                    },
                    // 押金
                    deposit: {
                        required: true
                    },
                    // 押金备注
                    deposit_memo: {
                        required: true
                    },
                    // 押金几个月
                    deposit_month: {
                        required: true
                    },
                    // 付租金几个月
                    pay_month: {
                        required: true
                    },
                    // 租金
                    monthly_rent: {
                        required: true
                    },
                   
                    
                    // 提前几天付款
                    advance_days: {
                        required: true
                    },
                    // 佣金金额
                    commission: {
                        required: true
                    },
                    // 业务员ID
                    salesman_id: {
                        required: true
                    },
                    // 片区负责人ID
                    manager_id: {
                        required: true
                    },
                    // 签约日
                    signing_date: {
                        required: true
                    },
                   
                   


                    // avatar: {
                    //     required: true
                    // },
                    // email: {
                    //     required: true,
                    //     email: true
                    // },
                    // category: {
                    //     required: true
                    // },
                    // options1: {
                    //     required: true
                    // },
                    // options2: {
                    //     required: true
                    // },
                    // occupation: {
                    //     minlength: 5,
                    // },
                    // membership: {
                    //     required: true
                    // },
                    // service: {
                    //     required: true,
                    //     minlength: 2
                    // }
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

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "education") { // for chosen elements, need to insert the error after the chosen container
                        error.insertAfter("#form_2_education_chzn");
                    } else if (element.attr("name") == "membership") { // for uniform radio buttons, insert the after the given container
                        error.addClass("no-left-padding").insertAfter("#form_2_membership_error");
                    } else if (element.attr("name") == "service") { // for uniform checkboxes, insert the after the given container
                        error.addClass("no-left-padding").insertAfter("#form_2_service_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavoir
                    }
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
                    if (label.attr("for") == "service" || label.attr("for") == "membership") { // for checkboxes and radip buttons, no need to show OK icon
                        label
                            .closest('.control-group').removeClass('error').addClass('success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                        .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success2.show();
                    error2.hide();
                    //alert("dsf");
                    //form.submit();

                    var el = form2.parents(".page-content");//jQuery(this).parents(".page-content");
                    App.blockUI(el);

                    setTimeout(function(){
                    $.post(form2.attr("action"), form2.serialize(),function(data){
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
                        .fail(function() {
                            $('#errModal').modal();
                            $('#errModal .modal-body').html("<p>发生错误，请重试</p>");
                          });
                    },500);
                }

            });

            var form3 = $('#form_sample_3');
            var error3 = $('.alert-error', form3);
            var success3 = $('.alert-success', form3);

            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {

                    


                    // password: {
                    //     required: true
                    // },
                    // r_password: {
                    //     required: true
                    // },
                    nickname: {
                        required: true
                    },
                    // avatar: {
                    //     required: true
                    // },
                    // email: {
                    //     required: true,
                    //     email: true
                    // },
                    // category: {
                    //     required: true
                    // },
                    // options1: {
                    //     required: true
                    // },
                    // options2: {
                    //     required: true
                    // },
                    // occupation: {
                    //     minlength: 5,
                    // },
                    // membership: {
                    //     required: true
                    // },
                    // service: {
                    //     required: true,
                    //     minlength: 2
                    // }
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

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "education") { // for chosen elements, need to insert the error after the chosen container
                        error.insertAfter("#form_2_education_chzn");
                    } else if (element.attr("name") == "membership") { // for uniform radio buttons, insert the after the given container
                        error.addClass("no-left-padding").insertAfter("#form_2_membership_error");
                    } else if (element.attr("name") == "service") { // for uniform checkboxes, insert the after the given container
                        error.addClass("no-left-padding").insertAfter("#form_2_service_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavoir
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
                        .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change dony by hightlight
                    $(element)
                        .closest('.control-group').removeClass('error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "service" || label.attr("for") == "membership") { // for checkboxes and radip buttons, no need to show OK icon
                        label
                            .closest('.control-group').removeClass('error').addClass('success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                        .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success3.show();
                    error3.hide();
                    //alert("dsf");
                    //form.submit();

                    var el = form3.parents(".page-content");//jQuery(this).parents(".page-content");
                    App.blockUI(el);

                    setTimeout(function(){
                    $.post(form3.attr("action"), form3.serialize(),function(data){
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
                        .fail(function() {
                            $('#errModal').modal();
                            $('#errModal .modal-body').html("<p>发生错误，请重试</p>");
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
