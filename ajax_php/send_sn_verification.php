
<?php

function create_sn_user(){

    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api-eval.signnow.com/user/verifyemail',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
	"email": "pamuxnj@gmail.com"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic ODE5OTk3ZjgxZmI4MTNhMjdhMzVhYWE4ZjMyN2RmNDQ6NDVmMmE0ZmRlYTUxZTAzZjNmNDAzMTFjM2M3NjI5NzE',
    'Content-Type: application/json'
  ),
));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
}

create_sn_user();
