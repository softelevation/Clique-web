{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="card card-custom">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">Assign Card
                <div class="text-muted pt-2 font-size-sm"></div>
            </h3>
        </div>

        <div class="card-toolbar">
              &nbsp;&nbsp;&nbsp;

        </div>
    </div>

    <div class="assign-card-sec">
        <div class="col-lg-12 text-left">
            
            <a href="javascript:void(0);" id="assigncard" class="btn btn-primary font-weight-bolder">
                <i class="ki ki-plus icon-sm"></i> Assign card
            </a>
        </div>
        <div class="col-lg-12 text-right">
            <form class="form mt-5" name="add-single-card" id="add-single-card" action="" method="post">
                @csrf
                <div class="row">
                	<div class="col-xl-7 col-lg-9 col-md-7 ml-auto">
                		<div class="row">
                	<div class="col-lg-8 col-md-7 pr-md-0">
                    <div class=""><div class="text-muted text-left mb-2">( Ex. 0x04362a52d55681 )</div></div>
                    <div class="">
                    <input type="text" id="addcard" class="form-control form-control-sm mr-5" name="addcard" value="" placeholder="Enter card number">
                    <input type="hidden" name="orderid" id="orderid" value="5">
                    
                    {{-- <input type="submit" class="btn btn-primary font-weight-bolder pl-9 pr-9" id="addcardsubmit" name="addcardsubmit" value="Add new card"> --}}
                </div>
                </div>
                <div class="col-lg-4 col-md-5 text-lg-center">
                	<button type="submit" id="addcardsubmit" name="addcardsubmit" class="btn btn-primary font-weight-bolder mt-sm-7 mt-2 w-100"><i class="ki ki-plus icon-sm"></i> Add new card</button>
           		</div>
                </div>
                	</div>
                </div>
            </form>
        </div>
    </div>


    <div class="card-body">
        <table class="table table-bordered data-table table-hover">
            <thead><tr>
                    <th>No</th>
                    <th>Card Number</th>
                    <th>Reference number</th>
                    {{-- <th>Purchase</th>
                    <th>Sell</th>
                    <th>Purchase Date</th>
                    <th width="150px">Action</th> --}}
            </tr></thead>
            <tbody></tbody>
        </table>
    </div>
</div>


<div id="addmember" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" onsubmit="return false;">
    <form method="post" action="" id="assign_member" name="assign_member" enctype="multipart/form-data">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">Assign Card to user</h4>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
               </button>
            </div>
            <div class="modal-body">
               <div row>
              <div class="form-group">
                    <label for="bs" style="float: left;" class="font-weight-bold">Member</label>
                    <input type="text" name="keyword" autofocus="autofocus" data-fetch-url="{{url('user/fetch')}}"  placeholder="Select Member"  class="form-control" value="" id="keyword" />
                  </div>
               </div>
            </div>
            <div class="modal-footer">
            	<input type="hidden" name="assign_to" id="assign_to" value="">
            	<input type="hidden" name="card_id" id="card_id" value="">
                <input type="hidden" name="order_id" id="order_id" value="">

            	<button type="button" class="btn btn-primary assign-member">Save</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
   		</div>
   <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
   </form>
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
toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
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
                    ajax: "{{ url('admin/assign-card-list') }}/{{$order_id}}",
                    //ajax: "{{ url('admin/assign-card-list') }}?qty={{$qty}}&order_id={{$order_id}}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'card_id', name: 'card_id'},
                        {data: 'sku_id', name: 'sku_id'}
                        // {data: 'is_purchase', name: 'is_purchase'},
                        // {data: 'is_sell', name: 'is_sell'},
                        // {data: 'purchase_date', name: 'purchase_date'},
                        // {data: 'action', name: 'action', orderable: false, searchable: false},
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



$('#assigncard').click(function(){
    var order_id = {{$order_id}};
    Swal.fire({
            title: "Are you sure?",
            text: "Assign Card for Order!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, Assign it!"
        }).then(function(result) {
            if (result.value == true) {
                $.ajax({
                    url: "{{ url('admin/assign-card-save') }}",
                    type: "POST",
                    data:{order_id:order_id},
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: "json",
                    success: function(data) {
                        if(data.status == "200")
                        {
                            if (result.value) {
                                Swal.fire(
                                    "Assigned!",
                                    "Your Card has been Assigned to order.",
                                    "success"
                                )
                            }
                            window.location.href = "{{ route('orders.list')}}";
                        }
                        if(data.status == "404")
                        {
                             Swal.fire("Issue!", "Card qty is not enough to process this order.", "warning");
                        }
                    }
                });
            }else{ }
    });
    // if (confirm("Do you want Assign Card for Order !")) {
    // $.ajax({
    //      url: "{{ url('admin/assign-card-save') }}",
    //      type: "POST",
    //      data:{order_id:order_id},
    //      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    //      dataType: "json",
    //      success: function(data) {
    //          if(data.status == "200")
    //          {
    //             //alert(data.message);
    //             window.location.href = "{{ route('orders.list')}}";
    //          }

    //         //location.reload();
    //      }
    //   });
    // }

});
});


$("#addcardsubmit" ).click(function() {
	$("#add-single-card").validate({
        rules: {
            addcard: {  required: true, minlength:14, maxlength:14},
        },
	    messages: {
            addcard: {  required: "Please enter card" },
         },
		submitHandler: function(form,event) {
			event.preventDefault();
			var myform = document.getElementById("add-single-card");
			var formData = new FormData(myform);
			$.ajax({
				url: '{{ url('admin/add-single-card') }}',
				type: "POST",
				data:formData,
				contentType: false,
            	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				cache: false,
				processData: false,
				success: function( response ) {
                    if(response.status == "200"){
                        toastr.success('Card added successfully.', 'Success');
                        $('.data-table').DataTable().ajax.reload();
                        $("#addcard").val("");
                    }else{
                        toastr.error('Card already added.', 'Error');
	            	}
				}
			});
		}
	});
});

</script>
@endsection
