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
        </div>
        <?php
        submit_button();
        ?>
    </form>


    <?php


    $cachedPageURL = ABSPATH;
        var_dump($cachedPageURL);
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
        $url = "https://";
    else
        $url = "http://";
    // Append the host(domain name, ip) to the URL.
    $url.= $_SERVER['HTTP_HOST'];

    // Append the requested resource location to the URL
    //$url.= $_SERVER['REQUEST_URI'];

    echo $url;


    $color_text = 'plugins_url';
    if (!empty($options[$color_text])) {
        $plugins_url_cache = $options[$color_text];
        $cachedPageURL = ABSPATH . $plugins_url_cache;
        $mydir = $cachedPageURL;
        $myfiles = array_diff(scandir($mydir), array('.', '..'));
        foreach ($myfiles as $filename) {
            echo '<p><div class="button button-primary wc-optimized-cached-file">'.$filename. '</div></p>';
        }
    }
    ?>
    <br>
    <!-- This file should primarily consist of HTML with a little bit of PHP. -->
    <select name="select_page" id="select_page">
        <option value="" disabled selected>Select a page</option>
        <option value="home-page">Home page</option>
        <option value="home-page">Home page</option>
    </select>
    <br>
    <br>
<?php
$domain = parse_url(home_url(), PHP_URL_HOST);
$cachedPageURL = ABSPATH . '/wp-content/cache/supercache/' . $domain . '/index.html';
$htmlContent = file_get_contents($cachedPageURL);
preg_match_all('/<link[^>]*href=[\'"]([^\'"]+\.css[^\'"]*)[\'"][^>]*>/i', $htmlContent, $cssLinks);
$selected_css = get_option('selected_css');
?>
    <select class="select-exclude-css-multiple" id="selected_exclude_css" name="selected_exclude_css[]"
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
    <button class="button button-primary" id="generate-optimized-css-code">Generate optimized css code</button>
    <button class="button button-primary" id="send-data-server">Send data to the server</button>
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





