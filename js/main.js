$(document).ready(function(){
	var images_arr = ["cherries.png", "club.png", "diamond.png", "heart.png", "joker.png", "seven.png", "spade.png"];
	var i = 0;
	var endTime = 3000; //time in milliseconds
	var incrementedNumber = 0;
	var randNum = Math.floor(Math.random() * 30);
	var randNum2 = Math.floor(Math.random() * 20);
	var arrRandom;
	var attempts = 1;
	var countdown = 30 * 60 * 1000;

	function slot1(){
		// console.log('this is slot 1');
		if (i == 7) {
			i = 0;
		}
		$("#slot1").attr('src', 'images/' + images_arr[i]);
		i++;
		incrementedNumber++;

	}

	function slot2(){
		if (i == 7) {
			i = 0;
		}
		// console.log('this is slot 2');
		$("#slot2").attr('src', 'images/' + images_arr[i]);
		i++;
		incrementedNumber++;
	}

	function slot3(){
		if (i == 7) {
			i = 0;
		}
		// console.log('this is slot 3');
		$("#slot3").attr('src', 'images/' + images_arr[i]);
		i++;
		incrementedNumber++;
	}

	if(parseInt(sessionStorage.getItem('attempts')) >= 4){
		$('#spinNow').unbind("click");

		var timerId = setInterval(function(){
		  countdown -= 1000;
		  var min = Math.floor(countdown / (60 * 1000));
		  var sec = Math.floor((countdown - (min * 60 * 1000)) / 1000);  

		  if (countdown <= 0) {
		     // alert("30 min!");
		     clearInterval(timerId);
		     $('#spinNow').bind("click", spinClick);
		     attempts = 0;
		  }

		}, 1000);
	}else{
		$('#spinNow').bind('click', spinClick);
	}

	function spinClick(){
		if(attempts > 3){
				// popup
				$('#threeTimes').modal('show');
				//set time out of 30 mins - enable
				$('#spinNow').unbind("click");

				var timerId = setInterval(function(){
				  countdown -= 1000;
				  var min = Math.floor(countdown / (60 * 1000));
				  var sec = Math.floor((countdown - (min * 60 * 1000)) / 1000);  

				  if (countdown <= 0) {
				     // alert("30 min!");
				     clearInterval(timerId);
				     $('#spinNow').bind("click", spinClick);
				     attempts = 0;
				  }

				}, 1000);
			}else{
				var slot1_task = setInterval(slot1, 100);
				var slot2_task = setInterval(slot2, 100);
				var slot3_task = setInterval(slot3, 100);

				setTimeout(function(){

					window.clearInterval(slot1_task);
					window.clearInterval(slot2_task);
					window.clearInterval(slot3_task);
					// debugger;
					arrRandom = Math.floor(Math.random() * 7);
					if(randNum == incrementedNumber){
						$("#slot1").attr('src', 'images/' + images_arr[arrRandom]);
						$("#slot2").attr('src', 'images/' + images_arr[arrRandom]);
						$("#slot3").attr('src', 'images/' + images_arr[arrRandom]);
					}else if(randNum2 == incrementedNumber){
						var randomSlot = Math.floor(Math.random() * 3) + 1;
						$("#slot" + randomSlot).attr('src', 'images/' + images_arr[arrRandom]);
						randomSlot = Math.floor(Math.random() * 3) + 1;
						$("#slot" + randomSlot).attr('src', 'images/' + images_arr[arrRandom]);
					}

					incrementedNumber = 0;

					var slot1_img_src = $("#slot1").attr('src');
					var slot2_img_src = $("#slot2").attr('src');
					var slot3_img_src = $("#slot3").attr('src');
					var rewardPoints;
					// debugger;
					if(slot1_img_src == slot2_img_src && slot1_img_src == slot3_img_src || slot2_img_src == slot1_img_src && slot2_img_src == slot3_img_src || slot3_img_src == slot1_img_src && slot3_img_src == slot2_img_src){
						// console.log("All 3 equal");
						// Add 500 points to rewards
						rewardPoints = 500;
						$('#success').modal('show');
						$('.successBg').show();
						$('#points').html(rewardPoints);

						$.ajax({
					        type: "POST",
					        url: "processreq/updateDatabase.php?rewards="+rewardPoints,
					        data: {
					        	rewardPoints : parseInt(rewardPoints)
					        },
					        dataType: 'json',
					        success: function(result){
					        	// debugger;
					        	if ( result.error != 0 ) {
					        		alert(result.errorMessage);
					        	} else {
					        		console.log('successfully updated in db');
					        		$('.balance').html(result.totalRewards);
					        	}
					        }
						}); 

					}else if((slot1_img_src == slot2_img_src || slot1_img_src == slot3_img_src) || (slot2_img_src == slot1_img_src || slot2_img_src == slot3_img_src) || (slot3_img_src == slot1_img_src || slot3_img_src == slot2_img_src)){
						// console.log("Only 2 equal");
						// Add 200 points to rewards
						rewardPoints = 200;
						$('.successBg').show();
						$('#success').modal('show');
						$('#points').html(rewardPoints);

						$.ajax({
					        type: "POST",
					        url: "processreq/updateDatabase.php?rewards="+rewardPoints,
					        data: {
					        	rewardPoints : parseInt(rewardPoints)
					        },
					        dataType: 'json',
					        success: function(result){
					        	debugger;
					        	if ( result.error != 0 ) {
					        		alert(result.errorMessage);
					        	} else {
					        		console.log('successfully updated in db');
					        	}
					        }
						});

					}else{
						// Error and try again
						// console.log("Nothing is equal");
						$('#failure').modal('show');
					}
				}, endTime);

				attempts++;
				sessionStorage.setItem('attempts', attempts);
			}
	}

	function millisToMinutes(millis) {
	  var minutes = Math.floor(millis / 60000);
	  console.log(millis);
	  console.log(minutes);
	  return minutes;
	}

	$('#logout').click(function(){
		sessionStorage.removeItem('attempts');
	});

});
