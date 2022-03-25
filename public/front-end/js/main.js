$(function(){
    $("#form-register").validate({
        rules: {
            password : {
                required : true,
            },
            confirm_password: {
                equalTo: "#password"
            }
        },
        messages: {
            username: {
                required: "Please provide an username"
            },
            email: {
                required: "Please provide an email"
            },
            password: {
                required: "Please provide a password"
            },
            confirm_password: {
                required: "Please provide a password",
                equalTo: "Please enter the same password"
            }
        }
    });
    $("#form-total").steps({
        headerTag: "h2",
        bodyTag: "section",
        transitionEffect: "fade",
        // enableAllSteps: true,
        autoFocus: true,
        transitionEffectSpeed: 500,
        titleTemplate : '<div class="title">#title#</div>',
        labels: {
            previous : 'Back',
            next : '<i class="zmdi zmdi-arrow-right"></i>',
            finish : '<i id="completed" class="zmdi zmdi-arrow-right"></i>',
            current : ''
        },
        onStepChanging: function (event, currentIndex, newIndex) { 
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var gender = $('#gender').val();
            var phonenumber = $('#phonenumber').val();
            var idnumber = $('#idnumber').val();
            var email = $('#email').val();
            var make = $('#make').val();
            var model = $('#model').val();
            var regno = $('#regno').val();


            $('#firstname-val').text(firstname);
            $('#lastname-val').text(lastname);
            $('#gender-val').text(gender);
            $('#phonenumber-val').text(phonenumber);
            $('#idnumber-val').text(idnumber);
            $('#email-val').text(email);
            $('#make-val').text(make);
            $('#model-val').text(model);
            $('#regno-val').text(regno);


            $("#form-register").validate().settings.ignore = ":disabled,:hidden";
            return $("#form-register").valid();
        }
    });

    $("#completed").on('click',function(){
        location.href = "/choose-option";
    });
});
