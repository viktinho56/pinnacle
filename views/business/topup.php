<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
                        <h4 class="font-weight-bold  text-left text-dark">Welcome <span id="username"><?php echo $_SESSION['nameofcompany']; ?></span> to your Dashboard</h4>
                        <p class="font-weight-normal mb-2 text-muted"></p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Required *</h4>
                        <form class="form-sample">

                            <div class="row">
                                <div class="col-md-4">
                                    <p class="card-description">
                                        1. Card Details
                                    </p>
                                    <div class="form-group">
                                        <label>Card Number *</label>
                                        <input v-model="cardnumber" type="text" placeholder="xxxx-xxxx-xxxx-xxxx" required class="form-control form-control-md" placeholder="Username" aria-label="Username">
                                    </div>
                                    <div class="form-group">
                                        <label>Name on Card *</label>
                                        <input v-model="cardname" type="text" placeholder="Card Holders Name" required class="form-control form-control-md" placeholder="Username" aria-label="Username">
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Expiry Date *</label>
                                            <input type="text" v-model="expiry" maxlength='5' placeholder="MM/YY" type="text" onkeyup="formatString(event)" required class="form-control form-control-md" placeholder="Username" aria-label="Username">

                                        </div>
                                        <div class="form-group col-6">
                                            <label>Security Code (CVV) *</label>
                                            <input type="text" v-model="cvv" placeholder="000" maxlength='3' required class="form-control form-control-md" placeholder="Username" aria-label="Username">
                                            <p class="card-description">
                                                This is the last 3 digits on the back of your card
                                            </p>
                                        </div>
                                        <div class="form-group col-12">
                                        <label>Amount *</label>
                                        <input v-model="amount" type="text" placeholder="5000" required class="form-control form-control-md" placeholder="Username" aria-label="Username">
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <p class="card-description">
                                        2. Card Holders Details
                                    </p>
                                    <div class="form-group">
                                        <label>Billing Address *</label>
                                        <input v-model="billingaddress1" type="text" placeholder="Address 1" required class="form-control form-control-md" placeholder="Username" aria-label="Username">
                                    </div>
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" v-model="cardholdername" placeholder="Card Holders Name" required class="form-control form-control-md" placeholder="Username" aria-label="Username">
                                    </div>
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select style="height:55px !important;" v-model="country" name="country" class="form-control form-control-md" id="exampleFormControlSelect2">
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


                                </div>
                                <div class="col-md-4">
                                    <p style="visibility:hidden" class="card-description">
                                        2. Card Holders Details
                                    </p>
                                    <div class="form-group">
                                        <label>Billing Address </label>
                                        <input type="text" v-model="billingaddress2" placeholder="Address 2" class="form-control form-control-md" placeholder="Username" aria-label="Username">
                                    </div>
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" v-model="state" placeholder="State" class="form-control form-control-md" placeholder="Username" aria-label="Username">
                                    </div>
                                    <div class="form-group">
                                        <label>Post Code</label>
                                        <input type="text" v-model="postcode" placeholder="Enter Postal Code If Available" class="form-control form-control-md" placeholder="Username" aria-label="Username">

                                    </div>


                                </div>

                                <div class="col-12 mx-auto grid-margin mb-4 mb-xl-0">

                                    <center>
                                        <button @click="SendToServer()" type="button" style='width:250px;' class="btn btn-sm btn-success mr-2">Pay</button>
                                        <br /><br />
                                        <p><img src='../../public/images/secflut.png' /></p>
                                    </center>
                                </div>


                            </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<script>
    function formatString(e) {
        var inputChar = String.fromCharCode(event.keyCode);
        var code = event.keyCode;
        var allowedKeys = [8];
        if (allowedKeys.indexOf(code) !== -1) {
            return;
        }

        event.target.value = event.target.value.replace(
            /^([1-9]\/|[2-9])$/g, '0$1/' // 3 > 03/
        ).replace(
            /^(0[1-9]|1[0-2])$/g, '$1/' // 11 > 11/
        ).replace(
            /^([0-1])([3-9])$/g, '0$1/$2' // 13 > 01/3
        ).replace(
            /^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2' // 141 > 01/41
        ).replace(
            /^([0]+)\/|[0]+$/g, '0' // 0/ > 0 and 00 > 0
        ).replace(
            /[^\d\/]|^[\/]*$/g, '' // To allow only digits and `/`
        ).replace(
            /\/\//g, '/' // Prevent entering more than 1 `/`
        );
    }
</script>
<script>
    var app = new Vue({
        el: '.full-panel',
        data() {
            return {
                cardnumber: '',
                billingaddress1: '',
                billingaddress2: '',
                city: '',
                state: '',
                country: 'Select Country',
                postcode: '',
                cvv: '',
                cardname: '',
                cardholdername: '',
                expiry: '',
                amount: '',
                order: '',
                cardpin: '',
                otp: '',
                email: '<?php echo $_SESSION['email'] ?>',
                id: '<?php echo $_SESSION['businessid'] ?>',
                contact: '<?php echo $_SESSION['contactnumber'] ?>',
                currency: 'NGN',
                payee: '<?php echo $_SESSION['nameofcompany'] ?>'


            };
        },
        methods: {
            ShowSenderOtp() {

            },
            ShowPin() {

            },
            Validate() {
                if (this.email == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Email can not be empty"',
                        'Okay',
                    );
                } else if (this.cardnumber == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Card number can not be empty"',
                        'Okay',
                    );
                } else if (this.cardname == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Card name can not be empty"',
                        'Okay',
                    );
                } else if (this.cvv == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Card cvv can not be empty"',
                        'Okay',
                    );
                } else if (this.expiry == "") {
                    Notiflix.Report.Failure(
                        'Error',
                        '"Card expory details can not be empty"',
                        'Okay',
                    );
                } else {
                    // Notiflix.Loading.Hourglass('Processing');
                    // this.SendToServer();
                }
            },
            SendToServer() {
                Notiflix.Loading.Hourglass('Processing');
                var bodyFormData = new FormData();
                bodyFormData.append('cardnumber', this.cardnumber);
                bodyFormData.append('cardname', this.cardname);
                bodyFormData.append('cvv', this.cvv);
                bodyFormData.append('expiry', this.expiry);
                bodyFormData.append('currency', this.currency);
                bodyFormData.append('amount', this.amount);
                bodyFormData.append('phone', this.contact);
                bodyFormData.append('email', this.email);
                bodyFormData.append('payee', this.payee);
                bodyFormData.append('currency', 'NGN');


                axios({
                        method: "post",
                        url: "../../flutterwave/card-payment.php",
                        data: bodyFormData,
                    })
                    .then(function(response) {
                        console.log(response);
                        if (response.data.status == "success") {
                           // Notiflix.Loading.Remove();
                           /* Notiflix.Report.Success(
                                'Success',
                                '"Payment Successfull"',
                                'Close',
                            );
                            */
                            setTimeout(function() {
                                app.SendTransactionToServer();
                                       }, 1000); //run this after 3 seconds

                        } else {
                            Notiflix.Loading.Remove();
                            Notiflix.Report.Failure(
                                'Error',
                                'Payment UnSuccessful',
                                'Try Again',
                            );
                        }

                        console.log(response.data.status);
                    })
                    .catch(function(response) {
                        //handle error
                        console.log(response);
                    });
            },
            SendTransactionToServer() {

var bodyFormData = new FormData();
bodyFormData.append('businessid', this.id);
bodyFormData.append('type', 'Card Top Up Transaction');
bodyFormData.append('amount', this.amount);
axios({
        method: "post",
        url: "../../api/transaction/create_api.php",
        data: bodyFormData,
    })
    .then(function(response) {
        console.log(response.data.code);
        if (response.data.code == 1) {
            Notiflix.Loading.Remove();
            Notiflix.Report.Success(
                'Success',
                '"Payment  Successfull"',
                'Close',
            );
            setTimeout(function() {
                 window.location.href = 'wallet';
            }, 1000); //run this after 3 seconds

        } else {
            Notiflix.Loading.Remove();
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
}
        },
        mounted() {


        },

    });
</script>
<?php
require __DIR__ . '../../../partials/footer.php';
?>