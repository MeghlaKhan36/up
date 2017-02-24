$(document).ready(function() {
    // Table sorting
    var filesTable = $('.files-table').DataTable({
        "sDom": '<"top">rt<"bottom"p><"clear">',
        "paging": false,
        "order": [[4, "table-date"]],
        "autoWidth": false,
    });

    $('.files-table .sortable').on('click', function() {
        $('.fa-caret-down').remove();
        $(this).addClass('active-heading');
        $(this).append("<i class='fa fa-caret-down' aria-hidden='true'></i>");
    });

});