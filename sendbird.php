<?php
/**
 * Plugin Name: Sendbird AI chatbot
 * Description: Power an AI chatbot for your website in minutes
 * Version: 1.1.12
 * Author: Sendbird
 * Author URI: https://sendbird.com/
 * License: GPL2
 */


function sbaichat_register_settings()
{
    register_setting('sbaichat_options', 'sbaichat_app_id');
    register_setting('sbaichat_options', 'sbaichat_bot_id');
    register_setting('sbaichat_options', 'sbaichat_bot_enabled', array(
        'default' => true,
        'sanitize_callback' => 'boolval',
    ));
}

add_action('admin_init', 'sbaichat_register_settings');

add_action('admin_menu', 'sbaichat_plugin_menu');

function sbaichat_plugin_menu()
{
    add_submenu_page(
        'plugins.php',              // The parent slug (for the Plugins menu)
        'Sendbird AI chatbot',     // Page title
        'Sendbird AI chatbot',              // Menu title
        'manage_options',           // Capability required to see this menu item
        'sendbird-ai-chatbot',     // The slug by which this menu item is accessible
        'sbaichat_options_page' // The name of the function that renders the menu page
    );
}


function sbaichat_options_page()
{
    $plugin_logo_url = plugins_url('images/plugin_logo.svg', __FILE__);
    $link_logo_url = plugins_url('images/icon-link.svg', __FILE__);
    ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <div class="sbaichat-centered-container">
        <div class="sbaichat-centered-box">
            <div class="sbaichat-container">
                <div class="sbaichat-form-container">
                    <img src="<?php echo esc_url($plugin_logo_url); ?>" alt="Sendbird AI chatbot logo">
                    <div class="sbaichat-title">Connect your AI chatbot</div>
                    <div class="sbaichat-body">You can find your Sendbird application ID and bot ID <a href="https://dashboard.sendbird.com/application-id/ai-chatbots/list" target="_blank">here</a> under <b>AI chatbot > Manage bots > your Bot > Add to my website > WordPress.</b> If you don't have an account, get started <a href="https://sendbird.com/form/ai-chatbot-wordpress-plugin?utm_medium=web-referral&utm_source=wordpress-plugin&utm_campaign=fy25-q2-glbl-website-ai-chat-wordpress" target="_blank">here.</a></div>
                    <form method="post" action="options.php" id="sbaichat-form">
                        <?php settings_fields('sbaichat_options'); ?>
                        <?php do_settings_sections('sbaichat_options'); ?>

                        <label class="sbaichat-form-label" for="sbaichat_app_id">Application ID</label>
                        <input type="text" id="sbaichat_app_id" name="sbaichat_app_id"
                               value="<?php echo esc_attr(get_option('sbaichat_app_id')); ?>"
                               class="sbaichat-input"/>

                        <label class="sbaichat-form-label" for="sbaichat_bot_id">Bot ID</label>
                        <input type="text" id="sbaichat_bot_id" name="sbaichat_bot_id"
                               value="<?php echo esc_attr(get_option('sbaichat_bot_id')); ?>"
                               class="sbaichat-input"/>

                        <div class="sbaichat-bot-activation">
                            <label for="sbaichat_bot_activation">Enable widget</label>
                            <label class="sbaichat-switch">
                                <input type="checkbox" id="sbaichat_bot_enabled" name="sbaichat_bot_enabled" <?php checked(get_option('sbaichat_bot_enabled'), true); ?>>
                                <span class="sbaichat-slider"></span>
                            </label>
                        </div>


                        <div class="sbaichat-save-button-container">
                            <button type="button" id="sbaichat-submit-btn" class="sbaichat-save-button">Save</button>
                        </div>
                    </form>
                </div>
                <div class="sbaichat-info-wrap">
                    <div class="sbaichat-info-container">
                        <div class="sbaichat-info-title">Haven't created<br>your AI chatbot?</div>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/DlH6NfDppyo"
                                title="YouTube video player" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        <a href="https://sendbird.com/form/ai-chatbot-wordpress-plugin?utm_medium=web-referral&utm_source=wordpress-plugin&utm_campaign=fy25-q2-glbl-website-ai-chat-wordpress" target="_blank"
                           class="sbaichat-create-bot-button">Create AI chatbot</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="sbaichat-help-feedback">
            <div>If you need help or have any feedback, <a href="https://dashboard.sendbird.com/settings/contact_us" target="_blank">Contact us</a></div>
            <img src="<?php echo esc_url($link_logo_url); ?>" alt="Contact us">
        </div>
    </div>
    <style>
        /* Reset some basic elements for consistent styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html, body {
            width: 100%;
            height: 100%;
            font-family: 'Roboto', 'Arial', sans-serif;
        }

        /* Container for centering the box */
        .sbaichat-centered-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* The main box */
        .sbaichat-centered-box {
            max-width: 1100px;
            width: 100%;
            margin: 20px;
            display: flex;
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            /*box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);*/
            box-shadow: 4px 15px 25px 0px rgba(33, 33, 33, 0.10);
        }

        /* Container for the left and right sections */
        .sbaichat-container {
            display: flex;
            width: 100%;
        }

        /* Left side form container */
        .sbaichat-form-container {
            width: 60%;
            padding: 40px;
        }

        /* Right side info container */
        .sbaichat-info-wrap {
            display: flex; /* Establishes flex context for child elements */
            justify-content: center; /* Centers child elements horizontally in the container */
            align-items: center; /* Centers child elements vertically in the container */
            height: 100%; /* Provides a height context for centering */
            width: 40%;
            /*background: linear-gradient(to bottom, #6BBFFC 0%, #8863F9 50%, #61FBBA 100%);*/
            background: linear-gradient(133deg, #6BBFFC 0%, #8863F9 48.36%, #61FBBA 99.34%);
            padding: 40px;
            color: white;
            text-align: center;
        }

        .sbaichat-info-container {
            display: flex; /* Establishes flex context for child elements */
            justify-content: center; /* Centers child elements horizontally in the container */
            flex-direction: column;
            align-items: center; /* Centers child elements vertically in the container */
            /* Adjust width and height as needed to fit content */
            width: auto; /* Or specify a width */
            height: auto; /* Or specify a height */
            /* Other styles as needed */
        }

        /* Styles for the form elements */
        .sbaichat-input {
            width: 100%;
            height: 48px;
            padding: 16px;
            margin-top: 4px;
            margin-bottom: 20px;
            border-radius: 15px;
            border: 1px solid #ccc;
        }

        /* Styles for the buttons */
        .sbaichat-save-button, .sbaichat-create-bot-button {
            display: block; /* Display block allows for margin auto to work */
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sbaichat-save-button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Base button styles */
        .sbaichat-save-button {
            background-color: #6210CC;
            color: white;
            border: none;
            margin-top: 40px;
            width: 240px;
        }

        .sbaichat-save-button:disabled {
            background-color: #ECECEC;
            color: #A6A6A6;
            cursor: not-allowed;
        }

        .sbaichat-save-button:not(:disabled):hover {
            background-color: #4E11A1;
        }

        /* Custom button styles */
        .sbaichat-create-bot-button {
            background-color: white;
            color: #0D0D0D;
            margin-top: 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 200px;
        }

        .sbaichat-create-bot-button:hover {
            color: #6210CC;
            border: 1px solid #6210CC;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 768px) {
            .sbaichat-centered-box {
                flex-direction: column;
            }

            .sbaichat-form-container, .sbaichat-info-container {
                width: 100%;
            }
        }

        /* Styles for typography */
        .sbaichat-title {
            margin-top: 16px;
            font-size: 36px;
            font-weight: bold;
            line-height: normal;
            letter-spacing: -0.5px;
            color: #0D0D0D;
        }

        .sbaichat-body {
            font-size: 14px;
            font-style: normal;
            font-weight: 400;
            line-height: 24px;
            margin-top: 16px;
            margin-bottom: 32px;
            color: #0D0D0D;
        }

        .sbaichat-body a {
            color: #6210CC;
            font-weight: 600;
            text-decoration: none;
        }

        .sbaichat-body a:hover {
            text-decoration: underline;
        }

        .sbaichat-form-label {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
            line-height: 24px;
            color: #0D0D0D;
        }

        /* Logo style */
        .sbaichat-form-container img {
            max-width: 100%;
            height: auto;
        }

        /* Style for the iframe video */
        .sbaichat-info-container iframe {
            width: 100%;
            height: auto;
            max-width: 560px;
            border: none;
            margin-top: 36px;
            margin-bottom: 36px;
            border-radius: 15px;
        }

        /* Link style */
        .sbaichat-manage-link {
            display: flex; /* Use flexbox for alignment */
            justify-content: center; /* Center content horizontally */
            align-items: center; /* Center content vertically */
            text-decoration: none;
            margin-top: 32px;
            font-size: 14px;
            color: #6210CC;
            font-weight: 500;
            width: 100%; /* Use the full width to allow centering */
            padding: 10px 0; /* Some padding */
        }

        .sbaichat-manage-link:hover {
            color: #4E11A1;
        }

        .sbaichat-manage-link img {
            margin-left: 8px; /* Adjust space between text and icon as needed */
            width: 16px; /* Adjust size as needed */
            height: auto; /* Maintain aspect ratio */
        }

        .sbaichat-info-title {
            color: #FFF;
            text-align: center;
            font-size: 30px;
            font-style: normal;
            font-weight: 700;
            line-height: 32px; /* 106.667% */
        }

        .sbaichat-bot-activation {
            display: flex;
            align-items: center;
            margin-top: 4px;
        }

        .sbaichat-bot-activation label {
            margin-right: 10px;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 4px;
            line-height: 24px;
            color: #0D0D0D;
        }

        .sbaichat-switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }

        .sbaichat-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .sbaichat-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 20px;
        }

        .sbaichat-slider:before {
            position: absolute;
            content: "";
            height: 10px;
            width: 10px;
            left: 5px;
            bottom: 5px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked + .sbaichat-slider {
            background-color: #6210CC;
        }

        input:focus + .sbaichat-slider {
            box-shadow: 0 0 1px #6210CC;
        }

        input:checked + .sbaichat-slider:before {
            transform: translateX(20px);
        }

        /* Add the following styles */
        .sbaichat-help-feedback {
            display: flex; /* Use flexbox to align children */
            flex-direction: row;
            align-items: center; /* Center align vertically */
            margin-top: 20px;
            color: #5e5e5e;
            font-size: 14px;
            font-weight: 500;
            line-height: 20px;
            letter-spacing: -0.1px;
        }

        .sbaichat-help-feedback a {
            color: #6210CC;
            text-decoration: none;
        }

        .sbaichat-help-feedback a:hover {
            text-decoration: underline;
        }

        .sbaichat-help-feedback img {
            margin-left: 4px;
        }

        /* Add additional custom styles as needed */
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const appIdInput = document.getElementById('sbaichat_app_id');
            const botIdInput = document.getElementById('sbaichat_bot_id');
            const botEnabledCheckbox = document.getElementById('sbaichat_bot_enabled');
            const submitBtn = document.getElementById('sbaichat-submit-btn');

            function trackChanges() {
                const initialAppId = appIdInput.value;
                const initialBotId = botIdInput.value;
                const initialBotEnabled = botEnabledCheckbox.checked;

                return function() {
                    const currentAppId = appIdInput.value;
                    const currentBotId = botIdInput.value;
                    const currentBotEnabled = botEnabledCheckbox.checked;

                    let valueChanged = currentAppId !== initialAppId || currentBotId !== initialBotId || currentBotEnabled !== initialBotEnabled;
                    if (valueChanged) {
                        submitBtn.disabled = currentAppId.trim() === '' || currentBotId.trim() === '';
                    } else {
                        submitBtn.disabled = true;
                    }
                };
            }

            const handleChanges = trackChanges();

            appIdInput.addEventListener('input', handleChanges);
            botIdInput.addEventListener('input', handleChanges);
            botEnabledCheckbox.addEventListener('change', handleChanges);

            submitBtn.addEventListener('click', function() {
                if (!submitBtn.disabled) {
                    jQuery.ajax({
                        url: sbaichat_ajax_object.ajax_url,
                        method: 'POST',
                        data: {
                            action: 'update_sendbird_options',
                            nonce: sbaichat_ajax_object.nonce,
                            app_id: appIdInput.value,
                            bot_id: botIdInput.value,
                            bot_enabled: botEnabledCheckbox.checked
                        },
                        success: function (response) {
                            if (response.success) {
                                // Optionally reload the page to trigger the script enqueue
                                location.reload();
                            } else {
                                console.log('Failed to update options');
                            }
                        },
                        error: function () {
                            console.log('An error occurred while updating options');
                        }
                    });
                }
            });

            handleChanges();
        });
    </script>
    <?php
}

add_action('wp_ajax_update_sendbird_options', 'update_sendbird_options');

function update_sendbird_options()
{
    // Check for nonce security
    check_ajax_referer('sendbird_nonce', 'nonce');

    $app_id = isset($_POST['app_id']) ? sanitize_text_field($_POST['app_id']) : '';
    $bot_id = isset($_POST['bot_id']) ? sanitize_text_field($_POST['bot_id']) : '';
    $bot_enabled = isset($_POST['bot_enabled']) ? boolval($_POST['bot_enabled']) : true;

    $region = null;

    if (!empty($app_id)) {
        // Perform the DNS lookup
        $url = "https://dns.google/resolve?name=api-{$app_id}.sendbird.com&type=cname";
        $response = wp_remote_get($url);

        if (!is_wp_error($response)) {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);
            $answers = isset($data['Answer']) ? $data['Answer'] : [];

            $allowedRegions = ['ap-1', 'ap-2', 'ap-3', 'ap-4', 'ap-5', 'ap-8', 'ap-9', 'ca-1', 'eu-1', 'us-1', 'us-2', 'us-3'];

            foreach ($answers as $answer) {
                error_log($answer['data']);
                if (preg_match('/([a-z0-9-]{4})\.sendbird\.com.*$/', $answer['data'], $matches)) {
                    error_log($region);

                    if (in_array($matches[1], $allowedRegions)) {
                        $region = $matches[1];
                        break;
                    }
                }
            }

        }
    }

    update_option('sbaichat_app_id', $app_id);
    update_option('sbaichat_bot_id', $bot_id);
    update_option('sbaichat_bot_enabled', $bot_enabled);

    if ($region) {
        update_option('sbaichat_region', $region);
        update_option('sbaichat_api_host', "https://api-cf-{$region}.sendbird.com");
    } else {
        delete_option('sbaichat_region');
        delete_option('sbaichat_api_host');
    }

    // Trigger the custom action hook to enqueue the script
    do_action('sbaichat_enqueue_script');

    wp_send_json_success('Options updated successfully');
}

function sbaichat_embed_chatbot()
{
    $sbaichat_bot_enabled = get_option('sbaichat_bot_enabled', true);
    $sbaichat_app_id = get_option('sbaichat_app_id');
    $sbaichat_bot_id = get_option('sbaichat_bot_id');
    $sbaichat_api_host = get_option('sbaichat_api_host', '');

    if ($sbaichat_bot_enabled && !empty($sbaichat_app_id) && !empty($sbaichat_bot_id)) {
        $handle = 'sbaichat-chatbot-script';

        $version = '1.0.0';

        wp_register_script($handle, '', array(), $version);
        wp_enqueue_script($handle);

        wp_add_inline_script($handle,
            "window.addEventListener('DOMContentLoaded', function() {
                !function(w, d, s, ...args){
                  var div = d.createElement('div');
                  div.id = 'aichatbot';
                  d.body.appendChild(div);
                  w.chatbotConfig = args;
                  
                  w.chatbotConfig[2] = {
                    serviceName: 'genai-wordpress-plugin'
                  };
                  if ('" . esc_js($sbaichat_api_host) . "' !== ''){
                      w.chatbotConfig[2].apiHost = '" . esc_js($sbaichat_api_host) . "';
                  }

                  var f = d.getElementsByTagName(s)[0],
                  j = d.createElement(s);
                  j.defer = true;
                  j.type = 'module';
                  j.src = 'https://aichatbot.sendbird.com/index.js';
                  f.parentNode.insertBefore(j, f);
                 
                }(window, document, 'script', '" . esc_js($sbaichat_app_id) . "', '" . esc_js($sbaichat_bot_id) . "');
            });", 'after');
    }
}

add_action('wp_enqueue_scripts', 'sbaichat_embed_chatbot');

function sbaichat_localize_script($hook)
{
    // Only enqueue on the plugin's options page
    if ($hook != 'plugins_page_sendbird-ai-chatbot') {
        return;
    }

    // Localize script variables with jQuery (as it is always enqueued)
    wp_localize_script('jquery', 'sbaichat_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('sendbird_nonce')
    ));

    // Enqueue Bootstrap CSS
    wp_enqueue_style('sbaichat-bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');

    // Optional: Enqueue Bootstrap Bundle JS (includes Popper JS for tooltips)
    wp_enqueue_script('sbaichat-bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}

add_action('admin_enqueue_scripts', 'sbaichat_localize_script');

?>