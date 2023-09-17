<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Api;

class Chats extends AbstractApi
{
    /**
     * Get the chats list
     *
     * @see https://docs.ultramsg.com/api/get/chats
     */
    public function getChats(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/chats');
    }
}
