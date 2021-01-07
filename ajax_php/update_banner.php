<?php
require_once('../../../../wp-load.php');
if (!isset($wpdb)){
    $msg = 'Error loading wpdb';
    echo ($msg);
    die();
}

//var_dump($_POST);

function update_banner(){
    global $wpdb;
    $msg = 'Error! Unknown';

    if( isset($_POST['filename']) || isset($_POST['url']) ){
        $table_name = $wpdb->prefix."hranker_settings";

        
            $data = array();
            $data["banner_img"] = $_POST['filename'];
            $data["banner_url"] = $_POST['url'];

            $where = array (
                'id' => 1
            );

        
        $msg = $wpdb->update($table_name, $data, $where);
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
$msg = update_banner();
echo($msg);

?> 