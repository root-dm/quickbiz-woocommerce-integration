<?php
function quickbiz_settings_page() {
    ?>
    <div class="wrap">
        <h1>QuickBiz Integration Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('quickbiz_settings_group');
            do_settings_sections('quickbiz_integration');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function quickbiz_settings_init() {
    register_setting('quickbiz_settings_group', 'quickbiz_api_key');
    add_settings_section(
        'quickbiz_settings_section',
        'QuickBiz API Settings',
        null,
        'quickbiz_integration'
    );
    add_settings_field(
        'quickbiz_api_key',
        'API Key',
        'quickbiz_api_key_render',
        'quickbiz_integration',
        'quickbiz_settings_section'
    );
}
add_action('admin_init', 'quickbiz_settings_init');

function quickbiz_api_key_render() {
    ?>
    <input type='text' name='quickbiz_api_key' value='<?php echo get_option('quickbiz_api_key'); ?>'>
    <?php
}
?>