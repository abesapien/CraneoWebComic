<?php

namespace Entity;

use \Entity\Page;

class PageRepository {
    public    $comic_dir;

    function __construct() {
        $this->comic_dir = '/pages';
    }

    public function getAllPageImages() {
        $path = __DIR__ . '/../../web' . $this->comic_dir;

        $images = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));

        $result_pages = [];

        foreach($images as $file){
            if ($file->isDir()) {
                continue;
            }

            $page = new Page();
            $page->setPageNumber($file->getBaseName('.jpg'));
            $page->setTitle('TDD WebComic Slide: ' . $page->getPageNumber());

            array_push($result_pages, $page);
        }
        return $result_pages;
    }

}


