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

    private function page_control_api_array($page_name = '')
    {
        $page_array = [
            'index.html' => 'indexhtml',
            'index-webp.html' => 'indexwebphtml',
            'index-https.html' => 'indexhttpshtml',
            'index-webp-https.html' => 'indexwebphttpshtml',
            'index-mobile.html' => 'indexmobilehtml',
            'index-webp-mobile.html' => 'indexwebpmobilehtml',
            'index-https-mobile.html' => 'indexhttpsmobilehtml'

        ];

        return $page_array[$page_name];
    }

    private function page_control_api_url($page_name = '')
    {
        $page_array = [
            'indexhtml' => 'api/homedesctop',
            'indexwebphtml' => 'api/homedesctop',
            'indexhttpshtml' => 'api/homedesctop',
            'indexwebphttpshtml' => 'api/homedesctop',
            'indexmobilehtml' => 'api/homemobile',
            'indexwebpmobilehtml' => 'api/homemobile',
            'indexhttpsmobilehtml' => 'api/homemobile'
        ];

        return $page_array[$page_name];
    }

    private function get_protocol_and_uri()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $url = "https://";
        } else {
            $url = "http://";
        }
        $url .= $_SERVER['HTTP_HOST'];
        return $url;
    }

    private function get_setings_admin($name)
    {
        $option_filds = 'tabs_one';
        $options = get_option($option_filds . '_option');
        return $options[$name];
    }


    public function combineCSSOnHomepage()
    {
        $opt_page_ajax_name = '';
        $api_page_name = '';
        $combined_css_page_name = '';

        isset($_POST['selectedCss']) ? $this->get_save_selected_exclude_css($_POST['selectedCss']) : $this->get_save_selected_exclude_css(array());

        if (isset($_POST['optimizedPage'])) {
            $opt_page_ajax_name = $_POST['optimizedPage'];

            if (is_null($this->page_control_api_array($opt_page_ajax_name))) {
                echo "ERROR combineCSSOnHomepage - optimizedPage";
                exit;
            } else {
                $api_page_name = $this->page_control_api_array($opt_page_ajax_name);
            }


            $cachedPageContent = $this->getCachedPageContent($opt_page_ajax_name);
        } else {
            echo "ERROR combineCSSOnHomepage - optimizedPage";
        }

        $combined_css_page_name = 'combined-css-' . $api_page_name . '.css';
        $rebuild_page_html_name = 'rebuild-index-' . $api_page_name . '.html';
        $opt_css_prod_name = 'style-opt-prod-' . $api_page_name . '.css';

        echo '<br>$api_page_name             1111  ' . $api_page_name;
        echo '<br>$combined_css_page_name    2222  ' . $combined_css_page_name;
        echo '<br>$rebuild_page_html_name    3333  ' . $rebuild_page_html_name;
        echo '<br>$opt_css_prod_name         4444  ' . $opt_css_prod_name;


        /*
        if ($combined_css_page_name = '' && $rebuild_page_html_name = '' && $opt_css_prod_name = '') {
            echo "ERROR combineCSSOnHomepage - optimizedPage";
            exit;
        }
*/
        $cssLinks = isset($_POST['css_url']) ? $this->getCSSLinks($cachedPageContent, $_POST['css_url']) : $this->getCSSLinks($cachedPageContent, array());
        $combinedCSS = $this->combineCSSFiles($cssLinks, $cachedPageContent);
        $targetFolder = $this->getTargetFolder();
        $combinedCSSFile = $targetFolder . $combined_css_page_name;
        $this->saveCombinedCSSToFile($combinedCSS, $combinedCSSFile);
        $cachedPageContent = isset($_POST['css_url']) ? $this->removeStyleTags($cachedPageContent, $_POST['css_url']) : $this->removeStyleTags($cachedPageContent, array());
        $rebuildCachedPageFile = $targetFolder . $rebuild_page_html_name;
        $this->addCombinedCSSToHTML($cachedPageContent, $rebuildCachedPageFile, $combinedCSSFile, $combined_css_page_name, $rebuild_page_html_name, $opt_css_prod_name, $opt_page_ajax_name);
        $this->createGzipVersion($cachedPageContent, $rebuildCachedPageFile);
    }

    private function isHomepage()
    {
        return is_home() || is_front_page();
    }

    private function getCachedPageContent($cachedPage)
    {
        $cachedPageURL = ABSPATH . $this->get_setings_admin('plugins_url') . $cachedPage;
        if (file_get_contents($cachedPageURL)) {
            return file_get_contents($cachedPageURL);
        } else {
            return 'URL eror - getCachedPageContent';
        }
    }

    private function getCSSLinks($htmlContent, $exclude_css_link)
    {
        preg_match_all('/<link[^>]*href=[\'"]([^\'"]+\.css[^\'"]*)[\'"][^>]*>/i', $htmlContent, $cssLinks);
        $cssLinks_arr = !empty($exclude_css_link) ? array_diff($cssLinks[1], $exclude_css_link) : $cssLinks[1];
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
        if (!file_exists(ABSPATH . $this->get_setings_admin('cache_url'))) {
            mkdir(ABSPATH . $this->get_setings_admin('cache_url'), 0755, true);

            return ABSPATH . $this->get_setings_admin('cache_url');
        } else {
            return 'ERROR dir getTargetFolder';
        }
    }

    private function saveCombinedCSSToFile($combinedCSS, $combinedCSSFile)
    {
        file_put_contents($combinedCSSFile, $combinedCSS);
    }

    private function removeStyleTags($htmlContent, $allowedStyles)
    {
        // Перевіряємо, чи містить URL стилів у масиві $allowedStyles
        $htmlContent = preg_replace_callback('/<link[^>]*href=["\'](.*?)["\'].*?>/i', function ($match) use ($allowedStyles) {
            $url = $match[1];
            if (in_array($url, $allowedStyles)) {
                return $match[0]; // Залишаємо тег <link>, оскільки URL є у списку дозволених стилів
            } else {
                return ''; // Видаляємо тег <link>, оскільки URL не є у списку дозволених стилів
            }
        }, $htmlContent);

        // Видаляємо теги <style>
        $htmlContent = preg_replace('/<style[^>]*>(?:(?:(?!<\/style>)(?!<\/style>).)*?)<\/style>/is', '', $htmlContent);

        // Прибираємо зайві пробіли
        $htmlContent = preg_replace('/^\s+$/m', '', $htmlContent);

        return $htmlContent;
    }


    private function addCombinedCSSToHTML($htmlContent, $rebuildCachedPageFile, $combinedCSSFile, $combined_css_page_name, $rebuild_page_html_name, $opt_css_prod_name, $opt_page_ajax_name)
    {
        $combinedCSSLink = '<link rel="stylesheet" type="text/css" href="' . $this->get_setings_admin('cache_url') . basename($combinedCSSFile) . '" async>';
        $htmlContent = str_replace('</head>', $combinedCSSLink . '</head>', $htmlContent);
        file_put_contents($rebuildCachedPageFile, $htmlContent);
        isset($_POST['optimizedPage']) ? $this->send_data_server($_POST['optimizedPage'], $combined_css_page_name, $rebuild_page_html_name, $opt_css_prod_name, $opt_page_ajax_name) : '';
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
        echo 'Data has been successfully saved';
    }

    public function send_data_server($cachedPage, $combined_css_page_name, $rebuild_page_html_name, $opt_css_prod_name, $opt_page_ajax_name)
    {
        $domain = parse_url(home_url(), PHP_URL_HOST);

        if (strpos($cachedPage, 'mobile') !== false) {
            $css_id_or_class_click = $this->get_setings_admin('css_id_or_class_click_mobile');
            $css_id_or_class_hover = $this->get_setings_admin('css_id_or_class_hover_mobile');
            $my_css_code = $this->get_setings_admin('my_css_code_mobile');
        } else {
            $css_id_or_class_click = $this->get_setings_admin('css_id_or_class_click');
            $css_id_or_class_hover = $this->get_setings_admin('css_id_or_class_hover');
            $my_css_code = $this->get_setings_admin('my_css_code');
        }

        $jsonData = json_encode([
            'id' => $this->get_setings_admin('id_opt'),
            'site_url' => 'sht.nik',
            'page_send_cov' => 'home_desctop',
            'site_url_page' => $this->get_protocol_and_uri() . $this->get_setings_admin('cache_url') . $rebuild_page_html_name,
            'secret_key' => $this->get_setings_admin('secret_key'),
            'css_id_or_class_click' => $css_id_or_class_click,
            'css_id_or_class_hover' => $css_id_or_class_hover,
        ]);

        $opt_page_ajax_array = $this->page_control_api_array($opt_page_ajax_name);

        if ($uri_api_post_page = $this->page_control_api_url($opt_page_ajax_array)) {
            $uri_api_post = $this->get_setings_admin('api_url') . $uri_api_post_page;
            $ch = curl_init($uri_api_post);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData),
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            if (curl_errno($ch)) {
                echo 'Помилка cURL: ' . curl_error($ch);
                return;
            }

            $link_coverage_css = plugins_url('/', dirname(__FILE__)) . 'coverage-css/';
            $targetFolderPath = dirname(plugin_dir_path(__FILE__)) . '/coverage-css/';
            $dataArray = json_decode($response, true);

            $font_family = $this->get_setings_admin('font_family');
            $font_src = $this->get_setings_admin('font_src');
            $fonts = '@font-face { font-weight: normal; font-style: normal; font-family: "' . $font_family . '"; src: url("' . $font_src . '") format("' . end(explode('.', $font_src)) . '"); }';

            $cssCode = $fonts . $dataArray['message'];

            $patterns = [
                '/\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*and\s*\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*{\s*/',
                '/\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*and\s*\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*/',
                '/\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*and\s*\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*{\s*/',
                '/\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*and\s*\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*/',
                '/\\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*{/',
                '/\\(\s*min-width\s*:\s*\d+\s*px\s*\)\s*/',
                '/\\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*{/',
                '/\\(\s*max-width\s*:\s*\d+\s*px\s*\)\s*/',
                '/\(\s*overflow\s*:\s*clip\)\s*\{/',
                '/\(\s*max-width\s*:\s*\d+\.\d+\s*px\s*\)\s*\{/',
            ];

            $cleaned_css = preg_replace($patterns, '', $cssCode);

            $cachedPageURL = ABSPATH . $this->get_setings_admin('cache_url') . $rebuild_page_html_name;
            $htmlContent = file_get_contents($cachedPageURL);

            $htmlContent = str_replace($this->get_setings_admin('cache_url') . $combined_css_page_name, $link_coverage_css . $opt_css_prod_name, $htmlContent);

            $cachedPageURL = ABSPATH . $this->get_setings_admin('plugins_url');
            $cleaned_css .= $my_css_code;
            $output_css = $cachedPageURL . $opt_css_prod_name;
            file_put_contents($targetFolderPath . $opt_css_prod_name, $cleaned_css);

            $rebuildCachedPageFile = $cachedPageURL . $cachedPage;
            rename($rebuildCachedPageFile, $cachedPageURL . 'old_' . $cachedPage);
            file_put_contents($rebuildCachedPageFile, $htmlContent);

            $gzipContent = gzencode($htmlContent, 9);
            $rebuildCachedPageGzFile = $rebuildCachedPageFile . '.gz';
            file_put_contents($rebuildCachedPageGzFile, $gzipContent);

            echo $dataArray['resultItem'];
        } else {
            echo "ERROR send_data_server - api url";
        }
    }


    public function return_select_ajax_css()
    {


        echo '<select>';
    }

    // Рекурсивна функція для видалення вмісту директорій
    private function delete_directory_contents($path)
    {
        if (is_dir($path)) {
            $files = glob($path . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                } elseif (is_dir($file)) {
                    delete_directory_contents($file);
                    rmdir($file);
                }
            }
        }
    }

    public function clear_optimized_css()
    {
        $directory_coverage_css = dirname(plugin_dir_path(__FILE__)) . '/coverage-css/';
        // Виклик рекурсивної функції для видалення вмісту директорії
        $this->delete_directory_contents($directory_coverage_css);
        $directory_rebuilt_cached_page = dirname(plugin_dir_path(__FILE__)) . '/rebuilt-cached-page/';
        $this->delete_directory_contents($directory_rebuilt_cached_page);
        echo '<h3 style="color: green;">Optimized css deleted</h3>';
    }



    public function enable_disable_plugin()
    {
        echo '<h3 style="color: red;">The plugin is disabled</h3><br>';
    }


    public function combine_external_scripts()
    {
        if (isset($_POST['selectedScripts'])) {
            $selectedScripts = $_POST['selectedScripts'];
            $folderPath = ABSPATH . $this->get_setings_admin('plugins_url');

            // 1. Об'єднати вибрані скрипти в один файл
            $combinedScript = '';
            foreach ($selectedScripts as $scriptURL) {
                $combinedScript .= file_get_contents($scriptURL);
            }

            // 2. Зберегти об'єднані скрипти в папці плагіна
            $pluginPath = plugin_dir_path(__FILE__);
            $externalScriptsPath = $pluginPath . 'external-scripts/';
            if (!is_dir($externalScriptsPath)) {
                // Створення папки external-scripts, якщо вона не існує
                mkdir($externalScriptsPath);
            }
            $combinedFilePath = $externalScriptsPath . 'combined_scripts.js';
            file_put_contents($combinedFilePath, $combinedScript);

            if ($_POST['page'] === 'mobile') {
                // 3. Видалити поодинокі підключення цих скриптів з файлів
                $mobileFiles = glob($folderPath . '/*mobile*.html');
                if (!empty($mobileFiles)) {
                    foreach ($mobileFiles as $file) {
                        $fileContent = file_get_contents($file);
                        foreach ($selectedScripts as $scriptURL) {
                            // Заміна тегів <script> з атрибутами src на порожній рядок
                            $pattern = '/<script\s+[^>]*src=["\']' . preg_quote($scriptURL, '/') . '["\'][^>]*><\/script>/i';
                            $fileContent = preg_replace($pattern, '', $fileContent);
                        }
                        // 4. Підключити об'єднаний файл
                        $combinedScriptURL = plugins_url('external-scripts/combined_scripts.js', __FILE__);
                        $fileContent = str_replace('</head>', '<script src="' . $combinedScriptURL . '"></script></head>', $fileContent);
                        file_put_contents($file, $fileContent);
                    }
                } else {
                    echo "No mobile files found.";
                }
            } else {
                // 3. Видалити поодинокі підключення цих скриптів з файлів
                $desktopFiles = glob($folderPath . '/*index*.html');
                if (!empty($desktopFiles)) {
                    foreach ($desktopFiles as $file) {
                        if (strpos($file, 'mobile') === false) {
                            $fileContent = file_get_contents($file);
                            foreach ($selectedScripts as $scriptURL) {
                                // Заміна тегів <script> з атрибутами src на порожній рядок
                                $pattern = '/<script\s+[^>]*src=["\']' . preg_quote($scriptURL, '/') . '["\'][^>]*><\/script>/i';
                                $fileContent = preg_replace($pattern, '', $fileContent);
                            }
                            // 4. Підключити об'єднаний файл
                            $combinedScriptURL = plugins_url('external-scripts/combined_scripts.js', __FILE__);
                            $fileContent = str_replace('</head>', '<script src="' . $combinedScriptURL . '"></script></head>', $fileContent);
                            file_put_contents($file, $fileContent);
                        }
                    }
                } else {
                    echo "No desktop files found.";
                }
            }

            var_dump($selectedScripts);
        }
    }



    private function remove_file_dir($url_dim)
    {
        $files = glob($url_dim . '/*');
        // Delete all the files of the list
        foreach ($files as $file) {
            if (is_file($file)) {
                // Deleting the given file
                unlink($file);
            }
        }
    }
}
