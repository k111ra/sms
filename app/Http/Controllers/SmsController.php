<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class SmsController extends Controller
{

    private $SMS_SENDER = "Sample";
    private $RESPONSE_TYPE = 'json';
    private $SMS_USERNAME = 'Your username';
    private $SMS_PASSWORD = 'Your password';


    public function getUserNumber(Request $request)
    {
        $phone_number = $request->input('phone_number');

        if(!$phone_number)  {
            return redirect()->back()->with('message', 'Veuillez entrer un numero');
        }

        $message = "A message has been sent to you";

        $this->initiateSmsActivation($phone_number, $message);
//        $this->initiateSmsGuzzle($phone_number, $message);

        return redirect()->back()->with('message', 'Votre Message a été envoyer');
    }


    public function initiateSmsActivation($phone_number, $message){
        $isError = 0;
        $errorMessage = true;

        //Preparing post parameters
        $postData = array(
            'username' => $this->SMS_USERNAME,
            'password' => $this->SMS_PASSWORD,
            'message' => $message,
            'sender' => $this->SMS_SENDER,
            'mobiles' => $phone_number,
            'response' => $this->RESPONSE_TYPE
        );

        $url = "http://??????";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);


        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);


        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 );
        }
    }

    public function initiateSmsGuzzle($phone_number, $message)
    {
        $client = new Client();

        $response = $client->post('http://??????', [
            'verify'    =>  false,
            'form_params' => [
                'username' => $this->SMS_USERNAME,
                'password' => $this->SMS_PASSWORD,
                'message' => $message,
                'sender' => $this->SMS_SENDER,
                'mobiles' => $phone_number,
            ],
        ]);


        $response = json_decode($response->getBody(), true);
    }
}
