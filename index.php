<?php 

header('Content-Type: text/html; charset=utf-8'); 

require_once (dirname(__FILE__) . '/service/RaffleService.php');

if (date("l") == 'Saturday') {
	echo "Hoje é Sábado, nada de restaurante no centro pra você!";
} else if (date("l") == 'Sunday') {
	echo "Hoje é Domingo, tu queria mesmo almoçar no centro?";
} else {
	echo 'O restaurante do dia é : ' . $raffleService->todaysRestaurant();
}

?>
