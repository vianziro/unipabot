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

if(strpos($text, "/start") === 0 || $text=="\xF0\x9F\x94\xB4 START" || $text == "\xF0\x9F\x94\xB4 start")
{
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId
		, 'text' => "\xF0\x9F\x91\x8B Ciao $firstname (@$username), benvenuto in Unipa Bot!"
		, 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","\xF0\x9F\x8F\xAB BIBLIO \xF0\x9F\x93\x9A","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPISTERIE","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 PUNTI RISTORO","\xE2\x98\x95 MACCH. CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","\xE2\x9A\xA0 HELP","\xE2\x84\xB9 ABOUT"))
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
	
	//$response = "\xF0\x9F\x91\x8B Ciao $firstname (@$username), benvenuto in Unipa Bot!";
}

else if(strpos($text, "/help") === 0 || $text == "\xE2\x81\x89 HELP" || $text == "\xE2\x81\x89 help")
{
	$response = "\xF0\x9F\x93\x94 ELENCOCOMANDI\n\n/start \xF0\x9F\x9A\x80 START BOT \n\n/professori \xF0\x9F\x91\xA4 Professori \n\n/mappa \xF0\x9F\x8C\x90 Mappa Unipa \n\n/orariolezioni \xF0\x9F\x95\x92 Orario Lezioni \n\n/oraribiblioteca \xF0\x9F\x8F\xA6 Orari Biblioteca \n\n/ristoro \xF0\x9F\x8D\x9D Punti Ristoro \n\n/about \xE2\x9A\xA0 Info sul Bot \n\n/help \xE2\x84\xB9 Elenco comandi \n\n";
}

else if($text == "\xE2\xAC\x85 BACK" || $text == "\xE2\xAC\x85 back")
{
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId
		, 'text' => "\xE2\x9A\xA0 MENU PRINCIPALE \xE2\x9A\xA0"
		, 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","\xF0\x9F\x8F\xAB BIBLIO \xF0\x9F\x93\x9A","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPISTERIE","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 PUNTI RISTORO","\xE2\x98\x95 MACCH. CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","\xE2\x9A\xA0 HELP","\xE2\x84\xB9 ABOUT"))
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

//ABOUT
elseif(strpos($text, "/about") === 0 || $text == "\xE2\x84\xB9 ABOUT" || $text == "\xE2\x84\xB9 about")
{
	$response = "\xE2\x9A\xA0 Info:\n\nIn Unipa Bot potrai trovare tutte le info necessarie per l'Università di Palermo\n\n\xE2\x84\xB9 Credits:\n\nQuesto bot è stato creato da Gabriele Dell'Aria (@gabrieledellaria) ... Se hai suggerimenti contattami pure e sarò felice di accogliere i tuoi spunti";
}

//PUNTI RISTORO
elseif(strpos($text, "/ristoro") === 0 || $text == "\xF0\x9F\x8D\x94 PUNTI RISTORO" || $text == "\xF0\x9F\x8D\x94 punti ristoro")
{
	
		$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8D\x94 Punti Ristoro\n\nScegli la Panineria tra quelle sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xE2\xAC\x85 BACK","\xF0\x9F\x8D\x94 Panineria Jhonny"),array("\xF0\x9F\x8D\x94 Panineria del Viale","\xF0\x9F\x8D\x94 Panineria Massaro"))
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
	$response = "\xF0\x9F\x8D\x94 Panineria da Jhonny \n\n\xF0\x9F\x8C\x8E Localizzazione Maps \xF0\x9F\x8C\x8E\n\nhttps://goo.gl/a17ehV\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLun-Ven dalle 11.30 alle 23.30\n\nDa Settembre a Luglio\n\n";
}

//Panineria Del Viale
elseif(strpos($text, "/pandelviale") === 0 || $text == "\xF0\x9F\x8D\x94 Panineria del Viale" || $text == "\xF0\x9F\x8D\x94 panineria del viale")
{
	$response = "\xF0\x9F\x8D\x94 Panineria Del Viale \n\n\xF0\x9F\x8C\x8E Localizzazione Maps \xF0\x9F\x8C\x8E\n\nhttps://goo.gl/nGtgbY\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLun-Ven dalle 11.30 alle 23.30\n\nDa Settembre a Luglio\n\n";
}

// MENU STUDENTI
elseif(strpos($text, "/menustudenti") === 0 || $text == "\xF0\x9F\x91\xA5 MENU STUDENTI" || $text == "\xF0\x9F\x91\xA5 menu studenti" )
{
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8F\xA6 Menu Studenti \xF0\x9F\x8F\xA6\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xE2\xAC\x85 BACK","\xF0\x9F\x95\x92 ORARIO LEZIONI"),array("\xF0\x9F\x93\x9A MATERIE A SCELTA","\xF0\x9F\x93\x91 TIROCINIO"))
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
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le MATERIE A SCELTA consigliate ";
	}

//TIROCINIO	
elseif(strpos($text, "/tirocinio") === 0 || $text == "\xF0\x9F\x93\x91 TIROCINIO" || $text == "\xF0\x9F\x93\x91 tirocinio")
	{
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le aziende di TIROCINIO consigliate ";
	}	

// MENU ORARIO LEZIONI
elseif(strpos($text, "/orariolezioni") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO LEZIONI" || $text == "\xF0\x9F\x95\x92 orario lezioni")
{
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x95\x92 SEZIONE ORARIO LEZIONI \xF0\x9F\x95\x92\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("\xF0\x9F\x95\x92 ORARIO CORSI ARCH","\xF0\x9F\x95\x92 ORARIO CORSI ECO"))
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
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x95\x92 ORARIO LEZIONI","\xF0\x9F\x95\x92 ORARIO ING INFORMATICA"),array("\xF0\x9F\x95\x92 ORARIO ING GESTIONALE","\xF0\x9F\x95\x92 ORARIO ING MECCANICA"))
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
	$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendPhoto";
	// change image name and path
	$postFields = array('chat_id' => $chatId, 'photo' => new CURLFile(realpath("./img/lezioni1anno.PNG")), 'caption' => "Orario Lezioni 1° Anno Ing.Informatica");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
	// change image name and path
	$postFields = array('chat_id' => $chatId, 'photo' => new CURLFile(realpath("./img/lezioni2annoinginf.PNG")), 'caption' => "Orario Lezioni 2° Anno Ing.Informatica");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
	// change image name and path
	$postFields = array('chat_id' => $chatId, 'photo' => new CURLFile(realpath("./img/lezioni3annoinginf.PNG")), 'caption' => "Orario Lezioni 3° Anno Ing.Informatica");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
}

// MENU ORARIO LEZIONI ARCH
elseif(strpos($text, "/orariolezarch") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO CORSI ARCH" || $text == "\xF0\x9F\x95\x92 orario corsi arch")
{
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea \xE2\x9A\xA0\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x95\x92 ORARIO LEZIONI","\xF0\x9F\x95\x92 ORARIO ARCHITETTURA"),array("\xF0\x9F\x95\x92 ORARIO DISEGNO INDUSTRIALE"))
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

// MENU ORARI BIBLIOTECHE
elseif(strpos($text, "/oraribiblioteca") === 0 || $text == "\xF0\x9F\x8F\xAB BIBLIO \xF0\x9F\x93\x9A" || $text == "\xF0\x9F\x8F\xAB biblio \xF0\x9F\x93\x9A" )
{
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8F\xA6 Menu Biblioteche \xF0\x9F\x8F\xA6\n\nScegli la Biblioteca\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xE2\xAC\x85 BACK","\xF0\x9F\x8F\xA6 BIBLIOTECA CENTR. INGEGNERIA"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA LETTERE","\xF0\x9F\x8F\xA6 SALA LETTURA WURTH"))
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
	$response = "\xF0\x9F\x8F\xA6 Edificio \n\nSi trova presso l'Edificio 8\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLun-Ven dalle 8.30 alle 22\n\nDa Settembre a Luglio\n\n\xF0\x9F\x91\xA4 Info Utili\n\nPotete richiedere il rinnovo dei libri in scadenza mandando una e-mail a bibling@unipa.it oppure chiamando il numero 091/23862001";
}

// MENU ORARI BIBLIOTECA LETTERE
elseif(strpos($text, "/bibliolettere") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA LETTERE" || $text == "\xF0\x9F\x8F\xA6 biblioteca lettere" )
{
	$response = "\xF0\x9F\x8F\xA6 Edificio \n\nSi trova presso l'Edificio 12 (Lettere e Filosofia)\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLun-Gio dalle 8.30 alle 17\nVen dalle 8:30 alle 13:30\n\n\xF0\x9F\x91\xA4 Info Utili\n\nChiusura dall' 8 al 21 agosto 2016 e dal 23 dicembre 2016 al 1° gennaio 2017";
}

// MENU ORARI SALA LETTURA WURTH
elseif(strpos($text, "/salletwurth") === 0 || $text == "\xF0\x9F\x8F\xA6 SALA LETTURA WURTH" || $text == "\xF0\x9F\x8F\xA6 sala lettura wurth" )
{
	$response = "\xF0\x9F\x8F\xA6 Edificio \n\nSi trova dietro l'Edificio 12 (Lettere e Filosofia)\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLun-Ven dalle 9.00 alle 22\n\n\xF0\x9F\x91\xA4 Info Utili\n\nChiusura dall' 8 al 21 agosto 2016; dal 23 dicembre 2016 al 1° gennaio 2017\n\n\xF0\x9F\x93\x9E Contatti:\n\nTel +39.09123899239 / 95418 (front-office)\n\nTel2. +39.09123899241 / 99243 (servizio dd)\n\nbiblioteca.scienzeumanistiche@unipa.it";
}

// MAPPA
elseif(strpos($text, "/mappa") === 0 || $text == "\xF0\x9F\x8C\x8E MAPPA" || $text == "\xF0\x9F\x8C\x8E mappa")
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

 //$response = "Mappa Unipa";
	
}

// DOC AULE ING
elseif(strpos($text, "/doc") === 0 || $text == "\xF0\x9F\x8C\x8E doc" || $text == "\xF0\x9F\x8C\x8E doc")
{
	
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
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x91\xA4 Menu Aule \xF0\x9F\x91\xA5\n\nInvia il nome dell'aula cercata\n\n\xE2\x9A\xA0 ES. F170", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xE2\xAC\x85 BACK","\xF0\x9F\x91\xA4 AULE IN ELENCO"))
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

//SOTTOSEZIONE Aule

//AULE

	elseif(strpos($text, "F170") === 0 || strpos($text, "F 170") === 0 || strpos($text, "f 170") === 0 )
	{
		$response = "Al momento in elenco:\n\n/profburlon \xF0\x9F\x91\xA4 Prof Burlon \n\n/proflacascia \xF0\x9F\x91\xA4 Prof La Cascia \n\nSe il prof che cerchi non è in elenco contatta @gabrieledellaria";
	}


//INFO PROF
elseif(strpos($text, "/professori") === 0 || $text == "\xF0\x9F\x91\xA4 INFO PROF" || $text == "\xF0\x9F\x91\xA4 info prof")
{
	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x91\xA4 Menu Professori \xF0\x9F\x91\xA5\n\nInvia il Cognome del Prof cercato\n\n\xE2\x9A\xA0 ES. Prof NomeProf", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xE2\xAC\x85 BACK","\xF0\x9F\x91\xA4 PROF IN ELENCO"),array("\xE2\x9A\xA0 Segnala Prof"))
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
		$response = "Al momento in elenco:\n\n/profburlon \xF0\x9F\x91\xA4 Prof Burlon \n\n/proflacascia \xF0\x9F\x91\xA4 Prof La Cascia \n\nSe il prof che cerchi non è in elenco contatta @gabrieledellaria";
	}
	
//SEGNALA IL TUO PROF
	elseif(strpos($text, "/segnalaprof") === 0 || $text == "\xE2\x9A\xA0 SEGNALA PROF" || $text == "\xE2\x9A\xA0 Segnala Prof" || $text == "\xE2\x9A\xA0 segnala prof")
	{
		$response = "Se il prof che cerchi non è in elenco contatta @gabrieledellaria riportando Nome,Cognome e Facoltà del Prof da inserire";
	}	

// Sottosezione Professori //


elseif(strpos($text, "/profburlon") === 0 || $text == "Burlon" || $text == "burlon" || $text == "Prof Burlon" || $text == "prof burlon")
	{
		$response = "\xF0\x9F\x91\xA4 Nome: Riccardo \n\xF0\x9F\x91\xA4 Cognome: Burlon \n\xF0\x9F\x8F\xA6 Ufficio: Ed.6 ";
	}
	
elseif(strpos($text, "/proflacascia") === 0 || $text == "La Cascia" || $text == "la cascia" || $text == "Prof La Cascia" || $text == "prof la cascia")
	{
		$response = "\xF0\x9F\x91\xA4 Nome: Marco \n\xF0\x9F\x91\xA4 Cognome: La Cascia \n\xF0\x9F\x8F\xA6 Ufficio: Ed.8 ";
	}
	
	
	
	
// ERSU 	
elseif(strpos($text, "/ersu") === 0 || $text == "\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6" || $text == "\xF0\x9F\x8F\xA8 ersu \xF0\x9F\x92\xB6")
{	
		$response = "\xF0\x9F\x8F\xA8 UFFICIO ERSU \xF0\x9F\x92\xB6 \n\nSi trova in Viale delle Scienze, ed. 1 – 90128 Palermo (alla destra dell'ingresso del COT)\n\n\xF0\x9F\x95\x92 Ricevimento pubblico:\n\ndal Lunedì al Venerdì dalle ore 9:00 alle ore 13:00
Mercoledì dalle ore 15:30 alle ore 17:30\n\n\xE2\x9A\xA0 INFO\n\nPer informazioni sugli uffici, sullo stato degli atti e dei procedimenti amministrativi, nonché su ogni attività che riguardi l’Ente, inviare email a info@ersupalermo.gov.it.
Per informazioni riguardanti le borse e i servizi erogati dall’Ente (borse di studio, servizio abitativo, servizio ristorazione, ecc…), inviare email a borse@ersupalermo.gov.it oppure compilare il modulo online disponibile nella pagina personale dei “Servizi ERSU” del portale studenti dell’UNIPA.";

}

// SEGRETERIA 	
elseif(strpos($text, "/segreteria") === 0 || $text == "\xF0\x9F\x8F\xAC SEGRETERIA" || $text == "\xF0\x9F\x8F\xAC segreteria")
{	
		$response = "\xF0\x9F\x8F\xAC SEGRETERIA STUDENTI \xF0\x9F\x92\xAC\n\nSi trova in Viale delle Scienze, Ed. 3\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLunedì, Mercoledì, Venerdì dalle ore 09.00 alle ore 13.00\nMartedì e Giovedì dalle ore 15.00 alle ore 17.00 (escluso Luglio e Agosto)\n\n\xF0\x9F\x93\x9E CONTATTI \n\nEmail: segreterie.studenti@unipa.it\nTel. +3909123867526\nTel.2 +3909123886472\nFax. +3909123860506";

}

// DIPARTIMENTI 	
elseif(strpos($text, "/dipartimenti") === 0 || $text == "\xF0\x9F\x8F\xA2 DIPART" || $text == "\xF0\x9F\x8F\xA2 dipart")
{	
	$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x8F\xA6 MENU DIPARTIMENTI \xF0\x9F\x91\xA5\n\nScegli il Dipartimento", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xE2\xAC\x85 BACK","\xF0\x9F\x8F\xA6 DICGIM"),array("\xF0\x9F\x8F\xA6 DIP. IDRAULICA","\xF0\x9F\x8F\xA6 DIP. CHIMICA"))
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
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le info del Dipartimento \xF0\x9F\x8F\xA6 DICGIM ";

}

// DIP. IDRAULICA	
elseif(strpos($text, "/dipidraulica") === 0 || $text == "\xF0\x9F\x8F\xA6 DIP. IDRAULICA" || $text == "\xF0\x9F\x8F\xA6 dip. idraulica")
{	
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le info del Dipartimento \xF0\x9F\x8F\xA6 DIP. IDRAULICA ";

}

// DIP. CHIMICA	
elseif(strpos($text, "/dipidraulica") === 0 || $text == "\xF0\x9F\x8F\xA6 DIP. CHIMICA	" || $text == "\xF0\x9F\x8F\xA6 dip. chimica")
{	
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le info del Dipartimento \xF0\x9F\x8F\xA6 DIP. CHIMICA	 ";

}



// CLA	
elseif(strpos($text, "/cla") === 0 || $text == "\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7" || $text == "\xF0\x9F\x93\x96 cla \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7")
{	
		$response = "\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7 \n\nSi trova in Piazza S. Antonino, 1 90134 PALERMO (PA)\n\n\xF0\x9F\x93\x9E CONTATTI \n\n+39 0916169615 - +39 09123899263 cla@unipa.it";

}


//MACCHINETTE CAFFE
elseif(strpos($text, "/macchcaffe") === 0 || $text == "\xE2\x98\x95 MACCH. CAFFE" || $text == "\xE2\x98\x95 macch. caffe")
	{
		$response = "\xE2\x9A\xA0 Prossimamente disponibili le macchinette del caffe dei vari edifici ";
	}

//MENSA
elseif(strpos($text, "/mensa") === 0 || $text == "\xF0\x9F\x8D\x9D MENSA" || $text == "\xF0\x9F\x8D\x9D mensa")
	{
		$response = "\xF0\x9F\x8D\x9D MENSA SANTI ROMANO \xF0\x9F\x8D\x95\n\n\xF0\x9F\x95\x92 ORARIO ESERCIZIO\n\nil pranzo viene servito dalle 12.00 alle 15.00, mentre la cena viene servita dalle 19.00 alle 21.30.\n\nIn più, la sala ristorazione della Residenza Universitaria S. Romano offre un servizio di pizzeria aperto ogni giorno dalle ore 19:30 alle ore 22:30. ";
	}
	
//ACQUISTO MATERIALE
elseif(strpos($text, "/copisterie") === 0 || $text == "\xF0\x9F\x93\x84 COPISTERIE" || $text == "\xF0\x9F\x93\x84 copisterie")
	{
		$botToken="254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "\xF0\x9F\x93\x84 COPISTERIE\n\nScegli tra le copisterie sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("\xE2\xAC\x85 BACK","\xF0\x9F\x93\x84 LA NUOVA COPISTERIA ING."),array("\xF0\x9F\x93\x84 COPISTERIA LETTERE","\xF0\x9F\x93\x84 COPISTERIA ED.9"),array("\xF0\x9F\x93\x84 LA NUOVA COPISTERIA BIO"))
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
		$response = "\xE2\x9A\xA0 Prossimamente disponibile!";
	}
	
//LA NUOVA COPISTERIA BIO
elseif(strpos($text, "/copbio") === 0 || $text == "\xF0\x9F\x93\x84 LA NUOVA COPISTERIA BIO" || $text == "\xF0\x9F\x93\x84 la nuova copisteria bio")
	{
		$response = "\xE2\x9A\xA0 Prossimamente disponibile!";
	}	
	
//COPISTERIA LETTERE
elseif(strpos($text, "/coplet") === 0 || $text == "\xF0\x9F\x93\x84 COPISTERIA LETTERE" || $text == "\xF0\x9F\x93\x84 copisteria lettere")
	{
		$response = "\xE2\x9A\xA0 Prossimamente disponibile!";
	}		
	
//COPISTERIA ED.9
elseif(strpos($text, "/coped9") === 0 || $text == "\xF0\x9F\x93\x84 COPISTERIA ED.9" || $text == "\xF0\x9F\x93\x84 copisteria ed.9")
	{
		$response = "\xE2\x9A\xA0 Prossimamente disponibile!";
	}	

//elseif(strpos($text, "/sndmsg") === 0 )
	//{
		//$url = "https://api.telegram.org/bot" . BOT_TOKEN ."/sendMessage?chat_id=".$chatId."&text=".urlencode($message);
		//file_get_contents($url);	
	//}	

else
{
	$response = "\xE2\x9A\xA0 Comando non valido!\n\nDigita /help per l'elenco comandi";
}
	

$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);

$parameters = array('chat_id' => $chatId, "text" => $response2);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);