<?php

namespace Http\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Http\Constants\PaymongoPayment;
use Http\Enums\PaymentMethod;

class PaymentHelper
{
    public string $apiUrl;
    public Client $client;
    public string $auth;
    public array $errors;

    public string $paymentIntentId;
    public string $paymentMethodId;
    public object $attachedPaymentIntent;

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

            $this->paymentIntentId = json_decode($response->getBody()->getContents())->data->id;
            return $this;
        } catch (ClientException $e) {
            // Handle 4xx client errors
            $response = $e->getResponse()->getBody()->getContents();
            $errors = json_decode($response);
            $this->errors["payment_method"] = reset($errors)[0]->detail;
            return $this;
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

            $this->paymentMethodId = json_decode($response->getBody()->getContents())->data->id;
            return $this;
        } catch (ClientException $e) {
            // Handle 4xx client errors
            $response = $e->getResponse()->getBody()->getContents();
            $errors = json_decode($response);
            $this->errors["payment_method"] = reset($errors)[0]->detail;
            return $this;
        }
    }


    public function attachPaymentIntent($returnUrl)
    {
        try {
            $payload = [
                'data' => [
                    'attributes' => [
                        'payment_method' => $this->paymentMethodId,
                        'return_url'     => $returnUrl,
                    ],
                ],
            ];

            $response = $this->client->request('POST', $this->apiUrl . "/payment_intents/{$this->paymentIntentId}/attach", [
                'body' => json_encode($payload),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'accept' => 'application/json',
                    'authorization' => $this->auth,
                ],
            ]);

            $this->attachedPaymentIntent = json_decode($response->getBody()->getContents())->data;
            return $this;
        } catch (ClientException $e) {
            // Handle 4xx client errors
            $response = $e->getResponse()->getBody()->getContents();
            $errors = json_decode($response);
            $this->errors["payment_method"] = reset($errors)[0]->detail;
            return $this;
        }
    }

    public function createPaymentLink($amount, $successUrl = null, $failedUrl = null)
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

            // Add redirect URLs if provided
            if ($successUrl || $failedUrl) {
                $payload['data']['attributes']['redirect'] = [
                    'success' => $successUrl,
                    'failed' => $failedUrl,
                ];
            }

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
                'id' => $responseData['data']['id'],
                'checkout_url' => $responseData['data']['attributes']['checkout_url'],
                'status' => $responseData['data']['attributes']['status'],
            ];
        } catch (ClientException $e) {
            $response = $e->getResponse()->getBody()->getContents();
            $errors = json_decode($response, true);
            $this->errors["payment_link"] = $errors['errors'][0]['detail'] ?? 'Unknown error';
            return null;
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

            return [
                'id' => $responseData['data']['id'],
                'amount' => $responseData['data']['attributes']['amount'] / 100,
                'description' => $responseData['data']['attributes']['description'] ?? null,
                'remarks' => $responseData['data']['attributes']['remarks'] ?? null,
                'status' => $responseData['data']['attributes']['status'],
                'checkout_url' => $responseData['data']['attributes']['checkout_url'],
                'created_at' => date('Y-m-d H:i:s', $responseData['data']['attributes']['created_at']),
                'updated_at' => date('Y-m-d H:i:s', $responseData['data']['attributes']['updated_at']),
            ];
        } catch (ClientException $e) {
            $response = $e->getResponse()->getBody()->getContents();
            $errors = json_decode($response, true);
            $this->errors["retrieve_payment_link"] = $errors['errors'][0]['detail'] ?? 'Unknown error';
            return null;
        }
    }
}
