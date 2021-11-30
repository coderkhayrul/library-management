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
<div class="col-md-3">
</div>
<div class="col-md-5">
    <div class="card">
        <div class="card-header">
            Book Issue
        </div>
        <div class="card-body">
            Book Issue
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card">
        <div class="card-header">
            Book Return
        </div>
        <div class="card-body">
            Book Return
        </div>
    </div>
</div>
@endsection
