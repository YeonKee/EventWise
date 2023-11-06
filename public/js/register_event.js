$(document).ready(function () {


    let have_picture = false;

    function validatePicture(input) {

        var picture = $("input[name='event_pic']");
        var prod_pic_span = picture.siblings("label").find("span");
        var inputLen = input.value.length;
        var file = input.files[0];
        var URL = window.URL || window.webkitURL;
        var picture_regex = new RegExp("image\/(gif|jpe?g|png)");

        // valid file (not more than 1MB, correct format: GIF, JPG, JPEG, PNG)
        if (inputLen && file.size <= (1 * 1024 * 1024) && picture_regex.test(file.type)) {
            picture.removeClass("is-invalid");
            have_picture = true;

            $('#picture_preview').attr('src', URL.createObjectURL(file));

        } // invalid file
        else if (inputLen) {
            picture.addClass("is-invalid");
            have_picture = false;

            // file format problem
            if (!picture_regex.test(file.type)) {
                if (!$('#picture_1').length) {
                    picture_1_span.html("<div class='invalid-feedback text-center' id='profile_1'>\n\
                        Please select image in GIF, JPG, JPEG, and PNG format only.\n\
                    </div>");
                }
            } else {
                $("#picture_1").remove();
            }

            // file size problem
            if (file.size > (1 * 1024 * 1024)) {
                if (!$('#picture_2').length) {
                    prod_pic_span.html("<div class='invalid-feedback text-center' id='profile_2'>\n\
                        Please make sure the image size is not more than 1MB.\n\
                    </div>");
                }
            } else {
                $("#picture_2").remove();
            }

        } // no file selected
        else {
            picture.removeClass("is-invalid");
            have_picture = false;
        }

        // restore the profile input
        if (!have_picture) {
            $("#profile_preview").attr("src", "/img/default_eventpic.png");
            picture.val('');
        }



    }

    // trigger file input
    $("#picture_preview").click(function () {
        $("input[name='event_pic']").click();
    });

    // detect file input changes
    $("input[name='event_pic']").change(function () {
        validatePicture(this);
    });

    //validate form input
    $("form").submit(function (e) {

        $(".message").text("");

        var submit = true;

        var event_picName_field = $("#event_personInCharge");
        var event_picContact_field = $("#event_picContactNo");
        var event_picEmail_field = $("#pic_email");
        var event_name_field = $("#event_name");
        var event_category_field = $("#event_cat");
        var event_otherCat_field = $("#other_category");
        var event_desc_field = $("#event_desc");
        var event_price_field = $("#event_price");
        var event_picAccNo_field = $("#pic_accNo");
        var event_capacity_field = $("#event_capacity");
        var event_date_field = $("#event_date");
        var event_duration_field = $("#event_duration");
        var event_time_field = $("#event_time");
        var event_remark_field = $("#event_remark");

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
        var event_picContact_maxLength = 15;
        var picContact_length = document.getElementById("event_picContactNo").value.length;
        var picContact_span = event_picContact_field.siblings("label").find("span");
        var picContact_regex = new RegExp('(\+?6?01)[0-46-9]-*[0-9]{7,8}');
        if (!$.trim(event_picContact_field.val())) {
            submit = false;
            picContact_span.html("<b>*</b> Empty field");
        } else if (picContact_length > event_picContact_maxLength) {
            submit = false;
            picContact_span.html("<b>*</b> The maximum character length is 15 only.");
        } else if (!picContact_regex.test(event_picContact_field)) {
            submit = false;
            picContact_span.html("<b>*</b> Contact number should be in correct format (Ex: <b>+6013-3506462</b>).");
        } else {
            picName_span.html("<b>*</b>");
        }

        //PIC email validation
        var picEmail_regex = new RegExp('^[A-Z0-9._%+-]+@([A-Z0-9-]+.){2,4}$', 'i');
        var picEmail_span = event_picEmail_field.siblings("label").find("span");

        // always clear error displayed first
        $("#pic_email").remove();

        if (isEmpty(event_picEmail_field)) {
            submit = false;
            picEmail_span.html("<b>*</b> Empty field");
        }
        else if (!picEmail_regex.test(event_picEmail_field)) {
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

        //event category validation
        var event_cat_maxLength = 20;
        var event_cat_dropdown = document.getElementById("event_cat_dropdown");
        var event_otherCat = document.getElementById("other_category");
        var event_otherCat_length = document.getElementById("other_category").value.length;
        var event_cat_span = event_category_field.siblings("label").find("span");
        submit = true;

        event_cat_dropdown.addEventListener("change", function () {
            if (event_cat_dropdown.value === "Others") {
                if (!$.trim(event_otherCat_field.val())) {
                    submit = false;
                    event_cat_span.innerHTML = "<b>*</b> Empty field";
                } else if (event_otherCat_length > event_cat_maxLength) {
                    submit = false;
                    event_cat_span.innerHTML = "<b>*</b> The maximum character length is 20 only.";
                } else {
                    event_cat_span.innerHTML = "<b>*</b>";
                }
            } else {
                event_cat_span.innerHTML = ""; // Clear any existing error message when "Other" is not selected
            }
        });

        //event description validation
        var event_desc_maxLength = 300;
        var event_length = document.getElementById("event_desc").value.length;
        var event_desc_span = event_desc_field.siblings("label").find("span");
        if (!$.trim(event_desc_field.val())) {
            submit = false;
            event_desc_span.html("<b>*</b> Empty field");
        } else if (event_length > event_desc_maxLength) {
            submit = false;
            event_desc_span.html("<b>*</b> The maximum character length is 300 only.");
        } else {
            event_desc_span.html("<b>*</b>");
        }

        //event price validation
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
        var event_name_maxLength = 15;
        var pic_accNo = document.getElementById("pic_accNo").value.length;
        var pic_accNo_regex = new RegExp(/^[0-9]*$/);
        var pic_accNo_span = event_picAccNo_field.siblings("label").find("span");
        if (!$.trim(event_picAccNo_field.val())) {
            submit = false;
            pic_accNo_span.html("<b>*</b> Empty field");
        } else if (!pic_accNo_regex.test(event_picAccNo_field.val())) {
            submit = false;
            pic_accNo_span.html("<b>*</b> The account number can be digits only.");
        } else if(pic_accNo > event_desc_maxLength){
            pic_accNo_span.html("<b>*</b> The account number can be 15 digits only.");
        }else {
            pic_accNo_span.html("<b>*</b>");
        }

        //event capacity validation
        var event_capacity_regex = new RegExp(/[1-3000]/);
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

        if (eventDate < threeWeeksFromNow) {
            // The selected date is not valid (before three weeks from now)
            submit = false;
            event_date_span.html("<b>*</b> Event date must be after three weeks from the current date.");
           
        } else {
            event_capacity_span.html("<b>*</b>");
        }

        //event duration validation
        var event_duration_regex = new RegExp(/[1-5]/);
        var event_duration_span = event_duration_field.siblings("label").find("span");
        if (!$.trim(event_duration_field.val())) {
            submit = false;
            event_duration_span.html("<b>*</b> Empty field");
        } else if (!event_duration_regex.test(event_duration_field.val())) {
            submit = false;
            event_duration_span.html("<b>*</b> The maximum duration is only 5 days.");
        } else {
            event_duration_span.html("<b>*</b>");
        }

        //event time validation
            var startTime = document.getElementById("event_startTime").value;
            var endTime = document.getElementById("event_endTime").value;
            var event_time_span = event_time_field.siblings("label").find("span");
        
            if (startTime > endTime) {
                event_time_span.html("<b>*</b>Start time cannot be later than end time.");
            } else if (endTime < startTime){
                event_time_span.html("<b>*</b>End time cannot be earlier than start time.");
            } else {
                event_time_span.html("<b>*</b>");
            }

        //



        //-----------------------------------------------
        if (!submit) {
            e.preventDefault();
        }
    });
});
