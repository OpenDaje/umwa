<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Api;

class Contacts extends AbstractApi
{
    /**
     * Get the contacts list
     * @see https://docs.ultramsg.com/api/get/contacts
     */
    public function getContacts(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/contacts');
    }

    /**
     * Get the contacts id's
     * @see https://docs.ultramsg.com/api/get/contacts/ids
     */
    public function getContactsIds(bool $clearIds = false): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/contacts/ids', [
            'clear' => $clearIds,
        ]);
    }

    /**
     * Get contact info
     * @see https://docs.ultramsg.com/api/get/contacts/contact
     *
     * @param string $chatId chatID for contact e.g 14155552671@c.us
     */
    public function getContactInfo(string $chatId): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/contacts/contact', [
            'chatId' => $chatId,
        ]);
    }

    /**
     * Gets all blocked contacts
     * @see https://docs.ultramsg.com/api/get/contacts/blocked
     */
    public function getBlockedContacts(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/contacts/blocked');
    }

    /**
     * Gets all invalid contacts
     * @see https://docs.ultramsg.com/api/get/contacts/invalid
     */
    public function getInvalidContacts(bool $clearIds = false): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/contacts/invalid', [
            'clear' => $clearIds,
        ]);
    }

    /**
     * Check if number is WhatsApp user
     * @see https://docs.ultramsg.com/api/get/contacts/check
     *
     * @param string $chatId chatID for contact e.g 14155552671@c.us
     *
     * @param bool $noCache Whether to check the contacts cache or not. Contact information is normally cached for 3 days. By setting the nocache parameter to true, the cache will be bypassed ensuring a check is performed.
     */
    public function checkContact(string $chatId, bool $noCache = false): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/contacts/check', [
            'chatId' => $chatId,
            'nocache' => $noCache,
        ]);
    }

    /**
     * Get contact profile picture
     * @see https://docs.ultramsg.com/api/get/contacts/image
     *
     * @param string $chatId chatID for contact e.g 14155552671@c.us
     */
    public function getContactImage(string $chatId): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/contacts/image', [
            'chatId' => $chatId,
        ]);
    }

    /**
     * block contact from WhatsApp
     * @see https://docs.ultramsg.com/api/post/contacts/block
     *
     * @param string $chatId chatID for contact e.g 14155552671@c.us
     */
    public function block(string $chatId): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/contacts/block', http_build_query([
            'token' => $this->getToken(),
            'chatId' => $chatId,
        ]));
    }

    /**
     * Unblock contact from WhatsApp
     * @see https://docs.ultramsg.com/api/post/contacts/unblock
     *
     * @param string $chatId chatID for contact e.g 14155552671@c.us
     */
    public function unblock(string $chatId): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/contacts/unblock', http_build_query([
            'token' => $this->getToken(),
            'chatId' => $chatId,
        ]));
    }
}
