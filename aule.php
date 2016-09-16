<?php

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
