$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

            const customer_id = localStorage.getItem('customer_id');
            const vehicle_id = localStorage.getItem('vehicle_id');

            console.log(vehicle_id);

            formData = new FormData();
            formData.append('customer_id',customer_id);
            formData.append('vehicle_id',vehicle_id);
            
            //get customer and vehicle data
            $.ajax({
                type:'post',
                url: "/customer-sales-data",
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {


                    customer = data.customer;
                    vehicle = data.vehicle;

                    console.log(customer);
                    console.log(vehicle);

                    date_time = new Date().toLocaleString();

                    $('#sales-date-time').text(date_time);
                    $('#sales-firstname-val').text(customer[0].first_name);
                    $('#sales-lastname-val').text(customer[0].last_name);
                    $('#sales-phonenumber-val').text(customer[0].phone_number);
                    $('#sales-idnumber-val').text(customer[0].id_number);
                    $('#sales-email-val').text(customer[0].email);
                    $('#sales-vehicle-category').text(vehicle[0].vehicle_category);
                    $('#sales-vehicle-registration').text(vehicle[0].vehicle_registration);


                    var myrewards = parseInt(customer[0].rewards);
                    var amount_payable = $('#amount_payable').val();
                    var amount_paid = $('#amount_paid').val();
                    var rewards_used = parseFloat($('#rewards').val()).toFixed(2);
                    localStorage.setItem('vehicle_registration',vehicle[0].vehicle_registration);


            
                    $('#sales-amount-payable').text(amount_payable);
                    $('#sales-amount-paid').text(amount_paid);

                    if(rewards_used != null && isNaN(rewards_used) != true)
                    {
                        $('#sales-reward').text(rewards_used);
                    }
                    else
                    {
                        $('#sales-reward').text("0");

                    }
                    
                    localStorage.setItem('amount_paid',amount_paid);
                    localStorage.setItem('amount_payable',amount_payable);
                    localStorage.setItem('product',"petrol");



                },
                error: function(data){
                   console.log(data);
                 }
               });

            $("#form-register").validate().settings.ignore = ":disabled,:hidden";
            return $("#form-register").valid();
        }
    });

    
    isSubmitting = false;

    //get data to be used for sales
    $("#databtn").on('click',function(e){

        if(isSubmitting) {
            return;
        }
        isSubmitting = true;

        const id_number = $('#id-number').val();
        const vehicle_reg = $('#vehicle-reg').val();

        localStorage.setItem('id_number', id_number );
        localStorage.setItem('vehicle_reg', vehicle_reg );

        formData = new FormData();
        formData.append('id_number',id_number);
        formData.append('vehicle_reg',vehicle_reg);


        $.ajax({
            type:'post',
            url: "/customer-data",
            data:formData,
            processData: false,
            contentType: false,
            success: (data) => {

               customer = data.customer;
               vehicles = data.vehicles;
               console.log(vehicles);
               console.log(customer);


               if(vehicles.length == 0)
               {

                    swal("Error!", "This user is not authorized to make a sale, please enroll or be authorized then try again !", "error");

               }
               else
               {
                
               //display customer details
               $('#display-details').remove();
               $('.main-section').append(
                   `
                   <div class="inner" style="margin-left:20px; margin-">
                            
                   <div class="form-row">
                       <div class="form-holder form-holder-2">
                           <label for="firstname" style="color:white; font-weight:bold; margin-bottom:10px;">Customer ID/Phone*</label>
                           <input type="text" id="id-number" style="height:55px;" placeholder="ID Number (34643511)" class="form-control" id="firstname" name="firstname" >
                       </div>

                       <div id="get_data_btn" class="form-holder form-holder-2">
                           <button type="button" id="databtn" style="background-color:#f9a14d; border:0px; width:100%; height:55px; margin-top:40px;" class="btn btn-primary btn-lg btn-block">Get Info</button>
                       </div>
                   </div>

                   <h3 style="color:white;">Customer Details</h3>
                   <div class="card" style="width: 100%; margin-bottom:25px; color:white; background-color:#2f8be0;">
                    <div class="card-body">
                        
                        <p class="card-text">
                        <span style="color:white; font-weight:bold;" class="card-subtitle mb-2 text-white">Name :</span>
                        <span> ${customer[0].first_name}  ${customer[0].last_name} </span> 
                        </p>

                        <p class="card-text">
                        <span style="color:white; font-weight:bold;" class="card-subtitle mb-2 text-white"">Phone Number :</span>
                        <span>${customer[0].phone_number}</span>
                        </p>

                        <p class="card-text">
                        <span style="color:white; font-weight:bold;" class="card-subtitle mb-2 text-white"">Id Number :</span>
                        <span>${customer[0].id_number}</span>                        
                        </p>

                        <p class="card-text">
                        <span style="color:white; font-weight:bold;" class="card-subtitle mb-2 text-white"">Rewards :</span>
                        <span>${customer[0].rewards}</span>                        
                        </p>
    
                    </div>
                    </div>
                    <h3 style="color:white; margin-top:40px; padding-left:5px;">Select Vehicle</h3>

               </div>

                   `
               );



               let i = 0;

               //display vehicle details
               vehicles.forEach(vehicle => {
                   i = i+1;

                  

                    $('.main-section').append(
                        `
                            <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                            <table style="border:0px;" class="table align-items-center mb-0">
                                <thead style="border:0px;">
                                <tr style="border:0px;">
                                <th style="border:0px;" class="text-uppercase text-white text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th style="border:0px;" class="text-uppercase text-white text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th style="border:0px;"  class="text-center text-white text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    <th style="border:0px;" class="text-center text-white text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody style="border:0px; border-bottom:0px;">
                                    <tr style="border:0px;">
                                    <th style="display:flex; border:0px;"><input id="${vehicle.id}" style="width:17px; height:17px;"  class="form-check-input vehicle_sale_id" type="checkbox" value="" />
                                    </th>
                                    <td  style="border:0px; color:white; " class="align-middle text-left text-sm">
                                       ${vehicle.vehicle_registration}
                                    <td style="border:0px; color:white;" class="align-middle text-center text-sm">
                                        ${vehicle.vehicle_type}
                                    </td>
                                    <td style="border:0px; color:white;" class="align-middle text-center text-sm">
                                    ${vehicle.vehicle_category}
                                    </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            </div>
                        </div>
                    
                        `
                    );
            
               });

               $('.main-section').append(`
                <div  class="form-holder form-holder-2">
                            <button type="button" id="addvehicle" style="max-width:150px; background-color:#f9a14d; border:0px; width:100%; font-size:15px; margin-top:40px;" class="btn btn-primary btn-lg btn-block">ADD NEW</button>
                        </div>
               `);
               

               //Get vehicle data to be fueled
               $("#addvehicle").on('click',function() {
                 $('#add_vehicle_modal').modal('show');
               });
               

                //Get vehicle data to be fueled
                $(".vehicle_sale_id").on('change',function() {
                    if(this.checked) {

                        const id = parseInt($(this).attr("id"));
                        localStorage.setItem('vehicle_id',id);

                    }
                });

                localStorage.setItem('first_name',customer[0].first_name);
                localStorage.setItem('last_name',customer[0].last_name);
                localStorage.setItem('phone_number',customer[0].phone_number);
                localStorage.setItem('customer_id',customer[0].id);
                localStorage.setItem('cutomer_rewards',customer[0].rewards);

               }

            isSubmitting = false;
            
            },
            error: function(data){

                swal("Error!", "please enter a valid id number or phone number and try again!", "error");
                isSubmitting = false;        

             },
          
           });

           return false;

    });
  

    //get the status of the reward
    $(".usereward").on('change',function(){
        
        var rewardStatus = $("input[type='radio']:checked").val();
        
        if(rewardStatus == 'yes')
        {   
            $( "#rewards" ).prop( "disabled", false );

        }
        else
        {   
            $( "#rewards" ).val("");
            $( "#rewards" ).prop( "disabled", true );

        }

    });


    
      // calculate amount payable using the rewards of the customer
      $("#amountpayablebtn").on('click',function(){

            //calculate amount payable
            const rewards =parseInt($('#rewards').val());
            const total_amount =parseInt($('#total_amount').val());

            if(rewards != null && isNaN(rewards) != true)
            {

                //get  customer rewards
                let customer_rewards = localStorage.getItem('cutomer_rewards');

                // check if the rewards entered is not less than the customer reward value
                if(rewards > customer_rewards)
                {
                   
                    swal("Error!", "Please Input less reward value, your rewards are less than the rewards set!", "error");
                }
                else
                {

                     //calculate amount payable with the rewards set only when the reward option is enabled
                     let amount_to_pay = total_amount - rewards;
                     $('#amount_payable').val(amount_to_pay);
 
                     //calculate new reward value
                     reward_percentage = parseFloat($('#reward_percentage').val());
                     petrol_amount = parseFloat($('#petrol_amount').val());
                     new_cutomer_rewards = (customer_rewards - rewards) + (reward_percentage * (amount_to_pay/petrol_amount));
                     $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                     amount_in_litres = (amount_to_pay/petrol_amount);
                     $("#liters_val").val(amount_in_litres.toFixed(2));
                     new_cutomer_rewards.toFixed(2);


                     rewards_awarded = (reward_percentage * (amount_to_pay/petrol_amount));
                     localStorage.setItem('new_cutomer_rewards',new_cutomer_rewards);
                     localStorage.setItem('used_rewards',rewards);
                     localStorage.setItem('rewards_awarded',rewards_awarded);


                }

                
            }
            else
            {   

                let rewards_used = 0;

                //get  customer rewards
                let customer_rewards = localStorage.getItem('cutomer_rewards');

                //calculate amount payable with the rewards set only when the reward option is enabled
                let amount_to_pay = total_amount - 0;
                $('#amount_payable').val(amount_to_pay);

                //calculate new reward value
                reward_percentage = parseFloat($('#reward_percentage').val());
                console.log(reward_percentage);
                new_cutomer_rewards = (customer_rewards - rewards_used) + (reward_percentage * amount_to_pay);
                $('#sales-reward-balance').text(new_cutomer_rewards);
                console.log(customer_rewards);
                console.log(rewards);

                rewards_awarded = reward_percentage * amount_to_pay;
                localStorage.setItem('new_cutomer_rewards',new_cutomer_rewards);
                localStorage.setItem('used_rewards',rewards_used);
                localStorage.setItem('rewards_awarded',rewards_awarded);



            }


    });

    //calculate amount of litres
    $('#total_amount').on('keyup',function(){
        petrol_amount = parseFloat($('#petrol_amount').val());
        total_amount = parseFloat($("#total_amount").val());
        total_amount_ltr = parseFloat( total_amount / petrol_amount);
        $("#liters_val").val(total_amount_ltr.toFixed(2));
    });


     //display an alert message redirect user back to choose-option page 
     $("#completed").on('click',function(){

        const selectedFile = document.getElementById('image').files[0];
        console.log(selectedFile);

        const product = localStorage.getItem('product');
        const last_name = localStorage.getItem('last_name');
        const first_name = localStorage.getItem('first_name');
        const amount_paid = localStorage.getItem('amount_paid');
        const customer_id = localStorage.getItem('customer_id');
        const phone_number = localStorage.getItem('phone_number');
        const used_rewards = localStorage.getItem('used_rewards');
        const amount_payable = localStorage.getItem('amount_payable');
        const rewards_awarded = localStorage.getItem('rewards_awarded');
        const new_cutomer_rewards = localStorage.getItem('new_cutomer_rewards');
        const vehicle_registration = localStorage.getItem('vehicle_registration');


        formData = new FormData();

        formData.append('vehicle_image',selectedFile);
        formData.append('product',product);
        formData.append('last_name',last_name);
        formData.append('first_name',first_name);
        formData.append('amount_paid',amount_paid);
        formData.append('customer_id',customer_id);
        formData.append('used_rewards',used_rewards);
        formData.append('phone_number',phone_number);
        formData.append('amount_payable',amount_payable);
        formData.append('vehicle_registration',vehicle_registration);
        formData.append('new_cutomer_rewards',new_cutomer_rewards);
        formData.append('rewards_awarded',rewards_awarded);

        console.log(vehicle_registration);

        $.ajax({
            type:'post',
            url: "/send-sales-sms",
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
                
                console.log(data);
                localStorage.clear();
                swal("Good job!", "Sale completed successfully, A confirmation message was sent!", "success")
                .then(() => {
                    location.href = "/choose-option";
                });
            },
            error: function(data){

                errors = data.responseJSON.errors;

                    $('#errorz').css("display","block");

                    for(key in errors)
                    {

                        console.log(errors[key][0]);

                        $('#errorsul').append(`
                        <li class="list-group-item">
                            "${errors[key][0]}"
                        </li>
                        `)

                    }

                  console.log(data);            
            
             }
           });

    });


    //get vehicle data to add
    $("#submitvehiclebtn").on('click',function(e){

        e.preventDefault();
        vehicle_category = $("#vehicle_category").val();
        vehicle_type = $("#vehicle_type").val();
        vehicle_registration = $("#vehicle_registration").val();
        customer_id = localStorage.getItem('customer_id');

        console.log(vehicle_registration);

        formData = new FormData();
        formData.append('vehicle_category',vehicle_category);
        formData.append('vehicle_type',vehicle_type);
        formData.append('vehicle_registration',vehicle_registration);
        formData.append('customer_id',customer_id);


        $.ajax({
            type:'post',
            url: "/add-another-vehicle",
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {

                $('#add_vehicle_modal').modal('hide');
                swal("Success!", "Vehicle Added successfully!", "success")
                .then(() => {
                    location.reload();
                });
                

             
            },
            error: function(data){
                   
                  
                swal("Error!", "There was an error adding vehicle Please try again!", "error");


             }
           });

         });

         $('#image').on('change',function(){
           
            let reader = new FileReader();
        
            reader.onload = (e) => { 
        
              $('#vehicle_image').attr('src', e.target.result); 

            }
        
            reader.readAsDataURL(this.files[0]); 
          
           });

        
});
