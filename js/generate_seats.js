/****************************
		GENERATE SEATS
*****************************/
//the constructor function below contains the method that displays seats and stands to user
function Seats() { 
	this.displayingSeatsAndStands = "";
} 

//method to display seats by using a for loop
Seats.prototype.createSeats = function (id, type   , date, noSeats) {
	
	this.displayingSeatsAndStands = '<div>';
	this.displayingSeatsAndStands += '<p>' + id + ' ' + type + '</p>';
	this.displayingSeatsAndStands += '<p>' + date + '</p>'; 
	this.displayingSeatsAndStands += '<ul class="cf">';

	for (i = 1; i <= noSeats; i++) {
		this.displayingSeatsAndStands += '<li>';
		this.displayingSeatsAndStands += '<a href="#">';
		this.displayingSeatsAndStands +=  id + i;
		this.displayingSeatsAndStands += '</a>';
		this.displayingSeatsAndStands += '</li>';
	}

	this.displayingSeatsAndStands += '</ul>';
	this.displayingSeatsAndStands += '</div>';

	document.getElementById("seatsAndStands").innerHTML = this.displayingSeatsAndStands;

}



/****************************
CHECK SEATS & STANDS DATA
*****************************/
var seatsAndStandsList = document.getElementsByTagName("li");

//the function below uses AJAX to GETs the seatsAndStandsData.json file and uses a loop to compare and determine which seats have been booked
function checkingSeatsAndStandsData () {
	var seatsAvailability = new XMLHttpRequest();
	seatsAvailability.open("GET", "json/seatsAndStandsData.json");
	seatsAvailability.send();
	seatsAvailability.onreadystatechange = function () {
		if (seatsAvailability.readyState === 4 && seatsAvailability.status === 200) {

			var seatsAndStandsID = JSON.parse(seatsAvailability.responseText);
			var pageID = eventID + eventType + eventDate; //uniquely identifies a page to make comparison easy

			//loops through seatsAndStands on the page and compares it to the data from the JSON file
			for (i = 0; i < seatsAndStandsList.length; i++) {
				if (seatsAndStandsID[pageID][i] === "NO") {
					seatsAndStandsList[i].style.background = "#b52e31";
					seatsAndStandsList[i].style.color = "black";
					var textValue = seatsAndStandsList[i].innerText;
					seatsAndStandsList[i].innerHTML = textValue;
				} 
			}

		} 
	};
}

checkingSeatsAndStandsData(); //automatically calls the function when page loads to tell the user which seats are available or not
setInterval(checkingSeatsAndStandsData, 2000); //calls the function every 2 seconds to make sure the seats are constantly updated


