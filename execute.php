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

if(strpos($text, "/start") === 0 || $text=="\xF0\x9F\x94\xB4 START" || $text == "\xF0\x9F\x94\xB4 start")
{
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId
		, 'text' => "\xF0\x9F\x91\x8B Ciao $firstname (@$username), benvenuto in Unipa Bot!\n\nℹ️ Comandi rapidi:\n\nAule - Trova Aula\nProf - Trova le info sul tuo prof\nBiblioteche - Trova le Biblioteche\nOrario Lezioni - Trova l'orario lezioni"
		, 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","📖 BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","🚈 TRASP","\xE2\x84\xB9 INFO BOT"),array("\xE2\x9A\xA0 COMANDI RAPIDI")),
			 'resize_keyboard' => true
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
	
	//"Oggi è il ".$today_date." e sono le ".$today_hour.;
}

// TORNA SUBITO AL MENU PRINCIPALE
if(strpos($text, "/menuprincipale") === 0 || $text=="🏠 MENU PRINCIPALE" || $text == "🏠 menu principale")
{
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "▶️ MENU PRINCIPALE ◀️\n\n ".$firstname." cosa vuoi fare?",
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","📖 BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","🚈 TRASP","\xE2\x84\xB9 INFO BOT"),array("\xE2\x9A\xA0 COMANDI RAPIDI"))
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

// COMANDI RAPIDI 

else if(strpos($text, "/cmdrapidi") === 0 || $text == "\xE2\x9A\xA0 COMANDI RAPIDI" || $text == "\xE2\x9A\xA0 comandi rapidi")
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
	
	$response = "ℹ️ Comandi rapidi:\n\nAule - Trova Aula\n\nProf - Trova le info sul tuo prof\n\nBiblioteche - Trova le Biblioteche\n\nOrario Lezioni - Trova il tuo orario lezioni";
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

// TRASPORTI

elseif(strpos($text, "/trasporti") === 0 || $text == "🚈 TRASPORTI" || $text == "🚈 trasporti")
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
		 'text' => "🚈 TRASPORTI\n\n".$firstname.", scegli il tuo mezzo di trasporto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"),array("🚈 METRO","🚈 TRENO","🚎 PULLMAN"))
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

// AUTOBUS 
elseif(strpos($text, "/bus") === 0 || $text == "🚌 AUTOBUS" || $text == "🚌 autobus")
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
	
	$response = "🚌 AUTOBUS da e verso Unipa \n\nDA UNIPA A PALERMO CITTA': \n\nDA PALERMO CITTA' AD UNIPA: ";
}

// METRO
elseif(strpos($text, "/metro") === 0 || $text == "🚈 METRO" || $text == "🚈 metro")
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
	
	$response = "🚈 METRO da e verso Unipa \n\nDA UNIPA A PALERMO CITTA': \n\nDA PALERMO CITTA' AD UNIPA: ";
}

// TRENO
elseif(strpos($text, "/treno") === 0 || $text == "🚈 TRENO" || $text == "🚈 treno")
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
	
	$response = "🚈 TRENO da e verso Unipa \n\nDA UNIPA A PALERMO CITTA': \n\nDA PALERMO CITTA' AD UNIPA: ";
}

// PULLMAN
elseif(strpos($text, "/pullman") === 0 || $text == "🚎 PULLMAN" || $text == "🚎 pullman")
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
	
	$response = "🚎 PULLMAN da e verso Unipa \n\nDA UNIPA A PALERMO CITTA: \n\nDA PALERMO CITTA' AD UNIPA: ";
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
		
		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8D\x94 Punti Ristoro\n\n".$firstname.", scegli dove andare a mangiare\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8D\x94 PANINERIA JHONNY"),array("🍝 PANIFICIO DELLO STUDENTE","🍴 CASA MASSARO"),array("\xF0\x9F\x8D\x94 BAR INGEGNERIA","\xF0\x9F\x8D\x94 BAR ARCHITETTURA"),array("\xF0\x9F\x8D\x94 BAR LETTERE"))
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

//Panineria da Jhonny

elseif(strpos($text, "/jhonny") === 0 || $text == "\xF0\x9F\x8D\x94 PANINERIA JHONNY" || $text == "\xF0\x9F\x8D\x94 panineria jhonny")
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
		 	'text' => "\xF0\x9F\x8D\x94 PANINERIA DA JHONNY \n\n🕒 Orari Esercizio\n\nLun-Ven dalle 11.30 alle 23.30\n\nDa Settembre a Luglio\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8D\x94 RISTORO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1062386", 
						'longitude' => "13.3525133");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

//Panificio dello Studente

elseif(strpos($text, "/panstud") === 0 || $text == "🍝 PANIFICIO DELLO STUDENTE" || $text == "🍝 panificio dello studente")
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
		 	'text' => "🍝 PANIFICIO DELLO STUDENTE \xF0\x9F\x8D\x94\n\nSi effettua anche domicilio\n\n☎️ Contatti: 0916572790\n\nPagina fb: https://www.facebook.com/Panificio-salumeria-dello-studente-123206791362330/", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8D\x94 RISTORO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1037223", 
						'longitude' => "13.3501872");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

//Casa Massaro

elseif(strpos($text, "/casamassaro") === 0 || $text == "🍴 CASA MASSARO" || $text == "🍴 casa massaro")
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
		 	'text' => "\xF0\x9F\x8D\x94 CASA MASSARO \n\n🕒 Orari Esercizio\n\nLun-Ven dalle 11.30 alle 23.30\n\nDa Settembre a Luglio\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8D\x94 RISTORO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1069112", 
						'longitude' => "13.3541213");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
}

// BAR INGEGNERIA

elseif(strpos($text, "/baring") === 0 || $text == "\xF0\x9F\x8D\x94 BAR INGEGNERIA" || $text == "\xF0\x9F\x8D\x94 bar ingegneria")
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
		 	'text' => "\xF0\x9F\x8D\x94 BAR INGEGNERIA\n\nSi trova sotto il portico dell'Ed.8\n\n🕒 Orari Esercizio\n\nLun-Ven dalle 08:00 alle 18:30\n\nDa Settembre a Luglio\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8D\x94 RISTORO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1049168", 
						'longitude' => "13.3483365");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}


// BAR ARCHITETTURA

elseif(strpos($text, "/bararch") === 0 || $text == "\xF0\x9F\x8D\x94 BAR ARCHITETTURA" || $text == "\xF0\x9F\x8D\x94 bar architettura")
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
		 	'text' => "\xF0\x9F\x8D\x94 BAR ARCHITETTURA\n\n🕒 Orari Esercizio\n\nLun-Ven dalle 08:00 alle 17:30\n\nDa Settembre a Luglio\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8D\x94 RISTORO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1025477", 
						'longitude' => "13.3473151");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// BAR LETTERE

elseif(strpos($text, "/barlet") === 0 || $text == "\xF0\x9F\x8D\x94 BAR LETTERE" || $text == "\xF0\x9F\x8D\x94 bar lettere")
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
		 	'text' => "\xF0\x9F\x8D\x94 BAR LETTERE\n\nSi trova di fronte l'Edificio 12\n\n🕒 Orari Esercizio\n\nLun-Ven dalle 08:00 alle 12:30\n\nDa Settembre a Luglio\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8D\x94 RISTORO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1025863", 
						'longitude' => "13.3441629");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

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
	
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8F\xA6 Menu Studenti \xF0\x9F\x8F\xA6\n\n".$firstname.", scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI"),array("\xF0\x9F\x93\x9A MATERIE A SCELTA","\xF0\x9F\x93\x91 TIROCINIO"),array("📄 CALENDARIO DIDATTICO","🏪 AULETTE ASSOCIAZIONI"))
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
		
		$response = "📖 Le materie a scelta che ti consiglio sono:\n\n📓 Gestione della Produzione Industriale (ING)\n\n ";
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
		
		$response = "ℹ️ Per le info sul Tirocinio visita http://www.stage.unipa.it/\n\nPer conoscere le offerte delle aziende visita http://aziende.unipa.it/searches";
	}

// AULETTE ASSOCIAZIONI

elseif(strpos($text, "/assoc") === 0 || $text == "🏪 AULETTE ASSOCIAZIONI" || $text == "🏪 aulette associazioni")
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
		 'text' => $firstname.", quale auletta cerchi?\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🏪 VIVERE INGEGNERIA"),array("🏪 AISA","🏪 ONDA UNIVERSITARIA"),array("🏪 RUM","🏪 UDU"))
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

// 🏪 VIVERE INGEGNERIA

elseif(strpos($text, "/aulviving") === 0 || $text == "🏪 VIVERE INGEGNERIA" || $text == "🏪 vivere ingegneria")
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
		 	'text' => "Si trova al 2° Piano dell'Edificio 8 (Posizione precisa sotto)\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🏪 AULETTE ASSOCIAZIONI"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1052339", 
						'longitude' => "13.3466103");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// 🏪 AISA

elseif(strpos($text, "/aulaisa") === 0 || $text == "🏪 AISA" || $text == "🏪 aisa")
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
		 	'text' => "Si trova presso l'Edificio 14, al Piano Terra sotto le scale principali (Posizione precisa sotto)\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🏪 AULETTE ASSOCIAZIONI"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1023513", 
						'longitude' => "13.3459358");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// 🏪 ONDA UNIVERSITARIA

elseif(strpos($text, "/aulonda") === 0 || $text == "🏪 ONDA UNIVERSITARIA" || $text == "🏪 onda universitaria")
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
		 	'text' => "Si trova accanto a LA NUOVA COPISTERIA ING. scendendo la discesa sotto la BIBLIOTECA DI INGEGNERIA (Per maggiori info vedi la sottosezione BIBLIO nel MENU PRINCIPALE) presso l'Edificio 7 (Posizione precisa sotto)\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🏪 AULETTE ASSOCIAZIONI"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.104807", 
						'longitude' => "13.349118"); 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// 🏪 RUM

elseif(strpos($text, "/aulrum") === 0 || $text == "🏪 RUM" || $text == "🏪 rum")
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
		 	'text' => "Si trova accanto a LA NUOVA COPISTERIA ING. scendendo la discesa sotto la BIBLIOTECA DI INGEGNERIA (Per maggiori info vedi la sottosezione BIBLIO nel MENU PRINCIPALE) presso l'Edificio 7 (Posizione precisa sotto)\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🏪 AULETTE ASSOCIAZIONI"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.104807", 
						'longitude' => "13.349118"); 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// 🏪 UDU

elseif(strpos($text, "/auludu") === 0 || $text == "🏪 UDU" || $text == "🏪 udu")
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
		 	'text' => "Si trova accanto alla BIBLIOTECA DI INGEGNERIA (Per maggiori info vedi la sottosezione BIBLIO nel MENU PRINCIPALE) presso l'Edificio 7 (Posizione precisa sotto)\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🏪 AULETTE ASSOCIAZIONI"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1048534", 
						'longitude' => "13.3491337"); 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// CALENDARIO DIDATTICO

elseif(strpos($text, "/caldid") === 0 || $text == "📄 CALENDARIO DIDATTICO" || $text == "📄 calendario didattico")
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
		 'text' => "❔ Quale Calendario Didattico vuoi?\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x91\xA5 MENU STUDENTI"),array("📄 CAL DID POLITECNICA"))
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

// CALENDARIO DIDATTICO POLITECNICA

elseif(strpos($text, "/caldidpoli") === 0 || $text == "📄 CAL DID POLITECNICA" || $text == "📄 cal did politecnica")
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
		 'text' => "Ecco il Calendario Didattico della tua Scuola!", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📄 CALENDARIO DIDATTICO"))
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
	
	$message = isset($update['message']) ? $update['message'] : "";
	$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
	$text = isset($message['text']) ? $message['text'] : "";
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendDocument";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 
						'document' => new CURLFile(realpath("./doc/calendariodidatticopolitecnica.pdf")), 
						'caption' => "Calendario Didattico della Scuola Politecnica");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}		

// MENU ORARIO LEZIONI
elseif(strpos($text, "/orariolezioni") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO LEZIONI" || $text == "\xF0\x9F\x95\x92 orario lezioni" || $text == "ORARIO LEZIONI" || $text == "orario lezioni")
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
		 'text' => "\xF0\x9F\x95\x92 SEZIONE ORARIO LEZIONI \xF0\x9F\x95\x92\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x91\xA5 MENU STUDENTI"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING","\xF0\x9F\x95\x92 ORARIO CORSI ARCH"),array("\xF0\x9F\x95\x92 ORARIO CORSI ECO","\xF0\x9F\x95\x92 ORARIO CORSI SC FORM"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC DI BASE"))
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
	
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
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
		
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
	
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
		
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
		
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
		
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
		
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
	
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
		
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
		
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
		
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
		
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
	
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI"),array("\xF0\x9F\x95\x92 ORARIO ARCHITETTURA","\xF0\x9F\x95\x92 ORARIO DIS. INDUSTRIALE","\xF0\x9F\x95\x92 ORARIO SPTUPA"))
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
elseif(strpos($text, "/arch") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ARCHITETTURA" || $text == "\xF0\x9F\x95\x92 orario architettura")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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
		
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
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

// ORARIO LEZIONI SPTUPA
elseif(strpos($text, "/sptupa") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO SPTUPA" || $text == "\xF0\x9F\x95\x92 orario sptupa")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I-II SEMESTRE SPTUPA"),array("\xF0\x9F\x95\x92 ORARIO CORSI ARCH"))
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

//SOTTOSEZIONE MODULI SPTU

elseif(strpos($text, "/mod12sptupa") === 0 || $text == "📄 I-II SEMESTRE SPTUPA" || $text == "📄 i-ii semestre sptupa")
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
						'photo' => new CURLFile(realpath("./orariolezioni/sptupa/orariosptupa2.jpg")), 
						'caption' => "Orario Lezioni 1° e 2° Semestre SPTUPA");
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
						'photo' => new CURLFile(realpath("./orariolezioni/sptupa/orariosptupa1.jpg")), 
						'caption' => "Orario Lezioni 1° e 2° Semestre SPTUPA");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// CORSI ECONOMIA

// MENU ORARIO LEZIONI ECONOMIA
elseif(strpos($text, "/orariolezeco") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO CORSI ECO" || $text == "\xF0\x9F\x95\x92 orario corsi eco")
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
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI"),array("\xF0\x9F\x95\x92 ORARIO SC TURISMO","\xF0\x9F\x95\x92 ORARIO STATISTICA"),array("\xF0\x9F\x95\x92 ORARIO ECO AZIENDALE","\xF0\x9F\x95\x92 ORARIO ECO FINANZA","\xF0\x9F\x95\x92 ORARIO ECO SV ECONOMICO"))
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

// ORARIO LEZIONI SC TURISMO
elseif(strpos($text, "/scturismo") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO SC TURISMO" || $text == "\xF0\x9F\x95\x92 orario sc turismo")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I SEMESTRE SC TURISMO"),array("\xF0\x9F\x95\x92 ORARIO CORSI ECO"))
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

//SOTTOSEZIONE MODULI SC TURISMO

elseif(strpos($text, "/mod12scturismo") === 0 || $text == "📄 I SEMESTRE SC TURISMO" || $text == "📄 i semestre sc turismo")
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
						'document' => new CURLFile(realpath("./orariolezioni/sctur/lezioniscturismo.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI STATISTICA
elseif(strpos($text, "/statistica") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO STATISTICA" || $text == "\xF0\x9F\x95\x92 orario statistica")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I SEMESTRE STATISTICA"),array("\xF0\x9F\x95\x92 ORARIO CORSI ECO"))
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

//SOTTOSEZIONE MODULI STATISTICA

elseif(strpos($text, "/mod12statistica") === 0 || $text == "📄 I SEMESTRE STATISTICA" || $text == "📄 i semestre statistica")
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
						'document' => new CURLFile(realpath("./orariolezioni/stat/lezionistatistica.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI ECO AZIENDALE
elseif(strpos($text, "/ecoaziendale") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ECO AZIENDALE" || $text == "\xF0\x9F\x95\x92 orario eco aziendale")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I SEMESTRE ECO AZIENDALE"),array("\xF0\x9F\x95\x92 ORARIO CORSI ECO"))
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

//SOTTOSEZIONE MODULI ECO AZIENDALE

elseif(strpos($text, "/mod12ecoaziendale") === 0 || $text == "📄 I SEMESTRE ECO AZIENDALE" || $text == "📄 i semestre eco aziendale")
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
						'document' => new CURLFile(realpath("./orariolezioni/ecoaz/lezioniecoaziendale.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI ECO FINANZA
elseif(strpos($text, "/ecofinanza") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ECO FINANZA" || $text == "\xF0\x9F\x95\x92 orario eco finanza")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I SEMESTRE ECO FINANZA"),array("\xF0\x9F\x95\x92 ORARIO CORSI ECO"))
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

//SOTTOSEZIONE MODULI ECO FINANZA

elseif(strpos($text, "/mod12ecofinanza") === 0 || $text == "📄 I SEMESTRE ECO FINANZA" || $text == "📄 i semestre eco finanza")
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
						'document' => new CURLFile(realpath("./orariolezioni/ecofin/lezioniecofinanza.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI SV ECONOMICO
elseif(strpos($text, "/ecose") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ECO SV ECONOMICO" || $text == "\xF0\x9F\x95\x92 orario eco sv economico")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I SEMESTRE ECO SV ECONOMICO"),array("\xF0\x9F\x95\x92 ORARIO CORSI ECO"))
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

//SOTTOSEZIONE MODULI SV ECONOMICO

elseif(strpos($text, "/mod12sveco") === 0 || $text == "📄 I SEMESTRE ECO SV ECONOMICO" || $text == "📄 i semestre eco sv economico")
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
						'document' => new CURLFile(realpath("./orariolezioni/ecose/lezioniecose.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO SCIENZE DELLA FORMAZIONE

// MENU ORARIO LEZIONI SCIENZE DELLA FORMAZIONE
elseif(strpos($text, "/orariolezscfor") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO CORSI SC FORM" || $text == "\xF0\x9F\x95\x92 orario corsi sc form")
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
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI"),array("\xF0\x9F\x95\x92 ORARIO PSICOLOGIA","\xF0\x9F\x95\x92 ORARIO SC COM MEDIA"),array("\xF0\x9F\x95\x92 ORARIO SC COM CULT","\xF0\x9F\x95\x92 ORARIO SC EDU"))
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

// ORARIO LEZIONI PSICOLOGIA
elseif(strpos($text, "/inginf") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO PSICOLOGIA" || $text == "\xF0\x9F\x95\x92 orario psicologia")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I SEMESTRE PSICOLOGIA"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC FORM"))
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

//SOTTOSEZIONE MODULI PSICOLOGIA

elseif(strpos($text, "/mod1psicologia") === 0 || $text == "📄 I SEMESTRE PSICOLOGIA" || $text == "📄 i semestre psicologia")
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
						'document' => new CURLFile(realpath("./orariolezioni/psicologia/orariopsicologia.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI SC COM MEDIA
elseif(strpos($text, "/sccommed") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO SC COM MEDIA" || $text == "\xF0\x9F\x95\x92 orario sc com media")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I SEMESTRE SC COM MEDIA"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC FORM"))
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

//SOTTOSEZIONE MODULI SC COM MEDIA

elseif(strpos($text, "/mod1sccommed") === 0 || $text == "📄 I SEMESTRE SC COM MEDIA" || $text == "📄 i semestre sc com media")
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
						'document' => new CURLFile(realpath("./orariolezioni/sccommed/orariosccommed.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI SC COM CULT
elseif(strpos($text, "/sccomcult") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO SC COM CULT" || $text == "\xF0\x9F\x95\x92 orario sc com cult")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I SEMESTRE SC COM CULT"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC FORM"))
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

//SOTTOSEZIONE MODULI SC COM CULT

elseif(strpos($text, "/mod1sccomcult") === 0 || $text == "📄 I SEMESTRE SC COM CULT" || $text == "📄 i semestre sc com cult")
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
						'document' => new CURLFile(realpath("./orariolezioni/sccomcult/orariosccomcult.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI SC EDU
elseif(strpos($text, "/scedu") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO SC EDU" || $text == "\xF0\x9F\x95\x92 orario sc edu")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I SEMESTRE SC EDU"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC FORM"))
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

//SOTTOSEZIONE MODULI SC COM CULT

elseif(strpos($text, "/mod1scedu") === 0 || $text == "📄 I SEMESTRE SC EDU" || $text == "📄 i semestre sc edu")
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
						'document' => new CURLFile(realpath("./orariolezioni/scedu/orarioscedu.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO SCIENZE DI BASE

// MENU ORARIO LEZIONI SCIENZE DI BASE

elseif(strpos($text, "/orariolezscbase") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO CORSI SC DI BASE" || $text == "\xF0\x9F\x95\x92 orario corsi sc di base")
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
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI"),array("\xF0\x9F\x95\x92 ORARIO FARMACIA"))
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

// ORARIO LEZIONI FARMACIA

elseif(strpos($text, "/farm") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO FARMACIA" || $text == "\xF0\x9F\x95\x92 orario farmacia")
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
		 'text' => "\xE2\x9A\xA0 Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("📄 I SEMESTRE FARMACIA"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC DI BASE"))
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

//SOTTOSEZIONE MODULI FARMACIA

elseif(strpos($text, "/mod1farmacia") === 0 || $text == "📄 I SEMESTRE FARMACIA" || $text == "📄 i semestre farmacia")
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
						'document' => new CURLFile(realpath("./orariolezioni/farm/orariofarmacia.pdf")), 
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
elseif(strpos($text, "/oraribiblioteca") === 0 || $text == "📖 BIBLIO" || $text == "📖 biblio" || $text == "Biblioteche" || $text == "biblioteche")
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
		 'text' => "\xF0\x9F\x8F\xA6 Menu Biblioteche \xF0\x9F\x8F\xA6\n\n".$firstname.", che Biblioteca vuoi visitare?\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8F\xA6 BIBLIOTECA CENTR. INGEGNERIA"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA LETTERE","\xF0\x9F\x8F\xA6 SALA LETTURA WURTH"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA ARCHITETTURA","\xF0\x9F\x8F\xA6 EMEROTECA ARCH"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA CLA","\xF0\x9F\x8F\xA6 BIBLIOTECA FIS CHIM ARCHIRAFI"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA EX ARCHITETTURA")),
			 'resize_keyboard' => true
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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 	'chat_id' => $chatId, 
		 	'text' => "\xF0\x9F\x95\x92 Orari Esercizio:\n\nLun-Ven dalle 8.30 alle 22\n\nDa Settembre a Luglio\n\nℹ️ Info Utili\n\nPotete richiedere il rinnovo dei libri in scadenza mandando una e-mail a bibling@unipa.it oppure chiamando il numero 091/23862001\n\nPer prenotare un posto in sala rossa rivolgersi al Front-Office della Biblioteca", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📖 BIBLIO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1046242", 
						'longitude' => "13.3485952");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 	'chat_id' => $chatId, 
		 	'text' => "Si trova dentro l'Edificio 12 (Sotto la posizione precisa)\n\n🕒 Orari Esercizio\n\nLun-Gio dalle 8.30 alle 17\nVen dalle 8:30 alle 13:30\n\nℹ️ Info Utili\n\nChiusura dall' 8 al 21 agosto 2016 e dal 23 dicembre 2016 al 1° gennaio 2017", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📖 BIBLIO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1025863", 
						'longitude' => "13.3441629");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
	
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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 	'chat_id' => $chatId, 
		 	'text' => "Si trova dietro l'Edificio 12 (Sotto la posizione precisa)\n\n🕒 Orari Esercizio\n\nLun-Ven dalle 09:00 alle 22:00\n\nℹ️ Info Utili\n\nChiusura dall' 8 al 21 agosto 2016 e dal 23 dicembre 2016 al 1° gennaio 2017\n\n\xF0\x9F\x93\x9E Contatti:\n\nTel +39.09123899239 / 95418 (front-office)\n\nTel2. +39.09123899241 / 99243 (servizio dd)\n\nbiblioteca.scienzeumanistiche@unipa.it", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📖 BIBLIO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1025863", 
						'longitude' => "13.3441629");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
}

// MENU ORARI BIBLIOTECA ARCHITETTURA
elseif(strpos($text, "/biblioarc") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA ARCHITETTURA" || $text == "\xF0\x9F\x8F\xA6 biblioteca architettura" )
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
		 	'text' => "Si trova dentro l'Edificio 14 al 2° Piano (Sotto la posizione)\n\n🕒 Orari Esercizio\n\nLun-Gio dalle 08:30 alle 17:00\nVen dalle 08:30 alle 15:00\n\nℹ️ Info Utili\n\nChiusura dal 12 al 21 agosto 2016; dal 23 dicembre 2016 al 1° gennaio 2017\nOrario mesi di Luglio e Agosto: dal lunedì al venerdì 8.30 - 14.30\n\n\xF0\x9F\x93\x9E Tel 091590454\n\n✉️ Email: biblioteca.architettura@unipa.it", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📖 BIBLIO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1023439", 
						'longitude' => "13.3470972");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// MENU ORARI BIBLIOTECA EMEROTECA ARCH
elseif(strpos($text, "/emerotecaarc") === 0 || $text == "\xF0\x9F\x8F\xA6 EMEROTECA ARCH" || $text == "\xF0\x9F\x8F\xA6 emeroteca arch" )
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
		 	'text' => "L’emeroteca si trova dentro l'Edificio 14 al 3° Piano (Sotto la posizione) e offre ampi e luminosi spazi per lo studio oltre a mettere a disposizione dell’utenza 16 postazioni PC per la ricerca bibliografica\n\n🕒 Orari Esercizio:\n\nLun-Gio dalle 08:30 alle 17:00\nVen dalle 08:30 alle 14:30\n\nℹ️ Info Utili\n\nChiusura dal 12 al 21 agosto 2016; dal 23 dicembre 2016 al 1° gennaio 2017\nOrario mesi di Luglio e Agosto: dal lunedì al venerdì 8.30 - 14.30\n\n\xF0\x9F\x93\x9E Tel 091590454\n\n✉️ Email: biblioteca.architettura@unipa.it", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📖 BIBLIO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1023439", 
						'longitude' => "13.3470972");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// MENU ORARI BIBLIOTECA CLA
elseif(strpos($text, "/bibliocla") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA CLA" || $text == "\xF0\x9F\x8F\xA6 biblioteca cla" )
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
		 	'text' => "La Biblioteca del CLA si trova a Piazza S.Antonino,1 (Sotto la posizione precisa) e offre ampi e luminosi spazi per lo studio\n\n\xF0\x9F\x93\x9E Tel 0916169615 - 09123899263\n\n✉️ Email: cla@unipa.it", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📖 BIBLIO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1096341", 
						'longitude' => "13.3638764");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// MENU ORARI BIBLIOTECA VIA ARCHIRAFI
elseif(strpos($text, "/biblioarchirafi") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA FIS CHIM ARCHIRAFI" || $text == "\xF0\x9F\x8F\xA6 biblioteca fis chim archirafi" )
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
		 	'text' => "La Biblioteca di Fisica e Chimica si trova a Via Archirafi,36 al 1° Piano (Sotto la posizione precisa) e offre ampi e luminosi spazi per lo studio\n\n🕒 Orari Esercizio:\n\nLun-Gio MATTINA dalle 08:30 alle 13:30 - POMERIGGIO dalle 14:30 alle 17:00\nVen dalle 08:30 alle 13:30\n\nℹ️ Info Utili\n\nChiusura dal 3 giugno 2016; dall' 8 al 21 agosto 2016; dal 23 dicembre 2016 al 3 gennaio 2017\nOrario mesi di Luglio e Agosto: dal lunedì al giovedì 8:30 - 14:30  venerdì 8:30- 14:00\n\n\xF0\x9F\x93\x9E Tel 09123862101 / 62108\n\n✉️ Email: biblioteca.fisicachimica@unipa.it ", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📖 BIBLIO"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1102781", 
						'longitude' => "13.3712033");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// MENU ORARI BIBLIOTECA EX ARCHITETTURA
elseif(strpos($text, "/biblioexarch") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA EX ARCHITETTURA" || $text == "\xF0\x9F\x8F\xA6 biblioteca ex architettura" )
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
		 	'text' => "La Ex Biblioteca di Architettura si trova presso l'Edificio 8 al Piano Terra sotto il porticato (Sotto la posizione precisa) e offre ampi e luminosi spazi per lo studio\n\n🕒 Orari Esercizio:\n\nLun-Gio dalle 08:30 alle 17:00\nVen dalle 08:30 alle 13:30\n\nℹ️ Info Utili\n\nChiusura dal 12 al 26 agosto 2016; dal 23 dicembre 2016 al 5 gennaio 2017\nOrario mesi di Luglio e Agosto: dal lunedì al venerdì 8.30-14.30\n\n\xF0\x9F\x93\x9E Tel 09123896204 / 62108\n\n✉️ Email: biblioteca.architettura@unipa.it", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📖 BIBLIO"))
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

	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "⚠️ Sotto trovi anche le mappe di Ingegneria e Architettura", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🌍 MAPPA POLIDIDATTICO"),array("🌍 MAPPA ARCHITETTURA","🌍 MAPPA INGEGNERIA"),array("🌍 MAPPA VIA ARCHIRAFI","🌍 MAPPA VIA GIUFFRE"))
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

 //$response = "Mappa Unipa";
	
}

// MAPPA INGEGNERIA

elseif(strpos($text, "/mappaing") === 0 || $text == "🌍 MAPPA INGEGNERIA" || $text == "🌍 mappa ingegneria")
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
						'caption' => $firstname.", ecco la Mappa di Ingegneria!");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// MAPPA VIA ARCHIRAFI

elseif(strpos($text, "/mappaviaarch") === 0 || $text == "🌍 MAPPA VIA ARCHIRAFI" || $text == "🌍 mappa via archirafi")
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
						'photo' => new CURLFile(realpath("./img/mappaviaarchirafi.jpg")), 
						'caption' => $firstname.", ecco la Mappa di Via Archirafi !");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// MAPPA VIA GIUFFRE

elseif(strpos($text, "/mappaviagiuffre") === 0 || $text == "🌍 MAPPA VIA GIUFFRE" || $text == "🌍 mappa via giuffre")
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
						'photo' => new CURLFile(realpath("./img/mappaviagiuffre.jpg")), 
						'caption' => $firstname.", ecco la Mappa di Via Giuffre' !");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// MAPPA POLIDIDATTICO

elseif(strpos($text, "/mappapoli") === 0 || $text == "🌍 MAPPA POLIDIDATTICO" || $text == "🌍 mappa polididattico")
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
						'photo' => new CURLFile(realpath("./img/mappapolididattico.jpg")), 
						'caption' => $firstname.", ecco la Mappa di Via Giuffre' !");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// MAPPA ARCHITETTURA

elseif(strpos($text, "/mappaarch") === 0 || $text == "🌍 MAPPA ARCHITETTURA" || $text == "🌍 mappa architettura")
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
						'photo' => new CURLFile(realpath("./img/mappaarchp0.jpg")), 
						'caption' => $firstname.", ecco la Mappa di Architettura!");
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
						'photo' => new CURLFile(realpath("./img/mappaarchp1.jpg")), 
						'caption' => $firstname.", ecco la Mappa di Architettura!");
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
						'photo' => new CURLFile(realpath("./img/mappaarchp2.jpg")), 
						'caption' => $firstname.", ecco la Mappa di Architettura!");
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
						'photo' => new CURLFile(realpath("./img/mappaarchp3.jpg")), 
						'caption' => $firstname.", ecco la Mappa di Architettura!");
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
						'photo' => new CURLFile(realpath("./img/mappaarchp4.jpg")), 
						'caption' => $firstname.", ecco la Mappa di Architettura!");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
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
	
	$response = "Le aule in elenco sono:\n\nF130\n\nF140\n\nF150\n\nF160\n\nF170\n\nF210\n\nF220\n\nF230\n\nF240\n\nF310\n\nF320\n\nPer segnalare altre aule scrivi a @gabrieledellaria";
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
	}

	elseif(strpos($text, "F220") === 0 || $text == "f220" || $text == "F220")
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
	}

	elseif(strpos($text, "F230") === 0 || $text == "f230" || $text == "F230")
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
	}



//INFO PROF

elseif(strpos($text, "/professori") === 0 || $text == "\xF0\x9F\x91\xA4 INFO PROF" || $text == "\xF0\x9F\x91\xA4 info prof" || $text == "Prof" || $text == "prof")
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
		
		$response = "Al momento in elenco:\n\n\xF0\x9F\x91\xA4 Prof Burlon \n\n\xF0\x9F\x91\xA4 Prof La Cascia \n\nSe il prof che cerchi non è in elenco contatta @gabrieledellaria";
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
	
	elseif(strpos($text, "/profdaverio") === 0 || $text == "daverio" || $text == "Daverio" || $text == "Prof Daverio" || $text == "prof daverio")
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
		
		$response = "\xF0\x9F\x91\xA4 Nome: Philippe \n\xF0\x9F\x91\xA4 Cognome: Daverio \n\xF0\x9F\x8F\xA6 Ufficio: Ed.14\n📝 Ricevimento: Lunedì dalle 12:00 alle 17:00 presso aula 4.4 (Edificio 14)\n✉️ Contatti: philippe.daverio@unipa.it";
	}

	elseif(strpos($text, "/profdigiovanni") === 0 || $text == "Di Giovanni" || $text == "di giovanni" || $text == "Prof Di Giovanni" || $text == "prof di giovanni")
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
		
		$response = "\xF0\x9F\x91\xA4 Nome: Elisabetta \n\xF0\x9F\x91\xA4 Cognome: Di Giovanni \n\xF0\x9F\x8F\xA6 Ufficio: Ed.15\n📝 Ricevimento: Martedì dalle 09:00 alle 11:00 presso Edificio 15, 7° piano\n✉️ Contatti: elisabetta.digiovanni@unipa.it";
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
		
		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
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
	
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8F\xA6 DIID (EX DICGIM)"),array("\xF0\x9F\x8F\xA6 DICAM","\xF0\x9F\x8F\xA6 DIP ARCHITETTURA"))
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
elseif(strpos($text, "/dicgim") === 0 || $text == "\xF0\x9F\x8F\xA6 DIID (EX DICGIM)" || $text == "\xF0\x9F\x8F\xA6 diid (ex dicgim)")
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
		 	'text' => "Si trova dietro l'Edificio 6 (Sotto la posizione precisa)\n\n☎️ Tel. 09123867503\n\n✉️ Email: dipartimento.dicgim@unipa.it", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8F\xA2 DIPART"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1058038", 
						'longitude' => "13.3329904");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// DICAM	
elseif(strpos($text, "/dicam") === 0 || $text == "\xF0\x9F\x8F\xA6 DICAM" || $text == "\xF0\x9F\x8F\xA6 dicam")
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
		 	'text' => "Si trova dietro l'Edificio 8 (Sotto la posizione precisa)\n\n☎️ Tel. 09123867503\n\n✉️ Email: dipartimento.dicam@unipa.it", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8F\xA2 DIPART"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.105589", 
						'longitude' => "13.348426");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// DIP ARCHITETTURA
elseif(strpos($text, "/diparch") === 0 || $text == "\xF0\x9F\x8F\xA6 DIP ARCHITETTURA" || $text == "\xF0\x9F\x8F\xA6 dip architettura")
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
		 	'text' => "La Sede Amministrativa si trova presso l'Edificio 8, scala F4 - 1° Piano (Sotto la posizione precisa)\n\nLa Sede Centrale si trova presso l'Edificio 14\n\n☎️ Tel. 091.23895320\n\n✉️ Email: dipartimento.architettura@unipa.it", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8F\xA2 DIPART"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1050216", 
						'longitude' => "13.3482036");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

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
		
		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
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
		
		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
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
		
		$response = "\xF0\x9F\x8D\x9D MENSA SANTI ROMANO \n\n\xF0\x9F\x95\x92 ORARIO ESERCIZIO\n\nIl pranzo viene servito dalle 12.00 alle 15.00, mentre la cena viene servita dalle 19.30 alle 21.00.\n\nIn più, la sala ristorazione della Residenza Universitaria S. Romano offre un servizio di pizzeria aperto ogni giorno dalle ore 20:30 alle ore 23:30.\n\n📝 Note:\nLa mensa Santi Romano è aperta tutto l'anno , escludendo brevi periodi  estivi e per le festività di Natale, Pasqua, 1° maggio";
	}

	//MENSA S.SAVERIO

elseif(strpos($text, "/mensassaverio") === 0 || $text == "\xF0\x9F\x8D\x9D MENSA S.SAVERIO" || $text == "\xF0\x9F\x8D\x9D mensa s.saverio" )
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
		
		$response = "\xF0\x9F\x8D\x9D MENSA S.SAVERIO (Via G. Di Cristina 7) \n\n\xF0\x9F\x95\x92 ORARIO ESERCIZIO\n\nIl pranzo viene servito dalle 12.00 alle 15.00, mentre la cena viene servita dalle 19.30 alle 21.00";
	}	

	//MENSA CIVICO

elseif(strpos($text, "/mensacivico") === 0 || $text == "\xF0\x9F\x8D\x9D MENSA CIVICO" || $text == "\xF0\x9F\x8D\x9D mensa civico" )
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
		
		$response = "\xF0\x9F\x8D\x9D MENSA CIVICO (ED.19 Ospedale Civico) \n\n\xF0\x9F\x95\x92 ORARIO ESERCIZIO\n\nIl pranzo viene servito dalle 12.00 alle 15.00";
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
		
		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x93\x84 COPISTERIE\n\n".$firstname.", ecco le copisterie che fanno per te\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x93\x84 LA NUOVA COPISTERIA ING."),array("\xF0\x9F\x93\x84 COPISTERIA LETTERE","\xF0\x9F\x93\x84 COPISTERIA AGORA"),array("\xF0\x9F\x93\x84 LA NUOVA COPISTERIA BIO","\xF0\x9F\x93\x84 COPISTERIA ARCH"))
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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 	'chat_id' => $chatId, 
		 	'text' => "\xF0\x9F\x93\x84 LA NUOVA COPISTERIA ING.\n\n🕒 Orari Esercizio\n\nLun-Ven dalle 08.30 alle 19.00\n\n📞 Contatti: +39 091.7098720\n\n💻 Sito Web: www.lanuovacopisteria.com", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x93\x84 COPIST"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.105099", 
						'longitude' => "13.348893");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 	'chat_id' => $chatId, 
		 	'text' => "\xF0\x9F\x93\x84 LA NUOVA COPISTERIA BIO\n\n🕒 Orari Esercizio\n\nLun-Ven dalle 08.30 alle 19.00\n\n📞 Contatti: +39 091.6526000\n\n💻 Sito Web: www.lanuovacopisteria.com", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x93\x84 COPIST"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1003383", 
						'longitude' => "13.3461458");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 	'chat_id' => $chatId, 
		 	'text' => "\xF0\x9F\x93\x84 COPISTERIA LETTERE \n\n🕒 Orari Esercizio\n\nLun-Ven dalle 08.30 alle 19.00\n\nSab dalle 09:00 - 13:00\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x93\x84 COPIST"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1036579", 
						'longitude' => "13.3478489");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

	}		
	
//COPISTERIA AGORÀ
elseif(strpos($text, "/copagorà") === 0 || $text == "\xF0\x9F\x93\x84 COPISTERIA AGORA" || $text == "\xF0\x9F\x93\x84 copisteria agora")
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
		 	'text' => "\xF0\x9F\x93\x84 COPISTERIA AGORÀ \n\n🕒 Orari Esercizio\n\nLun-Ven dalle 08.30 alle 19.00\n\nSab dalle 09:00 - 13:00\n\n", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x93\x84 COPIST"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1030086", 
						'longitude' => "13.3478489");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
	}	

//COPISTERIA ARCHITETTURA
	
elseif(strpos($text, "/coparch") === 0 || $text == "\xF0\x9F\x93\x84 COPISTERIA ARCH" || $text == "\xF0\x9F\x93\x84 copisteria arch")
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
		 	'text' => "\xF0\x9F\x93\x84 COPISTERIA ARCHITETTURA \n\nSi trova di fronte l'ingresso dell'Edificio 14\n\n🕒 Orario Esercizio: 08:00 - 19:00", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x93\x84 COPIST"))
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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1025477", 
						'longitude' => "13.3473151");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

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

		// SEND LOCATION ( INVIO POSIZIONE )
		
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendLocation";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'latitude' => "38.1069486", 
						'longitude' => "13.3539132");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		$response = "Ecco la posizione di ".$text." !";
	}	



else
{
	$response = "\xE2\x9A\xA0 Il comando che hai eseguito non è valido!\n\nDigita /help per il mio elenco comandi";
}
	

$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);

$parameters = array('chat_id' => $chatId, "text" => $response2);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);