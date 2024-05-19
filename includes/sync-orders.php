<?php
function sync_orders_to_quickbiz($order_id) {
    $quickbiz_api = new QuickBizAPI();
    $order = wc_get_order($order_id);
    $order_data = [
        'id' => $order->get_id(),
        'status' => $order->get_status(),
        'total' => $order->get_total(),
        'customer' => [
            'id' => $order->get_customer_id(),
            'email' => $order->get_billing_email()
        ]
    ];

    quickbiz_log('Sending Order Data: ' . print_r($order_data, true));

    $result = $quickbiz_api->createOrder($order_data);
    if ($result === null) {
        $message = 'Failed to create order: ' . $order->get_id();
        quickbiz_log($message);
        quickbiz_log('API Response: ' . print_r($result, true));
    } else {
        $message = 'Successfully created order: ' . $order->get_id();
        quickbiz_log($message);
    }
}
add_action('woocommerce_thankyou', 'sync_orders_to_quickbiz');
?>
