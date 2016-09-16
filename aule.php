<?php

define("BOT_TOKEN", "254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o");
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";


$text = trim($text);
$text = strtolower($text);
header("Content-Type: application/json");
$response = '';
$response2 = '';

// AULE
else if(strpos($text, "/aule") === 0 || $text == "\xF0\x9F\x8C\x8E AULE" || $text == "\xF0\x9F\x8C\x8E aule")
{
	
	$message = isset($update['message']) ? $update['message'] : "";
	$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
	$text = isset($message['text']) ? $message['text'] : "";
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaunipa.jpg")), 
						'caption' => "Mappa Unipa"/*$text*/);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);

 //comandi standard telegram da docs:
 //sendPhoto
 //sendAudio
 //sendDocument
 //sendSticker
 //sendVideo
 //sendVoice
 //sendLocation
 //sendChatAction
	
}

$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);

$parameters = array('chat_id' => $chatId, "text" => $response2);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);
