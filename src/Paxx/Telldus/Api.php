<?php namespace Paxx\Telldus;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;
use Paxx\Telldus\Api\BaseApi;
use Paxx\Telldus\Exception\ApiException;

class Api extends BaseApi {
    const ENDPOINT = 'http://api.telldus.com/json/';

    private $identifier;
    private $secret;
    private $token;
    private $token_secret;

    private $client;

    private $required_params = array(
        'identifier',
        'secret',
        'user_identifier',
        'user_secret',
    );

    public function __construct(array $params = array()) {
        $this->hydrateParams($params);

        $config = array(
            'consumer_key'    => $this->identifier,
            'consumer_secret' => $this->secret,
            'token'           => $this->token,
            'token_secret'    => $this->token_secret,
            'request_method'  => 'query'
        );

        // Create a stack so we can add the oauth-subscriber
        $stack = HandlerStack::create();
        $stack->push(new Oauth1($config));

        $this->client = new Client([
            'base_uri' => static::ENDPOINT,
            'handler'  => $stack,
            'auth'     => 'oauth'
        ]);

        parent::__construct($this->client);
    }

    /**
     * Hydrate object from passed parameters
     *
     * @param array $params
     * @throws Exception
     */
    private function hydrateParams(array $params)
    {
        $this->validateParams($params);
        foreach ($this->required_params as $param) {
            $this->{$param} = $params[$param];
        }
    }

    /**
     * Validate that the required parameters were passed into object constructor
     *
     * @param array $params
     * @throws Exception
     */
    private function validateParams(array $params)
    {
        foreach ($this->required_params as $param) {
            if (! isset($params{$param})) {
                throw new ApiException('Missing parameters');
            }
        }
    }

    /**
     * Returns a list of all devices associated with the current user
     *
     * @param null|bool $includeIgnored - Set to true to include ignored devices
     * @param null $supportedMethods - The methods supported by the calling application. If this parameter is not set the methods and state will always report 0.
     * @param null $extras - Comma-delimited list. Currently supported fields are: coordinate, timezone, transport, and tzoffset
     * @return mixed
     */
    public function devices($includeIgnored=null, $supportedMethods=null, $extras=null)
    {
        if($includeIgnored !== null) {
            $includeIgnored = (int) $includeIgnored;
        }

        $devices = $this->request('devices/list', array(
            'includeIgnored'   => $includeIgnored,
            'supportedMethods' => $supportedMethods,
            'extras'           => $extras
        ));

        return $devices['device'];
    }

    /**
     * Creates Device API instance
     *
     * @param int|null $id - Device id
     * @return Api\Device
     */
    public function device($id=null) {
        return new Api\Device($this->client, $id);
    }

    /**
     * Returns a list of all clients associated with the current user
     *
     * @param $extras - Comma-delimited list. Supported fields are: coordinate, features, latestversion, suntime, timezone, transports and tzoffset
     * @return mixed|array
     */
    public function clients($extras=null)
    {
        $clients = $this->request('clients/list', array(
            'extras' => $extras
        ));

        return $clients['client'];
    }

    /**
     * Creates a Client API instance
     *
     * @param int|null $id - Client id
     * @return Api\Client
     */
    public function client($id = null) {
        return new Api\Client($this->client, $id);
    }

    /**
     * Creates a Group API instance
     *
     * @param null $id
     * @return Api\Group
     */
    public function group($id = null) {
        return new Api\Group($this->client, $id);
    }

    /**
     * Returns a list of all sensors associated with the current user
     *
     * @param null|bool $includeIgnored - Set to true to include ignored sensors
     * @param null|bool $includeValues - Set to true to include the last value for each sensor
     * @param null|bool $includeScale - Set to true to include the scale types for values (only valid if combined with 'includeValues'), this will return values in a separate list
     * @param null|bool $useAlternativeData - BETA Use sensor data from alternative storage, this parameter will be REMOVED in the future (alternative storage will always be used) BETA
     * @return mixed
     */
    public function sensors($includeIgnored=null, $includeValues=null, $includeScale=null, $useAlternativeData=null)
    {
        if($includeIgnored !== null) {
            $includeIgnored = (int) $includeIgnored;
        }

        if($includeValues !== null) {
            $includeValues = (int) $includeValues;
        }

        if($includeScale !== null) {
            $includeValues = (int) $includeValues;
        }

        if($useAlternativeData !== null) {
            $useAlternativeData = (int) $useAlternativeData;
        }

        $response = $this->request('sensors/list', array(
            'includeIgnored'     => $includeIgnored,
            'includeValues'      => $includeValues,
            'includeScale'       => $includeScale,
            'useAlternativeData' => $useAlternativeData
        ));

        return $response['sensor'];
    }

    /**
     * Creates a Sensor API instance
     *
     * @param null $id - Sensor id
     * @return Api\Sensor
     */
    public function sensor($id=null)
    {
        return new Api\Sensor($this->client, $id);
    }

    /**
     * Returns a list of events
     *
     * @param true|null $listOnly - Only list the events and do not return triggers, conditions and actions.
     * @return mixed
     */
    public function events($listOnly=null) {
        if($listOnly !== null && $listOnly === true) {
            $listOnly = 1;
        }

        $response = $this->request('events/list', array(
            'listOnly' => $listOnly
        ));

        return $response['event'];
    }

    /**
     * Creates a Event API instance
     *
     * @param null $id - Event id
     * @return Api\Event
     */
    public function event($id=null)
    {
        return new Api\Event($this->client, $id);
    }

}