<?php
// exaples/tossbot.php

require __DIR__ . '/../src/PhpGram.php';


use PhpGram\PhpGram;

// Replace with your bot token
$botToken = '<bot token>'; // Make sure to replace this with your actual bot token
$bot = new PhpGram($botToken);
$botlogger = "-1002182782769"; // Optional chat ID for logging messages (send group ID , channel ID or user ID get it by opening group in web.telegram.org) - Make sure to replace this with your actual chat ID

// URL of the Telegram API for sending messages is not needed to be stored as a variable since it's not used elsewhere

// Get the incoming message and chat ID
$update = json_decode(file_get_contents('php://input'), true);
$chatId = $update['message']['chat']['id'];
// $messageId is not used in this script, so it can be removed to clean up the code
$command = trim($update['message']['text']);

// Command to handle
if ($command == '/flipcoin') {
    // Generate random number (0 or 1)
    $random = mt_rand(0, 1);

    // Determine the result
    $result = ($random == 0) ? "https://imagecdn.app/v1/images/https%3A%2F%2Fpics.shade.cool%2Fapi%2Fimages%2Fj22gcmxu7la47n3rbnb4ih" : "https://imagecdn.app/v1/images/https%3A%2F%2Fpics.shade.cool%2Fapi%2Fimages%2Fdfvyolmbeynvtnluncmq";
    // Send the result
    $bot->sendPhoto($chatId, $result, 'The coin flipped! /flipcoin again? 🪙 or /rolladice 🎲 ');
    $bot->sendPhoto($botlogger, $result, 'The coin flipped! /flipcoin again? 🪙 or /rolladice 🎲 ');

} elseif ($command == '/rolladice') {
    // Generate random number (1 to 6)
    $random = mt_rand(1, 6);

    // Determine the result
    $result = "https://cdn.statically.io/og/" . $random . ".png"; // Fixed concatenation issue

    // Send the result
    $bot->sendPhoto($chatId, $result, 'The dice rolled: ' . $random . ' 🎲 /rolladice again? or /flipcoin 🪙');
    $bot->sendPhoto($botlogger, $result, 'The dice rolled: ' . $random . ' 🎲 /rolladice again? or /flipcoin 🪙');

} elseif ($command == '/start') {
    // Send a welcome message
    $bot->sendMessage($chatId, 'Welcome to the bot! ✨ You can use the following commands: /flipcoin, /rolladice');
    $bot->sendMessage($botlogger, 'Welcome to the bot! ✨ You can use the following commands: /flipcoin, /rolladice - ' . $chatId);
    // The following lines are not needed for the /start command and can cause confusion
    // $result = ($random == 0) ? "https://imagecdn.app/v1/images/https%3A%2F%2Fpics.shade.cool%2Fapi%2Fimages%2Fj22gcmxu7la47n3rbnb4ih" : "https://imagecdn.app/v1/images/https%3A%2F%2Fpics.shade.cool%2Fapi%2Fimages%2Fdfvyolmbeynvtnluncmq";
    // $bot->sendPhoto($chatId, $result, 'A coin flip! 🪙');

} else {
    // Send a message for invalid commands
    $bot->sendMessage($chatId, 'Invalid command! Please use one of the following commands: /flipcoin, /rolladice');
}
