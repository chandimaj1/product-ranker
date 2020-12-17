<?php
/**
 * MODIFIED TEMPLATE FROM TWENTY-TWENTY POST TEMPLATE
 *
 */
//Check wpdb for SignNow account registered for the current user
// If not exist, Create one and update results
//setting script variables
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$site_host = "https://";   
else  
$site_host = "http://";   
// Append the host(domain name, ip) to the URL.   
$site_host.= $_SERVER['HTTP_HOST']; 


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


add_shortcode( 'sn-send-document', 'sn_send_doc' );
function sn_send_doc( ) {
?>
    <div class="row">
        <div class="container">
            <div class="cpl-sm-12" id="sn-api-settings" sn_data_url='<?= "$site_host/wp-content/plugins/SignNow_byChandimaj/ajax_php/" ?>'>
                <h4>Upload your document</h4>
                <form id="sn_upload_doc" action="#" onsubmit="return false" >
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <button type="button" id="upload_sn_files" >Upload</button>
                </form>
            </div>
        </div>
    </div>

<?php
}
?>