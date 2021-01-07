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
    <div class="row" style="margin-top:0px !important;">
            <select id="admin_product_select" style="display:none !important">
                <option value="<?= $atts["device"] ?>" selected><?= $atts["device"] ?></option>
            </select>
    </div>
    <div class="row">
        <div class="col-md-6 p-0" id="filters_row">
            <div id="social_sharer">
                <button id="ss_twitter" class="btn btn-secondary social_share_icon" data-toggle="tooltip" data-placement="bottom" title="Share on Twitter"> <i class="fa fa-twitter"></i></button>
                <button id="ss_facebook" class="btn btn-secondary social_share_icon" data-toggle="tooltip" data-placement="bottom" title="Share on Facebook"> <i class="fa fa-facebook"></i></button>
                <button id="ss_reddit" class="btn btn-secondary social_share_icon" data-toggle="tooltip" data-placement="bottom" title="Share on Reddit"> <i class="fa fa-reddit"></i></button>
                <button id="ss_linkedin" class="btn btn-secondary social_share_icon" data-toggle="tooltip" data-placement="bottom" title="Share on LinkedIn"> <i class="fa fa-linkedin"></i></button>
                <button id="ss_whatsapp" class="btn btn-secondary social_share_icon" data-toggle="tooltip" data-placement="bottom" title="Share on Whatsapp"> <i class="fa fa-whatsapp"></i></button>
                <button id="ss_email" class="btn btn-secondary social_share_icon" data-toggle="tooltip" data-placement="bottom" title="Share by Email"> <i class="fa fa-envelope"></i></button>
                <button id="ss_bookmark" class="btn btn-secondary social_share_icon" data-toggle="tooltip" data-placement="bottom" title="Bookmark this link"> <i class="fa fa-bookmark"></i></button>
                <button id="ss_copylink" class="btn btn-secondary social_share_icon" data-toggle="tooltip" data-placement="bottom" title="Copy link to clipboard"> <i class="fa fa-link"></i></button>
            </div>
            <div class="row" >
                <div class="col-sm-12">
                    <label for="filter_brand" class="small_label">Filter by Brand</label>
                    <select id="filter_brand">
                        <option value="any" selected>Any</option>
                    </select> 
                </div> 
<?php 
    if ( $atts["device"]=="headphones" ){
        $display = 'block';
        $searchbytxt = ', Principle';
    }else{
        $display = 'none';
        $searchbytxt = '';
    }
?>   
                <div class="col-sm-12" id="frontend_filter_by_principle" style="display:<?= $display ?>">
                    <label for="filter_brand" class="small_label">Filter by Principle</label>
                    <select id="filter_principle">
                        <option value="any" selected>Any</option>
                    </select>
                </div> 

                <div class="col-sm-12">
                    <label for="filter_genre" class="small_label">Filter by Genre</label>
                    <select id="filter_genre"> 
                        <option value="any" selected>Any</option> 
                    </select>
                </div>

                <div class="col-sm-12">
                <label for="filter_price" class="small_label">Filter by Price</label>
                    <div class="" id="filter_price">
                        <div class="col-sm-6">
                            <div class="txtlbl">From:</div>
                            <input type=number id="hr_price_from" class="form-control" style="" placeholder="From" min=0>
                        </div>
                        <div class="col-sm-6">
                        <div class="txtlbl">To:</div>
                            <input type=number id="hr_price_to" class="form-control" style="" placeholder="To" min=1>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-md-6" id="search_div">
            <div class="row">
                <label for="hr_search_input_group" class="small_label">Search Headphones</label>
                <div class="input-group hr_locked" id="hr_search_input_group">
                    <input type="text" id="hr_search_term" class="form-control" placeholder="Search by Brand, Model<?= $searchbytxt ?> or Genre" data-toggle="tooltip" data-placement="bottom" title="by headphone, principle or genre">
                    <button type="button" id="hr_search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                    <button type="button" id="hr_search_cancel" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>

            <hr>
            <div class="row" id="frontend_html_placeholder"></div> 
        </div>
    </div>
</div>


<div class="container" id="sponsors_area">
    <div class="row">
        <div class="col-sm-3 m-0 p-0 text-center bannerclass" id="banner1">
            <a href="#" target="_blank"><img src="<?= $plugin_url ?>assets/img/small_banner_default.jpg"></a>
        </div>
        <div class="col-sm-3 m-0 p-0 text-center bannerclass" id="banner2">
            <a href="#" target="_blank"><img src="<?= $plugin_url ?>assets/img/small_banner_default.jpg"></a>
        </div>
        <div class="col-sm-3 m-0 p-0 text-center bannerclass" id="banner3">
            <a href="#" target="_blank"><img src="<?= $plugin_url ?>assets/img/small_banner_default.jpg"></a>
        </div>
        <div class="col-sm-3 m-0 p-0 text-center bannerclass" id="banner4">
            <a href="#" target="_blank"><img src="<?= $plugin_url ?>assets/img/small_banner_default.jpg"></a>
        </div>
    </div>
</div>



<div class="container" id="hr_table_container">
    <div class="row">
        <div class="col-sm-12" id="hr_stats_row" style="position:relative">
            <img id="hranker_loader" src="/wp-content/plugins/headphone_ranker/assets/loading.gif" />
            <div id="hr_message" class="text-right">Retrieving ...</div>
        </div>
    </div>
    <div class="row" id="data_table_container">
        
        <table id="hranker_table" hr_showing="headphones" class="col-sm-12 table-striped">
            <thead class="hr_locked">
                <tr> 
                    <th class="hrt_rank" width="6%" data-toggle="tooltip" data-placement="top" title="Ranking: A (Best) to F (Worst)">
                        Rank<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div>
                    </th>
                    <th class="hrt_brand" width="6%" data-toggle="tooltip" data-placement="top" title="Brand of the device">
                        <span id="hr_brand_name">Brand</span><div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_device" width="6%" data-toggle="tooltip" data-placement="top" title="Model of the device">
                        <span id="hr_device_name">Model</span><div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_price" width="8%" data-toggle="tooltip" data-placement="top" title="Original Cost">
                        Price($)<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <th class="hrt_value" width="6%" data-toggle="tooltip" data-placement="top" title="Worth of headphone compared to price">
                        Value<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <?php 
                        if ( $atts["device"]=="headphones" ){
                    ?>
                            <th class="hrt_principle" data-toggle="tooltip" data-placement="top" title="Driver type and earcup design">
                        Principle<div class="hr_sort"><i class="fa fa-sort-up"></i> <i class="fa fa-sort-down"></i></div></th>
                    <?php
                        }
                    ?>
                    
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