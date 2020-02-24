<?php

namespace Model;

class Date {
	private $dayName;
	private $day;
	private $month;
	private $year;

	function __construct($dayName=NULL, $day=NULL, $month=NULL, $year=NULL) {
		// If date parameters are not set then today's data are chosen
		$dayName == NULL ? $this->dayName = date("l") : $this->dayName = $dayName;
		$day == NULL ? $this->day = date("j") : $this->day = $day;
		$month == NULL ? $this->month = date("n") : $this->month = $month;
		$year == NULL ? $this->year = date("Y") : $this->year = $year;
	}

	// Getters
	public function getDayName() {
		return $this->dayName;
	}

	public function getDay() {
		return $this->day;
	}

	public function getMonth() {
		return $this->month;
	}

	public function getYear() {
		return $this->year;
	}

	// Setters
	public function setDayName($dayName) {
		$this->dayName = $dayName;
	}

	public function setDay($day) {
		$this->day = $day;
	}

	public function setMonth($month) {
		$this->month = $month;
	}

	public function setYear($year) {
		$this->year = $year;
	}

	public function setDate($dayName, $day, $month, $year) {
		$this->setDayName($dayName);
		$this->setDay($day);
		$this->setMonth($month);
		$this->setYear($year);
	}

	public function showDate() {
		echo 'We are the ';
		echo $this->dayName . ' ';
		echo $this->day . '/';
		echo $this->month . '/';
		echo $this->year;
	}
}