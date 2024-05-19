<?php
function quickbiz_add_admin_menu() {
    add_menu_page(
        'QuickBiz API Settings',
        'QuickBiz API Settings',
        'manage_options',
        'quickbiz_integration',
        'quickbiz_settings_page'
    );
    add_submenu_page(
        'quickbiz_integration',
        'QuickBiz Sync Log',
        'Sync Log',
        'manage_options',
        'quickbiz_sync_log',
        'quickbiz_sync_log_page'
    );
    add_submenu_page(
        'quickbiz_integration',
        'Shipping Methods',
        'Shipping Methods',
        'manage_options',
        'quickbiz_shipping_methods',
        'quickbiz_shipping_methods_page'
    );
    add_submenu_page(
        'quickbiz_integration',
        'Payment Methods',
        'Payment Methods',
        'manage_options',
        'quickbiz_payment_methods',
        'quickbiz_payment_methods_page'
    );
    add_submenu_page(
        'quickbiz_integration',
        'Measurement Units',
        'Measurement Units',
        'manage_options',
        'quickbiz_measurement_units',
        'quickbiz_measurement_units_page'
    );
}
?>