/**
Video Play
**********/
if($('#my-banner').length != 0){
    var video = document.getElementById("my-banner");
    video.play();
}


// Handle signup
$('#kt_login_signup').on('click', function (e) {
    e.preventDefault();
    //_showForm('signup');
    $(".login-signin").hide();
    $(".login-signup").show();
});

$('#kt_login_signup_cancel').on('click', function (e) {
    e.preventDefault();
    $(".login-signup").hide();
    $(".login-signin").show();


});

$('#kt_login_signin_submit').on('click', function (e) {
    e.preventDefault();

    validation.validate().then(function(status) {
        if (status == 'Valid') {
            swal.fire({
                text: "All is cool! Now you submit this form",
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            }).then(function() {
                KTUtil.scrollTop();
            });
        } else {
            swal.fire({
                text: "Sorry, looks like there are some errors detected, please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            }).then(function() {
                KTUtil.scrollTop();
            });
        }
    });
});



/*BP - Owl*/
if($('#bp-owl').length != 0){
    $('#bp-owl').owlCarousel({
        loop:true,
        margin:30,
        smartSpeed :900,
        nav:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,

        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            }
        }
    })
}

/*RESOURCES - Owl*/
if($('#resources-owl').length != 0){
    $('#resources-owl').owlCarousel({
        loop:true,
        margin:30,
        nav:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplayHoverPause:true,
        navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            }
        }
    })
}
/**
Slider Range
************/
// if($('#price-loan').length != 0){
//     $("#price-loan").ionRangeSlider({
//         type: "double",
//         grid: true,
//         min: 5000,
//         max: 200000,
//         from: 5000,
//         to: 80000,
//         prefix: "$",
//         onStart: function (data) {
//           $('input[name="loan_amount_requested"]').val(data.to);
//         },

//         onChange: function (data) {
//             $('input[name="loan_amount_requested"]').val(data.to);
//             console.log(data.to);
//         }
//     });
// }

/**
Contact Request
**************/

$('#submit-contact').click(function(){
    var url = $('.co-form').attr('action');

    $.ajax ({
        type: 'POST',
        url: url,
        async: false,
        data: $(".co-form").serialize(),
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success : function(response) {
            toaserMessage(response.status, response.message);
            $('.co-form')[0].reset();
        },
        error: function (reject) {
            if( reject.status === 422 ) {
                var errors = $.parseJSON(reject.responseText);
                var errors = errors['errors'];
                toaserMessage(422, Object.values(errors)[0]);
            }
        }
    });
});
/**
Register Request
**************/
$('#terms_and_condition').click(function(){
    var name = $(this).attr('id');
    var checked = $('input[name='+name+']').attr('checked');
    console.log(checked);
    if(checked == 'checked'){
        $('input[name='+name+']').removeAttr('checked');
    }else{
        $('input[name='+name+']').attr('checked', 'checked');
    }
});

$('input[name="type"]').click(function(){

    var val_in = ( $('input[name="type"]').val() == 1) ? 0 : 1;
    $('input[name="type"]').val(val_in);
    $('input[name="type"]').removeAttr('checked');
    $(this).attr('checked', 'checked');
})

$('#btn-register').click(function(){
    $('.error-block').remove();
    var url = $('.register-form').attr('action');
    var redirect_url = $('.register-form').attr('data-redirect-url');

    $.ajax ({
        type: 'POST',
        url: url,
        data: $(".register-form").serialize(),
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success : function(response) {
            //toaserMessage(response.status, response.message);
            if(response.status == 201){
                window.location.href = redirect_url;
                /*$('.register-form')[0].reset();
                setTimeout(function(){ window.location.href = redirect_url; }, 2000);*/
            }else{
                $('.error-message').append('<span class="help-block error-block"><small>'+response.message+'</small></span>');
            }
        },
        error: function (reject) {
            if( reject.status === 422 ) {
                var errors = $.parseJSON(reject.responseText);
                var errors = errors['errors'];
                if(Object.keys(errors)[0] == 'terms_and_condition'){
                    $('.error-message').append('<span class="help-block error-block"><small>'+Object.values(errors)[0]+'</small></span>');
                }else{
                    $('input[name="'+Object.keys(errors)[0]+'"]').after('<span class="help-block error-block"><small>'+Object.values(errors)[0]+'</small></span>');
                }

                //toaserMessage(422, Object.values(errors)[0]);
            }
        }
    });
});

/**
Login Request
**************/

$('#login').click(function(){

    $('.error-block').remove();

    var type = $('#type').val();
    var url = $('.login-form-new').attr('action');


        if(type == 'user'){
        $.ajax ({
            type: 'POST',
            url: url,
            data: $(".login-form-new").serialize(),
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success : function(response) {
                if(response.status == 201){
                    window.location.href = response.data.redirect_url;
                }else{
                    //toaserMessage(response.status, response.message);
                    $('.error-message').append('<span class="help-block error-block"><small>'+response.message+'</small></span>');
                }
            },
            error: function (reject) {
                if( reject.status === 422 ) {
                    var errors = $.parseJSON(reject.responseText);
                    var errors = errors['errors'];
                    $('input[name="'+Object.keys(errors)[0]+'"]').after('<span class="help-block error-block"><small>'+Object.values(errors)[0]+'</small></span>');
                    //toaserMessage(422, Object.values(errors)[0]);
                }
            }
            });
    }else{

        var field = $('#email').val();
        if(is_email_or_phone(field))
        {

            $.ajax ({
                type: 'POST',
                url: url,
                data: $(".login-form").serialize()+ "&is_email_or_phone=" + is_email_or_phone(field),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success : function(response) {
                    if(response.status == 201){
                        window.location.href = response.data.redirect_url;
                    }else{
                        toaserMessage(response.status, response.message);
                    }

                    /*toaserMessage(response.status, response.message);
                    if(response.status == 201)
                    {
                        $('.login-form')[0].reset();
                        setTimeout(function(){ window.location.href = response.data.redirect_url; }, 2000);
                    }*/
                },
                error: function (reject) {
                    if( reject.status === 422 ) {
                        var errors = $.parseJSON(reject.responseText);
                        var errors = errors['errors'];
                        toaserMessage(422, Object.values(errors)[0]);
                    }
                }
            });
        }
    }
});


/**
Comman Function
**************/
function is_email_or_phone(field){
    var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if(field == ""){
        toaserMessage(422, "Required email");
        return false;
    }
    else if(testEmail.test(field)){
        return "email";
    }
    else{
        return "email"
    }
}


function toaserMessage(status, message) {
    var type = ( (status == '200') || (status == '201') ) ? 'success' : 'error';
    toastr[type](message)

    toastr.options = {
        "closeButton": true,
        "debug": true,
        "newestOnTop": true,
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
}

$(".numbers-only").keyup(function() {
    var $this = $(this);
    $this.val($this.val().replace(/[^\d.]/g, ''));
});
