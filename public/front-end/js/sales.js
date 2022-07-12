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
            var firstsale = false;

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
                    $('#sales-name-val').text(customer[0].first_name+' '+customer[0].last_name);
                    $('#sales-phonenumber-val').text(customer[0].phone_number);
                    $('#sales-email-val').text(customer[0].email);
                    $('#sales-vehicle-category').text(vehicle[0].vehicle_category);
                    $('#sales-vehicle-registration').text(vehicle[0].vehicle_registration);


                    var myrewards = parseInt(customer[0].rewards);
                    $('.rewards-available').text(myrewards);
                    var amount_payable = $('#amount_payable').val();
                    var amount_paid = $('#amount_paid').val();
                    var rewards_used = parseFloat($('#rewards').val()).toFixed(2);
                    localStorage.setItem('vehicle_registration',vehicle[0].vehicle_registration);
                    localStorage.setItem('authorized_amount',customer[0].authorized_amount);
                    localStorage.setItem('reward_type_to_use',customer[0].reward_type_to_use);



            
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

                    if((customer[0].sale_start_date == null) && (customer[0].sale_end_date == null))
                    {
                        firstsale = true;
                    }
                    else
                    {
                        firstsale = false;
                        localStorage.setItem('db_start_date',customer[0].sale_start_date);
                        localStorage.setItem('db_end_date',customer[0].sale_end_date);

                    }


                    //set amount and litres if customer is authoried by the corporate
                    if(!(isNaN(customer[0].authorized_amount)) && ((customer[0].reward_type_to_use == 'credit') || (customer[0].reward_type_to_use == 'prepaid')))
                    {
                        //calculate amount of litres
                        product_amount = parseFloat($('#product').val());
                        total_amount_ltr = parseFloat( customer[0].authorized_amount / product_amount);
                        $("#total_amount").val(customer[0].authorized_amount);
                        $("#liters_val").val(total_amount_ltr.toFixed(2));
                        rewards = parseInt($('#rewards').val());
                        litres = parseFloat($("#liters_val").val());
                        total_amount =parseInt($('#total_amount').val());
                        $('#total_amount').attr('readonly', true);
                        $('#liters_val').attr('readonly', true);



                    }
               

                    localStorage.setItem('amount_paid',amount_paid);
                    localStorage.setItem('amount_payable',amount_payable);
                    localStorage.setItem('product',"petrol");
                    localStorage.setItem('firstsale',firstsale);




                },
                error: function(data){
                   console.log(data);
                 }
               });

            //make it mandatory to choose a vehicle in the first step
            if(!($('.vehicle_sale_id').is(":checked")))
            {
                swal("Error!", "Please select a vehicle before proceeding!", "error");
                return;
            }
            else{
                console.log("vehicle selected");
            }

            
            
            //execute amount and image check on the second step 
            if( currentIndex == 1) {

                let amount_paid =parseInt($('#amount_paid').val());
                let amount_payable =parseInt($('#amount_payable').val());
                const selectedFile = document.getElementById('image').files;
                let error = "";
                
                // compare amount payable and amount paid
                if(!(amount_paid == amount_payable))
                {
             
                    error += "Amount paid must be equal to amount payable !";
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

    
    isSubmitting = false;

    //get data to be used for sales
    $("#databtn").on('click',function(e){

        if(isSubmitting) {
            return;
        }
        isSubmitting = true;

        id_number = $('#id-number').val();

        localStorage.setItem('id_number', id_number );

        formData = new FormData();
        formData.append('id_number',id_number);


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
                           <label for="firstname" style="color:white; font-weight:bold; margin-bottom:10px;">ID/Phone/Vehicle Registration*</label>
                           <input type="text" id="id-number" style="height:55px;" placeholder="" class="form-control" id="firstname" name="firstname" >
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

                        <p class="card-text">
                        <span style="color:white; font-weight:bold;" class="card-subtitle mb-2 text-white"">Customer :</span>
                        <span class="customer-type">${customer[0].reward_type_to_use}</span>                        
                        </p>

                        <p class="card-text authorized-amount-paragraph">
                        <span style="color:white; font-weight:bold;" class="card-subtitle mb-2 text-white"">Authorized Amount :</span>
                        <span class="authorized-amount">${customer[0].reward_type_to_use}</span>                        
                        </p>
    
                    </div>
                    </div>
                    <h3 style="color:white; margin-top:40px; padding-left:5px;">Select Vehicle</h3>

               </div>

                   `
               );
                
               //set customer type
               if(customer[0].reward_type_to_use !== null)
               {

                   $('.customer-type').text('Corporate');
                   $('.authorized-amount').text(customer[0].authorized_amount);
                   localStorage.setItem('authorized_amount',customer[0].authorized_amount);


               }
               else
               {
                   $('.customer-type').text('Normal');
                   $('.authorized-amount-paragraph').hide();


               }



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
                                    <th style="display:flex; border:0px;">
                                        <input id="${vehicle.id}" style="width:17px; height:17px;"  class="form-check-input vehicle_sale_id" type="checkbox" value="${vehicle.id}"/>
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

                console.log(data);
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

        customer_type = $('.customer-type').text();
        
        if(customer_type == 'Corporate')
        {
            $('#amount_payable').prop('readonly', false);

        }

        // get rewards
        $.ajax({
            type:'get',
            url: "/reward-format",
            success: (data) => {

            
            // get Rewards format
            rewards_format = data.rewards_format;

            // calculate amount payable
            var rewards =parseInt($('#rewards').val());
            var total_amount =parseInt($('#total_amount').val());
            var litres = parseFloat($("#liters_val").val());
            var new_cutomer_rewards = 0;
            var rewards_awarded = 0;
            var rewards_used = 0;
            firstsale = localStorage.getItem('firstsale');

            authorized_amount = localStorage.getItem('authorized_amount');
            authorized_reward_type = localStorage.getItem('reward_type_to_use');

            
            console.log(authorized_amount);
            console.log(authorized_reward_type);
            
            //define the reward format to use
            if(!(isNaN(authorized_amount)) && ((authorized_reward_type == 'credit') || (authorized_reward_type == 'prepaid')))
            {
                
                var reward_format_to_use = {};
                console.log(authorized_amount);
                console.log(authorized_reward_type);

                // get reward format details for rewards that are not corporate
                rewards_format.forEach(reward_format => {

                    if(reward_format.reward_type == authorized_reward_type)
                    {
                        

                        //calculate amount of litres
                        product_amount = parseFloat($('#product').val());
                        total_amount_ltr = parseFloat( authorized_amount / product_amount);
                        $("#total_amount").val(authorized_amount);
                        $("#liters_val").val(total_amount_ltr.toFixed(2));
                        rewards = parseInt($('#rewards').val());
                        litres = parseFloat($("#liters_val").val());
                        total_amount =parseInt($('#total_amount').val());

               
                        if((total_amount_ltr >= reward_format.low) && (total_amount_ltr <= reward_format.high))
                        {   
                            
                            reward_percentage = parseFloat(reward_format.shillings_per_litre);
                            reward_type = reward_format.reward_type;
                            reward_format_to_use[reward_type] = reward_percentage;

                        
                        }
                    }

                });


            }
            else
            {

                //clear reward format to
                reward_format_to_use = {};
                console.log(rewards_format);

                // get reward format details for rewards that are not corporate
                rewards_format.forEach(reward_format => {

                    if((litres >= reward_format.low) && (litres <= reward_format.high) && (reward_format.reward_type != 'credit') && (reward_format.reward_type != 'prepaid'))
                    {
                        
                        reward_percentage = parseFloat(reward_format.shillings_per_litre);
                        reward_type = reward_format.reward_type;
                        reward_format_to_use[reward_type] = reward_percentage;
                        reward_format_length = Object.keys(reward_format_to_use).length;
                    

                    }

                });

            }
           
            
            let customer_rewards = localStorage.getItem('cutomer_rewards');

            if(rewards != null && isNaN(rewards) != true)
            {

                // check if the rewards entered is not less than the customer reward value
                if(rewards > customer_rewards)
                {
                   
                    swal("Error!", "Please Input less reward value, your rewards are less than the rewards set!", "error");
                }
                else
                {   
                     
                    if('bulk' in reward_format_to_use)
                    {  
                        console.log('bulk');

                        if(firstsale == true)
                        { 
                            console.log(true);

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (rewards + (reward_format_to_use['bulk'] * litre));
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards;
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['bulk'] * litres).toFixed(2);
                            $('#sales-rewards-awarded').text(rewards_awarded);

                             //get current day
                             date = new Date();
                             start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             
                             localStorage.setItem('sale_start_date',start_date);
                             localStorage.setItem('sale_end_date',end_date);
                             console.log(rewards_awarded)
                        }
                        else
                        {  
                            
                            console.log(false);


                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                             //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (rewards + reward_format_to_use['bulk'] * litres);
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards;
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['bulk'] * litres).toFixed(2);
                            $('#sales-rewards-awarded').text(rewards_awarded);

                            console.log(rewards_awarded);


                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

                            console.log({
                                'st':start_date,
                                'et':end_date
                            })

                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                        }
                       



                    }
                    else if('credit' in reward_format_to_use)
                    {
                        

                        if(firstsale == true)
                        { 
                            console.log(true);

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - rewards;
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards + (reward_format_to_use['credit'] * litre);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['credit'] * litres).toFixed(2);
                            $('#sales-rewards-awarded').text(rewards_awarded);

                            console.log(rewards_awarded);


                             //get current day
                             date = new Date();
                             start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             
                             localStorage.setItem('sale_start_date',start_date);
                             localStorage.setItem('sale_end_date',end_date);
                             console.log(rewards_awarded);
                             console.log(sale_start_date);
                             console.log(sale_end_date);
                        }
                        else
                        {  
                            
                            console.log(total_amount);
                            console.log(reward_format_to_use['credit']); 

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                             //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - rewards;
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            console.log({
                                'rewards': customer_rewards
                            })


                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards + (reward_format_to_use['credit'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['credit'] * litres).toFixed(2);
                            $('#sales-rewards-awarded').text(rewards_awarded);

                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

                            console.log({
                                'st':start_date,
                                'et':end_date
                            })

                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(sale_start_date);
                            console.log(sale_end_date);
                        }
                       



                    }
                    else if('prepaid' in reward_format_to_use)
                    {
                        console.log('prepaid');

                        if(firstsale == true)
                        { 
                            console.log(true);

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (rewards);
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;


                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards + (reward_format_to_use['prepaid'] * litre);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['prepaid'] * litres).toFixed(2);
                           
                            console.log(customer_rewards);

                            $('#sales-rewards-awarded').text(rewards_awarded);

                             //get current day
                             date = new Date();
                             start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             
                             localStorage.setItem('sale_start_date',start_date);
                             localStorage.setItem('sale_end_date',end_date);
                             console.log(rewards_awarded)
                        }
                        else
                        {  
                            
                            console.log(false);


                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                             //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (rewards);
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            console.log({
                                'rewards': customer_rewards
                            })


                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards + (reward_format_to_use['prepaid'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['prepaid'] * litres).toFixed(2);
                            $('#sales-rewards-awarded').text(rewards_awarded);

                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

                            console.log({
                                'st':start_date,
                                'et':end_date
                            })

                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                        }
                       
                    }
                    else
                    {   
                        console.log('reter');

                        if(firstsale == true){

                            console.log(firstsale);

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - rewards;
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = (parseInt(customer_rewards) - rewards) + (reward_format_to_use['monthly'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['monthly'] * litres).toFixed(2);

                            //get current day
                            date = new Date();
                            start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            
                            $('#sales-rewards-awarded').text(rewards_awarded);
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(rewards_awarded)

                        }
                        else
                        {    

                           let customer_rewards = localStorage.getItem('cutomer_rewards');

                           //calculate difference in employs sale dates
                           db_end_date = new Date(localStorage.getItem('db_end_date')).getTime();
                           db_start_date = new Date(localStorage.getItem('db_start_date')).getTime();
                           datediff = Math.ceil((db_end_date - db_start_date)/(1000 * 60 * 60 * 24));

                           if(datediff >= 30)
                           {

                                let customer_rewards = localStorage.getItem('cutomer_rewards');

                                 //calculate amount payable with the rewards set only when the reward option is enabled
                                let amount_to_pay = total_amount - rewards;
                                $('#amount_payable').val(amount_to_pay);
                                rewards_used = rewards;

                                console.log(customer_rewards);


                                //bulk rewards
                                new_cutomer_rewards = (parseInt(customer_rewards) - rewards) + (reward_format_to_use['monthly'] * litres);
                                $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                                new_cutomer_rewards.toFixed(2);
                                rewards_awarded = (reward_format_to_use['monthly'] * litres).toFixed(2);

                                console.log(rewards_awarded);

                                date = new Date();
                                start_date = localStorage.getItem('db_start_date');
                                end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

                                $('#sales-rewards-awarded').text(rewards_awarded);
                                localStorage.setItem('sale_start_date',end_date);
                                localStorage.setItem('sale_end_date',end_date);
                                console.log(rewards_awarded)

                           }
                           else
                           {
                            
                                swal("Error!", "You are not eligble to use rewards, you must complete one month!", "error")

                                let customer_rewards = localStorage.getItem('cutomer_rewards');

                                //calculate amount payable with the rewards set only when the reward option is enabled
                                let rewards = 0;
                                let amount_to_pay = total_amount - rewards;
                                $('#amount_payable').val(amount_to_pay);
                                $('#rewards').val(0);
                                rewards_used = rewards;

                                console.log(customer_rewards);

                                //bulk rewards
                                new_cutomer_rewards = (parseInt(customer_rewards) - rewards) + (reward_format_to_use['monthly'] * litres);
                                $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                                new_cutomer_rewards.toFixed(2);
                                rewards_awarded = (reward_format_to_use['monthly'] * litres);

                                console.log(customer_rewards);


                                date = new Date();
                                start_date = localStorage.getItem('db_start_date');
                                end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

                                $('#sales-rewards-awarded').text(rewards_awarded);
                                localStorage.setItem('sale_start_date',start_date);
                                localStorage.setItem('sale_end_date',end_date);
                                console.log(rewards_awarded)

                          
                            }
                           
                        }
                        

                    }
           
                     
                     localStorage.setItem('new_cutomer_rewards',new_cutomer_rewards);
                     localStorage.setItem('used_rewards',rewards);
                     localStorage.setItem('rewards_awarded',rewards_awarded);


                }

                
            }
            else
            {
                
                    if('bulk' in reward_format_to_use)
                    {
                        if(firstsale == true)
                        {

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (0 + reward_format_to_use['bulk'] * litres);
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = 0;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - 0;
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['bulk'] * litres).toFixed(2);

                            //get current day
                            date = new Date();
                            start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                           
                            $('#sales-rewards-awarded').text(rewards_awarded);
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(rewards_awarded)

                        }
                        else
                        {
                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (0 + reward_format_to_use['bulk'] * litres);
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = 0;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - 0;
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['bulk'] * litres);

                           
                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                           
                            $('#sales-rewards-awarded').text(rewards_awarded);
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);


                        }


                    }
                    else if('credit' in reward_format_to_use)
                    {

                        console.log(reward_format_to_use);
                        if(firstsale == true)
                        {

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            // let amount_to_pay = total_amount - (0 + reward_format_to_use['credit'] * litres);
                            $('#amount_payable').val(total_amount);


                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) + (reward_format_to_use['credit'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['credit'] * litres).toFixed(2);

                            //get current day
                            date = new Date();
                            start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                           
                            $('#sales-rewards-awarded').text(rewards_awarded);
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(rewards_awarded);
                            console.log(sale_start_date);
                            console.log(sale_end_date);

                        }
                        else
                        {
                            let customer_rewards = localStorage.getItem('cutomer_rewards');
                            console.log(total_amount);
                            console.log(litres);
                            console.log(reward_format_to_use['credit']);



                            //calculate amount payable with the rewards set only when the reward option is enabled
                            // let amount_to_pay = total_amount - (0 + reward_format_to_use['credit'] * litres);
                            console.log(total_amount);

                            $('#amount_payable').val(total_amount);
                            rewards_used = 0;

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) + (reward_format_to_use['credit'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['credit'] * litres);
                            console.log(rewards_awarded);
                           
                            $('#sales-rewards-awarded').text(rewards_awarded);

                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(start_date);
                            console.log(end_date);
                            console.log(rewards_awarded);


                        }


                    }
                    else if('prepaid' in reward_format_to_use)
                    {
                        if(firstsale == true)
                        {

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            // let amount_to_pay = total_amount - (0 + reward_format_to_use['prepaid'] * litres);
                            $('#amount_payable').val(total_amount);
                            rewards_used = 0;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) +  (reward_format_to_use['prepaid'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['prepaid'] * litres).toFixed(2);

                            //get current day
                            date = new Date();
                            start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                           
                            $('#sales-rewards-awarded').text(rewards_awarded);
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(rewards_awarded)

                        }
                        else
                        {
                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            // let amount_to_pay = total_amount - (0 + reward_format_to_use['prepaid'] * litres);
                            $('#amount_payable').val(total_amount);
                            rewards_used = 0;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) + (reward_format_to_use['prepaid'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['prepaid'] * litres);

                            console.log(rewards_awarded)

                            $('#sales-rewards-awarded').text(rewards_awarded);
                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);


                        }


                    }
                    else
                    {  

                        if('monthly' in reward_format_to_use)
                        {
                            if(firstsale == true){

                                let customer_rewards = localStorage.getItem('cutomer_rewards');

                                //calculate amount payable with the rewards set only when the reward option is enabled
                                let amount_to_pay = total_amount - 0;
                                $('#amount_payable').val(amount_to_pay);
                                rewards_used = 0;
        
                                console.log(customer_rewards);
        
                                //bulk rewards
                                new_cutomer_rewards = (parseInt(customer_rewards) - 0) + (reward_format_to_use['monthly'] * litres);
                                $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                                new_cutomer_rewards.toFixed(2);
                                rewards_awarded =(reward_format_to_use['monthly']*litres).toFixed(2);
        
        
                                 //get current day
                                 date = new Date();
                                 start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                                 end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                               
                                 $('#sales-rewards-awarded').text(rewards_awarded);
                                 localStorage.setItem('sale_start_date',start_date);
                                 localStorage.setItem('sale_end_date',end_date);
        
                               }
                               else
                               {

                                rewards = 0;

                                let customer_rewards = localStorage.getItem('cutomer_rewards');
        
                                //calculate amount payable with the rewards set only when the reward option is enabled
                                let amount_to_pay = total_amount - 0;
                                $('#amount_payable').val(amount_to_pay);
                                rewards_used = rewards;
        
                                console.log(customer_rewards);
        
                                //bulk rewards
                                new_cutomer_rewards = (parseInt(customer_rewards) - rewards) + (reward_format_to_use['monthly'] * litres);
                                $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                                new_cutomer_rewards.toFixed(2);
                                rewards_awarded = (reward_format_to_use['monthly'] * litres).toFixed(2);
        
                                //get current day
                                date = new Date();
                                start_date = localStorage.getItem('db_start_date');
                                end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                                
                                $('#sales-rewards-awarded').text(rewards_awarded);
                                localStorage.setItem('sale_start_date',start_date);
                                localStorage.setItem('sale_end_date',end_date);
        
        
                               }
        
                        }
                        

                      

                    }
           
                     
                     $('#sales-rewards-awarded').text(rewards_awarded);
                     localStorage.setItem('new_cutomer_rewards',new_cutomer_rewards);
                     localStorage.setItem('used_rewards',rewards_used);
                     localStorage.setItem('rewards_awarded',rewards_awarded);



            }
                
               
            },
            error: function(data){
                   
                console.log(data);

             }
           })

           


    });

    //calculate amount of litres
    $('#total_amount').on('keyup',function(){
        product_amount = parseFloat($('#product').val());
        total_amount = parseFloat($("#total_amount").val());
        total_amount_ltr = parseFloat( total_amount / product_amount);
        $("#liters_val").val(total_amount_ltr.toFixed(2));
    });


    
    //calculate cash if litres is entered
    $('#liters_val').on('keyup',function(){
        product_amount = parseFloat($('#product').val());
        litres = parseFloat($("#liters_val").val());
        total_amount = parseFloat( litres * product_amount);
        $("#total_amount").val(total_amount.toFixed(2));
    });


    //calculate cash if litres is entered
    $('#amount_payable').on('keyup keypress',function(){
        
        authorized_amount =  parseInt(localStorage.getItem('authorized_amount'));
        var amount_payable = $('#amount_payable').val();
        
        if(amount_payable > authorized_amount)
        {  

            product_amount = parseFloat($('#product').val());
            liters = authorized_amount/product_amount
            litres = $("#liters_val").val(liters.toFixed(2));
            $("#total_amount").val(authorized_amount)
            swal("Error!", "Please Input a Less amount than the authorized amount","error");

        }
        else
        {
            product_amount = parseFloat($('#product').val());
            liters = amount_payable/product_amount
            litres = $("#liters_val").val(liters.toFixed(2));
            $("#total_amount").val(parseInt(amount_payable));

        // get rewards
        $.ajax({
            type:'get',
            url: "/reward-format",
            success: (data) => {

            
            // get Rewards format
            rewards_format = data.rewards_format;

            // calculate amount payable
            var rewards =parseInt($('#rewards').val());
            var total_amount =parseInt($('#total_amount').val());
            var litres = parseFloat($("#liters_val").val());
            var new_cutomer_rewards = 0;
            var rewards_awarded = 0;
            var rewards_used = 0;
            firstsale = localStorage.getItem('firstsale');

            authorized_amount = localStorage.getItem('authorized_amount');
            authorized_reward_type = localStorage.getItem('reward_type_to_use');

            
            console.log(authorized_amount);
            console.log(authorized_reward_type);
            
            //define the reward format to use
            if(!(isNaN(authorized_amount)) && ((authorized_reward_type == 'credit') || (authorized_reward_type == 'prepaid')))
            {
                
                var reward_format_to_use = {};
                console.log(authorized_amount);
                console.log(authorized_reward_type);

                // get reward format details for rewards that are not corporate
                rewards_format.forEach(reward_format => {

                    if(reward_format.reward_type == authorized_reward_type)
                    {
                        

                        //calculate amount of litres
                        product_amount = parseFloat($('#product').val());
                        total_amount_ltr = parseFloat( amount_payable / product_amount);
                        $("#total_amount").val(amount_payable);
                        $("#liters_val").val(total_amount_ltr.toFixed(2));
                        rewards = parseInt($('#rewards').val());
                        litres = parseFloat($("#liters_val").val());
                        total_amount =parseInt($('#total_amount').val());

               
                        if((total_amount_ltr >= reward_format.low) && (total_amount_ltr <= reward_format.high))
                        {   
                            
                            reward_percentage = parseFloat(reward_format.shillings_per_litre);
                            reward_type = reward_format.reward_type;
                            reward_format_to_use[reward_type] = reward_percentage;

                        
                        }
                    }

                });


            }
            else
            {

                //clear reward format to
                reward_format_to_use = {};
                console.log(rewards_format);

                // get reward format details for rewards that are not corporate
                rewards_format.forEach(reward_format => {

                    if((litres >= reward_format.low) && (litres <= reward_format.high) && (reward_format.reward_type != 'credit') && (reward_format.reward_type != 'prepaid'))
                    {
                        
                        reward_percentage = parseFloat(reward_format.shillings_per_litre);
                        reward_type = reward_format.reward_type;
                        reward_format_to_use[reward_type] = reward_percentage;
                        reward_format_length = Object.keys(reward_format_to_use).length;
                    

                    }

                });

            }
           
            
            let customer_rewards = localStorage.getItem('cutomer_rewards');

            if(rewards != null && isNaN(rewards) != true)
            {

                // check if the rewards entered is not less than the customer reward value
                if(rewards > customer_rewards)
                {
                   
                    swal("Error!", "Please Input less reward value, your rewards are less than the rewards set!", "error");
                }
                else
                {   
                     
                    if('bulk' in reward_format_to_use)
                    {  
                        console.log('bulk');

                        if(firstsale == true)
                        { 
                            console.log(true);

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (rewards + (reward_format_to_use['bulk'] * litre));
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards;
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['bulk'] * litres).toFixed(2);
                            $('#sales-rewards-awarded').text(rewards_awarded);

                             //get current day
                             date = new Date();
                             start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             
                             localStorage.setItem('sale_start_date',start_date);
                             localStorage.setItem('sale_end_date',end_date);
                             console.log(rewards_awarded)
                        }
                        else
                        {  
                            
                            console.log(false);


                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                             //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (rewards + reward_format_to_use['bulk'] * litres);
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards;
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['bulk'] * litres).toFixed(2);
                            $('#sales-rewards-awarded').text(rewards_awarded);

                            console.log(rewards_awarded);


                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

                            console.log({
                                'st':start_date,
                                'et':end_date
                            })

                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                        }
                       



                    }
                    else if('credit' in reward_format_to_use)
                    {
                        

                        if(firstsale == true)
                        { 
                            console.log(true);

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - rewards;
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards + (reward_format_to_use['credit'] * litre);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['credit'] * litres).toFixed(2);
                            $('#sales-rewards-awarded').text(rewards_awarded);

                            console.log(rewards_awarded);


                             //get current day
                             date = new Date();
                             start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             
                             localStorage.setItem('sale_start_date',start_date);
                             localStorage.setItem('sale_end_date',end_date);
                             console.log(rewards_awarded);
                             console.log(sale_start_date);
                             console.log(sale_end_date);
                        }
                        else
                        {  
                            
                            console.log(total_amount);
                            console.log(reward_format_to_use['credit']); 

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                             //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - rewards;
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            console.log({
                                'rewards': customer_rewards
                            })


                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards + (reward_format_to_use['credit'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['credit'] * litres).toFixed(2);
                            $('#sales-rewards-awarded').text(rewards_awarded);

                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

                            console.log({
                                'st':start_date,
                                'et':end_date
                            })

                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(sale_start_date);
                            console.log(sale_end_date);
                        }
                       



                    }
                    else if('prepaid' in reward_format_to_use)
                    {
                        console.log('prepaid');

                        if(firstsale == true)
                        { 
                            console.log(true);

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (rewards);
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;


                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards + (reward_format_to_use['prepaid'] * litre);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['prepaid'] * litres).toFixed(2);
                           
                            console.log(customer_rewards);

                            $('#sales-rewards-awarded').text(rewards_awarded);

                             //get current day
                             date = new Date();
                             start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                             
                             localStorage.setItem('sale_start_date',start_date);
                             localStorage.setItem('sale_end_date',end_date);
                             console.log(rewards_awarded)
                        }
                        else
                        {  
                            
                            console.log(false);


                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                             //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (rewards);
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            console.log({
                                'rewards': customer_rewards
                            })


                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - rewards + (reward_format_to_use['prepaid'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['prepaid'] * litres).toFixed(2);
                            $('#sales-rewards-awarded').text(rewards_awarded);

                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

                            console.log({
                                'st':start_date,
                                'et':end_date
                            })

                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                        }
                       
                    }
                    else
                    {   
                        console.log('reter');

                        if(firstsale == true){

                            console.log(firstsale);

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - rewards;
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = rewards;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = (parseInt(customer_rewards) - rewards) + (reward_format_to_use['monthly'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['monthly'] * litres).toFixed(2);

                            //get current day
                            date = new Date();
                            start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            
                            $('#sales-rewards-awarded').text(rewards_awarded);
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(rewards_awarded)

                        }
                        else
                        {    

                           let customer_rewards = localStorage.getItem('cutomer_rewards');

                           //calculate difference in employs sale dates
                           db_end_date = new Date(localStorage.getItem('db_end_date')).getTime();
                           db_start_date = new Date(localStorage.getItem('db_start_date')).getTime();
                           datediff = Math.ceil((db_end_date - db_start_date)/(1000 * 60 * 60 * 24));

                           if(datediff >= 30)
                           {

                                let customer_rewards = localStorage.getItem('cutomer_rewards');

                                 //calculate amount payable with the rewards set only when the reward option is enabled
                                let amount_to_pay = total_amount - rewards;
                                $('#amount_payable').val(amount_to_pay);
                                rewards_used = rewards;

                                console.log(customer_rewards);


                                //bulk rewards
                                new_cutomer_rewards = (parseInt(customer_rewards) - rewards) + (reward_format_to_use['monthly'] * litres);
                                $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                                new_cutomer_rewards.toFixed(2);
                                rewards_awarded = (reward_format_to_use['monthly'] * litres).toFixed(2);

                                console.log(rewards_awarded);

                                date = new Date();
                                start_date = localStorage.getItem('db_start_date');
                                end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

                                $('#sales-rewards-awarded').text(rewards_awarded);
                                localStorage.setItem('sale_start_date',end_date);
                                localStorage.setItem('sale_end_date',end_date);
                                console.log(rewards_awarded)

                           }
                           else
                           {
                            
                                swal("Error!", "You are not eligble to use rewards, you must complete one month!", "error")

                                let customer_rewards = localStorage.getItem('cutomer_rewards');

                                //calculate amount payable with the rewards set only when the reward option is enabled
                                let rewards = 0;
                                let amount_to_pay = total_amount - rewards;
                                $('#amount_payable').val(amount_to_pay);
                                $('#rewards').val(0);
                                rewards_used = rewards;

                                console.log(customer_rewards);

                                //bulk rewards
                                new_cutomer_rewards = (parseInt(customer_rewards) - rewards) + (reward_format_to_use['monthly'] * litres);
                                $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                                new_cutomer_rewards.toFixed(2);
                                rewards_awarded = (reward_format_to_use['monthly'] * litres);

                                console.log(customer_rewards);


                                date = new Date();
                                start_date = localStorage.getItem('db_start_date');
                                end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();

                                $('#sales-rewards-awarded').text(rewards_awarded);
                                localStorage.setItem('sale_start_date',start_date);
                                localStorage.setItem('sale_end_date',end_date);
                                console.log(rewards_awarded)

                          
                            }
                           
                        }
                        

                    }
           
                     
                     localStorage.setItem('new_cutomer_rewards',new_cutomer_rewards);
                     localStorage.setItem('used_rewards',rewards);
                     localStorage.setItem('rewards_awarded',rewards_awarded);


                }

                
            }
            else
            {
                
                    if('bulk' in reward_format_to_use)
                    {
                        if(firstsale == true)
                        {

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (0 + reward_format_to_use['bulk'] * litres);
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = 0;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - 0;
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['bulk'] * litres).toFixed(2);

                            //get current day
                            date = new Date();
                            start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                           
                            $('#sales-rewards-awarded').text(rewards_awarded);
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(rewards_awarded)

                        }
                        else
                        {
                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            let amount_to_pay = total_amount - (0 + reward_format_to_use['bulk'] * litres);
                            $('#amount_payable').val(amount_to_pay);
                            rewards_used = 0;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) - 0;
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['bulk'] * litres);

                           
                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                           
                            $('#sales-rewards-awarded').text(rewards_awarded);
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);


                        }


                    }
                    else if('credit' in reward_format_to_use)
                    {

                        console.log(reward_format_to_use);
                        if(firstsale == true)
                        {

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            // let amount_to_pay = total_amount - (0 + reward_format_to_use['credit'] * litres);
                            $('#amount_payable').val(total_amount);


                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) + (reward_format_to_use['credit'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['credit'] * litres).toFixed(2);

                            //get current day
                            date = new Date();
                            start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                           
                            $('#sales-rewards-awarded').text(rewards_awarded);
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(rewards_awarded);
                            console.log(sale_start_date);
                            console.log(sale_end_date);

                        }
                        else
                        {
                            let customer_rewards = localStorage.getItem('cutomer_rewards');
                            console.log(total_amount);
                            console.log(litres);
                            console.log(reward_format_to_use['credit']);



                            //calculate amount payable with the rewards set only when the reward option is enabled
                            // let amount_to_pay = total_amount - (0 + reward_format_to_use['credit'] * litres);
                            console.log(total_amount);

                            $('#amount_payable').val(total_amount);
                            rewards_used = 0;

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) + (reward_format_to_use['credit'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['credit'] * litres);
                            console.log(rewards_awarded);
                           
                            $('#sales-rewards-awarded').text(rewards_awarded);

                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(start_date);
                            console.log(end_date);
                            console.log(rewards_awarded);


                        }


                    }
                    else if('prepaid' in reward_format_to_use)
                    {
                        if(firstsale == true)
                        {

                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            // let amount_to_pay = total_amount - (0 + reward_format_to_use['prepaid'] * litres);
                            $('#amount_payable').val(total_amount);
                            rewards_used = 0;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) +  (reward_format_to_use['prepaid'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['prepaid'] * litres).toFixed(2);

                            //get current day
                            date = new Date();
                            start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                           
                            $('#sales-rewards-awarded').text(rewards_awarded);
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);
                            console.log(rewards_awarded)

                        }
                        else
                        {
                            let customer_rewards = localStorage.getItem('cutomer_rewards');

                            //calculate amount payable with the rewards set only when the reward option is enabled
                            // let amount_to_pay = total_amount - (0 + reward_format_to_use['prepaid'] * litres);
                            $('#amount_payable').val(total_amount);
                            rewards_used = 0;

                            console.log(customer_rewards);

                            //bulk rewards
                            new_cutomer_rewards = parseInt(customer_rewards) + (reward_format_to_use['prepaid'] * litres);
                            $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                            new_cutomer_rewards.toFixed(2);
                            rewards_awarded = (reward_format_to_use['prepaid'] * litres);

                            console.log(rewards_awarded)

                            $('#sales-rewards-awarded').text(rewards_awarded);
                            date = new Date();
                            start_date = localStorage.getItem('db_start_date');
                            end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                            localStorage.setItem('sale_start_date',start_date);
                            localStorage.setItem('sale_end_date',end_date);


                        }


                    }
                    else
                    {  

                        if('monthly' in reward_format_to_use)
                        {
                            if(firstsale == true){

                                let customer_rewards = localStorage.getItem('cutomer_rewards');

                                //calculate amount payable with the rewards set only when the reward option is enabled
                                let amount_to_pay = total_amount - 0;
                                $('#amount_payable').val(amount_to_pay);
                                rewards_used = 0;
        
                                console.log(customer_rewards);
        
                                //bulk rewards
                                new_cutomer_rewards = (parseInt(customer_rewards) - 0) + (reward_format_to_use['monthly'] * litres);
                                $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                                new_cutomer_rewards.toFixed(2);
                                rewards_awarded =(reward_format_to_use['monthly']*litres).toFixed(2);
        
        
                                 //get current day
                                 date = new Date();
                                 start_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                                 end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                               
                                 $('#sales-rewards-awarded').text(rewards_awarded);
                                 localStorage.setItem('sale_start_date',start_date);
                                 localStorage.setItem('sale_end_date',end_date);
        
                               }
                               else
                               {

                                rewards = 0;

                                let customer_rewards = localStorage.getItem('cutomer_rewards');
        
                                //calculate amount payable with the rewards set only when the reward option is enabled
                                let amount_to_pay = total_amount - 0;
                                $('#amount_payable').val(amount_to_pay);
                                rewards_used = rewards;
        
                                console.log(customer_rewards);
        
                                //bulk rewards
                                new_cutomer_rewards = (parseInt(customer_rewards) - rewards) + (reward_format_to_use['monthly'] * litres);
                                $('#sales-reward-balance').text(new_cutomer_rewards.toFixed(2));
                                new_cutomer_rewards.toFixed(2);
                                rewards_awarded = (reward_format_to_use['monthly'] * litres).toFixed(2);
        
                                //get current day
                                date = new Date();
                                start_date = localStorage.getItem('db_start_date');
                                end_date = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
                                
                                $('#sales-rewards-awarded').text(rewards_awarded);
                                localStorage.setItem('sale_start_date',start_date);
                                localStorage.setItem('sale_end_date',end_date);
        
        
                               }
        
                        }
                        

                      

                    }
           
                     
                     $('#sales-rewards-awarded').text(rewards_awarded);
                     localStorage.setItem('new_cutomer_rewards',new_cutomer_rewards);
                     localStorage.setItem('used_rewards',rewards_used);
                     localStorage.setItem('rewards_awarded',rewards_awarded);



            }
                
               
            },
            error: function(data){
                   
                console.log(data);

             }
           })

        }
        
    });


    //calculate litres if product changes
    $('#product').on('change',function(){

        total_amount = parseFloat($("#total_amount").val());

        if(!(total_amount == ''))
        {
            product_amount = parseFloat($('#product').val());
            total_amount = parseFloat($("#total_amount").val());
            total_amount_ltr = parseFloat( total_amount / product_amount);
            $("#liters_val").val(total_amount_ltr.toFixed(2));
        }
        else
        {
            return;
        }

    });


     //display an alert message redirect user back to choose-option page 
     $("#completed").on('click',function(){


        $('html, body').animate({
            scrollTop: $("#progress").offset().top
        }, 500);
        
        $('#progress').css('display','');

        const selectedFile = document.getElementById('image').files[0];
        const pumpFile = document.getElementById('pump_image').files[0];
        const receiptFile = document.getElementById('receipt_image').files[0];


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
        const sale_start_date = localStorage.getItem('sale_start_date');
        const sale_end_date = localStorage.getItem('sale_end_date');
        const sold_by = $('#sales-person-name').text();




        formData = new FormData();
        formData.append('vehicle_image',selectedFile);
        formData.append('pump_image',pumpFile);
        formData.append('receipt_image',receiptFile);
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
        formData.append('sale_start_date',sale_start_date);
        formData.append('sale_end_date',sale_end_date);
        formData.append('sold_by',sold_by);


        console.log(sold_by);
        console.log(sale_start_date);
        console.log(sale_end_date);



        console.log(vehicle_registration);

        $.ajax({
            type:'post',
            url: "/send-sales-sms",
            data: formData,
            processData: false,
            contentType: false,
            success: (data) => {

                $('#progress').css('display','none');
                console.log(data);
                localStorage.clear();
                swal("Good job!", "Sale completed successfully, A confirmation message was sent!", "success")
                .then(() => {
                    location.href = "/choose-option";
                });
            },
            error: function(data){

                $('#progress').css('display','none');
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


         //set vehicle image
         $('#image').on('change',function(){
           
            let reader = new FileReader();
        
            reader.onload = (e) => { 
        
              $('#vehicle_image').attr('src', e.target.result); 

            }
        
            reader.readAsDataURL(this.files[0]); 
          
           });


        //set pump image
         $('#pump_image').on('change',function(){
           
            let reader = new FileReader();
        
            reader.onload = (e) => { 
        
              $('#vehicle_pump_image').attr('src', e.target.result); 

            }
        
            reader.readAsDataURL(this.files[0]); 
          
           });

           //set pump image
         $('#receipt_image').on('change',function(){
           
            let reader = new FileReader();
        
            reader.onload = (e) => { 
        
              $('#vehicle_receipt_image').attr('src', e.target.result); 

            }
        
            reader.readAsDataURL(this.files[0]); 
          
           });

        
});
