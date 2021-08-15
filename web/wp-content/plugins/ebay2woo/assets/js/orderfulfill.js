jQuery(function ($) {

	$(document).on("click", ".e2w_ebay_order_fulfillment", function () {
		var id = null;
		if ( typeof $(this).attr('id') == "undefined" && $(this).attr('href').substr(0,1) === "#" ) {
			id = $(this).attr('href').substr(1);
		} else {
			id =  $(this).attr('id').split('-')[1];
		}

		var ids = [];
		ids.push(id);

		e2w_start_order_process(ids, 1);

		return false;
	});

	function app_rsp_timer_run(t){
		return setTimeout(function(){
			e2w_show_tip(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.get_no_responces_from_chrome_ext_d, 'https://ali2woo.com/codex/chrome-no-responce-issue/'), false, false, false, true);
			get_e2w_popup().find('.close').off('click').click(function () {
				e2w_hide_block();
				e2w_close_chrome_tab();
			});

		}, 30000);
	}


	function e2w_js_place_order(ids, state, on_load_calback){
		if (ids.length > 0) {
			var tmp_ids = ids.slice(0),
				id = ids.shift();

			var data = {'action': 'e2w_get_ebay_order_data', 'id': id};

			$.post(ajaxurl, data, function (response) {
				var json = $.parseJSON(response);

				if (json === null || json.state === undefined) {
					return false;
				}

				if (json.state !== 'ok') {
				//	console.log(json);
				}

				if (json.state === 'error') {
					state.error_cnt += 1;
					if (on_load_calback) {

						var data = {'stage': -5}; // unknown error

						if (typeof json.error_code !== "undefined") {
							data['stage'] = json.error_code
						}

						on_load_calback(json.state, state, data, tmp_ids);
					}
				} else {
					if (json.action === 'upd_ord_status') {

					}

					e2w_get_order_fulfillment(json.data.content, function(data){
						on_load_calback('ok', state, data, tmp_ids);
					});
				}

			}).fail(function (xhr, status, error) {
				console.log(error);
				state.error_cnt += 1;

				if (on_load_calback) {
					var data = {'stage': -6}; // server error
					on_load_calback('error', state, data, tmp_ids);
				}
			});
		} else {
			var data = {'stage': 6};
			on_load_calback('ok', state, data, tmp_ids);
		}
	}

	var e2w_start_order_process = function(ids, total_ids) {
		if (total_ids > 0) {
			e2w_reset_blocks();
			e2w_show_block(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.placing_orders_d_of_d, 0, total_ids));

			if (typeof e2w_get_order_fulfillment == "undefined") {

				e2w_show_tip(e2w_ebay_orderfulfill_js.lang.install_chrome_ext, false, false, false, true);
				get_e2w_popup().find('.close').off('click').click(function () {
					e2w_hide_block();

					if (typeof e2w_close_chrome_tab === "function") {
						e2w_close_chrome_tab();
					}
				});

				return;
			}

			var skip_order = function(ids, state){
				ids.shift();
				state.error_cnt += 1;
				state.success_cnt += 1;
				e2w_reset_blocks();
				e2w_show_block(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.placing_orders_d_of_d, state.success_cnt, state.num_to_update));
				rsp_timer = app_rsp_timer_run();
				e2w_js_place_order(ids, state, on_load);
			};

			var on_load = function (response_state, state, data, ids) {

				clearTimeout(rsp_timer);

				var e2w_popup = get_e2w_popup();

				if (response_state === "error") {

					switch (data.stage) {

						case -6:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.server_error, true);
							e2w_popup.find('.continue').off('click').click(function () {
								e2w_reset_blocks();
								rsp_timer = app_rsp_timer_run();
								e2w_js_place_order(ids, state, on_load);
							});
							break;

						case -5:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.unknown_error, false, true);
							e2w_popup.find('.skip').off('click').click(function () {
								skip_order(ids, state);
							});
							break;

						case -4:
							e2w_show_tip(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.no_ebay_products,'https://ali2woo.com/codex/no-ebay-prodoct-error/'),false,true);
							e2w_popup.find('.skip').off('click').click(function () {
								skip_order(ids, state);
							});
							break;

						case -3:
							e2w_show_tip(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.no_product_url,'https://ali2woo.com/codex/no-product-url-error/'),false,true);
							e2w_popup.find('.skip').off('click').click(function () {
								skip_order(ids, state);
							});
							break;

						case -2:
							e2w_show_tip(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.no_variable_data,'https://ali2woo.com/codex/no-variable-data-error/'),false,true);
							e2w_popup.find('.skip').off('click').click(function () {
								skip_order(ids, state);
							});
							break;
						case -1:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.bad_product_id,false,true);
							e2w_popup.find('.skip').off('click').click(function () {
								skip_order(ids, state);
							});
							break;
					}

				}
				else if (typeof data !== "undefined") {

					switch (data.stage) {
						case 0:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.login_into_ebay_account,false,false,false,false,true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();
							});
							break;

						case 1:
							e2w_show_tip(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.please_connect_chrome_extension_check_d, 'https://ali2woo.com/codex/ebay-google-chrome-extension/'), true);
							e2w_popup.find('.continue').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_start_order_process(ids, ids.length);
							});
							break;

						case 11:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.we_found_old_order, true);
							e2w_popup.find('.continue').off('click').click(function () {
								e2w_reset_blocks();
								e2w_show_block(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.placing_orders_d_of_d, state.success_cnt, state.num_to_update));
								rsp_timer = app_rsp_timer_run();
								e2w_js_place_order(ids, state, on_load);
							});
							break;

						case 2:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.please_activate_right_store_apikey_in_chrome, true);
							e2w_popup.find('.continue').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_start_order_process(ids, ids.length);
							});
							break;

						case 21:
							e2w_show_tip(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.cant_add_product_to_cart_d,'https://ali2woo.com/codex/chrome-add-to-cart-issue/'), true,false,false,false,true);
							e2w_popup.find('.solve').off('click').click(function () {
								e2w_switch_to_chrome_tab();
							});
							e2w_popup.find('.continue').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_get_order_fulfillment({});
								e2w_switch_to_chrome_tab();
							});
							break;

						case 3:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.please_type_customer_address,false,true,false,false,true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();
							});
							e2w_popup.find('.skip').off('click').click(function () {
								skip_order(ids, state);
							});
							break;

						case 33:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.please_input_captcha,false,false,false,false,true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();
							});
							break;

						case 41:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.internal_ebay_error, true,true);
							e2w_popup.find('.continue').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_start_order_process(ids, ids.length);
							});
							e2w_popup.find('.skip').off('click').click(function () {
								skip_order(ids, state);
							});
							break;

						case 42:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.payment_is_failed, true);
							e2w_popup.find('.continue').off('click').click(function () {
								ids.shift();
								state.error_cnt += 1;
								state.success_cnt += 1;
								e2w_reset_blocks();
								e2w_show_block(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.placing_orders_d_of_d, state.success_cnt, state.num_to_update));
								rsp_timer = app_rsp_timer_run();
								e2w_js_place_order(ids, state, on_load);
							});
							break;

						case 43:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.cant_get_order_id, true);
							e2w_popup.find('.continue').off('click').click(function () {
								ids.shift();
								state.error_cnt += 1;
								state.success_cnt += 1;
								e2w_reset_blocks();
								e2w_show_block(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.placing_orders_d_of_d, state.success_cnt, state.num_to_update));
								rsp_timer = app_rsp_timer_run();
								e2w_js_place_order(ids, state, on_load);
							});
							break;

						case 44:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.choose_payment_method,false,false,false,false,true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();

								// reset
								rsp_timer = app_rsp_timer_run();
								e2w_reset_blocks();
								e2w_show_tip(e2w_ebay_orderfulfill_js.lang.choose_payment_method,false,false,false,true);
								e2w_popup.find('.close').off('click').click(function () {
									e2w_hide_block();
								});
							});
							break;

						case 45:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.retry, true);
							e2w_popup.find('.continue').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_start_order_process(ids, ids.length);
							});
							break;

						case 46:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.sign_in, true,false,false,false,true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();
							});
							e2w_popup.find('.continue').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_start_order_process(ids, ids.length);
							});
							break;

						case 47:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.reg_update, false,false,false,false,true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();
							});
							break;

						case 5:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.order_is_placed);
							setTimeout(function(){
								ids.shift();
								state.success_cnt += 1;
								e2w_reset_blocks();
								e2w_show_block(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.placing_orders_d_of_d, state.success_cnt, state.num_to_update));
								rsp_timer = app_rsp_timer_run();
								e2w_js_place_order(ids, state, on_load);
							},1500);
							break;

						case 51:
							rsp_timer = app_rsp_timer_run();
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.cart_is_cleared);
							break;

						case 511:
							rsp_timer = app_rsp_timer_run();
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.auction_product, false,false,false,false,true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();
							});
							break;

						case 512:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.error_shipping_details,false,false,false,false,true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();

								// reset
								rsp_timer = app_rsp_timer_run();
								e2w_reset_blocks();
								e2w_show_tip(e2w_ebay_orderfulfill_js.lang.error_shipping_details,false,false,false,true);
								e2w_popup.find('.close').off('click').click(function () {
									e2w_hide_block();
								});
							});
							break;

						case 513:
							rsp_timer = app_rsp_timer_run();
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.filling_customer_details);
							break;

						case 52:
							rsp_timer = app_rsp_timer_run();
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.all_products_are_added);
							break;

						case 53:
							rsp_timer = app_rsp_timer_run();
							if (typeof data.param !== "undefined") {
								e2w_show_tip(e2w_sprintf(e2w_ebay_orderfulfill_js.lang.product_is_added_to_cart, data.param));
							} else {
								e2w_show_tip(e2w_ebay_orderfulfill_js.lang.product_is_added_to_cart);
							}
							break;

						case 54:
							rsp_timer = app_rsp_timer_run();
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.your_customer_address_entered);
							break;

						case 55:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.detected_old_ebay_interface, false, false, false, true);
							e2w_popup.find('.close').off('click').click(function () {
								e2w_hide_block();
								e2w_close_chrome_tab();
							});
							break;

						case 56:
							rsp_timer = app_rsp_timer_run();
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.fill_order_note);
							break;

						case 57:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.done_pay_manually,false,false,false,false,true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();
							});
							break;

						case 58:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.out_of_stock, true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();
							});
							break;

						case 59:
							e2w_show_tip(e2w_ebay_orderfulfill_js.lang.quantity_not_available, true);
							e2w_popup.find('.solve').off('click').click(function () {
								rsp_timer = app_rsp_timer_run();
								e2w_switch_to_chrome_tab();
							});
							break;

						case 6:
							if (state.error_cnt < state.num_to_update) {
								e2w_show_tip(e2w_ebay_orderfulfill_js.lang.all_orders_are_placed, false, false, true);
								e2w_popup.find('.payall').off('click').click(function () {
									e2w_go_to_payall();
									e2w_hide_block();
								});
							} else {
								e2w_show_tip(e2w_ebay_orderfulfill_js.lang.cant_process_your_orders, false, false, false, true);
								e2w_popup.find('.close').off('click').click(function () {
									e2w_hide_block();
									e2w_close_chrome_tab();
								});
							}
							break;
					}
				}
			};

			var state = {num_to_update: total_ids, success_cnt: 0, error_cnt: 0};
			var rsp_timer = app_rsp_timer_run();
			e2w_js_place_order(ids, state, on_load);
		}
	};

	$("#doaction, #doaction2").click(function (event) {
		var check_action = ($(this).attr('id') === 'doaction') ? $('#bulk-action-selector-top').val() : $('#bulk-action-selector-bottom').val();
		if ('e2w_order_place_bulk' === check_action) {
			event.preventDefault();

			var ids = [], cnt = 0, total_ids = 0;

			$('input:checkbox[name="post[]"]:checked').each(function () {
				total_ids++;
				cnt++;
				ids.push($(this).val());
			});

			e2w_start_order_process(ids, total_ids);
		}
	});

	var e2w_show_block = function(message) {
		var e2w_popup = get_e2w_popup();
		e2w_popup.find('.pr').html(message);
		e2w_popup.show();
	};

	var e2w_hide_block = function() {
		get_e2w_popup().hide();
	};

	var e2w_show_tip = function(message, _continue, skip, payall, close, solve) {
		e2w_reset_blocks();
		var e2w_popup = get_e2w_popup();
		e2w_popup.find('.tip').html(message).show();

		if (_continue)
			e2w_popup.find('.continue').show();

		if (skip)
			e2w_popup.find('.skip').show();

		if (payall)
			e2w_popup.find('.payall').show();

		if (typeof close !== "undefined" && close){
			e2w_popup.find('.close').show();
		}

		if (typeof solve !== "undefined" && solve){
			e2w_popup.find('.solve').show();
		}
	};

	var e2w_reset_blocks = function() {
		var e2w_popup = get_e2w_popup();
		e2w_popup.find('.tip').hide().html('');
		e2w_popup.find('.continue').hide();
		e2w_popup.find('.skip').hide();
		e2w_popup.find('.payall').hide();
		e2w_popup.find('.close').hide();
		e2w_popup.find('.solve').hide();
	};

	var get_e2w_popup = function() {
		return $('.hover_e2w_fulfillment');
	};

});