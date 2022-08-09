<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="staff/assets/img/apple-icon.png">
    <link rel="icon"  href="front-end/images/logo.jpg">
    <title>
        Staff Dashboard
    </title>
    <base href="{{ URL::to('/') }}">

    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="staff/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="staff/assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="staff/assets/css/toggleswitch.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="staff/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="staff/assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="staff/assets/js/main.js"></script>

    <style>
        .dataTables_wrapper{
            margin-left:20px;
            margin-right:20px;
        }
        th::after, th::before{
            color:black;
            font-weight:bold;
            font-size:20px;
            border:1px solid black;
        }
    </style>


</head>

<body class="g-sidenav-show  bg-gray-100">
    @include('staff.layouts.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        @yield('content')

        <footer class="footer pt-3  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="#" class="font-weight-bold" target="_blank">Epren Petrol Station Limited</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        </div>
    </main>
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg ">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent"
                        onclick="sidebarType(this)">Transparent</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                </div>
                <div class="form-check form-switch ps-0">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                        onclick="navbarFixed(this)">
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn bg-gradient-dark w-100"
                    href="https://www.creative-tim.com/product/soft-ui-dashboard-pro">Free Download</a>
                <a class="btn btn-outline-dark w-100"
                    href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View
                    documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard"
                        data-icon="octicon-star" data-size="large" data-show-count="true"
                        aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard"
                        class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!-- reward modal -->
    <!-- Modal -->
    <div class="modal fade" id="reward" tabindex="-1" aria-labelledby="reward" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Authorize Fuel Purchase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-register" id="form-register" action="#" method="post">
                        <div class="form-holder form-holder-2">
                            <label for="card-type">Employee Name</label>
                            <select name="make" id="make" class="form-control">
                                <option value="" selected>Kevin Amayi</option>
                                <option value="Honda">Brian Otwane</option>
                                <option value="Mitsubishi">Donald Kaniaru</option>
                                <option value="Isuzu">Pius Musungu</option>
                                <option value="Ford">Joyce Ayaa</option>
                            </select>
                        </div>

                        <div class="form-holder form-holder-2 mt-4">
                            <label for="card-type">Vehicle Reg</label>
                            <select name="make" id="make" class="form-control">
                                <option value="" selected>KAG 334</option>
                                <option value="Honda">KAR 445</option>
                                <option value="Mitsubishi">KUV 447</option>
                                <option value="Isuzu">KIS 448</option>
                                <option value="Ford">KIT 376</option>
                            </select>
                        </div>

                        <div class="form-holder form-holder-2 mt-4 mb-4">
                            <label for="regno">Amount</label></br>
                            <input
                                style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                type="text" name="regnor" class="regno" id="regno" placeholder="33,000">
                        </div>

                        <div class="form-holder form-holder-2 mt-4 mb-4">
                            <label for="regno">Transaction/Receipt Number</label></br>
                            <input
                                style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; "
                                type="text" name="regnor" class="regno" id="regno" placeholder="Q23431SFR">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Authorize Purchase</button>
                </div>
            </div>
        </div>
    </div>



    <!--   Core JS Files   -->
    <script src="/front-end/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="staff/assets/js/core/popper.min.js"></script>
    <script src="staff/assets/js/core/bootstrap.min.js"></script>
    <script src="staff/assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="staff/assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="staff/assets/js/plugins/chartjs.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="staff/assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
    <script>

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        //show another contact person information
        $('#add_another_contact_peson').on('click',function(){
            $("#another_contact_person_name_div").css("display","");
            $("#another_contact_person_email_div").css("display","");
            $("#another_contact_person_phone_div").css("display","");
            $("#another_contact_person_alternative_phone_div").css("display","");
        });

        //jQuery listen for checkbox change
        $("#rewards_checkbox").change(function() {
            if(this.checked) {

               status = "enabled";
               formData = new FormData();
               formData.append('status',status);

               $.ajax({
               type:'post',
               url: "set-status",
               data: formData,
               processData: false,
               contentType: false,
               success: (data) => {

                     swal("Good job!", "You have enabled using reward", "success");


               },
               error: function(data){
                
                    swal("Error!", "There was an error while performing the operstion", "error");
                
                }
                });

            }else{

               status = "disabled";
               formData = new FormData();
               formData.append('status',status);
                
                $.ajax({
                type:'post',
                url: "/set-status",
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {

                    swal("Good job!", "You have disabled using reward", "success");

                },
                error: function(data){
            
                    swal("Error!", "There was an error while performing the operstion", "error");

                    
                    }
                });

            }
        });

        $('.editstaff').on('click',function(){

            const id = parseInt($(this).attr("id"));
            $("#staffid").val(id)

            formData = new FormData();
            formData.append('id',id);
            
            $('#edit-staff').modal('show');

            $.ajax({
                type:'post',
                url: "/get-staff-data/"+id,
                data: formData,
                processData: false,
                contentType: false,
                success: (data) => {

                    //get sale data and show in a model
                    staff_data = data.user_data;

                    console.log(data);

                    $("#staffname").val(staff_data[0].name);
                    $("#staffemail").val(staff_data[0].email);
                },
                error: function(data){
                    
                      console.log(data);
                                       
                    }
                });



        });

        //when the reward button is clicked
        $('#rewardpass').on('click',function(event){
            event.preventDefault()
            reward_percentage = $('#reward_percentage').val()

            formData = new FormData();
            formData.append('reward_percentage',reward_percentage);

            $.ajax({
               type:'post',
               url: "set-reward",
               data: formData,
               processData: false,
               contentType: false,
               success: (data) => {

                    swal("Good job!", "Reward percentage set successfully", "success").then(() => {
                          location.reload()
                        });
               },
               error: function(data){
                
                    swal("Error!", "Setting Reward percentage failed", "error").then(() => {
                        location.reload();
                    });

                   }

                });

        });


        //get specific sales data 
        $(".moresalesdetails").on('click',function(){
        
            const id = parseInt($(this).attr("id"));

            console.log(id);

            $.ajax({
                type:'get',
                url: "/get-sale-data/"+id,
                success: (data) => {

                    //get sale data and show in a model
                    sale_data = data.sale_data;
                    console.log(sale_data);

                    $("#firstname").text(sale_data[0].first_name);
                    $("#lastname").text(sale_data[0].last_name);
                    $("#phonenumber").text(sale_data[0].phone_number);
                    $("#vehiclereg").text(sale_data[0].vehicle_registration);
                    $("#product").text(sale_data[0].product);
                    $("#rewards").text(sale_data[0].rewards_used);
                    $("#amountpayable").text(sale_data[0].amount_payable);
                    $("#amountpaid").text(sale_data[0].amount_paid);
                    $("#date").text(sale_data[0].created_at);
                    $('#vehicle_image').attr('src',`images/${sale_data[0].image_url}`); 
                    $('#pump_image').attr('src',`images/${sale_data[0].pump_image_url}`); 
                    $('#receipt_image').attr('src',`images/${sale_data[0].receipt_image_url}`); 
                    $('#sales-details').modal('show');


                },
                error: function(data){
                    
                      console.log(data);
                                       
                    }
                });

         

        });


     //get specific sales data 
     $(".morecustomerdetails").on('click',function(){
        
        const id = parseInt($(this).attr('id'));

        console.log(id);

        $.ajax({
            type:'get',
            url: "/get-customer-data/"+id,
            success: (data) => {

                console.log(data); 

                // get sale data and show in a model
                customer_data = data.customer_data;

                $("#firstname").text(customer_data[0].first_name);
                $("#lastname").text(customer_data[0].last_name);
                $("#phonenumber").text(customer_data[0].phone_number);
                $("#idnumber").text(customer_data[0].id_number);
                $("#email").text(customer_data[0].email);
                $("#rewards").text(customer_data[0].rewards);
                $("#gender").text(customer_data[0].gender);
                $('#customer-details').modal('show');

            },
            error: function(data){
                
                  console.log(data);
                                   
                }
            });

     

    });


    

    //edit customer details for editing
     $(".editcustomerbtn").on('click',function(){
        
        const id = parseInt($(this).attr('id'));
        $("#customerid").val(id);

        console.log(id);

        $.ajax({
            type:'get',
            url: "/get-customer-data/"+id,
            success: (data) => {

                console.log(data); 

                // get sale data and show in a model
                customer_data = data.customer_data;

                $("#first_name").val(customer_data[0].first_name);
                $("#last_name").val(customer_data[0].last_name);
                $("#phone_number").val(customer_data[0].phone_number);
                $("#id_number").val(customer_data[0].id_number);
                $("#edit_email").val(customer_data[0].email);
                $("#edit_rewards").val(customer_data[0].rewards);
                $("#edit_gender").val(customer_data[0].gender);
                $('#edit-customer-modal').modal('show');

            },
            error: function(data){
                
                  console.log(data);
                                   
                }
            });

    });


    //send edit customer details for editing
    $("#getcustomerdatabtn").on('click',function(){

        const id = $("#customerid").val();

        formData = new FormData
        const first_name = $("#first_name").val()
        const last_name = $("#last_name").val();
        const phone_number = $("#phone_number").val()
        const id_number = $("#id_number").val()
        const email = $("#edit_email").val()
        const rewards = $("#edit_rewards").val()
        const gender = $("#edit_gender").val()

        formData.append('first_name',first_name);
        formData.append('last_name',last_name);
        formData.append('phone_number',phone_number);
        formData.append('id_number',id_number);
        formData.append('email',email);
        formData.append('rewards',rewards);
        formData.append('gender',gender);
        formData.append('id',id);

        $.ajax({
            type:'post',
            url: "/edit-customer/"+id,
            data:formData,
            processData: false,
            contentType: false,
            success: (data) => {

                $('#edit-customer-modal').modal('hide');
                swal("Good job!", "Customer details edited successfully", "success").then(() => {
                          location.reload()
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


    //edit staff data
    $("#editstaffbtn").on('click',function(){

        const id = $("#staffid").val();

        formData = new FormData
        const name = $("#staffname").val()
        const email = $("#staffemail").val()
        const major_role =  $("#major_role").val() 
      
        formData.append('id',id);
        formData.append('name',name);
        formData.append('email',email);
        formData.append('major_role',major_role);

        $.ajax({
            type:'post',
            url: "/edit-staff/"+id,
            data:formData,
            processData: false,
            contentType: false,
            success: (data) => {

                $('#edit-staff').modal('hide');
                swal("Good job!", "Staff details edited successfully", "success").then(() => {
                        // location.reload()
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

    
    //edit products
    $(".editproductbtn").on('click',function(){

        const id = parseInt($(this).attr('id'));
        
        $.ajax({
            type:'get',
            url: "/get-product/"+id,
            success: (data) => {

                $('#product_cost').val(data.product[0].cost)
                $('#month').val(data.product[0].price_period.split(" ")[0])
                $('#product_year').val(data.product[0].price_period.split(" ")[1])
    

                console.log(data);
                $("#edit-product").modal('show');
                $("#product_id").val(id);

            },
            error: function(data){

                console.log(data);
                                
                }
            });

       
    });


    //edit monthly rewards
    $(".editmonthlyrewardbtn").on('click',function(){

        const id = parseInt($(this).attr('id'));

        $.ajax({
            type:'get',
            url: "/get-reward-format/"+id,
            success: (data) => {

                $('.lower_range').val(data.rewardformat[0].low)
                $('.higher_range').val(data.rewardformat[0].high)
                $('.reward_per_litre').val(data.rewardformat[0].shillings_per_litre)
                $('.monthly').val(data.rewardformat[0].price_period.split(" ")[0])
                $('.reward_year').val(data.rewardformat[0].price_period.split(" ")[1])
                $("#edit-monthly-reward").modal('show');
                $("#monthly_reward_id").val(id);

            },
            error: function(data){

                console.log(data);

                                
                }
            });

        

    });

    //edit bulk rewards
    $(".editbulkrewardbtn").on('click',function(){
         const id = parseInt($(this).attr('id'));

         $.ajax({
            type:'get',
            url: "/get-reward-format/"+id,
            success: (data) => {

                $('.lower_range').val(data.rewardformat[0].low)
                $('.higher_range').val(data.rewardformat[0].high)
                $('.reward_per_litre').val(data.rewardformat[0].shillings_per_litre)
                $('.monthly').val(data.rewardformat[0].price_period.split(" ")[0])
                $('.reward_year').val(data.rewardformat[0].price_period.split(" ")[1])
                $("#edit-bulk-reward").modal('show');
                $("#bulk_reward_id").val(id);

            },
            error: function(data){

                console.log(data);
                                
                }
            });

         $("#edit-bulk-reward").modal('show');
         $("#bulk_reward_id").val(id);
    });

    //show corporate management model
    $('.managecorporatebtn').on('click',function(){

            corporate_id = $(this).attr("id");
            account_type = $(this).attr("account_type");
            account_name = $(this).attr("account_name");
            account_balance = $(this).attr("account_balance");
            account_number = $(this).attr("account_number");

            console.log(account_name);

            $('.corporate_main_id').val(corporate_id);
            $('.corporate_account_type').val(account_type);
            $('.corporate_main_id').val(corporate_id);
            $('.acc_name_disp').text(account_name);
            $('.acc_name_type').text(account_type);
            $('.acc_no_disp').text(account_number);
            $('.acc_bal_type').text(account_balance);
            $('.acc_number').text(account_number);
            $('.limit_label').text(account_type.charAt(0).toUpperCase()+account_type.substring(1)+" Limit");
            $('.acc_number').val(account_number);
            $('#manage-corporate').modal('show');



            
    });

    //show purchase/payment model
    $('.show_purchase_payment_btn').on('click',function(){

        corporate_id = $(this).attr("org_id");
        account_type = $(this).attr("account_type");
        account_name = $(this).attr("account_name");
        account_balance = $(this).attr("account_balance");
        account_number = $(this).attr("account_number");

        $('.corporate_main_id').val(corporate_id);
        $('.corporate_account_type').val(account_type);
        $('.acc_name_disp').text(account_name);
        $('.acc_name_type').text(account_type);
        $('.acc_no_disp').text(account_number);
        $('.acc_bal_type').text(account_balance);
        $('#make-payment-model').modal('show');


    });


     //set vehicle image
     $('#company_logo_image').on('change',function(){
           
		   let reader = new FileReader();
	   
		   reader.onload = (e) => { 
	   
			 $('#company_logo').attr('src', e.target.result); 

		   }
	   
		   reader.readAsDataURL(this.files[0]); 
		 
		  });


    //retain the reward status when loading the page
    (function(){
            $.ajax({
            type:'get',
            url: "get-status",
            success: (data) => {

                    
                if(data.reward[0].status == 'enabled')
                {

                    $('#rewards_checkbox').prop('checked',true);
                }
                else
                {

                    $('#rewards_checkbox').prop('checked',false);


                }


            },
            error: function(data){
                
                    console.log(data);
                                    
                }
                });
    })();


    //function for authorizing purchase from admin portal
    $('#authorize_purchase_btn').on('click',function(){
        $('#authorize_purchase').modal('show');

        //get corporate users
        $.ajax({
            type:'get',
            url: "/get-corporate-users",
            success: (data) => {

                console.log(data)

                //get company data data and show in a model
                corporates = data.corporates;

                corporates.forEach(corporate => {
                        $('#companies_id').append(
                        `<option value="${corporate.id}" selected>${corporate.name}</option>`
                        )
                });

                $('#companies_id').append(
                        `<option value="" selected>Select...</option>`
                )
                    

            },
            error: function(data){
                     
            }
         });

    });

    $('#companies_id').on('change',function(){
       
       id = $('#companies_id').val();

       //clear the employee and vehicle option on changing the corporate option
       $('#employees').find('option').remove().end()
       $('#vehicles').find('option').remove().end()

       formData = new FormData();
       formData.append('id',id);
            //get corporate data
            $.ajax({
            type:'post',
            data:formData,
            processData: false,
            contentType: false,
            url: "/get-corporate-data",
            success: (data) => {

                    //get sale data and show in a model
                    vehicles = data.vehicles;
                    employees = data.employees;

                   employees.forEach(employee => {
                        $('#employees').append(
                        `<option value="${employee.id}" selected>${employee.first_name}  ${employee.last_name} - ID: ${employee.id_number} </option>`
                        )
                      });

                      vehicles.forEach(vehicle => {
                        $('#vehicles').append(
                        `<option value="${vehicle.id}" selected>${vehicle.vehicle_type}  ${vehicle.vehicle_registration}</option>`
                        )
                      });

                console.log(vehicles);
                console.log(employees);

                    
            },
            error: function(data){
                     
            }
         });
    });


    $('.customerstatusbtn').on('click',function(){

        customer_id = $(this).attr("customer_id");
        $('#enrollment_customerid').val(customer_id);
        $('#enrollment-status-modal').modal('show');

    });


    $('.salestatusbtn').on('click',function(){

         sale_id = $(this).attr("sale_id");
         console.log(sale_id);
        $('#salestatus_id').val(sale_id);
        $('#sale-status-modal').modal('show');

    });

    //datatable
    $('#dashboard_authorization_table').DataTable();
    $('#dashboard_sales_table').DataTable();
    $('#dashboard_customer_table').DataTable();
    $('#customer_table').DataTable();
    $('#sales_table').DataTable();
    $('#corporates_table').DataTable();
    $('#staff_table').DataTable();
    $('#authrorized_purchases_table').DataTable();


    $('.view-organizational-detail-link').on('click',function(){
       
        id = $(this).attr('id');
        formData = new FormData();
        formData.append('id',id);

            //get corporate data
            $.ajax({
            type:'post',
            data:formData,
            processData: false,
            contentType: false,
            url: "/get-organization-data",
            success: (data) => {

                    //get sale data and show in a model
                    corporate = data.corporate[0];
                    console.log(corporate);
                    $('#organization-details-modal').modal('show');
                    $('#orgname').text(corporate.name);
                    $('#orgemail').text(corporate.email);
                    $('#orgphonenumber').text(corporate.phone_number);
                    $('#orgaddress').text(corporate.country+'  '+corporate.town+'  '+corporate.address);
                    $('#orgkrapin').text(corporate.krapin);
                    $('#orgcontactperson1').text(corporate.contact_person_name+'   '+corporate.contact_person_email+'   '+corporate.contact_person_phone);
                    $('#orgcontactperson2').text(corporate.another_contact_person_name+'  '+corporate.another_contact_person_email+'   '+corporate.another_contact_person_phone);    

                   
            },
            error: function(data){
                     
            }
         });

    });
    
    </script>

    

</body>

</html>
