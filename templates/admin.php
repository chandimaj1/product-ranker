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

<div class="container" id="admin-container">
    <div class="row" style="margin-top:10px !important;">
        <div class="col-md-4">
            <h5 id="admin-title">HRanker Product Manager</h5>
        </div>
        <div class="col-md-4">
            <label for="admin_product_select" class="">Category: </label>
            <select id="admin_product_select">
                <option value="headphones" selected>Headphones</option>
                <option value="iem" >IEM</option>
                <option value="earbuds" >Earbuds</option>
            </select>
        </div>
            
        
            <img id="hranker_loader" src="/wp-content/plugins/headphone_ranker/assets/loading.gif" />
            <div id="hr_message" class="text-right">Retrieving ...</div>

    </div>

    <hr />

    <div class="row">
        <div class="col-md-4">
            <button id="hr_new_entry" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> New</button>
            <button id="hr_upload_csv" type="button" class="btn btn-primary"><i class="fa fa-upload"></i> CSV</button>
                <div class="custom-file" style="display:none">
                    <input type="file" class="custom-file-input" id="csv_file">
                    <label class="custom-file-label" for="inputGroupFile04">select csv</label>
                </div>
            
            <button id="hr_edit_selected" type="button" class="btn btn-warning hr_locked"><i class="fa fa-edit"></i> Edit</button>
            <button id="hr_delete_selected" type="button" class="btn btn-danger hr_locked"><i class="fa fa-trash"></i> Delete</button>
        </div>
        <div class="col-sm-4">
        <div class="row" id="filters_section">
            <div class="col-sm-4 p-0">
                <label for="filter_brand" class="small_label">Brand</label>
                <select id="filter_brand">
                    <option value="any" selected>Any</option>
                </select>
            </div> 
            
            <div class="col-sm-4 p-0">
                <label for="filter_brand" class="small_label">Principle</label>
                <select id="filter_principle">
                    <option value="any" selected>Any</option>
                </select>
                </div> 
            
            <div class="col-sm-4 p-0">
                <label for="filter_genre" class="small_label">Genre</label>
                <select id="filter_genre"> 
                    <option value="any" selected>Any</option> 
                </select>
            </div>

            <div class="col-sm-6">
                <div class="row" id="filter_price" style="margin-top:5px">
                    <div class="text-center col-sm-6 p-0">
                        <label for="hr_price_from" class="small_label">Price from</label>
                        <input type=number id="hr_price_from" class="form-control" style="width:100%; float:left" placeholder="From:" min=0>
                    </div>
                    <div class="text-center col-sm-6 p-0">
                        <label for="hr_price_to" class="small_label">Price to</label>
                        <input type=number id="hr_price_to" class="form-control" style="width:100%; float:left" placeholder="To:" min=1>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
            <div class="input-group hr_locked" id="hr_search_input_group">
                <input type="text" id="hr_search_term" class="form-control" placeholder="Search Table" data-toggle="tooltip" data-placement="bottom" title="by headphone, principle or genre">
                <button type="button" id="hr_search" class="btn btn-info"><i class="fa fa-search"></i></button>
                <button type="button" id="hr_search_cancel" class="btn btn-danger"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>
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
                    <th class="hrt_device" width="13%" data-toggle="tooltip" data-placement="top" title="Brand and Model">
                        <span id="hr_device_name">Headphone</span><div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_price" width="8%" data-toggle="tooltip" data-placement="top" title="Original Cost">
                        Price($)<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_value" width="6%" data-toggle="tooltip" data-placement="top" title="Worth of headphone compared to price">
                        Value<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_principle" data-toggle="tooltip" data-placement="top" title="Driver type and earcup design">
                        Principle<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_overall_timbre" data-toggle="tooltip" data-placement="top" title="One word summary for how each frequency range behaves">
                        Overall Timbre<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_summary" data-toggle="tooltip" data-placement="top" title="Short analysis of the headphones strengths and weaknesses">
                        Summary<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_ganre_focus" data-toggle="tooltip" data-placement="top" title="Types of music that showcase the headphones best qualities">
                        Genre Focus<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                </tr>
            <thead>
            <tbody class="hr_locked">
                
            </tbody>
        </table> 
    </div>

    <div class="row" id="pagination" current_page='1'>
    </div>
</div>