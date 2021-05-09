<?php 
    include_once('classes/UPI_QR_Generator.php'); 
    include_once('vendor/autoload.php');
    use Endroid\QrCode\QrCode;
?>
<?php


if($_POST['user_name'] != null){
    $pa = $pn = $am = $tid = $tr = $tn = $url = '';
    
    $pn = $_POST['user_name'];
    $pa = $_POST['upi_id'];
    //mc=0000&mode=02&purpose=00
    $merchant['pn'] = $pn;
    $merchant['pa'] = $pa;
    
    $merchant['mc'] = "0000";
    $merchant['mode'] = "02";
    $merchant['purpose'] = "00";
    //$merchant['am'] = $am;
    //$merchant['tid'] = $tid;
    //$merchant['tr'] = $tr;
    //$merchant['tn'] = $tn;
    //$merchant['url'] = $url;
                    
    $qr_code = new UPI_QR_Generator( $merchant );                                                             
    $upi_text = $qr_code ->generate_upi_text();                                
    $qrCode = new QrCode();
    $qrCode->setText($upi_text);
    $qrCode->setSize(200);
    $qrCode->setPadding(5);
    $qrCode->setErrorCorrection('high');    
    $imagename = time().".png";
    $qrCode->save('./public/files/qrcodes/'.$imagename);
    $img = 'https://dev.thewebtual.com/clique/orcodeapi/public/files/qrcodes/'.$imagename;
    $qr_generated = 1;
    
    //echo $img;
}else{
    $img = "";
}

echo $img;
?>
