<?php 
class ControllerExtensionPaymentHubtel extends Controller 
{
    private $error = array();

	public function index() {
		$this->load->language('extension/payment/hubtel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('hubtel', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_live'] = $this->language->get('text_live');
		$data['text_successful'] = $this->language->get('text_successful');
		$data['text_fail'] = $this->language->get('text_fail');
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_company_details'] = $this->language->get('tab_company_details');

		

		$data['entry_merchant'] = $this->language->get('entry_merchant');
		$data['entry_client_id'] = $this->language->get('entry_client_id');
		$data['entry_client_secret'] = $this->language->get('entry_client_secret');
		$data['entry_company_name'] = $this->language->get('entry_company_name');
		$data['entry_company_tagline'] = $this->language->get('entry_company_tagline');
		$data['entry_company_phone'] = $this->language->get('entry_company_phone');
		$data['entry_company_web_url'] = $this->language->get('entry_company_web_url');
		$data['entry_test'] = $this->language->get('entry_test');
		$data['entry_total'] = $this->language->get('entry_total');
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['help_client_id'] = $this->language->get('help_client_id');
		$data['help_client_secret'] = $this->language->get('help_client_secret');
		$data['help_total'] = $this->language->get('help_total');
		$data['help_company_name'] = $this->language->get('help_company_name');
		$data['help_company_tagline'] = $this->language->get('help_company_tagline');
		$data['help_company_phone'] = $this->language->get('help_company_phone');
		$data['help_company_web_url'] = $this->language->get('help_company_web_url');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['merchant'])) {
			$data['error_merchant'] = $this->error['merchant'];
		} else {
			$data['error_merchant'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/hubtel', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/hubtel', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=payment', true);

		if (isset($this->request->post['hubtel_merchant'])) {
			$data['hubtel_merchant'] = $this->request->post['hubtel_merchant'];
		} else {
			$data['hubtel_merchant'] = $this->config->get('hubtel_merchant');
		}

		

		if (isset($this->request->post['hubtel_client_id'])) {
			$data['hubtel_client_id'] = $this->request->post['hubtel_client_id'];
		} else {
			$data['hubtel_client_id'] = $this->config->get('hubtel_client_id');
		}

		if (isset($this->request->post['hubtel_client_secret'])) {
			$data['hubtel_client_secret'] = $this->request->post['hubtel_client_secret'];
		} else {
			$data['hubtel_client_secret'] = $this->config->get('hubtel_client_secret');
		}

		if (isset($this->request->post['hubtel_company_name'])) {
			$data['hubtel_company_name'] = $this->request->post['hubtel_company_name'];
		} else {
			$data['hubtel_company_name'] = $this->config->get('hubtel_company_name');
		}

		if (isset($this->request->post['hubtel_company_tagline'])) {
			$data['hubtel_company_tagline'] = $this->request->post['hubtel_company_tagline'];
		} else {
			$data['hubtel_company_tagline'] = $this->config->get('hubtel_company_tagline');
		}

		if (isset($this->request->post['hubtel_company_phone'])) {
			$data['hubtel_company_phone'] = $this->request->post['hubtel_company_phone'];
		} else {
			$data['hubtel_company_phone'] = $this->config->get('hubtel_company_phone');
		}

		if (isset($this->request->post['hubtel_company_web_url'])) {
			$data['hubtel_company_web_url'] = $this->request->post['hubtel_company_web_url'];
		} else {
			$data['hubtel_company_web_url'] = $this->config->get('hubtel_company_web_url');
		}

		if (isset($this->request->post['hubtel_test'])) {
			$data['hubtel_test'] = $this->request->post['hubtel_test'];
		} else {
			$data['hubtel_test'] = $this->config->get('hubtel_test');
		}

		if (isset($this->request->post['hubtel_total'])) {
			$data['hubtel_total'] = $this->request->post['hubtel_total'];
		} else {
			$data['hubtel_total'] = $this->config->get('hubtel_total');
		}

		if (isset($this->request->post['hubtel_order_status_id'])) {
			$data['hubtel_order_status_id'] = $this->request->post['hubtel_order_status_id'];
		} else {
			$data['hubtel_order_status_id'] = $this->config->get('hubtel_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['hubtel_geo_zone_id'])) {
			$data['hubtel_geo_zone_id'] = $this->request->post['hubtel_geo_zone_id'];
		} else {
			$data['hubtel_geo_zone_id'] = $this->config->get('hubtel_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['hubtel_status'])) {
			$data['hubtel_status'] = $this->request->post['hubtel_status'];
		} else {
			$data['hubtel_status'] = $this->config->get('hubtel_status');
		}

		if (isset($this->request->post['hubtel_sort_order'])) {
			$data['hubtel_sort_order'] = $this->request->post['hubtel_sort_order'];
		} else {
			$data['hubtel_sort_order'] = $this->config->get('hubtel_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/hubtel', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/hubtel')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['hubtel_merchant']) {
			$this->error['merchant'] = $this->language->get('error_merchant');
		}

		return !$this->error;
	}
}