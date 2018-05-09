<?php
class ControllerExtensionPaymentHubtel extends Controller {
	public function index() {
		
		$data['button_confirm'] = $this->language->get('button_confirm');
		
		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		$data['merchant'] = $this->config->get('hubtel_merchant');
		$data['trans_id'] = $this->session->data['order_id'];
		
		return $this->load->view('extension/payment/hubtel', $data);
	}

	public function invoice() {

		$this->load->model('checkout/order');

		$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

		if ($order_info) {
			
			$products = $this->cart->getProducts();

			$first_name = html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8');
			$last_name = html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');

			$invoice = [
				'invoice' => [
					'items' => array(),
					'total_amount' => 0.00,
					'description' => 'Total cost of ' . count($products) . ' item' . (count($products) > 1 ? 's' : '') 
			
				],
				'store' => [
					'name' => $this->config->get('hubtel_company_name'),
					'tagline' => $this->config->get('hubtel_company_tagline'),
					'phone' => $this->config->get('hubtel_company_phone'),
					'website_url' => $this->config->get('hubtel_company_web_url')
				],
				'actions' => [
					'cancel_url' => $this->url->link('checkout/checkout', '', true),
					'return_url' => $this->url->link('checkout/success')
				],
			];

			$count = 0;

			foreach ($products as $product) {
				
				$price = floatval($product['price']);
				$quantity = intval($product['quantity']);
				$total_price = floatval($price * $quantity);
				$description = $first_name . ' ' . $last_name . ' order from ' . $this->config->get('hubtel_company_name');

				$invoice['invoice']['items']["item_$count"] = [
					'name' => $product['name'],
					'quantity' => $quantity,
					'unit_price' => $price,
					'total_price' => $total_price,
					'description' => $description
				];

				$count++;
			}

			$invoice['invoice']['total_amount'] = $order_info['total'];

			$client_id = $this->config->get('hubtel_client_id');
			$client_secret = $this->config->get('hubtel_client_secret');
			$basic_auth_key =  'Basic ' . base64_encode($client_id . ':' . $client_secret);
			$request_url = 'https://api.hubtel.com/v1/merchantaccount/onlinecheckout/invoice/create';
			$create_invoice = json_encode($invoice, JSON_UNESCAPED_SLASHES);

			$ch =  curl_init($request_url);  
			curl_setopt( $ch, CURLOPT_POST, true );  
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $create_invoice);  
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);  
			curl_setopt( $ch, CURLOPT_HTTPHEADER, [
				'Authorization: '.$basic_auth_key,
				'Cache-Control: no-cache',
				'Content-Type: application/json'
			]);

			$result = curl_exec($ch); 
			$error = curl_error($ch);
			curl_close($ch);

			if ($error) {
				echo $error;
			} else {
				
				$response_param = json_decode($result, true);
				
				if (isset($response_param['token']) && isset($response_param['description'])) {

					$message = $response_param['description'] . ' with invoice token: ' . $response_param['token'];

					$order_status_id = $this->config->get('hubtel_order_status_id');

					$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $order_status_id, $message, false);
				}
			
				$this->response->addHeader('Content-Type: application/json');
				$this->response->setOutput($result);
			}		
		}
	}
}