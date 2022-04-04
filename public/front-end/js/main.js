$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });

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
            var category = $('#category').val();
            var regno = $('#regno').val();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
            });


            $('#image').on('change',function(){
           
                let reader = new FileReader();
            
                reader.onload = (e) => { 
            
                  $('#vehicle_image').attr('src', e.target.result); 
                  $('#confirm-vehicle-image').attr('src', e.target.result); 

                }
            
                reader.readAsDataURL(this.files[0]); 
              
               });


            $('#firstname-val').text(firstname);
            $('#lastname-val').text(lastname);
            $('#gender-val').text(gender);
            $('#phonenumber-val').text(phonenumber);
            $('#idnumber-val').text(idnumber);
            $('#email-val').text(email);
            $('#category-val').text(category);
            $('#regno-val').text(regno);
            

            $("#form-register").validate().settings.ignore = ":disabled,:hidden";
            return $("#form-register").valid();
        }
    });
    
    //submit enrollment details
    $("#completed").on('click',function(){

        const selectedFile = document.getElementById('image').files[0];
        console.log(selectedFile);

        formData1 = new FormData();
        formData1.append('vehicle_image',selectedFile);
        formData1.append('first_name',$('#firstname').val());
        formData1.append('last_name',$('#lastname').val());
        formData1.append('gender',$('#gender').val());
        formData1.append('phone_number',$('#phonenumber').val());
        formData1.append('id_number',$('#idnumber').val());
        formData1.append('email',$('#email').val());
        formData1.append('category',$('#category').val());
        formData1.append('regno',$('#regno').val());

        $.ajax({
            type:'post',
            url: "/customer-enrollment",
            data: formData1,
            processData: false,
            contentType: false,
            success: (data) => {
               console.log(data);
            },
            error: function(data){
               console.log(data);
             }
           }).then( function(){

            //store phone number to form data and use to send sms
           formData = new FormData();
           formData.append('phone_number',$('#phonenumber').val());
   
           $.ajax({
               type:'post',
               url: "/send-sms",
               data: formData,
               processData: false,
               contentType: false,
               success: (data) => {
                
                //display an alert message redirect user back to choose-option page 
                swal("Success !", "Enrollment completed successfully, A Confirmation message was sent !", "success")
                .then(() => {
                    location.href = "/choose-option";
                });

               },
               error: function(data){
   
                //display an alert message redirect user back to choose-option page 
                swal("Error !", "Enrollment completed successfully, Confirmation message failed !", "error")
                    .then(() => {
                        location.href = "/choose-option";
                    });            }
              });


            });


        
           


         })


})
