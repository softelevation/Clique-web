{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Add Cards
                        <div class="text-muted pt-2 font-size-sm"></div>
                    </h3>
                </div>
            </div>
            <form class="form" name="add-card" id="add-card" action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class=" container ">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group ">
                                <label>Card No <span class="text-danger">*</span></label>
                                <span class="text-muted">( Ex. 0x04362a52d55681 )</span>
                                <input type="text" id="cardnumber" name="cardnumber" value="" class="form-control"  placeholder="Enter card number"/>
                            </div>
                        </div>
                        <div class="col-md-8" style="display: none;">
                            <div class="form-group">
                                <label>Card Status <span class="text-danger">*</span></label>
                                    <div class="radio-inline">
                                        <label class="radio">
                                            <input type="radio" name="radios2" checked value="purchase"/>
                                            <span></span>
                                           Purchase
                                        </label>
                                        <label class="radio">
                                            <input type="radio" name="radios2" value="sell"/>
                                            <span></span>
                                            Sell
                                        </label>
                                    </div>
                                <span class="form-text text-muted"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Imports Cards
                        <div class="text-muted pt-2 font-size-sm"></div>
                    </h3>
                </div>

            </div>
            <form class="form" name="add-import" id="add-import" action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <div class=" container ">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>File Browser</label>
                                <div></div>
                                <div class="custom-file">
                                    <input type="file" name="importfile" class="custom-file-input" id="importfile"/>
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <span id="error-msg"></span>
                                </div>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('styles')
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#add-card')[0].reset();
    });

    if($("#add-card").length > 0) {
	    $("#add-card").validate({
            rules: {
                cardnumber: {  required: true },
                radios2: { required: true }
            },
	        messages: {
                cardnumber: {  required: "Please enter Card number" },
                radios2: {  required: "Please Select card status" },
            },
		    submitHandler: function(form,event) {
			    event.preventDefault();
			    var myform = document.getElementById("add-card");
			    var formData = new FormData(myform);
			    $.ajax({
				    url: '{{ url('admin/card/create') }}',
				    type: "POST",
				    data:formData,
				    contentType: false,
            	    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				    cache: false,
				    processData: false,
				    success: function( response ) {
					if(response.status == "200"){
                        window.location.href = "{{ route('card.list')}}";
                    }else{
                        //toastr.warning(response.message);
	            	}
				}
			});
		}
	});
}

if($("#add-import").length > 0) {
	    $("#add-import").validate({
            rules: {
                importfile: {  required: true },
              },
	        messages: {
                importfile: {  required: "Please Select file" },
              },
		    submitHandler: function(form,event) {
			    event.preventDefault();
			    var myform = document.getElementById("add-import");
			    var formData = new FormData(myform);
			    $.ajax({
				    url: '{{ url('admin/card/import') }}',
				    type: "POST",
				    data:formData,
				    contentType: false,
            	    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				    cache: false,
				    processData: false,
				    success: function( response ) {
					if(response.status == "200"){
                        window.location.href = "{{ route('card.list')}}";
                    }
                    else if(response.status == "201"){
                        $("#error-msg").text(response.message);
	                	//toastr.warning(response.message);
	            	}
				}
			});
		}
	});
}
</script>
@endsection
