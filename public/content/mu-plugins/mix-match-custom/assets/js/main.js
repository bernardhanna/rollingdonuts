// Btn active class
jQuery(document).ready(function () {
  if (ewcpm_php_vars_cb._mm_template_type != 'grid') {

    jQuery('.gift_box_container').height()
    var heightright = jQuery('.gift_box_container').height();
    jQuery('.vertical_box .product_addon_box').css('height', heightright);
  }
  var valid = true;
  var stockQtyinfo = ewcpm_php_vars_cb.localizeproductarray;
  var count = ewcpm_php_vars_cb.prefileldArraylength;
  var globaltotal;
  var pricingtype = ewcpm_php_vars_cb.pricingType;
  var baseprice = 0.0;
  var basebrice = 0.0;
  var arrs = [];
  var mmProdLimitEnable = ewcpm_php_vars_cb.mmProdLimitEnable;
  var mmProdLimitQuantity = ewcpm_php_vars_cb.mmProdLimitQuantity;
  var subtotal = ewcpm_php_vars_cb.Subtotal;

  if (subtotal == undefined) {
    subtotal = 'Subtotal'
  }


  //  console.log('count='+count)

  if ('perwithbase' == pricingtype || 'fixed' == pricingtype) {
    baseprice = parseFloat(ewcpm_php_vars_cb.parentProductprice);
    if (typeof (baseprice) == undefined) {
      baseprice = 0.0;
    }
  } else if ('perwoutbase' == pricingtype) {
    basebrice = baseprice;
  }
  var mmPrefilled_enable = ewcpm_php_vars_cb.mmPrefilled_enable;
  if (mmPrefilled_enable == 'yes') {

    var myArr = ewcpm_php_vars_cb.prefileldArray;
    globaltotal = myArr.reduce((total, curr) => {
      return total + parseFloat(curr['product_price'])
    }, parseFloat(baseprice))

    let myArr2 = [];
    for (let i = 0; i < myArr.length; i++) {
      if (myArr[i]['product_id'] != '') {
        myArr2.push(myArr[i]['product_id']);
      }
    }
    arrs.push(myArr2);

  } else {
    globaltotal = baseprice;
  }

  var partialyAllow = ewcpm_php_vars_cb.partialyAllow;
  var minboxqty = ewcpm_php_vars_cb.minboxqty;

  if (partialyAllow == 'yes') {
    if (count >= minboxqty) {
      jQuery('.extendonssingleaddtocart').prop('disabled', false);
    }
  }
  if (mmPrefilled_enable == 'yes' && 'fixed' != pricingtype) {
    globaltotal = globaltotal.toFixed(2);
    jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + ewcpm_php_vars_cb.currencysymbol + '</span>' + globaltotal + '</bdi></span>');
  }


  jQuery('#mm_product_items').val(JSON.stringify(arrs));

  function parsePrice(price, currencySymbol) {
    var hasCommaAsDecimalSeparator;
    switch (currencySymbol) {
      // List of currency symbols that use a comma as a decimal separator
      case '€':
        hasCommaAsDecimalSeparator = true;
        break;
      case '₣':
        // Add other currency symbols as needed
        hasCommaAsDecimalSeparator = true;
        break;
      default:
        hasCommaAsDecimalSeparator = false;
    }

    if (hasCommaAsDecimalSeparator) {
      return parseFloat(price.replace(',', '.'));
    } else {
      return parseFloat(price.replace(/,/g, ''));
    }
  }
  // for (let i = 0; i < 3; i++) {
  jQuery('body').on('click', '.add_cta', function (e) {
    e.preventDefault();
    let $this = jQuery(this);
    let boxQty = ewcpm_php_vars_cb.boxQty;
    let blockitem = jQuery(this).closest('.pd_add_block_inner').find('.image_block');
    let priceval = jQuery(this).closest('.pd_add_block_inner').find('.price');
    let currencysymbol = jQuery(this).closest('.pd_add_block_inner').find('.woocommerce-Price-currencySymbol').text();
    let currencySymbol;
    let originalPriceWithSymbol;
    let originalPriceWithoutSymbol;


    // mmProdLimitQuantity

    if (priceval) {
      currencySymbol = priceval.find('.woocommerce-Price-currencySymbol:last').text();
      originalPriceWithSymbol = priceval.find('.woocommerce-Price-amount.amount:last').text();
      originalPriceWithoutSymbol = originalPriceWithSymbol.replace(currencySymbol, '');
    } else {
      originalPriceWithSymbol = parseFloat(0);
    }

    originalPriceWithoutSymbol = parsePrice(originalPriceWithoutSymbol, currencySymbol);

    let totalprice = parseFloat(0);
    let baseprice = parseFloat(0);
    if ('perwithbase' == pricingtype) {
      baseprice = parseFloat(ewcpm_php_vars_cb.parentProductprice);
    } else if ('perwoutbase' == pricingtype) {
      basebrice = parseFloat(baseprice);
    }
    let thumbnailsrc = blockitem.find('img').attr('src');
    let acivelistitem;
    jQuery('.active_bx_dtl .gt_box_list li').each(function (index, value) {
      if (jQuery(this).hasClass('extendons_active_boxes')) {
        acivelistitem = jQuery(this);
        return false;
      }
    });
    itemid = jQuery(this).attr('data-id');
    let this_prod_quantity = parseInt(jQuery('.exqtyval' + itemid).text());

    prod_id = itemid;
    prod_quant = '.exqtyval' + itemid;

    // if (count==0) {
    // prdouct_limit_array= {};
    // }

    // if (typeof prdouct_limit_array == 'undefined') {
    // prdouct_limit_array= {};
    // }

    // if (prdouct_limit_array.hasOwnProperty(prod_quant)) {

    //     if (this_prod_quantity=="" || null==this_prod_quantity ){
    //     	this_prod_quantity = 0;
    //     }
    //     this_prod_quantity = this_prod_quantity + 1;

    //     prdouct_limit_array[prod_quant] = this_prod_quantity;
    // } else {
    //     prdouct_limit_array[prod_quant] = 1;

    // }


    // if (mmProdLimitEnable == 'yes' && this_prod_quantity > mmProdLimitQuantity){

    // 	jQuery('.product_box_container').before('<div class="extendonsboxfillederrormsg ext-limit-msg woocommerce-message  exterrormsg"><p>You cannot purchase more than '+mmProdLimitQuantity+' of the same product.</p></div>');
    // 	jQuery('.ext-limit-msg').delay(3000).fadeOut('slow');
    // 	valid = false;
    // 	jQuery( 'html,.extendonsboxfillederrormsg' ).scrollTop(0);
    // 	return false;
    // 	}

    /********************************New Code************************************/

    if (count == 0) {
      prdouct_limit_array = {};
    }

    if (typeof prdouct_limit_array === 'undefined') {
      prdouct_limit_array = {};
    }

    if (!prdouct_limit_array.hasOwnProperty(prod_quant)) {
      prdouct_limit_array[prod_quant] = 0;
    }

    if ("" === this_prod_quantity || null === this_prod_quantity) {
      this_prod_quantity = 0;
    }
    this_prod_quantity++;

    if ('yes' === mmProdLimitEnable && this_prod_quantity > mmProdLimitQuantity) {

      jQuery('.product_box_container').before('<div class="extendonsboxfillederrormsg ext-limit-msg woocommerce-message exterrormsg"><p>You cannot purchase more than ' + mmProdLimitQuantity + ' of the same product.</p></div>');
      jQuery('.ext-limit-msg').delay(3000).fadeOut('slow');
      valid = false;
      jQuery('html, body').scrollTop(0);
      return false;
    }

    prdouct_limit_array[prod_quant] = this_prod_quantity;

    /********************************New Code end************************************/


    if (boxQty == count) {
      jQuery('.extendonsboxfillederrormsg').remove();
      jQuery('.product_box_container').before('<div class="extendonsboxfillederrormsg woocommerce-message extsuccessmsg"><p>' + ewcpm_php_vars_cb.boxsuccessmessage + '</p></div>');
      jQuery('.extendonsboxfillederrormsg').delay(3000).fadeOut('slow');
      jQuery('.extendonsboxfillederrormsg').show();
      jQuery('.extendonssingleaddtocart').prop('disabled', false);
      if (ewcpm_php_vars_cb.add_new_box_quantity == 'yes') {
        jQuery('.extendonsaddnewbox').show();
      }
      valid = false;
      jQuery('html,.extendonsboxfillederrormsg').scrollTop(0);
      return false;
    } else {
      valid = true;
      if (itemid in stockQtyinfo) {
        if (stockQtyinfo[itemid] == 0) {
          jQuery('.extendonsboxfillederrormsg').remove();
          jQuery('.product_box_container').before('<div class="extendonsboxfillederrormsg woocommerce-message exterrormsg"><p> You cannot add more product stock is less </p></div>');
          jQuery('.extendonsboxfillederrormsg').delay(3000).fadeOut('slow');
          jQuery('.extendonsboxfillederrormsg').show();
          jQuery('html,.extendonsboxfillederrormsg').scrollTop(0);
          return false;
        }
        stockQtyinfo[itemid] = stockQtyinfo[itemid] - 1
      }
      jQuery($this).parent().parent().addClass('pd_addon_active');
      count++;
      if (partialyAllow == 'yes') {
        if (count == minboxqty) {
          jQuery('.extendonssingleaddtocart').prop('disabled', false);
        }
      } else {
        if (boxQty == count) {
          jQuery('.extendonssingleaddtocart').prop('disabled', false);
        }
        if (ewcpm_php_vars_cb.add_new_box_quantity == 'yes' && boxQty == count) {
          jQuery('.extendonsaddnewbox').show();
        }
      }
      jQuery('.active_tab .extendonsfilledboxcount').text(count);
      jQuery('.active_bx_dtl .extendonsfilledboxcount').text(count);
      let itemqty = jQuery(this).parent().parent().find('.addon_qty span').text();
      itemqty = parseInt(itemqty);
      itemqty++;
      jQuery(this).parent().parent().find('.addon_qty span').text(itemqty);
      jQuery('.exqtyval' + itemid).text(itemqty);

      ext_minicart_fly_to_cart(blockitem, acivelistitem);
      var qtyperbox = jQuery('#gift_box_' + box).find('.Boxqty').val();
      if ('fixed' == pricingtype) {
        globaltotal = parseFloat(ewcpm_php_vars_cb.parentProductprice);
      } else {
        globaltotal = parseFloat(globaltotal);
      }

      if (typeof (globaltotal) == undefined || Number.isNaN(globaltotal) || typeof (globaltotal) == NaN || globaltotal == NaN || globaltotal == undefined) {
        globaltotal = 0;
      }
      var color_val = jQuery('.gt_bx_rt').attr('color_val');
      var circled_x = `<?xml version="1.0" encoding="utf-8"?>
					<svg data-id="`+ itemid + `" class= "extendonsremovefilledboxes ` + itemid + `" width="24px" height="24px" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
					<g fill="none" fill-rule="evenodd" stroke="`+ color_val + `" stroke-linecap="round" stroke-linejoin="round" transform="translate(2 2)">
					<circle cx="8.5" cy="8.5" r="8"/>
					<g transform="matrix(0 1 -1 0 17 0)">
					<path d="m5.5 11.5 6-6"/>
					<path d="m5.5 5.5 6 6"/>
					</g>
					</g>
					</svg>`;
      jQuery(acivelistitem).find('.img_block img').attr('src', thumbnailsrc);
      jQuery(acivelistitem).removeClass('extendons_active_boxes');
      jQuery(acivelistitem).addClass('extendonsfilleditem');
      jQuery(acivelistitem).find('.img_block').after('<div class="dlt_icon">' + circled_x + '</div><div class="gt_overlay"><div class="overlay_inner"><div class="price"><span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + currencySymbol + '</span>' + originalPriceWithoutSymbol + '</bdi></span></div></div></div>');

      if (ewcpm_php_vars_cb._mm_template_type == 'grid') {

        if (jQuery(window).width() > 400) {
          if (jQuery('.active_bx_dtl').width() < jQuery(acivelistitem).offset().left - 400) {
            jQuery('.gt_box_list').animate({ scrollLeft: jQuery(acivelistitem).offset().left }, 800);
          }
        } else {
          if (jQuery('.active_bx_dtl').width() < jQuery(acivelistitem).offset().left) {
            jQuery('.gt_box_list').animate({ scrollLeft: jQuery(acivelistitem).offset().left }, 800);
          }
        }

      } else {

        if (jQuery(window).width() > 400) {
          if (jQuery('.active_bx_dtl').height() < jQuery(acivelistitem).offset().top - 400) {
            jQuery('.gt_box_list').animate({ scrollTop: jQuery(acivelistitem).offset().top }, 800);
          }
        } else {
          if (jQuery('.active_bx_dtl').width() < jQuery(acivelistitem).offset().left) {
            jQuery('.gt_box_list').animate({ scrollLeft: jQuery(acivelistitem).offset().left }, 800);
          }
        }
      }

      originalPriceWithoutSymbol = parseFloat(originalPriceWithoutSymbol) * parseFloat(qtyperbox);
      globaltotal = parseFloat(globaltotal) + parseFloat(originalPriceWithoutSymbol);
      globaltotal = globaltotal.toFixed(2);
    }


    // console.log('added')
    if (valid) {
      let numberofbox = jQuery('.active_bx_dtl').attr('data-box-count');
      if ('fixed' != pricingtype) {
        jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + currencySymbol + '</span>' + globaltotal + '</bdi></span>');
      }
      if (arrs[numberofbox] == undefined) {
        arrs[numberofbox] = [];
      }
      arrs[numberofbox].push(itemid);
      jQuery('#mm_product_items').val(JSON.stringify(arrs));
    }


  });

  // }
  // for (let i = 0; i < 3; i++) {
  jQuery('body').on('click', '.extendonsfilledboxesremove', function (e) {
    e.preventDefault();
    var id = jQuery(this).attr('data-id');
    var $this = jQuery(this);
    if (!jQuery('.active_bx_dtl .product_gift_box').hasClass('.extendonsfilleditem')) {
      var boxes = jQuery('.active_bx_dtl').find('.' + id);
      if (boxes.size() == 0) {
        return false;
      }
    }
    // console.log(boxes.size());
    /**
     * checks if product is pre-filled
     * @return bool
    **/
    prefilled_find_class = jQuery('.active_bx_dtl').find('.' + id).last();
    if (prefilled_find_class != undefined && jQuery(prefilled_find_class).closest("li").hasClass("prefilleditem")) {
      return false;
    };

    jQuery('.active_bx_dtl').find('.' + id).last().click();
    // console.log(id)
  });

  jQuery('.extendonssingleaddtocart').on('click', function (e) {
    if (pricingtype == 'fixed') {
      jQuery('#mmperItemPrice').val(baseprice);
    } else {
      jQuery('#mmperItemPrice').val(globaltotal);
    }

  });
  // }

  jQuery('body').on('click', '.extenonsboxplus', function (e) {
    e.preventDefault();
    var Qtyval = jQuery(this).parent().find('.Boxqty').val();
    Qtyval = parseInt(Qtyval) + parseInt(1);
    var acivelistitem;
    var currencySymbol;
    var originalPriceWithSymbol;
    var originalPriceWithoutSymbol;
    var boxtotal = 0;
    jQuery('.active_bx_dtl .gt_box_list li').each(function (index, value) {
      if (jQuery(this).hasClass('extendonsfilleditem')) {
        acivelistitem = jQuery(this);
        currencySymbol = acivelistitem.find('.woocommerce-Price-currencySymbol').text();
        originalPriceWithSymbol = acivelistitem.find('.woocommerce-Price-amount.amount').text();
        originalPriceWithoutSymbol = originalPriceWithSymbol.replace(currencySymbol, '');
        boxtotal += parseFloat(originalPriceWithoutSymbol);
      }
    });

    // console.log(boxtotal);

    globaltotal = parseFloat(globaltotal) + parseFloat(boxtotal);
    if ('fixed' != pricingtype) {
      jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + ewcpm_php_vars_cb.currencysymbol + '</span>' + globaltotal + '</bdi></span>');
    }
    jQuery(this).parent().find('.Boxqty').val(Qtyval);

  });

  jQuery('body').on('click', '.extenonsboxminus', function (e) {
    e.preventDefault();
    var Qtyval = jQuery(this).parent().find('.Boxqty').val();
    if (Qtyval == 1) {
      return false;
    }
    Qtyval = parseInt(Qtyval) - parseInt(1);
    var acivelistitem;
    var currencySymbol;
    var originalPriceWithSymbol;
    var originalPriceWithoutSymbol;
    var boxtotal = 0;
    jQuery('.active_bx_dtl .gt_box_list li').each(function (index, value) {
      if (jQuery(this).hasClass('extendonsfilleditem')) {
        acivelistitem = jQuery(this);
        currencySymbol = acivelistitem.find('.woocommerce-Price-currencySymbol').text();
        originalPriceWithSymbol = acivelistitem.find('.woocommerce-Price-amount.amount').text();
        originalPriceWithoutSymbol = originalPriceWithSymbol.replace(currencySymbol, '');
        boxtotal += parseFloat(originalPriceWithoutSymbol);
      }
    });
    globaltotal = parseFloat(globaltotal) - parseFloat(boxtotal);
    if ('fixed' != pricingtype) {
      jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + ewcpm_php_vars_cb.currencysymbol + '</span>' + globaltotal + '</bdi></span>');
    }
    jQuery(this).parent().find('.Boxqty').val(Qtyval);

  });


  jQuery('body').on('click', '.extendonsremovenewboxes', function (e) {
    e.preventDefault();
    let currentactive;
    let currentactivebox;
    let deletetab;
    let listtabcount = 1;
    var boxremovearrayindex;
    var Qtyspan;
    if (ewcpm_php_vars_cb._mm_template_type == 'grid') {
      Qtyspan = '<span>Qty:</span>';
    } else {
      Qtyspan = '';
    }
    var color_val = jQuery('.gt_bx_rt').attr('color_val');
    svg_delete = `<?xml version="1.0" encoding="utf-8"?>
				<svg width="16px" height="16px" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
				<g fill="none" fill-rule="evenodd" stroke="` + color_val + `" stroke-linecap="round" stroke-linejoin="round" transform="translate(2 2)">
				<circle cx="8.5" cy="8.5" r="8"/>
				<g transform="matrix(0 1 -1 0 17 0)">
				<path d="m5.5 11.5 6-6"/>
				<path d="m5.5 5.5 6 6"/>
				</g>
				</g>
				</svg>`;

    jQuery('.gt_box_tab li').each(function () {

      if (jQuery(this).hasClass('active_tab')) {
        boxremovearrayindex = jQuery(this).index();
        jQuery(this).remove();
      }
      if (!jQuery(this).hasClass('active_tab')) {
        currentactive = jQuery(this);
        jQuery(currentactive).find('.box_tb_list').html('Box ' + listtabcount + ' <span class="gt_qt">' + Qtyspan + '<span class="extendonsfilledboxcount"></span></span>');
        jQuery(currentactive).attr('data-tab', parseInt(listtabcount) - parseInt(1));
        box = listtabcount;
        listtabcount++;
      }
    });
    boxCount = 0;
    jQuery('.product_gift_box').each(function () {

      if (jQuery(this).hasClass('active_bx_dtl')) {
        jQuery(this).find('.clear_cta').click();
        jQuery(this).remove();
        arrs.splice(jQuery(this).attr('data-box-count'), 1);
        if (jQuery(this).attr('data-box-count') == '0') {
          // jQuery(currentactivebox).find('.add_box').remove();
        }
      }
      if (!jQuery(this).hasClass('active_bx_dtl')) {
        currentactivebox = jQuery(this);
        var Qtyvalbox = jQuery(currentactivebox).find('.extendonsfilleditem').length;
        jQuery('[data-tab="' + boxCount + '"]').find('.extendonsfilledboxcount').text(Qtyvalbox);
        if (jQuery(currentactivebox).find('.gift_block').hasClass('extendonsfilleditem')) {
          count = jQuery(currentactivebox).find('.extendonsfilleditem').length;
          // globalcount = count;
          if (count != ewcpm_php_vars_cb.boxQty) {
            jQuery('.extendonsaddnewbox').hide();
            jQuery('.extendonsaddnewbox').hide();
          }
        }
        jQuery(currentactivebox).attr('data-box-count', parseInt(boxCount));
        jQuery(currentactivebox).attr('id', 'gift_box_' + boxCount);
        let aciveboxnu = parseInt(boxCount) + parseInt(1);
        jQuery(currentactivebox).find('.gt_box_qty .label').text('Box ' + aciveboxnu + ' Quantity');
        jQuery(currentactivebox).find('.extendonsremovenewboxes').html(svg_delete + 'Remove Box ' + aciveboxnu);
        // jQuery(currentactivebox).find('.extendonsremovenewboxes').text('Removes Box '+ aciveboxnu);

        boxCount++;
      }
    });




    if (currentactivebox.index() == 0) {
      jQuery('.extendonsremovenewboxes').remove();
    }


    box--;
    arrs.splice(boxremovearrayindex, 1);
    jQuery('#mm_product_items').val(JSON.stringify(arrs));
    jQuery(currentactive).addClass('active_tab');
    jQuery(currentactivebox).addClass('active_bx_dtl');
    count = jQuery(currentactivebox).find('.extendonsfilleditem').length;






  });

  jQuery('body').on('mouseenter', '.extendonsremovenewboxes', function () {
    // console.log('hovered')

    org_color = jQuery(this).find('svg').find('g').attr("stroke");
    jQuery(this).find('svg').find('g').attr("stroke", "#fff");
  })

  jQuery('body').on('mouseleave', '.extendonsremovenewboxes', function () {
    // console.log('hovered')

    // org_color = jQuery(this).find('svg').find('g').attr("stroke");
    jQuery(this).find('svg').find('g').attr("stroke", org_color);
  })

  jQuery('body').on('click', '.extendonsremovefilledboxes', function (e) {
    // console.log('clicked')
    e.preventDefault();
    let removeitemid = jQuery(this).attr('data-id');
    jQuery('.addon_qty').each(function () {
      var loopproid = jQuery(this).find('.add_cta').attr('data-id');
      //subtracted
      if (removeitemid == loopproid) {

        var qtyval = jQuery(this).find('.extendonsqtytext').text();
        qtyval = parseInt(qtyval) - parseInt(1);

        //iffffffffss

        jQuery(this).find('.extendonsqtytext').text(qtyval);
        jQuery('.popupqty' + removeitemid).text(qtyval);
        return false;
      }

    });

    let filledelementitem = jQuery(this).closest('.gift_block');
    let checkboxcounter = jQuery(this).closest('.gift_block').parent().parent().attr('data-box-count');
    let removearrindex = filledelementitem.index();
    let removemultiarrayindex = parseInt(box) - parseInt(1);
    arrs[box].splice(removearrindex, 1);
    jQuery('#mm_product_items').val(JSON.stringify(arrs));
    let removeitemprice = jQuery(filledelementitem).find('.overlay_inner .price').text();
    let currencySymbol = ewcpm_php_vars_cb.currencysymbol;
    removeitemprice = removeitemprice.replace(currencySymbol, '');
    var qtyperbox = jQuery('#gift_box_' + box).find('.Boxqty').val();
    removeitemprice = parseFloat(removeitemprice) * parseFloat(qtyperbox);
    globaltotal = parseFloat(globaltotal) - parseFloat(removeitemprice);
    globaltotal = globaltotal.toFixed(2)
    if ('fixed' != pricingtype) {
      jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + currencySymbol + '</span>' + globaltotal + '</bdi></span>');
    }
    let path = jQuery('.gt_box_list').attr("ph_src");
    if (path == '' || path == undefined) {
      path = jQuery('.add_box').attr("ph_src");
    }
    let img_src = path;


    jQuery(filledelementitem).addClass('extendons_active_boxes');
    jQuery(filledelementitem).removeClass('extendonsfilleditem');
    jQuery(filledelementitem).find('.img_block img').attr('src', img_src);
    jQuery(filledelementitem).find('.dlt_icon').remove();
    jQuery(filledelementitem).find('.gt_overlay').remove();
    valid = true;
    if (removeitemid in stockQtyinfo) {
      stockQtyinfo[removeitemid] = stockQtyinfo[removeitemid] + 1;
    }


    count = jQuery('.active_bx_dtl .extendonsfilledboxcount').first().text();
    count--;
    if (partialyAllow == 'yes') {
      if (count < minboxqty && checkboxcounter == 0) {
        jQuery('.extendonssingleaddtocart').prop('disabled', true);
      }
    } else {

      if (count < ewcpm_php_vars_cb.boxQty && checkboxcounter == 0) {
        jQuery('.extendonssingleaddtocart').prop('disabled', true);
        if (ewcpm_php_vars_cb.add_new_box_quantity == 'yes') {
          jQuery('.active_bx_dtl .extendonsaddnewbox').hide();
          jQuery('.add_box_cta').show();
        }
      }
    }

    jQuery('.active_tab .extendonsfilledboxcount').text(count);
    jQuery('.active_bx_dtl .extendonsfilledboxcount').text(count);
    jQuery('.extendonsboxfillederrormsg').remove();

  });

  function removeByValue(array, value) {
    return array.filter(function (elem, _index) {
      return value.toString() != elem.toString();
    });
  }

  jQuery('body').on('click', '.clear_cta', function (e) {
    e.preventDefault();
    var boxarray = [];
    var curRectboxprice = 0;
    var qtyperbox = jQuery('#gift_box_' + box).find('.Boxqty').val();
    var activecount = 0;
    let path = jQuery('.gt_box_list').attr("ph_src");

    if (path == '' || path == undefined) {
      path = jQuery('.add_box').attr("ph_src");
    }
    let img_src = path;
    jQuery('.active_bx_dtl .gift_block').each(function (index) {

      if (jQuery(this).hasClass('extendonsfilleditem') && !jQuery(this).hasClass('prefilleditem')) {

        var filledelementitem = jQuery(this);
        var boxremovearrayindex = jQuery(filledelementitem).parent().parent().attr('data-box-count');
        if (boxremovearrayindex == 0) {
          jQuery('.extendonssingleaddtocart').prop('disabled', true);

        }
        let removeitemprice = jQuery(filledelementitem).find('.overlay_inner .price').text();
        let currencySymbol = ewcpm_php_vars_cb.currencysymbol;
        removeitemprice = removeitemprice.replace(currencySymbol, '');
        // globaltotal = parseFloat(globaltotal) - parseFloat(removeitemprice);
        var filledbox = jQuery(filledelementitem).find('.extendonsremovefilledboxes').attr('data-id');
        arrs.splice(boxremovearrayindex, 1);
        jQuery('#mm_product_items').val(JSON.stringify(arrs));
        arrs[boxremovearrayindex] = [];
        if (filledbox in stockQtyinfo) {
          stockQtyinfo[filledbox] = stockQtyinfo[filledbox] + 1;
        }
        jQuery(filledelementitem).addClass('extendons_active_boxes');
        jQuery(filledelementitem).removeClass('extendonsfilleditem');
        boxarray.push(filledbox);
        jQuery(filledelementitem).find('.img_block img').attr('src', img_src);
        jQuery(filledelementitem).find('.dlt_icon').remove();
        jQuery(filledelementitem).find('.gt_overlay').remove();
        count = 0;
        curRectboxprice = parseFloat(curRectboxprice) + parseFloat(removeitemprice);
      }

      setTimeout(function () {
        jQuery('.extendonsaddnewbox').show();
      }, 100)

    });



    curRectboxprice = parseFloat(curRectboxprice) * qtyperbox;
    globaltotal = parseFloat(globaltotal) - parseFloat(curRectboxprice);
    globaltotal = globaltotal.toFixed(2)
    jQuery('#gift_box_' + box).find('.Boxqty').val(1);
    if (mmPrefilled_enable == 'yes') {
      var prefilledindex = 0;
      jQuery('.active_bx_dtl .gift_block').each(function (index) {

        if (jQuery(this).hasClass('extendonsfilleditem') && jQuery(this).hasClass('prefilleditem')) {

          var indexelement = prefilledindex;
          var boxarrayindex = jQuery(this).parent().parent().attr('data-box-count');
          var prefilled = jQuery(this).find('.extendonsremovefilledboxes').attr('data-id');
          arrs[boxarrayindex][indexelement] = prefilled;
          jQuery('#mm_product_items').val(JSON.stringify(arrs));
          count = jQuery('.prefilleditem').length;
          prefilledindex++;
        }
      });
    }


    jQuery('.active_bx_dtl .extendonsfilledboxcount').text(count);
    jQuery('.active_tab .extendonsfilledboxcount').text(count);
    jQuery('.active_bx_dtl .extendonsboxfillederrormsg').remove();
    if (ewcpm_php_vars_cb.add_new_box_quantity == 'yes') {
      jQuery('.active_bx_dtl .extendonsaddnewbox').hide();
    }
    if ('fixed' != pricingtype) {
      jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + ewcpm_php_vars_cb.currencysymbol + '</span>' + globaltotal + '</bdi></span>');
    }
    let itemvaluearr = countDuplicates(boxarray);
    if (itemvaluearr != '') {
      let keys = Object.keys(itemvaluearr);
      keys.forEach((val) => {
        let spanVal = parseInt(jQuery(`#${val}`).text())
        let valInObj = parseInt(itemvaluearr[val])
        let subtractedVal = spanVal - valInObj
        jQuery(`#${val}`).text(subtractedVal)
      });
    }
    if (ewcpm_php_vars_cb._mm_template_type == 'grid') {
      jQuery('.gt_box_list').animate({ scrollLeft: 0 }, 200);
    } else {
      if (jQuery(window).width() > 400) {
        jQuery('.gt_box_list').animate({ scrollTop: 0 }, 200);
      } else {
        jQuery('.gt_box_list').animate({ scrollLeft: 0 }, 200);
      }
    }

  });


  function countDuplicates(arr) {
    const counts = {};
    for (let i = 0; i < arr.length; i++) {

      let element = arr[i];
      if (element in counts) {
        counts[element] = counts[element] + 1
      } else {
        counts[element] = 1
      }

    }
    return counts;
  }


  var box = 0;
  colorValue =
    jQuery('body').on('mouseenter', '.extendonsaddnewbox, .add_cta', function (e) {

      colorValue = jQuery(this).find('svg').find('path').attr("fill");
      jQuery(this).find('svg').find("path").attr("fill", "#fff");


    })
  jQuery('body').on('mouseleave', '.extendonsaddnewbox, .add_cta', function (e) {

    p_color = jQuery('.gt_bx_rt').attr("color_val")
    jQuery(this).find('svg').find("path").attr("fill", p_color);

  })

  jQuery('body').on('click', '.extendonsaddnewbox', function (e) {
    e.preventDefault();
    box++;
    let path = jQuery('.gt_box_list').attr("ph_src");
    let img_src = path;

    p_color = jQuery('.gt_bx_rt').attr("color_val")
    svg_delete = `<?xml version="1.0" encoding="utf-8"?>
				<svg width="16px" height="16px" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
				<g fill="none" fill-rule="evenodd" stroke=`+ p_color + ` stroke-linecap="round" stroke-linejoin="round" transform="translate(2 2)">
				<circle cx="8.5" cy="8.5" r="8"/>
				<g transform="matrix(0 1 -1 0 17 0)">
				<path d="m5.5 11.5 6-6"/>
				<path d="m5.5 5.5 6 6"/>
				</g>
				</g>
				</svg>`;
    // svg_add = `<?xml version="1.0" encoding="iso-8859-1"?>
    // 		 <!-- Generator: Adobe Illustrator 21.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
    // 		 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 50 50" width="16px" height="16px">
    // 		 <line style="fill:none; stroke:`+p_color+`;stroke-width:2;stroke-miterlimit:10;" x1="13" y1="25" x2="37" y2="25"/>
    // 		 <line style="fill:none;stroke:`+p_color+`;stroke-width:2;stroke-miterlimit:10;" x1="25" y1="13" x2="25" y2="37"/>
    // 		 <circle style="fill:none;stroke:`+p_color+`;stroke-width:2;stroke-miterlimit:10;" cx="25" cy="25" r="22"/>
    // 		 </svg>` ;

    svg_add = `<?xml version="1.0" encoding="utf-8"?>
				<!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
				<svg width="16px" height="16px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg">
				<path fill="`+ p_color + `" d="M353 480h320a32 32 0 1 1 0 64H352a32 32 0 0 1 0-64z"/>
				<path fill="`+ p_color + `" d="M480 672V352a32 32 0 1 1 64 0v320a32 32 0 0 1-64 0z"/>
				<path fill="`+ p_color + `" d="M512 896a384 384 0 1 0 0-768 384 384 0 0 0 0 768zm0 64a448 448 0 1 1 0-896 448 448 0 0 1 0 896z"/>
				</svg>`;


    if (ewcpm_php_vars_cb._mm_template_type == 'grid') {


      if (mmPrefilled_enable != 'yes') {
        jQuery('#gift_box_0').find('.add_box').remove();
        jQuery('#gift_box_0').find('.gt_qty').after('<div class="add_box"><a href="#" class="add_box_cta extendonsremovenewboxes">' + svg_delete + ' Remove Box 1</a></div>');
      }
      let boxCount = parseInt(box) + 1;
      jQuery('.gt_box_tab').append('<li data-tab="' + box + '" class="box_tb"><span class="box_tb_list"> Box ' + boxCount + ' <span class="gt_qt"><span>Qty:</span><span class="extendonsfilledboxcount">0</span></span></li>');
      let listbox = '';
      for (var i = 0; i < parseInt(ewcpm_php_vars_cb.boxQty); i++) {
        listbox += '<li class="gift_block active_gift extendons_active_boxes"><div class="img_block"><img src="' + img_src + '" alt=""></div></li>';
      }
      jQuery('.gt_bx_rt').append('<div id="gift_box_' + box + '" data-box-count=' + box + ' class="product_gift_box"><div class="gift_box_top"><div class="gt_box_qty"><span class="label">Box ' + boxCount + ' Quantity</span><div class="gt_qty"><a href="#" class="qty_control minus extenonsboxminus"></a><input type="text" value="1" class="value Boxqty" name="extendons_gt_box_qty' + box + '"><a href="#" class="qty_control plus extenonsboxplus"></a></div></div><div class="add_box"><a href="#" class="add_box_cta extendonsremovenewboxes">' + svg_delete + ' Remove Box ' + boxCount + '</a></div><!-- <div class="reset_gt_box"><a href="#" class="clear_cta">' + svg_delete + ' Clear All Items</a></div> --></div><ul class="gt_box_list">' + listbox + '</ul><div class="gt_item_lmt"><span class="text"><span class="added_item"><span class="extendonsfilledboxcount">0</span>/' + ewcpm_php_vars_cb.boxQty + '</span> Added </span></div><div class="reset_gt_box resp"><a href="#" class="clear_cta">' + svg_delete + ' Clear All Items</a></div></div>');
      arrs[box] = [];
    } else {
      if (mmPrefilled_enable != 'yes') {
        jQuery('#gift_box_0').find('.add_box').remove();
        jQuery('#gift_box_0').find('.gt_box_qty').before('<div class="add_box"><a href="#!" class="add_box_cta extendonsaddnewbox" style=""> ' + svg_add + '&nbsp;Add Box</a><a href="#" class="add_box_cta extendonsremovenewboxes"> ' + svg_delete + 'Remove Box 1</a></div>');
      }
      let boxCount = parseInt(box) + 1;
      jQuery('.gt_box_tab').append('<li data-tab="' + box + '" class="box_tb"><span class="box_tb_list"> Box ' + boxCount + ' <span class="gt_qt"><span class="extendonsfilledboxcount">0</span></span></li>');
      let listbox = '';
      for (var i = 0; i < parseInt(ewcpm_php_vars_cb.boxQty); i++) {
        listbox += '<li class="gift_block active_gift extendons_active_boxes"><div class="img_block"><img src="' + img_src + '" alt=""></div></li>';
      }

      jQuery('.gt_bx_rt').append('<div id="gift_box_' + box + '" data-box-count=' + box + ' class="product_gift_box"> <div class="gift_box_top"><div class="gt_item_lmt"><span class="text"><span class="added_item"><span class="extendonsfilledboxcount">0</span>/' + ewcpm_php_vars_cb.boxQty + ' </span>Added</span></div> <div class="reset_gt_box"><a href="#" class="clear_cta">' + svg_delete + 'Clear All Items</a></div></div><ul class="gt_box_list">' + listbox + '</ul><div class="gt_bottom_row"><div class="add_box"><a href="#!" class="add_box_cta extendonsaddnewbox" style="">' + svg_add + '&nbsp; Add Box</a><a href="#" class="add_box_cta extendonsremovenewboxes"> ' + svg_delete + '&nbsp;Remove Box ' + boxCount + '</a></div><div class="gt_box_qty" style="display:none;"><span class="label">Box ' + boxCount + ' Quantity</span><div class="gt_qty"><a href="#" class="qty_control minus extenonsboxminus"></a><input type="text" value="1" class="value Boxqty" name="extendons_gt_box_qty' + box + '"><a href="#" class="qty_control plus extenonsboxplus"></a></div></div></div></div>');
      arrs[box] = [];
    }

    jQuery('li[data-tab=' + box + ']').click();


  });


  jQuery('body').on('click', '.box_tb', function () {
    var boxTab = jQuery(this).attr('data-tab');
    jQuery(this).addClass('active_tab').siblings().removeClass('active_tab');
    jQuery('#gift_box_' + boxTab).addClass('active_bx_dtl').siblings().removeClass('active_bx_dtl');
    count = jQuery('.active_bx_dtl .extendonsfilledboxcount').text();
    // box = boxTab;
    valid = true;
  });


  // Popup open & Close
  jQuery('body').on('click', '.show_dtl', function () {

    var ajaxurl = ewcpm_php_vars_cb.ajax_url;
    var dataproid = jQuery(this).attr('data-pro-id');
    var itemQty = jQuery(this).parent().parent().find('.addon_qty span').text();


    jQuery.ajax({
      url: ajaxurl,
      type: 'post',
      data: {
        action: 'extendons_pd_addon_popup',
        dataproid: dataproid,
        itemQty: itemQty
      },
      success: function (data) {
        jQuery('.pd_addon_popup').html(data);
        jQuery('.pd_addon_popup').fadeIn('slow');
      }
    });
  });

  jQuery('body').on('click', '.add_on_popup_close img', function () {
    jQuery('.pd_addon_popup').fadeOut('slow');
  });


});


function ext_minicart_fly_to_cart(button, box) {
  setTimeout(function () {
    var cart = box;
    var imgtodrag = button.find("img").eq(0);
    if (imgtodrag) {
      var imgclone = imgtodrag.clone()
        .offset({
          top: imgtodrag.offset().top,
          left: imgtodrag.offset().left
        })
        .css({
          'opacity': '0.7',
          'position': 'absolute',
          'height': '150px',
          'width': '150px',
          'z-index': '100'
        })
        .appendTo(jQuery('body'))
        .animate({
          'top': cart.offset().top + 10,
          'left': cart.offset().left + 10,
          'width': 75,
          'height': 75
        }, 1000, 'easeInOutExpo');

      imgclone.animate({
        'width': 0,
        'height': 0
      }, function () {
        jQuery(this).detach()
      });
    }
  }
    , 100);
}

// Gift box tab js

jQuery('.box_tb').click(function () {
  var boxTab = jQuery(this).attr('data-tab');
  jQuery(this).addClass('active_tab').siblings().removeClass('active_tab');
  jQuery('#gift_box_' + boxTab).addClass('active_bx_dtl').siblings().removeClass('active_bx_dtl');
  count = 0;
})




jQuery(document).ready(function ($) {
  $('.add_cta').on('click', function (e) {
    e.preventDefault();
    var productID = $(this).data('id');
    var qtySelector = '.exqtyval' + productID;
    var currentQty = parseInt($(qtySelector).text(), 10);

    if (isNaN(currentQty)) {
      currentQty = 0;
    }

    $(qtySelector).text(currentQty + 1);
  });

});
