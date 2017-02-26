$(document).ready(function() {

    $('#mobile-nav').on('click', function() {
       $('#mobile-nav').toggleClass('active');
    });

    // Sweetalert prompt for account deactivation
    $('#deactivate').on('click', function() {
        swal({
            title: "Are you sure?",
            text: "You will not be able to log in again",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#00B0FF",
            confirmButtonText: "I'm sure",
            closeOnConfirm: true
        },
        function(isConfirm){
            if ( !isConfirm ) {
                $('#deactivate').prop('checked', false);
            }
        });
    });

    // Custom file input box
    $('.file-input').on('change', function(e) {
        var file = '';
        var name = '';
        file = $('input[type=file]').val();
        name = file.split('\\').pop();
        $('#filename').text(name);
    });

    $('.table-icon.delete').on('click', function(e) {
        e.preventDefault();
        var file = $(this);
        swal({
                title: "Delete",
                text: "You will not be able to access the file again",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00B0FF",
                confirmButtonText: "Delete",
                closeOnConfirm: true
            },
            function(isConfirm){
                if ( isConfirm ) {
                    file.parent().parent().hide();
                    $.ajax({
                        url: $(file).attr('data-url')
                    });
                }
            });
    });

});
