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

    $plugin_url = $site_host."/wp-content/plugins/headphone_ranker/";
?>

<div id="hr_settings" style="display:none">
    <input id="hr_pluginurl" value="<?= $plugin_url ?>" disabled/>
    <input id="isadminpage" value="true" disabled/>
</div>

<div class="container" id="admin-container" style="margin-top:20px !important">
    <div class="row">
        <div class="col-sm-12">
            <h5 id="admin-title">HRanker Product Manager</h5>
            <img id="hranker_loader" src="/wp-content/plugins/headphone_ranker/assets/loading.gif" />
            <div id="hr_message" class="text-right">Retrieving ...</div>
        </div> 
    </div>    
    <hr />
    <div class="row">
    <div class="col-md-2">
            <select id="admin_product_select">
                <option value="headphones" selected>Headphones</option>
                <option value="iem" >IEM</option>
                <option value="earbuds" >Earbuds</option>
            </select>
        </div>
        <div class="col-md-4">
            <button id="hr_new_entry" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> New</button>
            <button id="hr_edit_selected" type="button" class="btn btn-warning hr_locked"><i class="fa fa-edit"></i> Edit</button>
            <button id="hr_delete_selected" type="button" class="btn btn-danger hr_locked"><i class="fa fa-trash"></i> Delete</button>
        </div>
        <div class="col-md-3">
            <div class="input-group" id="csv_upload_section">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="csv_file">
                    <label class="custom-file-label" for="inputGroupFile04">select csv</label>
                </div>
                <div class="input-group-append">
                    <button id="hr_upload_csv" type="button" class="btn btn-primary"><i class="fa fa-upload"></i> CSV</button>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group hr_locked" id="hr_search_input_group">
                <input type="text" id="hr_search_term" class="form-control" placeholder="Search Table" data-toggle="tooltip" data-placement="bottom" title="by headphone, principle or genre">
                <button type="button" id="hr_search" class="btn btn-info"><i class="fa fa-search"></i></button>
                <button type="button" id="hr_search_cancel" class="btn btn-danger"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
    <hr />
</div>


<div class="container">
    <div class="row" id="data_table_container">
        <table id="hranker_table" hr_showing="headphones" class="col-sm-12">
            <thead class="hr_locked">
                <tr> 
                    <th class="hrt_select" width="1%" data-toggle="tooltip" data-placement="top" title="Select All / Deselect All">
                        <input id="hrt_select_all" type="checkbox">
                    </th>
                    <th class="hrt_rank" width="6%" data-toggle="tooltip" data-placement="top" title="Ranking: A (Best) to F (Worst)">
                        Rank<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div>
                    </th>
                    <th class="hrt_device" width="13%" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        <span id="hr_device_name">Headphone</span><div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_price" width="8%" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        Price($)<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_value" width="6%" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        Value<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_principle" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        Principle<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_overall_timbre" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        Overall Timbre<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_summary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        Summary<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_ganre_focus" data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                        Ganre Focus<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                </tr>
            <thead>
            <tbody class="hr_locked">
                
            </tbody>
        </table> 
    </div>

    <div class="row" id="pagination" current_page='1'>
    </div>
</div>