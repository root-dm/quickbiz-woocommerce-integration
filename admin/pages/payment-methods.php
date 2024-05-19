<?php
function quickbiz_payment_methods_page() {
    $quickbiz_api = new QuickBizAPI();
    $payment_methods = $quickbiz_api->getPaymentMethods();

    if (is_null($payment_methods)) {
        $error_message = "Failed to fetch payment methods.";
        quickbiz_log($error_message);
        ?>
        <div class="wrap">
            <h1>Payment Methods</h1>
            <div class="notice notice-error">
                <p><?php echo esc_html($error_message); ?></p>
            </div>
        </div>
        <?php
        return;
    }

    ?>
    <div class="wrap">
        <h1>Payment Methods</h1>
        <table class="widefat fixed" cellspacing="0">
            <thead>
                <tr>
                    <th class="manage-column column-columnname" scope="col">GID</th>
                    <th class="manage-column column-columnname" scope="col">Code</th>
                    <th class="manage-column column-columnname" scope="col">Description</th>
                    <th class="manage-column column-columnname" scope="col">Inactive</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($payment_methods['Data'])) : ?>
                    <?php foreach ($payment_methods['Data'] as $method) : ?>
                        <tr>
                            <td><?php echo esc_html($method['GID']); ?></td>
                            <td><?php echo esc_html($method['Code']); ?></td>
                            <td><?php echo esc_html($method['Description']); ?></td>
                            <td><?php echo esc_html($method['InActive'] ? 'Yes' : 'No'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4">No payment methods found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
?>
