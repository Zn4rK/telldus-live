<?php
/**
 * This is a complete oauth-example. Use this if you're building a public application that others can use.
 * Otherwise, check out index.php
 */
require '../vendor/autoload.php';

session_start();

$config = array(
    'identifier'   => 'your-public-key',
    'secret'       => 'your-private-key',
    'callback_uri' => "http://your-callback.lan/oauth.php",
);

$server = new Paxx\Telldus\Server\Telldus($config);

if(isset($_SESSION['identifier'], $_SESSION['secret'])) {
    // Step 3

    // Init API
    $api = new Paxx\Telldus\Api(array(
        'identifier'      => $config['identifier'],
        'secret'          => $config['secret'],
        'user_identifier' => $_SESSION['user_identifier'],
        'user_secret'     => $_SESSION['user_secret']
    ));

    // Get all devices
    $devices = $api->devices();

    // Holder for the device we want
    $deviceId = null;

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

    // Exit so we don't enter the if-statement below again
    die();
}

if (isset($_GET['oauth_token'])) {
    // Step 2

    // Retrieve the temporary credentials from step 2
    $temporaryCredentials = unserialize($_SESSION['temporary_credentials']);

    // Retrieve token credentials - you can save these for permanent usage
    $tokenCredentials = $server->getTokenCredentials($temporaryCredentials, $_GET['oauth_token'], $_GET['oauth_verifier']);

    $_SESSION['user_identifier'] = $tokenCredentials->getIdentifier();
    $_SESSION['user_secret']     = $tokenCredentials->getSecret();

    // Get back to this page, but with our sessions
    header('Location: ?');
} else {
    // Step 1

    // These identify you as a client to the server.
    $temporaryCredentials = $server->getTemporaryCredentials();

    // Store the credentials in the session.
    $_SESSION['temporary_credentials'] = serialize($temporaryCredentials);

    // Redirect the resource owner to the login screen on Telldus.
    $server->authorize($temporaryCredentials);
}