jQuery(document.body).on('added_to_cart', function () {
  jQuery.ajax({
    url: '/wp-admin/admin-ajax.php', // Adjust the path if your WordPress installation directory is different
    type: 'POST',
    data: {
      'action': 'fetch_wc_notices'
    },
    success: function (response) {
      if (response.success && response.data) {
        jQuery('body').append(response.data); // Append notices to the body or to a specific element as needed
      }
    }
  });
});
