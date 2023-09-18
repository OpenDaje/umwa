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
}
