<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use App\Orders;
use App\Company;
use App\Countries;
use App\Carditems;

class placeorder extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance. 
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        //return $this->subject('Welcome to clique')->markdown('emails.placeorder', ['data' => $this->data]);
        
        $address = 'clique@gmail.com';
        $subject = 'Order Details';
        $name = 'Bhaveh Vania';
        
        
        $orderid = $this->data['order_id'];
        $orderdata = Orders::where('id', $orderid)->first();
        $country = Countries::where('id', $orderdata->country_id)->first();
        $carddata = Carditems::select('card_items.*');
        $carddata->leftJoin('orders', 'orders.id', '=', 'card_items.order_id');
        $carddata = $carddata->where('card_items.order_id','=',$orderid);
        $carddata = $carddata->orderBy('card_items.id', 'DESC')->get();
        $cardCount = count($carddata);

        ($country)? $countryName = $country->name : $countryName='';

        
        
        return $this->view('emails.placeorder')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'order_details' => $orderdata ]);
    }
}
