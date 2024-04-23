<?php declare(strict_types=1);

namespace OpenDaje\UmWa\Api;

class Groups extends AbstractApi
{
    /**
     * get all groups info and participants
     * @see https://docs.ultramsg.com/api/get/groups
     */
    public function getGroups(): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/groups');
    }

    /**
     * get all groups id's
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
     * @see https://docs.ultramsg.com/api/get/groups/group
     *
     * @param string $groupId groupId e.g 14155552671-441234567890@g.us
     *
     * @param int $priority This parameter is optional, You can use it to create a professional queue for messages, The Messages with less priority value are sent first.
     * example of usage :
     * priority = 0: for High priority like OTP messages.
     * priority = 5: used with general messages.
     * priority =10: Non-urgent promotional offers and notifications to your customers.
     * Default value : 10
     */
    public function getGroupInfo(string $groupId, int $priority = 5): array|string
    {
        return $this->get('/' . rawurlencode($this->getInstanceId()) . '/groups/group', [
            'groupId' => $groupId,
            'priority' => $priority,
        ]);
    }
}
