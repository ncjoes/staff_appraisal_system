<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 8:21 PM
 */

namespace class_lib\domain;

class Publication extends Credential{
    private $title;
    private $author;
    private $publisher;
    private $year;
    private $scopus_indexed;
    private $thompson_indexed;

    function __construct($id=null){
        parent::__construct($id);
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
	    $this->markDirty();
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
	    $this->markDirty();
        return $this;
    }

    public function getPublisher()
    {
        return $this->publisher;
    }
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
	    $this->markDirty();
        return $this;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
        $this->markDirty();
        return $this;
    }

    public function isScopusIndexed()
    {
        return $this->scopus_indexed;
    }
    public function setScopusIndexed($scopus_indexed)
    {
        $this->scopus_indexed = $scopus_indexed;
	    $this->markDirty();
        return $this;
    }

    public function isThompsonIndexed()
    {
        return $this->thompson_indexed;
    }
    public function setThompsonIndexed($thompson_indexed)
    {
        $this->thompson_indexed = $thompson_indexed;
	    $this->markDirty();
        return $this;
    }
}