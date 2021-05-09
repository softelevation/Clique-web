{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Order List<div class="text-muted pt-2 font-size-sm"></div></h3>
        </div>
        <div class="card-toolbar">
               <div class="dropdown dropdown-inline mr-2"></div>
        <a href="{{ url('admin/corporate/create-order') }}" id="placeorder" class="btn btn-primary font-weight-bolder mr-2">
            <i class="icon-2x text-white-50 flaticon2-shopping-cart"></i> Create Order
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered data-table table-hover">
            <thead><tr>
                <th>No</th>
                <th>Order Number</th>
                <!--<th>Amount</th>-->
                <th>qty</th>
                <th>Customer Details</th>
                <th>Order Date</th>
                <th>Assign</th>
                <th width="150px">Action</th>
            </tr></thead>
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

<!--begin::Modal-->
<div class="modal fade" id="exampleModalSizeLg" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeLg" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="order_view">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary font-weight-bold">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->




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
                ajax: "{{ route('corporate.orders.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'order_number', name: 'order_number'},
                    // {data: 'amount', name: 'amount'},
                    {data: 'qty', name: 'qty'},
                    {data: 'customer_details', name: 'customer_details'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'assign', name: 'assign'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            table.on( 'order.dt search.dt', function () {
                table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            });
}).draw();

//***************************** Delete Loan type********************************/
$('body').on('click', '.deleteorders', function () {

    var order_id = $(this).data('id');
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
                        url: '{{ url("admin/orders/destroy") }}',
                        type: "POST",
                        data:{id:order_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        success: function(data) {
                            $('.data-table').DataTable().ajax.reload();
                        }
                    });

                    Swal.fire(
                        "Deleted!",
                        "Order has been deleted.",
                        "success"
                    )
                    // result.dismiss can be "cancel", "overlay",
                    // "close", and "timer"
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelled",
                        "Your Order is safe :)",
                        "error"
                    )
                }
            });

});



//***************************** View order ********************************/
$('body').on('click', '.vieworders', function () {
    var order_id = $(this).data('id');
        $.ajax({
            url: '{{ url("admin/orders/orderdetail") }}',
            type: "POST",
            data:{orderid:order_id},
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            dataType: "json",
            success: function(data) {
                if(data.status == '200')
                {
                    $("#order_view").html(data.html);
                }
            }
        });

});





});
</script>
@endsection
