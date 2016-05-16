<?php

namespace ControllerTest;

require __DIR__ . '/../test_bootstrap.php';

use Base\TestCaseBase;
use Controllers\SearchController;

class WebComicControllerTest extends TestCaseBase {

  private $searchServiceMock;
  private $controller;

  public function setUp() {
    parent::setUp();

  }

  public function testPageRoute() {
      //$client = $this->createClient();

      //$client->request('GET', 'http://silex.local.crowdrise.com/page/0');

      //$this->assertEquals($client->getResponse()->getStatusCode(), 200);

      //$json = $client->getResponse()->getContent();

      //$data = object_to_array(json_decode($json));

  }


}
