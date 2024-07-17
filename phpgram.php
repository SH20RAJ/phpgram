<?php

class PhpGram {
    private $token;
    private $apiUrl = "https://api.telegram.org/bot";

    public function __construct($token) {
        $this->token = $token;
        $this->apiUrl .= $token . '/';
    }

    // Basic methods

    public function getMe() {
        return $this->sendRequest('getMe');
    }

    public function sendMessage($chatId, $text, $params = []) {
        $params['chat_id'] = $chatId;
        $params['text'] = $text;
        return $this->sendRequest('sendMessage', $params);
    }

    public function sendPhoto($chatId, $photo, $caption = '', $params = []) {
        $params['chat_id'] = $chatId;
        $params['photo'] = $photo;
        $params['caption'] = $caption;
        return $this->sendRequest('sendPhoto', $params);
    }

    public function sendDocument($chatId, $document, $caption = '', $params = []) {
        $params['chat_id'] = $chatId;
        $params['document'] = $document;
        $params['caption'] = $caption;
        return $this->sendRequest('sendDocument', $params);
    }

    public function sendAudio($chatId, $audio, $caption = '', $params = []) {
        $params['chat_id'] = $chatId;
        $params['audio'] = $audio;
        $params['caption'] = $caption;
        return $this->sendRequest('sendAudio', $params);
    }

    public function sendVideo($chatId, $video, $caption = '', $params = []) {
        $params['chat_id'] = $chatId;
        $params['video'] = $video;
        $params['caption'] = $caption;
        return $this->sendRequest('sendVideo', $params);
    }

    public function sendAnimation($chatId, $animation, $caption = '', $params = []) {
        $params['chat_id'] = $chatId;
        $params['animation'] = $animation;
        $params['caption'] = $caption;
        return $this->sendRequest('sendAnimation', $params);
    }

    public function sendVoice($chatId, $voice, $caption = '', $params = []) {
        $params['chat_id'] = $chatId;
        $params['voice'] = $voice;
        $params['caption'] = $caption;
        return $this->sendRequest('sendVoice', $params);
    }

    public function sendVideoNote($chatId, $videoNote, $params = []) {
        $params['chat_id'] = $chatId;
        $params['video_note'] = $videoNote;
        return $this->sendRequest('sendVideoNote', $params);
    }

    public function sendMediaGroup($chatId, $media, $params = []) {
        $params['chat_id'] = $chatId;
        $params['media'] = json_encode($media);
        return $this->sendRequest('sendMediaGroup', $params);
    }

    public function sendLocation($chatId, $latitude, $longitude, $params = []) {
        $params['chat_id'] = $chatId;
        $params['latitude'] = $latitude;
        $params['longitude'] = $longitude;
        return $this->sendRequest('sendLocation', $params);
    }

    public function sendVenue($chatId, $latitude, $longitude, $title, $address, $params = []) {
        $params['chat_id'] = $chatId;
        $params['latitude'] = $latitude;
        $params['longitude'] = $longitude;
        $params['title'] = $title;
        $params['address'] = $address;
        return $this->sendRequest('sendVenue', $params);
    }

    public function sendContact($chatId, $phoneNumber, $firstName, $params = []) {
        $params['chat_id'] = $chatId;
        $params['phone_number'] = $phoneNumber;
        $params['first_name'] = $firstName;
        return $this->sendRequest('sendContact', $params);
    }

    public function sendPoll($chatId, $question, $options, $params = []) {
        $params['chat_id'] = $chatId;
        $params['question'] = $question;
        $params['options'] = json_encode($options);
        return $this->sendRequest('sendPoll', $params);
    }

    public function sendDice($chatId, $params = []) {
        $params['chat_id'] = $chatId;
        return $this->sendRequest('sendDice', $params);
    }

    // Methods for updating messages

    public function editMessageText($chatId, $messageId, $text, $params = []) {
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        $params['text'] = $text;
        return $this->sendRequest('editMessageText', $params);
    }

    public function editMessageCaption($chatId, $messageId, $caption, $params = []) {
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        $params['caption'] = $caption;
        return $this->sendRequest('editMessageCaption', $params);
    }

    public function editMessageMedia($chatId, $messageId, $media, $params = []) {
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        $params['media'] = json_encode($media);
        return $this->sendRequest('editMessageMedia', $params);
    }

    public function editMessageReplyMarkup($chatId, $messageId, $replyMarkup, $params = []) {
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        $params['reply_markup'] = json_encode($replyMarkup);
        return $this->sendRequest('editMessageReplyMarkup', $params);
    }

    // Methods for interacting with chat actions

    public function sendChatAction($chatId, $action) {
        $params = [
            'chat_id' => $chatId,
            'action' => $action,
        ];
        return $this->sendRequest('sendChatAction', $params);
    }

    // Methods for managing chat members

    public function kickChatMember($chatId, $userId, $params = []) {
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        return $this->sendRequest('kickChatMember', $params);
    }

    public function unbanChatMember($chatId, $userId) {
        $params = [
            'chat_id' => $chatId,
            'user_id' => $userId,
        ];
        return $this->sendRequest('unbanChatMember', $params);
    }

    public function restrictChatMember($chatId, $userId, $permissions, $params = []) {
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        $params['permissions'] = json_encode($permissions);
        return $this->sendRequest('restrictChatMember', $params);
    }

    public function promoteChatMember($chatId, $userId, $params = []) {
        $params['chat_id'] = $chatId;
        $params['user_id'] = $userId;
        return $this->sendRequest('promoteChatMember', $params);
    }

    public function setChatAdministratorCustomTitle($chatId, $userId, $customTitle) {
        $params = [
            'chat_id' => $chatId,
            'user_id' => $userId,
            'custom_title' => $customTitle,
        ];
        return $this->sendRequest('setChatAdministratorCustomTitle', $params);
    }

    // Methods for managing chat permissions

    public function setChatPermissions($chatId, $permissions) {
        $params = [
            'chat_id' => $chatId,
            'permissions' => json_encode($permissions),
        ];
        return $this->sendRequest('setChatPermissions', $params);
    }

    // Methods for managing chat information

    public function setChatTitle($chatId, $title) {
        $params = [
            'chat_id' => $chatId,
            'title' => $title,
        ];
        return $this->sendRequest('setChatTitle', $params);
    }

    public function setChatDescription($chatId, $description) {
        $params = [
            'chat_id' => $chatId,
            'description' => $description,
        ];
        return $this->sendRequest('setChatDescription', $params);
    }

    public function pinChatMessage($chatId, $messageId, $params = []) {
        $params['chat_id'] = $chatId;
        $params['message_id'] = $messageId;
        return $this->sendRequest('pinChatMessage', $params);
    }

    public function unpinChatMessage($chatId) {
        $params = [
            'chat_id' => $chatId,
        ];
        return $this->sendRequest('unpinChatMessage', $params);
    }

    // Methods for managing stickers

    public function sendSticker($chatId, $sticker, $params = []) {
        $params['chat_id'] = $chatId;
        $params['sticker'] = $sticker;
        return $this->sendRequest('sendSticker', $params);
    }

    public function getStickerSet($name) {
        $params = [
            'name' => $name,
        ];
        return $this->sendRequest('getStickerSet', $params);
    }

    public function uploadStickerFile($userId, $pngSticker) {
        $params = [
            'user_id' => $userId,
            'png_sticker' => $pngSticker,
        ];
        return $this->sendRequest('uploadStickerFile', $params);
    }

    public function createNewStickerSet($userId, $name, $title, $pngSticker, $emojis, $params = []) {
        $params['user_id'] = $userId;
        $params['name'] = $name;
        $params['title'] = $title;
        $params['png_sticker'] = $pngSticker;
        $params['emojis'] = $emojis;
        return $this->sendRequest('createNewStickerSet', $params);
    }

    public function addStickerToSet($userId, $name, $pngSticker, $emojis, $params = []) {
        $params['user_id'] = $userId;
        $params['name'] = $name;
        $params['png_sticker'] = $pngSticker;
        $params['emojis'] = $emojis;
        return $this->sendRequest('addStickerToSet', $params);
    }

    public function setStickerPositionInSet($sticker, $position) {
        $params = [
            'sticker' => $sticker,
            'position' => $position,
        ];
        return $this->sendRequest('setStickerPositionInSet', $params);
    }

    public function deleteStickerFromSet($sticker) {
        $params = [
            'sticker' => $sticker,
        ];
        return $this->sendRequest('deleteStickerFromSet', $params);
    }

    // Methods for inline mode

    public function answerInlineQuery($inlineQueryId, $results, $params = []) {
        $params['inline_query_id'] = $inlineQueryId;
        $params['results'] = json_encode($results);
        return $this->sendRequest('answerInlineQuery', $params);
    }

    // Methods for payments

    public function sendInvoice($chatId, $title, $description, $payload, $providerToken, $startParameter, $currency, $prices, $params = []) {
        $params['chat_id'] = $chatId;
        $params['title'] = $title;
        $params['description'] = $description;
        $params['payload'] = $payload;
        $params['provider_token'] = $providerToken;
        $params['start_parameter'] = $startParameter;
        $params['currency'] = $currency;
        $params['prices'] = json_encode($prices);
        return $this->sendRequest('sendInvoice', $params);
    }

    public function answerShippingQuery($shippingQueryId, $ok, $params = []) {
        $params['shipping_query_id'] = $shippingQueryId;
        $params['ok'] = $ok;
        return $this->sendRequest('answerShippingQuery', $params);
    }

    public function answerPreCheckoutQuery($preCheckoutQueryId, $ok, $params = []) {
        $params['pre_checkout_query_id'] = $preCheckoutQueryId;
        $params['ok'] = $ok;
        return $this->sendRequest('answerPreCheckoutQuery', $params);
    }

    // Methods for managing games

    public function sendGame($chatId, $gameShortName, $params = []) {
        $params['chat_id'] = $chatId;
        $params['game_short_name'] = $gameShortName;
        return $this->sendRequest('sendGame', $params);
    }

    public function setGameScore($userId, $score, $params = []) {
        $params['user_id'] = $userId;
        $params['score'] = $score;
        return $this->sendRequest('setGameScore', $params);
    }

    public function getGameHighScores($userId, $params = []) {
        $params['user_id'] = $userId;
        return $this->sendRequest('getGameHighScores', $params);
    }

    // Methods for handling updates

    public function getUpdates($params = []) {
        return $this->sendRequest('getUpdates', $params);
    }

    public function setWebhook($url, $params = []) {
        $params['url'] = $url;
        return $this->sendRequest('setWebhook', $params);
    }

    public function deleteWebhook() {
        return $this->sendRequest('deleteWebhook');
    }

    public function getWebhookInfo() {
        return $this->sendRequest('getWebhookInfo');
    }

    // Additional methods can be added based on Telegram Bot API documentation

    // Utility method to handle API requests
    private function sendRequest($method, $params = []) {
        $url = $this->apiUrl . $method;
        $options = [
            'http' => [
                'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($params),
            ],
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {
            throw new Exception("Error Processing Request to Telegram API");
        }
        return json_decode($result, true);
    }
}

