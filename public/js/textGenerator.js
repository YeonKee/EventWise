    //validate form input
    $("#submit_mainformm").on('click', function (e) {

        console.log("I am hereee???");
        e.preventDefault();

        $(".message").text("");

        var submit = true;

        var event_remark_field = $("#event_remark");
        var content = $("#remark");
        console.log(content);

        console.log(submit);

        //PIC name validation
        var event_remark_maxLength = 200;
        var remark_length = document.getElementById("remark").value.length;
        var remark_span = event_remark_field.siblings("label").find("span");
        if (!$.trim(content.val())) {
            submit = false;
            remark_span.html("<b>*</b> Empty field");
        } else if (remark_length > event_remark_maxLength) {
            submit = false;
            remark_span.html("<b>*</b> The maximum character length is 200 only.");
        } else {
            remark_span.html("<b>*</b>");
        }

        //

        console.log(submit);
        //-----------------------------------------------
        if (submit) {

            console.log("hiiii");
            $("#form3").submit();

        }
    });

