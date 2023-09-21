<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\UserTransaction;
use Illuminate\Http\Request;
use App\Models\User;

class BTCWebhook extends Controller
{

    // public function __invoke(Request $request){

    // }

    public function processWebhook(Request $request)
    {
        $secret = config('btcpayserver.default.secret');  // Get BTCpay secret from config/app.php
        $signature = $request->header('BTCPay-Sig');
        $payload = $request->getContent();
        
        $calculatedSignature = 'sha256=' . hash_hmac('sha256', $payload, $secret);

        if ($calculatedSignature == $signature) {
            $response = json_decode($payload, true);

            $userTransaction = UserTransaction::where('txid', $response['invoiceId'])->get()->first();

            // check if it is already paid
            if ($userTransaction->status == 'paid') {
                return response()->json(['info' => 'Already paid', 200]);
            }

            if ($userTransaction) {
                if ($response['type'] == 'InvoiceExpired') {
                    $userTransaction->update([
                        'status' => 'expired',
                    ]);
                } elseif ($response['type'] == 'InvoiceSettled' || 
                $response['type'] == 'InvoicePaymentSettled' || 
                $response['type'] == 'InvoiceReceivedPayment') {
                    $userTransaction->update([
                        'status' => 'paid',
                        'confirmations' => 1
                    ]);
                    $user = User::where('id', $userTransaction->user_id)->get()->first();

                    if ($user != null) {
                        $balance_in_cent = $user->balance_in_cent;

                        $user->update([
                            'balance_in_cent' => $balance_in_cent + $userTransaction->amount_cent
                        ]);
                    }
                }
            }
        } else {
            // Signature does not match
            return response()->json(['error' => 'Unauthorized attempt.'], 401);
        }

    }

}
