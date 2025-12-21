<?php

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://www.web-dream.fr/?edd_action=activate_license&item_name=cle-de-licence-rezo-pc-inline-1-an&license=9227906ed72256eaa30bdefad0e07ef1&url=http://www.web-dream.fr'//,
    //CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

$myArrayReponse = json_decode($resp, true);


echo $resp;
?>