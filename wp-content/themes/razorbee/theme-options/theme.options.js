/* global jQuery:false */
/* global GREENTHUMB_STORAGE:false */

//-------------------------------------------
// Theme Options fields manipulations
//-------------------------------------------
jQuery(document).ready(function() {
	"use strict";

	// Toggle inherit button and cover
	jQuery('#greenthumb_options_tabs').on('click', '.greenthumb_options_inherit_lock,.greenthumb_options_inherit_cover', function (e) {
		var parent = jQuery(this).parents('.greenthumb_options_item');
		var inherit = parent.hasClass('greenthumb_options_inherit_on');
		if (inherit) {
			parent.removeClass('greenthumb_options_inherit_on').addClass('greenthumb_options_inherit_off');
			parent.find('.greenthumb_options_inherit_cover').fadeOut().find('input[type="hidden"]').val('');
		} else {
			parent.removeClass('greenthumb_options_inherit_off').addClass('greenthumb_options_inherit_on');
			parent.find('.greenthumb_options_inherit_cover').fadeIn().find('input[type="hidden"]').val('inherit');
			
		}
		e.preventDefault();
		return false;
	});

	// Refresh linked field
	jQuery('#greenthumb_options_tabs').on('change', '[data-linked] select,[data-linked] input', function (e) {
		var chg_name     = jQuery(this).parent().data('param');
		var chg_value    = jQuery(this).val();
		var linked_name  = jQuery(this).parent().data('linked');
		var linked_data  = jQuery('#greenthumb_options_tabs [data-param="'+linked_name+'"]');
		var linked_field = linked_data.find('select');
		var linked_field_type = 'select';
		if (linked_field.length == 0) {
			linked_field = linked_data.find('input');
			linked_field_type = 'input';
		}
		var linked_lock = linked_data.parent().parent().find('.greenthumb_options_inherit_lock').addClass('greenthumb_options_wait');
		// Prepare data
		var data = {
			action: 'greenthumb_get_linked_data',
			nonce: GREENTHUMB_STORAGE['ajax_nonce'],
			chg_name: chg_name,
			chg_value: chg_value
		};
		jQuery.post(GREENTHUMB_STORAGE['ajax_url'], data, function(response) {
			var rez = {};
			try {
				rez = JSON.parse(response);
			} catch (e) {
				rez = { error: GREENTHUMB_STORAGE['ajax_error_msg'] };
				console.log(response);
			}
			if (rez.error === '') {
				if (linked_field_type == 'select') {
					var opt_list = '';
					for (var i in rez.list) {
						opt_list += '<option value="'+i+'">'+rez.list[i]+'</option>';
					}
					linked_field.html(opt_list);
				} else {
					linked_field.val(rez.value);
				}
				linked_lock.removeClass('greenthumb_options_wait');
			}
		});
		e.preventDefault();
		return false;
	});
	
	
	// Check for dependencies
	//-----------------------------------------------------------------------------
	jQuery('.greenthumb_options .greenthumb_options_section').each(function () {
		greenthumb_options_check_dependencies(jQuery(this));
	});
	jQuery('.greenthumb_options .greenthumb_options_item_field [name^="greenthumb_options_field_"]').on('change', function () {
		greenthumb_options_check_dependencies(jQuery(this).parents('.greenthumb_options_section'));
	});
	
	
	// Check for dependencies
	function greenthumb_options_check_dependencies(cont) {
		cont.find('.greenthumb_options_item_field').each(function() {
			var id = jQuery(this).data('param');
			if (id == undefined) return;
			var depend = false;
			for (var fld in greenthumb_dependencies) {
				if (fld == id) {
					depend = greenthumb_dependencies[id];
					break;
				}
			}
			if (depend) {
				var dep_cnt = 0, dep_all = 0;
				var dep_cmp = typeof depend.compare != 'undefined' ? depend.compare.toLowerCase() : 'and';
				var dep_strict = typeof depend.strict != 'undefined';
				var fld=null, val='', name='', subname='';
				var parts = '', parts2 = '';
				for (var i in depend) {
					if (i == 'compare' || i == 'strict') continue;
					dep_all++;
					name = i;
					subname = '';
					if (name.indexOf('[') > 0) {
						parts = name.split('[');
						name = parts[0];
						subname = parts[1].replace(']', '');
					}
					if (name.charAt(0)=='#' || name.charAt(0)=='.') {
						fld = jQuery(name);
						if (fld.length > 0 && !fld.hasClass('trx_addons_inited')) {
							fld.addClass('trx_addons_inited').on('change', function () {
								jQuery('.greenthumb_options .greenthumb_options_section').each(function () {
									greenthumb_options_check_dependencies(jQuery(this));
								});
							});
						}
					} else
						fld = cont.find('[name="greenthumb_options_field_'+name+'"]');
					if (fld.length > 0) {
						val = fld.attr('type')=='checkbox' || fld.attr('type')=='radio' 
									? (fld.parents('.greenthumb_options_item_field').find('[name^="greenthumb_options_field_"]:checked').length > 0 
										? (fld.parents('.greenthumb_options_item_field').find('[name^="greenthumb_options_field_"]:checked').val()
											? fld.parents('.greenthumb_options_item_field').find('[name^="greenthumb_options_field_"]:checked').val()
											: 1
											)
										: 0
										)
									: fld.val();
						if (val===undefined || val===null) val = '';
						if (subname!='') {
							parts = val.split('|');
							for (var p=0; p<parts.length; p++) {
								parts2 = parts[p].split('=');
								if (parts2[0]==subname) {
									val = parts2[1];
								}
							}
						}
						for (var j in depend[i]) {
							if ( 
								   (depend[i][j]=='not_empty' && val!='')	// Main field value is not empty - show current field
								|| (depend[i][j]=='is_empty' && val=='')	// Main field value is empty - show current field
								|| (val!=='' && (!isNaN(depend[i][j]) 		// Main field value equal to specified value - show current field
													? val==depend[i][j]
													: (dep_strict 
															? val==depend[i][j]
															: val.indexOf(depend[i][j])==0
														)
												)
									)
								|| (val!=='' && (""+depend[i][j]).charAt(0)=='^' && val.indexOf(depend[i][j].substr(1))==-1)
																// Main field value not equal to specified value - show current field
							) {
								dep_cnt++;
								break;
							}
						}
					} else
						dep_all--;
					if (dep_cnt > 0 && dep_cmp == 'or')
						break;
				}
				if ((dep_cnt > 0 && dep_cmp == 'or') || (dep_cnt == dep_all && dep_cmp == 'and')) {
					jQuery(this).parents('.greenthumb_options_item').show().removeClass('greenthumb_options_no_use');
				} else {
					jQuery(this).parents('.greenthumb_options_item').hide().addClass('greenthumb_options_no_use');
				}
			}
		});
	}

});