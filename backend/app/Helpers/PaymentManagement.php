<?php

namespace App\Helpers;

use Paymob\Library\Paymob;
use Illuminate\Support\Facades\Log;

class PaymentManagement
{
    public $paymobKeys;

    protected $paymob;

    public function __construct()
    {
        $this->paymobKeys = [
            'apiKey' => env('PAYMOB_API_KEY', 'your_api_key_here'),
            'pubKey' => env('PAYMOB_PUB_KEY', 'your_public_key_here'),
            'secKey' => env('PAYMOB_SEC_KEY', 'your_secret_key_here'),
            'integrationId' => [
                'card' => env('PAYMOB_CARD_INTEGRATION_ID', '5206932'),
                'wallet' => env('PAYMOB_WALLET_INTEGRATION_ID', '5210552'),
            ],
        ];
        $this->paymob = new Paymob();
    }

    public function authenticate()
    {
        return $this->paymob->authToken($this->paymobKeys);
    }

    public function createIntention(array $billingData, int $amountCents, string $method = 'card')
    {
        $integrationId = $this->paymobKeys['integrationId'][$method] ?? null;

        if (!$integrationId) {
            throw new \Exception("Invalid payment method: $method");
        }

        $merchantIntentionId = 'intent_' . time();

        $data = [
            'amount' => $amountCents,
            'currency' => 'EGP',
            'payment_methods' => array(5206932),
            'billing_data' => $billingData,
            'extras' => [
                'merchant_intention_id' => $merchantIntentionId,
            ],
            'special_reference' => $merchantIntentionId,
        ];
        Log::info('Intention Payload:', $data);
        $response = $this->paymob->createIntention($this->paymobKeys['secKey'], $data, $integrationId);
        Log::info('Paymob Response:', $response);

        return $response;
    }

    public function getCheckoutUrl(string $clientSecret)
    {
        $countryCode = $this->paymob->getCountryCode($this->paymobKeys['secKey']);
        $apiUrl = $this->paymob->getApiUrl($countryCode);

        return $apiUrl . "unifiedcheckout/?publicKey=" . $this->paymobKeys['pubKey'] . "&clientSecret=$clientSecret";
    }

    public function generatePaymentLink(array $billingData, int $amountCents, string $method = 'card')
    {
        $intention = $this->createIntention($billingData, $amountCents, $method);

        if (!isset($intention['cs'])) {
            throw new \Exception("Failed to create intention");
        }

        return $this->getCheckoutUrl($intention['cs']);
    }

    public function generateBillingData(
        string $email,
        string $firstName,
        string $lastName,
        string $phone,
        string $street,
        string $city,
        string $state,
        string $postalCode,
        string $country = 'EG'
    ): array {
        return [
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'phone_number' => $phone,
            'street' => $street,
            'city' => $city,
            'state' => $state,
            'postal_code' => $postalCode,
            'country' => $country,
        ];
    }
}
