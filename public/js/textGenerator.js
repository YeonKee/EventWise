$(document).ready(function () {
    //validate form input
    $("#submit_mainformm").on('click', function (e) {

        console.log("I am hereee???");
        e.preventDefault();

        $(".message").text("");

        var submit = true;

        var event_description_field = $("#event_description");
        var content = $("#description");
        console.log(content);

    

        //PIC name validation
        var event_description_maxLength = 255;
        var desc_length = document.getElementById("event_description").value.length;
        var desc_span = event_description_field.siblings("label").find("span");
        if (!$.trim(content.val())) {
            submit = false;
            desc_span.html("<b>*</b> Empty field");
        } else if (desc_length > event_description_maxLength) {
            submit = false;
            desc_span.html("<b>*</b> The maximum character length is 200 only.");
        } else {
            desc_span.html("<b>*</b>");
        }
        //

        console.log(submit);
        //-----------------------------------------------
        if (submit) {

            console.log("hiiii");
            $("#form3").submit();

        }
    });

});

