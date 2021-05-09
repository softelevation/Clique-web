{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">System Admin List
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>
        <div class="card-toolbar">
            <div class="dropdown dropdown-inline mr-2"></div>
            <a href="{{ url('admin/create/system-admin') }}" class="btn btn-primary font-weight-bolder mr-2">
                <i class="icon-2x text-white-50 flaticon-users-1"></i> Add System Admin
            </a>

        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    {{-- <th>Email</th> --}}
                    <th>Phone</th>
                    <th>Created Date</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div id="reset_password" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-default broker-popup-width">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-key text-primary"></i> Reset Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form  name="update-password" id="update-password" action="" method="post" enctype="multipart/form-data"  onsubmit="return false;">
                {{csrf_field()}}
                <input type="hidden" name="user_id" id="user_id" value="">
                <input type="hidden" name="user_email" id="user_email" value="">
                    <div class="modal-body mt-4">
                        <div class="user-email mb-1 mt-1 d-none"></div>
                        <div class="form-group">
                            <label for="bs">Password*</label>
                             <input type="text" class="form-control form-control-solid" name="password" id="password" value="" placeholder="New Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="update-pass" class="btn btn-primary update-pass">Reset Password</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection
{{-- Styles Section --}}
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
{{-- Scripts Section --}}
@section('scripts')
    {{-- vendors --}}
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    {{-- page scripts --}}
    <script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script>
    $(function () {
            var column_name = "DT_RowIndex";
            var table = $('.data-table').DataTable({
            processing: true,
            pageLength: 10,
            serverSide: true,
            searching: true,
            info: true,
            autoWidth:false,
            responsive: true,
            aoColumnDefs: [
                {
                  "bSearchable": true,
                  "bVisible": false,
                },
            ],
            "order": [[ 0, "DESC" ]],
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            ajax: "{{ route('systemadmin.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    // {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile1'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
        }).draw();
//***************************** Delete User ********************************/

        $('body').on('click', '.deleteuser', function () {
            var user_id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure want to delete!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it",
                cancelButtonText: "No, cancel",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                        $.ajax({
                            url: '{{ url("admin/users/destroy") }}',
                            type: "POST",
                            data:{id:user_id},
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            dataType: "json",
                            success: function(data) {
                                table.draw();
                                }
                    });

                    Swal.fire(
                        "Deleted!",
                        "User has been deleted.",
                        "success"
                    )
                    // result.dismiss can be "cancel", "overlay",
                    // "close", and "timer"
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelled",
                        "Your User is safe :)",
                        "error"
                    )
                }
            });

        });


//******************************** Reset Password ************************************//

        $('body').on('click', '.resetpassword', function () {
            var user_id = $(this).data('id');
            var user_email =  $(this).data('email');
            $(".user-email").text(user_email);
            $("#user_id").val(user_id);
            $("#user_email").val(user_email);
            $('#reset_password').modal('show');
            $('#reset_password')[0].reset();
        });

        $('.modal-footer').on('click', '.update-pass', function (e) {
            $("#update-password").validate({
                rules: {
                    password: { required: true, minlength: 8 },
                },
                messages: {
                    password: { required: "Please enter password", minlength: "Please enter password minimum 8 length."  },
                },
                submitHandler: function(form,event) {
                    event.preventDefault();
                    var myform = document.getElementById("update-password");
                    var formData = new FormData(myform);
                    $.ajax({
                        url: '{{ url("admin/update-password") }}',
                        type: "POST",
                        data:formData,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function( response ) {
                                var password = $('#password').val();
                                var user_email = $('#user_email').val();
                                $('#reset_password').modal('hide');
                                table.draw();
                            }
                    });
                }
            });
        });

});
</script>
@endsection
