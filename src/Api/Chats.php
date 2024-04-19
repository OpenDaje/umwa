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
     *
     * @see https://docs.ultramsg.com/api/get/chats/messages
     */
    public function getChatMessages(string $chatId, int $limit = 50): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/chats/messages', [
            'chatId' => $chatId,
            'limit' => $limit,
        ]);
    }

    /**
     * Archive chat from chat list
     *
     * @see https://docs.ultramsg.com/api/post/chats/archive
     */
    public function archiveChat(string $chatId): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/chats/archive', http_build_query([
            'token' => $this->getToken(),
            'chatId' => $chatId,
        ]));
    }

    /**
     * Return archived chat to chat list
     *
     * @see https://docs.ultramsg.com/api/post/chats/unarchive
     */
    public function unarchiveChat(string $chatId): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/chats/unarchive', http_build_query([
            'token' => $this->getToken(),
            'chatId' => $chatId,
        ]));
    }

    /**
     * Clear all messages from the chat
     *
     * @see https://docs.ultramsg.com/api/post/chats/clearMessages
     */
    public function clearMessages(string $chatId): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/chats/clearMessages', http_build_query([
            'token' => $this->getToken(),
            'chatId' => $chatId,
        ]));
    }

    /**
     * Delete chat from chat list
     *
     * @see https://docs.ultramsg.com/api/post/chats/delete
     */
    public function deleteChat(string $chatId): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/chats/delete', http_build_query([
            'token' => $this->getToken(),
            'chatId' => $chatId,
        ]));
    }

    /**
     * Make chat messages as read for specific conversation
     *
     * @see https://docs.ultramsg.com/api/post/chats/read
     */
    public function markAsReaded(string $chatId): array|string
    {
        return $this->postRaw('/' . rawurlencode($this->getInstanceId()) . '/chats/read', http_build_query([
            'token' => $this->getToken(),
            'chatId' => $chatId,
        ]));
    }
}
