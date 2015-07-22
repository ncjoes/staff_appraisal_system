<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 8:19 PM
 */

namespace class_lib\domain;

use \class_lib\mapper\MapperRegistry;
use \class_lib\mapper\collections\PublicationCollection;
use \class_lib\mapper\collections\SupervisionCollection;

class TutorialStaff extends Staff{
    private $publications;
    private $supervisions;

    function __construct($id=null){
        parent::__construct($id);
    }

    function set_publications(PublicationCollection $publications){
        foreach($publications as $publication){
            $publication->setAuthor($this->get_employeeId());
        }
        $this->publications = $publications;
    }
    function get_publications(){
        if(!isset($this->publications)){
            $mapper = MapperRegistry::getMapper("Publication");
            $this->publications = $mapper->findByAuthor($this->get_employeeId());
        }
        return $this->publications;
    }
    function add_publication(Publication $publication){
        $publication->setAuthor($this->get_employeeId());
        $this->get_publications()->add($publication);
    }
    function remove_publication(Publication $publication){
        $this->get_publications()->remove($publication);
        $publication->markDelete();
    }

    function set_supervisions(SupervisionCollection $supervisions){
        foreach($supervisions as $supervision){
            $supervision->setSupervisor($this->get_employeeId());
        }
        $this->supervisions = $supervisions;
    }
    function get_supervisions(){
        if(!isset($this->supervisions)){
            $mapper = MapperRegistry::getMapper("Supervision");
            $this->supervisions = $mapper->findBySupervisor($this->get_employeeId());
        }
        return $this->supervisions;
    }
    function add_supervision(Supervision $supervision){
	    $supervision->setSupervisor($this->get_employeeId());
        $this->get_supervisions()->add($supervision);
    }
    function remove_supervision(Supervision $supervision){
        $this->get_supervisions()->remove($supervision);
	    $supervision->markDelete();
    }
}