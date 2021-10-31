function deletePlayer(id, csrfToken) {
    let answer = confirm('Are you sure?');
    if (answer === true)
        $.ajax({
            type: "DELETE",
            url: "/admin/matches/" + id,
            data: {
                "_token": csrfToken,
                "id": id
            }
        }).done(
            $('#PlayersTable tbody').on('click', '.delete', function () {
                $('#PlayersTable').DataTable().row($(this).parents('tr')).remove().draw();
            }))
}
