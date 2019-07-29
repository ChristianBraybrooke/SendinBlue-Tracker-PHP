<?php

namespace ChrisBraybrooke\SendinBlueTracker\Traits;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as HttpClient;
use ChrisBraybrooke\SendinBlueTracker\Exceptions\TimeoutException;
use ChrisBraybrooke\SendinBlueTracker\Exceptions\NotFoundException;
use ChrisBraybrooke\SendinBlueTracker\Exceptions\ValidationException;
use ChrisBraybrooke\SendinBlueTracker\Exceptions\FailedActionException;

trait MakesHttpRequests
{
    /**
     * Make a POST request to the sendinblue servers and return the response.
     *
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    private function post($uri, array $payload = [])
    {
        return $this->request('POST', $uri, $payload);
    }

    /**
     * Make request to the sendinblue servers and return the response.
     *
     * @param  string $verb
     * @param  string $uri
     * @param  array $payload
     * @return mixed
     */
    private function request($verb, $uri, array $payload = [])
    {
        $response = $this->guzzle->request($verb, $uri,
            empty($payload) ? [] : ['json' => $payload]
        );
        if ($response->getStatusCode() != 200) {
            return $this->handleRequestError($response);
        }
        $responseBody = (string) $response->getBody();
        return json_decode($responseBody, true) ?: $responseBody;
    }

    /**
     * @param  \Psr\Http\Message\ResponseInterface $response
     * @return void
     */
    private function handleRequestError(ResponseInterface $response)
    {
        if ($response->getStatusCode() == 422) {
            throw new ValidationException(json_decode((string) $response->getBody(), true));
        }
        if ($response->getStatusCode() == 404) {
            throw new NotFoundException();
        }
        if ($response->getStatusCode() == 400) {
            throw new FailedActionException((string) $response->getBody());
        }
        throw new \Exception((string) $response->getBody());
    }

    /**
     * Setup guzzle ready to make requests.
     *
     * @return void
     */
    private function setupGuzzle()
    {
        $this->guzzle = new HttpClient([
            'base_uri' => 'https://in-automate.sendinblue.com/api/v2/',
            'http_errors' => false,
            'headers' => [
                'Ma-Key' => $this->trackerId,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ]);
    }
}