<?php
include '../calander/vendor/autoload.php';
/**
 * Converter
 */
class Converter extends Db
{
	private $exploader;

	public function toGrig($date){
		$this->exploader = explode("/", $date);
		$obj = Andegna\DateTimeFactory::of($this->exploader[2], $this->exploader[1], $this->exploader[0]);
		$out_obj = $obj->toGregorian()->format('m/j/Y');

		return $out_obj;
	}

	public function toEth($date){
		$gregorian = new DateTime($date);
		$ethopic = new Andegna\DateTime($gregorian);

		$year =  $ethopic->getYear();   
		$month =  $ethopic->getMonth();  
		$day =  $ethopic->getDay();   

		$output =  $day.'/'.$month.'/'.$year;

		return $output;
	}

	public function Now(){
		$gregorian_1 = new DateTime('now');
		$ethopic_1 = new Andegna\DateTime($gregorian_1);

		$year_1 =  $ethopic_1->getYear();  
		$month_1 =  $ethopic_1->getMonth(); 
		$day_1 =  $ethopic_1->getDay();    

		$output_1 =  $day_1.'/'.$month_1.'/'.$year_1;

		return $output_1;
	}
}