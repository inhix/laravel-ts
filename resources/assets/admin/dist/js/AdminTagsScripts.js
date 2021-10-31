function deleteTag(id, csrfToken) {
    let answer = confirm('Are you sure?');
    if (answer === true)
        $.ajax({
            type: "DELETE",
            url: "/admin/tags/" + id,
            data: {
                "_token": csrfToken,
                "id": id
            }
        }).done($('#TagsTable tbody').on('click', '.delete', function () {
                $('#TagsTable').DataTable().row($(this).parents('tr')).remove().draw();
            })
        )
}

