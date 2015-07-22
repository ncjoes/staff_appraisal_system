<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 10:38 PM
 */

namespace class_lib\domain;
use \class_lib\utilities\Date;

abstract class Person extends DomainObject{
    private $firstname;
    private $lastname;
    private $othernames;
    private $gender;
    private $date_of_birth;
    private $nationality;
    private $state_of_origin;
    private $lga;
    private $residence_country;
    private $residence_state;
    private $residence_city;
    private $residence_street;
    private $email;
    private $phone;
    private $biography;

    public static $gender_enum = array('M', 'F');

    function __construct($id=null){
        parent::__construct($id);
    }

    function set_names($firstname, $lastname, $othernames=""){
        $this->set_firstname($firstname);
        $this->set_lastname($lastname);
        $this->set_othernames($othernames);
        return $this;
    }

    function get_names(){
        return array(
            "firstname"=>$this->get_firstname(),
            "lastname"=>$this->get_lastname(),
            "othernames"=>$this->get_othernames()
        );
    }

    function getShortName(){
        return $this->lastname.", ".substr($this->firstname,0,1).". ".substr($this->othernames,0,1).".";
    }

    function set_firstname($value){
        $this->firstname = $value;
        $this->markDirty();
        return $this;
    }
    function get_firstname(){
        return $this->firstname;
    }

    function set_lastname($value){
        $this->lastname = $value;
        $this->markDirty();
        return $this;
    }
    function get_lastname(){
        return $this->lastname;
    }

    function set_othernames($value){
        $this->othernames = $value;
        $this->markDirty();
        return $this;
    }
    function get_othernames(){
        return $this->othernames;
    }

    function set_gender($value){
        if(in_array($value, Person::$gender_enum)){
            $this->gender = $value;
            $this->markDirty();
            return $this;
        }
        throw new \Exception("Invalid data: gender");
    }
    function get_gender(){
        return $this->gender;
    }

    function set_dateOfBirth(Date $date){
        $this->date_of_birth = $date;
        $this->markDirty();
        return $this;
    }
    function get_dateOfBirth(){
        return $this->date_of_birth;
    }

    function set_nationality($value){
        $this->nationality = $value;
        $this->markDirty();
        return $this;
    }
    function get_nationality(){
        return $this->nationality;
    }

    function set_state_of_origin($value){
        $this->state_of_origin = $value;
        $this->markDirty();
        return $this;
    }
    function get_state_of_origin(){
        return $this->state_of_origin;
    }

    function set_lga($value){
        $this->lga = $value;
        $this->markDirty();
        return $this;
    }
    function get_lga(){
        return $this->lga;
    }

    public function getBiography()
    {
        return $this->biography;
    }

    public function setBiography($biography)
    {
        $this->biography = $biography;
        $this->markDirty();
        return $this;
    }

}