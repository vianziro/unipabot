<?php 

define("BOT_TOKEN", "240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs");
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

date_default_timezone_set('Europe/Rome');
$today_date = date("d-m-Y");
$today_hour = date("H:i:s");


$text = trim($text);
$text = strtolower($text);
header("Content-Type: application/json");
$response = '';
$response2 = '';



//CERCA AULA 
elseif(strpos($text, "/cercaaula") === 0 || $text == "🔍 CERCA AULA" || $text == "🔍 cerca aula" || $text == "Aule" || $text == "aule")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "🏪 Menu Aule 🏪\n\n".$firstname.", come si chiama l'aula che cerchi?\n\n\xE2\x9A\xA0 ES. F170", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE"))
			,'resize_keyboard' => true
		)
	);
	
	$handle=curl_init();
	curl_setopt($handle,CURLOPT_URL,"https://api.telegram.org/bot$botToken/$method");
	curl_setopt($handle,CURLOPT_HTTPHEADER,array('Content-type: application/json'));
	curl_setopt($handle,CURLOPT_POST,1);
	curl_setopt($handle,CURLOPT_POSTFIELDS,JSON_ENCODE($postField));
	curl_setopt($handle,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($handle,CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($handle,CURLOPT_ENCODING,1);
	$dati=json_decode( curl_exec($handle) ,true);
	curl_close($handle);
	
	var_dump($dati);
	
	//$response = "\xF0\x9F\x91\xA4 Menu Professori \xF0\x9F\x91\xA5\n\n/profingegneria \xF0\x9F\x91\xA4 Prof Ingegneria \n\n/profarchitettura \xF0\x9F\x91\xA4 Prof Architett. \n\n/profeconomia \xF0\x9F\x91\xA4 Prof Economia \n\n";
	
}

// AULE IN ELENCO
else if(strpos($text, "/auleinelenco") === 0 || $text == "🏪 AULE IN ELENCO" || $text == "🏪 aule in elenco")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	
	$response = "Le aule in elenco sono:\n\nF130\n\nF140\n\nF150\n\nF160\n\nF170\n\nF210\n\nF220\n\nF230\n\nF240\n\nF310\n\nF320\n\nPer segnalare altre aule scrivi a @gabrieledellaria";
}

//SOTTOSEZIONE Aule

//AULE

	elseif(strpos($text, "F130") === 0 || $text == "f130" || $text == "F130" || $text == "Aula Tortorici" || $text == "aula tortorici" || $text == "tortorici")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change image name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.8"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}
	
	elseif(strpos($text, "F140") === 0 || $text == "f140" || $text == "F140")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change image name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.8 subito dopo la F130"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}
	
	elseif(strpos($text, "F150") === 0 || $text == "f150" || $text == "F150" || $text == "Aula Capito" || $text == "aula capito" || $text == "capito" || $text == "aula capitò" || $text == "capitò")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change image name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.8"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}
	
	elseif(strpos($text, "F160") === 0 || $text == "f160" || $text == "F160" || $text == "Aula Rubino" || $text == "aula rubino" || $text == "rubino" )
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change image name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.8"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}
	

	elseif(strpos($text, "F170") === 0 || $text == "f170" || $text == "F170" || $text == "Aula Alberti" || $text == "aula alberti" || $text == "alberti" )
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.8"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}


	elseif(strpos($text, "F180") === 0 || $text == "f180" || $text == "F180" || $text == "Aula Manzella" || $text == "aula manzella" || $text == "manzella" )
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.8");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "F010") === 0 || $text == "f010")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "F100") === 0 || $text == "f100" || $text == "F100")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.8 sul corridio che dà sul piazzale di Ingegneria"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

elseif(strpos($text, "L110") === 0 || $text == "l110" || $text == "L110")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.8 accanto alla F160"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "F110") === 0 || $text == "f110" || $text == "F110")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.8 sul corridio che dà sul piazzale di Ingegneria"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "F210") === 0 || $text == "f210" || $text == "F210")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.8 sul corridio che dà sul piazzale di Ingegneria"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "F220") === 0 || $text == "f220" || $text == "F220" || $text == "Aula Damiani Almeyda" || $text == "aula damiani almeyda")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.8 sul corridio che dà sul piazzale di Ingegneria"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "F230") === 0 || $text == "f230" || $text == "F230" || $text == "Aula Zanca" || $text == "aula zanca")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.8 sul corridio che dà sul piazzale di Ingegneria"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "F240") === 0 || $text == "f240" || $text == "F240")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.8 sul corridio che dà sul piazzale di Ingegneria"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "F310") === 0 || $text == "f310" || $text == "F310")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 3° Piano dell'Ed.8 sul corridio che dà sul piazzale di Ingegneria"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "F320") === 0 || $text == "f320" || $text == "F320")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 3° Piano dell'Ed.8 sul corridio che dà sul piazzale di Ingegneria"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "L010") === 0 || $text == "l010")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8 ( DIIV - Dip. di Ingegneria delle Infrastrutture Viarie )");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "O010") === 0 || $text == "o010")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8 ( DIM - Dip. di Ingegneria Meccanica )"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "O011") === 0 || $text == "o011")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8 ( DIM - Dip. di Ingegneria Meccanica )"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "O210") === 0 || $text == "o210")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.8 ( DIM - Dip. di Ingegneria Meccanica )"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "O220") === 0 || $text == "o220")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.8 ( DIM - Dip. di Ingegneria Meccanica )"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1051803", 
						'longitude' => "13.3487588");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "N010") === 0 || $text == "n010")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8, ingresso dal DTMPIG (Dip. di Tecnologia Meccanica, Produzione ed Ingegneria Gestionale)"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "N020") === 0 || $text == "n020")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8, ingresso dal DTMPIG (Dip. di Tecnologia Meccanica, Produzione ed Ingegneria Gestionale)"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "N030") === 0 || $text == "n030")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8, ingresso dal DTMPIG (Dip. di Tecnologia Meccanica, Produzione ed Ingegneria Gestionale)"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "N040") === 0 || $text == "n040")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8, ingresso dal DTMPIG (Dip. di Tecnologia Meccanica, Produzione ed Ingegneria Gestionale)"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "H010") === 0 || $text == "h010")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8 (DISeG - Dip. di Ingegneria Strutturale e Geotecnica)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "H020") === 0 || $text == "h020")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8 (DISeG - Dip. di Ingegneria Strutturale e Geotecnica)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "H030") === 0 || $text == "h030")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8 (DISeG - Dip. di Ingegneria Strutturale e Geotecnica)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "H040") === 0 || $text == "h040")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8 (DISeG - Dip. di Ingegneria Strutturale e Geotecnica)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "G210") === 0 || $text == "g210")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.8 (DPCE - Dip. di Progetto e Costruzione Edilizia)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "G220") === 0 || $text == "g220")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.8 (DPCE - Dip. di Progetto e Costruzione Edilizia)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "M020") === 0 || $text == "m020")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.8 (DTIA - Dip. di Tecnologie e Infrastrutture Aeronautiche)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044217", 
						'longitude' => "13.3474693");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "C310") === 0 || $text == "c310")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 3° Piano dell'Ed.7 (PRESIDENZA INGEGNERIA)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044819", 
						'longitude' => "13.3484525");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "C320") === 0 || $text == "c320")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 3° Piano dell'Ed.7 (PRESIDENZA INGEGNERIA)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044819", 
						'longitude' => "13.3484525");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "C330") === 0 || $text == "c330")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 3° Piano dell'Ed.7 (PRESIDENZA INGEGNERIA)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044819", 
						'longitude' => "13.3484525");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "C340") === 0 || $text == "c340")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 3° Piano dell'Ed.7 (PRESIDENZA INGEGNERIA)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1044819", 
						'longitude' => "13.3484525");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "T110") === 0 || $text == "t110")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.9 (Dip. di Ricerche Energetiche ed Ambientali)"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "T120") === 0 || $text == "t120")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.9 (Dip. di Ricerche Energetiche ed Ambientali)"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "T130") === 0 || $text == "t130")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.9 (Dip. di Ricerche Energetiche ed Ambientali)"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "T220") === 0 || $text == "t220")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.9 (Dip. di Ricerche Energetiche ed Ambientali)"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "T230") === 0 || $text == "t230")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.9 (Dip. di Ricerche Energetiche ed Ambientali)"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "U110") === 0 || $text == "u110")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.9 (DIEET - Dip. di Ingegneria Elettrica, Elettronica e delle Telecomunicazioni)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "U120") === 0 || $text == "u120")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.9 (DIEET - Dip. di Ingegneria Elettrica, Elettronica e delle Telecomunicazioni)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "U140") === 0 || $text == "u140")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.9 (DIEET - Dip. di Ingegneria Elettrica, Elettronica e delle Telecomunicazioni)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "U150") === 0 || $text == "u150")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.9 (DIEET - Dip. di Ingegneria Elettrica, Elettronica e delle Telecomunicazioni)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "U160") === 0 || $text == "u160")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.9 (DIEET - Dip. di Ingegneria Elettrica, Elettronica e delle Telecomunicazioni)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "U180") === 0 || $text == "u180")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.9 (DIEET - Dip. di Ingegneria Elettrica, Elettronica e delle Telecomunicazioni)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "USCR") === 0 || $text == "uscr")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.9 (DIEET - Dip. di Ingegneria Elettrica, Elettronica e delle Telecomunicazioni)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.103448", 
						'longitude' => "13.345832");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "A210") === 0 || $text == "a210")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.6 (DIN - Dip. di Ingegneria Nucleare)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
			$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.10623", 
						'longitude' => "13.3503068");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "A220") === 0 || $text == "a220")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.6 (DIN - Dip. di Ingegneria Nucleare)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
			$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.10623", 
						'longitude' => "13.3503068");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "A320") === 0 || $text == "a320")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 3° Piano dell'Ed.6 (DINFO - Dip. di Ingegneria Informatica)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
			$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.10623", 
						'longitude' => "13.3503068");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "A330") === 0 || $text == "a330")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 3° Piano dell'Ed.6 (DINFO - Dip. di Ingegneria Informatica)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.10623", 
						'longitude' => "13.3503068");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "B010") === 0 || $text == "b010")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.6 (DICPM - Dip. di Ingegneria Chimica dei Processi e dei Materiali)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
			$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.10623", 
						'longitude' => "13.3503068");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "B020") === 0 || $text == "b020")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.6 (DICPM - Dip. di Ingegneria Chimica dei Processi e dei Materiali)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
			$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.10623", 
						'longitude' => "13.3503068");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "B110") === 0 || $text == "b110")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.6 (DICPM - Dip. di Ingegneria Chimica dei Processi e dei Materiali)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
			$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.10623", 
						'longitude' => "13.3503068");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "B120") === 0 || $text == "b120")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.6 (DICPM - Dip. di Ingegneria Chimica dei Processi e dei Materiali)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
			$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.10623", 
						'longitude' => "13.3503068");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "B210") === 0 || $text == "b210")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 2° Piano dell'Ed.6 (DICPM - Dip. di Ingegneria Chimica dei Processi e dei Materiali)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
			$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.10623", 
						'longitude' => "13.3503068");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "B310") === 0 || $text == "b310")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al 3° Piano dell'Ed.6 (DICPM - Dip. di Ingegneria Chimica dei Processi e dei Materiali)");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
			$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.10623", 
						'longitude' => "13.3503068");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}

	elseif(strpos($text, "V010") === 0 || $text == "v010")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'photo' => new CURLFile(realpath("./img/mappaauleing.jpg")), 
						'caption' => "L'aula ".$text." si trova al Piano Terra dell'Ed.10 ( DIAS - Dip. di Ingegneria dell'Automazione e dei Sistemi )");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1036949", 
						'longitude' => "13.3453277");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}


//else
//{
//	$response = "\xE2\x9A\xA0 Il comando che hai eseguito non è valido!\n\nDigita /help per il mio elenco comandi";
//}
	

$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);

$parameters = array('chat_id' => $chatId, "text" => $response2);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);