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

?>


<div class="container" id="admin-container" style="margin-top:20px !important">
    <div class="row">
        <div class="col-sm-12">
            <h5 id="admin-title">HRanker Product Manager</h5>
            <img class="hranker_loader" src="/wp-content/plugins/headphone_ranker/assets/loading.gif" />
        </div>
    </div>    
    <hr />
    <div class="row">
    <div class="col-sm-3">
            <select id="admin_product_select">
                <option value="headphones" selected>Headphones</option>
                <option value="iem" >IEM</option>
                <option value="earbuds" >Earbuds</option>
            </select>
        </div>
        <div class="col-sm-5">
            <button id="hr_new_entry" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> New</button>
            <input type="file" id="csv_file" style="display:none"/>
            <button id="hr_upload_csv" type="button" class="btn btn-primary"><i class="fa fa-upload"></i> CSV</button>
            <button id="hr_edit_selected" type="button" class="btn btn-secondary"><i class="fa fa-edit"></i> Edit</button>
            <button id="hr_delete_selected" type="button" class="btn btn-secondary"><i class="fa fa-trash"></i> Delete</button>
        </div>
        <div class="col-sm-4">
            <div class="input-group">
                <input type="text" id="hr_search_term" class="form-control" placeholder="Search by headphone, principle or genre">
                <button type="button" id="hr_search" class="btn btn-info"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
    <hr />
</div>


<div class="container">
    <div class="row" id="data_table_container">
        <table id="hranker_table" hr_showing="headphones" class="col-sm-12">
            <thead>
                <tr>
                    <th class="hrt_select" width="2%"><input id="hrt_select_all" type="checkbox"></th>
                    <th class="hrt_rank" width="6%">Rank<div class="hr_sort hr_sort_desc"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_rank">Headphone<div class="hr_sort hr_sort_desc"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_rank" width="7%">Price<div class="hr_sort hr_sort_desc"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_rank" width="6%">Value<div class="hr_sort hr_sort_desc"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_rank">Principle<div class="hr_sort hr_sort_desc"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_rank">Overall Timbre<div class="hr_sort hr_sort_desc"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_rank">Summery<div class="hr_sort hr_sort_desc"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_rank">Ganre Focus<div class="hr_sort hr_sort_desc"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                </tr>
            <thead>
            <tbody>
                
            </tbody>
        </table> 
    </div>
</div>


