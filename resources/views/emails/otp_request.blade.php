<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
    <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
  </head>
 <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Hello !</h1>
                <p>Please enter the OTP code <b>{{ $otp }}</b> on the email verification screen to verify your account email address</p>
                
                <br>
                <p>Thank you for using our application!</p>
                <br>
              
                <p>Regards,<br>Clique Team</p>
            </div>
        </div>
    </div>           
</body>
</html>
