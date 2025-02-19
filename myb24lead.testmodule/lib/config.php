<?php

class Config
{
    private static $webhookUrl;

    public static function initialize($options)
    {
        self::$webhookUrl = $options['WEBHOOK_URL'] . $options['WEBHOOK_KEY'] . '/';
    }

    public static function getWebhookUrl()
    {
        return self::$webhookUrl;
    }
}
