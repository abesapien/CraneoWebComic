<?php

namespace Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Exception;

class WebComicController {
    protected $web_comic_service;

    public $testapp;

    public function __construct($service, $app){
        $this->web_comic_service = $service;
        $this->app = $app;
    }

    public function render() {
        try {
            $page_number = $this->app['request']->get('page_number');
            $action      = $this->app['request']->get('action');

            return $this->app->json(array('page' => $this->web_comic_service->getComicPanelImage($page_number, $action)), 200);
        }
        catch (Exception $e) {
            return $this->app->json(array('error'=>array($e->getMessage())));
        }
    }


}
