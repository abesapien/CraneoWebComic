<?php
namespace Entity;

class Page {
    public $page_number;

    public $title;

    public $action = 'none';

    public $relatives;

    /**
     * @return mixed
     */
    public function getPageNumber()
    {
        return $this->page_number;
    }

    /**
     * @param mixed $issue_number
     */
    public function setPageNumber($page_number)
    {
        $this->page_number = $page_number;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }


    /**
     * @return array
     */
    public function getRelatives()
    {
        return $this->relatives;
    }

    /**
     * @param array $relatives
     */
    public function setRelatives($relatives)
    {
        $this->relatives = $relatives;
    }
}
