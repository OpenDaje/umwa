<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Api;

class Instance extends AbstractApi
{
    /**
     * Get the instance status
     *
     * @see https://docs.ultramsg.com/api/get/instance/status
     */
    public function getStatus(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/instance/status');
    }

    /**
     * Get instance settings
     *
     * @see https://docs.ultramsg.com/api/get/instance/settings
     */
    public function getSettings(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/instance/settings');
    }

    /**
     * Get QR image for authentication
     *
     * @see https://docs.ultramsg.com/api/get/instance/qr
     */
    public function getQR(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/instance/qr');
    }

    /**
     * Get QR image for authentication
     *
     * @see https://docs.ultramsg.com/api/get/instance/qrCode
     */
    public function getQrCode(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/instance/qrCode');
    }

    /**
     * Get connected phone informations
     *
     * @see https://docs.ultramsg.com/api/get/instance/me
     */
    public function getConnectedPhoneInfo(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/instance/me');
    }

    /**
     * Logout from WhatsApp Web to get new QR code.
     *
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
     *
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
     *
     * @see https://docs.ultramsg.com/api/post/instance/settings
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
     * @see https://docs.ultramsg.com/api/post/instance/clear
     *
     * Delete all settings :
     * Instant messages will be deleted (sent, queue,..)
     * settings will reset to default
     * session will be deleted and instance return to QR
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
