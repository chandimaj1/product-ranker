<?php
require_once('../../../../wp-load.php');
if (!isset($wpdb)){
    $msg = 'Error loading wpdb';
    echo ($msg);
    die();
}

//var_dump($_POST);


function fetch_paginated_result_ids(){
    global $wpdb;
    $msg = 'Error! Unknown';
    $array_chunk_size = 10;

    if( isset($_POST['table']) ){
        $table_name = $wpdb->prefix."hranker_".$_POST['table'];

        $where = '';
        $sort = 'ORDER BY id DESC';

        if ( isset($_POST["sort_by"])  &&  isset($_POST["sort_type"]) && $_POST["sort_by"]!="no_sort" &&  $_POST["sort_type"]!="no_sort" ){
            $sort_by = str_replace("hrt_","",$_POST['sort_by']);
            $sort = "ORDER BY ".$sort_by." ".$_POST['sort_type'];
        }

        $result = $wpdb->get_results( 
                    "SELECT DISTINCT id FROM $table_name $where $sort"
                );

        if($result){ 
            $msg= "success";
        }else{
            $msg="failed";
        }
    }else{
        $msg = 'Missing data sent to server !';
    }

    $result = array_chunk($result, $array_chunk_size);

    $return = array("msg"=>$msg, "paginated_result"=>$result, "sort"=>$sort);
    return ($return);
}
$return = fetch_paginated_result_ids();






function fetch_results_from_ids($page1_ids,$table,$sort){
    global $wpdb;
    $msg = 'Error! Unknown';

    if( isset($page1_ids) &&  isset($table)){
        $table_name = $wpdb->prefix."hranker_".$table;
        $where = 'WHERE (';

        foreach ($page1_ids as $id){
            $where .= 'id='.$id->id.' || ';
        }

        $where .= ' false )';

        $result = $wpdb->get_results( 
                    "SELECT * FROM $table_name $where $sort"
                );

        if($result){ 
            $msg= "success";
        }else{
            $msg="failed";
        }
    }else{
        $msg = 'Missing data sent to server !';
    }

    $return = array("msg"=>$msg, "page1_data"=>$result);
    return ($return);
}
$return_page1 = fetch_results_from_ids($return["paginated_result"][0], $_POST["table"], $return["sort"]);

$msg = [$return, $return_page1];

$msg = json_encode($msg);
echo($msg);

?> 