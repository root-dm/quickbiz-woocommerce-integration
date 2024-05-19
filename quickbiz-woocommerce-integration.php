<?php
/*
Plugin Name: QuickBiz WooCommerce Integration
Description: Integrate QuickBiz with WooCommerce.
Version: 1.0
Author: root-dm
Author URI: https://rootdm.gr/
*/

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// Include necessary files
include_once(plugin_dir_path(__FILE__) . 'includes/helpers.php');
include_once(plugin_dir_path(__FILE__) . 'includes/quickbiz-api.php');
include_once(plugin_dir_path(__FILE__) . 'includes/sync-products.php');
include_once(plugin_dir_path(__FILE__) . 'includes/sync-orders.php');
include_once(plugin_dir_path(__FILE__) . 'includes/updater.php');
include_once(plugin_dir_path(__FILE__) . 'admin/menu.php');

// Include pages
include_once(plugin_dir_path(__FILE__) . 'admin/pages/shipping-methods.php');
include_once(plugin_dir_path(__FILE__) . 'admin/pages/payment-methods.php');
include_once(plugin_dir_path(__FILE__) . 'admin/pages/measurement-units.php');
include_once(plugin_dir_path(__FILE__) . 'admin/pages/log.php');
include_once(plugin_dir_path(__FILE__) . 'admin/pages/settings.php');

// Activation hook
register_activation_hook(__FILE__, 'quickbiz_plugin_activate');

// Deactivation hook
register_deactivation_hook(__FILE__, 'quickbiz_plugin_deactivate');

// Register settings page
add_action('admin_menu', 'quickbiz_add_admin_menu');

// Sync Manager
add_action('quickbiz_daily_sync', 'quickbiz_daily_sync_function');
?>
