<?php
/**
 * @package headphone_ranker
 */

 /* 
 Plugin Name: Headphone Ranker
 Plugin URI: https://github.com/axawebs/headphoneranker
 Description: Custom created plugin for Headphone Ranking on Wordpress
 Version: 1.0
 Author: Chandima Jayasiri
 Author URI: mailto:chandimaj@icloud.com
 License: GPLV2 or later
 Text Domain: headphone_ranker
 */

 /*
 This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if (! defined( 'ABSPATH') ){
    die;
}

class headphoneRanker
{

    public $plugin_name;
    public $settings = array();
    public $sections = array();
    public $fields = array();

    //Method Access Modifiers
    // public - can be accessed from outside the class
    // protected - can only be accessed within the class ($this->protected_method())
    // protected - can only be accessed from constructor

    function __construct(){
        //add_action ('init', array($this, 'custom_post_type')); // tell wp to execute method on init
        $this->plugin_name = plugin_basename( __FILE__ );
    }

    function register(){
        add_shortcode( 'headphone_ranker', array($this, 'hr_shortcode_frontend') );

        add_action( 'admin_enqueue_scripts', array($this, 'enqueue_admin') );
        add_action( 'wp_enqueue_scripts', array($this, 'enqueue') );

        add_action ( 'admin_menu', array( $this, 'add_admin_pages' ));
        add_filter ("plugin_action_links_$this->plugin_name", array ($this, 'settings_link'));
       // add_filter( 'single_template', array($this, 'load_custom_post_specific_template'));
    }


    function add_admin_pages(){
        add_menu_page( 'Headphone Ranker Settings', 'HRanker Settings', 'manage_options', 'headphone_ranker_settings', array($this,'admin_index'), 'dashicons-pdf', 100);
    }    

    function admin_index(){
        //require template
        require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
    }


    function settings_link($links){
        //add custom setting link
        $settings_link = '<a href="admin.php?page=headphone_ranker_settings">Settings Page</a>';
        array_push ( $links, $settings_link );
        return $links;
    }


    function activate(){
        // Plugin activated state
        // generate a Custom Post Style
        // $this->custom_post_type();
        $this->create_table();
        // Flush rewrite rules 
        flush_rewrite_rules();
    }
 
    function deactivate(){
        // Plugin deactivate state
        //Flush rewrite rules
        flush_rewrite_rules();
    }

    function uninstall(){
        //Plugin deleted
        //delete Custom Post Style
        //delete all plugin data from the DB

    }


    function create_table(){ 
        // create table if not exist
        global $wpdb;

        // Headphones
        $table_name = $wpdb->prefix."hranker_headphones";
        if ($wpdb->get_var('SHOW TABLES LIKE '.$table_name) != $table_name) {
            $sql = 'CREATE TABLE '.$table_name.'(
            id INTEGER NOT NULL AUTO_INCREMENT,
            rank VARCHAR(50),
            device VARCHAR(50),
            price VARCHAR(20),
            value INT(2), 
            principle VARCHAR(100),
            overall_timbre VARCHAR(300),
            summary TEXT,
            ganre_focus VARCHAR(300),
            PRIMARY KEY  (id))';
            require_once(ABSPATH.'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            add_option("headphoneranker_db_version", "1.0");
        }

        // IEM
        $table_name = $wpdb->prefix."hranker_iem";
        if ($wpdb->get_var('SHOW TABLES LIKE '.$table_name) != $table_name) {
            $sql = 'CREATE TABLE '.$table_name.'(
            id INTEGER NOT NULL AUTO_INCREMENT,
            rank VARCHAR(50),
            device VARCHAR(50),
            price VARCHAR(20),
            value INT(2), 
            overall_timbre VARCHAR(300),
            summary TEXT,
            ganre_focus VARCHAR(300),
            PRIMARY KEY  (id))';
            require_once(ABSPATH.'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            add_option("headphoneranker_db_version", "1.1");
        }

        // Earbuds
        $table_name = $wpdb->prefix."hranker_earbuds";
        if ($wpdb->get_var('SHOW TABLES LIKE '.$table_name) != $table_name) {
            $sql = 'CREATE TABLE '.$table_name.'(
            id INTEGER NOT NULL AUTO_INCREMENT,
            rank VARCHAR(50),
            device VARCHAR(50),
            price VARCHAR(20),
            value INT(2), 
            principle VARCHAR(100),
            overall_timbre VARCHAR(300),
            summary TEXT,
            ganre_focus VARCHAR(300),
            PRIMARY KEY  (id))';
            require_once(ABSPATH.'wp-admin/includes/upgrade.php');
            dbDelta($sql);
            add_option("headphoneranker_db_version", "1.2");
        }
    }
    
    //Enqueue on admin pages
    function enqueue_admin($hook_suffix){

        if (strpos($hook_suffix, 'headphone_ranker_settings') !== false) {
            //Bootstrap
            wp_enqueue_style( 'bootstrap4_styles', plugins_url('/assets/bootstrap4/bootstrap_4_5_2_min.css',__FILE__));
            wp_enqueue_script( 'bootstrap4_scripts', plugins_url('/assets/bootstrap4/bootstrap_4_5_2_min.js',__FILE__), array('jquery','headphoneranker_popper_scripts'));
            //Font-Awesome
            wp_enqueue_style( 'fontawesome_css', plugins_url('/assets/font_awesome/css/font-awesome.css',__FILE__));
            //Admin scripts and styles
            wp_enqueue_style( 'headphoneranker_admin_styles', plugins_url('/assets/hranker_admin_style.css',__FILE__));
            wp_enqueue_script( 'headphoneranker_admin_script', plugins_url('/assets/hranker_admin_scripts.js',__FILE__), array('jquery'));
            //Select2
            wp_enqueue_style( 'headphoneranker_select2_styles', plugins_url('/assets/select2/select2.css',__FILE__));
            wp_enqueue_script( 'headphoneranker_select2_scripts', plugins_url('/assets/select2/select2.full.js',__FILE__), array('jquery'));
            //Popper
            wp_enqueue_script( 'headphoneranker_popper_scripts', plugins_url('/assets/popper/popper.min.js',__FILE__), array('jquery'));
        }
    }

    //Enqueue on all other pages
    function enqueue(){ 

        //Load only on page id = 2
        global $post;
        $post_slug = $post->post_name;

        if ( $post_slug=="ranking" ){
            //Bootstrap
         wp_enqueue_style( 'bootstrap4_styles', plugins_url('/assets/bootstrap4/bootstrap_4_5_2_min.css',__FILE__),93);
         wp_enqueue_script( 'bootstrap4_scripts', plugins_url('/assets/bootstrap4/bootstrap_4_5_2_min.js',__FILE__), array('jquery','headphoneranker_popper_scripts'));
         //Font-Awesome
         wp_enqueue_style( 'fontawesome_css', plugins_url('/assets/font_awesome/css/font-awesome.css',__FILE__),90);
         //Admin scripts and styles
         wp_enqueue_style( 'headphoneranker_styles', plugins_url('/assets/hranker_style.css',__FILE__),99);
         wp_enqueue_script( 'headphoneranker_script', plugins_url('/assets/hranker_scripts.js',__FILE__), array('jquery'));
         //Select2
         wp_enqueue_style( 'headphoneranker_select2_styles', plugins_url('/assets/select2/select2.css',__FILE__),98);
         wp_enqueue_script( 'headphoneranker_select2_scripts', plugins_url('/assets/select2/select2.full.js',__FILE__), array('jquery'));
          //Popper
        wp_enqueue_script( 'headphoneranker_popper_scripts', plugins_url('/assets/popper/popper.min.js',__FILE__), array('jquery'));
        }
    }





    //------ Shortcode
    function hr_shortcode_frontend(){

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
</div>

<div class="container" id="admin-container" style="margin-top:20px !important">
    <div class="row">
        <div class="col-sm-12">
            <img id="hranker_loader" src="/wp-content/plugins/headphone_ranker/assets/loading.gif" />
            <div id="hr_message" class="text-right">Retrieving ...</div>
        </div> 
    </div>    
    <hr />
    <div class="row">
    <div class="col-md-6">
            <select id="admin_product_select">
                <option value="headphones" selected>Headphones</option>
                <option value="iem" >IEM</option>
                <option value="earbuds" >Earbuds</option>
            </select>
        </div>
        <div class="col-md-6">
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
<?php
    }
    
}

if ( class_exists('headphoneRanker') ){
    $headphone_ranker = new headphoneRanker();
    $headphone_ranker -> register();
}

//activate
register_activation_hook (__FILE__, array($headphone_ranker, 'activate'));

//deactivation
register_deactivation_hook (__FILE__, array($headphone_ranker, 'deactivate'));