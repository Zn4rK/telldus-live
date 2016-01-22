<?php namespace Paxx\Telldus\Api;

class Sensor extends BaseApi
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
     * Returns information about a specific sensor. You are not allowed to call this function more often than every 10 minutes.
     *
     * @param null|bool $useAlternativeData
     * @return mixed
     */
    public function info($useAlternativeData=null)
    {
        if($useAlternativeData !== null) {
            $useAlternativeData = (int) $useAlternativeData;
        }

        return $this->request('sensor/info', array(
            'id' => $this->id,
            'useAlternativeData' => $useAlternativeData
        ));
    }

    /**
     * Mark a sensor as 'ignored'. Ignored sensors will not show up in sensors/list if not explicit set to do so.
     *
     * @param bool|true $ignore - 1 to ignore the sensor, 0 to inlude it again
     * @return mixed
     */
    public function setIgnore($ignore=true)
    {
        $ignore = (int) $ignore;

        return $this->request('sensor/setIgnore', array(
            'id' => $this->id,
            'ignore' => $ignore
        ));
    }

    /**
     * Renames a sensor
     *
     * @param $name - The new name
     * @return mixed
     */
    public function setName($name)
    {
        return $this->request('sensor/setName', array(
            'id' => $this->id,
            'name' => $name
        ));
    }
}