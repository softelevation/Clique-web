<!DOCTYPE html>
<html class="" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<title>Profile | Clique</title>
		<style>
        .content-wrapper {
			display: block;
		}
		.clique-screen {
    overflow: hidden !important;
    z-index: 10;
    transition: all 350ms ease;
    width: 100%;
    max-width: 375px;
    height: 100%;
    /* max-height: 680px; */
    background: #fff;
    display: block;
    margin: 0 auto;
}
.clique-app-wrapper {
    // background: #251E54;
    position: relative;
    /* height: 100%; */
    height: 100vh;
}
.download-app-alert {
    top: 15px;
    left: 0;
    right: 0;
    display: block;
    position: fixed;
	background: linear-gradient(265.69deg, #E866B6 -28.53%, #6961FF 127.79%);
    z-index: 99;
    color: #ffffff;
    width: 100%;
    max-width: 414px;
    margin: 0 auto;
    z-index: 999;
}
		
	.download-app-holder {
		position: absolute;
		width: 414px;
		height: 286px;
		left: 0px;
		top: 0px;
		/* Button Gradient */
		background: linear-gradient(265.69deg, #E866B6 -28.53%, #6961FF 127.79%);
		box-shadow: 5px 5px 45px rgba(0, 0, 0, 0.15);
	}
.download-app-link {
    /* background: rgba(255,255,255,0.4); */
	margin-top: 10px;
    background: #20ad96;
    display: inline-block;
    /* margin-left: 20px; */
    padding: 15px 20px;
    text-decoration: none;
    color: #fff;
    border-radius: 2px;
    font-weight: bold;
    /* border: 1px solid rgba(255,255,255,0.5); */
    font-size: 14px;
    width: auto;
    text-align: center;
    max-width: 80%;
    margin: 0 auto;
    /* border: none; */
    box-shadow: 0px 0px 20px rgb(0 0 0 / 30%);
    border-radius: 40px;
}
	.rounded-circle{width: 100px;}
		
	.download-app-body{
		position: absolute;
		// width: 414px;
		width: 100%;
		height: 693px;
		left: 0px;
		top: 203px;
		background: #F3EEFA;
		box-shadow: 0px -8px 12px rgba(86, 40, 164, 0.3);
		border-radius: 40px 40px 0px 0px;
	}
	.add-to-contacts{
		background: linear-gradient(265.69deg, #E866B6 -28.53%, #6961FF 127.79%);
		display: inline-block;
		padding: 15px 20px;
		text-decoration: none;
		color: #fff;
		border-radius: 2px;
		font-weight: bold;
		font-size: 14px;
		width: auto;
		text-align: center;
		// max-width: 80%;
		width: 90%;
		margin: 0 auto;
		box-shadow: 0px 0px 20px rgb(0 0 0 / 30%);
		border-radius: 15px;
	}
	.user-contact-email{
		// background: linear-gradient(265.69deg, #E866B6 -28.53%, #6961FF 127.79%);
		display: inline-block;
		padding: 15px 20px;
		text-decoration: none;
		color: #fff;
		border-radius: 2px;
		font-weight: bold;
		font-size: 14px;
		width: auto;
		text-align: center;
		max-width: 80%;
		margin: 0 auto;
		color: #707070;
	}
	.image-icone{
		width: 75px;
	}
	.row.row-icone-material {margin-top: 15px;}
	.row.class-margin {margin-top: 10px;}
	.rows {position: absolute;}
	.col-mds-4 {width: 30%;float: left;}
	.col-mds-8 {width: 70%;float: right;}
	.col-mds-3 {margin: 10px;}
		</style>
    </head>
    <body>
        
        <div class="content-wrapper">
            <div class="clique-screen">
				<div class="clique-app-wrapper">
					<div class="download-app-alert">
						<div class="download-app-holder">
							<div class="container">
								<center>
								<div class="row class-margin">
									<div class="col-md-12">
									<a class="download-app-link" href="{{ 'socialclique://clique/user/profile?userid='.$user->id }}" target="_blank">Open Profile With Clique App</a>
									</div>
								</div>
								</center>
								<div class="rows">
									<div class="col-mds-4">
										@if($user->profile != null)
											<img src="{{url($user->profile->avatar)}}" class="rounded-circle">
										@else
											<img src="{{url('/user/default.png')}}" class="rounded-circle">
										@endif
									</div>
									<div class="col-mds-8">
									  <p>{{ ucfirst($user->name) }}</p>
									  <p>{{ ucfirst($user->profile->bio) }}</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="download-app-body">
							<div class="container">
								<center>
									<div class="row">
										<div class="col-md-12">
										<p class="user-contact-email">{{ $user->email }}</p>
										</div>
										<div class="col-md-12">
										<a class="add-to-contacts" href="{{ 'socialclique://clique/user/profile?userid='.$user->id }}" target="_blank">Add to Contacts</a>
										</div>
									</div>
									
									<div class="row row-icone-material">
										@foreach($icone_socials as $icone_social)
										<div class="col-mds-3">
											<img class="image-icone" src="{{ url($icone_social->url) }}" />
										</div>
										@endforeach
									</div>
								</center>
							</div>
						</div>
						
						
					</div>
				</div>
            </div>
        </div>
        
        
    </body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#btn-alert-close").click(function(){
    $('.download-app-alert').fadeOut();
  });

  
   // Savaji Rathod 27-04-21 Add to contact Ajax
   $("#add_to_contact").click(function(e){
	   var id = $('#profile_id').val();
	
	  	$.ajax({
	         url: "{{ url('add-to-contact') }}",
	         type: "POST",
	         data:{profile_id:id},
	         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	         dataType: "json",
	         success: function(response) {
	         	//alert(response);
	         	$('#reportsTable').html();
	         	$('#reportsTable').html(response.table);
	            //location.reload();
	         }
	      });

	});
});


</script>
