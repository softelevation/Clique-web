
<!DOCTYPE html>
<html class="" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="p7KDGowVOP0xNuYgpHWxJDVaF8jOUwugYq9EL6Vn" />
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
	height: 660px;
    overflow: scroll;
}
		
	.download-app-holder {
		
		width: 100%;
		
		/* Button Gradient */
		background: linear-gradient(265.69deg, #E866B6 -28.53%, #6961FF 127.79%);
		// box-shadow: 5px 5px 45px rgba(0, 0, 0, 0.15);
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
	.rounded-circle{width: 80px;}
		
	.download-app-body{
		position: absolute;
		// width: 414px;
		width: 100%;
		height: 693px;
		left: 0px;
		// top: 203px;
		background: #F3EEFA;
		// box-shadow: 0px -8px 12px rgba(86, 40, 164, 0.3);
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
		width: 100%;
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
		// font-weight: bold;
		font-size: 16px;
		width: auto;
		text-align: center;
		max-width: 80%;
		margin: 0 auto;
		color: #707070;
	}
.image-icone {
    width: 100%;
    margin-bottom: 10px;
}
	.row.row-icone-material {margin-top: 15px;}
	.class-margin {margin-top: 25px;}
	.rows {position: absolute;}
	.col-mds-4 {float: left;}
	.col-mds-8 {float: right;margin-top: 10px;}
	.col-mds-3 {margin: 9px;}
	.icone-image{width: 110px;}
	img.pro-icone-img {width: 20px;}
	.rowsicone{
			    margin-top: 25px;
    content: cornflowerblue;
    justify-content: space-between;
    /* flex: 1; */
    display: flex;
		}
	p.connection {
	margin-top: 8px;
    font-weight: bold;
}
	.main-header {
        background: black;text-align: center;height: 40px;font-size: 24px;}
	// .download-app-body {margin-top: 60px;}
	.user-info-app {
       font-size: 14px;
		// width: 244px;
		// padding-left: 20px;
		// display: -webkit-box;
		overflow: hidden !important;
		-webkit-box-orient: vertical;
		-webkit-line-clamp: 3;
		margin-top: 8px;
		margin-bottom: 0;
} 
.row.header-top {
    margin-top: 15px;
	align-items: center;
}
	.user-info-app-name{width: 100%; margin-bottom: 0;}
	.tap-link-redirect{color: #fff;}
	@media (max-width: 800px) {
		.main-header {
			background: black;
			text-align: center;
			/* height: 0px; */
			font-size: 18px;
			padding: 7px 0px;
		}
		
		.join_button {margin-left: 25px;}
		.image-icone {width: 62px;}
    }
	
	
@media (max-width: 768px){
.row.row-icone-material .col-md-3{
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
}
.row.header-top .col-md-3.class-margin {    
-ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;}
.row.header-top  .col-md-9 {     
	-ms-flex: 0 0 75%;
    flex: 0 0 75%;
    max-width: 75%; }
	.user-info-app {
    width: 100%; } 
	
.rounded-circle {
    width: 100%;
}
.row.header-top .col-md-9 {
    padding-left: 0;
}

.class-margin {
    margin-top: 10px;
}
	
}
		</style>
    </head>
    <body>
        
        <div class="content-wrapper">
            <div class="clique-screen">
				<div class="clique-app-wrapper">
					<div class="download-app-alert">
						<div class="download-app-holder">
							<div class="main-header"><a class="tap-link-redirect" href="https://cliquesocial.co">Tap here to get your Clique card</a></div>
							<div class="container">
								<div class="rowsicone ">
									<div class="col-md-4">
										
									</div>
									<div class="col-md-4">
										<img src="https://admin.cliquesocial.co/icone.png" class="icone-image">
									</div>
									<div class="col-md-4 join_button">
										
									</div>
									
								</div>
								
								<div class="row header-top">
									<div class="col-md-3 class-margin">
											@if($user->profile != null && $user->profile->avatar)
												<img src="{{url($user->profile->avatar)}}" class="rounded-circle">
											@else
												<img src="{{url('/user/default.png')}}" class="rounded-circle">
											@endif
									</div>
									<div class="col-md-9">
									  <h5 class="user-info-app-name">{{ ucfirst($user->name) }}  
											@if($user->profile->is_pro)
											<img class="pro-icone-img" src="{{url('avatars/check.png')}}" />
											@endIf
									 </h5>
									  <p class="user-info-app">{{ ucfirst($user->profile->bio) }}</p>
									<p class="connection"> {{$my_connections}} Connections </p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="download-app-body">
							<div class="container">
								<center>
									<div class="row">
										<div class="col-md-12">
											@if($user->name)
												<p class="user-contact-email">{{ $user->name."'s Contacts" }}</p>
											@else
												<p class="user-contact-email">{{ $user->email }}</p>
											@endif
										</div>
										<div class="col-md-12">
										<a class="add-to-contacts" href="{{url('/add-to-contact?profile_id='.$user->id) }}">Add to Contacts</a>
										</div>
									</div>
									
									<div class="row row-icone-material">
										@foreach($icone_socials as $icone_social)
											@if($icone_social->fade_out)
												<div class="col-md-3">
													@if($icone_social->icone_id == '24')
														<a href="{{url($icone_social->username)}}" download><img class="image-icone" src="{{ url($icone_social->icone->url) }}" /></a>
														@else
														<a href="{{$icone_social->link}}" target="_blank"><img class="image-icone" src="{{ url($icone_social->icone->url) }}" /></a>
													@endIf
												</div>
											@endif
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
   $(".add-to-contactsss").click(function(e){
	   var id = "{{$id}}";
	  	$.ajax({
	         url: "{{ url('add-to-contact') }}",
	         type: "POST",
	         data:{profile_id:id},
	         headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	         // dataType: "json",
	         success: function(response) {
				
				// console.log(response);
				
				window.open(response, '_blank');
	         	//alert(response);
	         	// $('#reportsTable').html();
	         	// $('#reportsTable').html(response.table);
	            // location.reload(response);
	         }
	      });

	});
});


</script>
