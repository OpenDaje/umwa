<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Api;

class Instance extends AbstractApi
{
    /**
     * Get the instance status
     * @see https://docs.ultramsg.com/api/get/instance/status
     *
     * Example: initialize|qr|retrying|loading|authenticated|disconnected|standby
     */
    public function getStatus(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/instance/status');
    }

    /**
     * Get instance settings
     * @see https://docs.ultramsg.com/api/get/instance/settings
     *
     * sendDelay : Delay in seconds between sending message, Default 1 second
     * webhook_url : Http or https URL for receiving notifications.
     * webhook_message_received : on/off notifications in webhooks when message received.
     * webhook_message_create : on/off notifications in webhooks when message create.
     * webhook_message_ack : on/off ack (message delivered and message viewed) notifications in webhooks.
     * webhook_message_download_media : on/off to get received document / media files.
     */
    public function getSettings(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/instance/settings');
    }

    /**
     * Get QR image for authentication
     * @see https://docs.ultramsg.com/api/get/instance/qr
     */
    public function getQR(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/instance/qr');
    }

    /**
     * Get QR code for authentication
     * @see https://docs.ultramsg.com/api/get/instance/qrCode
     */
    public function getQrCode(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/instance/qrCode');
    }

    /**
     * Get connected phone informations
     * @see https://docs.ultramsg.com/api/get/instance/me
     */
    public function getConnectedPhoneInfo(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/instance/me');
    }

    /**
     * Logout from WhatsApp Web to get new QR code.
     * @see https://docs.ultramsg.com/api/post/instance/logout
     */
    public function logout(): array|string
    {
        return $this->postRaw(
            '/' . rawurlencode($this->getInstanceId()) . '/instance/logout',
            http_build_query([
                'token' => $this->getToken(),
            ])
        );
    }

    /**
     * Restart your WhatsApp instance.
     * @see https://docs.ultramsg.com/api/post/instance/restart
     */
    public function restart(): array|string
    {
        return $this->postRaw(
            '/' . rawurlencode($this->getInstanceId()) . '/instance/restart',
            http_build_query([
                'token' => $this->getToken(),
            ])
        );
    }

    /**
     * Update instance settings
     * @see https://docs.ultramsg.com/api/post/instance/settings
     *
     * @param int $sendDelay Delay in seconds between sending message, Default 1 secondDelay in seconds between sending message .
     *
     * @param string $webhookUrl Http or https URL for receiving notifications .
     *
     * @param string $webhookMessageReceived true/false notifications in webhooks when message received .
     *
     * @param string $webhookMessageCreate true/false notifications in webhooks when message create .
     *
     * @param string $webhookMessageAck true/false ack (message delivered and message viewed) notifications in webhooks .
     */
    public function settings(int $sendDelay = 1, string $webhookUrl = '', string $webhookMessageReceived = '', string $webhookMessageCreate = '', string $webhookMessageAck = '', string $webhookMessageDownloadMedia = ''): array|string
    {
        return $this->postRaw(
            '/' . rawurlencode($this->getInstanceId()) . '/instance/settings',
            http_build_query([
                'token' => $this->getToken(),
                'sendDelay' => $sendDelay,
                'webhook_url' => $webhookUrl,
                'webhook_message_received' => $webhookMessageReceived,
                'webhook_message_create' => $webhookMessageCreate,
                'webhook_message_ack' => $webhookMessageAck,
                'webhook_message_download_media' => $webhookMessageDownloadMedia,
            ])
        );
    }

    /**
     * Reset instance to default settings
     *
     * Delete all settings :
     * Instant messages will be deleted (sent, queue,..)
     * settings will reset to default
     * session will be deleted and instance return to QR
     *
     * @see https://docs.ultramsg.com/api/post/instance/clear
     */
    public function clear(): array|string
    {
        return $this->postRaw(
            '/' . rawurlencode($this->getInstanceId()) . '/instance/clear',
            http_build_query([
                'token' => $this->getToken(),
            ])
        );
    }
}
