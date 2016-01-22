<?php namespace Paxx\Telldus\Api;

class Client extends BaseApi
{
    /**
     * @var int|null
     */
    private $id;

    public function __construct($client, $id)
    {
        parent::__construct($client);

        $this->id = $id;
    }

    /**
     * Returns informaiton about a specific client
     *
     * @param $uuid - (optional) An optional uuid for a client. By specifying the uuid, info about a non registered client can be fetched
     * @param $code - (optional) If a activation code from a TellStick Net is supplied here the uuid could be omitted. Only non activated units can be fetched this way.
     * @param $extras - (optional) Comma-delimited list. Supported fields are: coordinate, suntime, timezone and tzoffset
     * @return mixed
     */
    public function info($uuid, $code, $extras)
    {
        return $this->request('client/info', array(
            'id'     => $this->id,
            'uuid'   => $uuid,
            'code'   => $code,
            'extras' => $extras
        ));
    }

    /**
     * Register an unregistered client to the calling user
     *
     * @param $uuid - The specific clients uuid
     * @return mixed
     */
    public function register($uuid)
    {
        return $this->request('client/register', array(
            'id'   => $this->id,
            'uuid' => $uuid
        ));
    }

    /**
     * Removes a client from the user. The client needs to be activated again in order to be used
     *
     * @return mixed
     */
    public function remove()
    {
        return $this->request('client/remove', array(
            'id' => $this->id
        ));
    }

    /**
     * Renames a client
     *
     * @param string $name - The new name
     * @return mixed
     */
    public function setName($name)
    {
        return $this->request('client/setName', array(
            'id' => $this->id,
            'name' => $name
        ));
    }

    /**
     * Enables or disables push from this client. The current API key must be configured for push for this to work.
     *
     * @param bool|true $enable
     * @return mixed
     */
    public function setPush($enable=true)
    {
        $enable = (int) $enable;

        return $this->request('client/setPush', array(
            'id' => $this->id,
            'enable' => $enable
        ));
    }

}