$(document).ready(function () {
    $("#PostsTable").DataTable();
    $("#TagsTable").DataTable();
    $("#CategoriesTable").DataTable();
    $("#UsersTable").DataTable();
    $("#MatchesTable").DataTable();
    $("#PlayersTable").DataTable();
    $(".select2").select2();
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yy'
    });

});
