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

date_default_timezone_set('Europe/Rome');
$today_date = date("d-m-Y");
$today_hour = date("H:i:s");


$text = trim($text);
$text = strtolower($text);
header("Content-Type: application/json");
$response = '';
$response2 = '';

if(strpos($text, "/start") === 0 || $text=="\xF0\x9F\x94\xB4 START" || $text == "\xF0\x9F\x94\xB4 start")
{
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId
		, 'text' => "\xF0\x9F\x91\x8B Ciao $firstname (@$username), benvenuto in Unipa Bot!\n\nOggi è il ".$today_date." e sono le ".$today_hour
		, 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","\xF0\x9F\x93\x9A BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","\xE2\x84\xB9 ABOUT")),
			 'resize_keyboard' => true,
			'selective' => false,
			'one_time_keyboard' => false
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
	
	//$response = "\xF0\x9F\x91\x8B Ciao $firstname (@$username), benvenuto in Unipa Bot!";
}

// TORNA SUBITO AL MENU PRINCIPALE
if(strpos($text, "/menuprincipale") === 0 || $text=="🏠 MENU PRINCIPALE" || $text == "🏠 menu principale")
{
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "▶️ MENU PRINCIPALE ◀️\n\n ".$firstname." cosa vuoi fare?",
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","\xF0\x9F\x93\x9A BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","\xE2\x84\xB9 ABOUT"))
			,'resize_keyboard' => true,
			'selective' => false,
			'one_time_keyboard' => false
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
	
}

else if(strpos($text, "/help") === 0 || $text == "\xE2\x9A\xA0 HELP" || $text == "\xE2\x9A\xA0 help")
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
	
	$response = "\xF0\x9F\x93\x94 Ecco i miei comandi\n\n/start \xF0\x9F\x9A\x80 START BOT \n\n/professori \xF0\x9F\x91\xA4 Professori \n\n/mappa \xF0\x9F\x8C\x90 Mappa Unipa \n\n/orariolezioni \xF0\x9F\x95\x92 Orario Lezioni \n\n/oraribiblioteca \xF0\x9F\x8F\xA6 Orari Biblioteca \n\n/ristoro \xF0\x9F\x8D\x9D Punti Ristoro \n\n/about \xE2\x9A\xA0 Info sul Bot \n\n/help \xE2\x84\xB9 Elenco comandi \n\n";
}

else if($text == "\xE2\xAC\x85 BACK" || $text == "\xE2\xAC\x85 back")
{
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "▶️ MENU PRINCIPALE ◀️\n\n ".$firstname." cosa vuoi fare?",
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","\xF0\x9F\x93\x9A BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","\xE2\x84\xB9 ABOUT"))
			,'resize_keyboard' => true,
			'selective' => false,
			'one_time_keyboard' => false
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
}

//ABOUT
elseif(strpos($text, "/about") === 0 || $text == "\xE2\x84\xB9 ABOUT" || $text == "\xE2\x84\xB9 about")
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
	
	$response = "\xE2\x9A\xA0 Info:\n\nIn Unipa Bot potrai trovare tutte le info necessarie per l'Università di Palermo\n\n\xE2\x84\xB9 Credits:\n\nQuesto bot è stato creato da Gabriele Dell'Aria (@gabrieledellaria) ... Se hai suggerimenti contattami pure e sarò felice di accogliere i tuoi spunti";
}

//PUNTI RISTORO
elseif(strpos($text, "/ristoro") === 0 || $text == "\xF0\x9F\x8D\x94 RISTORO" || $text == "\xF0\x9F\x8D\x94 ristoro")
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
		
		$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8D\x94 Punti Ristoro\n\n".$firstname.", scegli dove andare a mangiare\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8D\x94 Panineria Jhonny"),array("\xF0\x9F\x8D\x94 Panineria del Viale","🍴 Casa Massaro"))
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
	
		//$response = "\xF0\x9F\x8D\x94 PUNTI RISTORO \xF0\x9F\x8D\x9D\n\n\xE2\x9A\xA0 Scegli il comando opportuno \n\n/jhonny \xF0\x9F\x8D\x94 Panineria da Jhonny \n\n/pandelviale \xF0\x9F\x8D\x94 Panineria del Viale \n\n"; 

}

//Panineria da Jhonny
elseif(strpos($text, "/jhonny") === 0 || $text == "\xF0\x9F\x8D\x94 Panineria Jhonny" || $text == "\xF0\x9F\x8D\x94 panineria jhonny")
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
	
	$response = "\xF0\x9F\x8D\x94 Panineria da Jhonny \n\n\xF0\x9F\x8C\x8E Localizzazione Maps \xF0\x9F\x8C\x8E\n\nhttps://goo.gl/a17ehV\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLun-Ven dalle 11.30 alle 23.30\n\nDa Settembre a Luglio\n\n";
}

//Panineria Del Viale
elseif(strpos($text, "/pandelviale") === 0 || $text == "\xF0\x9F\x8D\x94 Panineria del Viale" || $text == "\xF0\x9F\x8D\x94 panineria del viale")
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
	
	$response = "\xF0\x9F\x8D\x94 Panineria Del Viale \n\n\xF0\x9F\x8C\x8E Localizzazione Maps \xF0\x9F\x8C\x8E\n\nhttps://goo.gl/nGtgbY\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLun-Ven dalle 11.30 alle 23.30\n\nDa Settembre a Luglio\n\n";
}

//Casa Massaro
elseif(strpos($text, "/casamassaro") === 0 || $text == "🍴 Casa Massaro" || $text == "🍴 casa massaro")
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
	
	$response = "\xF0\x9F\x8D\x94 Casa Massaro \n\n\xF0\x9F\x8C\x8E Localizzazione \xF0\x9F\x8C\x8E\n\nAlla destra del Bar Massaro\n\nOrari Esercizio\n\nLun-Ven dalle 11.30 alle 23.30\n\nDa Settembre a Luglio\n\n";
}

// MENU STUDENTI
elseif(strpos($text, "/menustudenti") === 0 || $text == "\xF0\x9F\x91\xA5 MENU STUDENTI" || $text == "\xF0\x9F\x91\xA5 menu studenti" )
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8F\xA6 Menu Studenti \xF0\x9F\x8F\xA6\n\n".$firstname.", scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI"),array("\xF0\x9F\x93\x9A MATERIE A SCELTA","\xF0\x9F\x93\x91 TIROCINIO"))
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
	
	//$response = "\xF0\x9F\x8F\xA6 Menu Studenti \xF0\x9F\x8F\xA6\n\n/orariolezioni \xF0\x9F\x95\x92 ORARI LEZIONI \n\n/materieascelta \xF0\x9F\x95\x92 MATERIE A SCELTA CONSIGLIATE \n\n/tirocinio \xF0\x9F\x95\x92 TIROCINIO \n\n";
}

// MATERIE A SCELTA
elseif(strpos($text, "/matascelta") === 0 || $text == "\xF0\x9F\x93\x9A MATERIE A SCELTA" || $text == "\xF0\x9F\x93\x9A materie a scelta")
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
		
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le MATERIE A SCELTA consigliate ";
	}

//TIROCINIO	
elseif(strpos($text, "/tirocinio") === 0 || $text == "\xF0\x9F\x93\x91 TIROCINIO" || $text == "\xF0\x9F\x93\x91 tirocinio")
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
		
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le aziende di TIROCINIO consigliate ";
	}	

// MENU ORARIO LEZIONI
elseif(strpos($text, "/orariolezioni") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO LEZIONI" || $text == "\xF0\x9F\x95\x92 orario lezioni")
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x95\x92 SEZIONE ORARIO LEZIONI \xF0\x9F\x95\x92\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x91\xA5 MENU STUDENTI"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING","\xF0\x9F\x95\x92 ORARIO CORSI ARCH"),array("\xF0\x9F\x95\x92 ORARIO CORSI ECO"))
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
	
	//$response = "\xE2\x9A\xA0 Scegli Facoltà \xE2\x9A\xA0\n\n/orariolezing Corsi Ingegneria \n\n/orariolezarch Corsi Architettura \n\n";
}

// MENU ORARIO LEZIONI INGEGNERIA
elseif(strpos($text, "/orariolezing") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO CORSI ING" || $text == "\xF0\x9F\x95\x92 orario corsi ing")
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI"),array("\xF0\x9F\x95\x92 ORARIO ING INFORMATICA","\xF0\x9F\x95\x92 ORARIO ING GESTIONALE"),array("\xF0\x9F\x95\x92 ORARIO ING ELETTRONICA","\xF0\x9F\x95\x92 ORARIO ING MECCANICA"),array("\xF0\x9F\x95\x92 ORARIO ING ENERGIA","\xF0\x9F\x95\x92 ORARIO ING CHIMICA"),array("\xF0\x9F\x95\x92 ORARIO ING AMBIENTALE","\xF0\x9F\x95\x92 ORARIO ING CIV-EDI"),array("\xF0\x9F\x95\x92 ORARIO ING GEST INF","\xF0\x9F\x95\x92 ORARIO ING CIBERN"),array("\xF0\x9F\x95\x92 ORARIO ING BIOMEDICA"))
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
	
	//$response = "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\n/inginf Orari Ing.Informatica \n\n/inggest Orari Ing.Gestionale \n\n";
}

// ORARIO LEZIONI INGEGNERIA INFORMATICA
elseif(strpos($text, "/inginf") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING INFORMATICA" || $text == "\xF0\x9F\x95\x92 orario ing informatica")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING INF","📄 MODULO II ING INF"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING INF

elseif(strpos($text, "/mod1inginf") === 0 || $text == "📄 MODULO I ING INF" || $text == "📄 modulo i ing inf")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/inginf/noLINFTL1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2inginf") === 0 || $text == "📄 MODULO II ING INF" || $text == "📄 modulo ii ing inf")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/inginf/noLINFTL2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA GESTIONALE

elseif(strpos($text, "/inggest") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING GESTIONALE" || $text == "\xF0\x9F\x95\x92 orario ing gestionale")
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING GEST","📄 MODULO II ING GEST"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING GEST

elseif(strpos($text, "/mod1inggest") === 0 || $text == "📄 MODULO I ING GEST" || $text == "📄 modulo i ing gest")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/inggest/noLGST1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2inggest") === 0 || $text == "📄 MODULO II ING GEST" || $text == "📄 modulo ii ing gest")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/inggest/noLGST2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA MECCANICA

elseif(strpos($text, "/ingmec") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING MECCANICA" || $text == "\xF0\x9F\x95\x92 orario ing meccanica")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING MEC","📄 MODULO II ING MEC"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING MEC

elseif(strpos($text, "/mod1ingmec") === 0 || $text == "📄 MODULO I ING MEC" || $text == "📄 modulo i ing mec")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingmec/noLMEC1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingmec") === 0 || $text == "📄 MODULO II ING MEC" || $text == "📄 modulo ii ing mec")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingmec/noLMEC2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA ELETTRONICA

elseif(strpos($text, "/ingmec") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING ELETTRONICA" || $text == "\xF0\x9F\x95\x92 orario ing elettronica")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING ELE","📄 MODULO II ING ELE"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING ELE

elseif(strpos($text, "/mod1ingele") === 0 || $text == "📄 MODULO I ING ELE" || $text == "📄 modulo i ing ele")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingele/noLELN1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingele") === 0 || $text == "📄 MODULO II ING ELE" || $text == "📄 modulo ii ing ele")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingele/noLELN2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA DELL'ENERGIA

elseif(strpos($text, "/ingmec") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING ENERGIA" || $text == "\xF0\x9F\x95\x92 orario ing energia")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING ENE","📄 MODULO II ING ENE"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING ENE

elseif(strpos($text, "/mod1ingene") === 0 || $text == "📄 MODULO I ING ENE" || $text == "📄 modulo i ing ene")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingene/noLENRG1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingene") === 0 || $text == "📄 MODULO II ING ENE" || $text == "📄 modulo ii ing ene")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingene/noLENRG2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA CHIMICA
elseif(strpos($text, "/ingchi") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING CHIMICA" || $text == "\xF0\x9F\x95\x92 orario ing chimica")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING CHI","📄 MODULO II ING CHI"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING CHI

elseif(strpos($text, "/mod1ingchi") === 0 || $text == "📄 MODULO I ING CHI" || $text == "📄 modulo i ing chi")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingchi/noLCHM1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingchi") === 0 || $text == "📄 MODULO II ING CHI" || $text == "📄 modulo ii ing chi")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingchi/noLCHM2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA AMBIENTALE

elseif(strpos($text, "/ingamb") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING AMBIENTALE" || $text == "\xF0\x9F\x95\x92 orario ing ambientale")
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING AMB","📄 MODULO II ING AMB"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING AMB

elseif(strpos($text, "/mod1ingamb") === 0 || $text == "📄 MODULO I ING AMB" || $text == "📄 modulo i ing amb")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingamb/nnoLA1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingamb") === 0 || $text == "📄 MODULO II ING AMB" || $text == "📄 modulo ii ing amb")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingamb/nnoLA2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA CIV-EDI

elseif(strpos($text, "/ingmec") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING CIV-EDI" || $text == "\xF0\x9F\x95\x92 orario ing civ-edi")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING CIV","📄 MODULO II ING CIV"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING CIV

elseif(strpos($text, "/mod1ingciv") === 0 || $text == "📄 MODULO I ING CIV" || $text == "📄 modulo i ing civ")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingciv/noLCED1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingciv") === 0 || $text == "📄 MODULO II ING CIV" || $text == "📄 modulo ii ing civ")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingciv/noLCED2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA CIBERNETICA

elseif(strpos($text, "/ingcib") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING CIBERN" || $text == "\xF0\x9F\x95\x92 orario ing cibern")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING CIB","📄 MODULO II ING CIB"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING CIB

elseif(strpos($text, "/mod1ingcib") === 0 || $text == "📄 MODULO I ING CIB" || $text == "📄 modulo i ing cib")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingcib/noLCIB1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingcib") === 0 || $text == "📄 MODULO II ING CIB" || $text == "📄 modulo ii ing cib")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingcib/noLCIB2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA GESTIONALE E INFORMATICA

elseif(strpos($text, "/inggestinf") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING GEST INF" || $text == "\xF0\x9F\x95\x92 orario ing gest inf")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING GEST INF","📄 MODULO II ING GEST INF"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING GEST INF

elseif(strpos($text, "/mod1inggestinf") === 0 || $text == "📄 MODULO I ING GEST INF" || $text == "📄 modulo i ing gest inf")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/inggestinf/noLGSTINF1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2inggestinf") === 0 || $text == "📄 MODULO II ING GEST INF" || $text == "📄 modulo ii ing gest inf")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/inggestinf/noLGSTINF2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA BIOMEDICA

elseif(strpos($text, "/ingbio") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING BIOMEDICA" || $text == "\xF0\x9F\x95\x92 orario ing biomedica")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I ING BIO","📄 MODULO II ING BIO"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING"))
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
}

//SOTTOSEZIONE MODULI ING BIO

elseif(strpos($text, "/mod1ingbio") === 0 || $text == "📄 MODULO I ING BIO" || $text == "📄 modulo i ing bio")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingbio/noLBIO1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingbio") === 0 || $text == "📄 MODULO II ING BIO" || $text == "📄 modulo ii ing bio")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/ingbio/noLBIO2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// CORSI ARCHITETTURA 

// MENU ORARIO LEZIONI ARCHITETTURA-DIS.INDUSTRIALE
elseif(strpos($text, "/orariolezarch") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO CORSI ARCH" || $text == "\xF0\x9F\x95\x92 orario corsi arch")
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI"),array("\xF0\x9F\x95\x92 ORARIO ARCHITETTURA","\xF0\x9F\x95\x92 ORARIO DIS. INDUSTRIALE"))
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
	
	//$response = "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\n/inginf Orari Ing.Informatica \n\n/inggest Orari Ing.Gestionale \n\n";
}

// ORARIO LEZIONI ARCHITETTURA
elseif(strpos($text, "/inginf") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ARCHITETTURA" || $text == "\xF0\x9F\x95\x92 orario architettura")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I-II ARCHITETTURA"),array("\xF0\x9F\x95\x92 ORARIO CORSI ARCH"))
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
}

//SOTTOSEZIONE MODULI ARCHITETTURA

elseif(strpos($text, "/mod12arch") === 0 || $text == "📄 MODULO I-II ARCHITETTURA" || $text == "📄 modulo i-ii architettura")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/arch/orariolezioniarch.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI DISEGNO INDUSTRIALE
elseif(strpos($text, "/disind") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO DIS. INDUSTRIALE" || $text == "\xF0\x9F\x95\x92 orario dis. industriale")
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
		
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 MODULO I-II DIS IND"),array("\xF0\x9F\x95\x92 ORARIO CORSI ARCH"))
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
}

//SOTTOSEZIONE MODULI DIS IND

elseif(strpos($text, "/mod12disind") === 0 || $text == "📄 MODULO I-II DIS IND" || $text == "📄 modulo i-ii dis ind")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./orariolezioni/disind/orariolezdis.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// MENU ORARI BIBLIOTECHE
elseif(strpos($text, "/oraribiblioteca") === 0 || $text == "\xF0\x9F\x93\x9A BIBLIO" || $text == "\xF0\x9F\x93\x9A biblio" )
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8F\xA6 Menu Biblioteche \xF0\x9F\x8F\xA6\n\n".$firstname.", che Biblioteca vuoi visitare?\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8F\xA6 BIBLIOTECA CENTR. INGEGNERIA"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA LETTERE","\xF0\x9F\x8F\xA6 SALA LETTURA WURTH"))
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
	
	//$response = "\xF0\x9F\x8F\xA6 Menu Biblioteche \xF0\x9F\x8F\xA6\n\n/biblioing \xF0\x9F\x8F\xA6 Biblioteca Centr. Ingegneria \n\n/bibliolettere \xF0\x9F\x8F\xA6 Biblioteca Lettere \n\n";
}

// MENU ORARI BIBLIOTECA INGEGNERIA
elseif(strpos($text, "/biblioing") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA CENTR. INGEGNERIA" || $text == "\xF0\x9F\x8F\xA6 biblioteca centr. ingegneria" )
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
	
	$response = "\xF0\x9F\x8F\xA6 Edificio \n\nSi trova presso l'Edificio 8\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLun-Ven dalle 8.30 alle 22\n\nDa Settembre a Luglio\n\n\xF0\x9F\x91\xA4 Info Utili\n\nPotete richiedere il rinnovo dei libri in scadenza mandando una e-mail a bibling@unipa.it oppure chiamando il numero 091/23862001\n\nPer prenotare un posto in sala rossa rivolgersi al Front-Office della Biblioteca";
}

// MENU ORARI BIBLIOTECA LETTERE
elseif(strpos($text, "/bibliolettere") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA LETTERE" || $text == "\xF0\x9F\x8F\xA6 biblioteca lettere" )
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
	
	$response = "\xF0\x9F\x8F\xA6 Edificio \n\nSi trova presso l'Edificio 12 (Lettere e Filosofia)\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLun-Gio dalle 8.30 alle 17\nVen dalle 8:30 alle 13:30\n\n\xF0\x9F\x91\xA4 Info Utili\n\nChiusura dall' 8 al 21 agosto 2016 e dal 23 dicembre 2016 al 1° gennaio 2017";
}

// MENU ORARI SALA LETTURA WURTH
elseif(strpos($text, "/salletwurth") === 0 || $text == "\xF0\x9F\x8F\xA6 SALA LETTURA WURTH" || $text == "\xF0\x9F\x8F\xA6 sala lettura wurth" )
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
	
	$response = "\xF0\x9F\x8F\xA6 Edificio \n\nSi trova dietro l'Edificio 12 (Lettere e Filosofia)\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLun-Ven dalle 9.00 alle 22\n\n\xF0\x9F\x91\xA4 Info Utili\n\nChiusura dall' 8 al 21 agosto 2016; dal 23 dicembre 2016 al 1° gennaio 2017\n\n\xF0\x9F\x93\x9E Contatti:\n\nTel +39.09123899239 / 95418 (front-office)\n\nTel2. +39.09123899241 / 99243 (servizio dd)\n\nbiblioteca.scienzeumanistiche@unipa.it";
}

// MAPPA

elseif(strpos($text, "/mappa") === 0 || $text == "\xF0\x9F\x8C\x8E MAPPA" || $text == "\xF0\x9F\x8C\x8E mappa")
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
						'photo' => new CURLFile(realpath("./img/mappaunipa.jpg")), 
						'caption' => $firstname.", ecco la Mappa Unipa!"/*$text*/);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);

 //$response = "Mappa Unipa";
	
}

// DOC AULE ING
elseif(strpos($text, "/doc") === 0 || $text == "\xF0\x9F\x8C\x8E doc" || $text == "\xF0\x9F\x8C\x8E doc")
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./img/auleingegneria.pdf")), 
						'caption' => "Doc Aule Ingegneria Unipa"/*$text*/);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

//CERCA AULA 
elseif(strpos($text, "/cercaaula") === 0 || $text == "🔍 CERCA AULA" || $text == "🔍 cerca aula")
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "🏪 Menu Aule 🏪\n\n".$firstname.", come si chiama l'aula che cerchi?\n\n\xE2\x9A\xA0 ES. F170", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🏪 AULE IN ELENCO"))
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
	
	$response = "Le aule in elenco sono:\n\nF130\n\nF140\n\nF150\n\nF160\n\nF170\n\nPer segnalare altre aule scrivi a @gabrieledellaria";
}

//SOTTOSEZIONE Aule

//AULE

	elseif(strpos($text, "F130") === 0 || $text == "f130" || $text == "F130")
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
						'caption' => "L'aula ".$text." si trova al 1° Piano dell'Ed.8"/*$text*/);
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	}
	
	elseif(strpos($text, "F150") === 0 || $text == "f150" || $text == "F150")
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
	}
	
	elseif(strpos($text, "F160") === 0 || $text == "f160" || $text == "F160")
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
	}
	
	elseif(strpos($text, "F170") === 0 || $text == "f170" || $text == "F170")
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
	}


//INFO PROF

elseif(strpos($text, "/professori") === 0 || $text == "\xF0\x9F\x91\xA4 INFO PROF" || $text == "\xF0\x9F\x91\xA4 info prof")
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x91\xA4 Menu Professori \xF0\x9F\x91\xA5\n\n".$firstname.", qual'è il Cognome del Prof che cerchi?\n\n\xE2\x9A\xA0 ES. Prof NomeProf", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x91\xA4 PROF IN ELENCO"),array("\xE2\x9A\xA0 Segnala Prof"))
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

//PROF IN ELENCO

	elseif(strpos($text, "/profinelenco") === 0 || $text == "\xF0\x9F\x91\xA4 PROF IN ELENCO" || $text == "\xF0\x9F\x91\xA4 prof in elenco" )
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
		
		$response = "Al momento in elenco:\n\n/profburlon \xF0\x9F\x91\xA4 Prof Burlon \n\n/proflacascia \xF0\x9F\x91\xA4 Prof La Cascia \n\nSe il prof che cerchi non è in elenco contatta @gabrieledellaria";
	}
	
//SEGNALA IL TUO PROF

	elseif(strpos($text, "/segnalaprof") === 0 || $text == "\xE2\x9A\xA0 SEGNALA PROF" || $text == "\xE2\x9A\xA0 Segnala Prof" || $text == "\xE2\x9A\xA0 segnala prof")
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
		
		$response = "Se il prof che cerchi non è in elenco contatta @gabrieledellaria riportando Nome,Cognome e Facoltà del Prof da inserire";
	}	

// Sottosezione Professori //

elseif(strpos($text, "/profburlon") === 0 || $text == "Burlon" || $text == "burlon" || $text == "Prof Burlon" || $text == "prof burlon")
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
		
		$response = "\xF0\x9F\x91\xA4 Nome: Riccardo \n\xF0\x9F\x91\xA4 Cognome: Burlon \n\xF0\x9F\x8F\xA6 Ufficio: Ed.6 ";
	}
	
elseif(strpos($text, "/proflacascia") === 0 || $text == "La Cascia" || $text == "la cascia" || $text == "Prof La Cascia" || $text == "prof la cascia")
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
		
		$response = "\xF0\x9F\x91\xA4 Nome: Marco \n\xF0\x9F\x91\xA4 Cognome: La Cascia \n\xF0\x9F\x8F\xA6 Ufficio: Ed.8 ";
	}
	
	
	
	
// ERSU 	
elseif(strpos($text, "/ersu") === 0 || $text == "\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6" || $text == "\xF0\x9F\x8F\xA8 ersu \xF0\x9F\x92\xB6")
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
		
		$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8F\xA8 UFFICIO ERSU \xF0\x9F\x92\xB6 \n\nSi trova in Viale delle Scienze, ed. 1 – 90128 Palermo (alla destra dell'ingresso del COT)\n\n\xF0\x9F\x95\x92 Ricevimento pubblico:\n\ndal Lunedì al Venerdì dalle ore 9:00 alle ore 13:00
					Mercoledì dalle ore 15:30 alle ore 17:30\n\n\xE2\x9A\xA0 INFO\n\nPer informazioni sugli uffici, sullo stato degli atti e dei procedimenti amministrativi, nonché su ogni attività che riguardi l’Ente, inviare email a info@ersupalermo.gov.it.
					Per informazioni riguardanti le borse e i servizi erogati dall’Ente (borse di studio, servizio abitativo, servizio ristorazione, ecc…), inviare email a borse@ersupalermo.gov.it oppure compilare il modulo online disponibile nella pagina personale dei “Servizi ERSU” del portale studenti dell’UNIPA.", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🌍 MAPPA ERSU"))
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
		

}

//MAPPA SERVIZI ERSU

elseif(strpos($text, "/mappaersu") === 0 || $text == "🌍 MAPPA ERSU" || $text == "🌍 mappa ersu" )
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
		
		$response = "MAPPA SERVIZI ERSU http://www.ersupalermo.it/mappa-residenze-ersu-palermo/";
	}	

// SEGRETERIA 	
elseif(strpos($text, "/segreteria") === 0 || $text == "\xF0\x9F\x8F\xAC SEGRET" || $text == "\xF0\x9F\x8F\xAC segret")
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
		
		$response = "\xF0\x9F\x8F\xAC SEGRETERIA STUDENTI \xF0\x9F\x92\xAC\n\nSi trova in Viale delle Scienze, Ed. 3\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLunedì, Mercoledì, Venerdì dalle ore 09.00 alle ore 13.00\nMartedì e Giovedì dalle ore 15.00 alle ore 17.00 (escluso Luglio e Agosto)\n\n\xF0\x9F\x93\x9E CONTATTI \n\nEmail: segreterie.studenti@unipa.it\nTel. +3909123867526\nTel.2 +3909123886472\nFax. +3909123860506";

}

// DIPARTIMENTI 	
elseif(strpos($text, "/dipartimenti") === 0 || $text == "\xF0\x9F\x8F\xA2 DIPART" || $text == "\xF0\x9F\x8F\xA2 dipart")
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
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
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8F\xA6 MENU DIPARTIMENTI \xF0\x9F\x91\xA5\n\n".$firstname.", quale Dipartimento cerchi?", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8F\xA6 DICGIM"),array("\xF0\x9F\x8F\xA6 DIP. IDRAULICA","\xF0\x9F\x8F\xA6 DIP. CHIMICA"))
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
		
	//$response = "\xF0\x9F\x8F\xA6 MENU DIPARTIMENTI \xF0\x9F\x91\xA5 \n\n\xF0\x9F\x8F\xA6 /dipdicgim DICGIM\n\n\xF0\x9F\x8F\xA6 /dipidraulica DIP.IDRAULICA\n\n";

}

// DIPARTIMENTI UNIPA

// DICGIM	
elseif(strpos($text, "/dicgim") === 0 || $text == "\xF0\x9F\x8F\xA6 DICGIM" || $text == "\xF0\x9F\x8F\xA6 dicgim")
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
		
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le info del Dipartimento \xF0\x9F\x8F\xA6 DICGIM ";

}

// DIP. IDRAULICA	
elseif(strpos($text, "/dipidraulica") === 0 || $text == "\xF0\x9F\x8F\xA6 DIP. IDRAULICA" || $text == "\xF0\x9F\x8F\xA6 dip. idraulica")
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
		
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le info del Dipartimento \xF0\x9F\x8F\xA6 DIP. IDRAULICA ";

}

// DIP. CHIMICA	
elseif(strpos($text, "/dipidraulica") === 0 || $text == "\xF0\x9F\x8F\xA6 DIP. CHIMICA	" || $text == "\xF0\x9F\x8F\xA6 dip. chimica")
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
		
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le info del Dipartimento \xF0\x9F\x8F\xA6 DIP. CHIMICA	 ";

}



// CLA	
elseif(strpos($text, "/cla") === 0 || $text == "\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7" || $text == "\xF0\x9F\x93\x96 cla \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7")
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
		
		$response = "\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7 \n\nSi trova in Piazza S. Antonino, 1 90134 PALERMO (PA)\n\n\xF0\x9F\x93\x9E CONTATTI \n\n+39 0916169615 - +39 09123899263 cla@unipa.it";

}


//MACCHINETTE CAFFE
elseif(strpos($text, "/macchcaffe") === 0 || $text == "\xE2\x98\x95 CAFFE" || $text == "\xE2\x98\x95 caffe")
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
		
		$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8F\xA6 MENU MACCHINETTE CAFFE' \xF0\x9F\x91\xA5\n\n".$firstname.", seleziona fra le opzioni sotto", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xE2\x98\x95 MACCH. ED.8"),array("\xE2\x98\x95 MACCH. ED.9","\xE2\x98\x95 MACCH. ED.6"))
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
		
	}
//SOTTOSEZIONE MACCH.

//MACCH.ED.8
elseif(strpos($text, "/macchcaffeed8") === 0 || $text == "\xE2\x98\x95 MACCH. ED.8" || $text == "\xE2\x98\x95 macch. ed.8")
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
		
		$response = "\xE2\x98\x95 MACCH. ED.8\n\nLe macchinette si trovano al primo piano quasi alla fine del corridoio all'altezza della F170 e alla fine del corridoio sulla sinistra\n\nAl secondo piano dentro l'Auletta di Vivere Ingegneria";
	}	

//MENSA
elseif(strpos($text, "/mensa") === 0 || $text == "\xF0\x9F\x8D\x9D MENSA" || $text == "\xF0\x9F\x8D\x9D mensa")
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
		
		$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8D\x9D MENU MENSA\n\n".$firstname.", dove vuoi andare a mangiare?\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","ℹ️ INFO RISTORAZIONE"),array("\xF0\x9F\x8D\x9D MENSA SANTI ROMANO","\xF0\x9F\x8D\x9D MENSA CIVICO"),array("\xF0\x9F\x8D\x9D MENSA S.SAVERIO"))
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
		
	}
	
// INFO RISTORAZIONE

elseif(strpos($text, "/inforistorazione") === 0 || $text == "ℹ️ INFO RISTORAZIONE" || $text == "ℹ️ info ristorazione")
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
						'photo' => new CURLFile(realpath("./img/inforistorazione.PNG")), 
						'caption' => $firstname.", ecco le info sui servizi di ristorazione"/*$text*/);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);

 //$response = "Mappa Unipa";
	
}	
	
//SOTTOSEZIONE MENSE

//MENSA S.ROMANO

elseif(strpos($text, "/mensasromano") === 0 || $text == "\xF0\x9F\x8D\x9D MENSA SANTI ROMANO" || $text == "\xF0\x9F\x8D\x9D mensa santi romano" )
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
		
		$response = "\xF0\x9F\x8D\x9D MENSA SANTI ROMANO \xF0\x9F\x8D\x95\n\n\xF0\x9F\x95\x92 ORARIO ESERCIZIO\n\nIl pranzo viene servito dalle 12.00 alle 15.00, mentre la cena viene servita dalle 19.00 alle 21.30.\n\nIn più, la sala ristorazione della Residenza Universitaria S. Romano offre un servizio di pizzeria aperto ogni giorno dalle ore 19:30 alle ore 22:30.\n\nNote:La mensa Santi Romano è aperta tutto l'anno , escludendo brevi periodi  estivi e per le festività di Natale, Pasqua, 1° maggio";
	}	
	
//COPISTERIE

elseif(strpos($text, "/copisterie") === 0 || $text == "\xF0\x9F\x93\x84 COPIST" || $text == "\xF0\x9F\x93\x84 copist")
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
		
		$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x93\x84 COPISTERIE\n\n".$firstname.", ecco le copisterie che fanno per te\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x93\x84 LA NUOVA COPISTERIA ING."),array("\xF0\x9F\x93\x84 COPISTERIA LETTERE","\xF0\x9F\x93\x84 COPISTERIA ED.9"),array("\xF0\x9F\x93\x84 LA NUOVA COPISTERIA BIO"))
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
		
		//$response = "\xE2\x9A\xA0 Prossimamente disponibili le copisterie di Unipa ";
	}
	
//LA NUOVA COPISTERIA ING.
elseif(strpos($text, "/coping") === 0 || $text == "\xF0\x9F\x93\x84 LA NUOVA COPISTERIA ING." || $text == "\xF0\x9F\x93\x84 la nuova copisteria ing.")
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
		
		$response = "\xE2\x9A\xA0 Prossimamente disponibile!";
	}
	
//LA NUOVA COPISTERIA BIO
elseif(strpos($text, "/copbio") === 0 || $text == "\xF0\x9F\x93\x84 LA NUOVA COPISTERIA BIO" || $text == "\xF0\x9F\x93\x84 la nuova copisteria bio")
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
		
		$response = "\xE2\x9A\xA0 Prossimamente disponibile!";
	}	
	
//COPISTERIA LETTERE
elseif(strpos($text, "/coplet") === 0 || $text == "\xF0\x9F\x93\x84 COPISTERIA LETTERE" || $text == "\xF0\x9F\x93\x84 copisteria lettere")
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
		
		$response = "\xE2\x9A\xA0 Prossimamente disponibile!";
	}		
	
//COPISTERIA ED.9
elseif(strpos($text, "/coped9") === 0 || $text == "\xF0\x9F\x93\x84 COPISTERIA ED.9" || $text == "\xF0\x9F\x93\x84 copisteria ed.9")
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
		
		$response = "\xE2\x9A\xA0 Prossimamente disponibile!";
	}	

elseif(strpos($text, "/echochatid") === 0 )
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
		
		$response = "Il tuo chat_id è ".$chatId;	
	}

elseif(strpos($text, "/prova") === 0 )
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
	}		

else
{
	$response = "\xE2\x9A\xA0 Comando che hai eseguito non è valido!\n\nDigita /help per il mio elenco comandi";
}
	

$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);

$parameters = array('chat_id' => $chatId, "text" => $response2);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);