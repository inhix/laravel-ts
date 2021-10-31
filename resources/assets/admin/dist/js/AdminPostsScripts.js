function deletePost(id, csrfToken) {
    let answer = confirm('Are you sure?');
    if (answer === true)
        $.ajax({
            type: "DELETE",
            url: "/admin/posts/" + id,
            data: {
                "_token": csrfToken,
                "id": id
            }
        }).done(
            $('#PostsTable tbody').on('click', '.delete', function () {
                $('#PostsTable').DataTable().row($(this).parents('tr')).remove().draw();
            }))
}
