{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Corporate Request List<div class="text-muted pt-2 font-size-sm"></div></h3>
        </div>
        <div class="card-toolbar">
               <div class="dropdown dropdown-inline mr-2"></div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table table-hover">
            <thead><tr>
                <th>N0.</th>
                <th>Corporate Name</th>
                <th>Contact Person</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Created At</th>
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
                ajax: "{{ route('corporate.request.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'corporate_name', name: 'corporate_name',"width": "10%"},
                    {data: 'contact_person', name: 'contact_person',"width": "10%"},
                    {data: 'address', name: 'address',"width": "30%"},
                    {data: 'email', name: 'email',"width": "20%"},
                    {data: 'phone', name: 'phone',"width": "10%"},
                    {data: 'created_at', name: 'created_at',"width": "10%"},
                    {data: 'action', name: 'action', orderable: false, searchable: false,"width": "10%"},
                ]
            });


//***************************** Delete order ********************************/
$('body').on('click', '.deleterequest', function () {
    var request_id = $(this).data('id');
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
                        url: '{{ url("admin/corporaterequest/destroy") }}',
                        type: "POST",
                        data:{id:request_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        success: function(data) {
                            table.draw();
                        }
                    });
                    Swal.fire(
                        "Deleted!",
                        "Corporate Request has been deleted.",
                        "success"
                    )

                } else if (result.dismiss === "cancel") {

                }
            });

});




});
</script>
@endsection
