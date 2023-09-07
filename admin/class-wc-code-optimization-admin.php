<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Wc_Code_Optimization
 * @subpackage Wc_Code_Optimization/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Code_Optimization
 * @subpackage Wc_Code_Optimization/admin
 * @author     Arsenii Tymkiv <tymkivarseniy@gmail.com>
 */
class Wc_Code_Optimization_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wc_Code_Optimization_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wc_Code_Optimization_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */


        $screen = get_current_screen();
        if ($screen->id === 'plugins_page_wc-code-optimization') {
            wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wc-code-optimization-admin.css', array(), $this->version, 'all');
            // Підключення JavaScript-файлу "select2.min.css"
            wp_enqueue_style('credit-terms-popup-select2-styles', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.1.0-rc.0');
        }
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Wc_Code_Optimization_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wc_Code_Optimization_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wc-code-optimization-admin.js', array('jquery'), $this->version, false);
        $screen = get_current_screen();
        if ($screen->id === 'plugins_page_wc-code-optimization') {
            // Підключення JavaScript-файлу "select2.min.js"
            wp_enqueue_script('credit-terms-popup-scripts', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array('jquery'), '4.1.0-rc.0', true);
        }
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */

    public function add_plugin_admin_menu()
    {

        /*
           * Add a settings page for this plugin to the Settings menu.
           *
           * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
           *
           *        Administration Menus: http://codex.wordpress.org/Administration_Menus
           *
           */
        add_plugins_page(
            'WC Code Optimization',
            'WC Code Optimizations',
            'manage_options',
            $this->plugin_name,
            array($this, 'display_plugin_setup_page')
        );
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    1.0.0
     */

    public function add_action_links($links)
    {
        /*
          *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
          */
        $settings_link = array(
            '<a href="' . admin_url('plugins.php?page=' . $this->plugin_name) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge($settings_link, $links);
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */

    public function display_plugin_setup_page()
    {
        include_once('partials/wc-code-optimization-admin-display.php');
    }

    public function options_update()
    {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
        register_setting('tabs_one_group', 'tabs_one_option', 'sanitize_callback');
    }

    public function validate($input)
    {
        $valid = array();
        return $valid;
    }


    public function combineCSSOnHomepage()
    {

        // if ($this->isHomepage()) {
        isset($_POST['selectedCss']) ? $this->get_save_selected_exclude_css($_POST['selectedCss']) : $this->get_save_selected_exclude_css(array());
        $cachedPageContent =  isset($_POST['optimizedPage']) ? $this->getCachedPageContent($_POST['optimizedPage']) : '';
        $cssLinks = isset($_POST['css_url']) ? $this->getCSSLinks($cachedPageContent, $_POST['css_url']) : $this->getCSSLinks($cachedPageContent, array());
        $combinedCSS = $this->combineCSSFiles($cssLinks, $cachedPageContent);
        $targetFolder = $this->getTargetFolder();
        $combinedCSSFile = $targetFolder . 'combined-css.css';
        $this->saveCombinedCSSToFile($combinedCSS, $combinedCSSFile);
        $cachedPageContent = $this->removeStyleTags($cachedPageContent);
        $rebuildCachedPageFile = $targetFolder . 'rebuild-index.html';
        $this->addCombinedCSSToHTML($cachedPageContent, $rebuildCachedPageFile, $combinedCSSFile);
        $this->createGzipVersion($cachedPageContent, $rebuildCachedPageFile);
        
        
        // }
    }

    private function isHomepage()
    {
        return is_home() || is_front_page();
    }

    private function getCachedPageContent($cachedPage)
    {
        $domain = parse_url(home_url(), PHP_URL_HOST);
        $cachedPageURL = ABSPATH . '/wp-content/cache/supercache/' . $domain . '/' . $cachedPage;
        //var_dump($cachedPageURL);
        return file_get_contents($cachedPageURL);
    }

    private function getCSSLinks($htmlContent, $exclude_css_link)
    {


        preg_match_all('/<link[^>]*href=[\'"]([^\'"]+\.css[^\'"]*)[\'"][^>]*>/i', $htmlContent, $cssLinks);
        $cssLinks_arr = !empty($exclude_css_link) ? array_diff($cssLinks[1], $exclude_css_link) : $cssLinks[1];
        //var_dump($cssLinks_arr);
        return $cssLinks_arr;
    }

    private function combineCSSFiles($cssLinks, $htmlContent)
    {
        $combinedCSS = '';
        foreach ($cssLinks as $cssUrl) {
            $cssContent = file_get_contents($cssUrl);
            $combinedCSS .= $cssContent;
        }
        preg_match_all('/<style[^>]*>(.*?)<\/style>/is', $htmlContent, $inlineStyles);
        foreach ($inlineStyles[1] as $inlineStyle) {
            $combinedCSS .= $inlineStyle;
        }
        return $combinedCSS;
    }

    private function getTargetFolder()
    {
        $currentFilePath = __FILE__;
        $rootPath = dirname(dirname($currentFilePath));
        return $rootPath . '/rebuilt-cached-page/';
    }

    private function saveCombinedCSSToFile($combinedCSS, $combinedCSSFile)
    {
        file_put_contents($combinedCSSFile, $combinedCSS);
    }

    private function removeStyleTags($htmlContent)
    {
        $htmlContent = preg_replace('/<link[^>]*stylesheet.*?>/i', '', $htmlContent);
        $htmlContent = preg_replace('/<style[^>]*>(?:(?:(?!<\/style>)(?!<\/style>).)*?)<\/style>/is', '', $htmlContent);
        $htmlContent = preg_replace('/^\s+$/m', '', $htmlContent);
        return $htmlContent;
    }

    private function addCombinedCSSToHTML($htmlContent, $rebuildCachedPageFile, $combinedCSSFile)
    {
        $combinedCSSLink = '<link rel="stylesheet" type="text/css" href="/wp-content/plugins/wc-code-optimization/rebuilt-cached-page/' . basename($combinedCSSFile) . '">';
        $htmlContent = str_replace('</head>', $combinedCSSLink . '</head>', $htmlContent);
        file_put_contents($rebuildCachedPageFile, $htmlContent);
        isset($_POST['optimizedPage']) ? $this->send_data_server($_POST['optimizedPage']) : '';
    }

    private function createGzipVersion($htmlContent, $rebuildCachedPageFile)
    {
        $gzipContent = gzencode($htmlContent, 9); // 9 - максимальна стисненість
        $rebuildCachedPageGzFile = $rebuildCachedPageFile . '.gz';
        file_put_contents($rebuildCachedPageGzFile, $gzipContent);
    }


    private function get_save_selected_exclude_css($exclude_css)
    {
        $selected_css = $exclude_css;
        update_option('selected_css', $selected_css);


        echo 'Дані успішно збережено';
    }

    public function send_data_server($cachedPage)
    {
        $domain = parse_url(home_url(), PHP_URL_HOST);
        $jsonData = json_encode(array(
            'id' => 234252666,
            'site_url' => 'sht.nik',
            "page_send_cov" => "home_desctop",
            "site_url_page" => "http://" . $domain ."/wp-content/plugins/wc-code-optimization/rebuilt-cached-page/rebuild-index.html",
            "secret_key" => "w04856309485gj03w9485g"
        ));


        $apiUrl = 'http://localhost:5000/api/homedesctop';


        $ch = curl_init($apiUrl);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));


        $response = curl_exec($ch);


        if (curl_errno($ch)) {
            echo 'Помилка cURL: ' . curl_error($ch);
        } else {
            $currentFilePath = __FILE__;

            $rootPath = dirname(dirname($currentFilePath));


            $targetFolderPath = $rootPath . '/rebuilt-cached-page/';
            $dataArray = json_decode($response, true);

            // Отримуємо CSS код з асоціативного масиву
            $cssCode = $dataArray['message'];


            $patterns = [
                '/\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*and\s*\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*{\s*/',
                '/\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*and\s*\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*/',
                '/\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*and\s*\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*{\s*/',
                '/\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*and\s*\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*/',
                '/\\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*{/',
                '/\\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*/',
                '/\\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*{/',
                '/\\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*/',
                '/\(\s*overflow\s*:\s*clip\)\s*\{/'
            ];


            $cleaned_css = preg_replace($patterns, '', $cssCode);
            // Замініть підключений CSS на test2.css в HTML
            
            $cachedPageURL = ABSPATH . '/wp-content/plugins/wc-code-optimization/rebuilt-cached-page/rebuild-index.html';
            $htmlContent = file_get_contents($cachedPageURL);


            $htmlContent = str_replace('/wp-content/plugins/wc-code-optimization/rebuilt-cached-page/combined-css.css', '/wp-content/cache/supercache/' . $domain . '/test2.css', $htmlContent);

            $domain = parse_url(home_url(), PHP_URL_HOST);
            $cachedPageURL = ABSPATH . '/wp-content/cache/supercache/' . $domain . '/';

            // Збережіть CSS у test2.css
            $output_css = $cachedPageURL . 'test2.css';
            file_put_contents($output_css, $cleaned_css);

            // Збережіть змінений HTML у rebuild-index-webp.html
            $rebuildCachedPageFile = $cachedPageURL . $cachedPage;
            
            // rename file
            rename($rebuildCachedPageFile,$cachedPageURL . 'old_' . $cachedPage);

            // create file new
            file_put_contents($rebuildCachedPageFile, $htmlContent, FILE_APPEND | LOCK_EX);


            // Створіть та збережіть файл rebuild-index-webp.html.gz
            $gzipContent = gzencode($htmlContent, 9);
            $rebuildCachedPageGzFile = $rebuildCachedPageFile . '.gz';
            file_put_contents($rebuildCachedPageGzFile, $gzipContent);

           // echo 'Відповідь від сервера: ' . $cleaned_css;
            echo 'Відповідь від сервера: ' . $cleaned_css;
        }


        curl_close($ch);
    }


    public function handleAjaxRequest()
    {

        $data = $_POST;


        $currentFilePath = __FILE__;

        $rootPath = dirname(dirname($currentFilePath));


        $target_folder_path = $rootPath . '/rebuilt-cached-page/';
        $coverage_json = $target_folder_path . 'coverage.json';
        $combined_css = $target_folder_path . 'combined-css.css';

        $coverage_data = file_get_contents($coverage_json);

        $coverage_data = json_decode($coverage_data, true);

        $css = array();
        foreach ($coverage_data as $data) {
            if (strpos($data['url'], $combined_css)) {
                foreach ($data['ranges'] as $range) {
                    $length = $range['end'] - $range['start'];
                    $css[] = mb_substr($data['text'], $range['start'], $length, "UTF-8");
                }
                break;
            }
        }

        $css = implode(PHP_EOL . PHP_EOL, $css);


        $patterns = [
            '/\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*and\s*\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*{\s*/',
            '/\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*and\s*\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*/',
            '/\\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*{/',
            '/\\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*/',
            '/\(\s*overflow\s*:\s*clip\)\s*\{/'
        ];


        $cleaned_css = preg_replace($patterns, '', $css);


        $output_css = $target_folder_path . 'test2.css';
        file_put_contents($output_css, $cleaned_css);

        //echo $cleaned_css;
        wp_die();
    }
}
