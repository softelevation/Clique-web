<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\CorporateRequest;

class corporate_request extends Mailable
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
        $address = 'clique@gmail.com';
        $subject = 'Corporate Request register';
        $name = 'Clique';


        $request_id = $this->data['request_id'];
        $requestdata = CorporateRequest::where('id', $request_id)->first();

        return $this->view('emails.corporaterequest')
        ->from($address, $name)
        ->cc($address, $name)
        ->bcc($address, $name)
        ->replyTo($address, $name)
        ->subject($subject)
        ->with([ 'request_details' => $requestdata ]);


    }
}
