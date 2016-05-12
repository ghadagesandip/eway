<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * Created by PhpStorm.
 * User=> webwerks
 * Date=> 4/5/16
 * Time=> 3=>56 PM
 * @author vipul patel
 */
require_once 'vendor/autoload.php';
require('vendor/autoload.php');
require('lib/eWAY/RapidAPI.php');
// eWAY Credentials
$apiKey = '60CF3ClUauoysKZKwAlX3tv5DcbYT16eVBFfRQxTsgN6rx9cJXE+JQkXT6ktQunuAKN4og';
$apiPassword = 'uPa4PrWZ';
$apiEndpoint = \Eway\Rapid\Client::MODE_SANDBOX;




$client = \Eway\Rapid::createClient($apiKey, $apiPassword, $apiEndpoint);

$transaction = [
    'FirstName' => 'vipul',
    'LastName' => 'patel',
    'Street1' => 'Level 5',
    'Street2' => '369 Queen Street',
    'City' => 'Sydney',
    'State' => 'NSW',
    'PostalCode' => '2000',
    'Country' => 'au',
//    'Payment' => [
//        'TotalAmount' => 0,
//    ],
    'RedirectUrl' => "http://localhost/eway/index.php",
    'TransactionType' => \Eway\Rapid\Enum\TransactionType::MOTO,
];

$response = $client->createCustomer(\Eway\Rapid\Enum\ApiMethod::TRANSPARENT_REDIRECT, $transaction);

echo $response;
if ($response->TransactionStatus) {
    echo 'Payment successful! ID: '.$response->TransactionID;
}
?><br><br><br><br>

<form method="POST" action="<?php echo $response->FormActionURL ?>" id="form1">
    <input type="hidden" name="EWAY_ACCESSCODE" value="<?= $response->AccessCode ?>">

    <style>
        .options li { display: inline-block; padding:10px 0; clear: both; }
        .options img { margin-left:10px; top:10px; }
    </style>
    <div id="paymentoption" style="display: none;">
        <div class="transactioncustomer">
            <div class="header">Select Payment Option</div>
            <ul class="options">
                <li>
                    <label for="payment_option_creditcard">
                        <input id="payment_option_creditcard" value="creditcard" name="EWAY_PAYMENTTYPE" type="radio">
                        <img alt="creditcards" src="../assets/Images/creditcard_master.png">
                        <img alt="creditcards" src="../assets/Images/creditcard_visa.png">
                    </label>
                </li>
                <li>
                    <label for="payment_option_paypal">
                        <input id="payment_option_paypal" value="paypal" name="EWAY_PAYMENTTYPE" type="radio">
                        <img src="../assets/Images/paypal.png"></label>
                </li>
                <li>
                    <label for="payment_option_masterpass">
                        <input id="payment_option_masterpass" value="masterpass" name="EWAY_PAYMENTTYPE" type="radio">
                        <img src="../assets/Images/masterpass.png"></label>
                </li>
            </ul>
        </div>
        <div class="button">
            <br>
            <br>
            <input type="button" value="Continue" onclick="ChoosePaymentOption();">
        </div>
    </div>

    <script>
        function ChoosePaymentOption() {
            if (jQuery("input[name='EWAY_PAYMENTTYPE']:checked").val() != 'creditcard') {
                jQuery('#form1').submit();
            } else {
                jQuery('#paymentoption').hide();
                jQuery('#payment').show();
            }
        }
    </script>

    <div id="payment">
        <div class="transactioncustomer">
            <div class="header">
                Customer Card Details
            </div>
            <div class="fields">
                <label for="EWAY_CARDNAME">
                    Card Holder</label>
                <input type="text" name="EWAY_CARDNAME" id="EWAY_CARDNAME" value="TestUser">
            </div>
            <div class="fields">
                <label for="EWAY_CARDNUMBER">
                    Card Number</label>
                <input type="text" name="EWAY_CARDNUMBER" id="EWAY_CARDNUMBER" value="4444333322221111">
            </div>
            <div class="fields">
                <label for="EWAY_CARDEXPIRYMONTH">
                    Expiry Date</label>
                <select id="EWAY_CARDEXPIRYMONTH" name="EWAY_CARDEXPIRYMONTH">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05" selected="selected">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                /
                <select id="EWAY_CARDEXPIRYYEAR" name="EWAY_CARDEXPIRYYEAR">
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                </select>
            </div>
            <div class="fields">
                <label for="EWAY_CARDSTARTMONTH">
                    Valid From Date</label>
                <select id="EWAY_CARDSTARTMONTH" name="EWAY_CARDSTARTMONTH">
                    <option></option><option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                /
                <select id="EWAY_CARDSTARTYEAR" name="EWAY_CARDSTARTYEAR">
                    <option></option><option value="16">16</option>
                    <option value="15">15</option>
                    <option value="14">14</option>
                    <option value="13">13</option>
                    <option value="12">12</option>
                    <option value="11">11</option>
                    <option value="10">10</option>
                    <option value="09">09</option>
                    <option value="08">08</option>
                    <option value="07">07</option>
                    <option value="06">06</option>
                    <option value="05">05</option>
                </select>
            </div>
            <div class="fields">
                <label for="EWAY_CARDISSUENUMBER">
                    Issue Number</label>
                <input type="text" name="EWAY_CARDISSUENUMBER" id="EWAY_CARDISSUENUMBER" value="22" maxlength="2" style="width:40px;"> <!-- This field is optional but highly recommended -->
            </div>
            <div class="fields">
                <label for="EWAY_CARDCVN">
                    CVN</label>
                <input type="text" name="EWAY_CARDCVN" id="EWAY_CARDCVN" value="123" maxlength="4" style="width:40px;"> <!-- This field is optional but highly recommended -->
            </div>
        </div>
        <div class="button">
            <br>
            <br>
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit">
        </div>
    </div>

</form>
<?php session_start(); print_r($_SESSION) ?>

<script>
    $(document).ready(function(){
//        $("#btnSubmit").click(function(e){
//
//
//            if(true){
//                $.ajax({
//                    type: "POST",
//                    url: $("#form1").attr('action'),
//                    data: $("#form1").serializeArray(),
//                    success: function(data, status, jqxhr){
//                        console.log(data);
//                    },
//                    dataType: 'jsonp'
//                });
//            }
//        })

// Charge Customer by token having firstname vipul lastname patel Token = 912954813176


<?php

$client = \Eway\Rapid::createClient($apiKey, $apiPassword, $apiEndpoint);

$transaction = [
    'Customer' => [
        'TokenCustomerID' => 912954813176,
    ],
    'Payment' => [
        'TotalAmount' => 1000,
    ],
    'TransactionType' => \Eway\Rapid\Enum\TransactionType::RECURRING,
];

$response = $client->createTransaction(\Eway\Rapid\Enum\ApiMethod::DIRECT, $transaction);

echo $response;

