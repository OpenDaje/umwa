<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Api;

class Groups extends AbstractApi
{
    /**
     * get all groups info and participants
     *
     * @see https://docs.ultramsg.com/api/get/groups
     */
    public function getGroups(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/groups');
    }

    /**
     * get all groups id's
     *
     * @see https://docs.ultramsg.com/api/get/groups/ids
     */
    public function getGroupsIds(bool $clearIds = false): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/groups/ids', [
            'clear' => $clearIds,
        ]);
    }

    /**
     * Get group info and participants
     *
     * @see https://docs.ultramsg.com/api/get/groups/group
     */
    public function getGroupInfo(string $groupId, int $priority = 5): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/groups/group', [
            'groupId' => $groupId,
            'priority' => $priority,
        ]);
    }
}
