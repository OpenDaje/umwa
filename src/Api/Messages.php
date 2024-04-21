<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Api;

class Messages extends AbstractApi
{
    /**
     * Get a list of instance messages (sent,queue,unsent,all)
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
     * @see https://docs.ultramsg.com/api/get/messages/statistics
     *
     * return total messages count (sent & queue & unsent)
     */
    public function getStatistics(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/messages/statistics');
    }

    /**
     * Send a text message to phone number or group
     * @see https://docs.ultramsg.com/api/post/messages/chat
     *
     * @param string $to Phone number with international format e.g. +14155552671
     * or
     * chatID for contact or group e.g 14155552671@c.us or 14155552671-441234567890@g.us
     *
     * @param string $body Message text, UTF-8 or UTF-16 string with emoji
     * Max length : 4096 characters .
     *
     * Note :
     * in case the instance not authorized or phone disconnected from internet ,
     * the message will add to queue and will be sent when the WhatsApp instance ready.
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
     * Send an image to phone number or group
     * @see https://docs.ultramsg.com/api/post/messages/image
     *
     * @param string $to Phone number with international format e.g. +14155552671
     * or
     * chatID for contact or group e.g 14155552671@c.us or 14155552671-441234567890@g.us
     *
     * @param string $image HTTP link image or base64-encoded file
     * Supported extensions ( jpg , jpeg , gif , png , webp , bmp ) .
     * Max file size : 16MB .
     * Max Base64 length : 10,000,000
     * example images links :
     * jpg : https://file-example.s3-accelerate.amazonaws.com/images/test.jpg
     *
     * @param string $caption The text under the file .
     * Data type : text, UTF-8 or UTF-16 string with emoji .
     * Max length : 1024 char .
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
     * @see https://docs.ultramsg.com/api/post/messages/sticker
     *
     * @param string $to Phone number with international format e.g. +14155552671
     * or
     * chatID for contact or group e.g 14155552671@c.us or 14155552671-441234567890@g.us
     *
     * @param string $sticker HTTP link image or base64-encoded file
     * Supported extensions ( jpg , jpeg , gif , png , webp , bmp ) .
     * Max file size : 16MB .
     * Max Base64 length : 10,000,000
     * example images links :
     * webp : https://file-example.s3.us-west-2.amazonaws.com/sticker/1.webp
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
     * @see https://docs.ultramsg.com/api/post/messages/document
     *
     * @param string $to Phone number with international format e.g. +14155552671
     * or
     * chatID for contact or group e.g 14155552671@c.us or 14155552671-441234567890@g.us
     *
     * @param string $filename File name, for example 1.jpg or Hello.pdf
     * filename Max length : 255 char .
     *
     * @param string $document HTTP link file or base64-encoded file
     * Supported most extensions like ( zip , xlsx , csv , txt , pptx , docx ....etc ) .
     * Max file size : 30MB .
     * Max Base64 length : 10,000,000
     * example links :
     * https://file-example.s3-accelerate.amazonaws.com/documents/cv.pdf
     *
     * @param string $caption The text under the file .
     * Data type : text, UTF-8 or UTF-16 string with emoji .
     * Max length : 1024 char .
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
     * Send an audio file to phone number or group
     * @see https://docs.ultramsg.com/api/post/messages/audio
     *
     * @param string $to Phone number with international format e.g. +14155552671
     * or
     * chatID for contact or group e.g 14155552671@c.us or 14155552671-441234567890@g.us
     *
     * @param string $audio HTTP link audio or base64-encoded file
     * Supported extensions ( mp3 , aac , ogg ) .
     * Max file size : 16MB .
     * Max Base64 length : 10,000,000
     * example links :
     * https://file-example.s3-accelerate.amazonaws.com/audio/2.mp3
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
     * @see https://docs.ultramsg.com/api/post/messages/voice
     *
     * @param string $to Phone number with international format e.g. +14155552671
     * or
     * chatID for contact or group e.g 14155552671@c.us or 14155552671-441234567890@g.us
     *
     * @param string $audio HTTP link audio or base64-encoded file in opus codec .
     * Max file size : 16MB .
     * Max Base64 length : 10,000,000
     * example links :
     * https://file-example.s3-accelerate.amazonaws.com/voice/oog_example.ogg
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
     * @see https://docs.ultramsg.com/api/post/messages/video
     *
     * @param string $to Phone number with international format e.g. +14155552671
     * or
     * chatID for contact or group e.g 14155552671@c.us or 14155552671-441234567890@g.us
     *
     * @param string $video HTTP link video or base64-encoded file
     * Supported extensions ( mp4 , 3gp , mov ) .
     * Max file size : 16MB .
     * Max file size for multi-device : 16 MB .
     * Max Base64 length : 10,000,000
     * example links :
     * https://file-example.s3-accelerate.amazonaws.com/video/test.mp4
     *
     * @param string $caption The text under the file .
     * Data type : text, UTF-8 or UTF-16 string with emoji .
     * Max length : 1024 char .
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
     * @see https://docs.ultramsg.com/api/post/messages/contact
     *
     * @param string $to Phone number with international format e.g. +14155552671
     * or
     * chatID for contact or group e.g 14155552671@c.us or 14155552671-441234567890@g.us
     *
     * @param string $contact Contact ID or Contact IDs array example :
     * 14000000001@c.us
     * or
     * 14000000001@c.us,14000000002@c.us,14000000003@c.us
     * Max length : 300 char , almost 15 contacts
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
     * @see https://docs.ultramsg.com/api/post/messages/location
     *
     * @param string $to Phone number with international format e.g. +14155552671
     * or
     * chatID for contact or group e.g 14155552671@c.us or 14155552671-441234567890@g.us
     *
     * @param string $address Text under the location.
     * Supports two lines. To use two lines, use the \n symbol.
     * Max length : 300 char
     *
     * @param float $lat Latitude
     * Example :
     * 25.197197
     *
     * @param float $lng Longitude
     * Example :
     * 55.2721877
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
     * @see https://docs.ultramsg.com/api/post/messages/vcard
     *
     * @param string $to Phone number with international format e.g. +14155552671
     * or
     * chatID for contact or group e.g 14155552671@c.us or 14155552671-441234567890@g.us
     *
     * @param string $vCard Text value vcard 3.0
     * Max length : 4096 char
     * Example :
     * BEGIN:VCARD\nVERSION:3.0\nN:lastname;firstname\nFN:firstname lastname\nTEL;TYPE=CELL;waid=14000000001:14000000002\nNICKNAME:nickname\nBDAY:01.01.1987\nX-GENDER:M\nNOTE:note\nADR;TYPE=home:;;;;;;\nADR;TYPE=work_:;;;;;;\nEND:VCARD
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
     * @see https://docs.ultramsg.com/api/post/messages/reaction
     *
     * @param string $msgId msgId of the incoming message from Webhooks.
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
     * @see https://docs.ultramsg.com/api/post/messages/delete
     *
     * @param string $msgId msgId of the incoming message from Webhooks.
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
     * @see https://docs.ultramsg.com/api/post/messages/resendByStatus
     *
     * @param string $status message status : unsent or expired
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
     * @see https://docs.ultramsg.com/api/post/messages/resendById
     *
     * @param string $msgId msgId of the incoming message from Webhooks.
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
     * @see https://docs.ultramsg.com/api/post/messages/clear
     * @param string $status
     * queue : delete all queue messages
     * sent :delete all sent messages
     * unsent :delete all unsent messages
     * invalid :delete all invalid messages
     */
    public function clear(string $status): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/messages/clear', http_build_query([
            'token' => $this->getToken(),
            'status' => $status,
        ]));
    }
}
