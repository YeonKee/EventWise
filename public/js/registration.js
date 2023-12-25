$(document).ready(function () {

    function validatePicture(input) {
        var have_picture = false;
        var preview = $(input).siblings(".picturePreview");
        var span = $(input).parents("label").find("span");
        var inputLen = input.value.length;
        var file = input.files[0];
        var URL = window.URL || window.webkitURL;
        var picture_regex = new RegExp("image\/(jpe?g|png)");

        // valid file (not more than 1MB, correct format: JPG, JPEG, PNG)
        if (inputLen && file.size <= (1 * 1024 * 1024) && picture_regex.test(file.type)) {
            have_picture = true;

            preview.attr('src', URL.createObjectURL(file));
            span.html("<b>*</b>");

        } // invalid file
        else if (inputLen) {

            have_picture = false;

            // file format problem
            if (!picture_regex.test(file.type)) {
                if (!$(span).find('#picture_1').length) {
                    span.html("<div id='picture_1'>\n\
                        Please select image in JPG, JPEG, and PNG format only.\n\
                    </div>");
                }
            } else {
                $("#picture_1").remove();
            }

            // file size problem
            if (file.size > (1 * 1024 * 1024)) {
                if (!$(span).find('#picture_2').length) {
                    span.html("<div id='picture_2'>\n\
                        Please make sure the image size is not more than 1MB.\n\
                    </div>");
                }
            } else {
                $("#picture_2").remove();
            }

        } // no file selected
        else {

            have_picture = false;
        }

        // restore the profile input
        if (!have_picture) {
            preview.attr("src", "/img/default_eventpic.png");
            input.val(" ");
        }

    }




    // trigger file input
    $("#picture_preview").click(function () {
        $("input[name='part_receipt']").click();
    });

    // detect file input changes
    $("input[name='part_receipt']").change(function () {
        var input = this
        validatePicture(input);


    });


    //validate form input
    $("#submit_regForm").on('click', function (e) {
        e.preventDefault();

        $(".message").text("");

        var submit = true;

        var name_field = $("#part_name");
        var contactNo_field = $("#part_ContactNo");
        var email_field = $("#part_email");
        var address_field = $("#part_add");
        var event_price_field = $("#event_price");
  
 

        //participant name validation
        var name_maxLength = 100;
        var name_length = document.getElementById("part_name").value.length;
        var name_span = name_field.siblings("label").find("span");

        if (!$.trim(name_field.val())) {
            submit = false;
            name_span.html("<b>*</b> Empty field");
        } else if (name_length > name_maxLength) {
            submit = false;
            name_span.html("<b>*</b> The maximum character length is 100 only.");
        } else {
            name_span.html("<b>*</b>");
        }
 

        //participant contact number validation
        var contactNo_maxLength = 12;
        var contact_length = document.getElementById("part_ContactNo").value.length;
        var contact_span = contactNo_field.siblings("label").find("span");
        var Contact_regex = new RegExp(/^[0-9]*$/);


        if (!$.trim(contactNo_field.val())) {
            submit = false;
            contact_span.html("<b>*</b> Empty field");
        } else if (contact_length > contactNo_maxLength) {
            submit = false;
            contact_span.html("<b>*</b> The maximum character length is 12 only.");
        } else if (!Contact_regex.test(contactNo_field.val())) {
            submit = false;
            contact_span.html("<b>*</b> Contact number should be in correct format (Ex: <b>0133506462</b>).");
        } else {
            contact_span.html("<b>*</b>");
        }
    

        //participant email validation
        var email_regex = new RegExp('^[A-Z0-9._%+-]+@([A-Z0-9-]+.){2,4}$', 'i');
        var email_span = email_field.siblings("label").find("span");

        if (!$.trim(email_field.val())) {
            submit = false;
            email_span.html("<b>*</b> Empty field");
        }
        else if (!email_regex.test(email_field.val())) {
            submit = false;
            email_span.html("<b>*</b> Email should be in correct format (Ex: <b>example@gmail.com</b>).");
        } else {
            email_span.html("<b>*</b>");
        }
       

        //participant address validation
        var add_maxLength = 200;
        var add_length = document.getElementById("part_add").value.length;
        var add_span = address_field.siblings("label").find("span");
        if (!$.trim(address_field.val())) {
            submit = false;
            add_span.html("<b>*</b> Empty field");
        } else if (add_length > add_maxLength) {
            submit = false;
            add_span.html("<b>*</b> The maximum character length is 200 only.");
        } else {
            add_span.html("<b>*</b>");
        }


            //participant city validation
            // var city_maxLength = 50;
            // var city_length = document.getElementById("part_city").value.length;
            // var city_span = city_field.siblings("label").find("span");
            // if (!$.trim(city_field.val())) {
            //     submit = false;
            //     city_span.html("<b>*</b> Empty field");
            // } else if (city_length > city_maxLength) {
            //     submit = false;
            //     city_span.html("<b>*</b> The maximum character length is 50 only.");
            // } else {
            //     city_span.html("<b>*</b>");
            // }
            // console.log(submit);

            var picture2 = $("input[name='part_receipt']");
            if ($.trim(event_price_field.val())!=0.00 && picture2[0].files.length === 0) {
                var picture2_span = picture2.parents("label").find("span");    
                picture2_span.html("<b>*</b> Please upload receipt.");
                submit = false;
            }


        if (submit) {

            $("#form1").submit();

        }
        
    });
});
