<?php

namespace Toolman\Http;

use GuzzleHttp\Client;
use Toolman\PropertyInterface;

abstract class BaseHttpRequest implements PropertyInterface
{
  const METHOD_GET = 'GET';
  const METHOD_POST = 'POST';
  const METHOD_PUT = 'PUT';

  const DEFAULT_HEADER = [
  ];

  public $method = self::METHOD_POST;

  public $headers = self::DEFAULT_HEADER;

  public function __construct($_config = [])
  {
    foreach ($_config as $key => $value) {
      $this->$key = $value;
    }
  }

  public function send()
  {
    $params = [];

    foreach ($this->property() as $key) {
      if (isset($this->$key)) {
        $params[$key] = $this->$key;    
      }
    }
    if ($this->method == static::METHOD_GET) {
      $requestParams = [
        'query' => $params,
        'headers' => $this->headers,
      ];
    } else if ($this->method == static::METHOD_PUT) {
      $requestParams = [
        'json' => $params,
        'headers' => $this->headers,
      ];
    } else {
      $requestParams = [
        'form_params' => $params,
        'headers' => $this->headers,
      ];
    } 
    $client = new Client([
      'base_uri' => $this->getEndpointBase(),
    ]);
    $response = $client->request($this->method, $this->getEndpoint(), $requestParams);
    $responseClassName = $this->getResponseClassName();

    return new $responseClassName($response->getBody()->getContents());
  }

  abstract public function getEndpointBase(): string;

  abstract public function getEndpoint(): string;

  abstract public function getResponseClassName(): string;
}
