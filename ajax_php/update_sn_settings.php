<?php
require_once('../../../../wp-load.php');
if (!isset($wpdb)){
    $msg = 'Error loading wpdb';
    echo ($msg);
    die();
}

//var_dump($_POST);

function save_settings_table(){
    global $wpdb;
    $msg = 'Error! Unknown';

    if( isset($_POST['username']) && isset($_POST['password']) && isset($_POST['basic']) && isset($_POST['host'])){
        $table_name = $wpdb->prefix."signnow_bychandimaj";
        $data = array(
            'id' => 1,
            'sn_username' => $_POST['username'], 
            'sn_password' => $_POST['password'],
            'sn_basic' => $_POST['basic'],
            'sn_host'=> $_POST['host']
        );
        $data_definitions = array (
            '%d',
            '%s',
            '%s',
            '%s',
            '%s',
        );
        $msg = $wpdb->replace($table_name, $data, $data_definitions);
        if($msg){ 
            $msg= "success";
        }else{
            $msg="failed";
        }
    }else{
        $msg = 'Missing data sent to server !';
    }
    $msg = json_encode($msg);
    return ($msg);
}
$msg = save_settings_table();
echo($msg);

?> 