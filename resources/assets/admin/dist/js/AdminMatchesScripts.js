function deleteMatch(id, csrfToken) {
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
            $('#MatchesTable tbody').on('click', '.delete', function () {
                $('#MatchesTable').DataTable().row($(this).parents('tr')).remove().draw();
            }))
}
