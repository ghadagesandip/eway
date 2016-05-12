<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'vendor/autoload.php';
//require('lib/eWAY/RapidAPI.php');

// eWAY Credentials
$apiKey = '60CF3ClUauoysKZKwAlX3tv5DcbYT16eVBFfRQxTsgN6rx9cJXE+JQkXT6ktQunuAKN4og';
$apiPassword = 'uPa4PrWZ';
$apiEndpoint = \Eway\Rapid\Client::MODE_SANDBOX;

$client = \Eway\Rapid::createClient($apiKey, $apiPassword, $apiEndpoint);

$transaction = [
    'TokenCustomerID' => '',
    'Reference' => '',
    'Title' => '',
    'FirstName' => 'Vijay',
    'LastName' => 'Patil',
    'CompanyName' => '',
    'JobDescription' => '',
    'Street1' => 'Level 5',
    'Street2' => '369 Queen Street',
    'City' => 'Sydney',
    'State' => 'NSW',
    'PostalCode' => '2000',
    'Country' => 'au', //A two letter ISO 3166-1 alpha-2 code
    'Email' => '',
    'Phone' => '',
    'Mobile' => '',
    'Comments' => '',
    'Fax' => '',
    'Url' => '',  //The customer’s website
    'RedirectUrl' => "http://localhost/eway/index.php",
    'TransactionType' => \Eway\Rapid\Enum\TransactionType::MOTO,
];

$response = $client->createCustomer(\Eway\Rapid\Enum\ApiMethod::TRANSPARENT_REDIRECT, $transaction);



if ( isset($_GET['AccessCode']) ) {
    $AccessCode = $_GET['AccessCode'];

   $data = $client->queryAccessCode($AccessCode);
   echo '<pre>'; print_r($data);exit;
}

?>
<html>
    <head>
        <title>
            Eway test
        </title>
        <script src="bower_components/jquery/dist/jquery.min.js"></script>
    </head>

    <body>

    <form method="POST" action="<?php echo $response->FormActionURL ?>" id="form1">
        <input type="hidden" name="EWAY_ACCESSCODE" value="<?= $response->AccessCode ?>">
        <input type="text" name="EWAY_PAYMENTTYPE" value="creditcard">
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
    </body>
</html>