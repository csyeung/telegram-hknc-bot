<?php

/*
* This file is part of GeeksWeb Bot (GWB).
*
* GeeksWeb Bot (GWB) is free software; you can redistribute it and/or modify
* it under the terms of the GNU General Public License version 3
* as published by the Free Software Foundation.
*
* GeeksWeb Bot (GWB) is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.  <http://www.gnu.org/licenses/>
*
* Author(s):
*
* © 2015 Kasra Madadipouya <kasra@madadipouya.com>
*
*/
require 'vendor/autoload.php';

$client = new Zelenin\Telegram\Bot\Api('421429408:AAG3zXljBxWbCPr6XIeLZ3jUU0p1_djolDU'); // Set your access token
$url = 'https://rss-weather.yahoo.co.jp/rss/days/4310.xml'; // URL RSS feed
$content = file_get_contents('php://input');
$update = json_decode($content);

// Application Starts Here
try {
  $text = $update->message->text;
  $chatId = $update->message->chat->id;

    if (strpos($text, '/email') !== false)
    {
    	$response = $client->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
    	$response = $client->sendMessage([
        	'chat_id' => $chatId,
        	'text' => "You can send email to : psycohk@hotmail.com"
     	]);
    }
    else if (strpos($text, '/fuckoff') !== false)
    {
      $response = $client->sendChatAction(['chat_id' => $chatId, 'action' =>
      'typing']);
      $response = $client->sendMessage(['chat_id' => $chatId, 'text' => "你老母可否安好﹗"]);
    }
    else if (strpos($text, '/help') !== false)
    {
    	$response = $client->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $chatId,
    		'text' => "List of commands :\n /email -> Get email address of the owner \n /latest -> Get latest posts of the blog \n /help -> Shows list of available commands"
    		]);

    }
    else if (strpos($text, '/latest') !== false)
    {
    		Feed::$cacheDir 	= __DIR__ . '/cache';
			Feed::$cacheExpire 	= '5 hours';
			$rss 		= Feed::loadRss($url);
			$items 		= $rss->item;
			$lastitem 	= $items[0];
			$lastlink 	= $lastitem->link;
			$lasttitle 	= $lastitem->title;
			$message = $lasttitle . " \n ". $lastlink;
			$response = $client->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
			$response = $client->sendMessage([
					'chat_id' => $chatId,
					'text' => $message
				]);

    }
    else if (strpos($text, '早晨') !== false)
    {
      $response = $client->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $chatId,
    		'text' => "各位谷友早晨"
    		]);
    }
    else
    {
    	$response = $client->sendChatAction(['chat_id' => $chatId, 'action' => 'typing']);
    	$response = $client->sendMessage([
    		'chat_id' => $chatId,
    		'text' => "Invalid command, please use /help to get list of available commands"
    		]);
    }

} catch (\Zelenin\Telegram\Bot\NotOkException $e) {

    //echo error message ot log it
    //echo $e->getMessage();

}
