<?php namespace Paxx\Telldus\Api;

class Group extends BaseApi
{
    /**
     * @var int|null
     */
    private $id;

    public function __construct($client, $id) {
        parent::__construct($client);

        $this->id = $id;
    }

    /**
     * Adds a new group with devices and connects it to a client. The client must be editable for this to work.
     * Please note that groups are devices as well. This means that all device/* commands will work for groups too.
     *
     * @param $clientId - The id of the client
     * @param $name - The name of the group
     * @param $devices - A comma separated string with the device ids this group should control
     * @return mixed
     */
    public function add($clientId, $name, $devices)
    {
        return $this->request('group/add', array(
            'clientId' => $clientId,
            'name'     => $name,
            'devices'  => $devices
        ));
    }

    /**
     * Removes a group.
     *
     * @return mixed
     */
    public function remove()
    {
        return $this->request('group/remove', array(
            'id' => $this->id
        ));
    }
}