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
            
            //execute amount and image check on the second step 
            if( currentIndex == 1) {

                let vehicle_registration =$('#regno').val();
                const selectedFile = document.getElementById('image').files;
                let error = "";
                
                // compare amount payable and amount paid
                if(vehicle_registration == "")
                {
             
                    error += "Please enter vehicle registration!";
                    swal("Error!", error , "error");
                    return;
                    
                }
                else if(selectedFile.length == 0)
                {
                    error += "\n Please take a picture of the vehicle before proceeding !";
                    swal("Error!", error , "error");
                    return;

                }
                else
                {
                    console.log("amount paid is equal to amount payable");


                }



               
            
            }

            $("#form-register").validate().settings.ignore = ":disabled,:hidden";
            return $("#form-register").valid();
        }
    });
    
    //submit enrollment details
    $("#completed").on('click',function(){

        $('html, body').animate({
            scrollTop: $("#progress").offset().bottom
        }, 500);

        $('#progress').css('display','');

        const selectedFile = document.getElementById('image').files[0];
        console.log(selectedFile);

        formData = new FormData();
        formData.append('vehicle_image',selectedFile);
        formData.append('first_name',$('#firstname').val());
        formData.append('last_name',$('#lastname').val());
        formData.append('gender',$('#gender').val());
        formData.append('phone_number',$('#phonenumber').val());
        formData.append('id_number',$('#idnumber').val());
        formData.append('email',$('#email').val());
        formData.append('category',$('#category').val());
        formData.append('type',$('#type').val());
        formData.append('regno',$('#regno').val());

        $.ajax({
            type:'post',
            url: "/customer-enrollment",
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
                 
                console.log(data);
                $('#progress').css('display','none');
                //display an alert message redirect user back to choose-option page 
                swal("Success !", "Enrollment completed successfully, A Confirmation message was sent !", "success")
                .then(() => {
                    location.href = "/choose-option";
                });
            },
            error: function(data){
                   
                    theerrors = '';
                    errors = data.responseJSON.errors;
                    $('#progress').css('display','none');
                    $('#errorz').css("display","block");

                    for(key in errors)
                    {
                        
                        theerrors += errors[key][0];
                        theerrors += '\n'

                    }

                
                   swal("Error !", theerrors, "error");
                  
             }
           })

         })
})
