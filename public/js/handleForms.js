$(document).ready(function(){
    $('#submit_abs').on('click' , function(){
        let typeAbs = $('#select-absence').val();
        let form = $('#formsAbs');
        switch (typeAbs) {
            case 'CP':
                compareDates('cpDate' , 'cpDateR')
                break;
        
            case 'NP':
                compareDates('npDate' , 'npDateR')
                break;

            case 'MLD':
                compareDates('malDate' , 'malDateR')
                break;

            case 'INT':
                compareDates('intDate' , 'intDateR')
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
})