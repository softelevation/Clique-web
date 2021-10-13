<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
// use App\Traits\HelperTrait;
use Stripe;

trait PaymentTrait
{
    // use HelperTrait;

    // Create Stripe API Token
    public function stripe_token(){
		$stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
		return $stripe;
    }

    // Craete Customer on Stripe
	// $stripe = $this->stripe_token();
	
	// Craete stripe charge on Stripe
	
	public function createToken($stripe,$input){
		// $stripe = $this->stripe_token();
		$stripe_payment = $stripe->tokens->create([
						'card' => [
							'number' => $input['card_no'],
							'exp_month' => $input['exp_month'],
							'exp_year' => $input['exp_year'],
							'cvc' => $input['cvc'],
						  ],
						]);
		return $stripe_payment['id'];
    }
	
	
	
	public function getAllCustomer(){
		$stripe = $this->stripe_token();
		$stripeCus = $stripe->customers->all(['limit' => 3]);
		return $stripeCus;
    }
	
	
	public function createCustomer($stripe, $data){
		
		$customer = $stripe->customers->create([
		  'name' => $data['name'],
		  'email' => $data['email'],
		  'source' => $data['inputToken'],
		  'description' => 'My First Test Customer (created for API docs)',
		  "address" => ["city" => 'mohali', "country" => 'india', "line1" => 'mohali phase 3', "line2" => "", "postal_code" => '160069', "state" => 'Punjab']
		]);
		
		
		return $customer['id'];
        // $stripe = $this->stripe_token();
        // $charge = $stripe->charges()->create($data);
        // return $charge;
    }
	
	
	public function createCharge($data){
		$stripe = $this->stripe_token();
		
		$inputToken = $this->createToken($stripe,array(
									'card_no'=>$data['card_no'],'exp_month'=>$data['exp_month'],
									'exp_year'=>$data['exp_year'],'cvc'=>$data['cvc']
								));
		
		$inputcreateCustomer = $this->createCustomer($stripe, array('name'=>$data['name'],'email'=>$data['email'],'inputToken'=>$inputToken));
		
		
		$stripe_charge = $stripe->charges->create([
		  'customer' => $inputcreateCustomer,
		  'amount' => round($data['amount'] * 100),
		  'currency' => 'INR',
		  'description' => 'My First Test Charge (created for API docs)',
		]);
		
		
		// print_r();
		// $customer['id']
		// return $inputField;
        // $stripe = $this->stripe_token();
        // $charge = $stripe->charges()->create($data);
        // return $charge;
		return $stripe_charge;
    }
	
	public function subscription_curl($receiptbytes){
		// $applesharedsecret = "applesecretfromyourdevaccount";
		// $receiptbytes      = "......applereceipt.......";
		$appleurl          = "https://buy.itunes.apple.com/verifyReceipt"; // for production
		// use https://sandbox.itunes.apple.com/verifyReceipt for testing with sandbox receipt
		$request = json_encode(array("receipt-data" => $receiptbytes,"password"=>'0792494bdb014f29b13863640e35111a','exclude-old-transactions'=>true));
		$ch = curl_init($appleurl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		$jsonresult = curl_exec($ch);
		curl_close($ch);
		return json_decode($jsonresult);
	}
}
