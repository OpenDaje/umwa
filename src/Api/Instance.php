<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Api;

class Instance extends AbstractApi
{
    /**
     * Get the instance status
     *
     * @see https://docs.ultramsg.com/api/get/instance/status
     *
     * @return array|string
     */
    public function getStatus(string $instanceId)
    {
        return $this->get('/' . rawurlencode($instanceId) . '/instance/status');
    }

    /**
     * Get instance settings
     *
     * @see https://docs.ultramsg.com/api/get/instance/settings
     *
     * @return array|string
     */
    public function getSettings(string $instanceId)
    {
        return $this->get('/' . rawurlencode($instanceId) . '/instance/settings');
    }

    /**
     * Get QR image for authentication
     *
     * @see https://docs.ultramsg.com/api/get/instance/qr
     *
     * @return array|string
     */
    public function getQR(string $instanceId)
    {
        return $this->get('/' . rawurlencode($instanceId) . '/instance/qr');
    }

    /**
     * Get QR image for authentication
     *
     * @see https://docs.ultramsg.com/api/get/instance/qrCode
     *
     * @return array|string
     */
    public function getQrCode(string $instanceId)
    {
        return $this->get('/' . rawurlencode($instanceId) . '/instance/qrCode');
    }

    /**
     * Get connected phone informations
     *
     * @see https://docs.ultramsg.com/api/get/instance/me
     *
     * @return array|string
     */
    public function getConnectedPhoneInfo(string $instanceId)
    {
        return $this->get('/' . rawurlencode($instanceId) . '/instance/me');
    }
}
