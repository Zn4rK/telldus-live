<?php
/**
 * Use this if you're building an application just for you.
 *
 * On Telldus, you have the option to create a private token for your user, and don't have to go through the oauth-process
 * since Telldus generates a token and token_secret for you.
 *
 * Go to @see http://api.telldus.com/keys/index and click "Generate a private token for my user only"
 *
 * After that you can use the API as follows:
 */

$api = new Paxx\Telldus\Api(array(
    'identifier'      => 'your-public-key',
    'secret'          => 'your-private-key',
    'user_identifier' => 'your-token',
    'user_secret'     => 'your-token-secret'
));

// Get all devices
$devices = $api->devices();

// Holder for the device we want
$deviceId = null;

// Find the device we want
foreach($devices as $device) {
    if($device['name'] === 'Kitchen') { // change this to your device-name
        $deviceId = $device['id'];
        break;
    }
}

if($deviceId !== null) {
    // Turn kitchen off, on, off, on
    $kitchen = $api->device($deviceId);

    $kitchen->turnOff();
    $kitchen->turnOn();
    $kitchen->turnOff();
    $kitchen->turnOn();
}

