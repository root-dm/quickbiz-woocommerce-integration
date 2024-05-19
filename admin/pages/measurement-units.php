<?php
function quickbiz_measurement_units_page() {
    $quickbiz_api = new QuickBizAPI();
    $measurement_units = $quickbiz_api->getMeasurementUnits();

    if (is_null($measurement_units)) {
        $error_message = "Failed to fetch measurement units.";
        quickbiz_log($error_message);
        ?>
        <div class="wrap">
            <h1>Measurement Units</h1>
            <div class="notice notice-error">
                <p><?php echo esc_html($error_message); ?></p>
            </div>
        </div>
        <?php
        return;
    }

    ?>
    <div class="wrap">
        <h1>Measurement Units</h1>
        <table class="widefat fixed" cellspacing="0">
            <thead>
                <tr>
                    <th class="manage-column column-columnname" scope="col">Symbol</th>
                    <th class="manage-column column-columnname" scope="col">Code</th>
                    <th class="manage-column column-columnname" scope="col">Description</th>
                    <th class="manage-column column-columnname" scope="col">Alternative Description</th>
                    <th class="manage-column column-columnname" scope="col">Inactive</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($measurement_units['Data'])) : ?>
                    <?php foreach ($measurement_units['Data'] as $unit) : ?>
                        <tr>
                            <td><?php echo esc_html(isset($unit['Symbol']) ? $unit['Symbol'] : ''); ?></td>
                            <td><?php echo esc_html($unit['Code']); ?></td>
                            <td><?php echo esc_html($unit['Description']); ?></td>
                            <td><?php echo esc_html(isset($unit['AlternativeDescription']) ? $unit['AlternativeDescription'] : ''); ?></td>
                            <td><?php echo esc_html($unit['InActive'] ? 'Yes' : 'No'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5">No measurement units found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
?>
