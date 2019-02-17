define(['jquery', 'datatables'], function($) {
    var Module = {};

    Module.initializeDataTables = function() {
        $('#h5p-content').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 6 }
            ],
            "lengthMenu": [[10, 25, 50, 100, 200, 500], [10, 25, 50, 100, 200, 500]]
        });
        $('#h5p-library').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": 5 }
            ],
            "lengthMenu": [[10, 25, 50, 100, 200, 500], [10, 25, 50, 100, 200, 500]]
        });
    };

    $(document).ready(function() {
        Module.initializeDataTables();
    });
});