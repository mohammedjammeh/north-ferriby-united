<?php 
	//gets array values in seatsAndStandsData.json file and decodes it to be updated
	$seatsAndStandsJson = file_get_contents("../json/seatsAndStandsData.json");
	$decodedSeatsAndStandsJson = json_decode($seatsAndStandsJson, true);

	//checks if the linkIndex and pageID have been sent by an AJAX file,
	//changes the seat/stand (linkIndex) value to 'NO' in the decoded JSON file
	if (isset($_POST['linkIndex']) && isset($_POST['pageID'])) {
		$btnIndex = $_POST['linkIndex'];
		$pageID = $_POST['pageID'];
		$decodedSeatsAndStandsJson[$pageID][$btnIndex] = "NO";
	}

	//encodes the file again and sends it back
	$encodedSeatsAndStandsJson = json_encode($decodedSeatsAndStandsJson);
	file_put_contents("../json/seatsAndStandsData.json", $encodedSeatsAndStandsJson);

	echo "Thank you for booking:"; //string to be returned to AJAX file as 'response'
?>