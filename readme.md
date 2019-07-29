# Sendinblue Tracker SDK For PHP

## Installation

```php
composer require chrisbraybrooke/sendinblue-tracker
```



###Laravel Usage

Laravel will autodiscover our service provider and register the alias. The only additional setup is to add the following to your config/services.php and .ENV files.

```php
// config/services.php

'sendinblue' => [
    'tracker_id' => env('SENDINBLUE_TRACKER_ID'),
],
```

We are now able to use the available methods to communicate with sendinblue.

#### Identify

The is the primary way to create a new user within sendinblue or update an exsisting one. The primary way of indentifying users is via their email address.

```php
use SendinBlueTracker;

SendinBlueTracker::identify('christian.braybrooke@gmail.com', [
    'FIRSTNAME' => 'Christian',
    'LASTNAME' => 'Braybrooke'
]);
```



#### Event

The next method is how we fire an event within sendinblue, this can be used to trigger workflows and other types of automation.

````php
use SendinBlueTracker;

SendinBlueTracker::event(
    'christian.braybrooke@gmail.com',
    'eventName',
  	// Event Data
    [
      'CTA_URL' => 'https://www.example.com',
      'COST' => '20.00'
    ],
  	// User Data
    [
      'FIRSTNAME' => 'Chris'
    ],
);
````





