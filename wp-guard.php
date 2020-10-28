<?php
/*
    Plugin Name: WP Guard
    Plugin URI: https://tropicaljuice.nl/
    Description: Do you want to have a safer login? Use WP Guard to send out 2FA tokens via SMS and E-mail. Use your own Messaging provider or use our simple setup.
    Version: 1.0
    Author: Tropical Juice
    Author URI: https://tropicaljuice.nl/
    Text Domain: tropical_WP-Guard
    License: GPLv3
    License URI: https://www.gnu.org/licenses/gpl-3.0.html
*/
if (! defined('ABSPATH')) {
    exit;
}

//Getting some basic stuff ready.
define('WP_GUARD_VERSION', '1.0');
define('WP_GUARD_MIN_WP_VERSION', '3.7');
define('WP_GUARD_TEXT_DOMAIN', 'tropical_cookiewall');
define('WP_GUARD_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));
define('WP_GUARD_PLUGIN_DIR', basename(dirname(__FILE__)));
define('WP_GUARD_PLUGIN_URI', plugin_dir_url(__FILE__));
define('WP_GUARD_PLUGIN_FILE_NAME', plugin_basename(__FILE__));

//Load main class.
require_once(WP_GUARD_PLUGIN_DIR_PATH . 'lib/class.wp-guard.php');
add_action('wp_loaded', array( 'CookieWall', 'init' ));

//Only load admin specific classes when needed.
if (is_admin() || (defined('WP_CLI') && WP_CLI)) {
    require_once(WP_GUARD_PLUGIN_DIR_PATH . 'lib/class.wp-guard-admin-settings.php');
    require_once(WP_GUARD_PLUGIN_DIR_PATH . 'lib/class.wp-guard-admin-uprofile.php');
    require_once(WP_GUARD_PLUGIN_DIR_PATH . 'lib/class.wp-guard-admin.php');
    add_action('init', array( 'CookieWallAdmin', 'init' ));
}
