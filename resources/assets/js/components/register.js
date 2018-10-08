window.$ = window.jQuery = require('jquery');
window.gj = require('gijgo');


import 'gijgo/js/gijgo.js';
import 'gijgo/js/messages/messages.es-es.min.js';

(function() {
  console.log(gj)
    'use strict';

    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });



        //datepicker
        $('#group_class_date').datepicker({
            locale: 'es-es',
            uiLibrary: 'bootstrap4'
        });


    }, false);

})();