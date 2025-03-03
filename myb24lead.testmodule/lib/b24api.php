<?php

class B24API
{
    private $webhookUrl;

    public function __construct($webhookUrl)
    {
        $this->webhookUrl = rtrim($webhookUrl, '/');
    }

    public function sendLead($data)
    {
        $ch = curl_init($this->webhookUrl . '/crm.lead.add.json');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $errorMessage = curl_error($ch);
            curl_close($ch);
            throw new Exception("cURL error: " . $errorMessage);
        }

        curl_close($ch);

        $responseData = json_decode($response, true);

        if (isset($responseData['error'])) {
            throw new Exception("API error: " . $responseData['error_description']);
        }

        return $responseData;
    }
}
