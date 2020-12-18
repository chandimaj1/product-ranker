(function($) {
//--- jQuery No Conflict

/**
 * 
 *  Add New Entry
 * 
 */

function hr_new_entry(){
    $('#hr_new_entry').click(function(){

        const hrt_addnewrow_template = `
            <tr id="hrt_add_new_row">
                <td></td>
                <td><input id="hrt_anr_rank" class="form-control" type="text"></td>
                <td><input id="hrt_anr_device" class="form-control" type="text"></td>
                <td><input id="hrt_anr_price" class="form-control" type="text"></td>
                <td><input id="hrt_anr_value" class="form-control" type="text"></td>
                <td><input id="hrt_anr_principle" class="form-control" type="text"></td>
                <td><input id="hrt_anr_overall_timbre" class="form-control" type="text"></td>
                <td><input id="hrt_anr_summary" class="form-control" type="text"></td>
                <td><input id="hrt_anr_ganre_focus" class="form-control" type="text"></td>
            <tr>
            <tr id="hrt_anr_controls">
                <td colspan="10" class="text-right">
                    <button type="button" id="hrt_anr_save" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                    <button type="button" id="hrt_anr_cancel" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
                </td>
            </tr>
        `;

        if($('#hranker_table tbody tr').eq(0).attr('id') != "hrt_add_new_row"){
            $('#hranker_table tbody').prepend(hrt_addnewrow_template);
            //Refresh event listners
            $('#hrt_anr_save').unbind('click').bind('click',save_new_row);
            $('#hrt_anr_cancel').unbind('click').bind('click',delete_new_row);
        }
    });
} 

/**
 * 
 * Save new row to the database
 */
function save_new_row(){
    console.log('saving new row in the databse');

    var ajax_data = {
        "rank" :$('#hrt_anr_rank').val(),
        "device" :$('#hrt_anr_rank').val(),
        "price" :$('#hrt_anr_rank').val(),
        "value" :$('#hrt_anr_rank').val(),
        "principle" :$('#hrt_anr_rank').val(),
        "overall_timbre" :$('#hrt_anr_rank').val(),
        "summary" :$('#hrt_anr_rank').val(),
        "ganre_focus" :$('#hrt_anr_rank').val(),
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


/**
 * 
 * Delete new row from table
 */
function delete_new_row(){
    $('#hrt_anr_controls').remove();
    $('#hrt_add_new_row').remove();
}









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
    console.log('HRanker Product Manager - Scripts Ready()');
    //sn_admin_settings_save();
    //sn_admin_settings_test();

    hr_new_entry();
})
//--- jQuery No Conflict
})(jQuery);