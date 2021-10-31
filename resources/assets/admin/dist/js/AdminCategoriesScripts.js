function deleteCategory(id, csrfToken) {
    let answer = confirm('Are you sure?');
    if (answer === true)
        $.ajax({
            type: "DELETE",
            url: "/admin/categories/" + id,
            data: {
                "_token": csrfToken,
                "id": id
            }
        }).done($('#CategoriesTable tbody').on('click', '.delete', function () {
            $('#CategoriesTable').DataTable().row($(this).parents('tr')).remove().draw();
        }))
}

