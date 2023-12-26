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
        $("input[name='event_pic']").click();
    });

    // detect file input changes
    $("input[name='event_pic']").change(function () {
        var input = this
        validatePicture(input);


    });


    // trigger file input
    $("#picture_preview2").click(function () {
        $("input[name='event_venueArr']").click();
    });

    // detect file input changes
    $("input[name='event_venueArr']").change(function () {
        var input = this
        validatePicture(input);
    });

    // trigger file input
    $("#picture_preview3").click(function () {
        $("input[name='payment_qr']").click();
    });

    // detect file input changes
    $("input[name='payment_qr']").change(function () {
        var input = this
        validatePicture(input);

    });

    //validate form input
    $("#submit_form").on('click', function (e) {
        e.preventDefault();

        $(".message").text("");

        var submit = true;

        var event_picName_field = $("#event_personInCharge");
        var event_picContact_field = $("#event_picContactNo");
        var event_picEmail_field = $("#pic_email");
        var event_name_field = $("#event_name");
        // var event_category_field = $("#event_cat");
        // var event_otherCat_field = $("#other_category");
        var event_remark_field = $("#event_remark");
        var event_price_field = $("#event_price");
        var event_picAccNo_field = $("#pic_accNo");
        var event_capacity_field = $("#event_capacity");
        var event_date_field = $("#event_date");
        var event_duration_field = $("#event_duration");
        var event_time = $("#event_time");
        var event_start_time_field = $("#event_startTime");
        var event_end_time_field = $("#event_endTime");
        var form = $("#form1");
        // var event_remark_field = $("#event_remark");




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


        //PIC contact number validation
        var event_picContact_maxLength = 12;
        var picContact_length = document.getElementById("event_picContactNo").value.length;
        var picContact_span = event_picContact_field.siblings("label").find("span");
        var picContact_regex = new RegExp(/^[0-9]*$/);


        if (!$.trim(event_picContact_field.val())) {
            submit = false;
            picContact_span.html("<b>*</b> Empty field");
        } else if (picContact_length > event_picContact_maxLength) {
            submit = false;
            picContact_span.html("<b>*</b> The maximum character length is 12 only.");
        } else if (!picContact_regex.test(event_picContact_field.val())) {
            submit = false;
            picContact_span.html("<b>*</b> Contact number should be in correct format (Ex: <b>0133506462</b>).");
        } else {
            picName_span.html("<b>*</b>");
        }


        //PIC email validation
        var picEmail_regex = new RegExp('^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$');
        var picEmail_span = event_picEmail_field.siblings("label").find("span");

        // always clear error displayed first
        //$("#pic_email").remove();

        if (!$.trim(event_picEmail_field.val())) {
            submit = false;
            picEmail_span.html("<b>*</b> Empty field");
        }
        else if (!picEmail_regex.test(event_picEmail_field.val())) {
            submit = false;
            picEmail_span.html("<b>*</b> Email should be in correct format (Ex: <b>example@gmail.com</b>).");
        } else {
            picEmail_span.html("<b>*</b>");
        }


        //event name validation
        var event_name_maxLength = 100;
        var event_name_length = document.getElementById("event_name").value.length;
        var event_name_span = event_name_field.siblings("label").find("span");
        if (!$.trim(event_name_field.val())) {
            submit = false;
            event_name_span.html("<b>*</b> Empty field");
        } else if (event_name_length > event_name_maxLength) {
            submit = false;
            event_name_span.html("<b>*</b> The maximum character length is 100 only.");
        } else {
            event_name_span.html("<b>*</b>");
        }



        //event description validation
        var event_remark_maxLength = 300;
        var event_remark_length = document.getElementById("event_remark").value.length;
        var event_remark_span = event_remark_field.siblings("label").find("span");

        if (event_remark_length > event_remark_maxLength) {
            submit = false;
            event_remark_span.html("<b>*</b> The maximum character length is 300 only.");
        }

        //event price validation
        var event_price_regex = /^(0(?:\.\d{1,2})?|[1-9]\d{0,2}(?:\.\d{1,2})?)$/;
        var event_price_span = event_price_field.siblings("label").find("span");
        if (!$.trim(event_price_field.val())) {
            submit = false;
            event_price_span.html("<b>*</b> Empty field");
        } else if (!event_price_regex.test(event_price_field.val())) {
            submit = false;
            event_price_span.html("<b>*</b> The price can contain maximum 3 digits and 2 decimal places only.");
        } else {
            event_price_span.html("<b>*</b>");
        }


        //event PIC beneficiary account number validation
        var event_picAcc_maxLength = 15;
        var pic_accNo = document.getElementById("pic_accNo").value.length;
        var pic_accNo_regex = new RegExp(/^[0-9]*$/);
        var pic_accNo_span = event_picAccNo_field.siblings("label").find("span");
        if (event_remark_field.val() != 0.00) {
            if (!$.trim(event_picAccNo_field.val())) {
                submit = false;
                pic_accNo_span.html("<b>*</b> Empty field");
            } else if (!pic_accNo_regex.test(event_picAccNo_field.val())) {
                submit = false;
                pic_accNo_span.html("<b>*</b> The account number can be digits only.");
            } else if (pic_accNo > event_picAcc_maxLength) {
                submit = false;
                pic_accNo_span.html("<b>*</b> The account number can be 15 digits only.");
            } else {
                pic_accNo_span.html("<b>*</b>");
            }
        }



        //event capacity validation
        var event_capacity_regex = new RegExp(/^(?:[1-9]\d{0,2}|3000)$/);
        var event_capacity_span = event_capacity_field.siblings("label").find("span");
        if (!$.trim(event_capacity_field.val())) {
            submit = false;
            event_capacity_span.html("<b>*</b> Empty field");
        } else if (!event_capacity_regex.test(event_capacity_field.val())) {
            submit = false;
            event_capacity_span.html("<b>*</b> The maximum capacity is only 3000 only.");
        } else {
            event_capacity_span.html("<b>*</b>");
        }

        //event date validation
        var event_date_span = event_date_field.siblings("label").find("span");
        var currentDate = new Date(); // Get the current date
        var threeWeeksFromNow = new Date(currentDate.getTime() + 21 * 24 * 60 * 60 * 1000); // Calculate date three weeks from now

        if (!$.trim(event_date_field.val())) {
            submit = false;
            event_date_span.html("<b>*</b> Empty field");
        } else {
            // Convert the entered date to a JavaScript Date object
            var enteredDate = new Date(event_date_field.val());

            // Check if the entered date is before three weeks from now
            if (enteredDate < threeWeeksFromNow) {
                // The selected date is not valid (before three weeks from now)
                submit = false;
                event_date_span.html("<b>*</b> Event date must be after three weeks from the current date.");
            } else {
                event_date_span.html("<b>*</b>");
            }
        }


        //event duration validation
        var event_duration_max = 1;
        var event_duration_regex = new RegExp(/[1-5]/);
        var event_duration_length = document.getElementById("event_duration").value.length;
        var event_duration_span = event_duration_field.siblings("label").find("span");
        if (!$.trim(event_duration_field.val())) {
            submit = false;
            event_duration_span.html("<b>*</b> Empty field");
        } else if (event_duration_length > event_duration_max) {
            submit = false;
            event_duration_span.html("<b>*</b> The maximum duration is only 5 days.");
        } else if (!event_duration_regex.test(event_duration_field.val())) {
            submit = false;
            event_duration_span.html("<b>*</b> The maximum duration is only 5 days.");
        } else {
            event_duration_span.html("<b>*</b>");
        }


        //event time validation
        var startTime = event_start_time_field.val();
        var endTime = event_end_time_field.val();
        var event_time_span = $("label[for='event_time'] span");

        // submit = true;

        function parseTime(time) {
            var parts = time.split(":");
            if (parts.length === 2) {
                var hours = parseInt(parts[0], 10);
                var minutes = parseInt(parts[1], 10);
                if (!isNaN(hours) && !isNaN(minutes)) {
                    return hours * 100 + minutes;
                }
            }
            return NaN;
        }

        var startTimeNumeric = parseTime(startTime);
        var endTimeNumeric = parseTime(endTime);


        if (isNaN(startTimeNumeric) || isNaN(endTimeNumeric)) {
            submit = false;
            event_time_span.html("<b>*</b> Empty field");
        } else if (startTimeNumeric > endTimeNumeric) {
            submit = false;
            event_time_span.html("<b>*</b> Start time cannot be later than end time.");
        } else {
            event_time_span.html("<b>*</b>");
        }

        var picture1 = $("input[name='event_pic']");
        var picture1_span = picture1.parents("label").find("span");
        if (picture1[0].files.length === 0) {
            picture1_span.html("<b>*</b> Please upload event poster.");
            submit = false;
        }

        var picture2 = $("input[name='payment_qr']");
        if ($.trim(event_price_field.val())!=0.00 && picture2[0].files.length === 0) {
            var picture2_span = picture2.parents("label").find("span");    
            picture2_span.html("<b>*</b> Please upload QR code.");
            submit = false;
        }

        var picture3 = $("input[name='event_venueArr']");
        var picture3_span = picture3.parents("label").find("span");
        if (picture3[0].files.length === 0) {
            picture3_span.html("<b>*</b> Please upload event venue arrangement floor plan.");
            submit = false;
        }



        if (submit) {
            $("#form1").submit();
        }

    });
});
