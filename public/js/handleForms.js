$(document).ready(function(){
    $('#submit_abs').on('click' , function(){
        let typeAbs = $('#select-absence').val();
        let form = $('#formsAbs');
        switch (typeAbs) {
            case 'CP':
				if (compareDates('cpDate' , 'cpDateR')) {
					$('#formsAbs').submit();
				}
                break;
            case 'NP':
				if (compareDatesMinutes('npDate' , 'npDateR')) {
					if (compareGap('npDate' , 'npDateR' , 60)) {
						$('#formsAbs').submit();
					}
				}
                break;
            case 'MLD':
				if (compareDatesMinutes('malDate' , 'malDateR')) {
					if(compareGap('malDate' , 'malDateR' , 60)){
						$('#formsAbs').submit();
					}
				}
                break;
            case 'INT':
				if (compareDatesMinutes('intDate' , 'intDateR')) {
					$('#formsAbs').submit();
				}
                break;
            case 'RCU':
				if (compareDatesMinutes('recDate' , 'recDateR')) {
					if (compareGap('intDate' , 'intDateR' , 15)) {
						$('#formsAbs').submit();
					}
				}
                break;
            case 'TT':
				if (compareDates('ttDate' , 'ttDateR')) {
					$('#formsAbs').submit();
				}
                break;
        }
    })

	$('#btn-post').on('click' , function(){
		$('#formsAbs').submit();
	})

    function compareDates(date1, date2 ) {
        // Get the values of the Flatpickr inputs
        var startDate = document.getElementById(date1).value;
        var endDate = document.getElementById(date2).value;
  
        // Parse the dates
        var parsedStartDate = new Date(startDate);
        var parsedEndDate = new Date(endDate);
  
        // Compare dates
        if (parsedStartDate > parsedEndDate) {
            $('#texte-alert').text('La date de retour ne doit pas etre avant la date de depart')
            $('#exampleModalToggle').modal('show');
          } else {
			 return true;
            
          }
      }


      
    function compareDatesMinutes(date1, date2 ) {
        // Get the values of the Flatpickr inputs
        var startDate = document.getElementById(date1).value;
        var endDate = document.getElementById(date2).value;
  
        // Parse the dates
        var parsedStartDate = flatpickr.parseDate(startDate, "Y-m-d H:i:S");
        var parsedEndDate = flatpickr.parseDate(endDate, "Y-m-d H:i:S");
  
        // Compare dates
        if (parsedStartDate > parsedEndDate) {
          // Alert if the start date is later than the end date
          $('#texte-alert').text('La date de retour ne doit pas etre avant la date de depart')
          $('#exampleModalToggle').modal('show');
        } else {
          return true
         
        }
      }


    //   function compareGap($date1, $date2, gap) {
    //     var startDate = document.getElementById($date1).value;
    //     var endDate = document.getElementById($date2).value;
    //     var parsedStartDate = flatpickr.parseDate(startDate, "Y-m-d H:i:S");
    //     var parsedEndDate = flatpickr.parseDate(endDate, "Y-m-d H:i:S");
      
        
    //     if (
    //       parsedStartDate.getFullYear() === parsedEndDate.getFullYear() &&
    //       parsedStartDate.getMonth() === parsedEndDate.getMonth() &&
    //       parsedStartDate.getDate() === parsedEndDate.getDate()
    //     ) {
    //       var timeDifference = Math.abs(parsedEndDate - parsedStartDate) / 60000;
    //       var roundedEndDate = new Date(
    //         parsedStartDate.getTime() + Math.round(timeDifference / gap) * gap * 60000
    //       );
      
    //       var options = {
    //         year: 'numeric',
    //         month: '2-digit',
    //         day: '2-digit',
    //         hour: '2-digit',
    //         minute: '2-digit',
    //         hour12: false,
    //       };
      
    //       var formattedRoundedEndDate = roundedEndDate.toLocaleString('fr-FR', options);
      
    //       if (timeDifference % gap === 0) {
    //         //post
    //       } else {
    //         $('#alert-post').text(
    //           'Attention pour ce type de congé les tranches horaires minimum sont de : ' +
    //             gap +
    //             ' minutes. Voulez-vous continuer ? Le programme arrondira automatiquement : ' +
    //             formattedRoundedEndDate
    //         );
    //         $('#postModal').modal('show');
    //       }
    //     } else {
    //       //post////
    //     }
    //   }


	function compareGap(date1, date2, gap) {
		var startDate = document.getElementById(date1).value;
		var endDate = document.getElementById(date2).value;
		var parsedStartDate = flatpickr.parseDate(startDate, "Y-m-d H:i:S");
		var parsedEndDate = flatpickr.parseDate(endDate, "Y-m-d H:i:S");
	
		if (
			parsedStartDate.getFullYear() === parsedEndDate.getFullYear() &&
			parsedStartDate.getMonth() === parsedEndDate.getMonth() &&
			parsedStartDate.getDate() === parsedEndDate.getDate()
		) {
			var timeDifference = Math.abs(parsedEndDate - parsedStartDate) / 60000;
			var roundedEndDate = new Date(
				parsedStartDate.getTime() + Math.round(timeDifference / gap) * gap * 60000
			);
			var nextSuperiorRoundedEndDate = new Date(parsedStartDate.getTime() 
			+ Math.ceil(timeDifference / gap) * gap * 60000);
	
			// Check if the next superior rounded end date is closer to the start date
			if (nextSuperiorRoundedEndDate.getTime() - parsedStartDate.getTime() < roundedEndDate.getTime() - parsedStartDate.getTime()) {
				var options = {
					year: 'numeric',
					month: '2-digit',
					day: '2-digit',
					hour: '2-digit',
					minute: '2-digit',
					hour12: false,
				};
		
				var formattedRoundedEndDate = nextSuperiorRoundedEndDate.toLocaleString('fr-FR', options);
				
			} else {
				var options = {
					year: 'numeric',
					month: '2-digit',
					day: '2-digit',
					hour: '2-digit',
					minute: '2-digit',
					hour12: false,
				};
		
				var formattedRoundedEndDate = roundedEndDate.toLocaleString('fr-FR', options);
			}
      

			if (timeDifference % gap === 0) {
				return true;
			} else {
				$('#alert-post').text(
					'Attention pour ce type de congé les tranches horaires minimum sont de : ' +
					gap +
					' minutes. Voulez-vous continuer ? Le programme arrondira automatiquement : ' +
					formattedRoundedEndDate
				);
        
				$('#postModal').modal('show');
			}
		} else {
      
			return true;
		}
	}
	
    
      function checkRadioBoxes(name) {
        // Get all radio boxes with the specified name attribute
        var radioBoxes = document.querySelectorAll('input[name="'+name+'"]');
        var checked = false;
  
        // Loop through the radio boxes to check if any is checked
        for (var i = 0; i < radioBoxes.length; i++) {
          if (radioBoxes[i].checked) {
            checked = true;
            break; // Exit the loop if at least one radio box is checked
          }
        }
  
        // Display an alert if none of the radio boxes is checked
        if (!checked) {
          alert('Merci de cocher les heures de retour');
        }
      }

     
})