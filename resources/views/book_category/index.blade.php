@extends('layouts.app')
@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="d-flex justify-content-between card-header">
            All Book Category List
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AddCategoryModel">
                <i class="fa fa-book"></i> Create
            </button>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name </th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Add Modal Start -->
<div class="modal fade" id="AddCategoryModel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Book Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input placeholder="Category Name" id="name" type="text" class="form-control" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <span id="name_error" class="text-danger" role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="add_Category">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- Add Modal End --}}
{{-- Edit Modal Start --}}
<div class="modal fade" id="EditModel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Book Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_category_id">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input placeholder="Category Name" id="edit_name" type="text" class="form-control" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <span id="edit_name_error" class="text-danger" role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="update_Category">Update</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit Modal End --}}
{{-- Delete Modal Start --}}
<div class="modal fade" id="DeleteModel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Book Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="delete_category_id">
                    <h4>Are your Sure! Went To Delete Data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="delete_category_option">Yes Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- Delete Modal End --}}

<script>
    function clearData() {
        $('#name').val(''),
            $('#name_error').val('')
    }
    // All Category Books
    function allBookCategory() {
        $.ajax({
            type: "GET",
            url: "/allcategory",
            dataType: "json",
            success: function (response) {
                var data = ""
                $.each(response, function (key, value) {
                    data = data + "<tr>"
                    data = data + "<td>" + value.id + "</td>"
                    data = data + "<td>" + value.name + "</td>"
                    data = data + "<td>"
                    data = data +
                        "<button class='btn btn-primary btn-sm mr-2' id='edit_category' value='" +
                        value.id + "'>Edit</button>"
                    data = data +
                        "<button class='btn btn-danger btn-sm' id='show_delete' value='" +
                        value.id + "'>Delete</button>"
                    data = data + "</td>"
                    data = data + "</tr>"
                })
                $('tbody').html(data);
            }
        });
    }
    allBookCategory();

    // AJAX
    $(document).ready(function () {
        // Add Books Category
        $(document).on('click', '#add_Category', function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/bookcategory",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    name: $('#name').val()
                },
                dataType: "json",
                success: function (response) {
                    clearData();
                    $('#AddCategoryModel').modal('hide');
                    allBookCategory();
                    console.log(response);
                },
                error:function(error){
                        $('#name_error').text(error.responseJSON.errors.name);
                    }
            });
        });

        // Edit Book Category
        $(document).on('click', '#edit_category', function (e) {
            e.preventDefault();
            var category_id = $(this).val();
            $("#EditModel").modal('show');
            $.ajax({
                type: "GET",
                url: "bookcategory/" + category_id + "/edit",
                success: function (response) {
                    $('#edit_name').val(response.data.name);
                    $('#edit_category_id').val(category_id);
                }
            });
            // Update Book Category
            $(document).on('click', '#update_Category', function (e) {
                e.preventDefault();
                var category_id = $('#edit_category_id').val();
                $.ajax({
                    type: "PUT",
                    url: "/bookcategory/"+category_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {name: $('#edit_name').val()},
                    dataType: "json",
                    success: function (response) {
                        clearData();
                        $('#EditModel').modal('hide');
                        allBookCategory();
                    },
                    error:function(error){
                        $('#edit_name_error').text(error.responseJSON.errors.name);
                    }
                });

            });

        });

        // Delete Book Category
            $(document).on('click', '#show_delete', function (e) {
                e.preventDefault();
                var category_id = $(this).val();
                $('#delete_category_id').val(category_id);
                $('#DeleteModel').modal('show');

            });

            // Final Delete Book Category
            $(document).on('click','#delete_category_option', function (e) {
                e.preventDefault();
                var category_id = $('#delete_category_id').val();
                $.ajax({
                    type: "DELETE",
                    url: "bookcategory/" + category_id,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    success: function (response) {
                        $('#DeleteModel').modal('hide');
                        allBookCategory();
                        console.log(response);
                    }
                });
            });
    });

</script>
@endsection
