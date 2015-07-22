<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/11/15
 * Time: 10:46 PM
 */

namespace class_lib\mapper;

use \class_lib\domain;
use \class_lib\mapper\collections\QualificationCollection;
use \class_lib\utilities\Date;

class PublicationMapper extends Mapper{
    function __construct() {
        parent::__construct();
        $this->selectStmt = self::$PDO->prepare(
            "SELECT * FROM publications WHERE id=?");
        $this->selectByAuthorStmt = self::$PDO->prepare(
            "SELECT * FROM publications WHERE author=?");
        $this->updateStmt = self::$PDO->prepare(
            "UPDATE publications set title=?,author=?,publisher=?,publication_year=?,
				scopus_indexed=?,thompson_indexed=?,status=? WHERE id=?");
        $this->insertStmt = self::$PDO->prepare(
            "INSERT INTO publications (title,author,publisher,publication_year,scopus_indexed,thompson_indexed,status)
 				VALUES (?,?,?,?,?,?,?)");
        $this->deleteStmt = self::$PDO->prepare(
            "DELETE FROM publications WHERE id=?");
	    $this->selectByStatusStmt = self::$PDO->prepare(
		    "SELECT * FROM publications WHERE status=?");
    }

	function findByStatus($status) {
		$this->selectByStatusStmt->execute( array($status) );
		$raw_data = $this->selectByStatusStmt->fetchAll(\PDO::FETCH_ASSOC);
		return $this->getCollection( $raw_data );
	}

	function findByAuthor($employeeId) {
        $this->selectByAuthorStmt->execute( array($employeeId) );
        $raw_data = $this->selectByAuthorStmt->fetchAll(\PDO::FETCH_ASSOC);
        return $this->getCollection( $raw_data );
    }

    function getCollection( array $raw ) {
        return new QualificationCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new domain\Publication($array['id']);
        $obj->setTitle($array['title']);
        $obj->setAuthor($array['author']);
        $obj->setPublisher($array['publisher']);
        $obj->setYear($array['publication_year']);
        $obj->setScopusIndexed($array['scopus_indexed']);
	    $obj->setThompsonIndexed($array['thompson_indexed']);
	    $obj->setStatus($array['status']);

        return $obj;
    }

    protected function doInsert( domain\DomainObject $object ) {
        $values = array(
	        $object->getTitle(),
	        $object->getAuthor(),
	        $object->getPublisher(),
	        $object->getYear(),
	        $object->isScopusIndexed(),
	        $object->isThompsonIndexed(),
	        $object->getStatus()
        );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }

    function doUpdate( domain\DomainObject $object ) {
	    $values = array(
		    $object->getTitle(),
		    $object->getAuthor(),
		    $object->getPublisher(),
		    $object->getYear(),
		    $object->isScopusIndexed(),
		    $object->isThompsonIndexed(),
		    $object->getStatus(),
		    $object->getId()
	    );
        $this->updateStmt->execute( $values );
    }

    function doDelete( domain\DomainObject $object ) {
        $values = array( $object->getId() );
        $this->deleteStmt->execute( $values );
    }

    function selectStmt() {
        return $this->selectStmt;
    }

    function selectAllStmt() {
        return $this->selectStmt;
    }

    function targetClass(){
        return "Publication";
    }
}