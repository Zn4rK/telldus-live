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
     * Get devices
     */
    public function getDevices()
    {
        $devices = $this->request('devices/list');
        return $devices['device'];
    }

    /**
     * Get clients
     */
    public function getClients()
    {
        $clients = $this->request('clients/list');
        return $clients;
    }

    /**
     * Creates Device API instance
     *
     * @param int|null $id
     * @return Api\Device
     */
    public function device($id=null) {
        return new Api\Device($this->client, $id);
    }

    /**
     * Creates a Client API instance
     *
     * @return Api\Client
     */
    public function client() {
        return new Api\Client($this->client);
    }
}