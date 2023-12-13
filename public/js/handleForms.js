$(document).ready(function(){
    $('#submit_abs').on('click' , function(){
        let typeAbs = $('#select-absence').val();
        let form = $('#formsAbs');
        switch (typeAbs) {
            case 'CP':
                compareDates('cpDate' , 'cpDateR')
                break;
        
            case 'NP':
                compareDatesMinutes('npDate' , 'npDateR')
                break;

            case 'MLD':
                compareDatesMinutes('malDate' , 'malDateR')
                break;

            case 'INT':
                compareDatesMinutes('intDate' , 'intDateR')
                break;

            case 'RCU':
                compareDates('recDate' , 'recDateR')
                break;

            case 'TT':
                compareDates('ttDate' , 'ttDateR')
                break;
        }
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
          // Alert if the start date is later than the end date
          alert('La date de retour n est pas correcte');
        } else {
          // Do something else if the dates are valid
          alert('Dates ok');
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
          $('#texte-alert').text('La date de retour n est pas correcte').modal('show'); 
        } else {
          // Do something else if the dates are valid
          alert('Dates ok');
          $('#exampleModalToggle').modal('show'); 
        }
      }


      function compareGap($date1 , $date2 , gap) {

        var startDate = document.getElementById($date1).value;
        var endDate = document.getElementById($date2).value;
        var parsedStartDate = flatpickr.parseDate(startDate, "Y-m-d H:i:S");
        var parsedEndDate = flatpickr.parseDate(endDate, "Y-m-d H:i:S");
        var timeDifference = Math.abs(parsedEndDate - parsedStartDate) / 60000; 
        var roundedEndDate = new Date(parsedStartDate.getTime() + Math.round(timeDifference / gap) * gap * 60000);

        var options = {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            hour12: false 
        };

        var formattedRoundedEndDate = roundedEndDate.toLocaleString('fr-FR', options);

        if (timeDifference % gap === 0) {
            alert('Dates ok');
        ///////post du formulaire//////////
        } else {
            $('#texte-alert').text('Attention pour ce type de congé les tranches horaires minimum sont de : ' +
              gap + ' minutes. Voulez-vous continuer ? Le programme arrondira automatiquement : ' + formattedRoundedEndDate);
            $('#exampleModalToggle').modal('show'); 
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