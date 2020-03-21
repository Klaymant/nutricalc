<?php

namespace Model;

class Training {
	private $date;
	private $shape;
	private $exercices;

	function __construct($dayName=NULL, $day=NULL, $month=NULL, $year=NULL) {
		$date = new Date($dayName, $day, $month, $year);
		$shape = NULL;
		$exercices[];
	}
}