(function($) {
//--- jQuery No Conflict
var ajax_url = '/wp-content/plugins/headphone_ranker/ajax_php/';

/**
 * 
 * 
 * 
 * 
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
                <td><input id="hrt_anr_price" class="form-control" type="number" placeholder="$"></td>
                <td><input id="hrt_anr_value" class="form-control" type="number"></td>
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

        //Remove Edit row
        if ($('#hrt_edit_row').length>0){
            $('#hrt_edit_row').remove();
        }
        if ($('#hrt_edit_controls').length>0){
            $('#hrt_edit_controls').remove();
        }

        if($('#hranker_table tbody tr').eq(0).attr('id') != "hrt_add_new_row"){
            $('#hranker_table tbody').prepend(hrt_addnewrow_template);
            //Refresh event listners
            $('#hrt_anr_save').unbind('click').bind('click',save_new_row);
            $('#hrt_anr_cancel').unbind('click').bind('click',delete_new_row);
            //Remove UI lock
            $('#hranker_table tbody').removeClass('hr_locked');
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

    $('#hranker_table tbody').addClass('hr_locked');
}


/**
 * 
 * Save new row to the database
 */
function save_new_row(){
    console.log('saving new row in the databse');
    $('#hranker_table thead').addClass('hr_locked');
    $('#hranker_table tbody').addClass('hr_locked');
    hr_status('secondary','Saving new row in database...');

    let ajax_data = {
        "table":$('#admin_product_select').val(),
        "rank" :$('#hrt_anr_rank').val(),
        "device" :$('#hrt_anr_device').val(),
        "price" :$('#hrt_anr_price').val(),
        "value" :$('#hrt_anr_value').val(),
        "principle" :$('#hrt_anr_principle').val(),
        "overall_timbre" :$('#hrt_anr_overall_timbre').val(),
        "summary" :$('#hrt_anr_summary').val(),
        "ganre_focus" :$('#hrt_anr_ganre_focus').val()
    }

    //Validation
    let all_filled = true;
    
    for(key in ajax_data){
        let term = ajax_data[key];
        console.log(term);
        if(term=='' || typeof term == 'undefinded'){
            all_filled = false;
        }
    }
    
    if (all_filled){
        $.ajax({     
            type: "POST",
            crossDomain: true,
            url:ajax_url+'add_new_record.php',
            data :ajax_data,
    
            success: function(data)
            {   
                console.log(data);
                data = JSON.parse(data);
                if (data=="success"){
                    console.log("Settings saved successfully...");
                    hr_status('success','Settings saved !...');
                    get_table_results();
                }else{
                    console.log("Error... ");
                    console.log(data);
                    hr_status('secondary','Error. Reason:'+data.msg);
                    $('#hranker_table thead').removeClass('hr_locked');
                    $('#hranker_table tbody').removeClass('hr_locked');
                }
            },
    
            error: function(e)
            {
                console.log(e);
            }
        });
    }else{
        $('#hranker_table thead').removeClass('hr_locked');
        $('#hranker_table tbody').removeClass('hr_locked');
        hr_status('danger','All fields must be filled...')
    }
    

}







/**
 * 
 * 
 * UI notifications
 */

 function hr_status(type,message){
    setTimeout(function(){ 
        if (type=='success' || type=='danger'){
            $('#hranker_loader').hide();
        }
        $('#hr_message').css('opacity','0');
    }, 1000);

    setTimeout(function(){   
        $('#hr_message').css('opacity','0');
        $('#hr_message').html(message);
        $('#hr_message').removeClass('text-success');
        $('#hr_message').removeClass('text-danger');
        $('#hr_message').removeClass('text-secondary');
        $('#hr_message').addClass('text-'+type);
        $('#hr_message').css('opacity','1');

        if(type=="secondary"){
            $('#hranker_loader').stop().show();
        }else{
            $('#hranker_loader').stop().hide();
        }
    }, 2000);
 }




/**
 * 
 * 
 *  Listen for product category change
 */
function hr_category_change(){
    $('#admin_product_select').change(function(){
        get_table_results();
    });
}





/**
 * 
 * 
 * Listen for row select
 */
function hr_table_rowselect(){
    $('#hranker_table td.hrt_select input').unbind('change').change(function(){
        $('#hranker_table td.hrt_select input').parent().parent().removeClass('selected_row');
        $('#hranker_table td.hrt_select input:checked').parent().parent().addClass('selected_row');

        $('#hr_delete_selected').addClass('hr_locked');
        $('#hr_edit_selected').addClass('hr_locked');

        if($('#hranker_table td.hrt_select input:checked').length == 1){
            $('#hr_delete_selected').removeClass('hr_locked');
            $('#hr_edit_selected').removeClass('hr_locked');
        }else if($('#hranker_table td.hrt_select input:checked').length > 1){
            $('#hr_delete_selected').removeClass('hr_locked');
        }
        //If all checked
        if(  $('#hranker_table td.hrt_select input:checked').length == $('#hranker_table td.hrt_select input').length  ){
            $('#hrt_select_all').prop('checked',true);
        }else{
            $('#hrt_select_all').prop('checked',false);
        }
    });

    //Select All
    $('#hrt_select_all').unbind('change').change(function(){
        if( $('#hrt_select_all').prop('checked') ){
            $('#hranker_table td.hrt_select input').prop('checked',true);
        }else{
            $('#hranker_table td.hrt_select input').prop('checked',false);
        }
        $('#hranker_table td.hrt_select input').trigger('change');
    });
}




/***
 * 
 * 
 * Listen for Delete row
 */
function hr_delete_selected_rows(){
    $('#hr_delete_selected').unbind('click').click(function(){
        hr_status('secondary','Deleting rows...');

        let selected_ids = [];
        $('#hranker_table tbody .selected_row').each(function(){
            selected_ids.push(  parseInt( $(this).attr('id') )  );
        });

        if(selected_ids.length>0){
            delete_ids_from_database(selected_ids);
        }else{
            hr_status('danger','No selected rows to delete...');
        }
    })
}

/***
 * 
 * Delete Ids from Database
 */
function delete_ids_from_database(selected_ids){
    $('#hranker_table thead').addClass('hr_locked');
    $('#hranker_table tbody').addClass('hr_locked');
    $('#hr_edit_selected').addClass('hr_locked');
    $('#hr_delete_selected').addClass('hr_locked');

    $.ajax({     
        type: "POST",
        crossDomain: true,
        url:ajax_url+'delete_records.php',
        data :{
            "ids":selected_ids,
            "table":$('#admin_product_select').val(),
        },

        success: function(data)
        {   
            console.log(data);
            data = JSON.parse(data);
            if (data=="success"){
                console.log("Records deleted successfully...");
                hr_status('success','Records Deleted !...');
                get_table_results();
            }else{
                console.log("Error... ");
                console.log(data);
                hr_status('secondary','Error. Reason:'+data.msg);
                $('#hranker_table thead').removeClass('hr_locked');
                $('#hranker_table tbody').removeClass('hr_locked');
            }
        },

        error: function(e)
        {
            console.log(e);
        }
    });
}



/**
 * 
 * 
 * 
 * 
 * Edit Records
 */
function hr_edit_selected_row(){
    $('#hr_edit_selected').unbind('click').click(function(){
        hr_status('secondary','Edit record...');

        const selected_row = $('#hranker_table tbody .selected_row').eq(0);
        let edit_selected_row_template =
        `<tr id="hrt_edit_row" edit_row_id="`+selected_row.attr('id')+`">
            <td></td>
            <td><input id="hrt_er_rank" class="form-control" type="text" value="`+selected_row.children('.hrt_rank').text()+`"></td>
            <td><input id="hrt_er_device" class="form-control" type="text" value="`+selected_row.children('.hrt_device').text()+`"></td>
            <td><input id="hrt_er_price" class="form-control" type="number" placeholder="$" value="`+selected_row.children('.hrt_price').text()+`"></td>
            <td><input id="hrt_er_value" class="form-control" type="number" value="`+selected_row.children('.hrt_value').text()+`"></td>
            <td><input id="hrt_er_principle" class="form-control" type="text" value="`+selected_row.children('.hrt_principle').text()+`"></td>
            <td><input id="hrt_er_overall_timbre" class="form-control" type="text" value="`+selected_row.children('.hrt_overall_timbre').text()+`"></td>
            <td><input id="hrt_er_summary" class="form-control" type="text" value="`+selected_row.children('.hrt_summary').text()+`"></td>
            <td><input id="hrt_er_ganre_focus" class="form-control" type="text" value="`+selected_row.children('.hrt_ganre_focus').text()+`"></td>
        <tr>
        <tr id="hrt_edit_controls">
            <td colspan="10" class="text-right">
                <button type="button" id="hrt_er_save" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                <button type="button" id="hrt_er_cancel" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
            </td>
        </tr>`;

        //Remove add new element row
        if ($('#hrt_add_new_row').length>0){
            $('#hrt_add_new_row').remove();
        }
        if ($('#hrt_anr_controls').length>0){
            $('#hrt_anr_controls').remove();
        }

        //Remove Edit row
        if ($('#hrt_edit_row').length>0){
            $('#hrt_edit_row').remove();
        }
        if ($('#hrt_edit_controls').length>0){
            $('#hrt_edit_controls').remove();
        }

        $('#hranker_table tbody').prepend(edit_selected_row_template);
        //Refresh event listners
        $('#hrt_er_save').unbind('click').bind('click',save_edited_row);
        $('#hrt_er_cancel').unbind('click').bind('click',cancel_edit_row);
        //Remove UI lock
        $('#hranker_table tbody').removeClass('hr_locked');

    });
}

/**
 * 
 *  Save edited row
 */
function save_edited_row(){
    console.log('saving edited row in the databse');
    $('#hranker_table thead').addClass('hr_locked');
    $('#hranker_table tbody').addClass('hr_locked');
    hr_status('secondary','Saving edited row in database...');

    let ajax_data = {
        "table":$('#admin_product_select').val(),
        "id":$('#hrt_edit_row').attr('edit_row_id'),
        "rank" :$('#hrt_er_rank').val(),
        "device" :$('#hrt_er_device').val(),
        "price" :$('#hrt_er_price').val(),
        "value" :$('#hrt_er_value').val(),
        "principle" :$('#hrt_er_principle').val(),
        "overall_timbre" :$('#hrt_er_overall_timbre').val(),
        "summary" :$('#hrt_er_summary').val(),
        "ganre_focus" :$('#hrt_er_ganre_focus').val()
    }

    //Validation
    let all_filled = true;
    
    for(key in ajax_data){
        let term = ajax_data[key];
        console.log(term);
        if(term=='' || typeof term == 'undefinded'){
            all_filled = false;
        }
    }
    
    if (all_filled){
        $.ajax({     
            type: "POST",
            crossDomain: true,
            url:ajax_url+'save_edited_row.php',
            data :ajax_data,
    
            success: function(data)
            {   
                console.log(data);
                data = JSON.parse(data);
                if (data=="success"){
                    console.log("Settings saved successfully...");
                    hr_status('success','Settings saved !...');
                    get_table_results();
                }else{
                    console.log("Error... ");
                    console.log(data);
                    hr_status('secondary','Error. Reason:'+data.msg);
                    $('#hranker_table thead').removeClass('hr_locked');
                    $('#hranker_table tbody').removeClass('hr_locked');
                }
            },
    
            error: function(e)
            {
                console.log(e);
            }
        });
    }else{
        $('#hranker_table thead').removeClass('hr_locked');
        $('#hranker_table tbody').removeClass('hr_locked');
        hr_status('danger','All fields must be filled...')
    }
    
}





/**
 * 
 * 
 *  Cancel Edited Row
 */
function cancel_edit_row(){
    $('#hrt_edit_row').remove();
    $('#hrt_edit_controls').remove();
}



/**
 * 
 * 
 * 
 * 
 * 
 * Get Table Results
 * 
 * 
 */
function get_table_results(){
    console.log('Fetching results from table');
    $('#hranker_table thead').addClass('hr_locked');
    $('#hranker_table tbody').addClass('hr_locked');
    $('#hr_edit_selected').addClass('hr_locked');
    $('#hr_delete_selected').addClass('hr_locked');

    hr_status('secondary','Fetching results from database..');


    let ajax_data = {
        "table":$('#admin_product_select').val(),
        //Sort status
        "rank" :get_sort_status('hrt_rank'),
        "device" :get_sort_status('hrt_device'),
        "price" :get_sort_status('hrt_price'),
        "value" :get_sort_status('hrt_value'),
        "principle" :get_sort_status('hrt_principle'),
        "overall_timbre" :get_sort_status('hrt_overall_timbre'),
        "summary" :get_sort_status('hrt_summary'),
        "ganre_focus" :get_sort_status('hrt_ganre_focus'),
        //Search Status
        "search" :$('#hr_search_term').val()
    }

    $.ajax({     
        type: "POST",
        crossDomain: true,
        url:ajax_url+'fetch_records.php',
        data :ajax_data,

        success: function(data)
        {   
            console.log(data);
            data = JSON.parse(data);
            if (data[1].msg=="success"){
                console.log("fetch success...");
                console.log(data);

                $('#hranker_table thead').removeClass('hr_locked');
                $('#hranker_table tbody').removeClass('hr_locked');
                hr_status('success','Table results fetched..');

                //ADD TABLE ROWS
                add_data_to_table(data[1].page1_data);
            }else{
                console.log("Error... ");
                console.log(data);

                hr_status('danger','Error. Reason: (fetch ids)'+data[0].msg+' (fetch page1)'+data[1].msg);
            }
        },

        error: function(e)
        {
            console.log(e);
        }
    });
}

function add_data_to_table(data){
    $('#hranker_table tbody').html('');

    data.forEach(function(item){
        let row = 
        `<tr id="`+item.id+`">
            <td class="hrt_select"><input type="checkbox" class="form_control"/></td>
            <td class="hrt_rank">`+item.rank+`</td>
            <td class="hrt_device">`+item.device+`</td>
            <td class="hrt_price">`+item.price+`</td>
            <td class="hrt_value">`+item.value+`</td>
            <td class="hrt_principle">`+item.principle+`</td>
            <td class="hrt_overall_timbre">`+item.overall_timbre+`</td>
            <td class="hrt_summary">`+item.summary+`</td>
            <td class="hrt_ganre_focus">`+item.ganre_focus+`</td>
        </tr>`;

        $('#hranker_table tbody').append(row);
        $('#hranker_table').removeClass('hr_locked');

        //refresh row select event listners
        hr_table_rowselect();
        hr_delete_selected_rows();
        hr_edit_selected_row();
    });

    $('')

}

/**
 * 
 * 
 *  Listen for sort
 */
function hr_listen_sort(){
    $('.fa-sort-up').click(function(){
        $(this.parentElement).removeClass('hr_sort_desc');
        $(this.parentElement).addClass('hr_sort_asc');
    });

    $('.fa-sort-down').click(function(){
        $(this.parentElement).removeClass('hr_sort_asc');
        $(this.parentElement).addClass('hr_sort_desc');
    });    
}


/**
 * 
 * Get Sort status
 */
function get_sort_status(th){
    if ( $('.'+th+' .hr_sort').hasClass('hr_sort_desc') ){
        return 'desc';
    }else if ( $('.'+th).hasClass('hr_sort_asc') ){
        return 'asc'
    }else{
        return false
    }
}





/**
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * 
 * Execute functions on DOM ready
 * 
 */
$(document).ready(function() {
    console.log('HRanker Product Manager - Scripts Ready()');

    //Event Listeners
    hr_new_entry(); // new entry click
    hr_category_change();// category select change
    hr_listen_sort(); // Sorting




    //Onload fetch results
    get_table_results();
})

//--- jQuery No Conflict
})(jQuery);