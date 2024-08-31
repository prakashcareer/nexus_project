$(document).ready(function() {
    $("#Feedbackform").submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "../public/feedback_action.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function(data) {
                var res = $.parseJSON(data);
                if (res.status == "success") {
                    swal({
                        title: 'Success',
                        text: res.msg,
                        icon: 'success',
                        buttons: false,
                        timer: 2000
                    }).then(function() {
                        window.location.href = "feedback.php";
                    });
                } else if (res.status == "error") {
                    $.each(res.errors, function(key, message) {
                        $('.error_' + key).html(message);
                    });
                } else {
                    swal({
                        title: 'Error',
                        text: res.msg,
                        icon: 'error'
                    });
                }
            }
        });
    });
});
