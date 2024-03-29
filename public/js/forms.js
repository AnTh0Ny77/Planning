$(document).ready(function(){
   

    var cpDate  = flatpickr("#cpDate", {
        enableTime: false,
        locale: "fr" ,
        dateFormat: "Y-m-d",
       
    });
    var cpDateR = flatpickr("#cpDateR", {
        enableTime: false,
        locale: "fr" ,
        dateFormat: "Y-m-d",
        disable: []
    });

    var ttDate  = flatpickr("#ttDate", {
        enableTime: false,
        locale: "fr" ,
        dateFormat: "Y-m-d",
      
    });

    var ttDateR = flatpickr("#ttDateR", {
        enableTime: false,
        locale: "fr" ,
        dateFormat: "Y-m-d",
        disable: []
    });

    var npDate  = flatpickr("#npDate", {
        enableTime: true,
        locale: "fr" ,
        dateFormat: "Y-m-d H-i",
        minuteIncrement: 5 ,
      
    });

    var npDateR  = flatpickr("#npDateR", {
        enableTime: true,
        locale: "fr" ,
        dateFormat: "Y-m-d H-i",
        minuteIncrement: 5 ,
       
    });

    var malDateR  = flatpickr("#malDateR", {
        enableTime: true,
        locale: "fr" ,
        dateFormat: "Y-m-d H-i",
        minuteIncrement: 5 ,
       
    });

    var recDateR  = flatpickr("#recDateR", {
        enableTime: true,
        locale: "fr" ,
        dateFormat: "Y-m-d H-i",
        minuteIncrement: 5 ,
       
    });

    var recDate  = flatpickr("#recDate", {
        enableTime: true,
        locale: "fr" ,
        dateFormat: "Y-m-d H-i",
        minuteIncrement: 5 ,
       
    });

    var malDate  = flatpickr("#malDate", {
        enableTime: true,
        locale: "fr" ,
        dateFormat: "Y-m-d H-i",
        minuteIncrement: 5 ,
       
    });

    var intDate  = flatpickr("#intDate", {
        enableTime: true,
        locale: "fr" ,
        dateFormat: "Y-m-d H-i",
       
    });

    var intDateR  = flatpickr("#intDateR", {
        enableTime: true,
        locale: "fr" ,
        dateFormat: "Y-m-d H-i",
        
    });

    function updateDisabledDatesint(selectedDate) {
        // Disable the selected date and all dates that precede it
        intDateR.destroy();

        // Reinitialize the second Flatpickr with updated options
        intDateR = flatpickr("#intDateR", {
            enableTime: true,
            locale: "fr" ,
            dateFormat: "Y-m-d H-i",
            disable: [{ from: '1900-01-01', to: selectedDate }],
            // Add other options as needed
        });
    }

    function updateDisabledDatesNp(selectedDate) {
        // Disable the selected date and all dates that precede it
        npDateR.destroy();

        // Reinitialize the second Flatpickr with updated options
        npDateR = flatpickr("#npDateR", {
            enableTime: true,
            locale: "fr" ,
            dateFormat: "Y-m-d H-i",
            minuteIncrement: 60 ,
            disable: [{ from: '1900-01-01', to: selectedDate }],
            // Add other options as needed
        });
    }


    function updateDisabledDatesrec(selectedDate) {
        // Disable the selected date and all dates that precede it
        recDateR.destroy();

        // Reinitialize the second Flatpickr with updated options
        recDateR = flatpickr("#recDateR", {
            enableTime: true,
            locale: "fr" ,
            dateFormat: "Y-m-d H-i",
            minuteIncrement: 15 ,
            disable: [{ from: '1900-01-01', to: selectedDate }],
            // Add other options as needed
        });
    }


    function updateDisabledDatesGenrerique(selectedDate , flat2, id  ) {
        // Disable the selected date and all dates that precede it
        flat2.destroy();

        // Reinitialize the second Flatpickr with updated options
        flat2 = flatpickr("#"+id+"", {
            enableTime: true,
            locale: "fr" ,
            dateFormat: "Y-m-d H-i",
            minuteIncrement: 60 ,
            disable: [{ from: '1900-01-01', to: selectedDate }],
            // Add other options as needed
        });
    }
    

    function updateDisabledDatestt(selectedDate) {
        // Disable the selected date and all dates that precede it
        ttDateR.destroy();

        // Reinitialize the second Flatpickr with updated options
        ttDateR = flatpickr("#ttDateR", {
            enableTime: false,
            locale: "fr" ,
            dateFormat: "Y-m-d" ,
            disable: [{ from: '1900-01-01', to: selectedDate }],
            // Add other options as needed
        });
    }

    function updateDisabledDates(selectedDate) {
        // Disable the selected date and all dates that precede it
        cpDateR.destroy();

        // Reinitialize the second Flatpickr with updated options
        cpDateR = flatpickr("#cpDateR", {
            enableTime: false,
            locale: "fr" ,
            dateFormat: "Y-m-d" ,
            disable: [{ from: '1900-01-01', to: selectedDate }],
            // Add other options as needed
        });
    }

    function handleSelectChange() {
        var selectElement = document.getElementById('select-absence');
        var cpWrapper = document.getElementById('cp-wrapper');
        var npWrapper = document.getElementById('np-wrapper');
        var allSelectWrappers = document.querySelectorAll('.select-wrapper');
        
        
        
        if (selectElement.value === 'CP') {
          
          $('.select-wrapper').addClass('hidden-debut');
          $('#cp-wrapper').removeClass('hidden-debut');
          
        } 
        else if (selectElement.value === 'NP') {
            $('.select-wrapper').addClass('hidden-debut');
            $('#np-wrapper').removeClass('hidden-debut');
        }else if (selectElement.value === 'MLD') {
            $('.select-wrapper').addClass('hidden-debut');
            $('#mal-wrapper').removeClass('hidden-debut');

        }  else if (selectElement.value === 'RCU') {
            $('.select-wrapper').addClass('hidden-debut');
            $('#rec-wrapper').removeClass('hidden-debut');

        } else if (selectElement.value === 'TT') {
            $('.select-wrapper').addClass('hidden-debut');
            $('#tt-wrapper').removeClass('hidden-debut');

        }else if (selectElement.value === 'INT') {
            $('.select-wrapper').addClass('hidden-debut');
            $('#int-wrapper').removeClass('hidden-debut');

        } else{
            $('.select-wrapper').addClass('hidden-debut');
            $('#cp-wrapper').removeClass('hidden-debut');
        }
    }

    document.getElementById('select-absence').addEventListener('change', handleSelectChange);
    
  });

