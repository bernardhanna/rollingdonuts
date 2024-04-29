// Btn active class
jQuery(document).ready(function () {
  console.log("Document ready function start");
  if (ewcpm_php_vars_cb._mm_template_type != 'grid') {
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
    subtotal = 'Subtotal';
  }

  if ('perwithbase' == pricingtype || 'fixed' == pricingtype) {
    baseprice = parseFloat(ewcpm_php_vars_cb.parentProductprice);
  } else if ('perwoutbase' == pricingtype) {
    basebrice = baseprice;
  }

  var mmPrefilled_enable = ewcpm_php_vars_cb.mmPrefilled_enable;
  if (mmPrefilled_enable == 'yes') {
    var myArr = ewcpm_php_vars_cb.prefileldArray;
    globaltotal = myArr.reduce((total, curr) => {
      return total + parseFloat(curr['product_price']);
    }, parseFloat(baseprice));

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
    console.log("parsePrice called with", price, currencySymbol);
    var hasCommaAsDecimalSeparator;
    switch (currencySymbol) {
      case '€':
        hasCommaAsDecimalSeparator = true;
        break;
      case '₣':
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

  jQuery('body').on('click', '.add_cta', function (e) {
    console.log(".add_cta clicked");
    e.preventDefault();
    let boxQty = ewcpm_php_vars_cb.boxQty;
    let blockitem = jQuery(this).closest('.pd_add_block_inner').find('.image_block');
    let priceval = jQuery(this).closest('.pd_add_block_inner').find('.price');
    let currencySymbol = priceval.find('.woocommerce-Price-currencySymbol:last').text();
    let originalPriceWithSymbol = priceval.find('.woocommerce-Price-amount.amount:last').text();
    let originalPriceWithoutSymbol = originalPriceWithSymbol.replace(currencySymbol, '');
    originalPriceWithoutSymbol = parsePrice(originalPriceWithoutSymbol, currencySymbol);
    if (blockitem.length === 0) {
      console.error('Block item not found');
      return;
    }

    // Before accessing offset, check if the element is valid
    let itemOffset = jQuery('.someElement').offset();
    if (itemOffset) {
      console.log(itemOffset.left, itemOffset.top);
    } else {
      console.error('Element for offset calculation not found');
    }

    let thumbnailsrc = blockitem.find('img').attr('src');
    if (!thumbnailsrc) {
      console.error('Thumbnail source not found');
      return;
    }
    let itemid = jQuery(this).attr('data-id');
    let this_prod_quantity = parseInt(jQuery('.exqtyval' + itemid).text());

    this_prod_quantity++;

    if ('yes' === mmProdLimitEnable && this_prod_quantity > mmProdLimitQuantity) {
      jQuery('.product_box_container').before('<div class="extendonsboxfillederrormsg ext-limit-msg woocommerce-message exterrormsg"><p>You cannot purchase more than ' + mmProdLimitQuantity + ' of the same product.</p></div>');
      jQuery('.ext-limit-msg').delay(3000).fadeOut('slow');
      valid = false;
      jQuery('html, body').scrollTop(0);
      return false;
    }

    if (boxQty == count) {
      jQuery('.extendonsboxfillederrormsg').remove();
      jQuery('.product_box_container').before('<div class="extendonsboxfillederrormsg woocommerce-message extsuccessmsg"><p>' + ewcpm_php_vars_cb.boxsuccessmessage + '</p></div>');
      jQuery('.extendonsboxfillederrormsg').delay(3000).fadeOut('slow');
      jQuery('.extendonssingleaddtocart').prop('disabled', false);
      valid = false;
      return false;
    } else {
      valid = true;
      if (itemid in stockQtyinfo && stockQtyinfo[itemid] == 0) {
        jQuery('.extendonsboxfillederrormsg').remove();
        jQuery('.product_box_container').before('<div class="extendonsboxfillederrormsg woocommerce-message exterrormsg"><p> You cannot add more product stock is less </p></div>');
        jQuery('.extendonsboxfillederrormsg').delay(3000).fadeOut('slow');
        return false;
      }
      stockQtyinfo[itemid]--;
      count++;
      if (partialyAllow == 'yes' && count == minboxqty) {
        jQuery('.extendonssingleaddtocart').prop('disabled', false);
      } else if (boxQty == count) {
        jQuery('.extendonssingleaddtocart').prop('disabled', false);
      }
      jQuery('.active_tab .extendonsfilledboxcount').text(count);
      jQuery('.active_bx_dtl .extendonsfilledboxcount').text(count);
      let itemqty = parseInt(jQuery(this).parent().parent().find('.addon_qty span').text());
      itemqty++;
      jQuery(this).parent().parent().find('.addon_qty span').text(itemqty);

      ext_minicart_fly_to_cart(blockitem, acivelistitem);
      if ('fixed' == pricingtype) {
        globaltotal = parseFloat(ewcpm_php_vars_cb.parentProductprice);
      } else {
        globaltotal = parseFloat(globaltotal);
      }

      if (typeof (globaltotal) == 'undefined' || Number.isNaN(globaltotal) || globaltotal == NaN || globaltotal == undefined) {
        globaltotal = 0;
      }
      var color_val = jQuery('.gt_bx_rt').attr('color_val');
      var circled_x = `<?xml version="1.0" encoding="utf-8"?>
                    <svg data-id="` + itemid + `" class="extendonsremovefilledboxes ` + itemid + `" width="24px" height="24px" viewBox="0 0 21 21" xmlns="http://www.w3.org/2000/svg">
                    <g fill="none" fill-rule="evenodd" stroke="` + color_val + `" stroke-linecap="round" stroke-linejoin="round" transform="translate(2 2)">
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



      originalPriceWithoutSymbol = parseFloat(originalPriceWithoutSymbol) * parseFloat(qtyperbox);
      globaltotal = parseFloat(globaltotal) + parseFloat(originalPriceWithoutSymbol);
      globaltotal = globaltotal.toFixed(2);
    }

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

  jQuery('body').on('click', '.extendonsfilledboxesremove', function (e) {
    console.log(".extendonsfilledboxesremove clicked");
    e.preventDefault();
    var id = jQuery(this).attr('data-id');
    var boxes = jQuery('.active_bx_dtl').find('.' + id);
    if (boxes.size() == 0) {
      return false;
    }
    var prefilled_find_class = jQuery('.active_bx_dtl').find('.' + id).last();
    if (prefilled_find_class != undefined && jQuery(prefilled_find_class).closest("li").hasClass("prefilleditem")) {
      return false; // Prevent removal if the item is prefilled
    };

    jQuery('.active_bx_dtl').find('.' + id).last().click();
  });

  jQuery('.extendonssingleaddtocart').on('click', function (e) {
    console.log(".extendonssingleaddtocart clicked");
    if (pricingtype == 'fixed') {
      jQuery('#mmperItemPrice').val(baseprice);
    } else {
      jQuery('#mmperItemPrice').val(globaltotal);
    }
  });

  jQuery('body').on('click', '.extenonsboxplus', function (e) {
    console.log(".extenonsboxplus clicked");
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

    globaltotal = parseFloat(globaltotal) + parseFloat(boxtotal);
    if ('fixed' != pricingtype) {
      jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + ewcpm_php_vars_cb.currencysymbol + '</span>' + globaltotal + '</bdi></span>');
    }
    jQuery(this).parent().find('.Boxqty').val(Qtyval);
  });

  jQuery('body').on('click', '.extenonsboxminus', function (e) {
    console.log(".extenonsboxminus clicked");
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

    ///START HERE
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

    console.log(boxtotal);

    // Update the value of globaltotal by adding the value of boxtotal to it after converting both to floating point numbers
    console.log("Previous globaltotal:", globaltotal);
    console.log("Previous boxtotal:", boxtotal);
    globaltotal = parseFloat(globaltotal) + parseFloat(boxtotal);
    console.log("Updated globaltotal:", globaltotal);

    // Check if the pricing type is not 'fixed'
    if ('fixed' != pricingtype) {
      // Update the HTML content of elements with class 'extendssubtotalboxes' to display the subtotal followed by the updated globaltotal
      console.log("Updating extendssubtotalboxes HTML content...");
      console.log("Subtotal:", subtotal);
      console.log("Currency symbol:", ewcpm_php_vars_cb.currencysymbol);
      console.log("Updated globaltotal:", globaltotal);
      jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + ewcpm_php_vars_cb.currencysymbol + '</span>' + globaltotal + '</bdi></span>');
    }

    // Update the value of an input element with class 'Boxqty' which is a sibling of the current element in the loop
    console.log("Updating input element with class 'Boxqty'...");
    jQuery(this).parent().find('.Boxqty').val(Qtyval);
  });

  // Attach a click event handler to elements with class 'extenonsboxminus' within the body
  jQuery('body').on('click', '.extenonsboxminus', function (e) {
    // Prevent the default action of the click event (e.g., navigating to a new page)
    e.preventDefault();

    // Find the value of the input element with class 'Boxqty' that is a sibling of the clicked element
    var Qtyval = jQuery(this).parent().find('.Boxqty').val();
    console.log("Current Qtyval:", Qtyval);
    // If the quantity value is already 1, return without doing anything
    if (Qtyval == 1) {
      console.log("Quantity value is already 1. Returning without doing anything.");
      return false;
    }

    // Decrease the quantity value by 1
    Qtyval = parseInt(Qtyval) - parseInt(1);
    console.log("Decreased Qtyval:", Qtyval);
    // Declare variables for storing item details
    var acivelistitem;
    var currencySymbol;
    var originalPriceWithSymbol;
    var originalPriceWithoutSymbol;

    // Initialize the variable boxtotal to 0
    var boxtotal = 0;

    // Iterate over each list item within elements with class 'gt_box_list' that have class 'active_bx_dtl'
    jQuery('.active_bx_dtl .gt_box_list li').each(function (index, value) {
      // Check if the current list item has class 'extendonsfilleditem'
      if (jQuery(this).hasClass('extendonsfilleditem')) {
        // Store a reference to the current list item
        acivelistitem = jQuery(this);

        // Find the currency symbol within the current list item
        currencySymbol = acivelistitem.find('.woocommerce-Price-currencySymbol').text();
        console.log("Currency Symbol:", currencySymbol);
        // Find the original price with symbol within the current list item
        originalPriceWithSymbol = acivelistitem.find('.woocommerce-Price-amount.amount').text();
        console.log("Original Price with Symbol:", originalPriceWithSymbol);
        // Remove the currency symbol from the original price
        originalPriceWithoutSymbol = originalPriceWithSymbol.replace(currencySymbol, '');
        console.log("Original Price without Symbol:", originalPriceWithoutSymbol);
        // Convert the original price without symbol to a floating point number and add it to boxtotal
        boxtotal += parseFloat(originalPriceWithoutSymbol);
        console.log("Updated boxtotal:", boxtotal);
      }
    });

    // Subtract the boxtotal from the globaltotal
    globaltotal = parseFloat(globaltotal) - parseFloat(boxtotal);
    console.log("Updated globaltotal after subtracting boxtotal:", globaltotal);
    // If the pricing type is not 'fixed'
    if ('fixed' != pricingtype) {
      // Update the HTML content of elements with class 'extendssubtotalboxes' to display the subtotal followed by the updated globaltotal
      console.log("Updating extendssubtotalboxes HTML content...");
      console.log("Subtotal:", subtotal);
      console.log("Currency symbol:", ewcpm_php_vars_cb.currencysymbol);
      console.log("Updated globaltotal:", globaltotal);
      jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + ewcpm_php_vars_cb.currencysymbol + '</span>' + globaltotal + '</bdi></span>');
    }

    // Update the value of an input element with class 'Boxqty' which is a sibling of the current element in the loop
    jQuery(this).parent().find('.Boxqty').val(Qtyval);
    console.log("Updated input element with class 'Boxqty' value:", Qtyval);
  });


  jQuery('body').on('click', '.extendonsremovenewboxes', function (e) {
    // Prevent the default action of the click event (e.g., navigating to a new page)
    e.preventDefault();

    // Declare variables
    let currentactive;
    let currentactivebox;
    let deletetab;
    let listtabcount = 1;
    var boxremovearrayindex;
    var Qtyspan;

    // Determine Qtyspan based on the _mm_template_type
    if (ewcpm_php_vars_cb._mm_template_type == 'grid') {
      Qtyspan = '<span>Qty:</span>';
    } else {
      Qtyspan = '';
    }

    // Retrieve color value
    var color_val = jQuery('.gt_bx_rt').attr('color_val');

    // Define SVG delete icon markup
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

    // Iterate over each list item within elements with class 'gt_box_tab'
    jQuery('.gt_box_tab li').each(function () {

      // Check if the current list item has class 'active_tab'
      if (jQuery(this).hasClass('active_tab')) {
        // Store the index of the current list item and remove it
        boxremovearrayindex = jQuery(this).index();
        jQuery(this).remove();
      }

      // Check if the current list item does not have class 'active_tab'
      if (!jQuery(this).hasClass('active_tab')) {
        // Store a reference to the current list item
        currentactive = jQuery(this);

        // Update the HTML content of elements within the current list item to display the box number and quantity
        jQuery(currentactive).find('.box_tb_list').html('Box ' + listtabcount + ' <span class="gt_qt">' + Qtyspan + '<span class="extendonsfilledboxcount"></span></span>');

        // Update the 'data-tab' attribute of the current list item
        jQuery(currentactive).attr('data-tab', parseInt(listtabcount) - parseInt(1));

        // Update the box number
        box = listtabcount;

        // Increment the tab count
        listtabcount++;
      }
    });

    // Reset boxCount variable
    boxCount = 0;

    // Iterate over elements with class 'product_gift_box'
    jQuery('.product_gift_box').each(function () {

      // Check if the current element has class 'active_bx_dtl'
      if (jQuery(this).hasClass('active_bx_dtl')) {
        // Trigger a click event on the element with class 'clear_cta' within the current element
        jQuery(this).find('.clear_cta').click();

        // Remove the current element
        jQuery(this).remove();

        // Remove an item from the arrs array based on the value of 'data-box-count' attribute
        arrs.splice(jQuery(this).attr('data-box-count'), 1);

        // Check if the 'data-box-count' attribute of the current element is '0'
        if (jQuery(this).attr('data-box-count') == '0') {
          // Remove the '.add_box' element
          // jQuery(currentactivebox).find('.add_box').remove();
        }
      }

      // Check if the current element does not have class 'active_bx_dtl'
      if (!jQuery(this).hasClass('active_bx_dtl')) {
        // Store a reference to the current element
        currentactivebox = jQuery(this);

        // Find the quantity value of items within the current element
        var Qtyvalbox = jQuery(currentactivebox).find('.extendonsfilleditem').length;

        // Update the text content of elements with class 'extendonsfilledboxcount' within elements with 'data-tab' attribute
        jQuery('[data-tab="' + boxCount + '"]').find('.extendonsfilledboxcount').text(Qtyvalbox);

        // Check if the current element contains items with class 'extendonsfilleditem'
        if (jQuery(currentactivebox).find('.gift_block').hasClass('extendonsfilleditem')) {
          // Count the number of items with class 'extendonsfilleditem'
          count = jQuery(currentactivebox).find('.extendonsfilleditem').length;

          // Hide elements with class 'extendonsaddnewbox' if the count does not match ewcpm_php_vars_cb.boxQty
          if (count != ewcpm_php_vars_cb.boxQty) {
            jQuery('.extendonsaddnewbox').hide();
            jQuery('.extendonsaddnewbox').hide();
          }
        }

        // Update attributes and text content of elements within the current element
        jQuery(currentactivebox).attr('data-box-count', parseInt(boxCount));
        jQuery(currentactivebox).attr('id', 'gift_box_' + boxCount);
        let aciveboxnu = parseInt(boxCount) + parseInt(1);
        jQuery(currentactivebox).find('.gt_box_qty .label').text('Box ' + aciveboxnu + ' Quantity');
        jQuery(currentactivebox).find('.extendonsremovenewboxes').html(svg_delete + 'Remove Box ' + aciveboxnu);
        // jQuery(currentactivebox).find('.extendonsremovenewboxes').text('Removes Box '+ aciveboxnu);

        // Increment boxCount
        boxCount++;
      }
    });

    // Check if the index of the current active box is 0
    if (currentactivebox.index() == 0) {
      // Remove elements with class 'extendonsremovenewboxes'
      jQuery('.extendonsremovenewboxes').remove();
    }

    // Decrement box
    box--;
    // Remove an item from the arrs array based on the value of boxremovearrayindex
    arrs.splice(boxremovearrayindex, 1);
    // Update the value of element with id 'mm_product_items'
    jQuery('#mm_product_items').val(JSON.stringify(arrs));
    // Add class 'active_tab' to currentactive
    jQuery(currentactive).addClass('active_tab');
    // Add class 'active_bx_dtl' to currentactivebox
    jQuery(currentactivebox).addClass('active_bx_dtl');
    // Find the quantity value of items within currentactivebox and update count variable
    count = jQuery(currentactivebox).find('.extendonsfilleditem').length;
  });

  jQuery('body').on('mouseenter', '.extendonsremovenewboxes', function () {
    // Log a message to the console indicating that the element is being hovered over
    console.log('hovered')

    // Store the original stroke color of the SVG icon
    org_color = jQuery(this).find('svg').find('g').attr("stroke");

    // Change the stroke color of the SVG icon to white
    jQuery(this).find('svg').find('g').attr("stroke", "#fff");
  })


  // Attach a mouseleave event handler to elements with class 'extendonsremovenewboxes' within the body
  jQuery('body').on('mouseleave', '.extendonsremovenewboxes', function () {
    // Log a message to the console indicating that the mouse has left the element
    console.log('hovered')

    // Restore the original stroke color of the SVG icon
    jQuery(this).find('svg').find('g').attr("stroke", org_color);
  })

  jQuery('body').on('click', '.extendonsremovefilledboxes', function (e) {
    // Log a message to the console indicating that the element is being clicked
    console.log('clicked')
    // Prevent the default action of the click event (e.g., navigating to a new page)
    e.preventDefault();

    // Retrieve the value of the 'data-id' attribute from the clicked element
    let removeitemid = jQuery(this).attr('data-id');

    // Iterate over elements with class 'addon_qty'
    jQuery('.addon_qty').each(function () {
      // Retrieve the value of the 'data-id' attribute from the current element
      var loopproid = jQuery(this).find('.add_cta').attr('data-id');

      // Check if the 'data-id' attribute of the current element matches removeitemid
      if (removeitemid == loopproid) {
        // Retrieve the text content of the element with class 'extendonsqtytext' and parse it as an integer
        var qtyval = jQuery(this).find('.extendonsqtytext').text();
        qtyval = parseInt(qtyval) - parseInt(1);

        // Update the text content of the element with class 'extendonsqtytext'
        jQuery(this).find('.extendonsqtytext').text(qtyval);

        // Update the text content of elements with class 'popupqty' + removeitemid
        jQuery('.popupqty' + removeitemid).text(qtyval);

        // Exit the loop
        return false;
      }

    });

    // Find the closest ancestor element with class 'gift_block' relative to the current element
    let filledelementitem = jQuery(this).closest('.gift_block');

    // Retrieve the value of the 'data-box-count' attribute from the closest ancestor element with class 'gift_block'
    let checkboxcounter = jQuery(this).closest('.gift_block').parent().parent().attr('data-box-count');

    // Get the index of the 'filledelementitem' within its parent
    let removearrindex = filledelementitem.index();

    // Calculate the index for the 'arrs' array
    let removemultiarrayindex = parseInt(box) - parseInt(1);

    // Remove the item from the 'arrs' array at the calculated index
    arrs[box].splice(removearrindex, 1);

    // Update the value of element with id 'mm_product_items' with the updated 'arrs' array
    jQuery('#mm_product_items').val(JSON.stringify(arrs));

    // Retrieve the price of the removed item
    let removeitemprice = jQuery(filledelementitem).find('.overlay_inner .price').text();

    // Retrieve the currency symbol
    let currencySymbol = ewcpm_php_vars_cb.currencysymbol;

    // Remove the currency symbol from the price
    removeitemprice = removeitemprice.replace(currencySymbol, '');

    // Calculate the total price of the removed item considering the quantity per box
    var qtyperbox = jQuery('#gift_box_' + box).find('.Boxqty').val();
    removeitemprice = parseFloat(removeitemprice) * parseFloat(qtyperbox);

    // Update the global total by subtracting the price of the removed item
    globaltotal = parseFloat(globaltotal) - parseFloat(removeitemprice);

    // Ensure the global total has two decimal places
    globaltotal = globaltotal.toFixed(2)

    // If the pricing type is not 'fixed', update the HTML content of elements with class 'extendssubtotalboxes' to display the subtotal followed by the updated global total
    if ('fixed' != pricingtype) {
      jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + currencySymbol + '</span>' + globaltotal + '</bdi></span>');
    }

    // Retrieve the value of the 'ph_src' attribute from elements with class 'gt_box_list'
    let path = jQuery('.gt_box_list').attr("ph_src");

    // If 'path' is empty or undefined, retrieve the value of the 'ph_src' attribute from elements with class 'add_box'
    if (path == '' || path == undefined) {
      path = jQuery('.add_box').attr("ph_src");
    }

    // Store the image source
    let img_src = path;

    // Add class 'extendons_active_boxes' to 'filledelementitem' and remove class 'extendonsfilleditem'
    jQuery(filledelementitem).addClass('extendons_active_boxes');
    jQuery(filledelementitem).removeClass('extendonsfilleditem');

    // Update the image source and remove certain elements within 'filledelementitem'
    jQuery(filledelementitem).find('.img_block img').attr('src', img_src);
    jQuery(filledelementitem).find('.dlt_icon').remove();
    jQuery(filledelementitem).find('.gt_overlay').remove();

    // Set 'valid' variable to true if 'removeitemid' exists in 'stockQtyinfo'
    if (removeitemid in stockQtyinfo) {
      stockQtyinfo[removeitemid] = stockQtyinfo[removeitemid] + 1;
    }

    // Update the count variable
    count = jQuery('.active_bx_dtl .extendonsfilledboxcount').first().text();
    count--;

    // Disable the 'extendonssingleaddtocart' button if certain conditions are met
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

    // Update the text content of elements with class 'extendonsfilledboxcount'
    jQuery('.active_tab .extendonsfilledboxcount').text(count);
    jQuery('.active_bx_dtl .extendonsfilledboxcount').text(count);

    // Remove elements with class 'extendonsboxfillederrormsg'
    jQuery('.extendonsboxfillederrormsg').remove();
  });


  // Define a function called removeByValue that takes an array and a value to remove as parameters
  function removeByValue(array, value) {
    // Use the filter method to create a new array containing only the elements that do not match the specified value
    // The filter method takes a callback function as an argument, which is executed for each element in the array
    // The callback function receives the current element (elem) and its index (_index) as parameters
    return array.filter(function (elem, _index) {
      // Compare the current element to the specified value using strict inequality (value.toString() != elem.toString())
      // Convert both the value and the element to strings before comparison to ensure type safety
      // If the current element does not match the specified value, it is included in the filtered array
      return value.toString() != elem.toString();
    });
  }

  // Attach a click event handler to elements with class 'clear_cta' within the body
  jQuery('body').on('click', '.clear_cta', function (e) {
    // Prevent the default action of the click event (e.g., navigating to a new page)
    e.preventDefault();

    // Initialize variables
    var boxarray = [];
    var curRectboxprice = 0;

    // Retrieve the quantity per box from the element with id 'gift_box_' + box
    var qtyperbox = jQuery('#gift_box_' + box).find('.Boxqty').val();

    // Initialize activecount variable
    var activecount = 0;

    // Retrieve the value of the 'ph_src' attribute from elements with class 'gt_box_list'
    let path = jQuery('.gt_box_list').attr("ph_src");

    // If 'path' is empty or undefined, retrieve the value of the 'ph_src' attribute from elements with class 'add_box'
    if (path == '' || path == undefined) {
      path = jQuery('.add_box').attr("ph_src");
    }

    // Store the image source
    let img_src = path;

    // Iterate over elements with class 'gift_block' within elements with class 'active_bx_dtl'
    jQuery('.active_bx_dtl .gift_block').each(function (index) {

      // Check if the current element has class 'extendonsfilleditem' and does not have class 'prefilleditem'
      if (jQuery(this).hasClass('extendonsfilleditem') && !jQuery(this).hasClass('prefilleditem')) {

        // Store a reference to the current filled element item
        var filledelementitem = jQuery(this);

        // Retrieve the value of the 'data-box-count' attribute from the parent elements
        var boxremovearrayindex = jQuery(filledelementitem).parent().parent().attr('data-box-count');

        // Disable the 'extendonssingleaddtocart' button if the boxremovearrayindex is 0
        if (boxremovearrayindex == 0) {
          jQuery('.extendonssingleaddtocart').prop('disabled', true);
        }

        // Retrieve the price of the filled element item
        let removeitemprice = jQuery(filledelementitem).find('.overlay_inner .price').text();

        // Retrieve the currency symbol
        let currencySymbol = ewcpm_php_vars_cb.currencysymbol;

        // Remove the currency symbol from the price
        removeitemprice = removeitemprice.replace(currencySymbol, '');

        // Remove the item from the 'arrs' array at the calculated index
        arrs.splice(boxremovearrayindex, 1);

        // Update the value of element with id 'mm_product_items' with the updated 'arrs' array
        jQuery('#mm_product_items').val(JSON.stringify(arrs));

        // Reset the 'arrs' array at the calculated index to an empty array
        arrs[boxremovearrayindex] = [];

        // Increment the stock quantity of the removed item
        let filledbox = jQuery(filledelementitem).find('.extendonsremovefilledboxes').attr('data-id');
        if (filledbox in stockQtyinfo) {
          stockQtyinfo[filledbox] = stockQtyinfo[filledbox] + 1;
        }

        // Add class 'extendons_active_boxes' to 'filledelementitem' and remove class 'extendonsfilleditem'
        jQuery(filledelementitem).addClass('extendons_active_boxes');
        jQuery(filledelementitem).removeClass('extendonsfilleditem');

        // Push the filled box id to the 'boxarray'
        boxarray.push(filledbox);

        // Update the image source and remove certain elements within 'filledelementitem'
        jQuery(filledelementitem).find('.img_block img').attr('src', img_src);
        jQuery(filledelementitem).find('.dlt_icon').remove();
        jQuery(filledelementitem).find('.gt_overlay').remove();

        // Increment count variable and add removeitemprice to curRectboxprice
        count = 0;
        curRectboxprice = parseFloat(curRectboxprice) + parseFloat(removeitemprice);
      }

      // Show elements with class 'extendonsaddnewbox' after a delay of 100 milliseconds
      setTimeout(function () {
        jQuery('.extendonsaddnewbox').show();
      }, 100)

    });


    // Calculate the total price of the current box by multiplying curRectboxprice by qtyperbox
    curRectboxprice = parseFloat(curRectboxprice) * qtyperbox;

    // Subtract curRectboxprice from globaltotal
    globaltotal = parseFloat(globaltotal) - parseFloat(curRectboxprice);

    // Ensure globaltotal has two decimal places
    globaltotal = globaltotal.toFixed(2)

    // Set the value of the input field with id 'gift_box_' + box to 1
    jQuery('#gift_box_' + box).find('.Boxqty').val(1);

    // If mmPrefilled_enable is 'yes', handle prefilled items
    if (mmPrefilled_enable == 'yes') {
      var prefilledindex = 0;
      // Iterate over elements with class 'gift_block' within elements with class 'active_bx_dtl'
      jQuery('.active_bx_dtl .gift_block').each(function (index) {

        // Check if the current element has class 'extendonsfilleditem' and 'prefilleditem'
        if (jQuery(this).hasClass('extendonsfilleditem') && jQuery(this).hasClass('prefilleditem')) {

          // Store the index of the prefilled item
          var indexelement = prefilledindex;

          // Retrieve the value of the 'data-box-count' attribute from the parent elements
          var boxarrayindex = jQuery(this).parent().parent().attr('data-box-count');

          // Retrieve the data-id attribute from elements with class 'extendonsremovefilledboxes'
          var prefilled = jQuery(this).find('.extendonsremovefilledboxes').attr('data-id');

          // Update the 'arrs' array with the prefilled item
          arrs[boxarrayindex][indexelement] = prefilled;

          // Update the value of element with id 'mm_product_items' with the updated 'arrs' array
          jQuery('#mm_product_items').val(JSON.stringify(arrs));

          // Update the count variable with the number of elements with class 'prefilleditem'
          count = jQuery('.prefilleditem').length;

          // Increment prefilledindex
          prefilledindex++;
        }
      });
    }


    // Update the text content of elements with class 'extendonsfilledboxcount' in elements with class 'active_bx_dtl' with the value of 'count'
    jQuery('.active_bx_dtl .extendonsfilledboxcount').text(count);

    // Update the text content of elements with class 'extendonsfilledboxcount' in elements with class 'active_tab' with the value of 'count'
    jQuery('.active_tab .extendonsfilledboxcount').text(count);

    // Remove elements with class 'extendonsboxfillederrormsg' from elements with class 'active_bx_dtl'
    jQuery('.active_bx_dtl .extendonsboxfillederrormsg').remove();

    // If add_new_box_quantity is 'yes', hide elements with class 'extendonsaddnewbox' within elements with class 'active_bx_dtl'
    if (ewcpm_php_vars_cb.add_new_box_quantity == 'yes') {
      jQuery('.active_bx_dtl .extendonsaddnewbox').hide();
    }

    // If pricingtype is not 'fixed', update the HTML content of elements with class 'extendssubtotalboxes' with the subtotal and globaltotal
    if ('fixed' != pricingtype) {
      jQuery('.extendssubtotalboxes').html('' + subtotal + ': <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol">' + ewcpm_php_vars_cb.currencysymbol + '</span>' + globaltotal + '</bdi></span>');
    }

    // Count the duplicates in the boxarray and subtract their count from the corresponding elements
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

    // Scroll to the beginning of the gt_box_list element based on the _mm_template_type and window width
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


  // Define a function named countDuplicates that takes an array (arr) as input
  function countDuplicates(arr) {
    // Initialize an empty object to store the counts of each element
    const counts = {};

    // Iterate over each element in the input array
    for (let i = 0; i < arr.length; i++) {
      // Retrieve the current element from the array
      let element = arr[i];

      // Check if the current element already exists in the 'counts' object
      if (element in counts) {
        // If the element exists, increment its count by 1
        counts[element] = counts[element] + 1;
      } else {
        // If the element doesn't exist, set its count to 1
        counts[element] = 1;
      }
    }
    console.log(`Element: ${element}, Count: ${counts[element]}`);
    // Return the 'counts' object containing the counts of each unique element in the array
    return counts;
  }


  // Initialize the variable 'box' to 0
  var box = 0;

  // Attach mouseenter event handler to elements with class 'extendonsaddnewbox' and 'add_cta' within the body
  colorValue =
    jQuery('body').on('mouseenter', '.extendonsaddnewbox, .add_cta', function (e) {
      // Retrieve the current color value of the element's SVG path
      colorValue = jQuery(this).find('svg').find('path').attr("fill");

      // Change the color of the SVG path to white (#fff)
      jQuery(this).find('svg').find("path").attr("fill", "#fff");
    })

  // Attach mouseleave event handler to elements with class 'extendonsaddnewbox' and 'add_cta' within the body
  jQuery('body').on('mouseleave', '.extendonsaddnewbox, .add_cta', function (e) {
    // Retrieve the color value from an element with class 'gt_bx_rt' and attribute 'color_val'
    p_color = jQuery('.gt_bx_rt').attr("color_val")

    // Restore the color of the SVG path to the original color retrieved from 'p_color'
    jQuery(this).find('svg').find("path").attr("fill", p_color);
  })

  // Attach click event handler to elements with class 'extendonsaddnewbox' within the body
  jQuery('body').on('click', '.extendonsaddnewbox', function (e) {
    // Prevent the default action of the click event (e.g., navigating to a new page)
    e.preventDefault();

    // Increment the value of 'box' by 1
    box++;

    // Retrieve the value of the 'ph_src' attribute from elements with class 'gt_box_list'
    let path = jQuery('.gt_box_list').attr("ph_src");

    // Store the image source
    let img_src = path;

    p_color = jQuery('.gt_bx_rt').attr("color_val")

    if (ewcpm_php_vars_cb._mm_template_type == 'grid') {
      console.log("Template type is 'grid'");

      if (mmPrefilled_enable != 'yes') {
        console.log("Prefilled is not enabled");
        jQuery('#gift_box_0').find('.add_box').remove();
        jQuery('#gift_box_0').find('.gt_qty').after('<div class="add_box"><a href="#" class="add_box_cta extendonsremovenewboxes">' + svg_delete + ' Remove Box 1</a></div>');
      }

      let boxCount = parseInt(box) + 1;
      console.log("Box count:", boxCount);
      jQuery('.gt_box_tab').append('<li data-tab="' + box + '" class="box_tb"><span class="box_tb_list"> Box ' + boxCount + ' <span class="gt_qt"><span>Qty:</span><span class="extendonsfilledboxcount">0</span></span></li>');

      let listbox = '';
      for (var i = 0; i < parseInt(ewcpm_php_vars_cb.boxQty); i++) {
        listbox += '<li class="gift_block active_gift extendons_active_boxes"><div class="img_block"><img src="' + img_src + '" alt=""></div></li>';
      }
      console.log("Listbox:", listbox);

      jQuery('.gt_bx_rt').append('<div id="gift_box_' + box + '" data-box-count=' + box + ' class="product_gift_box"><div class="gift_box_top"><div class="gt_box_qty"><span class="label">Box ' + boxCount + ' Quantity</span><div class="gt_qty"><a href="#" class="qty_control minus extenonsboxminus"></a><input type="text" value="1" class="value Boxqty" name="extendons_gt_box_qty' + box + '"><a href="#" class="qty_control plus extenonsboxplus"></a></div></div><div class="add_box"><a href="#" class="add_box_cta extendonsremovenewboxes">' + svg_delete + ' Remove Box ' + boxCount + '</a></div><!-- <div class="reset_gt_box"><a href="#" class="clear_cta">' + svg_delete + ' Clear All Items</a></div> --></div><ul class="gt_box_list">' + listbox + '</ul><div class="gt_item_lmt"><span class="text"><span class="added_item"><span class="extendonsfilledboxcount">0</span>/' + ewcpm_php_vars_cb.boxQty + '</span> Added </span></div><div class="reset_gt_box resp"><a href="#" class="clear_cta">' + svg_delete + ' Clear All Items</a></div></div>');
      arrs[box] = [];
    } else {
      console.log("Template type is not 'grid'");

      if (mmPrefilled_enable != 'yes') {
        console.log("Prefilled is not enabled");
        jQuery('#gift_box_0').find('.add_box').remove();
        jQuery('#gift_box_0').find('.gt_box_qty').before('<div class="add_box"><a href="#!" class="add_box_cta extendonsaddnewbox" style=""> ' + svg_add + '&nbsp;Add Box</a><a href="#" class="add_box_cta extendonsremovenewboxes"> ' + svg_delete + 'Remove Box 1</a></div>');
      }

      let boxCount = parseInt(box) + 1;
      console.log("Box count:", boxCount);
      jQuery('.gt_box_tab').append('<li data-tab="' + box + '" class="box_tb"><span class="box_tb_list"> Box ' + boxCount + ' <span class="gt_qt"><span class="extendonsfilledboxcount">0</span></span></li>');

      let listbox = '';
      for (var i = 0; i < parseInt(ewcpm_php_vars_cb.boxQty); i++) {
        listbox += '<li class="gift_block active_gift extendons_active_boxes"><div class="img_block"><img src="' + img_src + '" alt=""></div></li>';
      }
      console.log("Listbox:", listbox);

      jQuery('.gt_bx_rt').append('<div id="gift_box_' + box + '" data-box-count=' + box + ' class="product_gift_box"> <div class="gift_box_top"><div class="gt_item_lmt"><span class="text"><span class="added_item"><span class="extendonsfilledboxcount">0</span>/' + ewcpm_php_vars_cb.boxQty + ' </span>Added</span></div> <div class="reset_gt_box"><a href="#" class="clear_cta">' + svg_delete + 'Clear All Items</a></div></div><ul class="gt_box_list">' + listbox + '</ul><div class="gt_bottom_row"><div class="add_box"><a href="#!" class="add_box_cta extendonsaddnewbox" style="">' + svg_add + '&nbsp; Add Box</a><a href="#" class="add_box_cta extendonsremovenewboxes"> ' + svg_delete + '&nbsp;Remove Box ' + boxCount + '</a></div><div class="gt_box_qty" style="display:none;"><span class="label">Box ' + boxCount + ' Quantity</span><div class="gt_qty"><a href="#" class="qty_control minus extenonsboxminus"></a><input type="text" value="1" class="value Boxqty" name="extendons_gt_box_qty' + box + '"><a href="#" class="qty_control plus extenonsboxplus"></a></div></div></div></div>');
      arrs[box] = [];
    }

    console.log("Clicked on box:", box);

    jQuery('li[data-tab=' + box + ']').click();
  });



  jQuery('body').on('click', '.box_tb', function () {
    var boxTab = jQuery(this).attr('data-tab');
    jQuery(this).addClass('active_tab').siblings().removeClass('active_tab');
    jQuery('#gift_box_' + boxTab).addClass('active_bx_dtl').siblings().removeClass('active_bx_dtl');
    count = jQuery('.active_bx_dtl .extendonsfilledboxcount').text();
    // box = boxTab;
    valid = true;
    console.log("Clicked on box tab:", boxTab);
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
    console.log("Closed popup");
  });


});

function ext_minicart_fly_to_cart(button, box) {
  console.log("Executing ext_minicart_fly_to_cart function with box:", box);
  setTimeout(function () {
    var cart = box;
    console.log("Cart:", cart);
    var imgtodrag = button.find("img").eq(0);
    if (imgtodrag) {
      console.log("Image to drag:", imgtodrag);
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
        jQuery(this).detach();
        console.log("Image clone detached");
      });
    }
  }, 100);
}
// Gift box tab js
jQuery('.box_tb').click(function () {
  console.log("Box tab clicked");
  var boxTab = jQuery(this).attr('data-tab');
  console.log("Box tab:", boxTab);
  jQuery(this).addClass('active_tab').siblings().removeClass('active_tab');
  jQuery('#gift_box_' + boxTab).addClass('active_bx_dtl').siblings().removeClass('active_bx_dtl');
  count = 0;
});

jQuery(document).ready(function ($) {
  $('.add_cta').on('click', function (e) {
    e.preventDefault();
    console.log("Add button clicked");
    var productID = $(this).data('id');
    console.log("Product ID:", productID);
    var qtySelector = '.exqtyval' + productID;
    console.log("Quantity selector:", qtySelector);
    var currentQty = parseInt($(qtySelector).text(), 10);

    if (isNaN(currentQty)) {
      currentQty = 0;
    }

    $(qtySelector).text(currentQty + 1);
    console.log("New quantity:", currentQty + 1);
  });
});

console.log(jQuery('.active_bx_dtl')); // Check if it outputs an element
console.log(jQuery('.active_bx_dtl').offset()); // Check if it outputs an offset object
console.log(jQuery('.active_bx_dtl').offset().top); // Check if it outputs the top offset value
console.log(jQuery('.active_bx_dtl').offset().left); // Check if it outputs the left offset value
