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

            const id_number = localStorage.getItem('id_number');
            const vehicle_reg = localStorage.getItem('vehicle_reg');

            formData = new FormData();
            formData.append('id_number',id_number);
            formData.append('vehicle_reg',vehicle_reg);
            
            //get customer and vehicle data
            $.ajax({
                type:'post',
                url: "/customer-data",
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {


                    customer = data.customer;
                    vehicle = data.vehicle;

                    console.log(customer);
                    console.log(vehicle);


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
                    var rewards_used = $('#rewards').val();

                

                    $('#sales-amount-payable').text(amount_payable);
                    $('#sales-amount-paid').text(amount_paid);
                    $('#sales-reward').text(rewards_used);

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

    
    //get data to be used for sales
    $("#databtn").on('click',function(){
    
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
               vehicle = data.vehicle;

               $('#display-details').remove();
               $('.main-section').append(
                   `
                   <div class="inner">
							
                   <div class="form-row">
                       <div class="form-holder form-holder-2">
                           <label for="firstname" style="color:white; font-weight:bold; margin-bottom:10px;">Customer ID/Phone*</label>
                           <input type="text" id="id-number" style="height:55px;" placeholder="ID Number (34643511)" class="form-control" id="firstname" name="firstname" >
                       </div>
                       <div class="form-holder form-holder-2">
                           <label for="firstname" style="color:white; font-weight:bold; margin-bottom:10px;">Vehicle Reg*</label>
                           <input type="text" id="vehicle-reg" style="height:55px;" placeholder="KAG 445W" class="form-control" id="firstname" name="firstname">
                       </div>
                       <div class="form-holder form-holder-2">
                           <button type="button" id="databtn" style="background-color:#f9a14d; border:0px; width:100%; height:55px; margin-top:40px;" class="btn btn-primary btn-lg btn-block">Get Info</button>
                       </div>
                   </div>
                   <div class="form-row table-responsive">
                       <table class="table">
                           <tbody>
                               <tr class="space-row">
                                   <th>First Name:</th>
                                   <td id="firstname-val">${customer[0].first_name}</td>
                               </tr>
                               <tr class="space-row">
                                   <th>Last Name:</th>
                                   <td id="lastname-val">${customer[0].last_name}</td>
                               </tr>
                           
                               <tr class="space-row">
                                   <th>Phone Number:</th>
                                   <td id="phonenumber-val">${customer[0].phone_number}</td>
                               </tr>
                               <tr class="space-row">
                                   <th>ID Number:</th>
                                   <td id="idnumber-val">${customer[0].id_number}</td>
                               </tr>
                               <tr class="space-row">
                                   <th>Email:</th>
                                   <td id="email-val">${customer[0].email}</td>
                               </tr>
                             
                               <tr class="space-row">
                                   <th>Vehicle Category:</th>
                                   <td id="category-val">${vehicle[0].vehicle_category}</td>
                               </tr>
                               <tr class="space-row">
                                   <th>Vehicle Registration Number:</th>
                                   <td id="regno-val">${vehicle[0].vehicle_registration}</td>
                               </tr>
                               <tr class="space-row">
                               <th>Rewards:</th>
                               <td id="rewards-val">${customer[0].rewards}</td>
                           </tr>
                               
                           </tbody>
                       </table>
                   </div>
                   <div class="col-lg-12 col-md-12 col-sm-12">
                       <p style="color:white; font-weight:bold; margin-bottom:15px;">Vehicle Picture</p>
                       <img src="images/${vehicle[0].image_url}" style="max-width:100%; max-height:500px;" alt="">									
                   </div>
               </div>

                   `
               );
               localStorage.setItem('first_name',customer[0].first_name);
               localStorage.setItem('last_name',customer[0].last_name);
               localStorage.setItem('phone_number',customer[0].phone_number);
               localStorage.setItem('vehicle_registration',vehicle[0].vehicle_registration);
               localStorage.setItem('customer_id',customer[0].id_number);
               localStorage.setItem('cutomer_rewards',customer[0].rewards);




            },
            error: function(data){
               console.log(data);
             }
           });

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
            $( "#rewards" ).prop( "disabled", true );

        }

    });


      // calculate amount payable using the rewards of the customer
      $("#amountpayablebtn").on('click',function(){

            //calculate amount payable
            const rewards =parseInt($('#rewards').val());
            const total_amount =parseInt($('#total_amount').val());

            if(rewards != null)
            {

                //get  customer rewards
                const customer_rewards = localStorage.getItem('cutomer_rewards');

                // check if the rewards entered is not less than the customer reward value
                if(rewards > customer_rewards)
                {
                   
                    swal("Error!", "Please Input less reward value, your rewards are less than the rewards set!", "error");
                }
                else
                {

                     //calculate amount payable with the rewards set only when the reward option is enabled
                     const amount_to_pay = total_amount - rewards;
                     $('#amount_payable').val(amount_to_pay);
 
                     //calculate new reward value
                     reward_percentage = parseFloat($('#reward_percentage').val());
                     console.log(reward_percentage);
                     new_cutomer_rewards = (customer_rewards - rewards) + (reward_percentage * amount_to_pay);
                     $('#sales-reward-balance').text(new_cutomer_rewards);
                     console.log(customer_rewards);
                     console.log(rewards);


                     localStorage.setItem('new_cutomer_rewards',new_cutomer_rewards);
                     localStorage.setItem('used_rewards',rewards);

                }

                
            }
            else
            {

                //calculate amount payable with the rewards set only when the reward option is enabled
                const amount_to_pay = total_amount - 0;
                $('#amount_payable').val(amount_to_pay);

            }


    });


     //display an alert message redirect user back to choose-option page 
     $("#completed").on('click',function(){

         const product = localStorage.getItem('product');
         const last_name = localStorage.getItem('last_name');
         const first_name = localStorage.getItem('first_name');
         const amount_paid = localStorage.getItem('amount_paid');
         const customer_id = localStorage.getItem('customer_id');
         const phone_number = localStorage.getItem('phone_number');
         const used_rewards = localStorage.getItem('used_rewards');
         const amount_payable = localStorage.getItem('amount_payable');
         const new_cutomer_rewards = localStorage.getItem('new_cutomer_rewards');
         const vehicle_registration = localStorage.getItem('vehicle_registration');


        console.log(customer_id);

        formData = new FormData();
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




        $.ajax({
            type:'post',
            url: "/send-sms",
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {
                console.log(data);
                swal("Good job!", "Sale completed successfully, A confirmation message was sent!", "success")
                .then(() => {
                    location.href = "/choose-option";
                });
            },
            error: function(data){

                console.log(data);
                swal("Error!", "An eror Occured!", "error")
                .then(() => {
                    location.href = "/choose-option";
                });             }
           });

    });
     
});
