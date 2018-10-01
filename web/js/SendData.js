$(document).ready(function(){
    $('#send-data').on('submit', function () {
        var details = $(this).serialize();
        var url = "./includes/save_file.php";
        $.post(url, details, function() {

        });
    });
});

