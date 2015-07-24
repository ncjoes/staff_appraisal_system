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
use \class_lib\mapper\collections\TutorialStaffRankCollection;

class TutorialStaffRankMapper extends Mapper{

    function __construct() {
        parent::__construct();

	    $this->selectStmt = self::$PDO->prepare("SELECT * FROM tutorial_staff_ranks WHERE id=?");

	    $this->selectByRankIDStmt = self::$PDO->prepare("SELECT * FROM tutorial_staff_ranks WHERE rank_id=?");

	    //NB: rank_order is mapped such that the highest rank (prof.) has rank_order=1, next rank has order=2 a.s.o.
	    $this->selectUpperRanksStmt = self::$PDO->prepare("SELECT * FROM tutorial_staff_ranks WHERE rank_order<? ORDER BY rank_order DESC");
	    $this->selectLowerRanksStmt = self::$PDO->prepare("SELECT * FROM tutorial_staff_ranks WHERE rank_order>? ORDER BY rank_order ASC");

	    $this->selectAllStmt = self::$PDO->prepare("SELECT * FROM tutorial_staff_ranks ORDER BY rank_order ASC");

	    $this->updateStmt = self::$PDO->prepare(
            "UPDATE tutorial_staff_ranks set rank_order=?,rank_title=?,min_year_of_service=?,min_qualification=?,
				min_num_of_publications=?,min_num_of_supervisions=?,min_scopus_indexes=?,min_thompson_indexes=? WHERE id=?");

        $this->insertStmt = self::$PDO->prepare(
            "INSERT INTO tutorial_staff_ranks (rank_id,rank_order,rank_title,min_qualification,min_year_of_service,min_num_of_supervisions,
				min_num_of_publications,min_scopus_indexes,min_thompson_indexes)
 				VALUES (?,?,?,?,?,?,?,?,?)");

        $this->deleteStmt = self::$PDO->prepare("DELETE FROM tutorial_staff_ranks WHERE id=?");

    }

	function findByRankID($rankID){
		//do db stuff
		$this->selectByRankIDStmt->execute( array( $rankID ) );
		$array = $this->selectByRankIDStmt->fetch();
		$this->selectByRankIDStmt->closeCursor();
		if ( ! is_array( $array ) ) { return null; }
		if ( ! isset( $array['id'] ) ) { return null; }
		$old = $this->getFromMap( $array['id'] );
		if ( is_object($old) ) { return $old; }
		$object = $this->createObject( $array );
		return $object;
	}

	function findUpperRanks(domain\TutorialStaffRank $currentRank){
		$this->selectUpperRanksStmt->execute( array( $currentRank->getOrder() ) );
		return $this->getCollection($this->selectUpperRanksStmt->fetchAll( \PDO::FETCH_ASSOC ) );
	}

	function findLowerRanks(domain\TutorialStaffRank $currentRank){
		$this->selectLowerRanksStmt->execute( array( $currentRank->getOrder() ) );
		return $this->getCollection($this->selectLowerRanksStmt->fetchAll( \PDO::FETCH_ASSOC ) );
	}

	function getCollection( array $raw ) {
        return new TutorialStaffRankCollection( $raw, $this );
    }

    protected function doCreateObject( array $array ) {
        $obj = new domain\TutorialStaffRank($array['id']);
	    $obj->setRankID($array['rank_id']);
	    $obj->setOrder($array['rank_order']);
	    $obj->setTitle($array['rank_title']);
	    $obj->setMinYearOfService($array['min_year_of_service']);
	    $obj->setMinQualification($array['min_qualification']);
	    $obj->setMinNumOfPublications($array['min_num_of_publications']);
	    $obj->setMinNumOfSupervisions($array['min_num_of_supervisions']);
	    $obj->setMinScopusIndexes($array['min_scopus_indexes']);
	    $obj->setMinThompsonIndexes($array['min_thompson_indexes']);

        return $obj;
    }

    protected function doInsert( domain\DomainObject $object ) {
        $values = array(
	        $object->getRankID(),
	        $object->getOrder(),
	        $object->getTitle(),
	        $object->getMinQualification(),
	        $object->getMinYearOfService(),
	        $object->getMinNumOfSupervisions(),
	        $object->getMinNumOfPublications(),
	        $object->getMinScopusIndexes(),
	        $object->getMinThompsonIndexes()
        );
        $this->insertStmt->execute( $values );
        $id = self::$PDO->lastInsertId();
        $object->setId( $id );
    }

    function doUpdate( domain\DomainObject $object ) {
	    $values = array(
		    $object->getOrder(),
		    $object->getTitle(),
		    $object->getMinYearOfService(),
		    $object->getMinQualification(),
		    $object->getMinNumOfPublications(),
		    $object->getMinNumOfSupervisions(),
		    $object->getMinScopusIndexes(),
		    $object->getMinThompsonIndexes(),
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
        return $this->selectAllStmt;
    }

    function targetClass(){
        return "TutorialStaffRank";
    }
}