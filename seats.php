<!DOCTYPE html>
<html>
	<head>
		<meta charset="uft-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>North Ferriby United (Tickets)</title> 
		<link href='https://fonts.googleapis.com/css?family=Droid+Serif' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>

	<body>
		<!-- HEADER -->
		<header id="seatsAndStandsHeader">
			<h1><a href="index.html">NFU</a></h1>
			<h2>Ticket Booking &amp; Reservation System</h2>
		</header>

		<!-- SECTION
		 	the section tag is filled with a div that is dynamically built in generate_seats.js based on the user's seat id, type and date selection -->
		<section id="seatsAndStands">
		</section>
		
		<!-- FOOTER -->
		<footer>
			<p>&copy;2016 North Ferriby United.</p>
		</footer>

		<script type="text/javascript" src="https://code.jquery.com/jquery-3.0.0.min.js"></script> 
		<script type="text/javascript" src="js/generate_seats.js"></script> 
		<script type="text/javascript">
			/*	event ID, event Type and event Date are taken from the URL which is originnally from data JSON file which creats the URL of the page,
			the addition of these event attributes are what makes a page unique	*/
			var eventID = "<?php echo $_GET['id']; ?>"; 
			var eventType = "<?php echo $_GET['type']; ?>";
			var eventDate = "<?php echo $_GET['date']; ?>";
			var displayEventDate;

			//checks which data is to be displayed on page base on url 
			if (eventDate == "03December2016") {
				displayEventDate = new Date("December 03, 2016").toDateString();
			} else if (eventDate == "22January2017") {
				displayEventDate = new Date("January 22, 2017").toDateString();
			} else if (eventDate == "28February2017") {
				displayEventDate = new Date("February 28, 2017").toDateString();
			} else {
				displayEventDate = false;
			}

			var seats = new Seats(); //creates an instance of 'Seats' class from the generate_seats.js file
			seats.createSeats(eventID, eventType, displayEventDate, 250); //calls a method for the class 



			/****************************
			UPDATE SEATS & STANDS DATA
			*****************************/
			//In this bit, I am using jQuery to add more advance experiences for the user on the front-end part of the booking.

			//creation of the overlay when a seat/stand is clicked
			$("#seatsAndStands ul li a").on("click", function() {

				//DOM elements (in variables) to be used on the overlay
				var $body = $('body');
				var $overlay = $('<div id="overlay"></div>');
				var $overlayDiv = $('<div id="overlayDiv"></div>');
				var $overlayThankYou = $('<p id="overlayThankYou"><p>');
				var $overlayID = $('<p id="overlayID"><p>');
				var $overlayType = $('<p id="overlayType">' + eventType + '<p>');
				var $overlayDate = $('<p id="overlayDate">' + displayEventDate + '<p>');
				var $overlayBookBtn = $('<input type="submit" name="bookBtn" value="Book">');
				var $overlayCancelBtn = $('<input type="submit" name="cancelBtn" value="Cancel">');
				var $overlayClose = $('<a href="#">Close</a>');

				//appending of the DOM elements on the overlay
				$body.append($overlay);
				$overlay.append($overlayDiv);
				$overlayDiv.append($overlayThankYou);
				$overlayDiv.append($overlayID);
				$overlayDiv.append($overlayType);
				$overlayDiv.append($overlayDate);
				$overlayDiv.append($overlayBookBtn);
				$overlayDiv.append($overlayCancelBtn);

				//clicked seat/stand's name (text value)
				var $seatName = $(this).text();
				$overlayID.text($seatName);

				//clicked seat/stand's index value
				var $linkIndex = $(this).parent().index();

				$overlay.show();
				
				// AJAX jQuery, Learnt from: 
				// 1. http://stackoverflow.com/questions/15461786/pass-javascript-variable-to-php-via-ajax
				// 2. https://teamtreehouse.com/library/ajax-basics/jquery-and-ajax/the-jquery-ajax-method

				//the AJAX below posts the unique ID of the page and the index value of the clicked seat/seat
				$('input[name="bookBtn"]').on("click", function() {
					$.ajax({
						url: "php/updateSeatsAndStandsData.php",
						data: {
							linkIndex : $linkIndex,
							pageID : eventID + eventType + eventDate
						},
						type: "POST",
						success: function(response) {
							checkingSeatsAndStandsData();
							$overlayThankYou.text(response);
							$overlayBookBtn.add($overlayCancelBtn).remove();
							$overlayDiv.append($overlayClose);
						}
					});
				});

				//the two functions below hides/closes the overlay when the overlay, close, cancel or the esp key is pressed
				$overlay.add($overlayClose).add($overlayCancelBtn).on("click", function() {
					$overlay.hide();
				});

				$body.on("keydown", function(event){
					if(event.keyCode == 27) {
						$overlay.hide();
					}
				});


				//stops $overlayDiv from inheriting $overlay's hide feature when clicked
				$overlayDiv.on("click", function(evt){
				    evt.stopPropagation();
				});
				

				//prevents the jumping to the top page
				$overlayClose.click(function(e) {
				    e.preventDefault();
				});

				return false;

			});

		</script> 

	</body>
</html>