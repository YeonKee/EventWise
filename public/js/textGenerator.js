    //validate form input
    $("form").submit(function (e) {

        $(".message").text("");

        var submit = true;

        var event_remark_field = $("title");

        //PIC name validation
        var event_picName_maxLength = 100;
        var picName_length = document.getElementById("event_personInCharge").value.length;
        var picName_span = event_picName_field.siblings("label").find("span");
        if (!$.trim(event_picName_field.val())) {
            submit = false;
            picName_span.html("<b>*</b> Empty field");
        } else if (picName_length > event_picName_maxLength) {
            submit = false;
            picName_span.html("<b>*</b> The maximum character length is 100 only.");
        } else {
            picName_span.html("<b>*</b>");
        }

        //

        //-----------------------------------------------
        if (!submit) {
            e.preventDefault();
        }
    });

