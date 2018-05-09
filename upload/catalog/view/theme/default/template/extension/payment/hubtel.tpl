<form action="javascript:;" method="post">
  <input type="hidden" name="merchant" value="<?php echo $merchant; ?>" />
  <input type="hidden" name="trans_id" value="<?php echo $trans_id; ?>" />

  <div class="buttons">
    <div class="pull-right">
      <input type="submit" value="<?php echo $button_confirm; ?>" id="button-confirm" class="btn btn-primary" />
    </div>
  </div>
</form>
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
	$.ajax({
		url: 'index.php?route=extension/payment/hubtel/invoice',
		type: 'post',
		data: {},
		dataType: 'json',
		beforeSend: function() {
			$('#button-confirm').val('processing...');
      $('#button-confirm').prop('disabled', true);
		},
		complete: function() {
			$('#button-confirm').val('done');
      $('#button-confirm').prop('disabled', false);
		},
		success: function(json) {
      $('#button-confirm').val('done');
      $('#button-confirm').prop('disabled', false);
      console.log(json);
			if (!json) {
				alert('An error occured creating your invoice');
				return;
			}

			if (json['response_code'] && json['response_code'] === '00') {
        window.location.assign(json['response_text']);
			} else {
			    alert(json['response_text'] || 'An error occurred. Please again later')
			}
		},
    error: function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
      $('#button-confirm').val('done');
      $('#button-confirm').prop('disabled', false);
    }
	});
});
//--></script>