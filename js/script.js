/*****************************
	DISPLAY SEATS & STANDS
*****************************/
//filling the selection options on index page
document.getElementsByTagName("option")[1].innerHTML = new Date("December 03, 2016").toDateString();
document.getElementsByTagName("option")[2].innerHTML = new Date("January 22, 2017").toDateString();
document.getElementsByTagName("option")[3].innerHTML = new Date("February 28, 2017").toDateString();

//this function runs when user chooses an event and clicks the 'get seats and stands' button
function displaySeatsAndStands () {

	var jsonFileRequest = new XMLHttpRequest(); 
	jsonFileRequest.open("GET", "json/data.json");
	jsonFileRequest.send();
	jsonFileRequest.onreadystatechange = function () { 
		if (jsonFileRequest.readyState === 4 && jsonFileRequest.status === 200) {

			var seatsAndStands = JSON.parse(jsonFileRequest.responseText);

			var eventSeatsAndStands = '<div class="cf">';

			//this function contains a layout of the 'Seats and Stands' groups that is to be displayed to the page with the use of data from the JSON FILE (data.json)
			function showSeatsAndStands (item, itemNo, itemMonth, seatOrStand, dateAndTime) {
				eventSeatsAndStands += '<ul class="cf">';
				eventSeatsAndStands += '<p>' + seatOrStand + '</p>';
				eventSeatsAndStands += '<p>' + dateAndTime + '</p>';

				// the for loop below loops through JSON array to all the required data that is to be displayed to the page
				for (i = item; i < itemNo; i++) {
					eventSeatsAndStands += '<li>';

					eventSeatsAndStands += '<a href=seats.php?id=' + itemMonth[i].id + '&type=' + itemMonth[i].type + '&date=' + itemMonth[i].date + '>';
					eventSeatsAndStands += '<h3>' + itemMonth[i].id + " " + itemMonth[i].type + '</h3>';
					eventSeatsAndStands += '</a>';

					eventSeatsAndStands += '</li>';
				}

				eventSeatsAndStands += '</ul>';
			}

			var selectionList = document.getElementsByTagName("select")[0];

			//this condition statement feeds the showSeatsAndStands functions with what is to be displayed to the page based on the user's selection from the events
			if(selectionList.selectedIndex === 1) {
				showSeatsAndStands (0, 5, seatsAndStands.december, "SEATS", new Date("December 03, 2016").toDateString());
				showSeatsAndStands (5, 10, seatsAndStands.december, "STANDS", new Date("December 03, 2016").toDateString());
			} else if (selectionList.selectedIndex === 2) {
				showSeatsAndStands (0, 5, seatsAndStands.january, "SEATS", new Date("January 22, 2017").toDateString());
				showSeatsAndStands (5, 10, seatsAndStands.january, "STANDS", new Date("January 22, 2017").toDateString());
			} else if (selectionList.selectedIndex === 3) {
				showSeatsAndStands (0, 5, seatsAndStands.february, "SEATS", new Date("February 28, 2017").toDateString());
				showSeatsAndStands (5, 10, seatsAndStands.february, "STANDS", new Date("February 28, 2017").toDateString());
			} else {

			}

			eventSeatsAndStands += '</div>';

			document.getElementsByTagName("section")[0].innerHTML = eventSeatsAndStands;

		} else {
			document.getElementsByTagName("section")[0].innerHTML = "<p class='errorNote'>" + "An error has occured. Please try again." + "</p>";
		}
	};

}

//event listener for when 'gets seats & stands' botton is clicked to run the function above
var submitBtn = document.getElementsByTagName("input")[0];
submitBtn.addEventListener("click", displaySeatsAndStands, false);













