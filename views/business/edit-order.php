<?php
require __DIR__ . '/../../helpers/session-checker.php';
require __DIR__ . '/../../partials/header.php';
require __DIR__ . '/../../partials/businessnavbar.php';

?>
<div class="full-panel mt-6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-9 mx-auto grid-margin mb-4 mb-xl-0">
        <div class="row">
          <div class="col-3">

            <img class="shadow-sm" src="<?php echo $_SESSION['avatar']; ?>" style="vertical-align: middle;object-fit: cover;border-radius: 50%;" width="50px" height="50px" />

          </div>
          <div class="col-9">
            <h4 class="font-weight-bold  text-left text-dark">Welcome <span id="username"><?php echo $_SESSION['forenames']; ?></span> to your Dashboard</h4>
            <p class="font-weight-normal mb-2 text-muted"></p>
          </div>
        </div>

      </div>
    </div>
    <div class="row mt-3">

      <div class="col-xl-9 d-flex mx-auto grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="m-4">
              <ul class="nav nav-tabs" id="myTab">
                <li style='display:none;' class="nav-item">
                  <a href="#home" class="nav-link active" data-bs-toggle="tab">Track</a>
                </li>
                <li class="nav-item">
                  <a href="#profile" class="nav-link" data-bs-toggle="tab">Send </a>
                </li>

              </ul>
              <div class="tab-content">
                <div style='display:none;' class="tab-pane fade show active" id="home">
                  <h4 class="mt-5 text-dark">Track Your Shipment</h4>
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control custom-input" placeholder="Enter Your Tracking Number" aria-label="Recipient's username">
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-primary custom-btn" type="button">Track Now</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade show active" id="profile">
                  <form method="POST" id="accountCreatee" action="/userapi/create-account" class="forms-sample">
                  <div id="sender-info">
                      <h4 class="mt-5 text-dark">Sender Information</h4>

                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Sender Destination *</label>
                        <select v-model="s_destination" name="destinationcountry" class="text-dark form-control form-control-lg" id="dest">

                          <option>Kenya</option>

                        </select>
                      </div>

                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Name of Company</label>
                        <input v-model="s_forename" name="foreNames" value="<?php echo $_SESSION['nameofcompany']; ?>" id="forenamesurname" type="text" class="text-dark form-control" placeholder="Sender Forenames and Surname">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Address Line 1 (*)</label>
                        <input v-model="s_addressone" type="text" id="addressone" value="<?php echo $_SESSION['addressone']; ?>" name="addressLineOne" class="text-dark form-control" placeholder="Address Line 1 (*)">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Address Line 2</label>
                        <input type="text" v-model="s_addresstwo" id="addresstwo" value="<?php echo $_SESSION['addresstwo']; ?>" name="addressLineTwo" class="text-dark form-control" placeholder="Address Line 2">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" id="city" class="text-dark">Town / City *</label>
                        <input type="text" v-model="s_city" id="city" value="<?php echo $_SESSION['city']; ?>" name="city" class="text-dark form-control" placeholder="city">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">State *</label>
                        <input type="text" v-model="s_state" id="state" value="<?php echo $_SESSION['state']; ?>" name="state" class="text-dark form-control" placeholder="state">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Country *</label>
                        <input type="text" id="country" v-model="s_country" value="<?php echo $_SESSION['country']; ?>" name="addressLineTwo" class="text-dark form-control" placeholder="Address Line 2">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Postcode (if Applicable)</label>
                        <input name="postcode" v-model="s_postcode" value="<?php echo $_SESSION['postcode']; ?>" type="text" class="text-dark form-control" id="post" placeholder="Postcode (if Applicable)">
                      </div>

                      <button type="button" @click='ShowReceiver' class="btn btn-success mr-2">Next</button>


                    </div>

                    <div style="display: none;" id="receiver-info">
                      <h4 class="mt-5 text-dark">Receiver Information</h4>
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Receiver Forenames and Surname</label>
                        <input v-model="r_forename" name="foreNames" type="text" class="text-dark form-control" id="exampleInputUsername1" placeholder="Receiver Forenames and Surname">
                      </div>
                      <div class="form-group">
                        <label class="text-dark" for="exampleInputUsername1">Receiver Contact Number</label>
                        <input type="text" v-model="r_contact" name="addressLineOne" class="text-dark form-control" id="exampleInputUsername1" placeholder="Receiver Contact Number (*)">
                      </div>
                      <div class="form-group">
                        <label class="text-dark" for="exampleInputUsername1">Receiver Email</label>
                        <input type="email" v-model="r_email"  class="text-dark form-control" id="exampleInputUsername1" placeholder="Receiver Email">
                      </div>

                      <div class="form-group">
                        <label class="text-dark" for="exampleInputUsername1">Address Line 1 (*)</label>
                        <input type="text" v-model="r_addressone" name="addressLineOne" class="text-dark form-control" id="exampleInputUsername1" placeholder="Address Line 1 (*)">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Address Line 2</label>
                        <input type="text" v-model="r_addresstwo" name="addressLineTwo" class="text-dark form-control" id="exampleInputUsername1" placeholder="Address Line 2">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Country *</label>
                        <select v-model="r_country" name="state" class="text-dark form-control form-control-lg" id="exampleFormControlSelect2">
                        <option>Select Country</option> 
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
                          <option value="Kenya">Kenya</option>
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
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">State *</label>
                        <input type="text" v-model="r_state" name="addressLineOne" class="text-dark form-control" id="exampleInputUsername1" placeholder="Receiver State (*)">
                    
              
                      </div>
                     
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Town / City *</label>
                        <input type="text" v-model="r_city" name="addressLineOne" class="text-dark form-control" id="exampleInputUsername1" placeholder="Receiver City (*)">
                    
          
                      </div>
                    
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Postcode (if Applicable)</label>
                        <input v-model="r_postcode" name="postcode" type="text" class="text-dark form-control" id="exampleInputUsername1" placeholder="Postcode (if Applicable)">
                      </div>

                      <button type="button" @click="ShowSender" class="btn btn-success mr-2">Previous</button>
                      <button type="button" @click="ShowPickUp" style="float:right;" class="btn btn-success mr-2">Next</button>


                    </div>
                    <div style="display: none;" id="pickup-info">
                      <h4 class="mt-5 text-dark">Pick Up Information</h4>
                      <div class="form-check form-check-flat form-check-success">
                        <label class="form-check-label">
                          <input type="checkbox"  @change="SameChecker($event)" class="form-check-input">
                          Tick this box, if the same as sender's details. If not complete the form below
                        </label>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Pick Up Country *</label>
                        <select v-model="p_destination" name="country" class="text-dark form-control form-control-lg" id="exampleFormControlSelect2">
                          <option>Country</option>
                          <option>Kenya</option>

                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Forenames and Surname</label>
                        <input v-model="p_forename" name="foreNames" type="text" class="text-dark form-control" id="exampleInputUsername1" placeholder="Sender Forenames and Surname">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Address Line 1 (*)</label>
                        <input type="text" v-model="p_addressone" name="addressLineOne" class="text-dark form-control" id="exampleInputUsername1" placeholder="Address Line 1 (*)">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Address Line 2</label>
                        <input type="text" v-model="p_addresstwo" name="addressLineTwo" class="text-dark form-control" id="exampleInputUsername1" placeholder="Address Line 2">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">City *</label>
                        <input v-model="p_city" name="foreNames" type="text" class="text-dark form-control" id="exampleInputUsername1" placeholder="Pick Up City">
                 
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">State *</label>
                        <input v-model="p_state" name="foreNames" type="text" class="text-dark form-control" id="exampleInputUsername1" placeholder="Pick Up State">
                 
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername1">Country *</label>
                        <select v-model="p_country" name="country" class="form-control form-control-lg" id="exampleFormControlSelect2">
                        <option>Select Country</option>  
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
                          <option value="Kenya">Kenya</option>
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
                      <div class="form-group">
                        <label for="exampleInputUsername1" class="text-dark">Postcode (if Applicable)</label>
                        <input v-model="p_postcode" name="postcode" type="text" class="text-dark form-control" id="exampleInputUsername1" placeholder="Postcode (if Applicable)">
                      </div>

                      <button type="button" @click="ShowReceiver" class="btn btn-success mr-2">Previous</button>
                      <button type="button" @click="ShowOtherInfo" style="float:right;" class="btn btn-success mr-2">Next</button>

                    </div>

                    <div style="display: none;" id="other-info">
                      <h4 class="mt-5 text-dark">Other Information</h4>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="text-dark">Select Delivery method</label>
                            <select v-model="deliverymethod" @change="CheckDelivery($event)" name="deliverymethod" class="text-dark form-control form-control-lg">
                            <option>Select Delivery Method</option>   
                            <option value="fast_delivery">Fast Delivery</option>
                              <option value="standard_delivery">Standard Delivery</option>
                              <option value="sea_freight">Sea Freight</option>
                              <option value="air_freight">Air Freight</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="text-dark">Select Sea Freight Option</label>
                            <select v-model="seafreight" disabled id="seafreightoption" name="seafreightoption" class="text-dark form-control form-control-lg">
                              <option>N/A</option>
                              <option value="FCL 20FT Container">FCL 20FT Container</option>
                              <option value="FCL 40FT Container">FCL 40FT Container</option>
                              <option value="LLC 1 CBM">LLC 1 CBM</option>
                              <option value="LLC 5 CBM">LLC 5 CBM</option>
                              <option value="LLC 10 CBM">LLC 10 CBM</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label class="text-dark">Select Air Freight Option</label>
                            <select v-model="airfreight" disabled id="airfreightoption" name="airfreightoption" class="text-dark form-control form-control-lg">
                              <option>N/A</option>
                              <option value="50 Kilos">50 Kilos</option>
                              <option value="200 Kilos">200 Kilos</option>
                              <option value="500 Kilos">500 Kilos</option>

                            </select>
                          </div>

                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="text-dark">Weight(kg) max: 100kg</label>

                            <input v-model="weight" type="text" placeholder="Max 100" class="form-control" />

                          </div>
                          <div class="form-group">
                            <label class="text-dark">Items : e.g. 2 books etc ..</label>

                            <input v-model="items" type="text" placeholder="Items to send" class="form-control" />

                          </div>
                          <div class="form-group">
                            <label class="text-dark">Description - max 50 words</label>

                            <textarea v-model="items_desc" rows="3" placeholder="Items Description" class="form-control"></textarea>

                          </div>

                        </div>
                        <br />
                        <div class="col-12">
                          <button type="button" @click="ShowPickUp" class="btn btn-success mr-2">Previous</button>
                          <button type="button" @click="SendToServer" class="btn btn-success mr-2">Quote</button>

                        </div>
                      </div>
                    </div>


                  </form>

                </div>



              </div>
            </div>

          </div>
        </div>
      </div>
    </div>


  </div>
</div>
<script>
  var app = new Vue({
    el: '.full-panel',
    data() {
      return {
        id: '<?php echo $_GET["order_id"] ?>',
        s_forename: '<?php echo $_SESSION["forenames"] ?>',
        s_addressone: '<?php echo $_SESSION['addressone'] ?>',
        s_addresstwo: '<?php echo $_SESSION['addresstwo'] ?>',
        s_city: '<?php echo $_SESSION['city'] ?>',
        s_state: '<?php echo $_SESSION['state'] ?>',
        s_country: '<?php echo $_SESSION['country'] ?>',
        s_postcode: '<?php echo $_SESSION['postcode'] ?>',
        s_email: '<?php echo $_SESSION['email'] ?>',
        r_email:'',
        r_forename: '',
        r_contact: '',
        r_addressone: '',
        r_addresstwo: '',
        r_city: 'Select City',
        r_state: 'Select State',
        r_country: 'Select Country',
        r_postcode: '',
        p_destination: 'Select Destination',
        p_forename: '',
        p_addressone: '',
        p_addresstwo: '',
        p_city: 'Select City',
        p_state: 'Select State',
        p_country: 'Select Country',
        p_postcode: '',
        deliverymethod: 'Select Delivery Method',
        seafreight: 'N/A',
        airfreight: 'N/A',
        items: '',
        items_desc: '',
        amount: '',
        r_email: '',
        s_destination: 'Kenya',
        weight: '',
        s_contact:'<?php echo $_SESSION['contactnumber'] ?>'

      };
    },
    methods: {
      ShowSender() {
        document.getElementById('sender-info').style.display = 'block';
        document.getElementById('receiver-info').style.display = 'none';
        document.getElementById('pickup-info').style.display = 'none';
        document.getElementById('other-info').style.display = 'none';
      },
      ShowReceiver() {
        document.getElementById('sender-info').style.display = 'none';
        document.getElementById('receiver-info').style.display = 'block';
        document.getElementById('pickup-info').style.display = 'none';
        document.getElementById('other-info').style.display = 'none';
      },
      ShowPickUp() {
        document.getElementById('receiver-info').style.display = 'none';
        document.getElementById('pickup-info').style.display = 'block';
        document.getElementById('sender-info').style.display = 'none';
        document.getElementById('other-info').style.display = 'none';

      },
      ShowOtherInfo() {
        document.getElementById('receiver-info').style.display = 'none';
        document.getElementById('pickup-info').style.display = 'none';
        document.getElementById('sender-info').style.display = 'none';
        document.getElementById('other-info').style.display = 'block';

      },
      SameChecker(event) {
        console.log(event.target.checked);
        var optionval = event.target.checked;
        if (optionval == true) {
          this.p_forename = this.s_forename;
        this.p_destination = this.s_destination;
        this.p_addressone = this.s_addressone;
        this.p_addresstwo = this.s_addresstwo;
        this.p_city= this.s_city;
        this.p_state = this.s_state;
        this.p_country = this.s_country;
        this.p_postcode = this.s_postcode;
        } else {
        this.p_destination = 'Kenya';
        this.p_addressone = '';
        this.p_addresstwo = '';
        this.p_city= 'Select City';
        this.p_state = 'Select State';
        this.p_country = 'Select Country';
        this.p_postcode = '';
        this.p_forename =''
        }
      },
      CheckDelivery(event) {
        console.log(event.target.value);
        var optionval = event.target.value;
        if (optionval == 'sea_freight') {
          document.getElementById('seafreightoption').removeAttribute('disabled');
        } else if (optionval == 'air_freight') {
          document.getElementById('airfreightoption').removeAttribute('disabled');
        } else {
          document.getElementById('seafreightoption').disabled = true;
          document.getElementById('airfreightoption').disabled = true;
        }
      },
      Login() {
        if (this.email == "") {
          Notiflix.Report.Failure(
            'Error',
            '"Email can not be empty"',
            'Okay',
          );
        } else if (this.password == "") {
          Notiflix.Report.Failure(
            'Error',
            '"Password can not be empty"',
            'Okay',
          );
        } else {

          this.SendToServer();
        }
      },
      SendToServer() {

        var bodyFormData = new FormData();
        bodyFormData.append('id', this.id);
        bodyFormData.append('s_forename', this.s_forename);
        bodyFormData.append('s_addressone', this.s_addressone);
        bodyFormData.append('s_addresstwo', this.s_addresstwo);
        bodyFormData.append('s_city', this.s_city);
        bodyFormData.append('s_state', this.s_state);
        bodyFormData.append('s_country', this.s_country);
        bodyFormData.append('s_postcode', this.s_postcode);
        bodyFormData.append('s_email', this.s_email);
        bodyFormData.append('r_forename', this.r_forename);
        bodyFormData.append('r_contact', this.r_contact);
        bodyFormData.append('r_addressone', this.r_addressone);
        bodyFormData.append('r_addresstwo', this.r_addresstwo);
        bodyFormData.append('r_city', this.r_city);
        bodyFormData.append('r_state', this.r_state);
        bodyFormData.append('r_country', this.r_country);
        bodyFormData.append('r_postcode', this.r_postcode);
        bodyFormData.append('p_destination', this.p_destination);
        bodyFormData.append('p_forename', this.p_forename);
        bodyFormData.append('p_addressone', this.p_addressone);
        bodyFormData.append('p_addresstwo', this.p_addresstwo);
        bodyFormData.append('p_city', this.p_city);
        bodyFormData.append('p_state', this.p_state);
        bodyFormData.append('p_country', this.p_country);
        bodyFormData.append('p_postcode', this.p_postcode);
        bodyFormData.append('deliverymethod', this.deliverymethod);
        bodyFormData.append('seafreight', this.seafreight);
        bodyFormData.append('airfreight', this.airfreight);
        bodyFormData.append('items', this.items);
        bodyFormData.append('items_desc', this.items_desc);
        bodyFormData.append('amount', this.amount);
        bodyFormData.append('r_email', this.r_email);
        bodyFormData.append('s_destination', this.s_destination);
        bodyFormData.append('weight', this.weight);
        bodyFormData.append('s_contact', this.s_contact);
        


        axios({
            method: "post",
            url: "../../api/order/edit_order_api.php",
            data: bodyFormData,
          })
          .then(function(response) {
            console.log(response.data.code);
            if (response.data.code == 1) {
              Notiflix.Report.Success(
                'Success',
                '"Order Updated Successfully"',
                'Close',
              );
              setTimeout(function() {
                window.location.href = 'summary?order_id='+app.id;
              }, 2000); //run this after 3 seconds

            } else {
              Notiflix.Report.Failure(
                'Error',
                response.data.message,
                'Close',
              );
            }

            console.log(response.data);
          })
          .catch(function(response) {
            //handle error
            console.log(response);
          });
      },
      Send() {
        axios.get('../../api/order/view_order_by_id_api.php?id=' + this.id).then(response => {
          if (response.data.code == 0) {
            Notiflix.Report.Failure(
              'Error',
              '"Order does not Exist"',
              'Close',
            );
          } else {
            this.s_forename = response.data[0].sender_forename;
            this.s_addressone = response.data[0].sender_addresslineone;
            this.s_contact = response.data[0].pickup_contact;
            this.s_email = response.data[0].sender_email;
            this.r_email = response.data[0].receiver_email;
            this.r_forename = response.data[0].receiver_forename;
            this.r_addressone = response.data[0].receiver_addresslineone;
            this.r_contact = response.data[0].receiver_contact;
            this.r_city = response.data[0].receiver_city;
            this.r_state = response.data[0].receiver_state;
            this.r_country = response.data[0].receiver_country;
            this.p_forename = response.data[0].pickup_forename;
            this.p_addressone = response.data[0].pickup_addresslineone;
            this.p_contact = response.data[0].pickup_contact;
            this.p_city = response.data[0].pickup_city;
            this.p_state = response.data[0].pickup_state;
            this.p_country = response.data[0].pickup_country;
            this.p_destination = response.data[0].pickup_destination;
         //   this.created = response.data[0].created;
            this.items = response.data[0].items;
            this.items_desc = response.data[0].description;
            this.deliverymethod = response.data[0].delivery_method;
            this.weight = response.data[0].weight;
            this.amount = response.data[0].amount;
            this.seafreight = response.data[0].seafreight;
            this.airfreight = response.data[0].airfreight;
            this.deliverymethod = response.data[0].delivery_method;
            this.weight = response.data[0].weight;
            this.items = response.data[0].items;
            this.items_desc = response.data[0].description;

            console.log(response.data[0]);
          }
          //this.order_arr = response.data;

        })
      }
    },
    mounted() {
      this.Send();

    },

  });
</script>
<?php
require __DIR__ . '../../../partials/footer.php';
?>