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
                        <option disabled> Select Category</option>
                        @foreach ($bookCategories as $category)
                        <option value="{{ $category->name }}"> {{ $category->name }}</option>
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

<script>
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
    // Book Create
    $(document).ready(function () {
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
                url: "book",
                data: data,
                dataType: "json",
                success: function (response) {
                    console.log(response);
                }
            });
        });
    });
</script>
@endsection
