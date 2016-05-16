<?php

use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\Debug\ErrorHandler;

$loader = require __DIR__.'/vendor/autoload.php';

$loader->add('Controllers', __DIR__ . '/app');
$loader->add('Services', __DIR__ . '/app');
$loader->add('Entity', __DIR__ . '/app');

ErrorHandler::register();

$app = new Silex\Application();

$app->register(new Silex\Provider\ServiceControllerServiceProvider());

include __DIR__ . '/conf/routes.php';

include __DIR__ . '/conf/dependency_injections.php';

// Get application environment from server. Don't accept anything with non-word characters ([0-9A-Za-z_])
if(!empty($_SERVER['WEBCOMIC_ENVIRONMENT']) && !preg_match('/[^\w]/', $_SERVER['WEBCOMIC_ENVIRONMENT'])) {
    $app['env'] = $_SERVER['WEBCOMIC_ENVIRONMENT'];
} else {
    $app['env'] = 'dev';
}

if ($app['env'] == 'prod') {
    include __DIR__ . '/conf/configuration.php';
} else {
    include __DIR__ . '/conf/configuration.local.php';
}

require_once __DIR__ . '/app/Utils/conversion.php';

$app->error(function ( \Exception $e, $code ) use ($app) {

  $error = array( 'message' => $e->getMessage() );

  return $app->json( $error, 200 );
});

$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/app/views',
    ));

return [$app, $loader];


