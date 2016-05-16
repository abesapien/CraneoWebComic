<?php

namespace Services;
use \Entity\Page;
use Entity\PageRepository;

class WebComicService {

    protected $imageService;
    public    $comic_dir;

    function __construct() { 
        $this->comic_dir = '/pages';
    }

    public function getComicPanelImage($page_number=0, $action='none') {
        $page = new Page();
        $page->setPageNumber($page_number);
        $page->setTitle("TDD WebComic Slide: " . $page_number);

        $page = $this->setActionHandler($page, $action);

        return $page;
    }

    public function getNextPage($page) {
        $current_page_number = $page->getPageNumber();

        $page->setPageNumber($current_page_number + 1);

        return $page;
    }

    public function getPreviousPage($page) {
        $current_page_number = $page->getPageNumber();

        $page->setPageNumber($current_page_number - 1);

        return $page;
    }

    public function getAllPages($page) {
        /** Important point regarding the testability and separation here.  */
        $pages_repo = new PageRepository();
        $results    = $pages_repo->getAllPageImages();
        $page->setRelatives($results);

        //$page = new Page();  //<-- watch out test fail if this uncommented.

        return $page;
    }

    private function getRandomPage() {

        $page = $this->getComicPanelImage(rand(1,10));
        return $page;

    }

    private function setActionHandler($page, $action) {
        $valid_actions = [
            'next'     => 'getNextPage',
            'previous' => 'getPreviousPage',
            'list'     => 'getAllPages',
            'none'     => null
        ];

        if ((!empty($valid_actions[$action]))) {
            $page->setAction($action);

            call_user_func(array(get_class($this), $valid_actions[$action]), $page);
        }

        return $page;
    }



}

?>
