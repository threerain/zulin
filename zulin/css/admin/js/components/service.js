var FormComponents = function () {

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
        $(".estates").val(movie.title);
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
        $(".buildings").val(movie.title);
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
            var property_id = data.property_id;
            $.post('/admin/sersellcontract/ajaxroom',{room_number:data.property_id},function(data){
                //多编号显示
                    $(".house_no").html("")
                    var a = $(".house_no").html();

                    $(".aa").parents(".bbb").remove();
                for (var i=0;i<data.length;i++)
                {
                    if(property_id != data[i]['property_id']){
                        $(".rooms").val(data[i]['house_no']);
                        mores =$("#addroom").clone();
                        mores.addClass('bbb');
                        mores.children(".dataTables_filter").children(".test").children(".rooms").attr('class','aa');
                        mores.show();
                        mores.removeAttr('id');
                        $('.add_roomnumber').append(mores);
                    }
                    a += '<option value="'+data[i]['property_id']+'">'+data[i]['house_no']+'</option>';
                }
                 $(".house_no").html(a);
                
            })
   
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
            results: function (data, page) {
                // parse the results into the format expected by Select2.
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
        handleSelectEstate();
        handleSelectBuilding();
        handleSelectHouseNo();
    }

};

}();
