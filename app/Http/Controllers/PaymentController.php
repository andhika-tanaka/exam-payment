<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class PaymentController extends Controller
{
    //
    public function create()
    {
        //
        return Inertia::render('Payment/CreatePayment');
    }

    public function payment(Request $request){
        $request->validate([
            'product' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'int'],
            'price' => ['required', 'int'],
            'description' => ['string', 'max:255'],
        ]);

        $apiKey= 'SANDBOX33D25841-43B6-4110-B1E2-4DA4A9669401-20210908105647';
        
        $va = '0000008980538990';

        $body = [
            'product' => array($request->product),
            'qty' => array($request->qty),
            'price' => array($request->price),
            'description' => array($request->description) ,
            'returnUrl' => 'https://ipaymu.com/return',
            'notifyUrl' => 'https://ipaymu.com/notify',
            'cancelUrl' => 'https://ipaymu.com/cancel',
        ];

        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);

        $bodyEncrypt = strtolower(hash('sha256', $jsonBody));

        $stringToSign = 'POST:' . $va . ':' . $bodyEncrypt. ':' . $apiKey;

        $signature = hash_hmac('sha256', $stringToSign, $apiKey);
        
        $timestamp = Date('YmdHis');

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => $timestamp
        ])->post('https://sandbox.ipaymu.com/api/v2/payment', $body);

        $res = json_decode($response);

        if($res->Status == 200) {
            $sessionId  = $res->Data->SessionID;
            $url        = $res->Data->Url;
            return response('', 409)
            ->header('X-Inertia-Location', $url)
            ->header('sessionId', $sessionId);
        } else {
            echo $res;
        }
    }
}
