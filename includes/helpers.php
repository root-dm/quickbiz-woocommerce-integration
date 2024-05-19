<?php
function quickbiz_log($message) {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log($message);
    }
    global $wpdb;
    $table_name = $wpdb->prefix . 'quickbiz_log';
    $wpdb->insert(
        $table_name,
        [
            'time' => current_time('mysql'),
            'message' => $message
        ]
    );
}

function quickbiz_plugin_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'quickbiz_log';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        message text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    if (!wp_next_scheduled('quickbiz_daily_sync')) {
        wp_schedule_event(time(), 'daily', 'quickbiz_daily_sync');
    }
}

function quickbiz_plugin_deactivate() {
    // delete_option('quickbiz_api_key');
    // global $wpdb;
    // $table_name = $wpdb->prefix . 'quickbiz_log';
    // $wpdb->query("DROP TABLE IF EXISTS $table_name");

    $timestamp = wp_next_scheduled('quickbiz_daily_sync');
    if ($timestamp) {
        wp_unschedule_event($timestamp, 'quickbiz_daily_sync');
    }
}

function quickbiz_daily_sync_function() {
    quickbiz_log('Daily sync started');
    quickbiz_sync_products();
    quickbiz_sync_orders();
    quickbiz_log('Daily sync completed');
}
?>