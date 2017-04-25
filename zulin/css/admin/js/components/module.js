var FormComponents = function () {

    

    var handleMultiSelect = function () {
        //$('#my_multi_select1').multiSelect();
        $('#my_multi_select2').multiSelect({
            selectableOptgroup: true
        });        
    }



    return {
        //main function to initiate the module
        init: function () {
            handleMultiSelect();
        }

    };

}();