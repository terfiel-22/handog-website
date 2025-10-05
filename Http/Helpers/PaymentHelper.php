<?php

namespace Http\Helpers;

use GuzzleHttp\Client;
use Http\Constants\PaymongoPayment;
use Http\Enums\PaymentMethod;

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

    public function createPaymentIntent($amount)
    {
        try {
            $payload = [
                'data' => [
                    'attributes' => [
                        'amount' => $amount * 100, // PayMongo requires amount in cents
                        'payment_method_allowed' => array_keys(PaymongoPayment::METHODS),
                        'payment_method_options' => [
                            'card' => [
                                'request_three_d_secure' => 'any',
                            ],
                        ],
                        'currency' => 'PHP',
                        'capture_type' => 'automatic',
                    ],
                ],
            ];

            $response = $this->client->request('POST', $this->apiUrl . '/payment_intents', [
                'body' => json_encode($payload),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'authorization' => $this->auth,
                ],
            ]);

            return json_decode($response->getBody()->getContents())->data->id;
        } catch (\Throwable $e) {
            echo "Payment API Error: " . $e->getMessage();
        }
    }


    public function createPaymentMethod($type, array $details = [])
    {
        try {
            $payload = [
                'data' => [
                    'attributes' => [
                        'type' => $type,
                    ],
                ],
            ];

            // If it's a card, append details
            if ($type === PaymentMethod::CARD && !empty($details)) {
                $payload['data']['attributes']['details'] = $details;
            }

            $response = $this->client->request('POST', $this->apiUrl . '/payment_methods', [
                'body' => json_encode($payload),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'authorization' => $this->auth,
                ],
            ]);

            return json_decode($response->getBody()->getContents())->data->id;
        } catch (\Throwable $e) {
            echo "Payment API Error: " . $e->getMessage();
        }
    }


    public function attachPaymentIntent($paymentIntentId, $paymentMethodId, $returnUrl)
    {
        try {
            $payload = [
                'data' => [
                    'attributes' => [
                        'payment_method' => $paymentMethodId,
                        'return_url'     => $returnUrl,
                    ],
                ],
            ];

            $response = $this->client->request('POST', $this->apiUrl . "/payment_intents/{$paymentIntentId}/attach", [
                'body' => json_encode($payload),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'authorization' => $this->auth,
                ],
            ]);

            return json_decode($response->getBody()->getContents())->data;
        } catch (\Throwable $e) {
            echo "Payment API Error: " . $e->getMessage();
        }
    }
}
