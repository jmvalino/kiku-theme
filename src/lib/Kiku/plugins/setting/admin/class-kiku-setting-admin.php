<?php

class Kiku_Setting_Admin {
    private $plugin_name;
    private $version;
    private $message;
    private $options;

    public function __construct( $plugin_name, $version ) {
        $this->options = $this->get_mokuji_option([
            'kiku_twitter' => "",
            'kiku_share_btn_twitter'  => true,
            'kiku_share_btn_facebook' => true,
            'kiku_share_btn_hatena'   => true,
            'kiku_share_btn_line'     => true,
        ]);
        add_action( 'admin_init', [$this, 'register_settings'] );
    }

    public function register_settings() {
        register_setting( 'kiku-settings-group', 'kiku_twitter' );
        register_setting( 'kiku-settings-group', 'kiku_share_btn_twitter' );
        register_setting( 'kiku-settings-group', 'kiku_share_btn_facebook' );
        register_setting( 'kiku-settings-group', 'kiku_share_btn_hatena' );
        register_setting( 'kiku-settings-group', 'kiku_share_btn_line' );
    }

    private function get_mokuji_option($defaults) {
         $options = get_option('kiku-setting-options', $defaults);
         $options = wp_parse_args( $options, $defaults );
         return $options;
    }

    public function add_admin_page() {
        add_theme_page(
            __('Setting', 'kiku'),  // page_title
            __('Setting', 'kiku'),  // menu_title
            'manage_options',       // capability
            'setting',              // menu_slug
            [$this, 'admin_options']
        );
    }

    public function admin_options(){
        require_once KIKU_LIB_PATH . 'plugins/setting/admin/partials/kiku-setting-admin-display.php';
    }

    public function save_admin_options() {
        if ( !current_user_can('manage_options') ){
            return false;
        }

        $input = [
            'kiku_twitter' => filter_input(INPUT_POST, 'kiku_twitter'),
            'kiku_share_btn_twitter'  => (boolean) filter_input(INPUT_POST, 'kiku_share_btn_twitter') ? true : false,
            'kiku_share_btn_facebook' => (boolean) filter_input(INPUT_POST, 'kiku_share_btn_facebook') ? true : false,
            'kiku_share_btn_hatena'   => (boolean) filter_input(INPUT_POST, 'kiku_share_btn_hatena') ? true : false,
            'kiku_share_btn_line'     => (boolean) filter_input(INPUT_POST, 'kiku_share_btn_line') ? true : false,
        ];

        $this->options = array_merge($this->options, $input);
        $result = update_option( 'kiku-setting-options', $this->options );

        return $result;
    }

}
