<?php
function quickbiz_sync_log_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'quickbiz_log';
    $results = $wpdb->get_results("SELECT * FROM $table_name ORDER BY time DESC");

    ?>
    <div class="wrap">
        <h1>QuickBiz Sync Log</h1>
        <table class="widefat fixed" cellspacing="0">
            <thead>
                <tr>
                    <th class="manage-column column-columnname" scope="col">Time</th>
                    <th class="manage-column column-columnname" scope="col">Message</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th class="manage-column column-columnname" scope="col">Time</th>
                    <th class="manage-column column-columnname" scope="col">Message</th>
                </tr>
            </tfoot>
            <tbody>
                <?php if($results) : ?>
                    <?php foreach($results as $row) : ?>
                        <tr>
                            <td><?php echo $row->time; ?></td>
                            <td><?php echo $row->message; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="2">No logs found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}
