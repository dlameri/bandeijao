<?php

require_once (dirname(__FILE__) . '/../repository/RestaurantRepository.php');
require_once (dirname(__FILE__) . '/../repository/HistoryRepository.php');

define('SEPARATOR','||');

class RaffleService {

	private $restaurantRepository;
	private $historyRepository;

	public function __construct($restaurantRepository, $historyRepository) {
		$this->restaurantRepository = $restaurantRepository;
		$this->historyRepository = $historyRepository;
	}

	private function fisherYatesShuffle($array) {	  
	  	$i = count($array);
	 
	  	while(--$i){
	  		$j = mt_rand(0,$i);
	    	if($i != $j){
	      		// swap items
	      		$tmp = $array[$j];
	      		$array[$j] = $array[$i];
	    		$array[$i] = $tmp;
			}
		}

	 	return $array;
	}

	private function makeRestaurantArray() {
		$restaurantString = '';
		$restaurantArray = $this->restaurantRepository->all();		

		// Percorrendo todos os restaurantes e multiplicando eles pela prioridade
		foreach ($restaurantArray as $index => $restaurant) {
			$restaurantString .= str_repeat($restaurant->getName() . SEPARATOR, $restaurant->getNumberOfRepeats());
		}

		$restaurantArray = explode(SEPARATOR, $restaurantString);

		// Removendo o ultimo espaço em branco
		array_pop($restaurantArray);		

		return $this->fisherYatesShuffle($restaurantArray);
	}

	public function todaysRestaurant() {
		$todaysRestaurant = $this->restaurantRepository->todaysRestaurant();

		if ($todaysRestaurant == null) {
			$restaurantArray = $this->makeRestaurantArray();

			$chosenRestaurant = $restaurantArray[mt_rand(0,sizeof($restaurantArray) - 1)];
			$chosenRestaurantObj = $this->restaurantRepository->ByName($chosenRestaurant);

			$this->historyRepository->makeItHistory($chosenRestaurantObj);
		} else {
			$chosenRestaurant = $todaysRestaurant->getName();
		}

		return $chosenRestaurant;
	}
}

$raffleService = new RaffleService(
					new RestaurantRepository(), 
					new HistoryRepository()
				);

?>