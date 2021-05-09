{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Testimonials List
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>
        <div class="card-toolbar">
            <div class="dropdown dropdown-inline mr-2"></div>
            <a href="{{ url('admin/create-testimonials') }}" class="btn btn-primary font-weight-bolder">
                    <i class="ki ki-plus icon-sm"></i> Add Testimonial
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Tagline</th>
                    <th width="150px">Action</th>
                </tr>
            </thead>
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
                    ajax: "{{ route('testimonials.list') }}",
                        columns: [
                            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                            {data:'image', name:'image'},
                            {data: 'name', name: 'name'},
                            {data: 'tagline', name: 'tagline'},
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
            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure want to delete!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: '{{ url("admin/testimonials/destroy") }}',
                        type: "POST",
                        data:{id:page_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        success: function(data) {
                            table.draw();
                        }
                    });

                    Swal.fire(
                        "Deleted!",
                        "Testimonials has been deleted.",
                        "success"
                    )
                    // result.dismiss can be "cancel", "overlay",
                    // "close", and "timer"
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelled",
                        "Your Testimonials is safe :)",
                        "error"
                    )
                }
            });

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

});

</script>
@endsection
