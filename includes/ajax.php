
<?php 


require_once(ABSPATH . 'wp-admin/includes/plugin.php');
class wedevs_Ajax_requiest_wp_plugin{

    public function __construct(){
        add_action('admin_menu', [$this, 'wedevs_ajax_menu_page'] );
        add_action( 'admin_enqueue_scripts', [$this, 'wedevs_ajax_scripts_page']);

        add_action( 'wp_ajax_academy_ajax_get_posts', [$this, 'academy_ajax_get_posts']);

        /**
         * if I send request from another page or fontend page
         * than under this function call
         */
        add_action( 'wp_ajax_nopriv_academy_ajax_get_posts', [$this, 'academy_ajax_get_posts']);

    }


    //link up js file of ajax
    public function wedevs_ajax_scripts_page( $hook){
       
        $plugin_data= get_plugin_data(__FILE__);

        $plugin_varsion=$plugin_data['Version'];
        
            // $plugins_url = plugin_dir_url(__FILE__) .'assets/';
            // $js_path=$plugins_url.'js/';
            
            /**
             * includes folder এর বাহিরে call করলে এভাবে call করতে হবে 
             */

            if('toplevel_page_ajax_requiest' == $hook){
                wp_enqueue_script( 'ajax-learning', WEDEVS_ACADEMY_URL . 'assets/js/ajax.js', array( 'jquery' ),$plugin_varsion, true );
                /**
                 * for ajax request send 
                 */
                wp_localize_script( 'ajax-learning', 'AcademyAjax', array(
                    'ajax_url' => admin_url( 'admin-ajax.php' ),
                    'ajax_nonce'=> wp_create_nonce( 'academy' )
                    
                ) );

            }
    
        }


    public function wedevs_ajax_menu_page(){
        add_menu_page(
            'Ajax Requiest',
            'Ajax Requiest',
            'manage_options',
            'ajax_requiest',
            [$this, 'wedevs_ajax_page']
        );
    }

    public function wedevs_ajax_page(){ 
            echo '<button class="wedevs-ajax-button" type="button">Click Me</button>';
        echo '<div class="wedevs-ajax-page"></div>';

    }

    //ajax request
    public function academy_ajax_get_posts(){

        check_ajax_referer('academy');

        $per_page= isset($_POST['per_page']) ? intval( $_POST['per_page']) : 10;
        $post= get_posts(array(
            'post_type'=>'page',
            'posts_per_page'=>$per_page
        ));

        wp_send_json($post);
      
    }

    
}