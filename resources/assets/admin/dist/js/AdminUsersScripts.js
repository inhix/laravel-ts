function deleteUser(id, csrfToken) {
    let answer = confirm('Are you sure?');
    if (answer === true)
        $.ajax({
            type: "DELETE",
            url: "/admin/users/" + id,
            data: {
                "_token": csrfToken,
                "id": id
            }
        }).done($('#UsersTable tbody').on('click', '.delete', function () {
            $('#UsersTable').DataTable().row($(this).parents('tr')).remove().draw();
        }))
}
