<?php
function sync_products_to_quickbiz($product_id, $post) {
    $quickbiz_api = new QuickBizAPI();
    $product = wc_get_product($product_id);
    $product_data = [
        'id' => $product->get_id(),
        'name' => $product->get_name(),
        'price' => $product->get_price(),
        'inventory' => $product->get_stock_quantity()
    ];

    if ($post->post_status == 'publish') {
        $result = $quickbiz_api->createProduct($product_data);
        if ($result === null) {
            quickbiz_log('Failed to create product: ' . $product->get_name());
        } else {
            quickbiz_log('Successfully created product: ' . $product->get_name());
        }
    } else {
        $result = $quickbiz_api->updateProduct($product->get_id(), $product_data);
        if ($result === null) {
            quickbiz_log('Failed to update product: ' . $product->get_name());
        } else {
            quickbiz_log('Successfully updated product: ' . $product->get_name());
        }
    }
}
add_action('save_post_product', 'sync_products_to_quickbiz', 10, 2);
?>
