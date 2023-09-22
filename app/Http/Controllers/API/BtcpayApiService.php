<?php
namespace App\Http\Controllers\API;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class BtcpayApiService
{
    private $client;

    public function __construct()
    {
        $email = config('btcpayserver.default.email');
        $password = config('btcpayserver.default.password');
        $storeId = config('btcpayserver.default.storeid');
	    $apiKey = config('btcpayserver.default.apikey');
        $host = config('btcpayserver.default.host');

        $credentials = base64_encode($email . ':' . $password);
        $this->client = new Client([
            'base_uri' => "$host/api/v1/stores/$storeId/",
            'headers' => [
                'Authorization' => [
                    'Basic ' . $credentials,
                    // 'token ' . $apiKey
                ],
                'Accept' => 'application/json',
            ],
        ]);
    }

    public function getAllinvoices()
    {
        $response = $this->client->get('invoices');

        return json_decode($response->getBody()->getContents(), true);
    }

    public function createInvoice(array $data)
    {
        $response = $this->client->post('invoices', [
            'json' => $data,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getInvoice($invoiceId)
    {
        $response = $this->client->get("invoices/{$invoiceId}");

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getWalletAddress()
    {

        $response = $this->client->get("payment-methods/onchain/BTC/wallet/address");

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getCustodianAccount()
    {
        $response = $this->client->get("payment-methods/onchain/BTC/wallet/transactions");

        return json_decode($response->getBody()->getContents(), true);
    }
}
