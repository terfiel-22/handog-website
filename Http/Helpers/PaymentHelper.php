<?php

namespace Http\Helpers;

use GuzzleHttp\Client;
use Http\Constants\PaymongoPayment;

class PaymentHelper
{
    public string $auth;
    public Client $client;

    public function __construct(array $config)
    {

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

            $response = $this->client->request('POST', 'https://api.paymongo.com/v1/payment_intents', [
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
            if ($type === 'card' && !empty($details)) {
                $payload['data']['attributes']['details'] = $details;
            }

            $response = $this->client->request('POST', 'https://api.paymongo.com/v1/payment_methods', [
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


    public function attachPaymentIntent($paymentIntentId, $paymentMethodId, $returnUrl = 'http://localhost:8000/booking')
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

            $response = $this->client->request('POST', "https://api.paymongo.com/v1/payment_intents/{$paymentIntentId}/attach", [
                'body' => json_encode($payload),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'authorization' => $this->auth,
                ],
            ]);

            return json_decode($response->getBody()->getContents())->data->attributes->next_action->redirect->url;
        } catch (\Throwable $e) {
            echo "Payment API Error: " . $e->getMessage();
        }
    }
}
