{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Subscriber User List
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>
        <div class="card-toolbar">
              <div class="dropdown dropdown-inline mr-2"></div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table table-hover">
                <thead><tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Assigned Card</th>
                    <th>Order Id</th>
                    <th>Phone</th>
                    <th>Created Date</th>
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
                  //"aTargets": [ 4 ]
              },
            ],
            "order": [[ 0, "DESC" ]],
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            ajax: "{{ route('subscriberusers.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',"width": "5%"},
                    {data: 'name', name: 'name',"width": "25%"},
                    {data: 'card_id', name: 'card_id',"width": "15%"},
                    {data: 'order_id', name: 'order_id',"width": "15%"},
                    {data: 'mobile', name: 'mobile1',"width": "15%"},
                    {data: 'created_at', name: 'created_at',"width": "15%"},
                    {data: 'action', name: 'action', orderable: false, searchable: false,"width": "10%"},
                ]
            });
            table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
        }).draw();
        //***************************** Delete Loan type********************************/
        $('body').on('click', '.deleteuser', function () {
            var user_id = $(this).data('id');
            if (confirm("Are you sure want to delete !")) {
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
            }
        });
});
</script>
@endsection
