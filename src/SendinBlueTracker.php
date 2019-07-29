<?php

namespace ChrisBraybrooke\SendinBlueTracker;

use ChrisBraybrooke\SendinBlueTracker\Traits\MakesHttpRequests;

class SendinBlueTracker
{
    use MakesHttpRequests;

    /**
     * The sendinblue Tracker ID
     *
     * @var String
     */
    public $trackerId;

    /**
     * The guzzle instance.
     *
     * @var HttpClient
     */
    public $guzzle;

    public function __construct($trackerId)
    {
        $this->trackerId = $trackerId;
        $this->setupGuzzle();
    }

    /**
     * Identify a user for sendinblue.
     *
     * @param  string $email
     * @param  array<key, value>  $userData
     * @return \ChrisBraybrooke\SendinBlueTracker\SendinBlueTracker
     */
    public function identify($email, array $userData = [])
    {
        $data = [
            'email' => $email
        ];
        if (!empty($userData)) {
            $data['attributes'] = $userData;
        }
        $this->post('identify', $data);
        return $this;
    }

    /**
     * Create a new event in sendblue for a user
     *
     * @param  string $email
     * @param  string $event
     * @param  array<key, value>  $eventData
     * @param  array<key, value>  $userData
     * @return \ChrisBraybrooke\SendinBlueTracker\SendinBlueTracker
     */
    public function event($email, $event, array $eventData = [], array $userData = [])
    {
        $data = [
            'email' => $email,
            'event' => $event
        ];
        if (!empty($userData)) {
            $data['properties'] = $userData;
        }
        if (!empty($eventData)) {
            $data['eventdata'] = $eventData;
        }
        $this->post('trackEvent', $data);
        return $this;
    }
}
