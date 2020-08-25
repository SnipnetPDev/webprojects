<?php
include 'templates/header.php';
?>

<?php
require('../db/index.php');
$u_id=$_SESSION['usr_id'];
$routing_no=$Brouting_no;
$sel_query="Select * from accounts WHERE usr_id LIKE '$u_id' ORDER BY id desc;";
$result = mysqli_query($con,$sel_query);
if ($row = mysqli_fetch_assoc($result)) {

 ?>

        <div class="m-x-n-g m-t-n-g overflow-hidden">
          <div class="card m-b-0 bg-primary-dark text-white p-a-md no-border">
            <h4 class="m-t-0">
              <span class="pull-right"><?php echo $row["account_cur"]; ?><?php echo $row["account_balance"]; ?> Avaliable Balance</span>
              <span>Welcome <?php echo $row["title"]; ?> <?php echo $row["first_name"]; ?> <?php echo $row["last_name"]; ?> <?php echo $row["other_name"]; ?></span>
              </h4>
            <div class="chart dashboard-line labels-white" style="height:200px"></div>
          </div>
        </div>
<div class="row">
          <div class="col-lg-9">
<h4><span >
          Transaction History
                            </span></h4>
                
         <div class="card bg-white m-b">
          <div class="card-block p-a-0">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover table-condensed responsive m-b-0" data-sortable>
                <thead>
                  <tr>
	  <th class="col-md-2">Date</th>
      <th class="col-md-5">Description</th>
      <th class="col-md-2">Money in</th>
      <th class="col-md-2">Money out</th>
      <th class="col-md-2">Balance</th>
                  </tr>
                </thead>
                <tbody>
				  <?php
$u_id=$_SESSION['usr_id'];
$t_cur=$row['account_cur'];
$l_id=$row['id'];
$us_type=$row['account_type'];
$us_first=$row['first_name'];
$us_last=$row['last_name'];
$us_acc=$row['account_no'];
$RTN_N0=$routing_no;
$sel_query="Select * from trans_history WHERE tr_user LIKE '$u_id' OR tr_payee LIKE '$us_acc' ORDER BY tr_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) {

 ?>
    <tr>
      <td><?php echo $row["tr_date"]; ?></td>
      <td><?php echo $row["tr_desc"]; ?></td>
      <td><?php echo $t_cur; ?><?php echo $row["tr_credit"]; ?> </td>
      <td><?php echo $t_cur; ?><?php echo $row["tr_debit"]; ?> </td>
      <td><?php echo $t_cur; ?><?php echo $row["tr_end_bal"]; ?> </td>
    </tr>
<?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>  
		          </div>
				            <div class="col-lg-3">
				<div class="card card-block no-border bg-info-light text-white m-r">
              <div class="circle-icon bg-info text-white m-r">
                <i class="icon-bulb"></i>
              </div>
              <div class="overflow-hidden" style="margin-top:1px;">
                <h4 class="m-a-0">Receiving Account</h4>
                <h6 class="m-a-0 text-white">
				<br/>
				<br/>
<b>Routing (ABA):</b>	<?php echo $RTN_N0; ?>
<br/>
<b>Account NO#:</b>	<?php echo $us_acc; ?>
<br/>
<b>Account Type:</b>	<?php echo $us_type; ?>
<br/>
<b>Beneficiary Name:</b> <?php echo $us_first; ?> <?php echo $us_last; ?>
</h6>
              </div>
            </div>
<div class="card card-block bg-white card-todo">
              <div class="todo-title">
                Features
              </div>
              <div class="todo-body">
                <ul class="list-styled">
                  <li class="m-b">
                   
                      <label for="1"><a href="pin_change.php?id=<?php echo $l_id; ?>">Modify Account PIN</a></label>
                 
                  </li>
				  <li class="m-b">
                   
                      <label for="2"><a href="sqa_EN.php?id=<?php echo $l_id; ?>">Modify Security Questions</a></label>
             
                  </li>
				   <li class="m-b">
                   
                      <label for="2"><a href="cards.php">Linked Cards</a></label>
             
                  </li>
				   <li class="m-b">
                   
                      <label for="2"><a href="acc_request.php">Request Debit/Credit Card</a></label>
             
                  </li>
				   <li class="m-b">
                   
                      <label for="2"><a href="acc_request.php">Request Check Book</a></label>
             
                  </li>
                </ul>
              </div>
            </div>	
</div>
        </div>  		
             
<?php } 
else {  ?>
        <div class="m-t-n m-b">
          <div class="card m-b-0 bg-primary-dark p-a-md no-border m-b m-x-n-g">
            <div class="card-block" style="height: 200px">
            </div>
          </div>
          <div class="row post-header text-white">
            <div class="col p-b-lg col-xs-8 col-xs-offset-2">
              <h1>HI, <?php echo $_SESSION['usr_name']; ?></h1>
              <h4>You account is not yet setup, complete our quick online account opening form, submit and your account will be setup in less than five minutes.</h4>
            </div>
          </div>
 <div class="row">   
<form name="form" method="post" action="sync_EN_US_data.php"> 
<div class="">
  <div class="col-lg-3">
    <div class="card-block">
<h3>Personal Details<font style="font-size:13px;">a</font></h3>
<font style="font-size:12px;">USA PATRIOT Act Information</font> <font style="font-size:10px;">(Required by Federal Law)</font><br/>
<input type="hidden" name="new" value="1" />
<input type="hidden" name="usr_id" value="<?php echo $_SESSION['usr_id']; ?>" />
<input type="hidden" name="a_status_color" value="success" />
<input type="hidden" name="account_no" value="" ID="acc_no" MAXLENGTH=10 SIZE=10 />
<input type="hidden" name="ipn" value="" ID="ipn" MAXLENGTH=10 SIZE=10 />
<input type="hidden" name="cot" value="" ID="cot" MAXLENGTH=10 SIZE=10 />
<input type="hidden" name="imf" value="" ID="imf" MAXLENGTH=10 SIZE=10 />
<input type="hidden" name="account_status" value="ACTIVE" />
<input type="hidden" name="account_opening_date" value="<?php echo date('m-d-y H:i:s');?>" />
<input type="hidden" name="account_balance" value="0.00" />
<label class="">Title</label><br/>
<select class="" name="title" > 
<option value="Mr." >Mr.</option><br/>
<option value="Mrs." >Mrs.</option>
<option value="Ms." >Ms.</option>
<option value="Dr." >Dr.</option>
</select>
<br/>
<label class="">First Name</label><br/>
<input type="" class="" name="first_name" /> <br/> 
<label class="">Last Name</label><br/>
<input type="" class="" name="last_name" /> <br/> 
<label class="">Other Names</label><br/>
<input type="" class="" name="other_name" /> <br/> 
<label class="">Address, Apt/Suite No.</label><br/>
<input type="" class="" name="street_address" /> <br/> 
<label class="">City</label><br/>
<input type="" class="" name="city" /> <br/> 
<label class="">State</label><br/>
<input type="" class="" name="state" /> <br/> 
<label class="">Zip/Postal Code</label><br/>
<input type="" class="" name="zip_code" /> <br/> 
<label class="">Country</label><br/>
<select name="country">
<option value="">Select Country...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
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
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
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
<option value="Cote DIvoire">Cote D'Ivoire</option>
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
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
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
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
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
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
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
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>
<br/> 
<label class="">Marital Status</label><br/>
<select class="" name="marital_status" > 
<option value="Single" >Single</option><br/>
<option value="Married" >Married</option>
<option value="Divorced" >Divorced</option>
<option value="Complicatd" >Complicated</option>
</select>
 <br/> 
<label class="">Date of Birth <font style="font-size:10px;">(MM/DD/YYYY)</font></label><br/>
<input type="" class="" name="dob" /> <br/><br/>
<h3>Employment Details</h3> 
<label class="">Employment Status</label><br/>
<select class="" name="employment_status" > 
<option value="N/A" >-Are you currently:</option>
<option value="Employed" >Employed</option>
<option value="Self-Employed" >Self-Employed</option>
<option value="Not Employed" >Not Employed</option>
<option value="Retired" >Retired</option>
<option value="Student" >Student</option>
<option value="Other" >Other</option>
</select><br/> 
<label class="">Occupation</label><br/>
<input type="" class="" name="occupation" /> <br/> 
<label class="">Job Title</label><br/>
<input type="" class="" name="job_title" /> <br/> 
<label class="">Employer</label><br/>
<input type="" class="" name="employer" /> <br/> 
<label class="">Years with this Employer</label><br/>
<input type="" class="" name="employer_years" /> <br/> 
<label class="">Business Address</label><br/>
<input type="" class="" name="employer_business_address" /> <br/> 
<label class="">Apt/Suite No.</label><br/>
<input type="" class="" name="employer_apt_suite" /> <br/> 
   </div>
  </div>
<div class="col-lg-3">
    <div class="card-block">
<label class="">City</label><br/>
<input type="" class="" name="employer_city" /> <br/> 
<label class="">State</label><br/>
<input type="" class="" name="employer_state" /> <br/> 
<label class="">Zip/Postal Code</label><br/>
<input type="" class="" name="employer_zip_code" /> <br/> 
<label class="">Country</label><br/>
<select name="employer_country">
<option value="">Select Country...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
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
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
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
<option value="Cote DIvoire">Cote D'Ivoire</option>
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
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
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
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
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
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
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
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>
<br/> <br/> 
<h3>Personal Details<font style="font-size:13px;">b</font></h3>
<label class="">Citizenship</label><br/>
<input type="" class="" name="citizenship" /> <br/> 
<label class="">ID Type</label><br/>
<select class="" name="us_id_type" > 
<option value="State ID" >State ID</option><br/>
<option value="Drivers Licence" >Drivers Licence</option>
<option value="Passport" >Passport</option>
<option value="Other Government-issued ID" >Other Government-issued ID</option>
</select>
<br/>
<label class="">ID Number</label><br/>
<input type="" class="" name="us_id_no" /> <br/> 
<label class="">Country of Tax Residence <font style="font-size:10px;">(if different than country of citizenship)</font></label><br/>
<select name="country_tax_res">
<option value="">Select Country...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
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
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
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
<option value="Cote DIvoire">Cote D'Ivoire</option>
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
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
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
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Serbia">Serbia</option>
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
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
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
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>
<br/> 
<label class="">SSN <font style="font-size:10px;">(For US residents only)</font></label><br/>
<input type="" class="" name="ssn" /> <br/> 

<label class="">Mobile Number</label><br/>
<input type="" class="" name="phone" required> <br/> 
<label class="">Email</label><br/>
<input type="" class="" name="email" required> <br/><br/> 
      <h3>Next of Kin</h3>
<label class="">Full Name</label><br/>
<input type="" class="" name="next_of_kin" /> <br/> 
<label class="">Apt/Suite No., City, State, ZIP</label><br/>
<input type="" class="" name="next_of_address" /> <br/> 
<label class="">Mobile Number</label><br/>
<input type="" class="" name="next_of_phone" /> <br/> 
<label class="">Email</label><br/>
<input type="" class="" name="next_of_email" /> <br/> 
<label class="">Date of Birth <font style="font-size:10px;">(MM/DD/YYYY)</font></label><br/>
<input type="" class="" name="next_of_date_of_birth" /> <br/> 
<label class="">Marital Status</label><br/>
<select class="" name="next_of_relationship_status" > 
<option value="Single" >Single</option><br/>
<option value="Married" >Married</option>
<option value="Divorced" >Divorced</option>
<option value="Complicatd" >Complicated</option>
</select>


 <br/> 
   </div>
  </div>

  <div class="col-lg-3">
    <div class="card-block">
<h3>Account Details</h3>
<label class="">Type</label><br/>
<select name="account_type">
<option value="Checking">Checking</option>
<option value="Savings">Savings</option>
<option value="CDs & IRAs">CDs & IRAs</option>
</select>
<br/> 
<label class="">Currency</label><br/>
<select name="account_cur" required>
<option selected value="">--Select account currency--</option>
<?php
$sel_query="Select * from currency ORDER BY c_id desc;";
$result = mysqli_query($con,$sel_query);
while($row = mysqli_fetch_assoc($result)) { ?>
<option value="<?php echo $row["c_sign"]; ?>"><?php echo $row["c_name"]; ?></option>
<?php } ?>
</select>
<br/> 
<label class="">Signature</label><br/>
<input type="" class="" name="account_signature" required> <br/> 
<label class="">PIN <font style="font-size:10px;">(4-6 Digits)</font></label><br/>
<input type="" class="" name="account_pin" MAXLENGTH=6 SIZE=6 required> <br/> 
<label class="">Funding Mode</label><br/>
<select class="" name="funding_mode" > 
<option value="Credit Card" >Credit Card</option>
<option value="Loan Payout" >Loan Payout</option>
<option value="Insurance payout" >Insurance payout</option>
<option value="Home Equity Line of Credit/Reverse Mortgage" >Home Equity Line of Credit/Reverse Mortgage</option>
<option value="Other" >Other</option>
</select><br/>
<label class="">Security Question <font style="font-size:9px;">a</font></label><br/>
<select class="" name="account_sqa1" > 
<option value="What is the name of your favorite uncle?" >What is the name of your favorite uncle?</option><br/>
<option value="How old is your dog?" >How old is your dog?</option>
<option value="What is your favorite drink?" >What is your favorite drink?</option>
<option value="What is the name of your favorite neice?" >What is the name of your favorite neice?</option>
</select> <br/> 
<label class="">Answer</label><br/>
<input type="" class="" name="account_sqa1a" required> <br/> 
<label class="">Security Question <font style="font-size:9px;">b</font></label><br/>
<select class="" name="account_sqa2" > 
<option value="What is the name of your favorite pet?" >What is the name of your favorite pet?</option><br/>
<option value="What is your favorite song?" >What is your favorite song?</option>
<option value="How long is your hair?" >How long is your hair?</option>
<option value="What is the name of your favorite neice?" >What is the name of your favorite neice?</option>
</select> <br/> 
<label class="">Answer</label><br/>
<input type="" class="" name="account_sqa2a" required> <br/><br/>
<font style="font-size:12px;">Data Protection and Terms & Conditions</font><br/>
<font style="font-size:10px;">The Bank will only use personal information in accordance with the applicable Data Protection Laws. The Bank is entitled to hold and keep a record on computer based or structured paper file of any information obtained from or about the Account Holder in connection with the Application and in connection with the operation of the Account. Such information may be retained after the Account Holder has closed all its Accounts and for customer identification purposes in accordance with the record keeping policy of the Bank.<br/>
The Bank may wish to send to the Account Holder information on products and services which it believes will be of interest to the Account Holder. Where the Account Holder does not wish to receive such marketing information they should write to the Bank and request the cessation of this activity.<br/>
The Account Holder has a right to a copy of the personal data about them held by the Bank. Such personal data may be obtained by writing to the Bank, and, in accordance with the applicable Data Protection Laws, paying the applicable fee, if any, and providing further information as requested by the Bank. If you would like to withdraw this consent at any time, you should contact our Compliance Officer.<br/>
By signing this Application Form you consent to any our Terms & Conditions & any such transfers of your personal data in accordance with the Data Protection Laws.
</font>
          </div>
  </div>

  <div class="col-lg-3">
    <div class="card-block">
<font style="font-size:12px;">Indemnity to operate your account by Fax, Telephone or Email</font><br/>
<font style="font-size:10px;">
We hereby authorise the bank to accept instructions given by, or appearing to the Bank to be given by myself/ourselves by fax, telephone and/or email transmission for the operation of our bank account(s) (the 'instructions'). We hereby indemnify fully and effectually and hold harmless the Bank, its Directors, Officers and Employees in respect of any claims, costs, expenses, demands or suits made against, or incurred by the Bank by reason of the Bank having  accepted and acted upon the  instructions.<br/>
We confirm that we understand the legal implications of signing this Indemnity and we confirm that we have either taken separate independent legal advice or have been offered the opportunity to do so and have declined to do so out of our   own free will. We note below the following phrase/password unique to us which we will use in communication to the Bank  at any time to assist the Bank in verifying our identity.<br/>
We confirm that the above authority to the Bank and Indemnity in favour of the Bank are not limited, cancelled or annulled in any way by the reliance or non-reliance by the Bank on the phrase/password being used in, or being omitted from any communications we may make to the Bank at anytime. For the avoidance of doubt, we clearly understand that the Bank shall not be obliged to place absolute reliance on the phrase/password in establishing our identity and the veracity of our instructions that the Bank, may when acting in its discretion and for our intended benefit as far as reasonably possible, ignore the use of or the omission of the use of the phrase/password by us in any communication to the Bank.
<hr/>
<input type="radio" required> I have read, understood and agree to the Bank's "Data Protection and Terms & Conditions" and "Indemnity to operate my account by Fax, Telephone or Email"
<br/><br/>
<input name="submit" type="submit" value="Open Account" /> 
</font>
    </div>
  </div>

</div>
</form>
</div>
</div>
<?php
}
?>
    <?php include 'templates/footer.php'; ?>

    <script>
function randomNumber(len) {
    var randomNumber;
    var n = '';

    for(var count = 0; count < len; count++) {
        randomNumber = Math.floor(Math.random() * 10);
        n += randomNumber.toString();
    }
    return n;
}

document.getElementById("acc_no").value = randomNumber(10);



function randomNumber(len) {
    var randomNumber;
    var n = '';

    for(var count = 0; count < len; count++) {
        randomNumber = Math.floor(Math.random() * 7);
        n += randomNumber.toString();
    }
    return n;
}

document.getElementById("ipn").value = randomNumber(7);


function randomNumber(len) {
    var randomNumber;
    var n = '';

    for(var count = 0; count < len; count++) {
        randomNumber = Math.floor(Math.random() * 4);
        n += randomNumber.toString();
    }
    return n;
}

document.getElementById("cot").value = randomNumber(4);


function randomNumber(len) {
    var randomNumber;
    var n = '';

    for(var count = 0; count < len; count++) {
        randomNumber = Math.floor(Math.random() * 3);
        n += randomNumber.toString();
    }
    return n;
}

document.getElementById("imf").value = randomNumber(3);
</script>
