<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractRepository
{

    /**
     * @var array
     */
    private $headers = [
        'Content-Type' => 'application/json'
    ];

    /**
     * @var Client
     */
    private $client;

    /**
     * AbstractRepository constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @return mixed
     */
    protected abstract function baseUrl();

    /**
     * @return Client
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * @param $resourcePath
     * @return string
     */
    public function buildUrl($resourcePath)
    {
        $numArgs = func_num_args();
        $argList = func_get_args();

        $fullResourceUrl = $this->baseUrl() . $resourcePath;
        $fullResourceUrlAux = $fullResourceUrl;

        if ($numArgs > 1) {
            $paramsResource = array();
            for ($i = 1; $i < $numArgs; $i++) {
                $paramsResource[] = $argList[$i];
            }

            $fullResourceUrl = vsprintf($fullResourceUrlAux, $paramsResource);
            if ($fullResourceUrl == $fullResourceUrlAux) {
                $fullResourceUrl = preg_replace_array("/\{(.*?)\}/", $paramsResource, $fullResourceUrl);
            }
        }

        return $fullResourceUrl;
    }

    /**
     * @param ResponseInterface $response
     * @param bool $json
     * @return mixed
     */
    public function formatResponse(ResponseInterface $response, $json = true)
    {
        if ($json) {
            $response = response($response->getBody()->getContents(), $response->getStatusCode())
                ->header('Content-Type', 'application/json')
                ->header('Server-DateTime', date('Y-m-d H:i:s'));
        } else {
            $response = (object)json_decode($response->getBody()->getContents());
        }

        return $response;
    }


    /**
     * @param $url
     * @param array $query
     * @param bool $json
     * @return string
     */
    public function clientGet($url, $query = [], $json = true)
    {
        $response = $this->getClient()->get($url, ['query' => $query]);
        return $this->formatResponse($response, $json);
    }

    /**
     * @param $url
     * @param $data
     * @param bool $json
     * @return string
     */
    public function clientPost($url, $data, $json = true)
    {
        $response = $this->getClient()->post($url, ['json' => $data, 'headers' => $this->headers]);
        return $this->formatResponse($response, $json);
    }

    /**
     * @param $url
     * @param $data
     * @param bool $json
     * @return string
     */
    public function clientPut($url, $data, $json = true)
    {
        $response = $this->getClient()->put($url, ['json' => $data, 'headers' => $this->headers]);
        return $this->formatResponse($response, $json);
    }

    /**
     * @param $url
     * @param $data
     * @param bool $json
     * @return mixed
     */
    public function clientPatch($url, $data, $json = true)
    {
        $response = $this->getClient()->patch($url, ['json' => $data, 'headers' => $this->headers]);
        return $this->formatResponse($response, $json);
    }

    /**
     * @param $url
     * @param array $data
     * @return mixed
     */
    public function clientDelete($url, $data = [])
    {
        if (!empty($data)) {
            $response = $this->getClient()->delete($url, ['json' => $data, 'headers' => $this->headers]);
        } else {
            $response = $this->getClient()->delete($url);
        }
        return $this->formatResponse($response);
    }

}