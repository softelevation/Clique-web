<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Countries;
use App\Orders;
use App\Contacts;
use App\User;
use App\Usercontact;
use App\Company;
use App\Icone;
use App\Profile;
use App\SocialNetwork;
use App\ProfileIcone;
use App\ProfileHospital;
use App\Carditems;
use App\TempSocialNetwork;
use Illuminate\Support\Facades\Storage;
use App\Mail\placeorder;
use Illuminate\Support\Facades\Mail;
use JeroenDesloovere\VCard\VCard;
use Carbon\Carbon;


class PagesController extends Controller
{
    //************* About us page */
    public function aboutus()
    {
        return view('about-us');
    }

    //************* Contact us page */
    public function contactus() 
    {
        return view('contact-us');
    }

    //************* Pricing page */
    public function pricing()
    {
        return view('pricing');
    }
	
	//************* privacyPolicy page */
    public function privacyPolicy()
    {
        return view('pricing');
    }

    //************* Place order page */
    public function placeorder()
    {
        $countries = Countries::get();
        return view('place-order',compact('countries'));
    }

    //*************************Store place order******* */
    public function placestore(Request $request)
    {
        $orders = new Orders;
        $orders->firstname = $request['firstname'];
        $orders->lastname = $request['lastname'];
        $orders->email = $request['email'];
        $orders->phone = $request['phone'];
        $orders->billing_address = $request['address1'];
        //$orders->shipping_address = $request['address2'];
        $orders->order_number = $this->getNextOrderNumber();
        $orders->qty = $request['qty'];
        $orders->amount = $request['amount'];
        $orders->country_id = $request['country'];
        $orders->state = $request['state'];
        $orders->zip = $request['postcode'];
        $orders->save();
        $orderid = $orders->id;
        
        //$data = ['message' => 'This is a test!'];
        $data = ['order_id' => $orderid];
        Mail::to($request['email'])->send(new placeorder($data));

        
        
        return response()->json([
                'status' => 200,
                'order_id' => $orderid,
                'message' =>'Order has been successfully created.']);

    }


    //*************************Store Contact store ******* */
    public function contactstore(Request $request)
    {
        $data = new Contacts;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile_number = $request->mobile_number;
        $data->subject = $request->subject;
        $data->comment = $request->comment;
        $data->save();
        return response()->json(['status' => 200, 'message' => 'Your request has been send successfully. we will get back to you soon.']);
    }



    /**************************************** Generate dynamic Number ************************************* */
    public function getNextOrderNumber()
	{
	    $lastOrder = Orders::orderBy('created_at', 'desc')->first();

	    if (!$lastOrder)
	        $number = 0;
	    else
	        $number = substr($lastOrder->order_number, 3);

	    return 'ORD' . sprintf('%06d', intval($number) + 1);
    }


    /********************** Thank you page after order place ******************* */
    public function orderthankyou(Request $request)
    {
       $orderid = $request['order_id'];
       $orderdata = Orders::where('id', $orderid)->first();
       return view('order-thank-you',compact('orderdata'));
    }
    
    
    /*public function get_profile($id, Request $request)
    {
       $id = $request['id'];
       return view('get-profile-page',compact('id'));
    }*/

    public function get_profile_new($id="", Request $request)
    {
        if($request->has('param') && $request->filled('param')){
            $id = $request['param'];
        }
       
        $user = User::find($id);
        
        $company = Company::where('user_id', $id)->first();
        $social_mtype_website = SocialNetwork::where('media_type', 'website')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        $social_mtype_mail = SocialNetwork::where('media_type', 'socialMail')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        $social_mtype_instagram = SocialNetwork::where('media_type', 'instagram')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        $social_mtype_facebook = SocialNetwork::where('media_type', 'facebook')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        $social_mtype_twitter = SocialNetwork::where('media_type', 'twitter')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        $social_mtype_youtube = SocialNetwork::where('media_type', 'youtube')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        $social_mtype_linkedin = SocialNetwork::where('media_type', 'linkdin')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        $social_mtype_contact_number = SocialNetwork::where(function($query) {
                $query->orwhere('media_type', 'homeNumber');
                $query->orwhere('media_type', 'workNumber');
                $query->orwhere('media_type', 'otherNumber');
        })->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        
        $social_mtype_music = SocialNetwork::where('media_type', 'music')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        $social_mtype_payment = SocialNetwork::where('media_type', 'payment')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        $social_mtype_e_link = SocialNetwork::where('media_type', 'externalLink')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
        
        
        
        return view('get-profile-page', compact('id', 'user', 'company', 'social_mtype_website',
        'social_mtype_mail',
        'social_mtype_instagram',
        'social_mtype_facebook',
        'social_mtype_twitter',
        'social_mtype_youtube',
        'social_mtype_linkedin',
        'social_mtype_contact_number',
        'social_mtype_music',  
        'social_mtype_payment',
        'social_mtype_e_link'
        ));
    }
	
	public function get_profile_with_card($card_id, $id)
    {
		$carditem = Carditems::where('card_id',$card_id)->first();
		if($carditem && $carditem->active_date){
			$decrypted = base64_decode($id);
			$user = User::find($decrypted);
			$my_connections = Usercontact::where('user_id',$user->id)->count() + 1;
			$user_image = '/user/default.png';
			if($user->profile->account_flag != 'hospital'){
				$icone_socials = ProfileIcone::with('icone')->where('profile_id',$user->profile->id)->where('type',$user->profile->account_flag)->get();
				return view('get-profile-page', compact('id', 'user', 'my_connections', 'icone_socials'));
			}else{
				$icone_socials = ProfileHospital::where('profile_id',$user->profile->id)->where('by_default',1)->first();
				$current_date = Carbon::now()->toDateString();
				$to_date = Carbon::createFromFormat('m/d/Y', $icone_socials->date_of_birth)->toDateString();
				$datediff = strtotime($current_date) - strtotime($to_date);
				$age_datediff = round(($datediff / (60 * 60 * 24))/365);
				if($icone_socials){
					$user_image = $icone_socials->photo;
				}
				if($icone_socials->uplod_file){
					$icone_socials->uplod_file = explode(',',$icone_socials->uplod_file);
				}else{
					$icone_socials->uplod_file = array();
				}
				return view('get-profile-hospital-page', compact('id', 'user', 'my_connections', 'age_datediff', 'user_image', 'icone_socials'));
			}
		}else{
			return abort(404);
		}
	}
	
    public function get_profile($id="", Request $request)
    {
        //dd($request);
        if($request->has('param') && $request->filled('param')){
            $id = $request['param'];
        }
		$decrypted = base64_decode($id);
        $user = User::find($decrypted);
		$my_connections = Usercontact::where('user_id',$user->id)->count() + 1;
		$user_image = '/user/default.png';
		if($user->profile->account_flag != 'hospital'){
			$icone_socials = ProfileIcone::with('icone')->where('profile_id',$user->profile->id)->where('type',$user->profile->account_flag)->get();
			return view('get-profile-page', compact('id', 'user', 'my_connections', 'icone_socials'));
		}else{
			$icone_socials = ProfileHospital::where('profile_id',$user->profile->id)->where('by_default',1)->first();
			$current_date = Carbon::now()->toDateString();
			$to_date = Carbon::createFromFormat('m/d/Y', $icone_socials->date_of_birth)->toDateString();
			$datediff = strtotime($current_date) - strtotime($to_date);
			$age_datediff = round(($datediff / (60 * 60 * 24))/365);
			if($icone_socials){
				$user_image = $icone_socials->photo;
			}
			if($icone_socials->uplod_file){
				$icone_socials->uplod_file = explode(',',$icone_socials->uplod_file);
			}else{
				$icone_socials->uplod_file = array();
			}
			// echo '<pre>'; print_r($icone_socials->toArray()); die;
			return view('get-profile-hospital-page', compact('id', 'user', 'my_connections', 'age_datediff', 'user_image', 'icone_socials'));
		}
    }


    /*
        Savaji Rathod  Date: 27-04-21  this function use addtocontact vcards save download.
    */
    public function addtocontact(Request $request){

        if($request->has('profile_id') && $request->filled('profile_id')){
            $id = $request['profile_id'];
        }
        $request->profile_id;
        $user = User::find($id);
		$icone_socials = ProfileIcone::with('icone')->where('profile_id',$user->profile->id)->where('icone_id','!=','1')->get();
		$icone_socials_tel = ProfileIcone::with('icone')->where('profile_id',$user->profile->id)->where('icone_id','1')->first();
		
        
        // if($user->is_temp == 1){
            
            // $company = Company::where('user_id', $id)->first();
            // $social_mtype_website = TempSocialNetwork::where('media_type', 'website')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_mail = TempSocialNetwork::where('media_type', 'socialMail')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_instagram = TempSocialNetwork::where('media_type', 'instagram')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_facebook = TempSocialNetwork::where('media_type', 'facebook')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_twitter = TempSocialNetwork::where('media_type', 'twitter')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_youtube = TempSocialNetwork::where('media_type', 'youtube')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_linkedin = TempSocialNetwork::where('media_type', 'linkdin')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_contact_number = TempSocialNetwork::where(function($query) {
                    // $query->orwhere('media_type', 'homeNumber');
                    // $query->orwhere('media_type', 'workNumber');
                    // $query->orwhere('media_type', 'otherNumber');
            // })->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            
            // $social_mtype_music = TempSocialNetwork::where('media_type', 'music')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_payment = TempSocialNetwork::where('media_type', 'payment')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_e_link = TempSocialNetwork::where('media_type', 'externalLink')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();  
            
        // }else{
            
            // $company = Company::where('user_id', $id)->first();
            // $social_mtype_website = SocialNetwork::where('media_type', 'website')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_mail = SocialNetwork::where('media_type', 'socialMail')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_instagram = SocialNetwork::where('media_type', 'instagram')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_facebook = SocialNetwork::where('media_type', 'facebook')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_twitter = SocialNetwork::where('media_type', 'twitter')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_youtube = SocialNetwork::where('media_type', 'youtube')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_linkedin = SocialNetwork::where('media_type', 'linkdin')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_contact_number = SocialNetwork::where(function($query) {
                    // $query->orwhere('media_type', 'homeNumber');
                    // $query->orwhere('media_type', 'workNumber');
                    // $query->orwhere('media_type', 'otherNumber');
            // })->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            
            // $social_mtype_music = SocialNetwork::where('media_type', 'music')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_payment = SocialNetwork::where('media_type', 'payment')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();
            // $social_mtype_e_link = SocialNetwork::where('media_type', 'externalLink')->where('status', 1)->where('media_value', '!=', '')->where('user_id', $id)->get();   
            
        // }
			
			// return $firstname; 
			
            // define vcard
            $vcard = new VCard();
            // define variables
            $firstname = $user->name;
            $lastname = '';
            $additional = '';
            $prefix = '';
            $suffix = '';
			
            // add personal data
            $vcard->addName($firstname, $additional, $prefix, $suffix);

            // add work data
            $vcard->addCompany("");
            $vcard->addJobtitle("");
            $vcard->addEmail($user->email);
            $vcard->addPhoneNumber($user->mobile, 'PREF;WORK');
            // foreach ($social_mtype_contact_number as $key => $row) {
			if($icone_socials_tel){
				$vcard->addPhoneNumber(ltrim($icone_socials_tel->link,'tel:'), 'WORK');
			}
            foreach ($icone_socials as $key => $row) {
				if($row->contact_link){
					$web_url = $row->contact_link;
					$vcard->addURL($web_url,"TYPE={$row->icone->name}");
				}
            }
            //$vcard->addLabel('Webtual, Testing, workpostcode Belgium,Ahmedabad');

            //$vcard->addAddress(null, null, 'street', 'worktown', null, 'workpostcode', 'Belgium');
            // $vcard->addURL('http://www.jeroendesloovere.be');

            $vcard->addPhoto(public_path($user->profile->avatar));
			 
			 return $vcard->download(); 
             // return vcard as a string
             // return $vcard->getOutput();
              // return vcard as a download
			// save vcard on disk
              $storagePath  = public_path('contact/');
              $vcard->setSavePath($storagePath);
              $vcard->save();
			// $file_url = url('contact/'.implode('-',explode(' ',strtolower($firstname))).'.vcf');
			// return $file_url; 

    }


}
