<?php
/*
Plugin Name: Better Posts Plus
Plugin URI: https://portfolio.aimweb.pl/better-posts-plus-wordpress-plugin/
Description: The simplest way to change posts order (and more!) to create your own style!
Version: 0.9.5
Author: Mateusz Mikos
Author URI: https://aimweb.pl
License: GPL2
Domain Path: /languages/
*/

defined('ABSPATH') or die('Access Denied');

// Check if the class exists
if (class_exists('RPAimweb')){
    $rpAimweb = new RPAimweb();
}



// activation hook

register_activation_hook(
    __FILE__, 
    array(
        $rpAimweb, 
        'activate'
    )
);


// deactivation hook

register_deactivation_hook(
    __FILE__, 
    array(
        $rpAimweb, 
        'deactivate'
    )
);



//TODO:error in plugin_action_links... //add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'rp_aimweb_add_action_links');





class RPAimweb {
    public $plugin_name = "Better Posts+ Reorder your blog!";
    public $words = array();
    function __construct()
    {
        // ADD MENU TO DASHBOARD:

        add_action(
            'admin_menu', 
            array($this, 'menu')
        );


        // Post order modify:

        add_action(
            'pre_get_posts', 
            array($this, 'order_modify')
        );


        // Settings pages:

        add_action(
            'admin_init', 
            array($this, 'settings_init')
        );


        // Load languages:

        add_action(
            'plugins_loaded', 
            array($this, 'load_textdomain')
        );
        
        
        // texts for translation:
        
        $this->words['orderby_def'] = _x(' by date (default)', 'e.g. Order...', 'rp-aimweb');
        $this->words['order_def'] = __(' descending (default)', 'rp-aimweb');
        $this->words['order_def'] = __(' descending (default)', 'rp-aimweb');
        $this->words['ID'] = _x(' by post ID', 'e.g. Order...', 'rp-aimweb');
        $this->words['author'] = _x(' by author', 'e.g. Order...', 'rp-aimweb');
        $this->words['title'] = _x(' by title', 'e.g. Order...', 'rp-aimweb');
        $this->words['name'] = _x(' by slug', 'e.g. Order...', 'rp-aimweb');
        $this->words['date'] = _x(' by date', 'e.g. Order...', 'rp-aimweb');
        $this->words['modified'] = _x(' by modification date', 'e.g. Order...', 'rp-aimweb');
        $this->words['type'] = _x(' by type', 'e.g. Order...', 'rp-aimweb');
        $this->words['comment_count'] =_x(' by number of comments', 'e.g. Order...', 'rp-aimweb');
        $this->words['rand'] =_x(' randomly', 'Sort randomly', 'rp-aimweb');
        $this->words['DESC'] =__(' descending (Z-A)', 'rp-aimweb');
        $this->words['ASC'] =__(' ascending (A-Z)', 'rp-aimweb');
        $this->words['settings'] =__('Settings', 'rp-aimweb');
        $this->words['welcome'] =__('Welcome to ', 'rp-aimweb');
        $this->words['save'] =__('Save Changes', 'rp-aimweb');
        $this->words['reset'] =__('Restore defaults', 'rp-aimweb');
        $this->words['reset_done'] =__('Settings have been reset', 'rp-aimweb');
        $this->words['yes'] =__('Yes', 'rp-aimweb');
        $this->words['p_sort'] =_x('Sorting posts', 'e.g. sorting posts on the category page', 'rp-aimweb');
        $this->words['on_home'] =_x(' on the home page', 'e.g. sorting posts...', 'rp-aimweb');
        $this->words['on_home_u'] =__('On the home page', 'rp-aimweb');
        $this->words['on_cat'] =_x(' on the category page', 'e.g. sorting posts...', 'rp-aimweb');
        $this->words['on_cat_u'] =__('On the category page', 'rp-aimweb');
        $this->words['on_arc'] =_x(' on the archive page', 'e.g. sorting posts...', 'rp-aimweb');
        $this->words['on_arc_u'] =__('On the archive page', 'rp-aimweb');
        $this->words['lets_sort'] =_x(' sort posts ', 'e.g. On the home page sort posts by name', 'rp-aimweb');
        $this->words['lets_place'] =_x(' arrage posts ', 'e.g. On the home page arrage posts asc.', 'rp-aimweb');
        $this->words['your_posts'] =__(' Your posts ', 'rp-aimweb');
        $this->words['as_main'] =_x(' just like on the home page', 'e.g. On the home page sort posts...', 'rp-aimweb');
        $this->words['as_cat'] =_x(' just like on the category page ', 'e.g. On the home page sort posts...', 'rp-aimweb');
        $this->words['as_none'] =__(' default', 'rp-aimweb');
        $this->words['are_sorted'] =_x(' are sorted ', 'e.g. Your posts are sorted by...', 'rp-aimweb');
        $this->words['sticky_u'] =__('Sticky posts', 'rp-aimweb');
        $this->words['sticky'] =__(' sticky posts ', 'rp-aimweb');
        $this->words['are_ignored'] =_x(' are ignored (they haven\'t priority) ', 'e.g. Sticky posts...', 'rp-aimweb');
        $this->words['arent_ignored'] =_x(' have priority ', 'e.g. Sticky posts...', 'rp-aimweb');
        $this->words['ignore_u'] =__('Ignore', 'rp-aimweb');
        $this->words['ignore'] =__(' ignore ', 'rp-aimweb');
        $this->words['post_beh_u'] =__('Choose post\' behavior ', 'rp-aimweb');
        $this->words['leave_def'] =__('Leave the default number of posts per page', 'rp-aimweb');
        $this->words['leave_def_sort'] =__('Leave the default sort settings', 'rp-aimweb');
        $this->words['use_this'] =__('Use these settings: ', 'rp-aimweb');
        $this->words['use_same'] =_x('Use the same settings as ', 'e.g. ...on home page.', 'rp-aimweb');
        $this->words['without_pag'] =__('All posts on one page (without pagination) ',  'rp-aimweb');
        $this->words['show_s'] =__('Show %s posts per page ', 'rp-aimweb');
        $this->words['thank_u'] =__('Thank you for installing the plugin ', 'rp-aimweb');
        $this->words['actual_settings'] =__('Below we present the current configuration of the plugin', 'rp-aimweb');
        $this->words['aus'] =__('Are you sure you want to reset all the plugin settings?', 'rp-aimweb');
        $this->words['gotoset'] =__('Go to the plugin settings', 'rp-aimweb');
        $this->words['pagin_set'] =__('Pagination settings', 'rp-aimweb');
        $this->words['actual_posts_settings'] =__('Current post settings', 'rp-aimweb');
        $this->words['btp'] =__('Back to the plugin', 'rp-aimweb');
        $this->words['read_more_button'] =__('"Read More" Button', 'rp-aimweb');
        $this->words['read_more_button_custom'] =__('Set custom "Read More" button', 'rp-aimweb');
        $this->words['read_more_button_text'] =__('New "Read More" button text', 'rp-aimweb');
        $this->words['read_more_default'] =__('"Read More" button has default text', 'rp-aimweb');
    }
    
    
    // initialize settings
    public function settings_init() 
    {
        register_setting(
                'rp-aimweb', // Option group
                'rp-aimweb', // Option name
                array($this, 'validate')
            );
    }
    
    public function add_action_links($links) {
        $mylinks = array(
            '<a href="' . admin_url( 'options-general.php?page=myplugin' ) . '">Settings</a>',
        );
        return array_merge( $links, $mylinks );
    }
    
    public function menu()
    {
        add_menu_page(
            $this->words['welcome'].$this->plugin_name, 
            $this->plugin_name, 
            'manage_options', 
            'rp_aimweb_menu', 
            array($this, 'menu_main')
        );
        add_submenu_page(
            'rp_aimweb_menu', 
            $this->plugin_name.' '.$this->words['settings'], 
            $this->words['settings'], 
            'manage_options', 
            'rp_aimweb_menu_settings', 
            array(
                $this, 
                'menu_settings'
            )
        );
        add_submenu_page(
            'rp_aimweb_menu', 
            $this->plugin_name.' '.$this->words['reset'], 
            $this->words['reset'], 
            'manage_options', 
            'rp_aimweb_reset', 
            array(
                $this, 'plugin_reset'
            )
        );
    }
    
    public function activate()
    {
        echo 'for error';
    }
    public function deactivate()
    {
        echo 'for error';    
    }
    

    
    // load textdomain:
    public function load_textdomain(){
        load_plugin_textdomain('wp-admin-motivation', false, dirname(plugin_basename(__FILE__)).'/languages/');
    }
    
    public function menu_main()
    {
        include('admin/rp-aimweb-main.php');
    }
    
    public function menu_settings()
    {
        include('admin/rp-aimweb-settings.php');
    }
    
    public function plugin_reset()
    {
        echo '<div class="wrap">';
        echo '<form method="POST">';
        echo '<h1>'.$this->plugin_name.' '.$this->words['reset'].'</h1>';
        if (isset($_POST['reset'])){
            delete_option('rp-aimweb');
            echo '<h3>'.$this->words['reset_done'].'</h3>';
        }
        else {
            echo '<h3>';
            echo $this->words['aus'];
            echo '</h3>';
            submit_button($this->words['yes'].', '.$this->words['reset'], 'primary', 'reset', true);
        }
        echo '<a href="' . admin_url( 'admin.php?page=rp_aimweb_menu' ) . '">' . $this->words['btp'] . '</a>';
    }
    
    // aktualizacja ustawień
    public function options_update()
    {
        register_setting('rp-aimweb', 'rp-aimweb', array($this, 'validate'));
    }

    public function validate($input){
        $orderby_a = array(
            'ID', 'author', 'title', 'name', 'type', 'date', 'modified', 'comment_count', 'rand'
        );
        $order_a = array('DESC', 'ASC');
    
        $valid['orderby'] = 'date';
        $valid['orderby_cat'] = 'date';
        $valid['orderby_arc'] = 'date';


        $valid['order'] = 'DESC';
        $valid['order_cat'] = 'DESC';
        $valid['order_arc'] = 'DESC';

        $valid['cat_radio'] = 'as_main';
        $valid['arc_radio'] = 'as_main';

        $valid['pagin_select'] = 'default';
        $valid['pagin_num'] = 20;

        $valid['pagin_select_arc'] = 'default';
        $valid['pagin_num_arc'] = 20;

        $valid['sticky_ignore'] = 'imsticky';
        
        
        
        if (isset($input['orderby']) AND in_array($input['orderby'], $orderby_a)){
            $valid['orderby'] = $input['orderby'];
        }

        if (isset($input['order']) AND in_array($input['order'], $order_a)){
            $valid['order'] = $input['order'];
        }

        if (isset($input['orderby_cat']) AND in_array($input['orderby_cat'], $orderby_a)){
            $valid['orderby_cat'] = $input['orderby_cat'];
        }

        if (isset($input['order_cat']) AND in_array($input['order_cat'], $order_a)){
            $valid['order_cat'] = $input['order_cat'];
        }

        if (isset($input['orderby_arc']) AND in_array($input['orderby_arc'], $orderby_a)){
            $valid['orderby_arc'] = $input['orderby_arc'];
        }

        if (isset($input['order_arc']) AND in_array($input['order_arc'], $order_a)){
            $valid['order_arc'] = $input['order_arc'];
        }

        if (isset($input['cat_radio']) AND 
            ($input['cat_radio']=='as_main' OR $input['cat_radio'] == 'as_none' OR
            $input['cat_radio']=='as_own')){
            $valid['cat_radio'] = $input['cat_radio'];
        }
        if (isset($input['arc_radio']) AND 
                ($input['arc_radio']=='as_main' OR $input['arc_radio'] == 'as_none' OR
                $input['arc_radio']=='as_own' OR $input['arc_radio'] == 'as_cat')){
            $valid['arc_radio'] = $input['arc_radio'];
        }

        if (isset($input['pagin_select']) AND ($input['pagin_select'] == 'default' OR
            $input['pagin_select'] == 'allinone' OR $input['pagin_select'] == 'selfset')){
            $valid['pagin_select'] = $input['pagin_select'];
        }

        if (isset($input['pagin_select_arc']) AND ($input['pagin_select_arc'] == 'default' OR $input['pagin_select_arc'] == 'allinone' OR $input['pagin_select_arc'] == 'selfset')){
            $valid['pagin_select_arc'] = $input['pagin_select_arc'];
        }

        if (isset($input['pagin_num']) AND absint($input['pagin_num'])){
            $valid['pagin_num'] = $input['pagin_num'];
        }

        if (isset($input['pagin_num_arc']) AND absint($input['pagin_num_arc'])){
            $valid['pagin_num_arc'] = $input['pagin_num_arc'];
        }
        if (isset($input['sticky_ignore']))
        {
            $valid['sticky_ignore'] = 'ignore';
        }
        
        
        return $valid;
    }

    
    
    



    public function order_modify( $query ) {
        $options = get_option('rp-aimweb');
        $orderby = $options['orderby'];
        $order = $options['order'];

        $orderby_cat = 'date';
        $order_cat = 'DESC';

        $cat_radio = $options['cat_radio'];
        $arc_radio = $options['arc_radio'];

        $pagin_select = $options['pagin_select'];
        $pagin_num = $options['pagin_num'];

        $pagin_select_arc = $options['pagin_select_arc'];
        $pagin_num_arc = $options['pagin_num_arc'];
        
        $order_arc = $options['order_arc'];
        $orderby_arc = $options['orderby_arc'];

        $sticky_ignore = (isset($options['sticky_ignore'])) ? $options['sticky_ignore'] : 'imsticky';

        if ($sticky_ignore=='ignore')
        {
            $query->set('ignore_sticky_posts', true);
        }

        if ($cat_radio=='as_own'){
            $orderby_cat = $options['orderby_cat'];
            $order_cat = $options['order_cat'];
        }
        else if ($cat_radio=='as_main'){
            $orderby_cat = $orderby;
            $order_cat = $order;
        }
     
        if ($arc_radio=='as_own'){
            $orderby_arc = $options['orderby_arc'];
            $order_arc = $options['order_arc'];
        }
        else if ($arc_radio=='as_cat'){
            $orderby_arc = $orderby_cat;
            $order_arc = $order_cat;
        }
        else if ($arc_radio=='as_main'){
            $orderby_arc = $orderby;
            $order_arc = $order;
        }
     
        if ( $query->is_front_page() && $query->is_main_query() && !is_admin() ) {
            $query->set('orderby', $orderby);
            $query->set('order', $order);
        }
        else if ($query->is_category() AND $query->is_main_query() AND !is_admin()){
            $query->set('orderby', $orderby_cat);
            $query->set('order', $order_cat);
        }
        else if ($query->is_archive() AND $query->is_main_query() AND !is_admin()){
            $query->set('orderby', $orderby_arc);
            $query->set('order', $order_arc);
        }
        if ($query->is_main_query() && !is_admin()){
            if ($query->is_front_page())
            {
                if ($pagin_select=='selfset')
                    $query->set('posts_per_page', $pagin_num);
                else if ($pagin_select=='allinone')
                    $query->set('nopaging', true);
            } else {
                if ($pagin_select_arc=='selfset')
                    $query->set('posts_per_page', $pagin_num_arc);
                else if ($pagin_select_arc=='allinone')
                    $query->set('nopaging', true);
                }
            }
    }
}
