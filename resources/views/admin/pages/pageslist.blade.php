{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Pages List<div class="text-muted pt-2 font-size-sm"></div></h3>
        </div>
        <div class="card-toolbar">
            <div class="dropdown dropdown-inline mr-2"></div>
            <a href="{{ url('admin/create-pages') }}" class="btn btn-primary font-weight-bolder">
                <i class="ki ki-plus icon-sm"></i> Add Page
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table table-hover">
            <thead><tr>
                    <th>No</th>
                    <th>Title</th>
                    <th width="150px">Action</th>
            </tr></thead>
            <tbody></tbody>
        </table>
    </div>
</div>
@endsection
@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
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
                        ajax: "{{ route('pages.list') }}",
                        columns: [
                                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                {data: 'title', name: 'title'},
                                {data: 'action', name: 'action', orderable: false, searchable: false},
                            ]
                    });
                    table.on( 'order.dt search.dt', function () {
                        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    });
                    }).draw();
//***************************** Delete Loan type********************************/
    $('body').on('click', '.deletepage', function () {
        var page_id = $(this).data('id');
            if ( confirm("Are you sure want to delete !")) {
            $.ajax({
                    url: '{{ url("admin/pages/destroy") }}',
                    type: "POST",
                    data:{id:page_id},
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    success: function(data) {
                        table.draw();
                        }
            });
        }
    });

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
