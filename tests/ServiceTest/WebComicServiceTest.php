<?php

namespace SearchServiceTest;

require __DIR__ . '/../test_bootstrap.php';
require __DIR__ . '/../../app/Services/WebComicService.php';

use \Entity\Page;
use Base\TestCaseBase;

class WebComicServiceTest extends TestCaseBase {
    private $pageRepositoryMock;

    public function setUp() {
        parent::setUp();

        $this->obj = new \Services\WebComicService();
        $this->app = new \Silex\Application();

        $this->pageRepositoryMock = $this->getMockBuilder('Entity\Page')
            ->getMock();

        $this->pageRepositoryMock->expects($this->any())
            ->method('getAllPageImages')
            ->will($this->returnValue($this->createGetAllPagesResponse()));
    }

    public function testPageNumberIsSet()  {
        $input_page_number = 1;

        $page = $this->obj->getComicPanelImage(1);

        $this->assertEquals($page->getPageNumber(), $input_page_number);
    }

    public function testNextPage() {
        $current_index = 3;

        $page = $this->obj->getComicPanelImage($current_index);

        $this->obj->getNextPage($page);

        $this->assertEquals($page->getPageNumber(), $current_index + 1);
    }

    public function testPrevious() {
        $current_index = 3;

        $page = $this->obj->getComicPanelImage($current_index);

        $this->obj->getPreviousPage($page);

        $this->assertEquals($page->getPageNumber(), $current_index - 1);
    }

    public function testActionHandler() {
        $current_index = 1;
        $valid_actions = ['next', 'previous', 'list', 'none'];

        foreach ($valid_actions as $current_action) {
            $page = $this->obj->getComicPanelImage($current_index, $current_action);
            $this->assertEquals($page->getAction(), $current_action);
        }
    }

    public function testPageListingsReturnsCorrectFormat() {
        $page = new Page();

        $mocked_page_with_relatives = $this->obj->getAllPages($page);

        $relatives_fixture_object   = $this->createGetAllPagesResponse();
        $relatives_fixture_array    = $relatives_fixture_object->getRelatives();

        // Taking the generic Page object and setting it manually with the same array.
        $page->setRelatives($relatives_fixture_array);

        $this->assertEquals($mocked_page_with_relatives->getRelatives(), $page->getRelatives());
    }

    private function createGetAllPagesResponse() {
        $parent_page = new Page();

        $child_page1 = new Page();
        $child_page2 = new Page();

        $relatives = [
            $child_page1,
            $child_page2,
        ];

        $parent_page->setRelatives($relatives);

        return $parent_page;

    }

    public function testCheckRandomPageWasCreated() {
        $page = new Page();

        //$mocked_page_with_relatives = $this->obj->getAllPages($page);
        $page_numbers = [1,2];
        $expected_page_object = null;

        foreach ($page_numbers as $n) {
            $this->assertEquals($expected_page_object, $page);

        }
    }

}
