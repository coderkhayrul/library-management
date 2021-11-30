@extends('layouts.app')
@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="d-flex justify-content-between card-header">
            All Book List
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AddBookModel">
                <i class="fa fa-book"></i> Create Book
            </button>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name </th>
                        <th scope="col">Author Name </th>
                        <th scope="col">Category</th>
                        <th scope="col">Status</th>
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
<div class="modal fade" id="AddBookModel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Book Name</label>
                    <input placeholder="Category Name" id="name" type="text" class="form-control" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <span id="name_error" class="text-danger" role="alert"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Author Name</label>
                    <input placeholder="Author Name" id="author_name" type="text" class="form-control" name="author_name"
                        value="{{ old('author_name') }}" required autocomplete="author_name" autofocus>
                    <span id="author_name_error" class="text-danger" role="alert"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option disabled selected> Select Category</option>
                        @foreach ($bookCategories as $category)
                        <option value="{{ $category->id }}"> {{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span id="category_id_error" class="text-danger" role="alert"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
                    <span id="description_error" class="text-danger" role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="add_book">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- Add Modal End --}}

<!--Edit Modal Start -->
<div class="modal fade" id="EditBookModel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_book_id">
                <div class="form-group">
                    <label for="exampleInputEmail1">Book Name</label>
                    <input placeholder="Category Name" id="edit_name" type="text" class="form-control" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                    <span id="name_error" class="text-danger" role="alert"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Author Name</label>
                    <input placeholder="Author Name" id="edit_author_name" type="text" class="form-control" name="author_name"
                        value="{{ old('author_name') }}" required autocomplete="author_name" autofocus>
                    <span id="author_name_error" class="text-danger" role="alert"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <select name="category_id" id="edit_category_id" class="form-control">
                        <option disabled selected> Select Category</option>
                        @foreach ($bookCategories as $category)
                        <option value="{{ $category->id }}"> {{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span id="category_id_error" class="text-danger" role="alert"></span>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <textarea name="description" id="edit_description" class="form-control" placeholder="Description"></textarea>
                    <span id="description_error" class="text-danger" role="alert"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="update_book">Update</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit Modal End --}}
{{-- Delete Modal Start --}}
<div class="modal fade" id="DeleteBookModel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="delete_book_id">
                    <h4>Are your Sure! Went To Delete Data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="delete_book">Yes Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- Delete Modal End --}}



<script>
    // ClearData
    function clearData() {
        $('#name').val(''),
        $('#author_name').val(''),
        $('#category_id').val(''),
        $('#description').val(''),
        $('#error_name').val(''),
        $('#error_author_name').val(''),
        $('#errro_description').val('')
    }
    // GET ALL Books
    function allBooks(){
        $.ajax({
        type: "GET",
        url: "/allbook",
        dataType:"json",
        success: function(response) {
            var data = ""
            console.log(response);

            $.each(response, function(key, value) {
                data = data + "<tr>"
                data = data + "<td>" + value.id + "</td>"
                data = data + "<td>" + value.name + "</td>"
                data = data + "<td>" + value.author_name + "</td>"
                data = data + "<td>" + value.category_id + "</td>"
                data = data + "<td>" + value.status + "</td>"
                data = data + "<td>"
                data = data + "<button class='btn btn-primary btn-sm mr-2' id='edit_book' value='"+value.id+"'>Edit</button>"
                data = data + "<button class='btn btn-danger btn-sm' id='show_delete_book' value='"+value.id+"'>Delete</button>"
                data = data + "</td>"
                data = data + "</tr>"
            })
            $('tbody').html(data);
        }
    });
    }
    allBooks();

    // AJAX
    $(document).ready(function () {
        // Book Create
        $(document).on('click', '#add_book', function (e) {
            e.preventDefault();
            var data = {
                'name': $('#name').val(),
                'author_name': $('#author_name').val(),
                'category_id': $('#category_id').val(),
                'description': $('#description').val(),
            }
            $.ajax({
                type: "POST",
                url: "/book",
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                dataType: "json",
                success: function (response) {
                    clearData();
                    $('#AddBookModel').modal('hide');
                    allBooks();
                    console.log(response);
                },
                error: function (error){
                    $('#name_error').text(error.responseJSON.errors.name);
                    $('#author_name_error').text(error.responseJSON.errors.author_name);
                    $('#category_id_error').text(error.responseJSON.errors.category_id);
                    $('#description_error').text(error.responseJSON.errors.description);
                }
            });
        });

        // Book Edit
        $(document).on('click', '#edit_book', function (e) {
            e.preventDefault();
            var book_id = $(this).val();
            $('#EditBookModel').modal('show');
            $.ajax({
                type: "GET",
                url: "book/"+book_id+"/edit",
                success: function (response) {
                    $('#edit_name').val(response.book.name);
                    $('#edit_author_name').val(response.book.author_name);
                    $('#edit_category_id').val(response.book.category);
                    $('#edit_description').val(response.book.description);
                    $('#edit_book_id').val(book_id);
                }
            });
        });
        // Update Book
        $(document).on('click','#update_book', function (e) {
            e.preventDefault();
            var book_id = $('#edit_book_id').val();
            var data = {
                'name': $('#edit_name').val(),
                'author_name': $('#edit_author_name').val(),
                'category_id': $('#edit_category_id').val(),
                'description': $('#edit_description').val(),
            }
            $.ajax({
                type: "PUT",
                url: "/book/"+book_id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: data,
                dataType: "json",
                success: function (response) {
                    allBooks();
                    console.log(response);
                },
                error: function (error){
                    $('#name_error').text(error.responseJSON.errors.name);
                    $('#author_name_error').text(error.responseJSON.errors.author_name);
                    $('#category_id_error').text(error.responseJSON.errors.category_id);
                    $('#description_error').text(error.responseJSON.errors.description);
                }
            });
        });

        // Delete Book
        $(document).on('click', '#show_delete_book', function (e) {
            e.preventDefault();
            var book_id = $(this).val();
            $('#delete_book_id').val(book_id);
            $('#DeleteBookModel').modal('show');
        });

        $(document).on('click', '#delete_book', function (e) {
            e.preventDefault();
            var book_id = $('#delete_book_id').val();
            $.ajax({
                type: "DELETE",
                url: "/book/"+book_id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (response) {
                    console.log(response);
                    $('#DeleteBookModel').modal('hide');
                    allBooks();

                }
            });
        });
    });
</script>
@endsection
