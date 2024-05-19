<?php
class QuickBizAPI {
    private $api_key;
    private $base_url;

    public function __construct() {
        $this->api_key = get_option('quickbiz_api_key');
        $this->base_url = 'https://api.entersoft.gr/api/eshopconnector/';
    }

    private function request($endpoint, $method = 'POST', $data = []) {
        $args = [
            'method' => $method,
            'headers' => [
                'Content-Type' => 'application/json',
                'X-ESAPIKEY-QBIZESHOPCONNECTOR' => $this->api_key
            ],
            'body' => json_encode($data)
        ];

        quickbiz_log("Requesting $endpoint with data: " . json_encode($data));

        $response = wp_remote_request($this->base_url . $endpoint, $args);

        if (is_wp_error($response)) {
            $error_message = 'QuickBiz API error: ' . $response->get_error_message();
            error_log($error_message);
            quickbiz_log($error_message);
            return null;
        }

        $body = wp_remote_retrieve_body($response);
        quickbiz_log("Response from $endpoint: " . $body);

        if (empty($body)) {
            $empty_response_message = 'QuickBiz API response is empty.';
            error_log($empty_response_message);
            quickbiz_log($empty_response_message);
            return null;
        }

        $decoded_body = json_decode($body, true);
        if (isset($decoded_body['error'])) {
            $api_error_message = 'QuickBiz API error: ' . $decoded_body['error'];
            error_log($api_error_message);
            quickbiz_log($api_error_message);
            return null;
        }

        return $decoded_body;
    }

    public function createProduct($product_data) {
        return $this->request('Product', 'POST', $product_data);
    }

    public function updateProduct($product_id, $product_data) {
        return $this->request('Product/' . $product_id, 'POST', $product_data);
    }

    public function getProduct($product_id) {
        return $this->request('Product/' . $product_id, 'POST');
    }

    public function createOrder($order_data) {
        return $this->request('Order', 'POST', $order_data);
    }

    public function updateOrder($order_id, $order_data) {
        return $this->request('Order/' . $order_id, 'POST', $order_data);
    }

    public function getOrder($order_id) {
        return $this->request('Order/' . $order_id, 'POST');
    }

    public function getShippingMethods() {
        $data = [
            "RequestParams" => (object)[],
            "PageNo" => 0
        ];
        return $this->request('ShippingMethods', 'POST', $data);
    }

    public function getPaymentMethods() {
        $data = [
            "RequestParams" => (object)[],
            "PageNo" => 0
        ];
        return $this->request('PaymentMethods', 'POST', $data);
    }

    public function getMeasurementUnits() {
        $data = [
            "RequestParams" => (object)[],
            "PageNo" => 0
        ];
        return $this->request('Mus', 'POST', $data);
    }
}
?>
