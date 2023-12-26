$(document).ready(function () {

    //validate form input
    $("#submit_form2").on('click', function (e) {

        e.preventDefault();

        $(".message").text("");

        var submit = true;

        var event_picName_field = $("#event_personInCharge");
        var event_picContact_field = $("#event_picContactNo");
        var event_picEmail_field = $("#pic_email");
        var event_name_field = $("#event_name");
        var event_remark_field = $("#remark");
        var event_desc_field = $("#event_desc");
        var event_price_field = $("#event_price");
        var event_picAccNo_field = $("#pic_accNo");
        var event_capacity_field = $("#event_capacity");
        var event_date_field = $("#event_date");
        var event_duration_field = $("#event_duration");
        var event_time_field = $("#event_time");
        var event_start_time_field = $("#event_startTime");
        var event_end_time_field = $("#event_endTime");


        //PIC name validation
        var event_picName_maxLength = 100;
        var picName_length = document.getElementById("event_personInCharge").value.length;
        var picName_span = event_picName_field.siblings("span");

        if (!$.trim(event_picName_field.val())) {
            submit = false;
            picName_span.html("<b>*</b> Empty field");

        } else if (picName_length > event_picName_maxLength) {
          
            submit = false;
            picName_span.html("<b>*</b> The maximum character length is 100 only.");
        } else {
            picName_span.html("");
        }


        //PIC contact number validation
        var event_picContact_maxLength = 12;
        var picContact_length = document.getElementById("event_picContactNo").value.length;
        var picContact_span = event_picContact_field.siblings("span");
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
            picContact_span.html("");
        }


        //PIC email validation
        var picEmail_regex = new RegExp('^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$');
        var picEmail_span = event_picEmail_field.siblings("span");
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
            picEmail_span.html("");
        }


        //event name validation
        var event_name_maxLength = 100;
        var event_name_length = document.getElementById("event_name").value.length;
        var event_name_span = event_name_field.siblings("span");
        if (!$.trim(event_name_field.val())) {
            submit = false;
            event_name_span.html("<b>*</b> Empty field");
        } else if (event_name_length > event_name_maxLength) {
            submit = false;
            event_name_span.html("<b>*</b> The maximum character length is 100 only.");
        } else {
            event_name_span.html("");
        }



        //event description validation
        var event_desc_maxLength = 600;
        var event_desc_length = document.getElementById("event_desc").value.length;
        var event_desc_span = event_desc_field.siblings("span");

        if (event_desc_length > event_desc_maxLength) {
            submit = false;
            event_desc_span.html("<b>*</b> The maximum character length is 600 only.");
        }


        //event price validation
        var event_price_regex = /^(0(?:\.\d{1,2})?|[1-9]\d{0,2}(?:\.\d{1,2})?)$/;
        var event_price_span = event_price_field.siblings("span");
        if (!$.trim(event_price_field.val())) {
            submit = false;
            event_price_span.html("<b>*</b> Empty field");
        } else if (!event_price_regex.test(event_price_field.val())) {
            submit = false;
            event_price_span.html("<b>*</b> The price can contain maximum 3 digits and 2 decimal places only.");
        } else {
            event_price_span.html("");
        }


        //event PIC beneficiary account number validation
        var event_picAcc_maxLength = 15;
        var pic_accNo = document.getElementById("pic_accNo").value.length;
        var pic_accNo_regex = new RegExp(/^[0-9]*$/);
        var pic_accNo_span = event_picAccNo_field.siblings("span");

        if (event_price_field.val() != 0.00) {
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
                pic_accNo_span.html("");
            }
        }



        //event capacity validation
        var event_capacity_regex = new RegExp(/[1-3000]/ );
        var event_capacity_span = event_capacity_field.parent().next("td").find("span");
        if (!$.trim(event_capacity_field.val())) {
            submit = false;
            event_capacity_span.html("<b>*</b> Empty field");
        } else if (!event_capacity_regex.test(event_capacity_field.val())) {
            submit = false;
            event_capacity_span.html("<b>*</b> The maximum capacity is only 3000 only.");
        } else {
            event_capacity_span.html("");
        }

        //event date validation
        var event_date_span = event_date_field.siblings("span");
        var currentDate = new Date(); // Get the current date
        var threeWeeksFromNow = new Date(currentDate.getTime() + 21 * 24 * 60 * 60 * 1000); // Calculate date three weeks from now
        
        if (!$.trim(event_date_field.val())) {
            submit = false;
            event_date_span.html("<b>*</b> Empty field");
        } else {
            // Try to parse the entered date
            var enteredDate = new Date(event_date_field.val());
        
            // Check if the entered date is a valid date and is earlier than or equal to the current date
            if (isNaN(enteredDate) || enteredDate <= currentDate) {
                // The selected date is not valid (empty, not a valid date, or earlier than or equal to the current date)
                submit = false;
                event_date_span.html("<b>*</b> Event date must be after the current date.");
            } else {
                event_date_span.html("");
            }
        }

        //event duration validation
        var event_duration_max = 1;
        var event_duration_regex = new RegExp(/[1-5]/);
        var event_duration_length = document.getElementById("event_duration").value.length;
        var event_duration_span = event_duration_field.siblings("span");
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
            event_duration_span.html("");
        }


        //event time validation
        var startTime = event_start_time_field.val();
        var endTime = event_end_time_field.val();
        var event_time_span =  event_start_time_field.parent().siblings("span");

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
            event_time_span.html("");
        }

        //event description validation
        var event_remark_maxLength = 300;
        var event_remark_length = document.getElementById("remark").value.length;
        var event_remark_span = event_remark_field.siblings("span");
        console.log(event_remark_span);

        if (event_remark_length > event_remark_maxLength) {
            submit = false;
            event_remark_span.html("<b>*</b> The maximum character length is 300 only.");
        }else {
            event_time_span.html("");
        }


        console.log(submit);


        if (submit) {
            $("#form1").submit();
        }

    });
});
