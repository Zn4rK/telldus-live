<?php namespace Paxx\Telldus\Api;

class Device extends BaseApi {

    /**
     * @var int|null
     */
    private $id;

    public function __construct($client, $id) {
        parent::__construct($client);

        $this->id = $id;
    }

    /**
     * Adds a new device and connects it to a client. The client must be editable for this to work
     *
     * @param $clientId - The id of the client
     * @param $name - The name of the device
     * @param $protocol - The protocol
     * @param $model - The model
     * @return mixed
     */
    public function add($clientId, $name, $protocol, $model) {
        return $this->request('device/add', array(
            'clientId' => $clientId,
            'name'     => $name,
            'protocol' => $protocol,
            'model'    => $model
        ));
    }

    /**
     * Sends bell command to devices supporting this.
     *
     * @return mixed
     */
    public function bell()
    {
        return $this->request('device/bell', array(
            'id' => $this->id
        ));
    }

    /**
     * Sends a command to a device
     *
     * @param mixed $method - This should be any of the method constants
     * @param null|mixed $value - For command where a value is needed, this is the value
     * @return mixed
     */
    public function command($method, $value=null)
    {
        return $this->request('device/command', array(
            'id' => $this->id,
            'method' => $method,
            'value' => $value
        ));
    }

    /**
     * Sends a dim command to devices supporting this.
     *
     * @param int $level - The level the device should dim to. This value should be 0-255
     * @return mixed
     */
    public function dim($level)
    {
        return $this->request('device/dim', array(
            'id' => $this->id,
            'level' => $level
        ));
    }

    /**
     * @return mixed
     */
    public function down()
    {
        return $this->request('device/down', array(
            'id' => $this->id
        ));
    }


    /**
     * BETA Parameters and data structure may be modified without notice
     *
     * Get all device states from a certain period. The data is limited to 5000 rows.
     * For some device types, failures will be logged too.
     * If successStatus is anything else than 0, the command was NOT executed.
     *
     * If no parameters provided, the api will use to = 0, from = time()
     *
     * @param null|int $from - Timestamp from, in seconds
     * @param null|int $to - Timestamp to, in seconds
     * @param null|string $extras - (optional) A comma-delimited list of extra information to fetch for each returned device. Currently supported fields are: timezone and tzoffset
     * @return mixed
     */
    public function history($from=null, $to=null, $extras=null)
    {
        if($from === null) {
            $from = 0;
        }

        if($to === null) {
            $to = time();
        }

        return $this->request('device/history', array(
            'id'     => $this->id,
            'from'   => $from,
            'to'     => $to,
            'extras' => $extras
        ));
    }

    /**
     * Returns information about a specific device
     *
     * @param mixed|null $supportedMethods - The methods supported by the calling application
     * @param string|null $extras - Comma-delimited list. Currently supported fields are: coordinate, timezone, transport, and tzoffset
     * @return mixed
     */
    public function info($supportedMethods=null, $extras=null)
    {
        return $this->request('device/info', array(
            'id'               => $this->id,
            'supportedMethods' => $supportedMethods,
            'extras'           => $extras
        ));
    }

    /**
     * Sends a special learn command to some devices that need a special learn-command to be used from TellStick
     *
     * @return mixed
     */
    public function learn()
    {
        return $this->request('device/learn', array(
            'id' => $this->id
        ));
    }

    /**
     * Removes a device. It is only possible to remove editable devices.
     *
     * @return mixed
     */
    public function remove()
    {
        return $this->request('device/remove', array(
            'id' => $this->id
        ));
    }

    /**
     * Mark a device as 'ignored'. Ignored devices will not show up in devices/list if not explicit set to do so.
     *
     * @param bool|true $ignore - true to ignore the device, false to include it again
     * @return mixed
     */
    public function setIgnore($ignore=true)
    {
        return $this->request('device/setIgnore', array(
            'id'     => $this->id,
            'ignore' => $ignore
        ));
    }

    /**
     * Renames a device
     *
     * @param string $name - The new name
     * @return mixed
     */
    public function setName($name)
    {
        return $this->request('device/setName', array(
            'id'   => $this->id,
            'name' => $name
        ));
    }

    /**
     * Set device model
     *
     * @param string $model - The new model
     * @return mixed
     */
    public function setModel($model)
    {
        return $this->request('device/setModel', array(
            'id'    => $this->id,
            'model' => $model
        ));
    }

    /**
     * Set device protocol
     *
     * @param string $protocol - The new protocol name
     * @return mixed
     */
    public function setProtocol($protocol)
    {
        return $this->request('device/setProtocol', array(
            'id'       => $this->id,
            'protocol' => $protocol
        ));
    }

    /**
     * Set a device parameter
     *
     * @param string $parameter - Parameter name
     * @param mixed $value - Parameter value
     * @return mixed
     */
    public function setParameter($parameter, $value)
    {
        return $this->request('device/setProtocol', array(
            'id'        => $this->id,
            'parameter' => $parameter,
            'value'     => $value
        ));
    }

    /**
     * Send a "stop" command to device.
     *
     * @return mixed
     */
    public function stop()
    {
        return $this->request('device/stop', array(
            'id' => $this->id
        ));
    }

    /**
     * Turns a device off.
     *
     * @return mixed
     */
    public function turnOff()
    {
        return $this->request('device/turnOff', array(
            'id' => $this->id
        ));
    }

    /**
     * Turns a device on.
     *
     * @return mixed
     */
    public function turnOn()
    {
        return $this->request('device/turnOn', array(
            'id' => $this->id
        ));
    }

    /**
     * @return mixed
     */
    public function up()
    {
        return $this->request('device/up', array(
            'id' => $this->id
        ));
    }
}