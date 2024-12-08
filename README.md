# PhpGram

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/SH20RAJ/phpgram/blob/main/LICENSE)
[![PHP](https://img.shields.io/badge/PHP-%3E%3D%207.0-8892BF.svg)](https://www.php.net/)
[![Telegram Bot API](https://img.shields.io/badge/Telegram%20Bot%20API-%3E%3D%205.0-0088cc.svg)](https://core.telegram.org/bots/api)
[![Visitors](https://api.visitorbadge.io/api/visitors?path=https%3A%2F%2Fgithub.com%2FSH20RAJ%2Fphpgram&labelColor=%232ccce4&countColor=%23f47373&style=flat-square)](https://visitorbadge.io/status?path=https%3A%2F%2Fgithub.com%2FSH20RAJ%2Fphpgram)
[![Latest Stable Version](https://img.shields.io/packagist/v/sh20raj/phpgram.svg?style=flat-square)](https://packagist.org/packages/sh20raj/phpgram)


PhpGram is a PHP library for interacting with the Telegram Bot API, providing easy-to-use methods for sending messages, media, managing chats, stickers, inline queries, payments, and more.

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
  - [Initialization](#initialization)
  - [Basic Usage](#basic-usage)
  - [Sending Messages and Media](#sending-messages-and-media)
  - [Managing Chats and Members](#managing-chats-and-members)
  - [Handling Stickers](#handling-stickers)
  - [Inline Mode](#inline-mode)
  - [Payments](#payments)
  - [Games](#games)
  - [Handling Updates](#handling-updates)
- [Contributing](#contributing)
- [License](#license)

## Installation

Install PhpGram via [Composer](https://packagist.org/packages/sh20raj/phpgram):

```bash
composer require sh20raj/phpgram
```

Alternatively, you can clone the repository:

```bash
git clone https://github.com/SH20RAJ/phpgram.git
```

## Usage

### Initialization

First, include the library in your PHP file and initialize `PhpGram` with your bot token:

```php
require __DIR__ . '/../src/PhpGram.php';

use PhpGram\PhpGram;

$token = 'YOUR_BOT_TOKEN';
$bot = new PhpGram($token);
```

### Basic Usage

> Try Example: [Toss Bot](./examples/tossbot.php) (Toss a coin and get the result or roll a dice)

```php
// Example: Get bot information
$botInfo = $bot->getMe();
echo 'Bot Username: ' . $botInfo['result']['username'] . PHP_EOL;
```

### Sending Messages and Media

#### Sending Text Messages

```php
// Send a text message
$chatId = 'YOUR_CHAT_ID';
$message = 'Hello from PhpGram!';
$response = $bot->sendMessage($chatId, $message);
```

#### Sending Photos

```php
// Send a photo
$photoPath = 'path/to/photo.jpg';
$response = $bot->sendPhoto($chatId, $photoPath, ['caption' => 'Check out this photo!']);
```

#### Sending Audio

```php
// Send an audio file
$audioPath = 'path/to/audio.mp3';
$response = $bot->sendAudio($chatId, $audioPath, ['caption' => 'Listen to this audio!']);
```

#### Sending Documents

```php
// Send a document
$documentPath = 'path/to/document.pdf';
$response = $bot->sendDocument($chatId, $documentPath, ['caption' => 'Here is your document.']);
```

#### Sending Videos

```php
// Send a video
$videoPath = 'path/to/video.mp4';
$response = $bot->sendVideo($chatId, $videoPath, ['caption' => 'Watch this video!']);
```

#### Sending Animations

```php
// Send an animation
$animationPath = 'path/to/animation.gif';
$response = $bot->sendAnimation($chatId, $animationPath, ['caption' => 'Enjoy this animation!']);
```

#### Sending Voice Messages

```php
// Send a voice message
$voicePath = 'path/to/voice.ogg';
$response = $bot->sendVoice($chatId, $voicePath, ['caption' => 'Listen to this voice message!']);
```

#### Sending Video Notes

```php
// Send a video note
$videoNotePath = 'path/to/video_note.mp4';
$response = $bot->sendVideoNote($chatId, $videoNotePath);
```

#### Sending Media Groups

```php
// Send a media group
$mediaGroup = [
    ['type' => 'photo', 'media' => 'path/to/photo1.jpg'],
    ['type' => 'photo', 'media' => 'path/to/photo2.jpg'],
];
$response = $bot->sendMediaGroup($chatId, $mediaGroup);
```

#### Sending Locations

```php
// Send a location
$response = $bot->sendLocation($chatId, 40.712776, -74.005974); // New York City coordinates
```

#### Sending Venues

```php
// Send a venue
$response = $bot->sendVenue($chatId, 40.712776, -74.005974, 'Venue Name', 'Venue Address');
```

#### Sending Contacts

```php
// Send a contact
$response = $bot->sendContact($chatId, 'PHONE_NUMBER', 'FirstName', ['last_name' => 'LastName']);
```

#### Sending Polls

```php
// Send a poll
$response = $bot->sendPoll($chatId, 'Your Question?', ['Option 1', 'Option 2']);
```

#### Sending Dice

```php
// Send a dice
$response = $bot->sendDice($chatId);
```

### Managing Chats and Members

```php
// Kick a member from a chat
$userId = 'USER_ID_TO_KICK';
$response = $bot->kickChatMember($chatId, $userId);

// Unban a member from a chat
$response = $bot->unbanChatMember($chatId, $userId);

// Restrict a member in a chat
$permissions = ['can_send_messages' => false];
$response = $bot->restrictChatMember($chatId, $userId, $permissions);

// Promote a member to an admin
$response = $bot->promoteChatMember($chatId, $userId);

// Set custom title for an admin
$response = $bot->setChatAdministratorCustomTitle($chatId, $userId, 'Custom Title');
```

### Handling Stickers

```php
// Send a sticker
$stickerPath = 'path/to/sticker.webp';
$response = $bot->sendSticker($chatId, $stickerPath);

// Get a sticker set
$stickerSetName = 'sticker_set_name';
$response = $bot->getStickerSet($stickerSetName);

// Upload a sticker file
$stickerFilePath = 'path/to/sticker.png';
$response = $bot->uploadStickerFile($userId, $stickerFilePath);

// Create a new sticker set
$stickerParams = [
    'name' => 'sticker_set_name',
    'title' => 'Sticker Set Title',
    'png_sticker' => 'path/to/sticker.png',
    'emojis' => '😀',
];
$response = $bot->createNewStickerSet($userId, $stickerParams);

// Add a sticker to a set
$response = $bot->addStickerToSet($userId, 'sticker_set_name', 'path/to/sticker.png', '😀');

// Set sticker position in a set
$response = $bot->setStickerPositionInSet('sticker_file_id', 0);

// Delete a sticker from a set
$response = $bot->deleteStickerFromSet('sticker_file_id');
```

### Inline Mode

```php
// Answer an inline query
$inlineQueryId = 'INLINE_QUERY_ID';
$results = [ /* Array of InlineQueryResult objects */ ];
$response = $bot->answerInlineQuery($inlineQueryId, $results);
```

### Payments

```php
// Send an invoice
$invoiceParams = [
    'title' => 'Product Name',
    'description' => 'Description of the product',
    'payload' => 'unique_payload',
    'provider_token' => 'PROVIDER_PAYMENT_TOKEN',
    'start_parameter' => 'start_param',
    'currency' => 'USD',
    'prices' => json_encode([ ['label' => 'Product Price', 'amount' => 1000] ]),
];
$response = $bot->sendInvoice($chatId, $invoiceParams);

// Answer a shipping query
$shippingQueryId = 'SHIPPING_QUERY_ID';
$response = $bot->answerShippingQuery($shippingQueryId, true);

// Answer a pre-checkout query
$preCheckoutQueryId = 'PRE_CHECKOUT_QUERY_ID';
$response = $bot->answerPreCheckoutQuery($preCheckoutQueryId, true);
```

### Games

```php
// Send a game
$gameShortName = 'game_short_name';
$response = $bot->sendGame($chatId, $gameShortName);

// Set game score
$response = $bot->setGameScore($userId, 100);

// Get game high scores
$response = $bot->getGameHighScores($userId);
```

### Handling Updates

```php
// Get updates
$updates = $bot->getUpdates();

// Set a webhook
$response = $bot->setWebhook('https://yourdomain.com/webhook');

// Delete a webhook
$response = $bot->deleteWebhook();

// Get webhook info
$response = $bot->getWebhookInfo();
```

## Contributing

Contributions are welcome! Fork the repository, make your changes, and submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](https://github.com/SH20RAJ/phpgram/blob/main/LICENSE) file for details.

---

### Important Links

> https://dev.to/sh20raj/how-to-create-a-telegram-bot-using-php-4hbd

> https://dev.to/sh20raj/phpgram-a-php-library-for-interacting-with-the-telegram-bot-api-3pip

> Video Documentation :- https://www.youtube.com/watch?v=FNnruIqvJDc
