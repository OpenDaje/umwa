<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Api;

class Messages extends AbstractApi
{
    /**
     * Get a list of instance messages (sent,queue,unsent,all)
     *
     * @see https://docs.ultramsg.com/api/get/messages
     */
    public function getMessages(
        string $id = "",
        string $referenceId = "",
        string $from = "",
        string $to = "",
        string $ack = "",
        string $status = "all",
        int $page = 1,
        int $limit = 100,
        string $sort = "asc"
    ): array|string {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/messages', [
            'id' => $id,
            'referenceId' => $referenceId,
            'from' => $from,
            'to' => $to,
            'ack' => $ack,
            'status' => $status,
            'page' => $page,
            'limit' => $limit,
            'sort' => $sort,
        ]);
    }

    /**
     * Get statistics for instance message
     *
     * return total messages count ( sent & queue & unsent )
     *
     * @see https://docs.ultramsg.com/api/get/messages/statistics
     */
    public function getStatistics(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/messages/statistics');
    }

    /**
     * Send a text message to phone number or group
     *
     * Note :
     * in case the instance not authorized or phone disconnected from internet ,
     * the message will add to queue and will be sent when the WhatsApp instance ready.
     *
     * @see https://docs.ultramsg.com/api/post/messages/chat
     */
    public function sendChatMessage(string $to, string $body, int $priority = 10, string $referenceId = '', string $msgId = '', string $mentions = ''): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/chat', http_build_query([
            'token' => $this->getToken(),
            'to' => $to,
            'body' => $body,
            'priority' => $priority,
            'referenceId' => $referenceId,
            'msgId' => $msgId,
            'mentions' => $mentions,
        ]));
    }

    /**
     * Send a image to phone number or group
     *
     * @see https://docs.ultramsg.com/api/post/messages/image
     */
    public function sendImageMessage(string $to, string $image, string $caption = '', int $priority = 10, string $referenceId = '', bool $noCache = false, string $msgId = '', string $mentions = ''): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/image', http_build_query([
            'token' => $this->getToken(),
            'to' => $to,
            'image' => $image,
            'caption' => $caption,
            'priority' => $priority,
            'referenceId' => $referenceId,
            'nocache' => $noCache,
            'msgId' => $msgId,
            'mentions' => $mentions,
        ]));
    }

    /**
     * Send a sticker to phone number or group
     *
     * @see https://docs.ultramsg.com/api/post/messages/sticker
     */
    public function sendStickerMessage(string $to, string $sticker, int $priority = 10, string $referenceId = '', bool $noCache = false, string $msgId = ''): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/sticker', http_build_query([
            'token' => $this->getToken(),
            'to' => $to,
            'sticker' => $sticker,
            'priority' => $priority,
            'referenceId' => $referenceId,
            'nocache' => $noCache,
            'msgId' => $msgId,
        ]));
    }

    /**
     * Send a document file to phone number or group
     *
     * @see https://docs.ultramsg.com/api/post/messages/document
     */
    public function sendDocumentMessage(string $to, string $filename, string $document, string $caption = '', int $priority = 10, string $referenceId = '', bool $noCache = false, string $msgId = '', string $mentions = ''): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/document', http_build_query([
            'token' => $this->getToken(),
            'to' => $to,
            'filename' => $filename,
            'document' => $document,
            'caption' => $caption,
            'priority' => $priority,
            'referenceId' => $referenceId,
            'nocache' => $noCache,
            'msgId' => $msgId,
            'mentions' => $mentions,
        ]));
    }

    /**
     * Send a audio file to phone number or group
     *
     * @see https://docs.ultramsg.com/api/post/messages/audio
     */
    public function sendAudioMessage(string $to, string $audio, int $priority = 10, string $referenceId = '', bool $noCache = false, string $msgId = ''): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/audio', http_build_query([
            'token' => $this->getToken(),
            'to' => $to,
            'audio' => $audio,
            'priority' => $priority,
            'referenceId' => $referenceId,
            'nocache' => $noCache,
            'msgId' => $msgId,
        ]));
    }

    /**
     * Send a ppt audio recording to phone number or group
     *
     * @see https://docs.ultramsg.com/api/post/messages/voice
     */
    public function sendVoiceMessage(string $to, string $audio, int $priority = 10, string $referenceId = '', bool $noCache = false, string $msgId = ''): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/voice', http_build_query([
            'token' => $this->getToken(),
            'to' => $to,
            'audio' => $audio,
            'priority' => $priority,
            'referenceId' => $referenceId,
            'nocache' => $noCache,
            'msgId' => $msgId,
        ]));
    }

    /**
     * Send a Video to phone number or group
     *
     * @see https://docs.ultramsg.com/api/post/messages/video
     */
    public function sendVideoMessage(string $to, string $video, string $caption = '', int $priority = 10, string $referenceId = '', bool $noCache = false, string $msgId = '', string $mentions = ''): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/video', http_build_query([
            'token' => $this->getToken(),
            'to' => $to,
            'video' => $video,
            'caption' => $caption,
            'priority' => $priority,
            'referenceId' => $referenceId,
            'nocache' => $noCache,
            'msgId' => $msgId,
            'mentions' => $mentions,
        ]));
    }

    /**
     * Sending one contact or contact list to phone number or group
     *
     * @see https://docs.ultramsg.com/api/post/messages/contact
     */
    public function sendContact(string $to, string $contact, int $priority = 10, string $referenceId = '', string $msgId = ''): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/contact', http_build_query([
            'token' => $this->getToken(),
            'to' => $to,
            'contact' => $contact,
            'priority' => $priority,
            'referenceId' => $referenceId,
            'msgId' => $msgId,
        ]));
    }

    /**
     * Sending a location to phone number or group
     *
     * @see https://docs.ultramsg.com/api/post/messages/location
     */
    public function sendLocation(string $to, string $address, float $lat, float $lng, int $priority = 10, string $referenceId = '', string $msgId = ''): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/location', http_build_query([
            'token' => $this->getToken(),
            'to' => $to,
            'address' => $address,
            'lat' => $lat,
            'lng' => $lng,
            'priority' => $priority,
            'referenceId' => $referenceId,
            'msgId' => $msgId,
        ]));
    }

    /**
     * Sending a vcard to phone number or group
     *
     * @see https://docs.ultramsg.com/api/post/messages/vcard
     */
    public function sendVcard(string $to, string $vCard, int $priority = 10, string $referenceId = '', string $msgId = ''): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/vcard', http_build_query([
            'token' => $this->getToken(),
            'to' => $to,
            'vcard' => $vCard,
            'priority' => $priority,
            'referenceId' => $referenceId,
            'msgId' => $msgId,
        ]));
    }

    /**
     * Sending a reaction to message
     *
     * @see https://docs.ultramsg.com/api/post/messages/reaction
     */
    public function sendReaction(string $msgId, string $emoji): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/reaction', http_build_query([
            'token' => $this->getToken(),
            'msgId' => $msgId,
            'emoji' => $emoji,
        ]));
    }

    /**
     * delete whatsapp message
     *
     * @see https://docs.ultramsg.com/api/post/messages/delete
     */
    public function deleteMessage(string $msgId): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/delete', http_build_query([
            'token' => $this->getToken(),
            'msgId' => $msgId,
        ]));
    }

    /**
     * Resend messages by message status
     *
     * @see https://docs.ultramsg.com/api/post/messages/resendByStatus
     */
    public function resendByStatus(string $status): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/resendByStatus', http_build_query([
            'token' => $this->getToken(),
            'status' => $status,
        ]));
    }

    /**
     * Resend message by message id
     *
     * @see https://docs.ultramsg.com/api/post/messages/resendById
     */
    public function resendById(string $msgId): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/resendById', http_build_query([
            'token' => $this->getToken(),
            'id' => $msgId,
        ]));
    }

    /**
     * Delete messages from instance (queue or sent or unsent)
     *
     * status: queue|sent|unsent|invalid
     *
     * @see https://docs.ultramsg.com/api/post/messages/clear
     */
    public function clear(string $status): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/clear', http_build_query([
            'token' => $this->getToken(),
            'status' => $status,
        ]));
    }
}
