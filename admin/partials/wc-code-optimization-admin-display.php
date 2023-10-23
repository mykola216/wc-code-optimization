<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Wc_Code_Optimization
 * @subpackage Wc_Code_Optimization/admin/partials
 */

?>


    <form action="options.php" method="POST">

        <?php

        $option_filds = 'tabs_one';
        $options = get_option($option_filds . '_option');
        settings_fields($option_filds . '_group');
        do_settings_sections($option_filds . '_group');

        ?>
        <div id="controll_opt_wc">
            <h3 id="comments">Setings default</h3>

            <p>

                <?php $color_text = 'id_opt'; ?>
                <input type="text" class="regular-text" size="100" tabindex="1" style="width: auto;"
                       id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       value="<?php if (!empty($options[$color_text])) {
                           echo $options[$color_text];
                       } else {
                           echo '';
                       } ?>"
                />
                <label for="author">
                    <small>id_opt</small>
                </label>
            </p>
            <p>

                <?php $color_text = 'site_url'; ?>
                <input type="text" class="regular-text" size="100" tabindex="1" style="width: auto;"
                       id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       value="<?php if (!empty($options[$color_text])) {
                           echo $options[$color_text];
                       } else {
                           echo '';
                       } ?>"
                />
                <label for="email">
                    <small>site_url</small>
                </label>
            </p>
            <p>
                <?php $color_text = 'page_send_cov'; ?>
                <input type="text" class="regular-text" size="100" tabindex="1" style="width: auto;"
                       id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       value="<?php if (!empty($options[$color_text])) {
                           echo $options[$color_text];
                       } else {
                           echo '';
                       } ?>"
                />
                <label for="url">
                    <small>page_send_cov</small>
                </label>
            </p>
            <p>

                <?php $color_text = 'site_url_page'; ?>
                <input type="text" class="regular-text" size="100" tabindex="1" style="width: auto;"
                       id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       value="<?php if (!empty($options[$color_text])) {
                           echo $options[$color_text];
                       } else {
                           echo '';
                       } ?>"
                />
                <label for="url">
                    <small>site_url_page</small>
                </label>
            </p>
            <p>
                <?php $color_text = 'secret_key'; ?>
                <input type="text" class="regular-text" size="100" tabindex="1" style="width: auto;"
                       id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       value="<?php if (!empty($options[$color_text])) {
                           echo $options[$color_text];
                       } else {
                           echo '';
                       } ?>"
                />
                <label for="url">
                    <small>secret_key</small>
                </label>
            </p>
            <p>
                <?php $color_text = 'api_url'; ?>
                <input type="text" class="regular-text" size="100" tabindex="1" style="width: auto;"
                       id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       value="<?php if (!empty($options[$color_text])) {
                           echo $options[$color_text];
                       } else {
                           echo '';
                       } ?>"
                />
                <label for="url">
                    <small>api_url</small>
                </label>
            </p>
            <p>
                <?php $color_text = 'plugins_url'; ?>
                <input type="text" class="regular-text" size="100" tabindex="1" style="width: auto;"
                       id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       value="<?php if (!empty($options[$color_text])) {
                           echo $options[$color_text];
                       } else {
                           echo '';
                       } ?>"
                />
                <label for="url">
                    <small>plugins_url</small>
                </label>
            </p>
            <p>
                <?php $color_text = 'cache_url'; ?>
                <input type="text" class="regular-text" size="100" tabindex="1" style="width: auto;"
                       id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       value="<?php if (!empty($options[$color_text])) {
                           echo $options[$color_text];
                       } else {
                           echo '';
                       } ?>"
                />
                <label for="url">
                    <small>cache_url</small>
                </label>
            </p>
            <p>
                <?php $color_text = 'font_family'; ?>
                <input type="text" class="regular-text" size="100" tabindex="1" style="width: auto;"
                       id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       value="<?php if (!empty($options[$color_text])) {
                           echo $options[$color_text];
                       } else {
                           echo '';
                       } ?>"
                />
                <label for="url">
                    <small>font_family</small>
                </label>
            </p>
            <p>
                <?php $color_text = 'font_src'; ?>
                <input type="text" class="regular-text" size="100" tabindex="1" style="width: auto;"
                       id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                       value="<?php if (!empty($options[$color_text])) {
                           echo $options[$color_text];
                       } else {
                           echo '';
                       } ?>"
                />
                <label for="url">
                    <small>font_src</small>
                </label>
            </p>
            <div class="tabs">
                <div class="tab active">
                    Desktop
                </div>
                <div class="tab">
                    Mobile
                </div>
            </div>
            <div class="show">
                <p>
                    <?php $color_text = 'my_css_code'; ?>
                    <textarea type="text" style="width: 50%; min-height: 250px;" class="regular-text" size="100" tabindex="1" style="width: auto;"
                        id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        value=""
                    ><?php if (!empty($options[$color_text])) {
                            echo $options[$color_text];
                        } else {
                            echo '';
                        } ?></textarea>
                    <label for="url">
                        <small>my_css_code</small>
                    </label>
                </p>
                <p>
                    <?php $color_text = 'css_id_or_class_click'; ?>
                    <textarea type="text" style="width: 50%; min-height: 250px;" class="regular-text" size="100" tabindex="1" style="width: auto;"
                        id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        value=""
                    ><?php if (!empty($options[$color_text])) {
                            echo $options[$color_text];
                        } else {
                            echo '';
                        } ?></textarea>
                    <label for="url">
                        <small>css_id_or_class_click</small>
                    </label>
                </p>
                <p>
                    <?php $color_text = 'css_id_or_class_hover'; ?>
                    <textarea type="text" style="width: 50%; min-height: 250px;" class="regular-text" size="100" tabindex="1" style="width: auto;"
                        id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        value=""
                    ><?php if (!empty($options[$color_text])) {
                            echo $options[$color_text];
                        } else {
                            echo '';
                        } ?></textarea>
                    <label for="url">
                        <small>css_id_or_class_hover</small>
                    </label>
                </p>
                <p>
                    <?php $enable_disable_plugin = 'enable_disable_plugin'; ?>
                    <input type="checkbox" id="<?php echo $option_filds; ?>_option[<?php echo $enable_disable_plugin; ?>]"
                        name="<?php echo $option_filds; ?>_option[<?php echo $enable_disable_plugin; ?>]"
                        <?php if (!empty($options[$enable_disable_plugin])) {
                            echo 'checked="checked"';
                        } ?>
                    >
                    <label for="<?php echo $option_filds; ?>_option[<?php echo $enable_disable_plugin; ?>]">
                        <small>enable_disable_plugin</small>
                    </label>
                </p>
            </div>
            <div class="hide">
                <p>
                    <?php $color_text = 'my_css_code_mobile'; ?>
                    <textarea type="text" style="width: 50%; min-height: 250px;" class="regular-text" size="100" tabindex="1" style="width: auto;"
                        id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        value=""
                    ><?php if (!empty($options[$color_text])) {
                            echo $options[$color_text];
                        } else {
                            echo '';
                        } ?></textarea>
                    <label for="url">
                        <small>my_css_code_mobile</small>
                    </label>
                </p>
                <p>
                    <?php $color_text = 'css_id_or_class_click_mobile'; ?>
                    <textarea type="text" style="width: 50%; min-height: 250px;" class="regular-text" size="100" tabindex="1" style="width: auto;"
                        id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        value=""
                    ><?php if (!empty($options[$color_text])) {
                            echo $options[$color_text];
                        } else {
                            echo '';
                        } ?></textarea>
                    <label for="url">
                        <small>css_id_or_class_click_mobile</small>
                    </label>
                </p>
                <p>
                    <?php $color_text = 'css_id_or_class_hover_mobile'; ?>
                    <textarea type="text" style="width: 50%; min-height: 250px;" class="regular-text" size="100" tabindex="1" style="width: auto;"
                        id="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        name="<?php echo $option_filds; ?>_option[<?php echo $color_text; ?>]"
                        value=""
                    ><?php if (!empty($options[$color_text])) {
                            echo $options[$color_text];
                        } else {
                            echo '';
                        } ?></textarea>
                    <label for="url">
                        <small>css_id_or_class_hover_mobile</small>
                    </label>
                </p>
                <p>
                    <?php $enable_disable_plugin = 'enable_disable_plugin'; ?>
                    <input type="checkbox" id="<?php echo $option_filds; ?>_option[<?php echo $enable_disable_plugin; ?>]"
                        name="<?php echo $option_filds; ?>_option[<?php echo $enable_disable_plugin; ?>]"
                        <?php if (!empty($options[$enable_disable_plugin])) {
                            echo 'checked="checked"';
                        } ?>
                    >
                    <label for="<?php echo $option_filds; ?>_option[<?php echo $enable_disable_plugin; ?>]">
                        <small>enable_disable_plugin</small>
                    </label>
                </p>
            </div>
        </div>
        <?php
        submit_button();
        ?>
    </form>
    <?php


        function page_control_api_arrey_my ($page_name) {
            $page_arrey = [
                'index.html' => 'homedesctop',
                'index-webp.html' => 'homedesctop',

            ];

            return $page_arrey[''];
        }
        $cachedPageURL = ABSPATH;
            //var_dump($cachedPageURL);
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
            $url = "https://";
        else
            $url = "http://";
        // Append the host(domain name, ip) to the URL.
        $url.= $_SERVER['HTTP_HOST'];
        
        // Append the requested resource location to the URL
        //$url.= $_SERVER['REQUEST_URI'];

        //echo $url;
        
        $all_files = array();
        $color_text = 'plugins_url';
        if (!empty($options[$color_text])) {
        $plugins_url_cache = $options[$color_text];
        $cachedPageURL = ABSPATH . $plugins_url_cache;
        $mydir = $cachedPageURL;
        $myitems = array_diff(scandir($mydir), array('.', '..'));

    ?>
    <div class="show">
    <?php
        foreach ($myitems as $item) {
            $itemPath = $mydir . DIRECTORY_SEPARATOR . $item;

                if (is_file($itemPath) && strpos($item, 'mobile') === false) {
                    echo '<p><div class="button button-primary wc-optimized-cached-file">' . $item . '</div></p>';
                    $all_files[] = $item;
                }
            }
        }

        ?>
    </div>
    <div class="hide">
        <?php
        foreach ($myitems as $item) {
            $itemPath = $mydir . DIRECTORY_SEPARATOR . $item;
        
            if (is_file($itemPath) && strpos($item, 'mobile') !== false) {
                echo '<p><div class="button button-primary wc-optimized-cached-file">' . $item . '</div></p>';
                $all_files[] = $item;
            }
        }
        
        

        ?>
    </div>
    <p>Select exclude css</p>
    <?php
    $file_select_css = null;
    foreach ($all_files as $file) {
        $file_array = explode('.', $file);
        if(substr($file, 0, 4) === "old_"){
            $file_select_css = $file;
            break;
        };
        end($file_array) === 'html' ? $file_select_css = $file : $file_select_css;
    }
    $domain = parse_url(home_url(), PHP_URL_HOST);
    $cachedPageURL = ABSPATH . $options['plugins_url'] . $file_select_css;
    $htmlContent = file_get_contents($cachedPageURL);
    preg_match_all('/<link[^>]*href=[\'"]([^\'"]+\.css[^\'"]*)[\'"][^>]*>/i', $htmlContent, $cssLinks);
    $selected_css = get_option('selected_css');
    ?>
    <select class="select-exclude-css-multiple" id="selected_exclude_css" style="width: 50%; min-height: 250px;" name="selected_exclude_css[]"
            multiple="multiple" style="width: 100%;">
        <?php
        foreach ($cssLinks[1] as $cssKey => $cssUrl) {
            preg_match('/id=[\'"]([^\'"]+)[\'"]/', $cssLinks[0][$cssKey], $cssIDs);
            $selected = in_array($cssIDs[1], $selected_css) ? 'selected="selected"' : '';
            echo '<option value="' . $cssIDs[1] . '" css_url="' . $cssUrl . '"' . $selected . '>' . "id='{$cssIDs[1]}'" . '</option>';
        }
        ?>
    </select>
    <br>
    <br>
    <br>
    <br>
    <div class="external_scripts show" page="desktop">
        <?php 
        // Регулярний вираз для знаходження всіх скриптів
        $regex = '/<script[^>]+src=["\']((?!(?:' . preg_quote($url, '/') . ')).+?)["\'][^>]*>/i';
        
        // Знайдемо всі входження в регулярному виразі
        if (preg_match_all($regex, $htmlContent, $matches)) {
            // $matches[1] містить URL-адреси скриптів
            $scriptURLs = $matches[1];

            // Виведемо ті скрипти, у яких в src відсутній ваш домен разом із чекбоксами
            foreach ($scriptURLs as $scriptURL) {
                echo '<label style="font-size: 20px;">';
                echo '<input type="checkbox" name="selectedScriptsDesktop[]" value="' . $scriptURL . '">';
                echo $scriptURL;
                echo '</label>';
                echo "<br>";
                echo "<br>";
            }
            echo '<p><div class="button button-primary combine_js" page="desktop" style="background-color: lightgreen; color: #000;">Combine js codes</div></p>';
        }else{
            echo '<h3 style="color: maroon;">No external js scripts</h3>';
        } 
        ?>
    </div>
    <div class="external_scripts hide" page="mobile">
        <?php 
        foreach ($all_files as $file) {
           // Перевірка, чи в файлі присутнє слово "mobile"
            if (strpos($file, 'mobile') !== false) {
                // Перевірка, чи ім'я файлу закінчується на ".html"
                if (pathinfo($file, PATHINFO_EXTENSION) === 'html') {
                    $mobile_cache = $file;
                }
            }
        }
        $cachedPageURLMobile = ABSPATH . $options['plugins_url'] . $mobile_cache;
        $htmlContentMobile = file_get_contents($cachedPageURLMobile);
        // Регулярний вираз для знаходження всіх скриптів
        $regex = '/<script[^>]+src=["\']((?!(?:' . preg_quote($url, '/') . ')).+?)["\'][^>]*>/i';
        
        // Знайдемо всі входження в регулярному виразі
        if (preg_match_all($regex, $htmlContentMobile, $matches)) {
            // $matches[1] містить URL-адреси скриптів
            $scriptURLs = $matches[1];

            // Виведемо ті скрипти, у яких в src відсутній ваш домен разом із чекбоксами
            foreach ($scriptURLs as $scriptURL) {
                echo '<label style="font-size: 20px;">';
                echo '<input type="checkbox" name="selectedScriptsMobile[]" value="' . $scriptURL . '">';
                echo $scriptURL;
                echo '</label>';
                echo "<br>";
                echo "<br>";
            }
            echo '<p><div class="button button-primary combine_js" page="mobile" style="background-color: lightgreen; color: #000;">Combine js codes</div></p>';
        }else{
            echo '<h3 style="color: maroon;">No external js scripts</h3>';
        } 
        ?>
    </div>
    <br>
    <p><div class="button button-primary" id="clear_optimized_css" style="background-color: red;">Clear optimized css</div></p>
    <!-- This file should primarily consist of HTML with a little bit of PHP. -->
    <!-- <select name="select_page" id="select_page">
        <option value="" disabled selected>Виключити CSS з оптимізації</option>
        <option value="home-page">index.html</option>
        <option value="home-page">index-webp.html</option>
    </select> -->
    <br>
    <br>
    
    <br>
    <!-- <button class="button button-primary" id="generate-optimized-css-code">Generate optimized css code</button>
    <button class="button button-primary" id="send-data-server">Send data to the server</button> -->
    <div class="lds-roller" style="display: none;">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <br>
    <p id="optimization-css"></p>
    <!-- <button class="button button-primary" id="saveButton">Generate optimized css code</button> -->





