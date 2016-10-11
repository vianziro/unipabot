<?php

// PARAMETRI DA MODIFICARE
$WEBHOOK_URL = 'https://unipabot.herokuapp.com/execute.php';
$BOT_TOKEN = '240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs';

// NON APPORTARE MODIFICHE NEL CODICE SEGUENTE
$API_URL = 'https://api.telegram.org/bot' . $BOT_TOKEN .'/';
$method = 'setWebhook';
$parameters = array('url' => $WEBHOOK_URL);
$url = $API_URL . $method. '?' . http_build_query($parameters);
$handle = curl_init($url);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 2);
curl_setopt($handle, CURLOPT_TIMEOUT, 2);
$result = curl_exec($handle);
print_r($result);
