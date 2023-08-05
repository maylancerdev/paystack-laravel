<?php

namespace Maylancer\Paystack;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;


class Paystack
{
    const PAYSTACK_PRODUCTION_API_ENDPOINT = 'https://api.paystack.co';
    const PAYSTACK_TESTNET_API_ENDPOINT = 'https://api.paystack.co';

    private $APIEndpoint = null;
    private $AuthAPIEndpoint = null;
    private $url = null;
    private $params = [];
    private $client;
    public  $enviroment;

    /**
     * Create a new PaystackClient instance
     */
    public function __construct()
    {
        $this->setKey();
        $this->setEnviroment();
        $this->setEndpoints();
        $this->resolve();


        if (empty($this->merchant_key)) {
            throw new \Exception('Error: No Merchant Key or Merchant ID passed');
        }


    }

    public function setKey()
    {
        $this->merchant_key = Config::get('paystack.secretKey');
    }


    public function setEnviroment()
    {
        $this->enviroment = Config::get('paystack.production');
    }

    public  function  setEndpoints()
    {
        $this->APIEndpoint = (!$this->enviroment) ? self::PAYSTACK_PRODUCTION_API_ENDPOINT : self::PAYSTACK_TESTNET_API_ENDPOINT;
        $this->AuthAPIEndpoint = (!$this->enviroment) ? self::PAYSTACK_PRODUCTION_API_ENDPOINT : self::PAYSTACK_TESTNET_API_ENDPOINT;
    }


    function resolve()
    {
        $this->client = new Client([
            'base_uri' => $this->APIEndpoint,
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->merchant_key
            ]
        ]);
    }




    /**
     * Friendly welcome
     * This function does nothing, believe me. Kindly ignore it.
     * @param string $phrase Phrase to return
     *
     * @return array
     */
    public function echoPhrase()
    {
        $this->url = $this->APIEndpoint;
        return $this->__execute('PUT');
    }

    public function verifyAccountNumber(string $account_number, string $bank_code)
    {
        $this->url = $this->AuthAPIEndpoint . '/bank/resolve';
        $this->params = ['account_number' => $account_number, 'bank_code' => $bank_code];
        return $this->__execute('GET');
    }

    public function getBanks()
    {
        $this->url = $this->AuthAPIEndpoint . '/bank/';
        return $this->__execute('GET');
    }

    private function __execute(string $requestType = 'POST')
    {
        $options = [
            'json' => array_filter($this->params),
            'verify' => true,
        ];

        if ($requestType === 'GET') {
            $options['query'] = array_filter($this->params);
        }

        $response = $this->client->request($requestType, $this->url, $options);
        return json_decode($response->getBody(), true);
    }

}
