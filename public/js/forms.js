$(document).ready(function(){
   

    var dzea  = flatpickr("#cpDate", {
        enableTime: false,
        locale: "fr" ,
        dateFormat: "Y-m-d",
        onChange: function(selectedDates, dateStr, instance) {
          // When the date is changed, update the second Flatpickr
          updateDisabledDates(selectedDates[0]);
      }
    });
    var cpDateR = flatpickr("#cpDateR", {
        enableTime: false,
        locale: "fr" ,
        dateFormat: "Y-m-d",
        disable: []
    });
    

    function updateDisabledDates(selectedDate) {
        // Disable the selected date and all dates that precede it
        cpDateR.destroy();

        // Reinitialize the second Flatpickr with updated options
        cpDateR = flatpickr("#cpDateR", {
            disable: [{ from: '1900-01-01', to: selectedDate }],
            // Add other options as needed
        });
    }
    
  });

