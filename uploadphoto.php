<?php

$content = file_get_contents("php://input");
$update = json_decode($content, true);

$botToken = "254111121:AAE898EquNqARS_8UpwVepo131EdLNXLm2o";
$website = "https://api.telegram.org/bot".$botToken;

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

?>

<form action="<?php echo $website."/sendphoto" ?>" method="post" enctype="multipart/form-data">

	<input type="text" name="chat_id" value="001" />
	<input type="file" name="photo" />
	<input type="submit" value="send" />

</form> 