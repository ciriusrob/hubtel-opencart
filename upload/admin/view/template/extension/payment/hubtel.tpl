<?php echo $header; ?><?php echo $column_left; ?>
  <div id="content">
    <div class="page-header">
      <div class="container-fluid">
        <div class="pull-right">
          <button type="submit" form="form-hubtel" data-toggle="tooltip" title="<?php echo $button_save; ?>"
                  class="btn btn-primary"><i class="fa fa-save"></i></button>
          <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"
             class="btn btn-default"><i class="fa fa-reply"></i></a></div>
        <h1><?php echo $heading_title; ?></h1>
        <ul class="breadcrumb">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="container-fluid">
      <?php if ($error_warning) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
          <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
      <?php } ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
        </div>
        <div class="panel-body">

          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-hubtel" class="form-horizontal">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
              <li><a href="#tab-company-details" data-toggle="tab"><?php echo $tab_company_details; ?></a></li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane active" id="tab-general">
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-merchant"><?php echo $entry_merchant; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="hubtel_merchant" value="<?php echo $hubtel_merchant; ?>"
                           placeholder="<?php echo $entry_merchant; ?>" id="input-merchant" class="form-control"/>
                    <?php if ($error_merchant) { ?>
                      <div class="text-danger"><?php echo $error_merchant; ?></div>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-client-id"><span data-toggle="tooltip"
                                                                                    title="<?php echo $help_client_id; ?>"><?php echo $entry_client_id; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="hubtel_client_id" value="<?php echo $hubtel_client_id; ?>"
                           placeholder="<?php echo $entry_client_id; ?>" id="input-client-id" class="form-control"/>
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-client-secret"><span data-toggle="tooltip"
                                                                                        title="<?php echo $help_client_secret; ?>"><?php echo $entry_client_secret; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="hubtel_client_secret" value="<?php echo $hubtel_client_secret; ?>"
                           placeholder="<?php echo $entry_client_secret; ?>" id="input-client-secret"
                           class="form-control"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-test"><?php echo $entry_test; ?></label>
                  <div class="col-sm-10">
                    <select name="hubtel_test" id="input-test" class="form-control">
                      <?php if ($hubtel_test == 'live') { ?>
                        <option value="live" selected="selected"><?php echo $text_live; ?></option>
                      <?php } else { ?>
                        <option value="live"><?php echo $text_live; ?></option>
                      <?php } ?>
                      <?php if ($hubtel_test == 'successful') { ?>
                        <option value="successful" selected="selected"><?php echo $text_successful; ?></option>
                      <?php } else { ?>
                        <option value="successful"><?php echo $text_successful; ?></option>
                      <?php } ?>
                      <?php if ($hubtel_test == 'fail') { ?>
                        <option value="fail" selected="selected"><?php echo $text_fail; ?></option>
                      <?php } else { ?>
                        <option value="fail"><?php echo $text_fail; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip"
                                                                                title="<?php echo $help_total; ?>"><?php echo $entry_total; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="hubtel_total" value="<?php echo $hubtel_total; ?>"
                           placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control"/>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"
                         for="input-order-status"><?php echo $entry_order_status; ?></label>
                  <div class="col-sm-10">
                    <select name="hubtel_order_status_id" id="input-order-status" class="form-control">
                      <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $hubtel_order_status_id) { ?>
                          <option value="<?php echo $order_status['order_status_id']; ?>"
                                  selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                          <option
                            value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-geo-zone"><?php echo $entry_geo_zone; ?></label>
                  <div class="col-sm-10">
                    <select name="hubtel_geo_zone_id" id="input-geo-zone" class="form-control">
                      <option value="0"><?php echo $text_all_zones; ?></option>
                      <?php foreach ($geo_zones as $geo_zone) { ?>
                        <?php if ($geo_zone['geo_zone_id'] == $hubtel_geo_zone_id) { ?>
                          <option value="<?php echo $geo_zone['geo_zone_id']; ?>"
                                  selected="selected"><?php echo $geo_zone['name']; ?></option>
                        <?php } else { ?>
                          <option
                            value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                  <div class="col-sm-10">
                    <select name="hubtel_status" id="input-status" class="form-control">
                      <?php if ($hubtel_status) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                      <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="hubtel_sort_order" value="<?php echo $hubtel_sort_order; ?>"
                           placeholder="<?php echo $entry_sort_order; ?>" id="input-sort-order" class="form-control"/>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab-company-details">
                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-company-name"><span data-toggle="tooltip"
                                                                                       title="<?php echo $help_company_name; ?>"><?php echo $entry_company_name; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="hubtel_company_name" value="<?php echo $hubtel_company_name; ?>"
                           placeholder="<?php echo $entry_company_name; ?>" id="input-company-name" class="form-control"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-company-tagline"><span data-toggle="tooltip"
                                                                                          title="<?php echo $help_company_tagline; ?>"><?php echo $entry_company_tagline; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="hubtel_company_tagline" value="<?php echo $hubtel_company_tagline; ?>"
                           placeholder="<?php echo $entry_company_tagline; ?>" id="input-company-tagline"
                           class="form-control"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-input-company-phone"><span data-toggle="tooltip"
                                                                                              title="<?php echo $help_company_phone; ?>"><?php echo $entry_company_phone; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="hubtel_company_phone" value="<?php echo $hubtel_company_phone; ?>"
                           placeholder="<?php echo $entry_company_phone; ?>" id="input-company-phone"
                           class="form-control"/>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="input-company-web-url"><span data-toggle="tooltip"
                                                                                          title="<?php echo $help_company_web_url; ?>"><?php echo $entry_company_web_url; ?></span></label>
                  <div class="col-sm-10">
                    <input type="text" name="hubtel_company_web_url" value="<?php echo $hubtel_company_web_url; ?>"
                           placeholder="<?php echo $entry_company_web_url; ?>" id="input-company-web-url"
                           class="form-control"/>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php echo $footer; ?>
