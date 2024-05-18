function deleteData(route, id) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'POST',
                url: route,
                data: {
                    '_method': 'DELETE',
                    '_token': CSRF_TOKEN
                },
                success: function(data) {
                    swal({
                        title: "Delete Done!",
                        text: "The record has been deleted!",
                        icon: "success",
                        button: "Done",
                    });
                    $("#row_" + id).remove();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX Error:", textStatus, errorThrown);
                    console.log("Response Text:", jqXHR.responseText);
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        timer: 1500
                    });
                }
            });
        } else {
            swal("Your imaginary file is safe!");
        }
    });
}
