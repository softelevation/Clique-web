{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Card List
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>
        <div class="card-toolbar">
              &nbsp;&nbsp;&nbsp;
            <a href="{{ url('admin/card/create') }}" class="btn btn-primary font-weight-bolder">
                <i class="ki ki-plus icon-sm"></i> Add Card
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table table-hover">
            <thead><tr>
                    <th>No</th>
                    <th>Card Number</th>
                    <th>Reference number</th>
                    <th>Purchase</th>
                    <th>Sell</th>
                    <th>Purchase Date</th>
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
                    ajax: "{{ route('corporate.card.list') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'card_id', name: 'card_id'},
                        {data: 'sku_id', name: 'sku_id'},
                        {data: 'is_purchase', name: 'is_purchase'},
                        {data: 'is_sell', name: 'is_sell'},
                        {data: 'purchase_date', name: 'purchase_date'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                     ]
            });
            table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i+1;
                });
            }).draw();

//***************************** Delete Loan type********************************/
$('body').on('click', '.deletcard', function () {
    var company_id = $(this).data('id');
    if (confirm("Are you sure want to delete !")) {
        $.ajax({
         url: '{{ url("admin/card/destroy") }}',
        type: "POST",
        data:{id:company_id},
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
