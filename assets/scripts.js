(function($) {
//--- jQuery No Conflict

/**  
 * 
 * Update status for status = 'loading', 'success', 'error'
 * 
 * */
function sn_update_status(parent,status) {
    $('#'+parent).removeClass('signnow_status_loading');
    $('#'+parent).removeClass('signnow_status_success');
    $('#'+parent).removeClass('signnow_status_error');
    $('#'+parent).removeClass('signnow_status_'); // class used to clear any notification

    let status_class = "signnow_status_"+status;
    $('#'+parent).addClass(status_class);
}

/**
 * 
 * Admin page settings save
 * 
 */
function sn_admin_settings_save() {
    $('#sn_save_settings .sn_save').click(function(){
        sn_save_settings();
    });   
}
function sn_save_settings(){

    const sn_data_host = $('#sn_data_host').val();
    const sn_data_username = $('#sn_data_username').val();
    const sn_data_password = $('#sn_data_password').val();
    const sn_data_basic = $('#sn_data_basic').val();
    const ajax_url = $('#sn-api-settings').attr('sn_data_url');

    if(sn_data_host=='' || sn_data_username=='' || sn_data_password=='' || sn_data_basic==''){
        sn_update_status('sn-api-settings','error');
    }else{
        sn_update_status('sn-api-settings','');
        
        $('#sn-api-settings input').attr('disabled','true');
        sn_update_status('sn_save_settings','loading');
        
        var ajax_data = {
            "host" :sn_data_host,
            "username" :sn_data_username,
            "password" :sn_data_password,
            "basic" :sn_data_basic,
        }

        $.ajax({     
            type: "POST",
            crossDomain: true,
            url:ajax_url+'update_sn_settings.php',
            data :ajax_data,
    
            success: function(data)
            {   
                data = JSON.parse(data);
                if(data=='success'){
                    sn_update_status('sn_save_settings','success');
                    setTimeout(function () {
                        location.reload();
                    }, 3000)
                }
            },
    
            error: function(e)
            {
                $('#sn-api-settings input').removeAttr('disabled');
                $('#sn-api-settings #sn_data_bearer').attr('disabled','true');
                sn_update_status('sn_save_settings','error');
                console.log(e);
            }
        });
    }
}


/**
 * 
 * Admin page settings Test
 * 
 */
function sn_admin_settings_test() {
    $('#sn_test_settings').click(function(){
        sn_test_settings();
    });   
}
function sn_test_settings(){

    const sn_data_host = $('#sn_data_host').val();
    const sn_data_username = $('#sn_data_username').val();
    const sn_data_password = $('#sn_data_password').val();
    const sn_data_basic = $('#sn_data_basic').val();
    const ajax_url = $('#sn-api-settings').attr('sn_data_url');

    if(sn_data_host=='' || sn_data_username=='' || sn_data_password=='' || sn_data_basic==''){
        sn_update_status('sn-api-settings','error');
    }else{
        sn_update_status('sn-api-settings','');
        
        var ajax_data = {
            "host" :sn_data_host,
            "username" :sn_data_username,
            "password" :sn_data_password,
            "basic" :sn_data_basic,
        }

        $.ajax({     
            type: "POST",
            crossDomain: true,
            url:ajax_url + 'test_sn_settings.php',
            data :ajax_data,
    
            success: function(data)
            {   
                console.log('Testing Settings..');
                console.log(data);
                if(data=='success'){
                    $('#sn_data_bearer').val('Settings Validated !');
                    $('#sn_data_bearer').css('background-color','#efe');
                }else{
                    $('#sn_data_bearer').val('Settings Not Validated !');
                    $('#sn_data_bearer').css('background-color','#fee');
                }
            },
    
            error: function(e)
            {
                
            }
        });
    }
}



/**
 * 
 * Execute functions on DOM ready
 * 
 */
$(document).ready(function() {
    console.log('SignNow by ChandimaJ - Scripts Ready()');
    sn_admin_settings_save();
    sn_admin_settings_test();
})
//--- jQuery No Conflict
})(jQuery);