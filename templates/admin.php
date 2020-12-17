<?php
if (! defined( 'ABSPATH') ){
    die;
}

//setting script variables
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
$site_host = "https://";   
else  
$site_host = "http://";   
// Append the host(domain name, ip) to the URL.   
$site_host.= $_SERVER['HTTP_HOST']; 


// Get SN Api Settings
include plugin_dir_path(__FILE__)."../ajax_php/get_sn_settings.php"; 
$sn_settings = get_settings_table_results();

?>
<h2 style="padding:20px;" id="admin-title">SignNow Settings <br>
<span>-SignNow plugin byChandimaJ</span></h2>

<div class="container" id="admin-container">
    <div class="row">
        <div class="col-sm-8" id="sn-api-settings" sn_data_url='<?= "$site_host/wp-content/plugins/SignNow_byChandimaj/ajax_php/" ?>'>
            <h4>SignNow Account Settings</h4>
            <div class="signnow_error">Error! All fields must be filled.</div>
            <div>Api Host:</div>
            <div class="input-group">
                <input type="text" id="sn_data_host" value="<?= $sn_settings->sn_host?>" class="form-control" placeholder="SignNow Api Host">
            </div>
            <div>Api Username:</div>
            <div class="input-group">
                <input type="text" id="sn_data_username" value="<?= $sn_settings->sn_username?>" class="form-control" placeholder="SignNow App Account Email">
            </div>
            <div>Api Password:</div>
            <div class="input-group">
                <input type="text" id="sn_data_password" value="<?= $sn_settings->sn_password?>"   class="form-control" placeholder="SignNow App Account Password">
            </div>
            <div>Api Basic:</div>
            <div class="input-group">
                <input type="text" id="sn_data_basic" value="<?= $sn_settings->sn_basic?>"  class="form-control" placeholder="SignNow Basic Authorization Token">
            </div>
 
            <div class="input-group">
                <input type="text" id="sn_data_bearer" class="form-control" placeholder="Test if Settings are valid" disabled>
                <button type="button" id="sn_test_settings" class="btn btn-default">Test Settings</button>
            </div>

            <div class="button-group">
                
            </div>
            <div id="sn_save_settings">
                <button type="button" class="btn btn-default sn_save">Save Settings</button>
                <img class="signnow_loading" src="/wp-content/plugins/SignNow_byChandimaj/assets/loading.gif" />
                <div class="signnow_success">Settings Saved !</div>
                <div class="signnow_error">Error! Settings not saved.</div>
            </div>
        </div>
        <div class="col-sm-4">
            
        </div>
    </div>
 
    <div class="row" style="margin-top:50px;">
        <div class="col-sm-6">
            <h4>Implementation</h4>
            <p>The plugin use custom post types and shortcodes to implement
                Send Now actions: <br>
            <hr>
            <h6>Create & Send Document to Sign:</h6>
            <div class="col-sm-6">
                <span class='titlex'>SignNow Post Type</span> <br>
                <span class='copytext'>SignNow Send Document</span>
            </div>
            <div class="col-sm-6">
                <span class='titlex'>Shortcode</span> <br>
                <span class='copytext'>[sn-send-doc]</span>    
            </div>
            </p>
        </div>
    </div>
</div>



