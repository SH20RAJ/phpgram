<?php

namespace PhpGram;

class PhpGram {
    private $token;
    private $apiUrl = "https://api.telegram.org/bot";

    public function __construct($token) {
        $this->token = $token;
        $this->apiUrl .= $this->token;
    }

    private function request($method, $params = []) {
        $url = $this->apiUrl . '/' . $method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    public function sendMessage($chatId, $text, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'text' => $text], $options);
        return $this->request('sendMessage', $params);
    }

    public function forwardMessage($chatId, $fromChatId, $messageId, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'from_chat_id' => $fromChatId, 'message_id' => $messageId], $options);
        return $this->request('forwardMessage', $params);
    }

    public function sendPhoto($chatId, $photo, $caption = '', $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'photo' => $photo, 'caption' => $caption], $options);
        return $this->request('sendPhoto', $params);
    }

    public function sendAudio($chatId, $audio, $caption = '', $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'audio' => $audio, 'caption' => $caption], $options);
        return $this->request('sendAudio', $params);
    }

    public function sendDocument($chatId, $document, $caption = '', $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'document' => $document, 'caption' => $caption], $options);
        return $this->request('sendDocument', $params);
    }

    public function sendVideo($chatId, $video, $caption = '', $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'video' => $video, 'caption' => $caption], $options);
        return $this->request('sendVideo', $params);
    }

    public function sendVoice($chatId, $voice, $caption = '', $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'voice' => $voice, 'caption' => $caption], $options);
        return $this->request('sendVoice', $params);
    }

    public function sendVideoNote($chatId, $videoNote, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'video_note' => $videoNote], $options);
        return $this->request('sendVideoNote', $params);
    }

    public function sendMediaGroup($chatId, $media, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'media' => json_encode($media)], $options);
        return $this->request('sendMediaGroup', $params);
    }

    public function sendLocation($chatId, $latitude, $longitude, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'latitude' => $latitude, 'longitude' => $longitude], $options);
        return $this->request('sendLocation', $params);
    }

    public function editMessageLiveLocation($chatId, $messageId, $latitude, $longitude, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'message_id' => $messageId, 'latitude' => $latitude, 'longitude' => $longitude], $options);
        return $this->request('editMessageLiveLocation', $params);
    }

    public function stopMessageLiveLocation($chatId, $messageId, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'message_id' => $messageId], $options);
        return $this->request('stopMessageLiveLocation', $params);
    }

    public function sendVenue($chatId, $latitude, $longitude, $title, $address, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'latitude' => $latitude, 'longitude' => $longitude, 'title' => $title, 'address' => $address], $options);
        return $this->request('sendVenue', $params);
    }

    public function sendContact($chatId, $phoneNumber, $firstName, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'phone_number' => $phoneNumber, 'first_name' => $firstName], $options);
        return $this->request('sendContact', $params);
    }

    public function sendPoll($chatId, $question, $options, $otherOptions = []) {
        $params = array_merge(['chat_id' => $chatId, 'question' => $question, 'options' => json_encode($options)], $otherOptions);
        return $this->request('sendPoll', $params);
    }

    public function sendChatAction($chatId, $action) {
        return $this->request('sendChatAction', ['chat_id' => $chatId, 'action' => $action]);
    }

    public function getUserProfilePhotos($userId, $options = []) {
        $params = array_merge(['user_id' => $userId], $options);
        return $this->request('getUserProfilePhotos', $params);
    }

    public function getFile($fileId) {
        return $this->request('getFile', ['file_id' => $fileId]);
    }

    public function kickChatMember($chatId, $userId, $untilDate = null) {
        return $this->request('kickChatMember', ['chat_id' => $chatId, 'user_id' => $userId, 'until_date' => $untilDate]);
    }

    public function unbanChatMember($chatId, $userId) {
        return $this->request('unbanChatMember', ['chat_id' => $chatId, 'user_id' => $userId]);
    }

    public function restrictChatMember($chatId, $userId, $permissions, $untilDate = null) {
        return $this->request('restrictChatMember', ['chat_id' => $chatId, 'user_id' => $userId, 'permissions' => json_encode($permissions), 'until_date' => $untilDate]);
    }

    public function promoteChatMember($chatId, $userId, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'user_id' => $userId], $options);
        return $this->request('promoteChatMember', $params);
    }

    public function exportChatInviteLink($chatId) {
        return $this->request('exportChatInviteLink', ['chat_id' => $chatId]);
    }

    public function setChatPhoto($chatId, $photo) {
        return $this->request('setChatPhoto', ['chat_id' => $chatId, 'photo' => $photo]);
    }

    public function deleteChatPhoto($chatId) {
        return $this->request('deleteChatPhoto', ['chat_id' => $chatId]);
    }

    public function setChatTitle($chatId, $title) {
        return $this->request('setChatTitle', ['chat_id' => $chatId, 'title' => $title]);
    }

    public function setChatDescription($chatId, $description) {
        return $this->request('setChatDescription', ['chat_id' => $chatId, 'description' => $description]);
    }

    public function pinChatMessage($chatId, $messageId, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'message_id' => $messageId], $options);
        return $this->request('pinChatMessage', $params);
    }

    public function unpinChatMessage($chatId, $messageId) {
        return $this->request('unpinChatMessage', ['chat_id' => $chatId, 'message_id' => $messageId]);
    }

    public function unpinAllChatMessages($chatId) {
        return $this->request('unpinAllChatMessages', ['chat_id' => $chatId]);
    }

    public function leaveChat($chatId) {
        return $this->request('leaveChat', ['chat_id' => $chatId]);
    }

    public function getChat($chatId) {
        return $this->request('getChat', ['chat_id' => $chatId]);
    }

    public function getChatAdministrators($chatId) {
        return $this->request('getChatAdministrators', ['chat_id' => $chatId]);
    }

    public function getChatMembersCount($chatId) {
        return $this->request('getChatMembersCount', ['chat_id' => $chatId]);
    }

    public function getChatMember($chatId, $userId) {
        return $this->request('getChatMember', ['chat_id' => $chatId, 'user_id' => $userId]);
    }

    public function setChatStickerSet($chatId, $stickerSetName) {
        return $this->request('setChatStickerSet', ['chat_id' => $chatId, 'sticker_set_name' => $stickerSetName]);
    }

    public function deleteChatStickerSet($chatId) {
        return $this->request('deleteChatStickerSet', ['chat_id' => $chatId]);
    }

    public function getStickerSet($name) {
        return $this->request('getStickerSet', ['name' => $name]);
    }

    public function uploadStickerFile($userId, $pngSticker) {
        return $this->request('uploadStickerFile', ['user_id' => $userId, 'png_sticker' => $pngSticker]);
    }

    public function createNewStickerSet($userId, $name, $title, $pngSticker, $emojis, $options = []) {
        $params = array_merge(['user_id' => $userId, 'name' => $name, 'title' => $title, 'png_sticker' => $pngSticker, 'emojis' => $emojis], $options);
        return $this->request('createNewStickerSet', $params);
    }

    public function addStickerToSet($userId, $name, $pngSticker, $emojis, $options = []) {
        $params = array_merge(['user_id' => $userId, 'name' => $name, 'png_sticker' => $pngSticker, 'emojis' => $emojis], $options);
        return $this->request('addStickerToSet', $params);
    }

    public function setStickerPositionInSet($sticker, $position) {
        return $this->request('setStickerPositionInSet', ['sticker' => $sticker, 'position' => $position]);
    }

    public function deleteStickerFromSet($sticker) {
        return $this->request('deleteStickerFromSet', ['sticker' => $sticker]);
    }

    public function answerInlineQuery($inlineQueryId, $results, $options = []) {
        $params = array_merge(['inline_query_id' => $inlineQueryId, 'results' => json_encode($results)], $options);
        return $this->request('answerInlineQuery', $params);
    }

    public function sendInvoice($chatId, $title, $description, $payload, $providerToken, $startParameter, $currency, $prices, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'title' => $title, 'description' => $description, 'payload' => $payload, 'provider_token' => $providerToken, 'start_parameter' => $startParameter, 'currency' => $currency, 'prices' => json_encode($prices)], $options);
        return $this->request('sendInvoice', $params);
    }

    public function answerShippingQuery($shippingQueryId, $ok, $options = []) {
        $params = array_merge(['shipping_query_id' => $shippingQueryId, 'ok' => $ok], $options);
        return $this->request('answerShippingQuery', $params);
    }

    public function answerPreCheckoutQuery($preCheckoutQueryId, $ok, $options = []) {
        $params = array_merge(['pre_checkout_query_id' => $preCheckoutQueryId, 'ok' => $ok], $options);
        return $this->request('answerPreCheckoutQuery', $params);
    }

    public function setPassportDataErrors($userId, $errors) {
        return $this->request('setPassportDataErrors', ['user_id' => $userId, 'errors' => json_encode($errors)]);
    }

    public function sendGame($chatId, $gameShortName, $options = []) {
        $params = array_merge(['chat_id' => $chatId, 'game_short_name' => $gameShortName], $options);
        return $this->request('sendGame', $params);
    }

    public function setGameScore($userId, $score, $options = []) {
        $params = array_merge(['user_id' => $userId, 'score' => $score], $options);
        return $this->request('setGameScore', $params);
    }

    public function getGameHighScores($userId, $options = []) {
        $params = array_merge(['user_id' => $userId], $options);
        return $this->request('getGameHighScores', $params);
    }



}

?>
