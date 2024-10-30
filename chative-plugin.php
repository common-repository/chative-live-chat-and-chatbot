<?php
/**
 * Plugin Name: Chative - Live chat & Chatbot
 * Plugin URI: https://help.chative.io/support/solutions/articles/73000152204-add-chative-live-chat-to-wordpress-site
 * Description: Chative is a messaging platform that allows businesses to interact with customers across multiple websites and social media outlets while seamlessly gathering all conversations in one place
 * Version: 1.1
 * Author: Chative
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Author URI: https://chative.io
 **/

// Add settings page and register settings with WordPress
add_action('admin_menu', 'chative_setup');
function chative_setup()
{
    add_menu_page(
        'Chative',
        'Chative Live chat',
        'manage_options',
        'chative',
        'chative_settings',
        'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIHZpZXdCb3g9IjAgMCAxMCAxMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZmlsbC1ydWxlPSJldmVub2RkIiBjbGlwLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0zLjkxNzg2IDkuNDg2OTVDMy4xNjI1NiA5Ljg5NTUyIDIuMzExNTcgMTAuMTY5MyAxLjY0NDMgOS44Nzk3OEMyLjI3MzczIDkuNTg1NSAyLjM5MjI5IDkuMjUxNzggMi40NTQyOSA4Ljk3MzU4QzIuNDU3NTggOC45NTg4MSAyLjQ2MDY2IDguOTQ0MTkgMi40NjM1MyA4LjkyOTY5QzIuMjUyNDEgOC44MDE0OCAyLjAzNjQgOC42NDk2MiAxLjgxMDU4IDguNDcwNDRDMC43MDQ0NzkgNy41OTI3NiAwIDYuMjY3NjkgMCA0Ljc4NTA2QzAgMi4xNDIyMiAyLjIzODQ1IDAgNSAwQzYuNDc3NTggMCA3LjgwNTQxIDAuNjEzMjgyIDguNzIwNzIgMS41ODgzOUM5LjUxNjExIDIuNDM1NzMgMTAgMy41NTYyOCAxMCA0Ljc4NTA2QzEwIDcuNDI3OSA3Ljc2MTU1IDkuNTcwMTIgNSA5LjU3MDEyQzQuNjEwNDEgOS41NzAxMiA0LjI1NjA4IDkuNTQ3MTkgMy45MTc4NiA5LjQ4Njk1Wk0yLjY3MDE4IDYuNjI0N0MzLjQ0MjcxIDcuMTE2MTkgNC4yMjkxNyA3LjM2NDM0IDUuMDI1ODIgNy4zNjQzNEM1LjgyMTcxIDcuMzY0MzQgNi42MTcxOCA3LjExNjY4IDcuNDA5MSA2LjYyNjE4QzcuNTEzNjkgNi41NjE0IDcuNTQxNjggNi40MzA0OSA3LjQ3MTYxIDYuMzMzNzlDNy40MDE1NSA2LjIzNzA5IDcuMjU5OTcgNi4yMTEyMSA3LjE1NTM4IDYuMjc1OTlDNi40MzUwMyA2LjcyMjE2IDUuNzI2MjIgNi45NDI4NCA1LjAyNTgyIDYuOTQyODRDNC4zMjYxOSA2Ljk0Mjg0IDMuNjI4MzYgNi43MjI2NSAyLjkyODYgNi4yNzc0NkMyLjgyNDg5IDYuMjExNDggMi42ODI5NyA2LjIzNTczIDIuNjExNjEgNi4zMzE2MkMyLjU0MDI1IDYuNDI3NTEgMi41NjY0NyA2LjU1ODcyIDIuNjcwMTggNi42MjQ3WiIgZmlsbD0id2hpdGUiLz4KPC9zdmc+Cg==',
        90
    );
}

add_action('wp_head', 'chative_header');
function chative_header()
{
?>
<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
<?php
}

add_action('wp_ajax_chative_setwidget', 'add_chative_widget_action');

function add_chative_widget_action()
{
    header( 'Content-Type: application/json' );
    // Retrieve post data
    $post_data = json_decode( file_get_contents( 'php://input' ), true );

    $response = array('success' => true);
    $response['channelId'] = $post_data['channelId'];
    $response['orgId'] = $post_data['orgId'];

    // Update field to db
    update_option('chative-channel-id', $post_data['channelId'] );
    update_option('chative-org-id', $post_data['orgId'] );

    wp_send_json($response);
    wp_die();
}

// Display settings page
function chative_settings()
{
    $channelId = get_option('chative-channel-id');
    $orgId = get_option('chative-org-id');
    $webUrl = get_site_url();
    // $userName = get_bloginfo('name');
    $email = get_bloginfo('admin_email');
    // $baseUrl = 'https://rare-dingo-10.loca.lt/integrations/wordpress?channelId=' . $channelId . '&orgId=' . $orgId . '&webUrl=' . $webUrl . '&email=' . $email . '&domain=' . $webUrl . '&utm_id=wordpress&isIntegration=true';
    // $baseUrl = urlencode('https://staging.ohmychat.botstar.com/app/integrations/wordpress?channelId=' . $channelId . '&orgId=' . $orgId . '&webUrl=' . $webUrl . '&name=' . $userName . '&email=' . $email . '&domain=' . $webUrl . '&utm_id=wordpress&isIntegration=true');
    $baseUrl = 'https://app.chative.io/integrations/wordpress?channelId=' . $channelId . '&orgId=' . $orgId . '&webUrl=' . $webUrl . '&domain=' . $webUrl . '&email=' . $email . '&utm_id=wordpress&isIntegration=true';

    // echo "<p>";
    // echo get_option('chative-org-id');
    // echo get_option('chative-channel-id');
    // echo "</p>";
    echo "<div class='container'>";
    echo "<iframe id='chative-iframe' src=" . esc_url($baseUrl) . ">";
    echo '</iframe>';
    echo "</div>";
}

// Add the code to footer
add_action('wp_footer', 'add_chative_code');

function add_chative_code()
{
	// header( 'Content-Type: application/json' );
    $channelId = get_option('chative-channel-id');
    $orgId = get_option('chative-org-id');

    if ( ! empty( $channelId ) && ! empty( $orgId ) ) {
        include sprintf( '%s/templates/widget.php', dirname( __FILE__ ) );
    }
}
function chative_eneque_scripts()
{
    wp_enqueue_script(
        'chative-selection',
        plugin_dir_url(__DIR__) . 'chative-live-chat-and-chatbot/include/js/chative.selection.js',
        [],
        null,
        false
    );

    wp_enqueue_style( 'chative_admin_style', plugin_dir_url(__DIR__) . 'chative-live-chat-and-chatbot/include/css/index.css');
}
add_action('wp_loaded', 'chative_eneque_scripts');

