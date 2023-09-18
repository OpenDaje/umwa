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
}
