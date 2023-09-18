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

    /**
     * Get the chats id's
     *
     * @see https://docs.ultramsg.com/api/get/chats/ids
     */
    public function getChatsIds(bool $clearIds = false): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/chats/ids', [
            'clear' => $clearIds,
        ]);
    }

    /**
     * Get last message from chat conversation
     */
    public function getChatMessages(string $chatId, int $limit = 50): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/chats/messages', [
            'chatId' => $chatId,
            'limit' => $limit,
        ]);
    }
}
