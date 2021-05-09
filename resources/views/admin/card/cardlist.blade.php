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
                    <th>Assign To</th>
                    {{-- <th>Purchase</th> --}}
                    {{-- <th>Sell</th> --}}
                    <th>Purchase Date</th>
                    <th width="150px">Action</th>
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
                    <input type="text" name="keyword" autofocus="autofocus" data-fetch-url="{{url('admin/fetch')}}"  placeholder="Select Member"  class="form-control" value="" id="keyword" />
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-autocomplete/1.3.5/jquery.easy-autocomplete.min.js"></script>
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
                    ajax: "{{ route('card.list') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'card_id', name: 'card_id'},
                        {data: 'sku_id', name: 'sku_id'},
                        {data: 'assign_to', name: 'assign_to'},
                        // {data: 'is_purchase', name: 'is_purchase'},
                        // {data: 'is_sell', name: 'is_sell'},
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

            var card_id = $(this).data('id');
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
                        url: '{{ url("admin/card/destroy") }}',
                        type: "POST",
                        data:{id:card_id},
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        dataType: "json",
                        success: function(data) { 
                            $('.data-table').DataTable().ajax.reload();
                        }
                        });

                    Swal.fire(
                        "Deleted!",
                        "Card has been deleted.",
                        "success"
                    )
                    // result.dismiss can be "cancel", "overlay",
                    // "close", and "timer"
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "Cancelled",
                        "Your Card is safe :)",
                        "error"
                    )
                }
            });
    });
});


$('#assigncard').click(function(){
    var order_id = "";
    if (confirm("Do you want Assign Card for Order !")) {
    $.ajax({
         url: "{{ url('admin/assign-card-save') }}",
         type: "POST",
         data:{order_id:order_id},
         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
         dataType: "json",
         success: function(data) {
             if(data.status == "200")
             {
                //alert(data.message);
                window.location.href = "{{ route('orders.list')}}";
             }

            //location.reload();
         }
      });
    }

});
//});
$('#addmember').on('show.bs.modal', function() { $("#keyword").focus(); $('#keyword').val(''); });
$(document).ready(function(){
   var url = $('#keyword').data('fetch-url');
   var keyword = $('#keyword').val();
   var card_id = $("#card_id").val();

   var options = {
      url: function(keyword) {
        return url+ "?keyword=" + keyword;
      },
      getValue: "title",
      ajaxSettings: {
        dataType: "json",
        beforeSend: function(xhr) {
           xhr.setRequestHeader("X-CSRF-TOKEN", $('meta[name="csrf-token"]').attr('content'));
        },
        method: 'POST',
         data:{
            dataType: keyword
         }
      },
      preparePostData: function(data) {
         data.keyword = $('#keyword').val();
         data.card_id = $('#card_id').val();
         return data;
   },
   template: {
      type: "iconLeft",
      fields: { iconSrc: "icon" }
   },
   list: {
        onSelectItemEvent: function() {
            var value = $("#keyword").getSelectedItemData().id
            $("#assign_to").val(value).trigger("change");
            $("#keyword-error").hide();
        },
        onHideListEvent:function(){

        }
   }

  };

    $("#keyword").easyAutocomplete(options).click(function(){
        $(this).triggerHandler(jQuery.Event("keyup", { keyCode: 65, which: 65}))
    });


});

$('body').on('click', '.assign_to', function () {
    var order_id = $(this).data('orderid');
    var card_id = $(this).data('id');
    $("#order_id").val(order_id);
    $("#card_id").val(card_id);
});

$('body').on('click', '.assign-member', function (e) {
   var card_id = $('#card_id').val();
   var assign_to = $('#assign_to').val();
   var form = $("#assign_member");
   form.validate({
      rules: {
         keyword: {  required: true }
      },
       messages: {
          keyword: {  required: "Please select any one User" },
       },
    });
    if (form.valid() == true){

      $.ajax({
            url: '{{ url("admin/card/assigncard") }}',
            type: "POST",
            data: { 'assign_to' : assign_to, 'id' : card_id },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(data) {
               if(data.status == "200")
               {
                $('#addmember').modal('hide');
                $('.data-table').DataTable().ajax.reload();
                toastr.success('Card has been assign successfully.', 'Success');
                //location.reload();
               }
               if(data.status == "404"){
                toastr.error('Card allready assigned to other');

               }
            }
       });
    }
});


$('body').on('click', '.revoke_to', function (e) {
    
    var card_id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "Are you sure want to Revoke!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Revoke it",
                cancelButtonText: "No, cancel",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                   $.ajax({
                            url: '{{ url("admin/card/revokecard") }}', 
                            type: "POST",
                            data: { 'card_id' : card_id},
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            success: function(data) {
                               if(data.status == "200")
                               {
                                $('.data-table').DataTable().ajax.reload();
                                toastr.success('Card Revoke successfully.', 'Success');
                                }
                            }
                       });

                    Swal.fire(
                        "Revoked!",
                        "Card has been Revoked.",
                        "success"
                    )

                } else if (result.dismiss === "cancel") {
                    // Swal.fire(
                    //     "Cancelled",
                    //     "Your Card is cancel :)",
                    //     "error"
                    // )
                }
            });

    
});
</script>
@endsection
