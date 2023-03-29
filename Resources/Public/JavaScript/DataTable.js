define(['tablesort'], function($) {
    var Module = {};

    Module.initializeDataTables = function() {
        new Tablesort(
            document.getElementById('h5p-content')
        );

        new Tablesort(
            document.getElementById('h5p-library')
        );
    };

    document.addEventListener("DOMContentLoaded",function() {
        Module.initializeDataTables();
    });
});