<!DOCTYPE html>
<html class="" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
      
       <link href="{{ asset('css/custom-front.css') }}" rel="stylesheet" type="text/css" />
       <title>Profile | Clique</title>
       <style>
           .text-decoration-none-link{
               text-decoration: none;
           }
       </style>
    </head>
    <body>
        
        <div class="content-wrapper">
            <div class="clique-screen">               
                
                
                <div class="clique-app-wrapper">
                    
                    @php
                        if(\Request::route()->getName() == "corporate.main"){
                            $url = "corporate_profile";
                        }else{
                            $url = "profile";
                        }
                    @endphp
                    
                    <div class="download-app-alert">
                        <div class="download-app-holder">
                            <!--<a class="download-app-link" href="{{ url($url.'?param='.$user->id) }}" target="_blank">Open Profile With Clique App</a>-->
                            <a class="download-app-link" href="{{ 'socialclique://clique/user/profile?userid='.$user->id }}" target="_blank">Open Profile With Clique App</a>
                        </div>
                    </div>
                    
                    <div class="clique-app-header">
                        <h4 class="clique-header-name">{{ ucfirst($user->name) }}</h4>
                    </div>
                    <input type="hidden" name="profile_id" id="profile_id" value="{{$id}}">
                    <div class="clique-app-container clique-app-scroll">
                        <div class="clique-app-data">
                            <div class="clique-app-content">
								<div class="clique-profile-image-wrapper">
								    <div class="clique-profile-img">
								        @if($user->profile != null)
										    <img src="{{url($user->profile->avatar)}}" class="img-fluid">
										@else
										    <img src="{{url('frontend/images/app-profile-img.png')}}" class="img-fluid">
										@endif
									</div>
								</div>
                                <div class="clique-profile-info">
                                    <h3 class="clique-profile-name">{{ ucfirst($user->name) }}</h3>
                                    
                                    @if($company != null)
                                    <h5 class="clique-profile-designation">Owner at {{ ucfirst($company->name) }}</h5>
                                    @endif
                                    
                                    @if($user->is_temp == 1)
                                        @if($user->temp_profile != null)
                                        <p class="clique-profile-bio">{{ $user->temp_profile->bio }}</p>
                                        @endif
                                    @endif
                                    
                                    @if($user->is_temp == 0)
                                        @if($user->profile != null)
                                        <p class="clique-profile-bio">{{ $user->profile->bio }}</p>
                                        @endif
                                    @endif
                                </div>
                                
                                <div class="clique-contact-wrapper">
                                    @if($company != null)
                                    <div class="clique-contact-col">
										<label class="clique-contact-label">
											<figure>
												<img src="{{asset('frontend/images/briefcase.svg')}}" class="img-fluid">
											</figure>
											<span>My Company</span>
										</label>
										<div class="clique-contact-group company">
											<div class="icon">
												<span>{{ $company->first_two_word($company->name) }}</span>
											</div>
											<div class="details">
												<p>{{ ucfirst($company->name) }}</p>
												<span>{{ $company->description }}</span>
											</div>
										</div>
                                    </div>
                                    @endif
									
									@if($user->mobile != null)
									<div class="clique-contact-group">
										<div class="icon">
											<img src="{{asset('frontend/images/call-icon.svg')}}" class="img-fluid">
										</div>
										<div class="details">
											<p><a class="text-decoration-none-link" href="tel:{{ $user->mobile }}">{{ $user->mobile }}</a></p>
										</div>
									</div>
									@endif
									
									@if($user->email != null)
									
									<div class="clique-contact-group">
										<div class="icon">
											<img src="{{asset('frontend/images/email-icon.svg')}}" class="img-fluid">
										</div>
										<div class="details">
											<p><a class="text-decoration-none-link" href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
										</div>
									</div>
									
									@endif
									
                                    <div class="clique-contact-col">
                                        
                                        @if( (count($social_mtype_contact_number) != 0) || (count($social_mtype_website) != 0) || (count($social_mtype_mail) != 0) ||  (count($social_mtype_instagram) != 0) || (count($social_mtype_facebook) != 0) || (count($social_mtype_twitter) != 0) || (count($social_mtype_youtube) != 0) || (count($social_mtype_linkedin) != 0)  )
										<label class="clique-contact-label">
											<figure>
												<img src="{{asset('frontend/images/share-icon.svg')}}" class="img-fluid">
											</figure>
											<span>Social Networks</span>
										</label>
										@endif
										
										@forelse($social_mtype_contact_number as $row)
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/call-icon.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a class="text-decoration-none-link" href="tel:{{ $row->media_value }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@empty
										
										@endforelse
										
										
										@forelse($social_mtype_website as $row)
										
    										<?php
        										if (strpos($row->media_value, 'http://') == 0){
                                                    $web_url = $row->media_value;
        										}elseif(strpos($row->media_value, 'http://') == 0){
                                                    $web_url = $row->media_value;
                                                }else{
                                                    $web_url = "https://".$row->media_value;
                                                }
    										?>
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/web-icon.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a target="new" class="text-decoration-none-link" href="{{ $web_url }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@empty
										
										@endforelse
										
										
										@forelse($social_mtype_mail as $row)
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/email-icon.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a class="text-decoration-none-link" href="mailto:{{ $row->media_value }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@empty
										
										@endforelse
										
										
										@forelse($social_mtype_instagram as $row)
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/instagram-icon.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a target="new" class="text-decoration-none-link" href="https://www.instagram.com/{{ $row->media_value }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@empty
										
										@endforelse
										
										@forelse($social_mtype_facebook as $row)
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/facebook-icon.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a target="new" class="text-decoration-none-link" href="https://www.facebook.com/{{ $row->media_value }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@empty
										
										@endforelse
										
										@forelse($social_mtype_linkedin as $row)
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/linkedin-icon.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a target="new" class="text-decoration-none-link" href="https://www.linkedin.com/in/{{ $row->media_value }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@empty
										
										@endforelse
										
										@forelse($social_mtype_twitter as $row)
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/twitter-icon.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a target="new" class="text-decoration-none-link" href="https://www.twitter.com/{{ $row->media_value }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@empty
										
										@endforelse
										
										
										@forelse($social_mtype_youtube as $row)
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/youtube-icon.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a target="new" class="text-decoration-none-link" href="https://www.youtube.com/{{ $row->media_value }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@empty
										
										@endforelse
										
                                    </div>
									
									
									@if(count($social_mtype_music) != 0)
                                    <div class="clique-contact-col">
										<label class="clique-contact-label">
											<figure>
												<img src="{{asset('frontend/images/music-icon.svg')}}" class="img-fluid">
											</figure>
											<span>Music</span>
										</label>
										@foreach($social_mtype_music as $row)
										    <?php
        										if (strpos($row->media_value, 'http://') == 0){
                                                    $web_url = $row->media_value;
        										}elseif(strpos($row->media_value, 'http://') == 0){
                                                    $web_url = $row->media_value;
                                                }else{
                                                    $web_url = "https://".$row->media_value;
                                                }
    										?>
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/spotify-icon.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a target="new" class="text-decoration-none-link" href="{{ $web_url }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@endforeach
                                    </div>
                                    @endif
									
									@if(count($social_mtype_payment) != 0)
                                    <div class="clique-contact-col">
										<label class="clique-contact-label">
											<figure>
												<img src="{{asset('frontend/images/wallet-icon.svg')}}" class="img-fluid">
											</figure>
											<span>Payment</span>
										</label>
										@foreach($social_mtype_payment as $row)
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/picpay-wallet.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a target="new" class="text-decoration-none-link" href="{{ $row->media_value }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@endforeach
                                    </div>
                                    @endif
                                    
                                    
                                    @if(count($social_mtype_e_link) != 0)
                                    <div class="clique-contact-col">
										<label class="clique-contact-label">
											<figure>
												<img src="{{asset('frontend/images/title-external_link-icon.svg')}}" class="img-fluid">
											</figure>
											<span>External Links</span>
										</label>
										@foreach($social_mtype_e_link as $row)
										    <?php
        										if (strpos($row->media_value, 'http://') == 0){
                                                    $web_url = $row->media_value;
        										}elseif(strpos($row->media_value, 'http://') == 0){
                                                    $web_url = $row->media_value;
                                                }else{
                                                    $web_url = "https://".$row->media_value;
                                                }
    										?>
										<div class="clique-contact-group">
											<div class="icon">
												<img src="{{asset('frontend/images/external_link-icon.svg')}}" class="img-fluid">
											</div>
											<div class="details">
												<p><a target="new" class="text-decoration-none-link" href="{{ $web_url }}">{{ $row->media_value }}</a></p>
											</div>
										</div>
										@endforeach
                                    </div>
                                    @endif
									
									<div class="clique-contact-col">
										<div class="download-app-holder">
											<a class="download-app-link" href="{{url('/add-to-contact/?profile_id='.$user->id) }}" target="_blank">Add to Contact</a>
										</div>
									</div>
                                </div>
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
