<?php

namespace Http\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Http\Enums\YesNo;

class PaymentHelper
{
    public string $apiUrl;
    public Client $client;
    public string $auth;

    public function __construct(array $config)
    {
        $this->apiUrl = "https://api.paymongo.com/v1";
        $this->client = new Client();
        $this->auth = "Basic " . base64_encode($config["secret"] . ":");
    }

    public function createPaymentLink($amount)
    {
        try {
            $payload = [
                'data' => [
                    'attributes' => [
                        'amount' => $amount * 100, // PayMongo expects centavos
                        'description' => 'Payment Link',
                        'remarks' => null,
                    ],
                ],
            ];

            $response = $this->client->request('POST', $this->apiUrl . '/links', [
                'body' => json_encode($payload),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'authorization' => $this->auth,
                ],
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);

            return [
                'success' => YesNo::YES,
                'id' => $responseData['data']['id'],
                'checkout_url' => $responseData['data']['attributes']['checkout_url'],
                'status' => $responseData['data']['attributes']['status'],
            ];
        } catch (ClientException $e) {
            $response = $e->getResponse()->getBody()->getContents();
            $errors = json_decode($response, true);
            return [
                'success' => YesNo::NO,
                'error' => $errors['errors'][0]['detail'] ?? 'Unknown error',
            ];
        }
    }


    public function retrievePaymentLink($linkId)
    {
        try {
            $response = $this->client->request('GET', $this->apiUrl . '/links/' . $linkId, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'authorization' => $this->auth,
                ],
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);
            $attributes = $responseData['data']['attributes'];

            $paymentMethod = 'N/A';
            if (!empty($attributes['payments']['data'])) {
                $firstPayment = $attributes['payments']['data'][0];
                $paymentMethod = $firstPayment['attributes']['source']['type'] ?? 'N/A';
            }

            return [
                'success' => YesNo::YES,
                'amount' => $attributes['amount'] / 100, // convert to pesos
                'payment_method' => $paymentMethod,
                'payment_status' => $attributes['status'],
                'payment_link' => $attributes['checkout_url'],
            ];
        } catch (ClientException $e) {
            $response = $e->getResponse()->getBody()->getContents();
            $errors = json_decode($response, true);
            return [
                'success' => YesNo::NO,
                'error' => $errors['errors'][0]['detail'] ?? 'Unknown error',
            ];
        }
    }
}
