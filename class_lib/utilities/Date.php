<?php
/**
 * Phoenix Laboratories NG.
 * Author: N. C. Joseph (phoenixlabs.ng@gmail.com)
 * Project: staff_portal
 * Date: 7/8/15
 * Time: 10:50 PM
 */

namespace class_lib\utilities;


class Date {
    private $year;
	private $month;
	private $day;

    function __construct($month=null, $day=null, $year=null){
        if(is_null($month) and is_null($day) and is_null($year)){
            $month = date("m");
	        $day = date("d");
	        $year = date("Y");
        }
        $this->set_date($month, $day, $year);
    }

    function set_date($month, $day, $year){
        if(checkdate((int)$month, (int)$day, (int)$year) == true){
            $this->year = $year;
	        $this->month = $month;
	        $this->day = $day;
        }else{
            throw new \Exception("invalid date supplied: ".$month."-".$day."-".$year);
        }
    }

    function get_date_int(){
        return mktime(null,null,null,$this->month,$this->day,$this->year);
    }

    function toStr($separator="-"){
        return (string)$this->get_year().$separator.$this->get_month().$separator.$this->get_day();
    }

	function __toString(){
		return $this->toStr();
	}

    function toStrf($format){
        return date($format, $this->get_date_int());
    }

    function get_day(){
        return $this->day;
    }
    function get_month(){
        return $this->month;
    }
    function get_year(){
        return $this->year;
    }
}