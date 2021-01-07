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
            <h5 id="admin-title">Headphone Ranker Plugin</h5>

        <div class="col-sm-12" id="hr_stats_row" style="position:fixed; right:5px; top:5px;">
            <img id="hranker_loader" src="/wp-content/plugins/headphone_ranker/assets/loading.gif" />
            <div id="hr_message" class="text-right">Retrieving ...</div>
        </div>
    </div>


    <hr>
    <div class="row">
        <div class="col-sm-12"><h6>Front Section HTML:</h6></div>
        <div class="col-sm-4 text-right">
            <div style="font-size:10pt" class="text-left">
                Front page custom section HTML for the selected category:
            </div>
            <button id="hr_category_html" type="button" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
        </div>
        <div class="col-sm-8">
            <textarea class="form-control" id="frontend_html"></textarea>
        </div>
    </div>
    <hr />



    <div class="row">
        <div class="col-sm-12"><h6>Sponsor's Banner:</h6></div>
        <div class="col-sm-12">
            <!--
            <img id="hr_admin_banner_img" file_name="sponsor_banner_default.jpg" src="<?= $plugin_url ?>assets/img/sponsor_banner_default.jpg"/>
                -->
            <div class="small_banner" id="banner_image1">
                <div class="banner_title">Banner Image 1</div>
                <img id="" file_name="small_banner_default.jpg" src="<?= $plugin_url ?>assets/loading.gif"/>
                <button class="btn btn-primary"> <i class="fa fa-upload"></i> Upload</button>
                <input type="text" class="form-control bannerlink" placeholder="Banner redirect link">
            </div>
            <div class="small_banner"  id="banner_image2">
                <div class="banner_title">Banner Image 2</div>
                <img id="" file_name="small_banner_default.jpg" src="<?= $plugin_url ?>assets/loading.gif"/>
                <button class="btn btn-primary"> <i class="fa fa-upload"></i> Upload</button>
                <input type="text" class="form-control bannerlink" placeholder="Banner redirect link">
            </div>
            <div class="small_banner"  id="banner_image3">
                <div class="banner_title">Banner Image 3</div>
                <img id="" file_name="small_banner_default.jpg" src="<?= $plugin_url ?>assets/loading.gif"/>
                <button class="btn btn-primary"> <i class="fa fa-upload"></i> Upload</button>
                <input type="text" class="form-control bannerlink" placeholder="Banner redirect link">
            </div>
            <div class="small_banner"  id="banner_image4">
                <div class="banner_title">Banner Image 4</div>
                <img id="" file_name="small_banner_default.jpg" src="<?= $plugin_url ?>assets/loading.gif"/>
                <button class="btn btn-primary"> <i class="fa fa-upload"></i> Upload</button>
                <input type="text" class="form-control bannerlink" placeholder="Banner redirect link">
            </div>

            <input type="file" class="custom-file-input" id="banner_img_file" style="display:none">

            <div class="text-right">
                 <button id="hr_save_banner" type="button" class="btn btn-success"><i class="fa fa-check"></i> Save Banner Settings</button>
            </div>
        </div>
       
    </div>
    <hr />


    <div class="row">
        <div class="col-md-5">
            <div class=""><h6>Data Table Management:</h6></div>
            <button id="hr_new_entry" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> New</button>
            <button id="hr_upload_csv" type="button" class="btn btn-primary"><i class="fa fa-upload"></i> CSV</button>
                <div class="custom-file" style="display:none">
                    <input type="file" class="custom-file-input" id="csv_file">
                    <label class="custom-file-label" for="inputGroupFile04">select csv</label>
                </div>
            
            <button id="hr_edit_selected" type="button" class="btn btn-warning hr_locked"><i class="fa fa-edit"></i> Edit</button>
            <button type="button" id="hrt_er_save" class="btn btn-success hr_locked hr_hidden"><i class="fa fa-check"></i> Save</button>
                <button type="button" id="hrt_er_cancel" class="btn btn-danger hr_locked hr_hidden"><i class="fa fa-times"></i> Cancel</button>
            <button id="hr_delete_selected" type="button" class="btn btn-danger hr_locked"><i class="fa fa-trash"></i> Delete</button>
        </div>
        <div class="col-md-3">
            <div class=""><h6>Select Category (Table):</h6></div>
            <select id="admin_product_select" class="form-control">
                <option value="headphones" selected>Headphones</option>
                <option value="iem" >IEM/Earphones</option>
                <option value="earbuds" >True Wireless</option>
            </select>
        </div>
        <div class="col-md-4">
            <div class=""><h6>Search Table:</h6></div>
            <div class="input-group hr_locked" id="hr_search_input_group">
                <input type="text" id="hr_search_term" class="form-control" placeholder="Search Table" data-toggle="tooltip" data-placement="bottom" title="by headphone, principle or genre">
                <button type="button" id="hr_search" class="btn btn-info"><i class="fa fa-search"></i></button>
                <button type="button" id="hr_search_cancel" class="btn btn-danger"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-sm-12"><h6>Table Results:</h6></div>
    </div>

    <div class="row" id="filters_row">
        <div class="col-sm-3">
            <label for="filter_brand" class="small_label">Filter by Brand</label>
            <select id="filter_brand">
                <option value="any" selected>Any</option>
            </select>
        </div> 
        
        <div class="col-sm-3">
            <label for="filter_brand" class="small_label">Filter by Principle</label>
            <select id="filter_principle">
                <option value="any" selected>Any</option>
            </select>
            </div> 
        
        <div class="col-sm-3">
            <label for="filter_genre" class="small_label">Filter by Genre</label>
            <select id="filter_genre"> 
                <option value="any" selected>Any</option> 
            </select>
        </div>

        <div class="col-sm-3">
        <label for="filter_genre" class="small_label">Filter by Price</label>
            <div class="" id="filter_price">
                <div class="text-center" style="width:20%; float:left"> From </div>
                <input type=number id="hr_price_from" class="form-control" style="width:35%; float:left" placeholder="From:" min=0>
                <div class="text-center" style="width:10%; float:left"> to </div>
                <input type=number id="hr_price_to" class="form-control" style="width:35%; float:left" placeholder="To:" min=1>
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
                    <th class="hrt_brand" width="6%" data-toggle="tooltip" data-placement="top" title="Brand of the audio device">
                        Brand<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div>
                    </th>
                    <th class="hrt_device" width="6%" data-toggle="tooltip" data-placement="top" title="Model of the audio device">
                        <span id="hr_device_name">Model</span><div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
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

<div class="modal" tabindex="-1" role="dialog" id="modal_confirm_delete" style="margin-top:50px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>You are about to delete <span id="delete_records_no">0</span> records from the table.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="confirmed_delete">Delete Records</button>
        <button type="button" class="btn btn-warning" id="confirmed_delete_cancel" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>