<?php
/*
Template Name: SignNow - My Documents Template
Template Post Type: post
*/

//Check wpdb for SignNow account registered for the current user
// If not exist, Create one and update results
function get_wpdb_user_info(){
    global $wpdb;
    global $current_user;
    $msg = false;
//var_dump($current_user);
    $table_name = $wpdb->prefix."signnow_bychandimaj_users";
    $current_user_id = (int) $current_user->ID; 
    $msg = $wpdb->get_var("SELECT COUNT(*) FROM $table_name WHERE sn_userid = $current_user_id");
    
    if($msg == "0"){ 
        $msg=false;
    }else{
        $msg=true;
    }
    
    return $msg;
}
$msg_user_exist = get_wpdb_user_info();


//Create new user if not exist in table
//---- at SignNow
if(!$msg_user_exist){
    echo ('User does not exis');
}

// Fetch user related infromation from SignNow
?>
<h1> My Documents </h1>