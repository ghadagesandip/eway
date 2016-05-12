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
    'FirstName' => 'Nishad',
    'LastName' => 'Kanade',
    'CompanyName' => '',
    'JobDescription' => '',
    'Street1' => 'chinchpokli',
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
    'RedirectUrl' => "http://www.eway.com.au",
    'CancelUrl' => "http://www.eway.com.au",
    'TransactionType' => \Eway\Rapid\Enum\TransactionType::MOTO,
];

$response = $client->createCustomer(\Eway\Rapid\Enum\ApiMethod::RESPONSIVE_SHARED, $transaction);

//echo '<pre>'; print_r($response);exit;
$sharedPaymentUrl = null;
$accessCode = null;

if (!$response->getErrors()) {
    $sharedPaymentUrl = $response->SharedPaymentUrl;
     $accessCode = $response->AccessCode;
} else {
    foreach ($response->getErrors() as $error) {
        echo "Error: ".\Eway\Rapid::getMessage($error)."<br>";
    }
}
//F98022oTyqf5hJ3JVkd8uzXwG30GLdNxijdVAZj5UT8sqO8ieHlzuOJRyvTAYGwVII8ACBaMrOJXKZj2TQ-eu7yqC7IuxqEcNdTvnK0I7C2JXdmIro7qsoA_upUXMQ0HvplWRNn_n8o4umT_1BS_KXWOYMQ==



$response = $client->queryTransaction('F98022oTyqf5hJ3JVkd8uzXwG30GLdNxijdVAZj5UT8sqO8ieHlzuOJRyvTAYGwVII8ACBaMrOJXKZj2TQ-eu7yqC7IuxqEcNdTvnK0I7C2JXdmIro7qsoA_upUXMQ0HvplWRNn_n8o4umT_1BS_KXWOYMQ==');
//get customer token ID by callng : $response->Transactions[0]->TokenCustomerID
$response->Customer->TokenCustomerID;



?>
<html>
<head>
    <title>
        Eway Iframe
    </title>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="https://secure.ewaypayments.com/scripts/eCrypt.js"></script>
    <script>

        /**
         * eWAY Rapid IFrame config object. Contains the SharedPaymentUrl
         */
        var eWAYConfig = {
            sharedPaymentUrl: "<?php echo $sharedPaymentUrl;?>"
        };

        /**
         * Example eWAY Rapid IFrame callback
         */
        function resultCallback(result, transactionID, errors) {
            if (result == "Complete") {
                alert("Payment complete! eWAY Transaction ID: " + transactionID);
            } else if (result == "Error") {
                alert("There was a problem completing the payment: " + errors);
            }
        }

    </script>
</head>

<body>
    <button type="button" onClick="eCrypt.showModalPayment(eWAYConfig, resultCallback);">Pay with eWAY</button>
</body>
</html>