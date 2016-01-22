<?php namespace Paxx\Telldus\Api;

use GuzzleHttp\Client;
use Paxx\Telldus\Exception\ApiException;

abstract class BaseApi {

    /**
     * @var Client
     */
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Make a request to the API
     *
     * todo: find out if the protocol supports anything other than get and change requests so they use the correct http method
     *
     * @param string $path
     * @param array $params
     * @return mixed
     * @throws ApiException
     */
    protected function request($path = '', $params = array())
    {
        $request = $this->client->get($path, array('query' => $params));

        // Decode the response
        $response = json_decode($request->getBody()->getContents(), true);

        // Check for errors
        $this->checkError($response);

        return $response;
    }

    /**
     * Checks the response and throws and error if we got one
     *
     * @param $response
     * @throws ApiException
     */
    private function checkError($response)
    {
        if(isset($response['error'])) {
            throw new ApiException($response['error']);
        }
    }
}