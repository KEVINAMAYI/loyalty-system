@extends('staff.body')
@section('content')
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">

  <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <h6 class="font-weight-bolder mb-0">Registered Corporates</h6>
      </nav>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="container-fluid py-4">


      {{-- display success message on a successful action --}}
      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
      </div>
      @endif

      {{-- display error on top of the form --}}
      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
          <ul class="list-group">
              @foreach ($errors->all() as $error )
              <li class="list-group-item">
                {{ $error }}
              </li>
              @endforeach
          </ul>
      </div>
      @endif

      <button type="button" style="background-color:#f9a14d;" class="btn btn-primary btn-md" data-bs-toggle="modal" data-bs-target="#add-corporate-modal"><i class="fa-solid fa-plus"></i>
        <span style="margin-left:5px;">Add Corporate</span>
    </button>

    <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Registered Corporates</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table id="corporates_table" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Organization Name</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Type</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Credit Limit(KES)</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prepaid Amount(KES)</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Contact Person</th>
                    <th style="border-bottom:1px solid rgb(200, 195, 195);" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Logo</th> --}}
                  </tr>
                </thead>
                <tbody>

                  @foreach ( $corporates_accounts as $corporate_account)
                    <tr>
                      <td style="padding-left:30px;" class="align-middle text-left text-sm">
                        <a id="{{ $corporate_account->organization_id ?? ''}}" style="cursor:pointer" class="view-organizational-detail-link text-xs font-weight-bold mb-0">{{ App\Models\User::where('id', $corporate_account->organization_id)->first()->name ?? '' }}</a>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $corporate_account->account_type ?? '' }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $corporate_account->account_limit ?? '' }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">{{ $corporate_account->amount_payable ? $corporate_account->amount_payable : 0  }}</span>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">
                          {{ App\Models\User::where('id', $corporate_account->organization_id)->first()->contact_person_phone ?? '' }}<br>
                          {{ App\Models\User::where('id', $corporate_account->organization_id)->first()->contact_person_name ?? '' }}
                        </span>
                      </td>
                      <td class="align-middle text-center text-sm">
                      <span id="{{ $corporate_account->organization_id ?? '' }}" account_name="{{ App\Models\User::where('id', $corporate_account->organization_id)->first()->name ?? '' }}" account_type="{{ $corporate_account->account_type ?? '' }}" account_number={{ $corporate_account->account_number ?? '' }} account_balance={{ $corporate_account->account_balance ?? '' }} style="background-color:#4881c0; cursor:pointer;"  class="managecorporatebtn badge badge-sm">Manage</span>
                      <span org_id="{{ $corporate_account->organization_id ?? '' }}" account_name="{{ App\Models\User::where('id', $corporate_account->organization_id)->first()->name ?? '' }}" account_type="{{ $corporate_account->account_type ?? '' }}" class="show_purchase_payment_btn badge badge-sm bg-gradient-danger" account_number={{ $corporate_account->account_number ?? '' }} account_balance={{ $corporate_account->account_balance ?? '' }} style="cursor:pointer;">Payment/Purchase</span>
                    </td>
                    </tr>
                  @endforeach

                </tbody>
                <tfoot>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Organization Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Type</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Credit Limit(KES)</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prepaid Amount(KES)</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Discount Amount</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                 </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
 </div>

 {{-- Add Corporate Modal --}}
 <form class="form-register" method="POST" action="/add-register-corporate" enctype="multipart/form-data">
  @csrf
  <div class="modal fade" id="add-corporate-modal" tabindex="-1" aria-labelledby="add-corporate-modal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Corporate Customer</h5>
            <button type="button" style="color:black;"  class="btn-close" data-bs-dismiss="modal" aria-label="Close">&#10006</button>
          </div>
          <div class="modal-body">
            <div class="form-row col-md-12" style="margin-top:30px; text-align:center">
              <span class="login100-form-logo" >
                <img style="border:2px solid orange; border-radius:100%;" id="company_logo" src="../assets/img/logo.jpg" width="70" height="70">
              </span>
            </div>
            <div class="form-row" style="margin-top:15px; display:flex; margin-bottom:40px; justify-content:center; text-align:center;">
              <div style="background-color:#f9a14d; margin-left:0px; border-radius:10px; padding-right:20px; padding-left:20px; padding-top:2px;" class="form-holder">
                <label class="custom-file-upload">
                  <img id="camera" src="front-end/images/camera.png" id="company_logo" style="max-width:50px; max-height:50px;" alt="">
                  <input type="file" style="display:none;" class="" id="company_logo_image" name="company_logo_image" id="uploader"
                  accept="image/*"
                  capture="camera" />
                  Upload  Logo
                </label>
              </div>
            </div>
            <div class="form-holder col-md-12 form-holder-2 mt-4 mb-4">
              <label for="account_type">Account Type</label></br>
              <select name="account_type" id="account_type" class="form-control">
                  <option value="credit">Credit</option>
                  <option value="prepaid">Prepaid</option>
                  <option value="both">Prepaid & Credit</option>
              </select>
            </div>
            <div class="form-row col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Organization Name  <span style="color:red;">*</span></label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" type="text" id="name"   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
            <div class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Phone Number <span style="color:red;">*</span></label> </br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;"  type="text" id="phonenumber"   name="phonenumber" value="{{ old('phonenumber') }}" required autocomplete="phonenumber" autofocus>
            </div>
            <div class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Alternative Phone Number</label></br>
              <input  style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" type="text" id="alternativephonenumber"    name="alternativephonenumber" value="{{ old('alternativephonenumber') }}" autocomplete="alternativephonenumber" autofocus>
            </div>
            <div class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Organization Email <span style="color:red;">( login credentials will be sent to this email address ) *</span></label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;"  type="text" id="email"  name="email" value="{{ old('email') }}"  required autocomplete="email">
            </div>

            <div class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Organization Address<span style="color:red;">*</span></label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;"  type="text" id="address"     name="address" value="{{ old('address') }}" required  autocomplete="name" autofocus>
            </div>

            <div class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Town<span style="color:red;">*</span></label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" type="text" id="town"  name="town" value="{{ old('town') }}" required autocomplete="town" autofocus>
            </div>
            <div class="form-holder col-md-12 form-holder-2 mt-4 mb-4">
              <label for="country">Country<span style="color:red;">*</span></label></br>
              <select name="country" id="country" class="form-control">
                <option value="Kenya">Kenya</option>
                <option value="Afganistan">Afghanistan</option>
                <option value="Albania">Albania</option>
                <option value="Algeria">Algeria</option>
                <option value="American Samoa">American Samoa</option>
                <option value="Andorra">Andorra</option>
                <option value="Angola">Angola</option>
                <option value="Anguilla">Anguilla</option>
                <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                <option value="Argentina">Argentina</option>
                <option value="Armenia">Armenia</option>
                <option value="Aruba">Aruba</option>
                <option value="Australia">Australia</option>
                <option value="Austria">Austria</option>
                <option value="Azerbaijan">Azerbaijan</option>
                <option value="Bahamas">Bahamas</option>
                <option value="Bahrain">Bahrain</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Barbados">Barbados</option>
                <option value="Belarus">Belarus</option>
                <option value="Belgium">Belgium</option>
                <option value="Belize">Belize</option>
                <option value="Benin">Benin</option>
                <option value="Bermuda">Bermuda</option>
                <option value="Bhutan">Bhutan</option>
                <option value="Bolivia">Bolivia</option>
                <option value="Bonaire">Bonaire</option>
                <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                <option value="Botswana">Botswana</option>
                <option value="Brazil">Brazil</option>
                <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                <option value="Brunei">Brunei</option>
                <option value="Bulgaria">Bulgaria</option>
                <option value="Burkina Faso">Burkina Faso</option>
                <option value="Burundi">Burundi</option>
                <option value="Cambodia">Cambodia</option>
                <option value="Cameroon">Cameroon</option>
                <option value="Canada">Canada</option>
                <option value="Canary Islands">Canary Islands</option>
                <option value="Cape Verde">Cape Verde</option>
                <option value="Cayman Islands">Cayman Islands</option>
                <option value="Central African Republic">Central African Republic</option>
                <option value="Chad">Chad</option>
                <option value="Channel Islands">Channel Islands</option>
                <option value="Chile">Chile</option>
                <option value="China">China</option>
                <option value="Christmas Island">Christmas Island</option>
                <option value="Cocos Island">Cocos Island</option>
                <option value="Colombia">Colombia</option>
                <option value="Comoros">Comoros</option>
                <option value="Congo">Congo</option>
                <option value="Cook Islands">Cook Islands</option>
                <option value="Costa Rica">Costa Rica</option>
                <option value="Cote DIvoire">Cote DIvoire</option>
                <option value="Croatia">Croatia</option>
                <option value="Cuba">Cuba</option>
                <option value="Curaco">Curacao</option>
                <option value="Cyprus">Cyprus</option>
                <option value="Czech Republic">Czech Republic</option>
                <option value="Denmark">Denmark</option>
                <option value="Djibouti">Djibouti</option>
                <option value="Dominica">Dominica</option>
                <option value="Dominican Republic">Dominican Republic</option>
                <option value="East Timor">East Timor</option>
                <option value="Ecuador">Ecuador</option>
                <option value="Egypt">Egypt</option>
                <option value="El Salvador">El Salvador</option>
                <option value="Equatorial Guinea">Equatorial Guinea</option>
                <option value="Eritrea">Eritrea</option>
                <option value="Estonia">Estonia</option>
                <option value="Ethiopia">Ethiopia</option>
                <option value="Falkland Islands">Falkland Islands</option>
                <option value="Faroe Islands">Faroe Islands</option>
                <option value="Fiji">Fiji</option>
                <option value="Finland">Finland</option>
                <option value="France">France</option>
                <option value="French Guiana">French Guiana</option>
                <option value="French Polynesia">French Polynesia</option>
                <option value="French Southern Ter">French Southern Ter</option>
                <option value="Gabon">Gabon</option>
                <option value="Gambia">Gambia</option>
                <option value="Georgia">Georgia</option>
                <option value="Germany">Germany</option>
                <option value="Ghana">Ghana</option>
                <option value="Gibraltar">Gibraltar</option>
                <option value="Great Britain">Great Britain</option>
                <option value="Greece">Greece</option>
                <option value="Greenland">Greenland</option>
                <option value="Grenada">Grenada</option>
                <option value="Guadeloupe">Guadeloupe</option>
                <option value="Guam">Guam</option>
                <option value="Guatemala">Guatemala</option>
                <option value="Guinea">Guinea</option>
                <option value="Guyana">Guyana</option>
                <option value="Haiti">Haiti</option>
                <option value="Hawaii">Hawaii</option>
                <option value="Honduras">Honduras</option>
                <option value="Hong Kong">Hong Kong</option>
                <option value="Hungary">Hungary</option>
                <option value="Iceland">Iceland</option>
                <option value="Indonesia">Indonesia</option>
                <option value="India">India</option>
                <option value="Iran">Iran</option>
                <option value="Iraq">Iraq</option>
                <option value="Ireland">Ireland</option>
                <option value="Isle of Man">Isle of Man</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Jamaica">Jamaica</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Kazakhstan">Kazakhstan</option>
                <option value="Kiribati">Kiribati</option>
                <option value="Korea North">Korea North</option>
                <option value="Korea Sout">Korea South</option>
                <option value="Kuwait">Kuwait</option>
                <option value="Kyrgyzstan">Kyrgyzstan</option>
                <option value="Laos">Laos</option>
                <option value="Latvia">Latvia</option>
                <option value="Lebanon">Lebanon</option>
                <option value="Lesotho">Lesotho</option>
                <option value="Liberia">Liberia</option>
                <option value="Libya">Libya</option>
                <option value="Liechtenstein">Liechtenstein</option>
                <option value="Lithuania">Lithuania</option>
                <option value="Luxembourg">Luxembourg</option>
                <option value="Macau">Macau</option>
                <option value="Macedonia">Macedonia</option>
                <option value="Madagascar">Madagascar</option>
                <option value="Malaysia">Malaysia</option>
                <option value="Malawi">Malawi</option>
                <option value="Maldives">Maldives</option>
                <option value="Mali">Mali</option>
                <option value="Malta">Malta</option>
                <option value="Marshall Islands">Marshall Islands</option>
                <option value="Martinique">Martinique</option>
                <option value="Mauritania">Mauritania</option>
                <option value="Mauritius">Mauritius</option>
                <option value="Mayotte">Mayotte</option>
                <option value="Mexico">Mexico</option>
                <option value="Midway Islands">Midway Islands</option>
                <option value="Moldova">Moldova</option>
                <option value="Monaco">Monaco</option>
                <option value="Mongolia">Mongolia</option>
                <option value="Montserrat">Montserrat</option>
                <option value="Morocco">Morocco</option>
                <option value="Mozambique">Mozambique</option>
                <option value="Myanmar">Myanmar</option>
                <option value="Nambia">Nambia</option>
                <option value="Nauru">Nauru</option>
                <option value="Nepal">Nepal</option>
                <option value="Netherland Antilles">Netherland Antilles</option>
                <option value="Netherlands">Netherlands (Holland, Europe)</option>
                <option value="Nevis">Nevis</option>
                <option value="New Caledonia">New Caledonia</option>
                <option value="New Zealand">New Zealand</option>
                <option value="Nicaragua">Nicaragua</option>
                <option value="Niger">Niger</option>
                <option value="Nigeria">Nigeria</option>
                <option value="Niue">Niue</option>
                <option value="Norfolk Island">Norfolk Island</option>
                <option value="Norway">Norway</option>
                <option value="Oman">Oman</option>
                <option value="Pakistan">Pakistan</option>
                <option value="Palau Island">Palau Island</option>
                <option value="Palestine">Palestine</option>
                <option value="Panama">Panama</option>
                <option value="Papua New Guinea">Papua New Guinea</option>
                <option value="Paraguay">Paraguay</option>
                <option value="Peru">Peru</option>
                <option value="Phillipines">Philippines</option>
                <option value="Pitcairn Island">Pitcairn Island</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Puerto Rico">Puerto Rico</option>
                <option value="Qatar">Qatar</option>
                <option value="Republic of Montenegro">Republic of Montenegro</option>
                <option value="Republic of Serbia">Republic of Serbia</option>
                <option value="Reunion">Reunion</option>
                <option value="Romania">Romania</option>
                <option value="Russia">Russia</option>
                <option value="Rwanda">Rwanda</option>
                <option value="St Barthelemy">St Barthelemy</option>
                <option value="St Eustatius">St Eustatius</option>
                <option value="St Helena">St Helena</option>
                <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                <option value="St Lucia">St Lucia</option>
                <option value="St Maarten">St Maarten</option>
                <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                <option value="Saipan">Saipan</option>
                <option value="Samoa">Samoa</option>
                <option value="Samoa American">Samoa American</option>
                <option value="San Marino">San Marino</option>
                <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Senegal">Senegal</option>
                <option value="Seychelles">Seychelles</option>
                <option value="Sierra Leone">Sierra Leone</option>
                <option value="Singapore">Singapore</option>
                <option value="Slovakia">Slovakia</option>
                <option value="Slovenia">Slovenia</option>
                <option value="Solomon Islands">Solomon Islands</option>
                <option value="Somalia">Somalia</option>
                <option value="South Africa">South Africa</option>
                <option value="Spain">Spain</option>
                <option value="Sri Lanka">Sri Lanka</option>
                <option value="Sudan">Sudan</option>
                <option value="Suriname">Suriname</option>
                <option value="Swaziland">Swaziland</option>
                <option value="Sweden">Sweden</option>
                <option value="Switzerland">Switzerland</option>
                <option value="Syria">Syria</option>
                <option value="Tahiti">Tahiti</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Tajikistan">Tajikistan</option>
                <option value="Tanzania">Tanzania</option>
                <option value="Thailand">Thailand</option>
                <option value="Togo">Togo</option>
                <option value="Tokelau">Tokelau</option>
                <option value="Tonga">Tonga</option>
                <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                <option value="Tunisia">Tunisia</option>
                <option value="Turkey">Turkey</option>
                <option value="Turkmenistan">Turkmenistan</option>
                <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                <option value="Tuvalu">Tuvalu</option>
                <option value="Uganda">Uganda</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Erimates">United Arab Emirates</option>
                <option value="United States of America">United States of America</option>
                <option value="Uraguay">Uruguay</option>
                <option value="Uzbekistan">Uzbekistan</option>
                <option value="Vanuatu">Vanuatu</option>
                <option value="Vatican City State">Vatican City State</option>
                <option value="Venezuela">Venezuela</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                <option value="Wake Island">Wake Island</option>
                <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                <option value="Yemen">Yemen</option>
                <option value="Zaire">Zaire</option>
                <option value="Zambia">Zambia</option>
                <option value="Zimbabwe">Zimbabwe</option>
              </select>
            </div>
            <div class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Organization KRA PIN</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" type="text" id="krapin"    name="krapin" value="{{ old('krapin') }}"  autocomplete="krapin" autofocus>
            </div>
             <u><h5 style="margin-top:30px; margin-bottom:-20px;">Primary Contact Person</h5></u>
             <div class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Name<span style="color:red;">*</span></label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" name="contact_person_name" type="text" id="contact_person_name"  required autocomplete="contact_person_name" autofocus>
            </div>
            <div class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Email<span style="color:red;">*</span></label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;"  type="email" id="contact_person_email"  name="contact_person_email"  required autocomplete="email">
            </div>
            <div class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Phone Number<span style="color:red;">*</span></label></br>
              <input type="text" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;"   id="contact_person_phone"   name="contact_person_phone" required autocomplete="phonenumber" autofocus>
            </div>
            <div style="margin-top:20px;" class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Additional Phone Number</label></br>
              <input type="text" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;"   id="contact_person_alternative_phone"   name="contact_person_alternative_phone" autocomplete="phonenumber" autofocus>
            </div>


            <span style="color:red; font-size:11px; font-weight:bold;">Optional</span>
            <button id="add_another_contact_peson" type="button" style="width:100%; margin-top:0px; margin-bottom:-10px;  background-color:#f9a14d;" class="btn btn-primary btn-md"><i class="fa-solid fa-plus"></i>
              <span style="margin-left:5px;">Add Another contact person</span>
            </button>

            <div id="another_contact_person_name_div" style="display:none;" class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Name</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" name="another_contact_person_name" type="text" id="another_contact_person_name" autocomplete="contact_person_name" autofocus>
            </div>
            <div  id="another_contact_person_email_div"  style="display:none;" class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Email</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;"  type="email" id="another_contact_person_email"  name="another_contact_person_email"  autocomplete="email">
            </div>
            <div id="another_contact_person_phone_div" style="display:none;" class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-1">
              <label for="regno">Phone Number</label></br>
              <input type="text" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;"   id="another_contact_person_phone"   name="another_contact_person_phone" autocomplete="phonenumber" autofocus>
            </div>
            <div id="another_contact_person_alternative_phone_div" style="display:none;" class="form-holder col-md-12 col-sm-12 form-holder-2 mt-4 mb-0">
              <label for="regno">Additional Phone Number</label></br>
              <input type="text" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;"  id="another_contact_person_alternative_phone"   name="another_contact_person_alternative_phone" autocomplete="phonenumber" autofocus>
            </div>
            <div style="margin-top:30px;" class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" style="background-color:#f9a14d; color:white;" type="button" class="btn">Submit</button>
           </div>
          </div>
        </div>
      </div>
    </div>
  </form>



 <!--  Manage corporates modal -->
<form class="form-register" method="POST" action="/set-credit-limit">
  @csrf
  <div class="modal fade" id="manage-corporate" tabindex="-1" aria-labelledby="manage-corporate" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Manage Corporate Customer</h5>
            <button type="button" style="color:black;"  class="btn-close" data-bs-dismiss="modal" aria-label="Close">&#10006</button>
          </div>
          <div class="modal-body">
            <div class="form-row row">
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-1">
                <label for="regno">Organization Name</label></br>
                <p class="acc_name_disp" style="padding-left:5px;"></p>
              </div>
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-1">
                <label for="regno">Account Type</label></br>
                <p class="acc_name_type" style="padding-left:5px;"></p>
              </div>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
                <label for="regno">Account Number</label></br>
                <input class="acc_number" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" name="account_number" id="account_number"  placeholder="7770169016805">
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno" class="limit_label">Credit Limit Amount</label></br>
              <input  style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px;" name="account_limit" id="account_limit" placeholder="0">
            </div>

            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="reward-type">Reward Type</label>
              <select name="reward-type" id="reward-type" class="form-control">
                <option value="credit" selected>Credit</option>
                <option value="prepaid">Prepaid</option>
              </select>
           </div>

            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="major_role">Manage Status</label></br>
              <select name="corporate_status" id="corporate_status" class="form-control">
                  <option value="active">Activate</option>
                  <option value="inactive">Disable</option>
              </select>
            </div>
            <div class="modal-footer">
              <input type="hidden" class="corporate_main_id" name="corporate_id" value="">
              <input type="hidden" class="corporate_account_type" name="account_type"  value="">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" style="background-color:#f9a14d; color:white;" type="button" class="btn">Submit</button>
           </div>
          </div>
        </div>
      </div>
    </div>
  </form>



 <!--  Add Payment/Purchase modal -->
<form class="form-register" method="POST" action="/make-payment-or-purchase">
  @csrf
  <div class="modal fade" id="make-payment-model" tabindex="-1" aria-labelledby="manage-corporate-payment" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Payment</h5>
            <button type="button" style="color:black;"  class="btn-close" data-bs-dismiss="modal" aria-label="Close">&#10006</button>
          </div>
          <div class="modal-body">
            <div class="form-row row">
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-1">
                <label for="regno">Organization Name</label></br>
                <p class="acc_name_disp" style="padding-left:5px;"></p>
              </div>
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-1">
                <label for="regno">Account Type</label></br>
                <p class="acc_name_type" style="padding-left:5px;"></p>
              </div>
            </div>
            <div class="form-row row">
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-2">
                <label for="regno">Account Number</label></br>
                <p class="acc_no_disp" style="padding-left:5px;">7770169016805</p>
              </div>
              <div class="form-holder col-md-6 col-sm-12 form-holder-2 mt-4 mb-2">
                <label for="regno">Current Balance</label></br>
                <p class="acc_bal_type" style="padding-left:5px;">-10000</p>
              </div>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Amount Paid</label></br>
              <input type="number" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " name="amount_paid" id="amount_paid"  required>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Paid By</label></br>
              <input type="text" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " name="paid_by" id="paid_by" required>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Payment Date</label></br>
              <input style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " type="date" name="payment_date" id="payment_date" required>
            </div>
            <div class="form-holder form-holder-2 mt-4 mb-4">
              <label for="regno">Mode of Payment (Choose One ...)</label></br>
              <select name="payment_mode" id="payment_mode" class="form-control" required>
                <option value="Cheque">Cheque</option>
                <option value="Cash">Cash</option>
                <option value="Mpesa">Mpesa</option>
            </select>
           </div>
           <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="regno">Reference Number</label></br>
            <input type="text" style="width:100%; padding:5px; border-radius:8px; border-color: rgb(240, 235, 235); border-width:1px; " name="reference_number" id="reference_number"  required>
          </div>
           <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="regno">Payment details</label></br>
            <textarea name="payment_details" id="payment_details" style="width:100%; padding-left:0px;" rows="3" required>
            </textarea>
            </div>
            <div class="modal-footer">
              <input type="hidden" class="corporate_main_id" name="corporate_id" value="">
              <input type="hidden" class="corporate_account_type" name="account_type"  value="">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" style="background-color:#f9a14d; color:white;" type="button" class="btn">Submit</button>
           </div>
          </div>
        </div>
      </div>
    </div>
  </form>

{{-- Get organizational details --}}
  <div class="modal fade" id="organization-details-modal" tabindex="-1" aria-labelledby="organization-details-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Organization Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-holder form-holder-2 mb-2">
            <label for="orgname">Organization Name</label></br>
            <p id="orgname" style="padding-left:5px;"></p>
           </div>
          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="orgemail">Organization Email</label></br>
            <p  id="orgemail" style="padding-left:5px;"></p>
          </div>

          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="orgphonenumber">Organization Phone Number</label></br>
            <p id="orgphonenumber" style="padding-left:5px;"></p>
          </div>

          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="orgaddress">Organization Address</label></br>
            <p  id="orgaddress" style="padding-left:5px;"></p>
          </div>
          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label for="orgkrapin">Organization KRA PIN</label></br>
            <p id="orgkrapin" style="padding-left:5px;"></p>
          </div>
          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label id="orgcontactperson1label" for="orgcontactperson1">Organization Contact Person 1</label></br>
            <p id="orgcontactperson1" style="padding-left:5px;"></p>
          </div>
          <div class="form-holder form-holder-2 mt-4 mb-4">
            <label id="orgcontactperson2label" for="orgcontactperson2">Organization Contact Person 2</label></br>
            <p id="orgcontactperson2" style="padding-left:5px;"></p>
          </div>
          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
        </div>
      </div>
    </div>
  </div>

@endsection
