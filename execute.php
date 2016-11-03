<?php 

//Questa definizione di costante poi non viene usata, piuttosto lo ripeti come variabile $botToken
define("BOT_TOKEN", "240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs");
$content = file_get_contents("php://input");

//Questo L'ho spostato quì, l'ho salito di qualche riga.
//Se $content è falso (cioè vuoto), tanto vale uscire subito, è inutile fargli fare le altre cose
if(!$content)
{
  exit;
}

$fHandle=fopen('mioLog.txt','w');
fwrite($fHandle,$content);

$update = json_decode($content, true);


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


$message_inline = isset($update['inline_query']) ? $update['inline_query'] : "";

$message_inline_keyboard = isset($message_inline['callback_query']) ? $message_inline['callback_query'] : "";

$message_inline_callbackdata = isset($message_inline_keyboard['text']) ? $message_inline_keyboard['text'] : "";


$message_inline_Id = isset($message_inline['id']) ? $message_inline['id'] : "";

$method='answerInlineQuery';
$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";

$postField_inline = array(
	 'inline_query_id' => $message_inline_Id
	,'cache_time' => 1
	,'results' => array(array(
		 'type' => 'article'
		,'id' => 'random_no_cache'.rand(0,65535)		
		,'title' => 'NEWS'
		,'message_text' => 'Ecco dove trovare le NEWS riguardanti Unipa'		
		,'description' => 'Scopri le News di Unipa'
		,'thumb_url' => "http://obrag.org/wp-content/uploads/2009/04/breaking-news.jpg"		
		,'reply_markup'=>['inline_keyboard'=>[
			[	 ['text'=>'UNIPABOT CH','url'=> "http://telegram.me/UnipaBotCh" ] ]
		]]
	), array(
		'type' => 'article'
		,'id' => 'random_no_cache'.rand(0,65535)		
		,'title' => 'ACTION2'
		,'message_text' => 'Ecco le NEWS riguardanti Unipa2'		
		,'description' => 'Scopri le News di Unipa'		
		,'reply_markup'=>['inline_keyboard'=>[
			[	 ['text'=>'CACCA','callback_data'=> "CACCA" ] ]
		]]
	))
	
);

fwrite($fHandle,"\n\nPostField inviato a telegram:\n".JSON_ENCODE($postField_inline)."\n");


$handle=curl_init();
curl_setopt($handle,CURLOPT_URL,"https://api.telegram.org/bot$botToken/$method");
curl_setopt($handle,CURLOPT_HTTPHEADER,array('Content-type: application/json'));
curl_setopt($handle,CURLOPT_POST,1);
curl_setopt($handle,CURLOPT_POSTFIELDS,JSON_ENCODE($postField_inline));
curl_setopt($handle,CURLOPT_RETURNTRANSFER,1);
curl_setopt($handle,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($handle,CURLOPT_ENCODING,1);
//$dati=json_decode( curl_exec($handle) ,true);	
$dati=curl_exec($handle);	

curl_close($handle);

fwrite($fHandle,"\n\nRisposta ricevuta da telegram:\n$dati");

fclose($fHandle);


$text_msg_broadcast = "⚠️ Aggiornati tutti gli orari dei corsi di Ingegneria";

if(strpos($text, "/start") === 0 || $text=="\xF0\x9F\x94\xB4 START" || $text == "\xF0\x9F\x94\xB4 start" || $text=="CIAO" || $text == "ciao")
{
	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId
		, 'text' => "\xF0\x9F\x91\x8B Ciao $firstname (@$username), benvenuto in Unipa Bot!\n\nℹ️ Comandi rapidi:\n\nAule - Trova Aula\nProf - Trova le info sul tuo prof\nBiblioteche - Trova le Biblioteche\nOrario Lezioni Tri - Trova l'orario lezioni dei corsi triennali\nOrario Lezioni Mag - Trova l'orario lezioni dei corsi magistrali"
		, 'reply_markup' => array(
			 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","📖 BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","🚈 TRASP","🚽 BAGNI"),array("↕ EVENTI","🖥 NEWS","🌥 METEO"),array("📘 CATALOGO ONLINE 💻"),array("🔧 CMD RAPIDI","ℹ️ INFO BOT")),
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
			 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","📖 BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","🚈 TRASP","🚽 BAGNI"),array("↕ EVENTI","🖥 NEWS","🌥 METEO"),array("📘 CATALOGO ONLINE 💻"),array("🔧 CMD RAPIDI","ℹ️ INFO BOT"))
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

else if( strpos($message_inline_callbackdata, "CACCA") === 0 || $message_inline_callbackdata=="CACCA" || $message_inline_callbackdata == "cacca")
{

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='answerCallbackQuery';
	
		$postField = array(
		 	'callback_query_id'=> $messageId,
		 	'text' => "Digita sotto ...",
		 	'show_alert' => true
		);

		fwrite($fHandle,"\n\nCacca rilasciata!\n".JSON_ENCODE($postField_inline)."\n");
	
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

else if(strpos($text, "/meteo") === 0 || $text == "🌥 METEO" || $text == "🌥 meteo")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "Digita sotto @meteovunque_bot Palermo per conoscere il meteo ad Unipa", //http://api.openweathermap.org/data/2.5/forecast/city?id=2523920&APPID=4202cf40c6d2c97a03ae52f757754ac2
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
	
}

else if(strpos($text, "/catonl") === 0 || $text == "📘 CATALOGO ONLINE 💻" || $text == "📘 catalogo online 💻")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "Per cercare un libro nel Catalogo di Ateneo visita il sito\n\nhttp://aleph22.unipa.it:8991/F\n\nHai tre modalità di ricerca all'interno di esso:\nRicerca semplice: Permette di scegliere dal menù a tendina il campo su cui si vuole effettuare la ricerca (autore, titolo, soggetto..)\n\nRicerca multicampo: Consente la ricerca contemporanea su diversi indici. Più campi compili, più sarà puntuale la tua ricerca\n\nRicerca avanzata: Permette di formulare richieste complesse attraverso la compilazione di diversi campi di ricerca e l'uso di filtri per affinare il risultato", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","ℹ GUIDA ALL'USO"))
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

else if(strpos($text, "/guidacatonl") === 0 || $text == "ℹ GUIDA ALL'USO" || $text == "ℹ guida all'uso")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./doc/guidacatonline.pdf")), 
						'caption' => "Guida per utilizzare il Catalogo Online delle Biblioteche");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
}

else if(strpos($text, "/eventiunipa") === 0 || $text == "↕ EVENTI" || $text == "↕ eventi")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "Per conoscere tutti gli eventi che si terranno ad Unipa visita\n\nhttps://www.unipa.it/?lista=eventi&id=9e1c1205-d2c4-11e4-a2b8-005056010139", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","📖 BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","🚈 TRASP","🚽 BAGNI"),array("↕ EVENTI","🖥 NEWS","🌥 METEO"),array("📘 CATALOGO ONLINE 💻"),array("🔧 CMD RAPIDI","ℹ️ INFO BOT")),
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
	
}

// COMANDI RAPIDI 

else if(strpos($text, "/cmdrapidi") === 0 || $text == "🔧 CMD RAPIDI" || $text == "🔧 cmd rapidi")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "ℹ️ Comandi rapidi:\n\nAule - Trova Aula\n\nProf - Trova le info sul tuo prof\n\nBiblioteche - Trova le Biblioteche\n\nOrario Lezioni Tri - Trova l'orario lezioni dei corsi triennali\n\nOrario Lezioni Mag - Trova l'orario lezioni dei corsi magistrali", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","📖 BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","🚈 TRASP","🚽 BAGNI"),array("↕ EVENTI","🖥 NEWS","🌥 METEO"),array("📘 CATALOGO ONLINE 💻"),array("🔧 CMD RAPIDI","ℹ️ INFO BOT")),
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

// 🖥 NEWS UNIPA

elseif(strpos($text, "/news") === 0 || $text == "🖥 NEWS" || $text == "🖥 news")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "Digita @UnipaBot NEWS o vai direttamente al canale @UnipaBotCh", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","📖 BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","🚈 TRASP","🚽 BAGNI"),array("↕ EVENTI","🖥 NEWS","🌥 METEO"),array("📘 CATALOGO ONLINE 💻"),array("🔧 CMD RAPIDI","ℹ️ INFO BOT")),
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
}

// INFO BOT
elseif(strpos($text, "/info") === 0 || $text == "ℹ️ INFO BOT" || $text == "ℹ️ info bot")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "✍ In Unipa Bot potrai trovare tutte le info necessarie per l'Università di Palermo\n\n👤 Credits: Questo bot è stato ideato e creato da Gabriele Dell'Aria (@gabrieledellaria)\n\nℹ Fonte Dati Principale: Portale Unipa - unipa.it\n\n🚌 Fonte Dati Autobus: OpenAmatBot - @openamatbot\n\n🚅 Fonte Dati Treni: Orario treni - @OrarioTreniBot\n\n⛈ Fonte Meteo: MeteOvunque - @meteovunque_bot\n\n⚠ Se hai suggerimenti contattami pure e sarò felice di accogliere i tuoi spunti", 
		 	'reply_markup' => array(
				"keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","📖 BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","🚈 TRASP","🚽 BAGNI"),array("↕ EVENTI","🖥 NEWS","🌥 METEO"),array("📘 CATALOGO ONLINE 💻"),array("🔧 CMD RAPIDI","ℹ️ INFO BOT")),
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
}

// INVIO MESSAGGIO BROADCAST
elseif(strpos($text, "/msg") === 0 || $text == "🔵 MSG BROADCAST" || $text == "🔵 msg broadcast")
{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "⛔ Inserisci la password di accesso", 
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
}

//PASSWORD ACCESSO BROADCAST

elseif(strpos($text, "otbapinu") === 0 || $text == "otbapinu")
{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => $text_msg_broadcast, 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🔵 MSG GLOBALE"))
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

// INVIO MESSAGGIO BROADCAST A TUTTI GLI ISCRITTI
elseif(strpos($text, "/sendglobal") === 0 || $text == "🔵 MSG GLOBALE" || $text == "🔵 msg globale")
{

		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

		$text_ok = "☑ Messaggio Broadcast: ".$text_msg_broadcast." correttamente inviato!";

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 	'chat_id' => $chatId, 
		 	'text' => $text_ok, 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🔵 MSG BROADCAST"))
				,'resize_keyboard' => true
			)
		);
	
	// MESSAGGIO PER GLI ISCRITTI

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
		$chatId_Adri = 213854702; 
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'chat_id' => $chatId_Adri, 
		 	'text' => $text_msg_broadcast, 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🔵 MSG BROADCAST"))
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
		$chatId_Mario = 12679403;
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'chat_id' => $chatId_Mario, 
		 	'text' => $text_msg_broadcast, 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🔵 MSG BROADCAST"))
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
		$chatId_Roby = 148082843;
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'chat_id' => $chatId_Roby, 
		 	'text' => $text_msg_broadcast, 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🔵 MSG BROADCAST"))
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
		$chatId_Simy = 164137894;
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'chat_id' => $chatId_Simy, 
		 	'text' => $text_msg_broadcast, 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🔵 MSG BROADCAST"))
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
		$chatId_Allie = 147239346;
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'chat_id' => $chatId_Allie, 
		 	'text' => $text_msg_broadcast, 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🔵 MSG BROADCAST"))
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
		$chatId_Adriana = 130295342;
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'chat_id' => $chatId_Adriana, 
		 	'text' => $text_msg_broadcast, 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🔵 MSG BROADCAST"))
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
		$chatId_Io = 18261059;
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'chat_id' => $chatId_Io, 
		 	'text' => $text_msg_broadcast, 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🔵 MSG BROADCAST"))
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

// TRASPORTI

elseif(strpos($text, "/trasp") === 0 || $text == "🚈 TRASP" || $text == "🚈 trasp")
{
	
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"),array("🚈 METRO","🚎 PULLMAN"),array("🚈 TRENO"))
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
		
		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "⭕️ Scegli la linea di cui vuoi le info sugli orari", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚈 TRASP"),array("🚌 LINEA 104","🚌 LINEA 109"),array("🚌 LINEA 118","🚌 LINEA 307"),array("🚌 LINEA 309","🚌 LINEA 364"),array("🚌 LINEA 380","🚌 LINEA EXPR"))
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

// MESSAGGI DOPO INVIO COMANDO INLINE PER OPENAMATBOT

// @openamatbot 104

elseif(strpos($text, "@openamatbot 104") === 0 || $text == "@openamatbot 104")
{	
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => $firstname.", ecco gli orari della linea da te richiesta!", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"))
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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "Digita @openamatbot 104 per avere le info sull'arrivo della ".$text." presso la tua fermata", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"))
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

// 🚌 LINEA 104

elseif(strpos($text, "/linea104") === 0 || $text == "🚌 LINEA 104" || $text == "🚌 linea 104")
{	
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "Digita @openamatbot 104 per avere le info sull'arrivo della ".$text." presso la tua fermata", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"))
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

// 🚌 LINEA 109
 
elseif(strpos($text, "/linea109") === 0 || $text == "🚌 LINEA 109" || $text == "🚌 linea 109")
{	
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "Digita @openamatbot 109 per avere le info sull'arrivo della ".$text." presso la tua fermata", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"))
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

// 🚌 LINEA 118
 
elseif(strpos($text, "/linea118") === 0 || $text == "🚌 LINEA 118" || $text == "🚌 linea 118")
{	
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "Digita @openamatbot 118 per avere le info sull'arrivo della ".$text." presso la tua fermata", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"))
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

// 🚌 LINEA 307
 
elseif(strpos($text, "/linea307") === 0 || $text == "🚌 LINEA 307" || $text == "🚌 linea 307")
{	
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "Digita @openamatbot 307 per avere le info sull'arrivo della ".$text." presso la tua fermata", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"))
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

// 🚌 LINEA 309
 
elseif(strpos($text, "/linea309") === 0 || $text == "🚌 LINEA 309" || $text == "🚌 linea 309")
{	
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "Digita @openamatbot 309 per avere le info sull'arrivo della ".$text." presso la tua fermata", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"))
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

// 🚌 LINEA 364
 
elseif(strpos($text, "/linea364") === 0 || $text == "🚌 LINEA 364" || $text == "🚌 linea 364")
{	
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "Digita @openamatbot 364 per avere le info sull'arrivo della ".$text." presso la tua fermata", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"))
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

// 🚌 LINEA 380
 
elseif(strpos($text, "/linea380") === 0 || $text == "🚌 LINEA 380" || $text == "🚌 linea 380")
{	
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "Digita @openamatbot 380 per avere le info sull'arrivo della ".$text." presso la tua fermata", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"))
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

// 🚌 LINEA EXPR
 
elseif(strpos($text, "/lineaexpr") === 0 || $text == "🚌 LINEA EXPR" || $text == "🚌 linea expr")
{	
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "Digita @openamatbot EXPR per avere le info sull'arrivo della ".$text." presso la tua fermata", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚌 AUTOBUS"))
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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "🚈 METRO da e verso Unipa \n\n⭕️ Scegli la linea di cui vuoi le info sugli orari", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚈 TRASP"),array("🚈 LINEA A","🚈 LINEA B"),array("🚈 LINEA C"))
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

// 🚈 LINEA A
elseif(strpos($text, "/lineaa") === 0 || $text == "🚈 LINEA A" || $text == "🚈 linea a")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "🚈 LINEA A da e verso Unipa\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚈 TRASP"),array("🚈 METRO"))
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
						'document' => new CURLFile(realpath("./doc/orarilineaa.pdf")), 
						'caption' => "🕒 ORARI 🚈 LINEA A - Palermo C.le -> Notarbartolo");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
}

// 🚈 LINEA B
elseif(strpos($text, "/lineab") === 0 || $text == "🚈 LINEA B" || $text == "🚈 linea b")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "🚈 LINEA B da e verso Unipa\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚈 TRASP"),array("🚈 METRO"))
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
						'document' => new CURLFile(realpath("./doc/orarilineab.pdf")), 
						'caption' => "🕒 ORARI 🚈 LINEA B - Notarbartolo -> Giachery");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
}

// 🚈 LINEA C
elseif(strpos($text, "/lineac") === 0 || $text == "🚈 LINEA C" || $text == "🚈 linea c")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "🚈 LINEA C da e verso Unipa\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚈 TRASP"),array("🚈 METRO"))
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
						'document' => new CURLFile(realpath("./doc/orarilineac1.pdf")), 
						'caption' => "🕒 ORARI 🚈 LINEA C - Palermo C.le -> Termini Imerese");
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
						'document' => new CURLFile(realpath("./doc/orarilineac2.pdf")), 
						'caption' => "🕒 ORARI 🚈 LINEA C - Termini Imerese -> Palermo C.le");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
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

	$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "Digita @OrarioTreniBot NomeStazionePartenza - NomeStazioneArrivo per avere le info sui treni che effettuano il percorso delle stazioni scelte\n\nIn alternativa digita @OrarioTreniBot NomeStazionePartenza per scoprire i treni che partono e arrivano nella stazione scelta\n\nLe stazioni inserite per Palermo sono:\n\nPALERMO CENTRALE\n\nPALERMO BRANCACCIO\n\nPALERMO NOTARBARTOLO\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚈 TRASP"))
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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
	$method='sendMessage';
	
	$postField = array(
		 'chat_id' => $chatId, 
		 'text' => "🚎 PULLMAN da e verso Unipa \n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚈 TRASP"))
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
						'document' => new CURLFile(realpath("./doc/orariopullmann.pdf")), 
						'caption' => "AUTOLINEE GALLO || DA UNIPA A CATTOLICA - RIBERA - SCIACCA - MENFI - SAMBUCA - BIVIO GULFA E DA CATTOLICA - RIBERA - SCIACCA - MENFI - SAMBUCA - BIVIO GULFA AD UNIPA");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📈 CALCOLO MEDIA"),array("\xF0\x9F\x95\x92 ORARIO LEZIONI TRI","\xF0\x9F\x95\x92 ORARIO LEZIONI MAG"),array("\xF0\x9F\x93\x9A MATERIE A SCELTA","\xF0\x9F\x93\x91 TIROCINIO"),array("📄 CALENDARI DIDATTICI","🏪 AULETTE ASSOCIAZIONI"))
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

// "📈 CALCOLO MEDIA"

elseif(strpos($text, "/calcmedia") === 0 || $text == "📈 CALCOLO MEDIA" || $text == "📈 calcolo media")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "Ecco un esempio pratico di come calcolare la tua Media Ponderata:\n
					Esame 1: voto 30 – 6 Cfu.\n\n
					Esame 2: voto 25 – 6 Cfu.\n\n
					Esame 3: voto 20 – 12 Cfu.\n\nSommando i crediti avremo un totale di 24 Cfu. La formula da applicare per ottenere la media ponderata è la seguente:\n\n [(30 x 6) + (25 x 6) + (20 x 12)] / 24 = (180 + 150 + 240) / 24 = 23,75.\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x91\xA5 MENU STUDENTI"))
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
		
		$response = "📖 Le materie a scelta che ti consiglio sono:\n\n📓 Gestione della Produzione Industriale (ING)\n\n📓 Biologia della Riproduzione ed Etologia (SCUOLA SCIENZE DI BASE)\n\n📓 Ecologia degli ambienti marini costieri  (SCUOLA SCIENZE DI BASE)\n\n📓 Storia della Chimica (SCUOLA SCIENZE DI BASE)\n\n📓 Metodologie Biochimiche (SCUOLA SCIENZE DI BASE)\n\n📓 Biologia riproduttiva e dello sviluppo dei vegetali (SCUOLA SCIENZE DI BASE)\n\nPalinologia e Paleobotanica A. Troia (SCUOLA SCIENZE DI BASE)\n\n📓 Metodi di data processing per la vulcanologia e la geochimica (SCUOLA SCIENZE DI BASE)\n\n📓 Cambiamenti climatici e record geologico (SCUOLA SCIENZE DI BASE)\n\n";
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
		
		$response = "ℹ️ Per le info sul Tirocinio visita http://www.stage.unipa.it/\n\n📜 Per conoscere le offerte delle aziende visita http://aziende.unipa.it/searches\n\nPer richiedere convenzioni per Tirocini presso Enti/Aziende nazionali http://www.unipa.it/amministrazione/area2/set17/Accreditamento-Aziende/procedura_aziende_nazionali.html";
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

// CALENDARI DIDATTICI

elseif(strpos($text, "/caldid") === 0 || $text == "📄 CALENDARI DIDATTICI" || $text == "📄 calendari didattici" || $text == "calendario didattico" || $text == "calendariodidattico")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x91\xA5 MENU STUDENTI"),array("📄 CAL DID POLITECNICA","📄 CAL DID SC UMANE"),array("📄 CAL DID SC GIURIDICHE","📄 CAL DID SC DI BASE"),array("📄 CAL DID SCUOLA MEDICINA"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📄 CALENDARI DIDATTICI"))
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

// CALENDARIO DIDATTICO SCIENZE UMANE

elseif(strpos($text, "/caldidscuma") === 0 || $text == "📄 CAL DID SC UMANE" || $text == "📄 cal did sc umane")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📄 CALENDARI DIDATTICI"))
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
						'document' => new CURLFile(realpath("./doc/calendarioscienzeumane.pdf")), 
						'caption' => "Calendario Didattico della Scuola di Scienze di Base e Applicate");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}		

// CALENDARIO DIDATTICO SCIENZE GIURIDICHE

elseif(strpos($text, "/caldidscbas") === 0 || $text == "📄 CAL DID SC GIURIDICHE" || $text == "📄 cal did sc giuridiche")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📄 CALENDARI DIDATTICI"))
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
						'document' => new CURLFile(realpath("./doc/calendarioscienzegiuridiche.pdf")), 
						'caption' => "Calendario Didattico della Scuola di Scienze di Base e Applicate");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}		

// CALENDARIO DIDATTICO SCUOLA MEDICINA

elseif(strpos($text, "/caldidscbas") === 0 || $text == "📄 CAL DID SCUOLA MEDICINA" || $text == "📄 cal did scuola medicina")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📄 CALENDARI DIDATTICI"))
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
						'document' => new CURLFile(realpath("./doc/calendariomedinf1.xls")), 
						'caption' => "Calendario Didattico Infermieristica I ANNO");
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
						'document' => new CURLFile(realpath("./doc/calendariomedinf2.xls")), 
						'caption' => "Calendario Didattico Infermieristica II ANNO");
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
						'document' => new CURLFile(realpath("./doc/calendariomedoste1.pdf")), 
						'caption' => "Calendario Didattico Ostetricia I ANNO");
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
						'document' => new CURLFile(realpath("./doc/calendariomedoste2.pdf")), 
						'caption' => "Calendario Didattico Ostetricia II ANNO");
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
						'document' => new CURLFile(realpath("./doc/calendariomedprofsani1.pdf")), 
						'caption' => "Calendario Didattico Assitenza Sanitaria I ANNO");
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
						'document' => new CURLFile(realpath("./doc/calendariomedprofsani2.pdf")), 
						'caption' => "Calendario Didattico Assitenza Sanitaria II ANNO");
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
						'document' => new CURLFile(realpath("./doc/calendariomedprofsani3.pdf")), 
						'caption' => "Calendario Didattico Assitenza Sanitaria III ANNO");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}	

// CALENDARIO DIDATTICO SCIENZE DI BASE

elseif(strpos($text, "/caldidscbas") === 0 || $text == "📄 CAL DID SC DI BASE" || $text == "📄 cal did sc di base")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","📄 CALENDARI DIDATTICI"))
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
						'document' => new CURLFile(realpath("./doc/calendarioscienzedibase.pdf")), 
						'caption' => "Calendario Didattico della Scuola di Scienze di Base e Applicate");
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}			

// MENU ORARIO LEZIONI TRIENNALE

elseif(strpos($text, "/orariolezionitri") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO LEZIONI TRI" || $text == "\xF0\x9F\x95\x92 orario lezioni tri" || $text == "ORARIO LEZIONI TRI" || $text == "orario lezioni tri")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x91\xA5 MENU STUDENTI"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING","\xF0\x9F\x95\x92 ORARIO CORSI ARCH"),array("\xF0\x9F\x95\x92 ORARIO CORSI ECO","\xF0\x9F\x95\x92 ORARIO CORSI SC UMANE"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC DI BASE"))
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
		 'text' => "\xE2\x9A\xA0 Scegli Corso di Laurea\n\n⭕️ Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI TRI"),array("\xF0\x9F\x95\x92 ORARIO ING INFORMATICA","\xF0\x9F\x95\x92 ORARIO ING GESTIONALE"),array("\xF0\x9F\x95\x92 ORARIO ING ELETTRONICA","\xF0\x9F\x95\x92 ORARIO ING MECCANICA"),array("\xF0\x9F\x95\x92 ORARIO ING ENERGIA","\xF0\x9F\x95\x92 ORARIO ING CHIMICA"),array("\xF0\x9F\x95\x92 ORARIO ING AMBIENTALE","\xF0\x9F\x95\x92 ORARIO ING CIV-EDI"),array("\xF0\x9F\x95\x92 ORARIO ING GEST INF","\xF0\x9F\x95\x92 ORARIO ING CIBERN"),array("\xF0\x9F\x95\x92 ORARIO ING BIOMEDICA"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING INF","📄 MODULO II ING INF"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING GEST","📄 MODULO II ING GEST"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING MEC","📄 MODULO II ING MEC"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING ELE","📄 MODULO II ING ELE"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING ENE","📄 MODULO II ING ENE"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING CHI","📄 MODULO II ING CHI"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING AMB","📄 MODULO II ING AMB"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING CIV","📄 MODULO II ING CIV"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING CIB","📄 MODULO II ING CIB"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING GEST INF","📄 MODULO II ING GEST INF"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING"),array("📄 MODULO I ING BIO","📄 MODULO II ING BIO"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI TRI"),array("\xF0\x9F\x95\x92 ORARIO ARCHITETTURA","\xF0\x9F\x95\x92 ORARIO DIS. INDUSTRIALE","\xF0\x9F\x95\x92 ORARIO SPTUPA"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ARCH"),array("📄 I SEMESTRE ARCHITETTURA"))
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

elseif(strpos($text, "/mod12arch") === 0 || $text == "📄 I SEMESTRE ARCHITETTURA" || $text == "📄 i semestre architettura")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ARCH"),array("📄 I SEMESTRE DIS IND"))
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

elseif(strpos($text, "/mod12disind") === 0 || $text == "📄 I SEMESTRE DIS IND" || $text == "📄 i semestre dis ind")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ARCH"),array("📄 I SEMESTRE SPTUPA"))
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

elseif(strpos($text, "/mod12sptupa") === 0 || $text == "📄 I SEMESTRE SPTUPA" || $text == "📄 i semestre sptupa")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezioni/sptupa/orariolezsptupa.pdf")), 
						'caption' => $text);
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI TRI"),array("\xF0\x9F\x95\x92 ORARIO SC TURISMO","\xF0\x9F\x95\x92 ORARIO STATISTICA"),array("\xF0\x9F\x95\x92 ORARIO ECO AZIENDALE","\xF0\x9F\x95\x92 ORARIO ECO FINANZA","\xF0\x9F\x95\x92 ORARIO ECO SV ECONOMICO"))
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

// ORARIO SCIENZE UMANE

// MENU ORARIO LEZIONI SCIENZE DELLA FORMAZIONE
elseif(strpos($text, "/orariolezscuma") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO CORSI SC UMANE" || $text == "\xF0\x9F\x95\x92 orario corsi sc umane")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI TRI"),array("\xF0\x9F\x95\x92 ORARIO PSICOLOGIA","\xF0\x9F\x95\x92 ORARIO SC COM MEDIA"),array("\xF0\x9F\x95\x92 ORARIO SC COM CULT","\xF0\x9F\x95\x92 ORARIO SC EDU"))
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
			 "keyboard"=> array(array("📄 I SEMESTRE PSICOLOGIA"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC UMANE"))
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
			 "keyboard"=> array(array("📄 I SEMESTRE SC COM MEDIA"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC UMANE"))
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
			 "keyboard"=> array(array("📄 I SEMESTRE SC COM CULT"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC UMANE"))
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
			 "keyboard"=> array(array("📄 I SEMESTRE SC EDU"),array("\xF0\x9F\x95\x92 ORARIO CORSI SC UMANE"))
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI TRI"),array("\xF0\x9F\x95\x92 ORARIO FARMACIA"))
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

// MENU ORARIO LEZIONI MAGISTRALE

elseif(strpos($text, "/orariolezionitri") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO LEZIONI MAG" || $text == "\xF0\x9F\x95\x92 orario lezioni mag" || $text == "ORARIO LEZIONI MAG" || $text == "orario lezioni mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "⭕️ Scegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x91\xA5 MENU STUDENTI"),array("\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"))
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

// MENU ORARIO LEZIONI INGEGNERIA MAGISTRALE 

elseif(strpos($text, "/orariolezingmag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO CORSI ING MAG" || $text == "\xF0\x9F\x95\x92 orario corsi ing mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 'text' => "⭕️ Scegli Corso di Laurea\n\nScegli fra le opzioni sotto\n\n", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO LEZIONI MAG"),array("\xF0\x9F\x95\x92 ORARIO ING INFORMATICA MAG","\xF0\x9F\x95\x92 ORARIO ING GESTIONALE MAG"),array("\xF0\x9F\x95\x92 ORARIO ING AMBIENTALE MAG","\xF0\x9F\x95\x92 ORARIO ING CHIMICA MAG"),array("\xF0\x9F\x95\x92 ORARIO ING MATERIALI MAG","\xF0\x9F\x95\x92 ORARIO ING ELETTRONICA MAG"),array("\xF0\x9F\x95\x92 ORARIO ING CIVILE MAG","\xF0\x9F\x95\x92 ORARIO ING ENERGETICA MAG"),array("\xF0\x9F\x95\x92 ORARIO ING AEROSPAZIALE MAG","\xF0\x9F\x95\x92 ORARIO ING ELETTRICA MAG"),array("\xF0\x9F\x95\x92 ORARIO ING SIS EDILIZI MAG","\xF0\x9F\x95\x92 ORARIO ING TELECOMUNICAZIONI MAG"),array("\xF0\x9F\x95\x92 ORARIO ING MECCANICA MAG","\xF0\x9F\x95\x92 ORARIO ING EDI ARCH MAG"))
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

// ORARIO LEZIONI INGEGNERIA INFORMATICA MAG
elseif(strpos($text, "/inginfmag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING INFORMATICA MAG" || $text == "\xF0\x9F\x95\x92 orario ing informatica mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING INF MAG","📄 MODULO II ING INF MAG"))
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

//SOTTOSEZIONE MODULI ING INF MAG

elseif(strpos($text, "/mod1inginfmag") === 0 || $text == "📄 MODULO I ING INF MAG" || $text == "📄 modulo i ing inf mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/inginf/noLSINF1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2inginfmag") === 0 || $text == "📄 MODULO II ING INF MAG" || $text == "📄 modulo ii ing inf mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/inginf/noLSINF2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA GESTIONALE MAG
elseif(strpos($text, "/inggestmag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING GESTIONALE MAG" || $text == "\xF0\x9F\x95\x92 orario ing gestionale mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING GEST MAG","📄 MODULO II ING GEST MAG"))
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

//SOTTOSEZIONE MODULI ING INF MAG

elseif(strpos($text, "/mod1inggestmag") === 0 || $text == "📄 MODULO I ING GEST MAG" || $text == "📄 modulo i ing gest mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/inggest/noLSGST1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2inggestmag") === 0 || $text == "📄 MODULO II ING GEST MAG" || $text == "📄 modulo ii ing gest mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/inggest/noLSGST2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA AMBIENTALE MAG
elseif(strpos($text, "/ingambmag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING AMBIENTALE MAG" || $text == "\xF0\x9F\x95\x92 orario ing ambientale mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING AMB MAG","📄 MODULO II ING AMB MAG"))
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

//SOTTOSEZIONE MODULI ING AMB MAG

elseif(strpos($text, "/mod1ingambmag") === 0 || $text == "📄 MODULO I ING AMB MAG" || $text == "📄 modulo i ing amb mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingamb/noLSAMB1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingambmag") === 0 || $text == "📄 MODULO II ING AMB MAG" || $text == "📄 modulo ii ing amb mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingamb/noLSAMB2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA CHIMICA MAG
elseif(strpos($text, "/ingchimag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING CHIMICA MAG" || $text == "\xF0\x9F\x95\x92 orario ing chimica mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING CHI MAG","📄 MODULO II ING CHI MAG"))
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

//SOTTOSEZIONE MODULI ING CHI MAG

elseif(strpos($text, "/mod1ingchimag") === 0 || $text == "📄 MODULO I ING CHI MAG" || $text == "📄 modulo i ing chi mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingchi/noLSCHM1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingchimag") === 0 || $text == "📄 MODULO II ING CHI MAG" || $text == "📄 modulo ii ing chi mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingchi/noLSCHM2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA DEI MATERIALI MAG

elseif(strpos($text, "/ingmatmag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING MATERIALI MAG" || $text == "\xF0\x9F\x95\x92 orario ing materiali mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING MAT MAG","📄 MODULO II ING MAT MAG"))
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

//SOTTOSEZIONE MODULI ING MAT MAG

elseif(strpos($text, "/mod1ingmatmag") === 0 || $text == "📄 MODULO I ING MAT MAG" || $text == "📄 modulo i ing mat mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingmat/noLSSTM1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingcmatmag") === 0 || $text == "📄 MODULO II ING MAT MAG" || $text == "📄 modulo ii ing mat mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingmat/noLSSTM2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA ELETTRONICA MAG

elseif(strpos($text, "/ingelemag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING ELETTRONICA MAG" || $text == "\xF0\x9F\x95\x92 orario ing elettronica mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING MAT MAG","📄 MODULO II ING MAT MAG"))
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

//SOTTOSEZIONE MODULI ING ELE MAG

elseif(strpos($text, "/mod1ingelemag") === 0 || $text == "📄 MODULO I ING ELE MAG" || $text == "📄 modulo i ing ele mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingele/noLSELN1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingelemag") === 0 || $text == "📄 MODULO II ING ELE MAG" || $text == "📄 modulo ii ing ele mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingele/noLSELN2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA CIVILE MAG

elseif(strpos($text, "/ingcivmag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING CIVILE MAG" || $text == "\xF0\x9F\x95\x92 orario ing civile mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING CIV MAG","📄 MODULO II ING CIV MAG"))
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

//SOTTOSEZIONE MODULI ING CIV MAG

elseif(strpos($text, "/mod1ingcivmag") === 0 || $text == "📄 MODULO I ING CIV MAG" || $text == "📄 modulo i ing civ mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingciv/noLSCIV1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingcivmag") === 0 || $text == "📄 MODULO II ING CIV MAG" || $text == "📄 modulo ii ing civ mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingciv/noLSCIV2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA ENERGETICA E NUCLEARE MAG

elseif(strpos($text, "/ingcivmag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING ENERGETICA MAG" || $text == "\xF0\x9F\x95\x92 orario ing energetica mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING ENE MAG","📄 MODULO II ING ENE MAG"))
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

//SOTTOSEZIONE MODULI ING ENE MAG

elseif(strpos($text, "/mod1ingenemag") === 0 || $text == "📄 MODULO I ING ENE MAG" || $text == "📄 modulo i ing ene mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingene/noLSENG1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingenemag") === 0 || $text == "📄 MODULO II ING ENE MAG" || $text == "📄 modulo ii ing ene mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingene/noLSENG2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA AEROSPAZIALE MAG

elseif(strpos($text, "/ingaeromag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING AEROSPAZIALE MAG" || $text == "\xF0\x9F\x95\x92 orario ing aerospaziale mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING AERO MAG","📄 MODULO II ING AERO MAG"))
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

//SOTTOSEZIONE MODULI ING AERO MAG

elseif(strpos($text, "/mod1ingaeromag") === 0 || $text == "📄 MODULO I ING AERO MAG" || $text == "📄 modulo i ing aero mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingaero/noLSASP1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingaeromag") === 0 || $text == "📄 MODULO II ING AERO MAG" || $text == "📄 modulo ii ing aero mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingaero/noLSASP2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA ELETTRICA MAG

elseif(strpos($text, "/ingeletmag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING ELETTRICA MAG" || $text == "\xF0\x9F\x95\x92 orario ing elettrica mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING ELET MAG","📄 MODULO II ING ELET MAG"))
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

//SOTTOSEZIONE MODULI ING AERO MAG

elseif(strpos($text, "/mod1ingeletmag") === 0 || $text == "📄 MODULO I ING ELET MAG" || $text == "📄 modulo i ing elet mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingelet/noLSELT1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingeletmag") === 0 || $text == "📄 MODULO II ING ELET MAG" || $text == "📄 modulo ii ing elet mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingelet/noLSELT2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA SIS EDILIZI MAG

elseif(strpos($text, "/ingesisedimag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING SIS EDILIZI MAG" || $text == "\xF0\x9F\x95\x92 orario ing sis edilizi mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING SIS EDI MAG","📄 MODULO II ING SIS EDI MAG"))
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

//SOTTOSEZIONE MODULI ING SIS EDI MAG

elseif(strpos($text, "/mod1ingsisedimag") === 0 || $text == "📄 MODULO I ING SIS EDI MAG" || $text == "📄 modulo i ing sis edi mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingsisedi/noLMSE1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingsisedimag") === 0 || $text == "📄 MODULO II ING SIS EDI MAG" || $text == "📄 modulo ii ing sis edi mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingsisedi/noLMSE2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA TELECOMUNICAZIONI MAG

elseif(strpos($text, "/ingesisedimag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING TELECOMUNICAZIONI MAG" || $text == "\xF0\x9F\x95\x92 orario ing telecomunicazioni mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING TEL MAG","📄 MODULO II ING TEL MAG"))
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

//SOTTOSEZIONE MODULI ING TEL MAG

elseif(strpos($text, "/mod1ingtelmag") === 0 || $text == "📄 MODULO I ING TEL MAG" || $text == "📄 modulo i ing tel mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingtel/noLSTLC1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingtelmag") === 0 || $text == "📄 MODULO II ING TEL MAG" || $text == "📄 modulo ii ing tel mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingtel/noLSTLC2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA MECCANICA MAG

elseif(strpos($text, "/ingesisedimag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING MECCANICA MAG" || $text == "\xF0\x9F\x95\x92 orario ing meccanica mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING MEC MAG","📄 MODULO II ING MEC MAG"))
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

//SOTTOSEZIONE MODULI ING MEC MAG

elseif(strpos($text, "/mod1ingmecmag") === 0 || $text == "📄 MODULO I ING MEC MAG" || $text == "📄 modulo i ing mec mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingmec/noLSMEC1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingmecmag") === 0 || $text == "📄 MODULO II ING MEC MAG" || $text == "📄 modulo ii ing mec mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingmec/noLSMEC2.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

// ORARIO LEZIONI INGEGNERIA EDILE - ARCHITETTURA MAG

elseif(strpos($text, "/ingesisedimag") === 0 || $text == "\xF0\x9F\x95\x92 ORARIO ING EDI ARCH MAG" || $text == "\xF0\x9F\x95\x92 orario ing edi arch mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x95\x92 ORARIO CORSI ING MAG"),array("📄 MODULO I ING EDI ARCH MAG","📄 MODULO II ING EDI ARCH MAG"))
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

//SOTTOSEZIONE MODULI ING EDI ARCH MAG

elseif(strpos($text, "/mod1ingediarchmag") === 0 || $text == "📄 MODULO I ING EDI ARCH MAG" || $text == "📄 modulo i ing edi arch mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingediarch/noLSEDA1.pdf")), 
						'caption' => $text);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
	curl_setopt($ch, CURLOPT_URL, $botUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
	// read curl response
	$output = curl_exec($ch);
	
}

elseif(strpos($text, "/mod2ingediarchmag") === 0 || $text == "📄 MODULO II ING EDI ARCH MAG" || $text == "📄 modulo ii ing edi arch mag")
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
						'document' => new CURLFile(realpath("./orariolezionimag/ingediarch/noLSEDA2.pdf")), 
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
		 'text' => "\xF0\x9F\x8F\xA6 Menu Biblioteche \xF0\x9F\x8F\xA6\n\n".$firstname.", che Biblioteca vuoi visitare?", 
		 'reply_markup' => array(
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","ℹ️ INFO SISTEMA BIBLIOTECARIO"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA CENTR. INGEGNERIA","\xF0\x9F\x8F\xA6 BIBLIOTECA LETTERE"),array("\xF0\x9F\x8F\xA6 SALA LETTURA WURTH","\xF0\x9F\x8F\xA6 BIBLIOTECA ARCHITETTURA"),array("\xF0\x9F\x8F\xA6 EMEROTECA ARCH","\xF0\x9F\x8F\xA6 BIBLIOTECA CLA"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA FIS CHIM ARCHIRAFI","\xF0\x9F\x8F\xA6 BIBLIOTECA DICAM"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA IDRAULICA","\xF0\x9F\x8F\xA6 BIBLIOTECA GEOTECNICA"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA CHIMICA ED.6","\xF0\x9F\x8F\xA6 BIBLIOTECA ED.9 2° PIANO"),array("\xF0\x9F\x8F\xA6 BIBLIOTECA ARCHITETTURA (ED.8)")),
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

// INFO SISTEMA BIBLIOTECARIO

elseif(strpos($text, "/infosisbiblio") === 0 || $text == "ℹ️ INFO SISTEMA BIBLIOTECARIO" || $text == "ℹ️ info sistema bibliotecario" )
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "Per le info sui servizi bibliotecari visita http://www.unipa.it/biblioteche/Formazione-degli-utenti-corsi-guide-e-tutorial/\n\nPer accedere al catalogo bibliografico online visita http://aleph22.unipa.it:8991/F", 
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
		 	'text' => "\xF0\x9F\x95\x92 Orari Esercizio:\n\nLun-Ven dalle 8.30 alle 22\n\nDa Settembre a Luglio\n\nℹ️ Info Utili\n\nPotete richiedere il rinnovo dei libri in scadenza mandando una e-mail a bibling@unipa.it oppure chiamando il numero 091/23862001\n\nPer prenotare un posto in sala rossa ved il link sotto\n\nhttp://biblioing.unipa.it:8080/engine/BookingEngine", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("📘 POSTI DISPONIBILI SALA LETTURA BIB ING"),array("🏠 MENU PRINCIPALE","📖 BIBLIO"))
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

// 📘 POSTI DISPONIBILI SALA LETTURA BIB ING

elseif(strpos($text, "/postidisp") === 0 || $text == "📘 POSTI DISPONIBILI SALA LETTURA BIB ING" || $text == "📘 posti disponibili sala lettura bib ing" )
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "Per visualizzare i posti disponibili nella Sala Lettura clicca sul link sotto ⤵\n\nhttp://polib.unipa.it/enus_distroweb/politecnico/BINGE/enus_new/mappa.php", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x8F\xA6 BIBLIOTECA CENTR. INGEGNERIA"),array("📖 BIBLIO"))
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

// MENU ORARI BIBLIOTECA ARCHITETTURA (ED.8)
elseif(strpos($text, "/biblioing") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA ARCHITETTURA (ED.8)" || $text == "\xF0\x9F\x8F\xA6 biblioteca architettura (ed.8)" )
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "Si trova accanto la Biblioteca di Geotecnica sotto il primo portico dell'Ed.8\n\n\xF0\x9F\x95\x92 Orari Esercizio:\n\nLun-Gio dalle 8.30 alle 17\n\nVen dalle 8.30 alle 13:30\n\nDa Settembre a Luglio", 
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

// MENU ORARI BIBLIOTECA IDRAULICA
elseif(strpos($text, "/bibliodidra") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA IDRAULICA" || $text == "\xF0\x9F\x8F\xA6 biblioteca idraulica" )
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "\xF0\x9F\x95\x92 Orari Esercizio:\n\nLun-Gio dalle 8.30 alle 17\n\nVen dalle 8.30 alle 13:30\n\nDa Settembre a Luglio\n\n", 
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


// MENU ORARI BIBLIOTECA GEOTECNICA
elseif(strpos($text, "/bibliogeo") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA GEOTECNICA" || $text == "\xF0\x9F\x8F\xA6 biblioteca geotecnica" )
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "Si trova presso l'Edificio 8 sotto il primo portico (posizione precisa sotto)\n\n\xF0\x9F\x95\x92 Orari Esercizio:\n\nLun-Ven dalle 8:30 alle 17:00\n\nDa Settembre a Luglio\n\nℹ️ Info Utili\n\n\xF0\x9F\x95\x92 Orario Esercizio mesi di Luglio e Agosto: dal Lunedì al Venerdì 8:30 - 14:30\n\n📌 Chiusura: dal 8 al 26 agosto 2016 e dal 23 dicembre 2016 al 1° gennaio 2017", 
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

// MENU ORARI BIBLIOTECA CHIMICA ED.6
elseif(strpos($text, "/biblioched6") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA CHIMICA ED.6" || $text == "\xF0\x9F\x8F\xA6 biblioteca chimica ed.6" )
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "Si trova presso l'Edificio 6 ingresso Dip.Chimica e Imp.Nucleari (posizione precisa sotto)\n\n\xF0\x9F\x95\x92 Orari Esercizio:\n\nLun-Gio dalle 8:30 alle 13:30\n\nDa Settembre a Luglio\n\n", 
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
						'latitude' => "38.1065202", 
						'longitude' => "13.350356");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);

}

// MENU ORARI BIBLIOTECA ED.9 2° PIANO
elseif(strpos($text, "/biblioed9") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA ED.9 2° PIANO" || $text == "\xF0\x9F\x8F\xA6 biblioteca ed.9 2° piano" )
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "Si trova al secondo piano dell'Edificio 9 salendo dalle scale di SX (posizione precisa sotto)\n\n\xF0\x9F\x95\x92 Orari Esercizio:\n\nLun-Ven dalle 8:30 alle 13:30\n\nDa Settembre a Luglio\n\n", 
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
						'latitude' => "38.1040381", 
						'longitude' => "13.3450416");
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

// MENU ORARI BIBLIOTECA DICAM
elseif(strpos($text, "/biblioexarch") === 0 || $text == "\xF0\x9F\x8F\xA6 BIBLIOTECA DICAM" || $text == "\xF0\x9F\x8F\xA6 biblioteca dicam" )
{
	$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "La ".$text." si trova presso l'Edificio 8 al Piano Terra sotto il porticato (Sotto la posizione precisa) e offre ampi e luminosi spazi per lo studio\n\n🕒 Orari Esercizio:\n\nLun-Gio dalle 08:30 alle 17:00\nVen dalle 08:30 alle 13:30\n\nℹ️ Info Utili\n\nChiusura dal 12 al 26 agosto 2016; dal 23 dicembre 2016 al 5 gennaio 2017\nOrario mesi di Luglio e Agosto: dal lunedì al venerdì 8.30-14.30\n\n\xF0\x9F\x93\x9E Tel 09123896204 / 62108\n\n✉️ Email: biblioteca.architettura@unipa.it", 
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xE2\x9A\xA0 SEGNALA PROF"),array())
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
		
		$response = "Se il prof che cerchi non è stato trovato contatta @gabrieledellaria riportando Nome,Cognome e Facoltà del Prof da inserire";
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

	elseif(strpos($text, "/profgiarre") === 0 || $text == "Giarre" || $text == "giarre" || $text == "Giarré" || $text == "giarré"|| $text == "Prof Giarre" || $text == "prof giarre" || $text == "Prof Giarré" || $text == "prof giarré")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$response = "\xF0\x9F\x91\xA4 Nome: Laura \n\n\xF0\x9F\x91\xA4 Cognome: Giarrè \n\n\xF0\x9F\x8F\xA6 Ufficio: Ed.9\n\n📝 Ricevimento: Martedì dalle 18:00 alle 19:00 presso DEIM - Edificio 9\n\nMercoledì dalle 8:30 alle 10:30 presso DEIM - Edificio 9\n\n✉️ Contatti: laura.giarre@unipa.it";
	}

	elseif( $text == "Fagiolini" || $text == "fagiolini" || $text == "Prof Fagiolini" || $text == "prof fagiolini" )
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$response = "\xF0\x9F\x91\xA4 Nome: Adriano \n\n\xF0\x9F\x91\xA4 Cognome: Fagiolini \n\n\xF0\x9F\x8F\xA6 Ufficio: Ed.10\n\n📝 Ricevimento: Giovedì dalle 9:30 alle 12:30 presso Viale delle Scienze, Edificio 10\n\n✉️ Contatti: adriano.fagiolini@unipa.it - +3909123863613";
	}

		elseif( $text == "Vassallo" || $text == "vassallo" || $text == "Prof Vassallo" || $text == "prof vassallo" )
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$response = "\xF0\x9F\x91\xA4 Nome: Giorgio \n\n\xF0\x9F\x91\xA4 Cognome: Vassallo \n\n\xF0\x9F\x8F\xA6 Ufficio: Ed.6\n\n📝 Ricevimento: Martedì dalle 11:00 alle 13:00 presso Viale delle Scienze, Ed. 6 terzo piano\n\n✉️ Contatti: giorgio.vassallo@unipa.it - +3909123862637";
	}

	elseif( $text == "Lo Presti" || $text == "lo presti" || $text == "Prof Lo Presti" || $text == "prof lo presti" )
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$response = "\xF0\x9F\x91\xA4 Nome: Liliana \n\n\xF0\x9F\x91\xA4 Cognome: Lo Presti \n\n\xF0\x9F\x8F\xA6 Ufficio: Ed.6\n\n📝 Ricevimento: Martedì dalle 15:00 alle 18:00 presso Ufficio del docente (DIID, V.le delle Scienze Ed.6 III piano, stanza n. 7)\n\n✉️ Contatti: liliana.lopresti@unipa.it - +3909123899526";
	}

	elseif( $text == "Sorbello" || $text == "sorbello" || $text == "Prof Sorbello" || $text == "prof sorbello" )
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$response = "\xF0\x9F\x91\xA4 Nome: Rosario \n\n\xF0\x9F\x91\xA4 Cognome: Sorbello \n\n\xF0\x9F\x8F\xA6 Ufficio: Ed.6\n\n📝 Ricevimento: Lunedì dalle 11:00 alle 13:00 presso Stanza del Professore, Edificio 6, terzo piano\n\n✉️ Contatti: rosario.sorbello@unipa.it - +3909123862635\n\nE' consigliabile contattarlo via WhatsApp";
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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 	'chat_id' => $chatId, 
		 	'text' => "\xF0\x9F\x8F\xAC SEGRETERIA STUDENTI \xF0\x9F\x92\xAC\n\nSi trova in Viale delle Scienze, Ed. 3\n\n\xF0\x9F\x95\x92 Orari Esercizio\n\nLunedì, Mercoledì, Venerdì dalle ore 09.00 alle ore 13.00\nMartedì e Giovedì dalle ore 15.00 alle ore 17.00 (escluso Luglio e Agosto)\n\n\xF0\x9F\x93\x9E CONTATTI \n\nEmail: segreterie.studenti@unipa.it\nTel. +3909123867526\nTel.2 +3909123886472\nFax. +3909123860506", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("\xF0\x9F\x91\xA5 MENU STUDENTI","🔍 CERCA AULA","\xF0\x9F\x91\xA4 INFO PROF"),array("\xF0\x9F\x8F\xAC SEGRET","📖 BIBLIO","\xF0\x9F\x8F\xA2 DIPART"),array("\xF0\x9F\x8F\xA8 ERSU \xF0\x9F\x92\xB6","\xF0\x9F\x93\x84 COPIST","\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7"),array("\xF0\x9F\x8D\x9D MENSA","\xF0\x9F\x8D\x94 RISTORO","\xE2\x98\x95 CAFFE"),array("\xF0\x9F\x8C\x8E MAPPA","🚈 TRASP","🚽 BAGNI"),array("↕ EVENTI","🖥 NEWS","🌥 METEO"),array("📘 CATALOGO ONLINE 💻"),array("🔧 CMD RAPIDI","ℹ️ INFO BOT")),
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

		$botToken="240736726:AAHGVsRYjCUw8LZOcs7BD9L9c_vcVY1xBIs";
		$method='sendMessage';
	
		$postField = array(
		 	'chat_id' => $chatId, 
		 	'text' => "\xF0\x9F\x93\x96 CLA \xF0\x9F\x87\xAC\xF0\x9F\x87\xA7 \n\nSi trova in Piazza S. Antonino, 1 90134 PALERMO (PA)\n\n\xF0\x9F\x93\x9E CONTATTI \n\n+39 0916169615 - +39 09123899263 cla@unipa.it", 
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xE2\x98\x95 MACCH. ED.8"),array("\xE2\x98\x95 MACCH. ED.9","\xE2\x98\x95 MACCH. ED.6"),array("\xE2\x98\x95 MACCH. ED.12","\xE2\x98\x95 MACCH. ED.13"))
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

// MACCH.ED.8
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
		
		$response = "ℹ️ Le macchinette si trovano al primo piano quasi alla fine del corridoio all'altezza della F170 e alla fine del corridoio sulla sinistra\n\nAl secondo piano dentro l'Auletta di Vivere Ingegneria";
	}

// MACCH.ED.9
elseif(strpos($text, "/macchcaffeed9") === 0 || $text == "\xE2\x98\x95 MACCH. ED.9" || $text == "\xE2\x98\x95 macch. ed.9")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$response = "ℹ️ Le macchinette si trovano al Piano Terra subito dopo l'entrata dell'edificio e al Primo Piano vicino la U110";
	}

// MACCH.ED.6
elseif(strpos($text, "/macchcaffeed6") === 0 || $text == "\xE2\x98\x95 MACCH. ED.6" || $text == "\xE2\x98\x95 macch. ed.6")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$response = "🏦 DIP. CHIMICA: Le macchinette si trovano al Piano Terra subito dopo l'entrata dell'edificio\n\n🏦 DIFO: Le macchinette si trovano al 3° Piano";
	}

// MACCH.ED.13

elseif(strpos($text, "/macchcaffeed13") === 0 || $text == "\xE2\x98\x95 MACCH. ED.13" || $text == "\xE2\x98\x95 macch. ed.13")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$response = "ℹ️ Le macchinette si trovano al Piano Terra subito dopo l'entrata dal primo ingresso dell'edificio";
	}

// MACCH.ED.12

elseif(strpos($text, "/macchcaffeed12") === 0 || $text == "\xE2\x98\x95 MACCH. ED.12" || $text == "\xE2\x98\x95 macch. ed.12")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
		$postFields = array('chat_id' => $chatId, 
						'action' => 'typing');
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
		$response = "ℹ️ Le macchinette si trovano al Piano Terra in fondo al corridoio d'ingresso";
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
			 "keyboard"=> array(array("🏠 MENU PRINCIPALE","\xF0\x9F\x93\x84 LA NUOVA COPISTERIA ING."),array("\xF0\x9F\x93\x84 COPISTERIA LETTERE","\xF0\x9F\x93\x84 COPISTERIA AGORA"),array("\xF0\x9F\x93\x84 LA NUOVA COPISTERIA BIO","\xF0\x9F\x93\x84 COPISTERIA ARCH"),array("\xF0\x9F\x93\x84 COPISTERIA DA.MI.RA"))
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

// COPISTERIA DA.MI.RA
	
elseif(strpos($text, "/copdamira") === 0 || $text == "\xF0\x9F\x93\x84 COPISTERIA DA.MI.RA" || $text == "\xF0\x9F\x93\x84 copisteria da.mi.ra")
	{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => $text."\n\n🕒 Orari Esercizio\n\nDa Lunedì a Venerdì dalle 8.00 alle 13:30 e dalle 15:00 alle 19:30\n\nSabato dalle 8:00 alle 13:00\n\nNota: nel mese di agosto dalle 8:30 alle 13 tutti i giorni\n\n📞 Contatti:  091421125\n\n💻 Sito Web: http://www.damira.net/", 
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
						'latitude' => "38.107339", 
						'longitude' => "13.35294");
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
		curl_setopt($ch, CURLOPT_URL, $botUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
		// read curl response
		$output = curl_exec($ch);
		
	}			

	// BAGNI

elseif(strpos($text, "/bagni") === 0 || $text == "🚽 BAGNI" || $text == "🚽 bagni")
{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "⚠️ Scegli fra le opzioni sotto", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚽 BAGNI ED.8"),array("🚽 BAGNI ED.9","🚽 BAGNI ED.6 CHIMICA","🚽 BAGNI ED.6 DINFO"))
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

elseif(strpos($text, "/bagnied8") === 0 || $text == "🚽 BAGNI ED.8" || $text == "🚽 bagni ed.8")
{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "I ".$text." sono al 2° Piano accanto al corridoio aperto che porta alla F120 e al 3° Piano vicino ai tavolini studio", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚽 BAGNI"))
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

elseif(strpos($text, "/bagnied9") === 0 || $text == "🚽 BAGNI ED.9" || $text == "🚽 bagni ed.9")
{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "I ".$text." sono a Piano Terra vicino alle scale", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚽 BAGNI"))
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

elseif(strpos($text, "/bagnied6ch") === 0 || $text == "🚽 BAGNI ED.6 CHIMICA" || $text == "🚽 bagni ed.6 chimica")
{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "I ".$text." sono al Piano Terra vicino all'Aula B010", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚽 BAGNI"))
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

elseif(strpos($text, "/bagnied6dinfo") === 0 || $text == "🚽 BAGNI ED.6 DINFO" || $text == "🚽 bagni ed.6 dinfo")
{
		$message = isset($update['message']) ? $update['message'] : "";
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		$text = isset($message['text']) ? $message['text'] : "";
		$botUrl = "https://api.telegram.org/bot" . BOT_TOKEN . "/sendChatAction";
		// change file name and path
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
		 	'text' => "I ".$text." al 2° Piano vicino alla A220 e al 3° Piano vicino alla A320", 
		 	'reply_markup' => array(
				 "keyboard"=> array(array("🏠 MENU PRINCIPALE","🚽 BAGNI"))
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



//else
//{
//	$response = "\xE2\x9A\xA0 Il comando che hai eseguito non è valido!\n\nDigita /help per il mio elenco comandi";
//}
	

//$parameters = array('chat_id' => $chatId, "text" => $response);
//$parameters["method"] = "sendMessage";
//echo json_encode($parameters);
