<?php

$app['webcomic.service'] = $app->share(function ($app) {
    return new Services\WebComicService($app);
});

$app['webcomic.controller'] = $app->share(function ($app) {
    return new Controllers\WebComicController($app['webcomic.service'], $app);
});
