$(document).ready(function () {
    $.ajax({
        url: 'landingPage.php',
        type: 'post',
        data: {},
        success: function (response) {
            $('#response').html(response);
        }
    });
});
