<?php

namespace App\Http\Controllers;

use App\Jobs\UploadCustomersJob;
use App\Models\CustomerReward;
use App\Models\Discount;
use App\Models\Organization;
use App\Models\OrganizationReward;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Mail;
use Image;
use Config;
use Exception;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\Vehicle;
use Twilio\Rest\Client;
use App\Models\Customer;
use App\Models\Account;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\AutomaticDiscount;
use App\Models\AuthorizedPurchase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CustomerController extends Controller
{

    public function updateSalesType(){
        $automaticdiscounts = AutomaticDiscount::all();
        $discounts = Discount::all();

        foreach ($automaticdiscounts as $automaticdiscount){
            Sale::where('phone_number',$automaticdiscount->customer_phone)
                ->where('rewards_awarded',$automaticdiscount->discount)->update([
                    'sales_type' => 'bulk'
                ]);
        }

        foreach ($discounts as $discount){
            Sale::where('amount_payable',$discount->amount)->update([
                    'sales_type' => 'customer'
                ]);
        }
    }

    public function getReports()
    {
        $sales = Sale::latest()->get();
        return view('staff.reports',compact('sales'));
    }

    public function enrollNewCustomer()
    {
        $organizations = Organization::all();
        return view('enroll-customer', compact('organizations'));
    }


    // register corporate customer from staff dashboard
    public function registerCorporate(Request $request)
    {

        //validate new staff details
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phonenumber' => 'required',
            'address' => ['required', 'string', 'max:255'],
            'town' => ['required', 'string', 'max:255'],
            'krapin' => ['max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_person_name' => ['required', 'string', 'max:255'],
            'contact_person_email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_person_phone' => 'required',
            'country' => 'required'

        ]);

        //generate password for corporate user
        $password_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789#$%^&*()!~';
        $password = substr(str_shuffle($password_chars), 0, 15);
        $data = $request->all();

        //define a default account number
        $default_account_number = intval(substr(str_shuffle('0123456789'), 0, 7));

        //check if image is set and upload otherwise default to OLA logo
        if ($request->hasFile('company_logo_image')) {

            //upload company logo
            $companyLogo = "image-" . time() . '.' . $data['company_logo_image']->getClientOriginalExtension();
            $data['company_logo_image']->move(public_path('images'), $companyLogo);
        } else {

            // set default logo to OLA logo
            $companyLogo = 'logo.jpg';

        }

        $user = User::create([
            'name' => strtoupper($data['name']),
            'phone_number' => $data['phonenumber'],
            'address' => $data['address'],
            'town' => $data['town'],
            'krapin' => $data['krapin'],
            'alternative_phone_number' => $data['alternativephonenumber'],
            'email' => $data['email'],
            'password' => Hash::make($password),
            'role' => 'Corperate',
            'logo_url' => $companyLogo,
            'country' => $data['country'],
            'contact_person_name' => $data['contact_person_name'],
            'contact_person_email' => $data['contact_person_email'],
            'contact_person_phone' => $data['contact_person_phone'],
            'contact_person_alternative_phone' => $data['contact_person_alternative_phone'],
            'another_contact_person_name' => $data['another_contact_person_name'],
            'another_contact_person_email' => $data['another_contact_person_email'],
            'another_contact_person_phone' => $data['another_contact_person_phone'],
            'another_contact_person_alternative_phone' => $data['another_contact_person_alternative_phone'],
        ]);


        //create account depending on the corporate customer preference
        switch ($data['account_type']) {
            case "credit":
                Account::create([
                    'organization_id' => $user->id,
                    'account_number' => $default_account_number,
                    'account_limit' => 0,
                    'account_balance' => 0,
                    'limit_utilized' => 0,
                    'discount' => 0,
                    'account_type' => 'credit',
                    'corporate_status' => 'inactive'
                ]);
                break;
            case "prepaid":
                Account::create([
                    'organization_id' => $user->id,
                    'account_number' => $default_account_number,
                    'account_limit' => 0,
                    'account_balance' => 0,
                    'limit_utilized' => 0,
                    'discount' => 0,
                    'account_type' => 'prepaid',
                    'corporate_status' => 'inactive'
                ]);
                break;
            case "both":
                Account::create([
                    'organization_id' => $user->id,
                    'account_number' => $default_account_number,
                    'account_limit' => 0,
                    'account_balance' => 0,
                    'limit_utilized' => 0,
                    'discount' => 0,
                    'account_type' => 'credit',
                    'corporate_status' => 'inactive'
                ]);
                Account::create([
                    'organization_id' => $user->id,
                    'account_number' => $default_account_number,
                    'account_limit' => 0,
                    'account_balance' => 0,
                    'limit_utilized' => 0,
                    'discount' => 0,
                    'account_type' => 'prepaid',
                    'corporate_status' => 'inactive'

                ]);;
                break;
            default:
                echo "No account type chosen";
        }


        //data to use in email
        $email_data = array('corporate_name' => $data['name'], 'corporate_email' => $data['email'], 'corporate_password' => $password);

        try {

            //send the user a password once the account has been set successfully
            Mail::send('corporate_login_mail', $email_data, function ($message) use ($data) {
                $message->to($data['email'], $data['name'])->subject
                ("Loyalty Corporate Portal Login Details");
                $message->from('loyalty@datahatchworks.co.ke', 'Loyalty Reward System');
            });

            session()->flash('success', 'Coporate Added Successfully Login details was sent to the registration email');
            return redirect()->back();

        } catch (Exception $e) {

            session()->flash('success', 'There was an error while sending the login details');
            return redirect()->back();

        }


    }

    //get corporate company info
    public function getCompanyInfo()
    {
        $user = Auth::user()->id;
        $company = User::where('id', '=', $user)->get();
        return view('cooperate-customer.company-info')->with(['company' => $company]);

    }

    public function getRegisteredCorporates()
    {
        if (Auth::user()->major_role == 'Admin' || Auth::user()->major_role == 'Supervisor') {
            $corporates_accounts = Account::all();
            // $corporates = User::where('role','=','Corperate')->get();
            return view('staff.corporates')->with(['corporates_accounts' => $corporates_accounts]);
        } else {
            return redirect('/choose-option');
        }
    }

    public function getRegisteredCorporateDetails(Request $request)
    {

        $corporate = User::where('id', $request->id)->get();
        return response()->json([
            'corporate' => $corporate
        ]);

    }

    //generate sms token
    public function smsToken()
    {


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.emalify.com/v1/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "client_id" : "bebWKRRVZaPvCb4o3JSfqWmidlqxjOdo",
                "client_secret" : "WgLRBAKoBJ0fsXbYe1TMxqCGSN7mWg1mZ6mC5si3",
                "grant_type" : "client_credentials"
                    }',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json'
            ),
        ));
        $curl_response = curl_exec($curl);
        $access_token = json_decode($curl_response);

        curl_close($curl);
        return $access_token->access_token;
    }

    //send SMS using emalify
    public function sendSms($message, $phone_number)
    {
        $token = $this->smsToken();

        $url = "https://api.emalify.com/v1/projects/nvk85q40v8mjpdxz/sms/simple/send";
        $post_fields = array(
            'to' => [$phone_number],
            "message" => $message,
            "from" => "KCT_LTD"
        );
        $body = json_encode($post_fields);

        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_HEADER => false,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type:application/json',
                    'Authorization:Bearer ' . $token,
                ),
            )
        );

        $response = curl_exec($curl);
        Log::info($response);
        return $response;
    }


    public function sendSalesConfirmationSMS(Request $request)
    {

        $data = $request->all();
        $sales_type = $data['sales_type'];

        //get amount store in database
        $authorized_amount = Customer::where('id', '=', $data['customer_id'])->get()[0]->authorized_amount;
        $sales_status = 'pending';
        $amount_status_update = false;
        $new_amount = 0;

        if (!is_null($authorized_amount)) {

            if ($data['amount_payable'] < $authorized_amount) {
                //get customer purchase
                Customer::where('id', '=', $data['customer_id'])->update([
                    'rewards' => $data['new_customer_rewards'],
                    'sale_start_date' => Carbon::now()->format('Y-m-d'),
                    'sale_end_date' => Carbon::now()->format('Y-m-d'),
                    'purchase_status' => "complete",
                    'authorized_amount' => $authorized_amount - $data['amount_payable'],

                ]);

                $sales_status = 'complete';
                $amount_status_update = true;

            }

            if ($authorized_amount == 0) {
                //get customer purchase
                Customer::where('id', '=', $data['customer_id'])->update([
                    'rewards' => $data['new_customer_rewards'],
                    'sale_start_date' => Carbon::now()->format('Y-m-d'),
                    'sale_end_date' => Carbon::now()->format('Y-m-d'),
                    'purchase_status' => "complete",
                    'authorized_amount' => $data['amount_payable'],
                ]);

                $sales_status = 'complete';
                $amount_status_update = true;
                $new_amount = $data['amount_payable'];

            }

            if ($data['amount_payable'] == $authorized_amount) {
                //get customer purchase
                Customer::where('id', '=', $data['customer_id'])->update([
                    'rewards' => $data['new_customer_rewards'],
                    'sale_start_date' => Carbon::now()->format('Y-m-d'),
                    'sale_end_date' => Carbon::now()->format('Y-m-d'),
                    'purchase_status' => "complete",

                ]);

                $sales_status = 'complete';
                $amount_status_update = true;

            }

        } else {

            //get customer purchase
            Customer::where('id', '=', $data['customer_id'])->update([
                'rewards' => $data['new_customer_rewards'],
                'sale_start_date' => Carbon::now()->format('Y-m-d'),
                'sale_end_date' => Carbon::now()->format('Y-m-d'),
            ]);

        }


        //get the updated customer
        $customer = Customer::where('id', '=', $data['customer_id'])->get();

        if ($amount_status_update) {
            if ($new_amount > 0) {
                //update status for authorized purchases if the sale was completed for an employee
                AuthorizedPurchase::where('employee_id', '=', $customer[0]->id)
                    ->where('status', '=', 'pending')
                    ->update([
                        'status' => $sales_status,
                        'amount' => $new_amount,
                        'amount_sold' => $data['amount_payable'],
                        'sales_date' => date("d-m-y")
                    ]);
            } else {
                //update status for authorized purchases if the sale was completed for an employee
                AuthorizedPurchase::where('employee_id', '=', $customer[0]->id)
                    ->where('status', '=', 'pending')
                    ->update([
                        'status' => $sales_status,
                        'amount_sold' => $data['amount_payable'],
                        'sales_date' => date("d-m-y")
                    ]);
            }


        }


        // upload vehicle and image
        $vehicleImage = $request->vehicle_image;
        $vehicleImageName = "image-" . time() . '-' . $vehicleImage->getClientOriginalName();
        $destinationPath = public_path('/images');


        //compress image and store image if size is greater than 512KB
        $vehiclefileSize = $vehicleImage->getSize();    //get vehicle  size of image


        if (($vehiclefileSize < 512000)) {

            //store  images if they do not need compression
            $vehicleImage->move(public_path('images'), $vehicleImageName);

        } else {

            Log::info('Vehicle Image size in bytes --- ' . $vehiclefileSize);
            $vehicle_actual_image = Image::make($vehicleImage->getRealPath());
            $height = $vehicle_actual_image->height() / 4;        //get 1/4th of image height
            $width = $vehicle_actual_image->width() / 4;            //get 1/4th of image width
            $vehicle_actual_image->resize($width, $height)->save($destinationPath . '/' . $vehicleImageName);
        }


        //store sales details
        $sale = Sale::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'customer_type' => $data['customer_type'],
            'vehicle_registration' => $data['vehicle_registration'],
            'rewards_used' => $data['used_rewards'],
            'rewards_awarded' => $data['rewards_awarded'],
            'amount_payable' => $data['amount_payable'],
            'amount_paid' => $data['amount_paid'],
            'image_url' => $vehicleImageName,
            'pump' => $data['pump'],
            'pump_side' => $data['pump_side'],
            'receipt_image_url' => "receipt_image_url",
            'sold_by' => $data['sold_by'],
            'rewards_balance' => $data['new_customer_rewards'],
            'status' => "Pending",
            'approved_by' => Auth::user()->name,
            'reason' => "No reason",
            'product' => $data['product_text'],
            'organization_id' => $data['organization_id'],
            'litres_sold' => $data['litres_sold'],
            'bulk_rewards' => $data['bulk_rewards'] ? 0 : $data['bulk_rewards'],
            'sales_type' => $sales_type
        ]);


        //if the sales_type is defined as bulk
        if ($sales_type == 'bulk') {
            AutomaticDiscount::create([
                "customer_name" => $data['first_name'] . ' ' . $data['last_name'],
                "customer_phone" => $data['phone_number'],
                "product" => $data['product_text'],
                "litres_sold" => $data['litres_sold'],
                "discount" => $data['rewards_awarded'],
                "csa" => Auth::user()->name,
                "transaction_date" => Carbon::now()->format('Y-m-d H:i:m'),
                "sales_id" => $sale->id
            ]);
        }

        return response()->json([
            'data' => $request->all(),
        ]);

    }


    /**
     * add a new staff and staff dashboard.
     *
     * @return "view"
     */
    public function addNewStaff(Request $request)
    {

        //validate new staff details
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'major_role' => ['required', 'string', 'max:255'],
            'shift' => ['required', 'string', 'max:255']
        ]);

        $data = $request->all();


        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'Staff',
            'shift' => $data['shift'],
            'major_role' => ucfirst($data['major_role']),
            'phone_number' => '0719020100',
            'alternative_phone_number' => '0719020100',
            'address' => '00100',
            'town' => 'Nairobi',
            'krapin' => 'A010116927I',
            'logo_url' => 'IMG_URL',
            'contact_person_email' => $data['email']
        ]);


        session()->flash('success', 'Staff Added Successfully');
        return redirect()->back();


    }


    /**
     * add a new employee from cooperate dashboard
     *
     * @return "view"
     */
    public function addEmployee(Request $request)
    {

        //validate eployee enrollment details
        $request->validate([
            'employee_firstname' => ['required', 'string', 'max:255'],
            'employee_lastname' => ['required', 'string', 'max:255'],
            'employee_gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'phone_number' => 'required|regex:(^07)|digits:10|unique:customers'
        ]);

        $data = $request->all();


        //  create a new customer
        Customer::create([
            'first_name' => $data['employee_firstname'],
            'last_name' => $data['employee_lastname'],
            'gender' => $data['employee_gender'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'id_number' => $data['id_number'],
            'type' => Auth::user()->name,
            'enrolled_by' => Auth::user()->name,
            'status' => 'pending',
            'rewards' => 0
        ]);

        session()->flash('success', 'Employee Added Successfully');
        return redirect()->back();

    }


    /**
     * delete a staff.
     *
     * @return "view"
     */
    public function deleteStaff(User $user)
    {

        $user->delete();
        session()->flash('success', 'Staff Deleted Successfully');
        return redirect()->back();

    }

    /**
     * add a new staff and staff dashboard.
     *
     * @return "view"
     */
    public function showStaffs()
    {
        if (Auth::user()->major_role == 'Admin' || Auth::user()->major_role == 'Supervisor') {
            $staffs = User::where('role', '=', 'Staff')->get();
            return view('staff.users')->with(['staffs' => $staffs]);
        } else {
            return redirect('/choose-option');
        }
    }


    /**
     * add a new staff and staff dashboard.
     *
     * @return "view"
     */
    public function getCorporateUsers()
    {

        $corporates = User::where('role', 'Corperate')->get();
        return response()->json([
            'corporates' => $corporates
        ]);

    }

    /**
     * get corpoarate data.
     *
     * @return "view"
     */
    public function getCorporateUserData(Request $request)
    {
        $data = $request->all();
        $name = User::where('id', '=', $data['id'])->get()[0]['name'];
        $employees = Customer::where('type', '=', $name)->get();
        $vehicles = Vehicle::where('ownership', '=', $name)->get();
        return response()->json([
            'employees' => $employees,
            'vehicles' => $vehicles
        ]);

    }

    /**
     * get coorporate data for authorizing purchase
     *
     * @return "view"
     */
    public function getCoorporateData()
    {

        $user = Auth::user()->name;
        $employees = Customer::where('type', '=', $user)->get();
        $vehicles = Vehicle::where('ownership', '=', $user)->get();
        return response()->json([
            'employees' => $employees,
            'vehicles' => $vehicles
        ]);

    }


    /**
     * get coorporate employee data for editing
     *
     * @return "json"
     */
    public function getEmployeeData(Customer $customer)
    {

        $employee_data = Customer::where('id', '=', $customer->id)->get();

        return response()->json([

            'employee' => $employee_data
        ]);


    }


    /**
     * get corporate employee dashboard data
     *
     * @return view
     */
    public function getDashboardData(Customer $customer)
    {
        $user = Auth::user()->name;
        $employees = Customer::where('type', '=', $user)->take(20)->get();
        $vehicles = Vehicle::where('ownership', '=', $user)->take(20)->get();
        $autorizedpurchases = AuthorizedPurchase::where('name', '=', $user)->take(20)->get();
        $employees_authorized_data = array();
        $company = User::where('id', '=', $user)->get();
        $employees_count = Customer::where('type', '=', $user)->get();
        $vehicles_count = Vehicle::where('ownership', '=', $user)->get();
        $autorizedpurchases_count = AuthorizedPurchase::where('name', '=', $user)->get();


        foreach ($autorizedpurchases as $autorizedpurchase) {
            $customerid = $autorizedpurchase->employee_id;
            $vehicleid = $autorizedpurchase->vehicle_id;
            $personal_data = Customer::where('id', '=', $customerid)->get();
            $vehicle_data = Vehicle::where('id', '=', $vehicleid)->get();


            $employee = array();

            array_push($employee, $personal_data);
            array_push($employee, $vehicle_data);
            array_push($employee, $autorizedpurchase);
            array_push($employees_authorized_data, $employee);

        }

        return view('cooperate-customer.dashboard')->with([
            'employees' => $employees,
            'vehicles' => $vehicles,
            'authorized_purchases' => $employees_authorized_data,
            'company' => $company,
            'employees_count' => $employees_count,
            'vehicle_count' => $vehicles_count,
            'authorized_purchases_count' => $autorizedpurchases_count]);


    }


    /**
     * edit coorporate employee
     *
     * @return "view"
     */
    public function editEmployeeData(Request $request)
    {

        $data = $request->all();

        //validate eployee enrollment details
        $request->validate([
            'edit_first_name' => ['required', 'string', 'max:255'],
            'edit_last_name' => ['required', 'string', 'max:255'],
            'edit_gender' => ['required', 'string', 'max:255'],
            'edit_email' => ['required', 'string', 'email', 'max:255'],
            'edit_phone_number' => 'required|regex:(^07)|digits:10',
            'edit_id_number' => 'required|min:7|max:8',

        ]);

        //update employee data using id
        Customer::where('id', '=', $data['employee_edit_id'])->update([
            'first_name' => $data['edit_first_name'],
            'last_name' => $data['edit_last_name'],
            'gender' => $data['edit_gender'],
            'email' => $data['edit_email'],
            'phone_number' => $data['edit_phone_number'],
            'id_number' => $data['edit_id_number']

        ]);


        session()->flash('success', 'Employee Edited Successfully');
        return redirect()->back();

    }


    /**
     * authorize fuel purchase
     *
     *
     */
    public function authorizeFuelPurchase(Request $request)
    {

        $data = $request->all();
        $name = Auth::user()->name;

        if (!array_key_exists('jaza_tank', $data)) {
            if ($data['amount'] > 0) {
                //check if the employee/vehicle is authorized and the status is pending
                $alreadyAuthorizedVehicleandEmployees = AuthorizedPurchase::where(function ($query) use ($data) {
                    $query->where('employee_id', '=', $data['employees']);
                    $query->orWhere('vehicle_id', '=', $data['vehicles']);
                })
                    ->where('status', '=', 'pending')->get();


                // if the employee/vehicle is already authorized cancel authorization
                if (count($alreadyAuthorizedVehicleandEmployees) > 0) {
                    session()->flash('success', 'The employee or the vehicle is already authorized try again once the sale is completed');
                    return redirect()->back();
                } else {

                    //check payment type and compare amount
                    if ($data['payment_type'] == 'prepaid') {
                        //check if amount to prepaid account is furnished
                        $user = Auth::user()->id;
                        $account = Account::where('organization_id', '=', $user)
                            ->where('account_type', '=', 'prepaid')
                            ->get();

                        if (($account[0]->account_balance > $data['amount']) && ($account[0]->account_balance > 0)) {
                            //create authorized purchase record for an employee
                            AuthorizedPurchase::create([
                                'organization_id' => $user,
                                'employee_id' => $data['employees'],
                                'vehicle_id' => $data['vehicles'],
                                'amount' => $data['amount'],
                                'amount_sold' => 0,
                                'payment_type' => $data['payment_type'],
                                'status' => 'pending',
                                'name' => $name,
                                'organization_id' => $user,
                                'document_url' => 'no-document'

                            ]);

                            //update vehicle with customer id reward type and amount for the authorized purchase
                            Vehicle::where('id', '=', $data['vehicles'])->update([
                                'customer_id' => $data['employees'],
                            ]);


                            //update customer amount authorized and reward type to use
                            Customer::where('id', '=', $data['employees'])->update([
                                'authorized_amount' => $data['amount'],
                                'reward_type_to_use' => 'prepaid',
                                'purchase_status' => 'pending'
                            ]);


                            //update account balance for the corporate customer
                            $new_account_balance = $account[0]->account_balance - $data['amount'];

                            Account::where('organization_id', '=', $user)
                                ->where('account_type', '=', 'prepaid')
                                ->update([
                                    'account_balance' => $new_account_balance
                                ]);

                            session()->flash('success', 'Fuel Purchase Authorized Successfully');
                            return redirect()->back();

                        } else {

                            session()->flash('success', 'You do not have enough balance to authorize a purchase, Please recharge your account and try again');
                            return redirect()->back();

                        }

                    } else {

                        //check if amount to prepaid account is furnished
                        $user = Auth::user()->id;
                        $account = Account::where('organization_id', '=', $user)
                            ->where('account_type', '=', 'credit')
                            ->get();

                        //get the account balance as a positive value
                        $account_balance = abs($account[0]->account_balance);
                        if (($account_balance > $data['amount']) && ($account_balance > 0)) {
                            AuthorizedPurchase::create([
                                'employee_id' => $data['employees'],
                                'vehicle_id' => $data['vehicles'],
                                'amount' => $data['amount'],
                                'amount_sold' => 0,
                                'payment_type' => $data['payment_type'],
                                'status' => 'pending',
                                'name' => $name,
                                'organization_id' => $user,
                                'document_url' => 'no-document'

                            ]);

                            //update vehicle with customer id
                            Vehicle::where('id', '=', $data['vehicles'])->update([
                                'customer_id' => $data['employees']
                            ]);


                            //update customer amount authrized and reward type to use
                            Customer::where('id', '=', $data['employees'])->update([
                                'authorized_amount' => $data['amount'],
                                'reward_type_to_use' => 'credit',
                                'purchase_status' => 'pending'

                            ]);


                            $new_account_balance = -1 * (abs($account[0]->account_balance) - $data['amount']);

                            Account::where('organization_id', '=', $user)
                                ->where('account_type', '=', 'credit')
                                ->update([
                                    'account_balance' => $new_account_balance
                                ]);

                            session()->flash('success', 'Fuel Purchase Authorized Successfully');
                            return redirect()->back();

                        } else {

                            session()->flash('success', 'You do not have enough balance to authorize a purchase, Please recharge your account and try again');
                            return redirect()->back();

                        }


                    }


                }

            }

            if ($data['amount'] <= 0) {
                session()->flash('success', 'Kindly set appropriate amount');
                return redirect()->back();
            }
        } else {

            //check if the employee/vehicle is authorized and the status is pending
            $alreadyAuthorizedVehicleandEmployees = AuthorizedPurchase::where(function ($query) use ($data) {
                $query->where('employee_id', '=', $data['employees']);
                $query->orWhere('vehicle_id', '=', $data['vehicles']);
            })
                ->where('status', '=', 'pending')->get();


            // if the employee/vehicle is already authorized cancel authorization
            if (count($alreadyAuthorizedVehicleandEmployees) > 0) {
                session()->flash('success', 'The employee or the vehicle is already authorized try again once the sale is completed');
                return redirect()->back();
            } else {

                //check payment type and compare amount
                if ($data['payment_type'] == 'prepaid') {
                    //check if amount to prepaid account is furnished
                    $user = Auth::user()->id;
                    $account = Account::where('organization_id', '=', $user)
                        ->where('account_type', '=', 'prepaid')
                        ->get();

                    if (($account[0]->account_balance > $data['amount']) && ($account[0]->account_balance > 0)) {
                        //create authorized purchase record for an employee
                        AuthorizedPurchase::create([
                            'organization_id' => $user,
                            'employee_id' => $data['employees'],
                            'vehicle_id' => $data['vehicles'],
                            'amount' => $data['amount'],
                            'amount_sold' => 0,
                            'payment_type' => $data['payment_type'],
                            'status' => 'pending',
                            'name' => $name,
                            'organization_id' => $user,
                            'document_url' => 'no-document'

                        ]);

                        //update vehicle with customer id reward type and amount for the authorized purchase
                        Vehicle::where('id', '=', $data['vehicles'])->update([
                            'customer_id' => $data['employees'],
                        ]);


                        //update customer amount authorized and reward type to use
                        Customer::where('id', '=', $data['employees'])->update([
                            'authorized_amount' => $data['amount'],
                            'reward_type_to_use' => 'prepaid',
                            'purchase_status' => 'pending'
                        ]);


                        //update account balance for the corporate customer
                        $new_account_balance = $account[0]->account_balance - $data['amount'];

                        Account::where('organization_id', '=', $user)
                            ->where('account_type', '=', 'prepaid')
                            ->update([
                                'account_balance' => $new_account_balance
                            ]);

                        session()->flash('success', 'Fuel Purchase Authorized Successfully');
                        return redirect()->back();

                    } else {

                        session()->flash('success', 'You do not have enough balance to authorize a purchase, Please recharge your account and try again');
                        return redirect()->back();

                    }

                } else {

                    //check if amount to prepaid account is furnished
                    $user = Auth::user()->id;
                    $account = Account::where('organization_id', '=', $user)
                        ->where('account_type', '=', 'credit')
                        ->get();

                    //get the account balance as a positive value
                    $account_balance = abs($account[0]->account_balance);
                    if (($account_balance > $data['amount']) && ($account_balance > 0)) {
                        AuthorizedPurchase::create([
                            'employee_id' => $data['employees'],
                            'vehicle_id' => $data['vehicles'],
                            'amount' => $data['amount'],
                            'amount_sold' => 0,
                            'payment_type' => $data['payment_type'],
                            'status' => 'pending',
                            'name' => $name,
                            'organization_id' => $user,
                            'document_url' => 'no-document'

                        ]);

                        //update vehicle with customer id
                        Vehicle::where('id', '=', $data['vehicles'])->update([
                            'customer_id' => $data['employees']
                        ]);


                        //update customer amount authrized and reward type to use
                        Customer::where('id', '=', $data['employees'])->update([
                            'authorized_amount' => $data['amount'],
                            'reward_type_to_use' => 'credit',
                            'purchase_status' => 'pending'

                        ]);


                        $new_account_balance = -1 * (abs($account[0]->account_balance) - $data['amount']);

                        Account::where('organization_id', '=', $user)
                            ->where('account_type', '=', 'credit')
                            ->update([
                                'account_balance' => $new_account_balance
                            ]);

                        session()->flash('success', 'Fuel Purchase Authorized Successfully');
                        return redirect()->back();

                    } else {

                        session()->flash('success', 'You do not have enough balance to authorize a purchase, Please recharge your account and try again');
                        return redirect()->back();

                    }


                }


            }
        }


    }

    /**
     * authorize fuel purchase
     *
     *
     */
    public function staffAuthorizeFuelPurchase(Request $request)
    {

        $data = $request->all();
        $name = User::where('id', '=', $data['companies_id'])->get()[0]['name'];

        if (!array_key_exists('jaza_tank', $data)) {
            if ($data['amount'] > 0) {
                //check if the employee/vehicle is authorized and the status is pending
                $alreadyAuthorizedVehicleandEmployees = AuthorizedPurchase::where(function ($query) use ($data) {
                    $query->where('employee_id', '=', $data['employees']);
                    $query->orWhere('vehicle_id', '=', $data['vehicles']);
                })
                    ->where('status', '=', 'pending')->get();


                // if the employee/vehicle is already authorized cancel authorization
                if (count($alreadyAuthorizedVehicleandEmployees) > 0) {
                    session()->flash('success', 'The employee or the vehicle is already authorized try again once the sale is completed');
                    return redirect()->back();
                } else {

                    //check payment type and compare amount
                    if ($data['payment_type'] == 'prepaid') {
                        //check if amount to prepaid account is furnished
                        $account = Account::where('organization_id', '=', $data['companies_id'])
                            ->where('account_type', '=', 'prepaid')
                            ->get();

                        if (($account[0]->account_balance > $data['amount']) && ($account[0]->account_balance > 0)) {

                            $document_url = '';

                            //upload testimony image
                            if (($request->hasfile('authorize_purchase_document')) && ($request->authorize_purchase_document != null)) {

                                $document_url = $request->authorize_purchase_document->getClientOriginalName();
                                $request->authorize_purchase_document->move(public_path() . '/assets/authorize_purchases/', $document_url);

                            }

                            //create authorized purchase record for an employee
                            AuthorizedPurchase::create([
                                'organization_id' => $data['companies_id'],
                                'employee_id' => $data['employees'],
                                'vehicle_id' => $data['vehicles'],
                                'amount' => $data['amount'],
                                'amount_sold' => 0,
                                'payment_type' => $data['payment_type'],
                                'status' => 'pending',
                                'name' => $name,
                                'organization_id' => $data['companies_id'],
                                'document_url' => $document_url

                            ]);

                            //update vehicle with customer id reward type and amount for the authorized purchase
                            Vehicle::where('id', '=', $data['vehicles'])->update([
                                'customer_id' => $data['employees'],
                            ]);


                            //update customer amount authrized and reward type to use
                            Customer::where('id', '=', $data['employees'])->update([
                                'authorized_amount' => $data['amount'],
                                'reward_type_to_use' => 'prepaid',
                                'purchase_status' => 'pending'
                            ]);


                            //update account balance for the corporate customer
                            $new_account_balance = $account[0]->account_balance - $data['amount'];

                            Account::where('organization_id', '=', $data['companies_id'])
                                ->where('account_type', '=', 'prepaid')
                                ->update([
                                    'account_balance' => $new_account_balance
                                ]);

                            session()->flash('success', 'Fuel Purchase Authorized Successfully');
                            return redirect()->back();

                        } else {

                            session()->flash('success', 'There is no enough balance to authorize a purchase, Please recharge your account and try again');
                            return redirect()->back();

                        }

                    } else {

                        //check if amount to prepaid account is furnished
                        $user = $data['companies_id'];;
                        $account = Account::where('organization_id', '=', $data['companies_id'])
                            ->where('account_type', '=', 'credit')
                            ->get();

                        //get the account balance as a positive value
                        $account_balance = abs($account[0]->account_balance);

                        if (($account_balance > $data['amount']) && ($account_balance > 0)) {


                            $document_url = '';

                            //upload testimony image
                            if (($request->hasfile('authorize_purchase_document')) && ($request->authorize_purchase_document != null)) {

                                $document_url = $request->authorize_purchase_document->getClientOriginalName();
                                $request->authorize_purchase_document->move(public_path() . '/assets/authorize_purchases/', $document_url);

                            }

                            AuthorizedPurchase::create([
                                'employee_id' => $data['employees'],
                                'vehicle_id' => $data['vehicles'],
                                'amount' => $data['amount'],
                                'amount_sold' => 0,
                                'payment_type' => $data['payment_type'],
                                'status' => 'pending',
                                'name' => $name,
                                'organization_id' => $data['companies_id'],
                                'document_url' => $document_url


                            ]);

                            //update vehicle with customer id
                            Vehicle::where('id', '=', $data['vehicles'])->update([
                                'customer_id' => $data['employees']
                            ]);


                            //update customer amount authorized and reward type to use
                            Customer::where('id', '=', $data['employees'])->update([
                                'authorized_amount' => $data['amount'],
                                'reward_type_to_use' => 'credit',
                                'purchase_status' => 'pending'

                            ]);


                            $new_account_balance = -1 * (abs($account[0]->account_balance) - $data['amount']);

                            Account::where('organization_id', '=', $user)
                                ->where('account_type', '=', 'credit')
                                ->update([
                                    'account_balance' => $new_account_balance
                                ]);

                            session()->flash('success', 'Fuel Purchase Authorized Successfully');
                            return redirect()->back();

                        } else {

                            session()->flash('success', 'You do not have enough balance to authorize a purchase, Please recharge your account and try again');
                            return redirect()->back();

                        }


                    }


                }

            }

            if ($data['amount'] <= 0) {
                session()->flash('success', 'Kindly set appropriate amount');
                return redirect()->back();
            }
        } else {

            //check if the employee/vehicle is authorized and the status is pending
            $alreadyAuthorizedVehicleandEmployees = AuthorizedPurchase::where(function ($query) use ($data) {
                $query->where('employee_id', '=', $data['employees']);
                $query->orWhere('vehicle_id', '=', $data['vehicles']);
            })
                ->where('status', '=', 'pending')->get();

            // if the employee/vehicle is already authorized cancel authorization
            if (count($alreadyAuthorizedVehicleandEmployees) > 0) {
                session()->flash('success', 'The employee or the vehicle is already authorized try again once the sale is completed');
                return redirect()->back();
            } else {

                //check payment type and compare amount
                if ($data['payment_type'] == 'prepaid') {
                    //check if amount to prepaid account is furnished
                    $account = Account::where('organization_id', '=', $data['companies_id'])
                        ->where('account_type', '=', 'prepaid')
                        ->get();

                    if (($account[0]->account_balance > $data['amount']) && ($account[0]->account_balance > 0)) {

                        $document_url = '';

                        //upload testimony image
                        if (($request->hasfile('authorize_purchase_document')) && ($request->authorize_purchase_document != null)) {

                            $document_url = $request->authorize_purchase_document->getClientOriginalName();
                            $request->authorize_purchase_document->move(public_path() . '/assets/authorize_purchases/', $document_url);

                        }

                        //create authorized purchase record for an employee
                        AuthorizedPurchase::create([
                            'organization_id' => $data['companies_id'],
                            'employee_id' => $data['employees'],
                            'vehicle_id' => $data['vehicles'],
                            'amount' => $data['amount'],
                            'amount_sold' => 0,
                            'payment_type' => $data['payment_type'],
                            'status' => 'pending',
                            'name' => $name,
                            'organization_id' => $data['companies_id'],
                            'document_url' => $document_url

                        ]);

                        //update vehicle with customer id reward type and amount for the authorized purchase
                        Vehicle::where('id', '=', $data['vehicles'])->update([
                            'customer_id' => $data['employees'],
                        ]);


                        //update customer amount authrized and reward type to use
                        Customer::where('id', '=', $data['employees'])->update([
                            'authorized_amount' => $data['amount'],
                            'reward_type_to_use' => 'prepaid',
                            'purchase_status' => 'pending'
                        ]);


                        //update account balance for the corporate customer
                        $new_account_balance = $account[0]->account_balance - $data['amount'];

                        Account::where('organization_id', '=', $data['companies_id'])
                            ->where('account_type', '=', 'prepaid')
                            ->update([
                                'account_balance' => $new_account_balance
                            ]);

                        session()->flash('success', 'Fuel Purchase Authorized Successfully');
                        return redirect()->back();

                    } else {

                        session()->flash('success', 'There is no enough balance to authorize a purchase, Please recharge your account and try again');
                        return redirect()->back();

                    }

                } else {

                    //check if amount to prepaid account is furnished
                    $user = $data['companies_id'];;
                    $account = Account::where('organization_id', '=', $data['companies_id'])
                        ->where('account_type', '=', 'credit')
                        ->get();

                    //get the account balance as a positive value
                    $account_balance = abs($account[0]->account_balance);

                    if (($account_balance > $data['amount']) && ($account_balance > 0)) {


                        $document_url = '';

                        //upload testimony image
                        if (($request->hasfile('authorize_purchase_document')) && ($request->authorize_purchase_document != null)) {

                            $document_url = $request->authorize_purchase_document->getClientOriginalName();
                            $request->authorize_purchase_document->move(public_path() . '/assets/authorize_purchases/', $document_url);

                        }

                        AuthorizedPurchase::create([
                            'employee_id' => $data['employees'],
                            'vehicle_id' => $data['vehicles'],
                            'amount' => $data['amount'],
                            'amount_sold' => 0,
                            'payment_type' => $data['payment_type'],
                            'status' => 'pending',
                            'name' => $name,
                            'organization_id' => $data['companies_id'],
                            'document_url' => $document_url


                        ]);

                        //update vehicle with customer id
                        Vehicle::where('id', '=', $data['vehicles'])->update([
                            'customer_id' => $data['employees']
                        ]);


                        //update customer amount authorized and reward type to use
                        Customer::where('id', '=', $data['employees'])->update([
                            'authorized_amount' => $data['amount'],
                            'reward_type_to_use' => 'credit',
                            'purchase_status' => 'pending'

                        ]);


                        $new_account_balance = -1 * (abs($account[0]->account_balance) - $data['amount']);

                        Account::where('organization_id', '=', $user)
                            ->where('account_type', '=', 'credit')
                            ->update([
                                'account_balance' => $new_account_balance
                            ]);

                        session()->flash('success', 'Fuel Purchase Authorized Successfully');
                        return redirect()->back();

                    } else {

                        session()->flash('success', 'You do not have enough balance to authorize a purchase, Please recharge your account and try again');
                        return redirect()->back();

                    }


                }


            }

        }


    }


    /**
     * get authorized fuel purchases
     *
     *
     */
    public function getAuthorizedPurchases()
    {

        $name = Auth::user()->name;
        $id = Auth::user()->id;
        $account = Account::where('organization_id', '=', $id)->where('account_type', '=', 'credit')->get();

        if (count($account) < 1) {

            $account = Account::where('organization_id', '=', $id)->where('account_type', '=', 'prepaid')->get();

        }

        $status = $account[0]->corporate_status;

        if ($status == 'active') {
            $autorizedpurchases = AuthorizedPurchase::where('name', '=', $name)->get();
            $employees_authorized_data = array();

            foreach ($autorizedpurchases as $autorizedpurchase) {
                $customerid = $autorizedpurchase->employee_id;
                $vehicleid = $autorizedpurchase->vehicle_id;
                $personal_data = Customer::where('id', '=', $customerid)->get();
                $vehicle_data = Vehicle::where('id', '=', $vehicleid)->get();


                $employee = array();

                array_push($employee, $personal_data);
                array_push($employee, $vehicle_data);
                array_push($employee, $autorizedpurchase);
                array_push($employees_authorized_data, $employee);

            }

            return view('cooperate-customer.authorizepurchase')->with(['authorized_purchases' => $employees_authorized_data]);


        } else {
            return redirect()->back();

        }


    }


    /**
     * get authorized fuel purchases and show staff data
     *
     *
     */
    public function getAuthorizedPurchasesForStaff()
    {
        if (Auth::user()->major_role == 'Admin' || Auth::user()->major_role == 'Supervisor') {
            $autorizedpurchases = AuthorizedPurchase::all();
            $employees_authorized_data = array();

            foreach ($autorizedpurchases as $autorizedpurchase) {
                $customerid = $autorizedpurchase->employee_id;
                $vehicleid = $autorizedpurchase->vehicle_id;
                $personal_data = Customer::where('id', '=', $customerid)->get();
                $vehicle_data = Vehicle::where('id', '=', $vehicleid)->get();


                $employee = array();

                array_push($employee, $personal_data);
                array_push($employee, $vehicle_data);
                array_push($employee, $autorizedpurchase);
                array_push($employees_authorized_data, $employee);

            }

            return view('staff.authorized-purchases')->with(['authorized_purchases' => $employees_authorized_data]);


        } else {
            return redirect('/choose-option');
        }


    }


    /**
     * add another vehicle.
     *
     * @return "view"
     */
    public function addAnotherVehicle(Request $request)
    {
        $data = $request->all();

        //update customer vehicle image
        Vehicle::create([
            'customer_id' => $data['customer_id'],
            'vehicle_category' => $data['vehicle_category'],
            'vehicle_type' => $data['vehicle_type'],
            'fuel_type' => $data['fuel_type'],
            'vehicle_registration' => $data['vehicle_registration'],
        ]);

        $vehicles = Vehicle::where('id', '=', $data['customer_id'])->get();
        $customer = Customer::where('id', '=', $data['customer_id'])->get();

        return response()->json([
            'customer' => $customer,
            'vehicles' => $vehicles
        ]);


    }

    /**
     * get all coorporate customer employees.
     *
     * @return "view"
     */
    public function getEmployees()
    {

        $type = Auth::user()->name;
        $employees = Customer::where('type', '=', $type)->get();
        return view('cooperate-customer.employees')->with(['employees' => $employees]);

    }

    /**
     * get all dashboard data for the staff dashboard
     *
     * @return "view"
     */
    public function staffDashboard()
    {
        if (Auth::user()->major_role == 'Admin' || Auth::user()->major_role == 'Supervisor') {
            $customers = Customer::latest()->take(20)->get();;
            $sales = Sale::latest()->take(20)->get();;
            $autorizedpurchases = AuthorizedPurchase::latest()->take(20)->get();;
            $employees_authorized_data = array();

            foreach ($autorizedpurchases as $autorizedpurchase) {
                $customerid = $autorizedpurchase->employee_id;
                $vehicleid = $autorizedpurchase->vehicle_id;
                $personal_data = Customer::where('id', '=', $customerid)->get();
                $vehicle_data = Vehicle::where('id', '=', $vehicleid)->get();


                $employee = array();

                array_push($employee, $personal_data);
                array_push($employee, $vehicle_data);
                array_push($employee, $autorizedpurchase);
                array_push($employees_authorized_data, $employee);

            }

            return view('staff.dashboard')->with(['customers' => $customers, 'sales' => $sales, 'authorized_purchases' => $employees_authorized_data]);

        } else {
            return redirect('/choose-option');
        }
    }


    /**
     * delete an employee.
     *
     * @return "view"
     */
    public function deleteEmployees(Customer $customer)
    {

        //delete employee
        $customer->delete();

        //delete authorized purchases for the same employee
        AuthorizedPurchase::where('employee_id', '=', $customer->id)->delete();

        session()->flash('success', 'Employee Deleted Successfully');
        return redirect()->back();

    }


    /**
     * show customers.
     *
     * @return "view"
     */
    public function showCustomers()
    {
        if (Auth::user()->major_role == 'Admin' || Auth::user()->major_role == 'Supervisor') {

            $customers = Customer::all();
            return view('staff.customers')->with(['customers' => $customers]);

        } else {
            return redirect('/choose-option');
        }
    }


    /**
     * set customer enrollment status.
     *
     * @return "view"
     */
    public function setEnrollmentStatus(Request $request)
    {


        $data = $request->all();

        //Customer status & Phone Number & FirstName for the sale
        $customer = Customer::where('id', '=', $data['enrollment_customerid'])->get();
        $enrollment_status = $customer[0]->status;
        $receiversNumber = "+254" . substr($customer[0]->phone_number, 1);
        $firstname = $customer[0]->first_name;


        if (($enrollment_status == 'Accepted') || ($enrollment_status == 'Rejected')) {
            session()->flash('success', 'Status Already Set');
            return redirect()->back();
        } else {

            $todayDateTime = Carbon::now()->format('Y-m-d H:i:m');
            $personnel = Auth::user()->name;


            if ($data['enrollment_status'] == 'Rejected') {

                //update customer status
                Customer::where('id', '=', $data['enrollment_customerid'])->update([
                    'status' => $data['enrollment_status'],
                    'reason' => $data['enrollment_status_reason'],
                    'approved_by' => $personnel,
                    'approved_date' => $todayDateTime

                ]);

                //send conmfirmation message
                try {
                    $message = "Dear " . $firstname . ", Sorry ! Your enrollment has failed. Please Review the reason and enrollment again";
                    $this->sendSms($message, $receiversNumber);

                    session()->flash('success', 'Customer Rejected and  Message sent Successfully');
                    return redirect()->back();

                } catch (Exception $e) {

                    session()->flash('success', 'Customer Rejected, there was an error while sending SMS');
                    return redirect()->back();

                };

            } else {


                //update customer status
                Customer::where('id', '=', $data['enrollment_customerid'])->update([
                    'status' => $data['enrollment_status'],
                    'reason' => $data['enrollment_status_reason'],
                    'approved_by' => $personnel,
                    'approved_date' => $todayDateTime
                ]);


                //send conmfirmation message
                try {
                    $message = "Dear " . $firstname . ", Congratulations! You have successfully enrolled to our fuel rewards program. Keep fuelling with us to earn redeemable discount rewards";
                    $this->sendSms($message, $receiversNumber);

                    session()->flash('success', 'Customer Approved and Confirmation Message sent Successfully');
                    return redirect()->back();

                } catch (Exception $e) {

                    session()->flash('success', 'Customer Approved Successfully, but there was an error while sending SMS');
                    return redirect()->back();

                }

            }


        }


    }


    /**
     * set sale enrollment status.
     *
     * @return "view"
     */
    public function setSaleStatus(Request $request)
    {

        $data = $request->all();

        //sales details
        $sale = Sale::where('id', '=', $data['salestatus_id'])->get();
        $sales_status = $sale[0]->status;
        $firstname = $sale[0]->first_name;
        $rewards_awarded = $sale[0]->rewards_awarded;
        $customer_rewards = Customer::where('phone_number', '=', $data['salestatuscustomer_phone'])->get()[0]->rewards;
        $receiverNumber = "+254" . substr($data['salestatuscustomer_phone'], 1);


        if (($sales_status == 'Accepted') || ($sales_status == 'Rejected')) {
            session()->flash('success', 'Status Already Set');
            return redirect()->back();
        } else {

            $todayDateTime = Carbon::now()->format('Y-m-d H:i:m');
            $personnel = Auth::user()->name;

            if ($data['sales_status'] == 'Rejected') {

                //sales rewards
                $sales_rewards = Sale::where('id', '=', $data['salestatus_id'])->get()[0]->rewards_awarded;

                //get customer rewards
                $customer_rewards = Customer::where('phone_number', '=', $data['salestatuscustomer_phone'])
                    ->get()[0]->rewards;

                $new_rewards = $customer_rewards - $sales_rewards;

                Customer::where('phone_number', '=', $data['salestatuscustomer_phone'])
                    ->update(['rewards' => $new_rewards]);

                $less_customer_rewards = Customer::where('phone_number', '=', $data['salestatuscustomer_phone'])->get()[0]->rewards;


                Sale::where('id', '=', $data['salestatus_id'])->update([
                    'status' => $data['sales_status'],
                    'reason' => $data['sales_status_reason'] == null ? "No Reason" : $data['sales_status_reason'],
                    'approved_by' => $personnel,
                    'approved_date' => $todayDateTime
                ]);

                //send a confirmation SMS
                try {
                    $message = "Sorry " . $firstname . "! You have not been awarded " . $rewards_awarded .
                        " points. Your balance is " . $less_customer_rewards . " Keep fuelling with us for bigger discounts and rewards.";

                    $this->sendSms($message, $receiverNumber);
                    session()->flash('success', 'Sale Rejected , A Confirmation message was sent');
                    return redirect()->back();

                } catch (Exception $e) {

                    session()->flash('success', 'Sale Rejected, there was an error while sending SMS');
                    return redirect()->back();

                }


            } else {

                $todayDateTime = Carbon::now()->format('Y-m-d H:i:m');

                Sale::where('id', '=', $data['salestatus_id'])->update([
                    'status' => $data['sales_status'],
                    'reason' => $data['sales_status_reason'] == null ? "No Reason" : $data['sales_status_reason'],
                    'approved_by' => $personnel,
                    'approved_date' => $todayDateTime

                ]);


                //send a confirmation SMS
                try {
                    $message = "Congratulations " . $firstname . "! You have been awarded " . $rewards_awarded .
                        " points. Your balance is " . $customer_rewards . " Keep fuelling with us for bigger discounts and rewards.";

                    $this->sendSms($message, $receiverNumber);
                    session()->flash('success', 'Sale Approved Successfully, A Confirmation message was sent');
                    return redirect()->back();

                } catch (Exception $e) {

                    session()->flash('success', 'Sale Approved Successfully, there was an error while sending SMS');
                    return redirect()->back();

                }


            }


        }


    }


    /**
     * add a new staff and staff dashboard.
     *
     * @return "view"
     */
    public function deleteCustomer(Customer $customer)
    {

        $customer->delete();
        session()->flash('success', 'Staff Deleted Successfully');
        return redirect()->back();

    }


    /**
     * ennroll a customer, send an SMS and redirect to chose option page.
     *
     * @return "view"
     */
    public function enrollCustomer(Request $request)
    {

        //validate customer enrollment details
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'phone_number' => 'required|regex:(^07)|digits:10|unique:customers',
            'id_number' => 'required|min:7|max:8|unique:customers',
            'category' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'customer_type' => ['required', 'string', 'max:255'],
            'regno' => ['required', 'string', 'max:255', 'unique:vehicles,vehicle_registration'],
        ]);

        $data = $request->all();

        //  create a new customer
        $customer = Customer::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
            'email' => "customer-email",
            'phone_number' => $data['phone_number'],
            'id_number' => $data['id_number'],
            'rewards' => 0,
            'organization_id' => intval($data['organization']),
            'custom_reward_type' => intval($data['organization']) == 0 ? 'customer' : 'organization',
            'enrolled_by' => Auth::user()->name,
            'status' => "Accepted",
            'customer_type' => $data['customer_type']
        ]);


        $this->storeDefaultCustomerRewards($customer);


        // upload vehicle image
        $fileName = "image-" . time() . '.' . $request->vehicle_image->getClientOriginalExtension();
        $request->vehicle_image->move(public_path('images'), $fileName);


        //update customer vehicle image
        Vehicle::create([
            'customer_id' => $customer->id,
            'vehicle_category' => $data['category'],
            'vehicle_type' => $data['type'],
            'vehicle_registration' => strtoupper($data['regno']),
            'fuel_type' => $data['fuel_type'],
            'image_url' => $fileName

        ]);


        return response()->json([
            'data' => $request->phone_number,
        ]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return
     */
    public function edit(Request $request, Customer $customer)
    {
        //validate customer enrollment details
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone_number' => 'required|regex:(^07)|digits:10',
            'id_number' => 'required|min:7|max:8',
            'rewards' => 'integer',
            'customer_type' => ['required', 'string', 'max:255'],
        ]);


        $data = $request->all();


        //update customer data using id provided
        $customer->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'id_number' => $data['id_number'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'rewards' => $data['rewards'],
            'organization_id' => $data['organization_id'],
            'custom_reward_type' => $data['custom_reward_type'],
            'customer_type' => $data['customer_type'],
        ]);


        return response()->json([

            'data' => 'success'

        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return
     */
    public function editStaff(Request $request, User $user)
    {

        //validate customer enrollment details
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'major_role' => ['required', 'string', 'max:255'],
            'shift' => ['required', 'string', 'max:255'],
        ]);

        $data = $request->all();

        if (!$data['password']) {
            //update customer data using id provided
            User::where('id', '=', $user->id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'major_role' => ucfirst($data['major_role']),
                'shift' => $data['shift']
            ]);

        } else {

            //update customer data using id provided
            User::where('id', '=', $user->id)->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'major_role' => ucfirst($data['major_role']),
                'shift' => ['shift'],
                'password' => Hash::make($data['password'])
            ]);

        }


        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return
     */
    public function viewCustomerData(Customer $customer)
    {
        $customer_data = Customer::where('id', $customer->id)->get();
        $vehicles_data = Vehicle::where('customer_id', '=', $customer->id)->get();
        $organizations = Organization::all();

        return response()->json([

            'customer_data' => $customer_data,
            'vehicles_data' => $vehicles_data,
            'organization_data' => $organizations,

        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customer
     * @return
     */
    public function getStaffData(Request $request)
    {
        $user = User::where('id', '=', $request->all()['id'])->get();
        return response()->json([

            'user_data' => $user
        ]);
    }


    // Function to check string starting
    // with given substring
    public function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return (substr($string, 0, $len) === $startString);
    }


    /**
     * Get customer data to be used in sales.
     *
     * @param \App\Models\Request $request
     * @return \Illuminate\Http\JsonResponse with customer and vehicle data
     */
    public function getCustomerData(Request $request)
    {

        $data = $request->all();
        $organization_data = array();

        $vehicles = Vehicle::where('vehicle_registration', '=', $data['id_number'])->get();

        if (count($vehicles) > 0) {
            $customer = Customer::with('organization')->where('id', '=', $vehicles[0]->customer_id)->get();
        } else {
            $customer = Customer::with('organization')->where('id_number', '=', $data['id_number'])->orWhere('phone_number', '=', $data['id_number'])->get();
        }

        if (!is_null($customer[0]->organization)) {
            $organization_data['id'] = $customer[0]->organization->id;
            $organization_data['name'] = $customer[0]->organization->name;
            $organization_data['discount'] = $customer[0]->organization->rewards;
        }

        if (($customer[0]->purchase_status == 'complete') || ($customer[0]->status == 'Rejected') || ($customer[0]->status == 'Pending')) {
            $vehicles = [];
        } else {
            $vehicles = Vehicle::where('customer_id', '=', $customer[0]->id)->get();
        }


        return response()->json([
            'customer' => $customer,
            'vehicles' => $vehicles,
            'organization' => $organization_data
        ]);


    }


    /**
     * Get customer data to be used in sales.
     *
     * @param \App\Models\Request $request
     * @return view with customer and vehicle data
     */
    public function getCustomerSalesData(Request $request)
    {

        $data = $request->all();
        $customer = Customer::where('id', '=', $data['customer_id'])->get();
        $vehicle = Vehicle::where('id', '=', $data['vehicle_id'])->get();
        $fuel_details = Products::all();


        return response()->json([

            'customer' => $customer,
            'vehicle' => $vehicle,
            'fuel_details' => $fuel_details

        ]);

    }


    /**
     * Autocomplete sales search
     *
     */
    public function autoCompleteCustomerSearch(Request $request)
    {
        $query = $request->get('query');
        $datas = Vehicle::select('vehicle_registration')
            ->where('vehicle_registration', 'LIKE', '%' . $query . '%')
            ->get();

        $dataModified = array();
        foreach ($datas as $data) {
            $dataModified[] = $data->vehicle_registration;
        }

        return response()->json($dataModified);
        // return response()->json($data);
    }

    public function editCustomerRewards(Customer $customer)
    {

        $petrol_reward_formats = CustomerReward::where('customer_id', $customer->id)
            ->where('product_type', 'petrol')->get();
        $diesel_reward_formats = CustomerReward::where('customer_id', $customer->id)
            ->where('product_type', 'diesel')->get();;

        return view('staff.customer_rewards', compact('customer', 'petrol_reward_formats', 'diesel_reward_formats'));
    }

    private function storeDefaultCustomerRewards(Customer $customer)
    {

        DB::table('customer_rewards')->insert([
            [
                'customer_id' => $customer->id,
                'low' => 0,
                'high' => 100,
                'reward_type' => 'customer',
                'shillings_per_litre' => 0.69,
                'period' => 'July 2023',
                'product_type' => 'Petrol'
            ],
            [
                'customer_id' => $customer->id,
                'low' => 0,
                'high' => 100,
                'reward_type' => 'customer',
                'shillings_per_litre' => 1,
                'period' => 'July 2023',
                'product_type' => 'Diesel'
            ]
        ]);
    }

    public function uploadCustomers(Request $request)
    {

        if ($request->has('customers_csv')) {

            $csv = file($request->customers_csv);
            $chunks = array_chunk($csv, 10000);

            foreach ($chunks as $key => $chunk) {
                $customersList = array_map('str_getcsv', $chunk);
                if ($key == 0) {
                    unset($customersList[0]);
                }

                foreach ($customersList as $customerList) {

                    //  create a new customer
                    $customer = Customer::create([
                        'first_name' => $customerList[0],
                        'last_name' => $customerList[1],
                        'gender' => 'male',
                        'email' => "customer-email",
                        'phone_number' => '0'.substr($customerList[2],3),
                        'id_number' => $customerList[3],
                        'rewards' => 0,
                        'organization_id' => $request->input('organization'),
                        'custom_reward_type' => $customerList[4],
                        'enrolled_by' => Auth::user()->name,
                        'status' => "Accepted"
                    ]);


                    //update customer vehicle image
                    Vehicle::create([
                        'customer_id' => $customer->id,
                        'vehicle_category' => $customerList[5],
                        'vehicle_type' => $customerList[6],
                        'vehicle_registration' => strtoupper($customerList[7]),
                        'fuel_type' => $customerList[8],
                        'image_url' => "Not Uploaded"
                    ]);
                }

                return response()->json([
                    'message' => 'Customers Uploaded Successfully'
                ]);

            }

            return response()->json([
                'message' => 'There was an error Uploading Customers'
            ]);
        }
    }
}
