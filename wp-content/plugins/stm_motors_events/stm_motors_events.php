<?php
/**
Plugin Name: Motors - Events
Plugin URI: https://stylemixthemes.com/
Description: Motors Events
Author: StylemixThemes
Author URI: https://stylemixthemes.com/
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: stm_motors_events
Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

define( 'STM_EVENTS_PATH', dirname( __FILE__ ) );
define( 'STM_EVENTS_URL', plugins_url( '', __FILE__ ) );
define( 'STM_EVENTS', 'stm_motors_events' );

define( 'STM_EVENTS_IMAGES', STM_EVENTS_URL . '/includes/admin/butterbean/images/' );

if ( ! is_textdomain_loaded( 'stm_motors_events' ) ) {
	load_plugin_textdomain( 'stm_motors_events', false, 'stm_motors_events/languages' );
}

require_once __DIR__ . '/includes/events-post-type/post-types.php';
require_once __DIR__ . '/includes/ajax-actions.php';
require_once __DIR__ . '/includes/setup.php';
require_once __DIR__ . '/includes/query.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/templates.php';
require_once __DIR__ . '/includes/enqueue.php';
require_once __DIR__ . '/includes/visual_composer.php';
require_once __DIR__ . '/includes/admin/SubContentEventEditor.php';
require_once __DIR__ . '/includes/event_participant_handler.php';

if ( is_admin() ) {
	require_once __DIR__ . '/includes/admin/enqueue.php';
	require_once __DIR__ . '/includes/admin/butterbean_metaboxes.php';
}