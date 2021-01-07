<?php

require_once('../../../../wp-load.php');
if (!isset($wpdb)){
    $msg = 'Error loading wpdb';
    echo ($msg);
    die();
}

//var_dump($_POST);


function fetch_html(){
    global $wpdb;
    $msg = 'Error! Unknown';

    
        $table_name = $wpdb->prefix."hranker_settings";

        $sql = "SELECT DISTINCT banner_img, banner_url FROM $table_name WHERE id=1 LIMIT 1";

        $result = $wpdb->get_results( $sql, ARRAY_N );

        if($result){ 
            $msg= "success";
        }else{
            $msg="failed";
        }

   

    $return = array("msg"=>$msg, "filename"=>$result[0][0], "url"=>$result[0][1]);
    $return = json_encode($return);
    echo($return);
}
fetch_html();

?>