<?php

class ContactForm
{
    private $api;

    public function __construct(B24API $api)
    {
        $this->api = $api;
    }

    public function handleFormSubmission($formData)
    {
        $leadData = [
            'fields' => [
                'NAME' => $formData['name'],
                'EMAIL' => [['VALUE' => $formData['email'], 'VALUE_TYPE' => 'WORK']],
                'PHONE' => [['VALUE' => $formData['phone'], 'VALUE_TYPE' => 'WORK']],
                'COMMENT' => $formData['comment'],
            ],
        ];
        return $this->api->sendLead($leadData);
    }
}
