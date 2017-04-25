var FormComponents = function () {

    var handleWysihtml5 = function () {
        if (!jQuery().wysihtml5) {
            return;
        }

        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["assets/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
            });
        }
    }

    var resetWysihtml5 = function () {
        if (!jQuery().wysihtml5) {
            return;
        }

        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["assets/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
            });
        }
    }

    var handleToggleButtons = function () {
        if (!jQuery().toggleButtons) {
            return;
        }
        $('.basic-toggle-button').toggleButtons();
        $('.text-toggle-button').toggleButtons({
            width: 200,
            label: {
                enabled: "Lorem Ipsum",
                disabled: "Dolor Sit"
            }
        });
        $('.danger-toggle-button').toggleButtons({
            style: {
                // Accepted values ["primary", "danger", "info", "success", "warning"] or nothing
                enabled: "danger",
                disabled: "info"
            }
        });
        $('.info-toggle-button').toggleButtons({
            style: {
                enabled: "info",
                disabled: ""
            }
        });
        $('.success-toggle-button').toggleButtons({
            style: {
                enabled: "success",
                disabled: "info"
            }
        });
        $('.warning-toggle-button').toggleButtons({
            style: {
                enabled: "warning",
                disabled: "info"
            }
        });

        $('.height-toggle-button').toggleButtons({
            height: 100,
            font: {
                'line-height': '100px',
                'font-size': '20px',
                'font-style': 'italic'
            }
        });
    }

    var handleTagsInput = function () {
        if (!jQuery().tagsInput) {
            return;
        }
        $('#tags_1').tagsInput({
            width: 'auto',
            'onAddTag': function () {
                //alert(1);
            },
        });
        $('#tags_2').tagsInput({
            width: 240
        });
    }

    var handlejQueryUIDatePickers = function () {
        $( ".ui-date-picker" ).datepicker();
    }

    var handleDatePickers = function () {

        if (jQuery().datepicker) {
            $('.date-picker').datepicker({
                rtl : App.isRTL(),
                format: "yyyy-mm-dd",
            });
        }
    }

    var handleTimePickers = function () {
        
        if (jQuery().timepicker) {
            $('.timepicker-default').timepicker();
            $('.timepicker-24').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false
            });
        }
    }

    var handleDateRangePickers = function () {
        if (!jQuery().daterangepicker) {
            return;
        }

        $('.date-range').daterangepicker(
            {
                opens: (App.isRTL() ? 'left' : 'right'),
                format: 'MM/dd/yyyy',
                separator: ' to ',
                startDate: Date.today().add({
                    days: -29
                }),
                endDate: Date.today(),
                minDate: '01/01/2012',
                maxDate: '12/31/2014',
            }
        );

        $('#form-date-range').daterangepicker({
            ranges: {
                'Today': ['today', 'today'],
                'Yesterday': ['yesterday', 'yesterday'],
                'Last 7 Days': [Date.today().add({
                        days: -6
                    }), 'today'],
                'Last 29 Days': [Date.today().add({
                        days: -29
                    }), 'today'],
                'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
                'Last Month': [Date.today().moveToFirstDayOfMonth().add({
                        months: -1
                    }), Date.today().moveToFirstDayOfMonth().add({
                        days: -1
                    })]
            },
            opens: (App.isRTL() ? 'left' : 'right'),
            format: 'MM/dd/yyyy',
            separator: ' to ',
            startDate: Date.today().add({
                days: -29
            }),
            endDate: Date.today(),
            minDate: '01/01/2012',
            maxDate: '12/31/2014',
            locale: {
                applyLabel: 'Submit',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            },
            showWeekNumbers: true,
            buttonClasses: ['btn-danger']
        },

        function (start, end) {
            $('#form-date-range span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
        });

        $('#form-date-range span').html(Date.today().add({
            days: -29
        }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));


        //modal version:

        $('#form-date-range-modal').daterangepicker({
            ranges: {
                'Today': ['today', 'today'],
                'Yesterday': ['yesterday', 'yesterday'],
                'Last 7 Days': [Date.today().add({
                        days: -6
                    }), 'today'],
                'Last 29 Days': [Date.today().add({
                        days: -29
                    }), 'today'],
                'This Month': [Date.today().moveToFirstDayOfMonth(), Date.today().moveToLastDayOfMonth()],
                'Last Month': [Date.today().moveToFirstDayOfMonth().add({
                        months: -1
                    }), Date.today().moveToFirstDayOfMonth().add({
                        days: -1
                    })]
            },
            opens: (App.isRTL() ? 'left' : 'right'),
            format: 'MM/dd/yyyy',
            separator: ' to ',
            startDate: Date.today().add({
                days: -29
            }),
            endDate: Date.today(),
            minDate: '01/01/2012',
            maxDate: '12/31/2014',
            locale: {
                applyLabel: 'Submit',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            },
            showWeekNumbers: true,
            buttonClasses: ['btn-danger']
        },

        function (start, end) {
            $('#form-date-range-modal span').html(start.toString('MMMM d, yyyy') + ' - ' + end.toString('MMMM d, yyyy'));
        });

        $('#form-date-range-modal span').html(Date.today().add({
            days: -29
        }).toString('MMMM d, yyyy') + ' - ' + Date.today().toString('MMMM d, yyyy'));

    }

    // var handleDatetimePicker = function () {        

    //       $(".form_datetime").datetimepicker({
    //           format: "dd MM yyyy - hh:ii",
    //           pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left")
    //       });

    //      $(".form_advance_datetime").datetimepicker({
    //           format: "dd MM yyyy - hh:ii",
    //           autoclose: true,
    //           todayBtn: true,
    //           startDate: "2013-02-14 10:00",
    //           pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
    //           minuteStep: 10
    //       });

    //      $(".form_meridian_datetime").datetimepicker({
    //         format: "dd MM yyyy - HH:ii P",
    //         showMeridian: true,
    //         autoclose: true,
    //         pickerPosition: (App.isRTL() ? "bottom-right" : "bottom-left"),
    //         todayBtn: true
    //     });
    // }

    // var handleClockfaceTimePickers = function () {

    //     if (!jQuery().clockface) {
    //         return;
    //     }

    //     $('.clockface_1').clockface();

    //     $('#clockface_2').clockface({
    //         format: 'HH:mm',
    //         trigger: 'manual'
    //     });

    //     $('#clockface_2_toggle').click(function (e) {
    //         e.stopPropagation();
    //         $('#clockface_2').clockface('toggle');
    //     });

    //     $('#clockface_2_modal').clockface({
    //         format: 'HH:mm',
    //         trigger: 'manual'
    //     });

    //     $('#clockface_2_modal_toggle').click(function (e) {
    //         e.stopPropagation();
    //         $('#clockface_2_modal').clockface('toggle');
    //     });

    //     $('.clockface_3').clockface({
    //         format: 'H:mm'
    //     }).clockface('show', '14:30');
    // }

    // var handleColorPicker = function () {
    //     if (!jQuery().colorpicker) {
    //         return;
    //     }
    //     $('.colorpicker-default').colorpicker({
    //         format: 'hex'
    //     });
    //     $('.colorpicker-rgba').colorpicker();
    // }

    var handleSelec2 = function () {
        // $('#channel_id').select2({
        //     placeholder: "请选择",
        //     allowClear: true
        // });

        // $('#channel_manager_id').select2({
        //     placeholder: "请选择",
        //     allowClear: true
        // });

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

        $("#salesman_id").select2({
            placeholder: "",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "/admin/admin/ajaxlist",
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
                    $.ajax("/admin/admin/ajaxitem", {
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
    var handlechannel_idSelec2 = function () {
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
            $('#channel_manager_id').attr('data',movie.id);
            $("#channel_manager_id").select2("val", "");
            return movie.title;
        }
        $("#channel_id").select2({
            placeholder: "",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "/admin/channel/ajaxlist",
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
                    $.ajax("/admin/channel/ajaxitem", {
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
    var handlechannel_manager_idSelec2 = function () {
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
                url: "/admin/channelmanager/ajaxlist",
                dataType: 'json',
                data: function (term, page) {
                    return {
                        channel_id : $('#channel_manager_id').attr('data'),
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

   var handleSelec3 = function () {
        // $('#channel_id').select2({
        //     placeholder: "请选择",
        //     allowClear: true
        // });

        // $('#channel_manager_id').select2({
        //     placeholder: "请选择",
        //     allowClear: true
        // });

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

        $("#recycle_id").select2({
            placeholder: "",
            minimumInputLength: 1,
            ajax: { // instead of writing the function to execute the request we use Select2's convenient helper
                url: "/admin/admin/ajaxlist",
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
                    $.ajax("/admin/admin/ajaxitem", {
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




    // var handleMultiSelect = function () {
    //     $('#my_multi_select1').multiSelect();
    //     $('#my_multi_select2').multiSelect({
    //         selectableOptgroup: true
    //     });        
    // }

    var handleInputMasks = function () {
        $.extend($.inputmask.defaults, {
            'autounmask': true
        });

        // $("#mask_date").inputmask("d/m/y", {autoUnmask: true});  //direct mask        
        // $("#mask_date1").inputmask("d/m/y",{ "placeholder": "*"}); //change the placeholder
        // $("#mask_date2").inputmask("d/m/y",{ "placeholder": "dd/mm/yyyy" }); //multi-char placeholder
        // $("#mask_phone").inputmask("mask", {"mask": "(999) 999-9999"}); //specifying fn & options
        // $("#mask_tin").inputmask({"mask": "99-9999999"}); //specifying options only
        // $("#mask_number").inputmask({ "mask": "9", "repeat": 10, "greedy": false });  // ~ mask "9" or mask "99" or ... mask "9999999999"
        // $("#mask_decimal").inputmask('decimal', { rightAlignNumerics: false }); //disables the right alignment of the decimal input
        // $("#mask_currency").inputmask('€ 999.999.999,99', { numericInput: true });  //123456  =>  € ___.__1.234,56
       
        // $("#mask_currency2").inputmask('€ 999,999,999.99', { numericInput: true, rightAlignNumerics: false, greedy: false}); //123456  =>  € ___.__1.234,56
        // $("#mask_ssn").inputmask("999-99-9999", {placeholder:" ", clearMaskOnLostFocus: true }); //default
        //$("input[name='deposit']").inputmask({ "mask": "9", "repeat": 10, "greedy": false }); 
        //$("input[name='deposit_month']").inputmask({ "mask": "9", "repeat": 1, "greedy": false }); 
        //$("input[name='pay_month']").inputmask({ "mask": "9", "repeat": 2, "greedy": false }); 
        //$("input[name='monthly_rent']").inputmask({ "mask": "9", "repeat": 8, "greedy": false }); 
        //$("input[name='day_meter_rent']").inputmask({ "mask": "9", "repeat": 2, "greedy": false }); 
        //$("input[name='advance_days']").inputmask({ "mask": "9", "repeat": 2, "greedy": false });
        //$("input[name='commission']").inputmask({ "mask": "9", "repeat": 8, "greedy": false });
        //$("input[name='area']").inputmask({ "mask": "9999.99" });
    }

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
            $("#building_id").select2("val", "");
            $("#room_number").select2("val", "");
            $("input[name='area']").val(""); 
            return movie.title;
        }

        $("#estate_id").select2({
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
            $("#room_number").select2("val", "");
            $("input[name='area']").val(""); 
            return movie.title;
        }

        $("#building_id").select2({
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
                $("#area").val(data.area);
                $("#room_type").val(data.room_type);
                $("#property_id").val(data.property_id);
            });

            return movie.title;
        }

        $("#room_number").select2({
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

    return {
        //main function to initiate the module
        init: function () {
            handleWysihtml5();
            handleToggleButtons();
            handleTagsInput();
            handlejQueryUIDatePickers();
            handleDatePickers();
            handleTimePickers();
            // handleDatetimePicker();
            handleDateRangePickers();
            //handleClockfaceTimePickers();
            //handleColorPicker();
            handleSelec2();
            handlechannel_idSelec2();
            handlechannel_manager_idSelec2();
            handleSelec3();
            handleSelectEstate();
            handleSelectBuilding();
            handleSelectHouseNo();
            handleInputMasks();
            //handleIPAddressInput();
            //handleMultiSelect();

            App.addResponsiveHandler(function(){
                resetWysihtml5();
            })
        }

    };

}();