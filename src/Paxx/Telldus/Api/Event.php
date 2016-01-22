<?php namespace Paxx\Telldus\Api;

class Event extends BaseApi
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
     * Returns the info of an event.
     *
     * @return mixed
     */
    public function info()
    {
        return $this->request('event/info', array(
            'id' => $this->id
        ));
    }

    /**
     * Adds or updates a event to the system. Set id to 0 if you want to create a new event
     *
     * @param $description - A user friendly description for this event
     * @param $minRepeatInterval - Sets the minimum time that needs to pass before this event can execute again. Defaults to 30 seconds.
     * @param $active - Is the event active or paused?
     */
    public function setEvent($description, $minRepeatInterval, $active)
    {
        // todo: implement this
    }

    /**
     * todo: implement this
     *
     * Adds or update a new sensor as trigger to an event.
     *
     * @param null $triggerId - The id of the trigger. Leave empty to create a new trigger
     * @param $sensorId
     * @param $hour
     * @param $minute
     *
     * @return mixed
     */
    public function setBlockHeaterTrigger($triggerId=null, $sensorId, $hour, $minute)
    {
        // todo: implement this - http://api.telldus.com/explore/event/setBlockHeaterTrigger
        /*
         $this->request('event/setBlockHeaterTrigger', array(
            'id' => $triggerId,
            'eventId' => $this->id,
            'sensorId' => $sensorId,
            'hour' => $hour,
            'minute' => $minute
         ));
         */
    }

    public function setDeviceAction()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setDeviceAction
    }

    public function setDeviceCondition()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setDeviceCondition
    }

    public function setDeviceTrigger()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setDeviceTrigger
    }

    public function setEmailAction()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setEmailAction
    }

    public function setPushAction()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setPushAction
    }

    public function setSMSAction()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setSMSAction
    }

    public function setSensorCondition()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setSensorCondition
    }

    public function setSensorTrigger()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setSensorTrigger
    }

    public function setSuntimeCondition()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setSuntimeCondition
    }

    public function setSuntimeTrigger()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setSuntimeTrigger
    }

    public function setTimeCondition()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setTimeCondition
    }

    public function setTimeTrigger()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setTimeTrigger
    }

    public function setURLAction()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setURLAction
    }

    public function setWeekdaysCondition()
    {
        // todo: implement this - http://api.telldus.com/explore/event/setWeekdaysCondition
    }

    public function removeAction()
    {
        // todo: implement this - http://api.telldus.com/explore/event/removeAction
    }

    public function removeCondition()
    {
        // todo: implement this - http://api.telldus.com/explore/event/removeCondition
    }

    /**
     * Removes an event.
     *
     * @return mixed
     */
    public function removeEvent()
    {
        return $this->request('event/removeEvent', array(
            'id' => $this->id
        ));
    }

    public function removeTrigger()
    {
        // todo: implement this - http://api.telldus.com/explore/event/removeTrigger
    }

}