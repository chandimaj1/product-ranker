<?php
require_once('../../../../wp-load.php'); // Get WP Functions (to load $wpdb)

//var_dump($_POST);

$sn_settings = (object) array(
            'sn_username' => $_POST['username'], 
            'sn_password' => $_POST['password'],
            'sn_basic' => $_POST['basic'],
            'sn_host'=> $_POST['host']
);

$msg = 'fail';

function get_sn_bearer($sn_settings){
    global $wpdb;
    $msg = "fail";

    //CURL to fetch bearer token
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => $sn_settings->sn_host.'/oauth2/token',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => array(
        'username' => $sn_settings->sn_username,
        'password' => $sn_settings->sn_password,
        'grant_type' => 'password',
        'scope' => '*'),
    CURLOPT_HTTPHEADER => array(
        "Authorization: Basic $sn_settings->sn_basic"
    ),
    ));

    $response = curl_exec($curl);
    $bearer = 'not_set';
    $refresh = 'not_set';
    //var_dump($response);
    $response = json_decode($response);
    
    if(!isset($response->error)){    
        $bearer = $response->access_token;
        $refresh = $response->refresh_token;
    }else{
        $bearer = 'not_set';
        $msg .= ": ".$response->error;
    }
    curl_close($curl);

    //Saving data to table
    if(!$bearer || $bearer=='not_set'){
        $bearer = 'not_set';
    }else{
        $table_name = $wpdb->prefix."signnow_bychandimaj";
        $data = array(
            'sn_bearer' => $bearer, 
            'sn_refresh' => $refresh,
        );
        $data_definitions = array (
            '%s',
            '%s',
        );
        $where = array(
            'id' => 1,
        );
        $where_definitions = array(
            '%d',
        );

        $msg = $wpdb->update( $table_name, $data, $where, $data_definitions, $where_definitions );

        if($msg){ 
            $msg= "success";
        }else{
            $msg="failed";
        }
    }

    return $msg;
}

$msg = get_sn_bearer($sn_settings);
echo($msg);
?>