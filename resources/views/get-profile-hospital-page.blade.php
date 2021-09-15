<!doctype html>
                        <html>
                            <head>
                                <meta charset='utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1'>
                                <title>Clique | Hospital</title>
                                <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' rel='stylesheet'>
                                <link href='' rel='stylesheet'>
                                <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
                                <style>body {
    background: linear-gradient(
265.69deg, #E866B6 -28.53%, #6961FF 127.79%);
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
img.rounded-circle.mt-5 {
    width: auto;
    max-width: 180px;
}
</style>
                                </head>
                                <body oncontextmenu='return false' class='snippet-body'>
                                <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" src="{{asset($user_image)}}">
				<span class="font-weight-bold">{{$icone_socials->start_name.' '.$icone_socials->first_name.' '.$icone_socials->last_name}}</span>
				<span class="text-black-50">{{$icone_socials->email_id}}</span><span> </span>
			</div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Hospital Member</h4>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Title</label><span class="form-control">{{$icone_socials->start_name}}</span></div>
                    <div class="col-md-12"><label class="labels">First Name</label><span class="form-control">{{$icone_socials->first_name}}</span></div>
                    <div class="col-md-12"><label class="labels">Last Name</label><span class="form-control">{{$icone_socials->last_name}}</span></div>
                    <div class="col-md-12"><label class="labels">Mobile number</label><span class="form-control">{{$icone_socials->mobile_no}}</span></div>
					@if($icone_socials->landline)
                    <div class="col-md-12"><label class="labels">Landline number</label><span class="form-control">{{$icone_socials->landline}}</span></div>
					@endIf
                    <div class="col-md-12"><label class="labels">{{$icone_socials->govt_id}}</label><span class="form-control">{{$icone_socials->govt_id_number}}</span></div>
                    <div class="col-md-12"><label class="labels">Mother Tounge</label><span class="form-control">{{$icone_socials->mother_tounge}}</span></div>
                    <div class="col-md-12"><label class="labels">Age</label><span class="form-control">{{$age_datediff.' years'}}</span></div>
                    <div class="col-md-12"><label class="labels">Date Of Birth</label><span class="form-control">{{$icone_socials->date_of_birth}}</span></div>
                    <div class="col-md-12"><label class="labels">Sex</label><span class="form-control">{{$icone_socials->sex}}</span></div>
                    <div class="col-md-12"><label class="labels">Marital Status</label><span class="form-control">{{$icone_socials->marital_status}}</span></div>
                    <div class="col-md-12"><label class="labels">Relation</label><span class="form-control">{{$icone_socials->relation}}</span></div>
                    <div class="col-md-12"><label class="labels">Address</label><span class="form-control">{{$icone_socials->address}}</span></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
				<div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Attachments</h4>
                </div>
                <!--div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br-->
                @foreach($icone_socials->uplod_file as $uplod_files)
				<div class="col-md-12"><label class="super_labels">{{ rtrim(ltrim($uplod_files,'/member/'),'.jpg') }} <a href="{{url($uplod_files)}}" download>Download</a></label></div>
				@endforeach
                <!--div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div-->
            </div>
        </div>
    </div>
</div>
</div>
</div>
                                <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>
                                <script type='text/javascript'></script>
                                </body>
                            </html>