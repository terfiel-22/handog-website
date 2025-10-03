<?php

namespace Http\Helpers;

use Paymongo\PaymongoClient;
use Paymongo\Exceptions\InvalidRequestException;
use Paymongo\Exceptions\AuthenticationException;
use Paymongo\Exceptions\ApiException;

class PaymentHelper
{
    public PaymongoClient $client;

    public function __construct(array $config)
    {
        $this->client = new PaymongoClient($config["secret"]);
    }

    public function createPaymentIntent($amount)
    {
        try {
            return $this->client->paymentIntents->create([
                'amount' => $amount * 100,
                'currency' => 'PHP',
                'payment_method_allowed' => ['card', 'paymaya', 'gcash'],
                'description' => "Payment"
            ]);
        } catch (AuthenticationException $e) {
            echo "Authentication Error: " . $e->getMessage();
        } catch (InvalidRequestException $e) {
            echo "Invalid Request Error: " . $e->getMessage() . "\n";
            foreach ($e->getErrors() as $error) {
                echo " - Field `{$error->source->attribute}`: {$error->detail}\n";
            }
        } catch (ApiException $e) {
            echo "API Error: " . $e->getMessage();
        }
    }
}
