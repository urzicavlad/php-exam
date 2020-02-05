$(document).ready(function () {
    $("#username").keyup(function () {
        let username = $(this).val().trim();
        if (username !== '') {
            $.ajax({
                url: 'check.php',
                type: 'post',
                data: {username: username},
                success: function (response) {
                    $('#user-availability-status').html(response);
                }
            });
        } else {
            $("#user-availability-status").html("");
        }
    });

    $("#email").keyup(function () {
        let email = $(this).val().trim();
        if (email !== '') {
            $.ajax({
                url: 'check.php',
                type: 'post',
                data: {email: email},
                success: function (response) {
                    $('#email-availability-status').html(response);
                }
            });
        } else {
            $("#email-availability-status").html("");
        }
    });
});
