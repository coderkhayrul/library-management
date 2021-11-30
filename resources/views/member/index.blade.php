@extends('layouts.app')
@section('content')
<div class="col-md-9">
    <div class="card">
        <div class="d-flex justify-content-between card-header">
            All Member List
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#AddMemberModel">
                <i class="fa fa-user"></i> Create Member
            </button>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name </th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
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
<div class="modal fade" id="AddMemberModel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Create Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input placeholder="Full Name" id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <span id="name_error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Address</label>
                        <input placeholder="Email Address" id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span id="email_error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <input placeholder="Phone Number" id="phone" type="text" class="form-control " name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                        <span id="phone_error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <textarea placeholder="Address" class="form-control" name="address" id="address" value="{{ old('address') }}" required autocomplete="address"></textarea>

                        <span id="address_error" class="text-danger" role="alert"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="add_Member">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- Add Modal End --}}

{{-- Edit Modal Start --}}
<div class="modal fade" id="EditMemberModel" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <input type="hidden" id="edit_member_id">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input placeholder="Full Name" id="edit_name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <span id="edit_name_error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email Address</label>
                        <input placeholder="Email Address" id="edit_email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span id="edit_email_error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <input placeholder="Phone Number" id="edit_phone" type="text" class="form-control " name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                        <span id="edit_phone_error" class="text-danger" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Address</label>
                        <textarea placeholder="Address" class="form-control" name="address" id="edit_address" value="{{ old('address') }}" required autocomplete="address"></textarea>

                        <span id="edit_address_error" class="text-danger" role="alert"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="update_member">Update</button>
            </div>
        </div>
    </div>
</div>
{{-- Edit Modal End --}}

{{-- Delete Modal Start --}}
<div class="modal fade" id="DeleteMemberModel" data-backdrop="static" data-keyboard="false" tabindex="-1"
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
                    <input type="hidden" id="delete_member_id">
                    <h4>Are your Sure! Went To Delete Data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger" id="delete_member">Yes Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- Delete Modal End --}}

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script>
    function clearData() {
        $('#name').val(''),
        $('#email').val(''),
        $('#phone').val(''),
        $('#address').val(''),
        $('#name_error').val(''),
        $('#email_error').val(''),
        $('#phone_error').val(''),
        $('#address_error').val('')
    }

    // GET ALL MEMBER
    function allMember(){
        $.ajax({
        type: "GET",
        url: "/memberall",
        dataType:"json",
        success: function(response) {
            var data = ""
            $.each(response, function(key, value) {
                data = data + "<tr>"
                data = data + "<td>" + value.id + "</td>"
                data = data + "<td>" + value.name + "</td>"
                data = data + "<td>" + value.email + "</td>"
                data = data + "<td>" + value.phone + "</td>"
                data = data + "<td>"
                data = data + "<button class='btn btn-primary btn-sm mr-2' id='edit_member' value='"+value.id+"'>Edit</button>"
                data = data + "<button class='btn btn-danger btn-sm' id='show_delete_member' value='"+value.id+"'>Delete</button>"
                data = data + "</td>"
                data = data + "</tr>"
            })
            $('tbody').html(data);
        }
    });
    }
    allMember();


$(document).ready(function() {
    // ADD MEMBER MODAL
    $(document).on('click', '#add_Member', function(e) {
        e.preventDefault();
        var data = {
            'name': $('#name').val(),
            'email': $('#email').val(),
            'phone': $('#phone').val(),
            'address': $('#address').val(),
        }
        $.ajax({
            type: "POST",
            url: "{{ route('member.store') }}",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:data,
            dataType: "json",
            success: function(response) {
                $('#AddMemberModel').modal('hide');
                allMember();
                console.log(response);
            },
            error: function(error){
                $('#name_error').text(error.responseJSON.errors.name);
                $('#email_error').text(error.responseJSON.errors.email);
                $('#phone_error').text(error.responseJSON.errors.phone);
                $('#address_error').text(error.responseJSON.errors.address);
            }
        })
    })

    // EDIT MEMBER MODAL
    $(document).on('click','#edit_member', function(e) {
        e.preventDefault();
        var member_id = $(this).val();
        $("#EditMemberModel").modal('show');
        $.ajax({
            type: "GET",
            url: "member/"+member_id+"/edit",
            success: function(response){
                $('#edit_name').val(response.member.name);
                $('#edit_email').val(response.member.email);
                $('#edit_phone').val(response.member.phone);
                $('#edit_address').val(response.member.address);
                $('#edit_member_id').val(member_id);
            }
        })
    })

    // UPDATE MEMBER MODAL
    $(document).on('click','#update_member', function (e) {
        e.preventDefault();
        var member_id = $('#edit_member_id').val();
        var data= {
            'name' : $('#edit_name').val(),
            'email' : $('#edit_email').val(),
            'phone' : $('#edit_phone').val(),
            'address' : $('#edit_address').val(),
        }
        $.ajax({
            type: "PUT",
            url: "/member/"+member_id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: "json",
            data: data,
            success: function(response){
                $('#EditMemberModel').modal('hide');
                allMember();
                clearData();
                console.log(response);
            },
            error:function(error){
                $('#edit_name_error').text(error.responseJSON.errors.name);
                $('#edit_email_error').text(error.responseJSON.errors.email);
                $('#edit_phone_error').text(error.responseJSON.errors.phone);
                $('#edit_address_error').text(error.responseJSON.errors.address);
            }
        })
    });
    
    // Delete Member
    $(document).on('click', '#show_delete_member', function (e) {
        e.preventDefault();
        var member_id = $(this).val();
        $('#delete_member_id').val(member_id);
        $('#DeleteMemberModel').modal('show');
    });
    $(document).on('click', '#delete_member', function (e) {
        e.preventDefault();
        var member_id = $('#delete_member_id').val();
        $.ajax({
            type: "DELETE",
            url: "/member/"+member_id,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (response) {
                $('#DeleteMemberModel').modal('hide');
                allMember();
                console.log(response);
            }
        });
    });

})

</script>

@endsection
