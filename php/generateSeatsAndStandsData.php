<?php
	// creates the 'seatsAndStandsData' JSON file which contains YES value for all seats/stands meaning they have not been booked yet.
	$seatsAndStands = array(
		'ASeats03December2016' => array_fill(0, 250, 'YES'),
		'BSeats03December2016' => array_fill(0, 250, 'YES'),
		'CSeats03December2016' => array_fill(0, 250, 'YES'),
		'DSeats03December2016' => array_fill(0, 250, 'YES'),
		'ESeats03December2016' => array_fill(0, 250, 'YES'),
		'AStands03December2016' => array_fill(0, 250, 'YES'),
		'BStands03December2016' => array_fill(0, 250, 'YES'),
		'CStands03December2016' => array_fill(0, 250, 'YES'),
		'DStands03December2016' => array_fill(0, 250, 'YES'),
		'EStands03December2016' => array_fill(0, 250, 'YES'),

		'ASeats22January2017' => array_fill(0, 250, 'YES'),
		'BSeats22January2017' => array_fill(0, 250, 'YES'),
		'CSeats22January2017' => array_fill(0, 250, 'YES'),
		'DSeats22January2017' => array_fill(0, 250, 'YES'),
		'ESeats22January2017' => array_fill(0, 250, 'YES'),
		'AStands22January2017' => array_fill(0, 250, 'YES'),
		'BStands22January2017' => array_fill(0, 250, 'YES'),
		'CStands22January2017' => array_fill(0, 250, 'YES'),
		'DStands22January2017' => array_fill(0, 250, 'YES'),
		'EStands22January2017' => array_fill(0, 250, 'YES'),

		'ASeats28February2017' => array_fill(0, 250, 'YES'),
		'BSeats28February2017' => array_fill(0, 250, 'YES'),
		'CSeats28February2017' => array_fill(0, 250, 'YES'),
		'DSeats28February2017' => array_fill(0, 250, 'YES'),
		'ESeats28February2017' => array_fill(0, 250, 'YES'),
		'AStands28February2017' => array_fill(0, 250, 'YES'),
		'BStands28February2017' => array_fill(0, 250, 'YES'),
		'CStands28February2017' => array_fill(0, 250, 'YES'),
		'DStands28February2017' => array_fill(0, 250, 'YES'),
		'EStands28February2017' => array_fill(0, 250, 'YES')


		);


	$seatsAndStandsJson = json_encode($seatsAndStands); //encodes the array
	file_put_contents("../json/seatsAndStandsData.json", $seatsAndStandsJson); //puts the array in the seatsAndStandsData.json file
?>





		