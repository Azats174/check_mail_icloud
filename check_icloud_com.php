<?php 
//API Url
$email = "nikolas@icloud.com";
//$email= "qwqwqwqwqwqwqwqwqwqwqwqwqwswewe@icloud.com";
check_email_exists($email);

function check_email_exists($email, &$output = null)
{
 list($email_name, $email_domain) = explode('@', $email);

 switch ($email_domain)
 {
  case "icloud.com":
$url = "https://forgot.apple.com/password/verify/appleid"; 
//Initiate cURL.
$ch = curl_init($url);
 
//The JSON data.
$jsonData = array(
    'id' => $email,
);
$customHeaders = array('Content-Type: application/json',
                        'X-Requested-With:XMLHttpRequest',
                        'Accept:application/json, text/javascript, */*; q=0.01',
                        'Origin : https://iforgot.apple.com',
                          );
 
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
 
//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, true);
 
//Attach our encoded JSON string to the POST fields.
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
 
//Set the content type to application/json
//curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 0);
curl_setopt($ch, CURLOPT_PROXY, ':8888');
curl_setopt($ch, CURLOPT_HTTPHEADER, $customHeaders );
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/52.0.2743.116 Chrome/52.0.2743.116 Safari/537.36');
curl_setopt($ch,CURLOPT_REFERER, 'Referer : https://iforgot.apple.com/password/verify/appleid?r=1&language=US-EN');
//compressed content
curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
//возврата результата передачи в качестве строки
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//для следования любому заголовку "Location: ", 
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
// для автоматической установки поля Referer: в запросах, перенаправленных заголовком Location:
curl_setopt($ch, CURLOPT_AUTOREFERER, true);
//curl_setopt($ch, CURLOPT_VERBOSE, true);
//curl_setopt($ch, CURLOPT_AUTOREFERER, true);
//curl_setopt($ch, CURLOPT_AUTOREFERER, true); 
//Execute the request
$result = curl_exec($ch);
curl_close($ch);
var_dump($result);
$result2 = json_decode($result);
var_dump($result2);


if (isset($result2->paidAccount)) {
    if( $result2->paidAccount == false) {
        echo "0";
        break;
    } 
}

if (empty($result2)) { 
    echo "1";
  } 
  else { 
  echo "NULL";
  }
}
}
?>
















