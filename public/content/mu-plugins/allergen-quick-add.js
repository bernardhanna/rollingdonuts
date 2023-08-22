/**
 * @Author: Bernard Hanna
 * @Date:   2023-08-03 12:49:39
 * @Last Modified by:   Bernard Hanna
 * @Last Modified time: 2023-08-04 10:49:09
 */

jQuery(document).ready(function($) {
  var mediaUploader;

  if (!$('body').hasClass('edit-php') || !$('body').hasClass('post-type-allergen')) {
      return;
  }

  if (typeof allergenQuickAdd === 'undefined' || !allergenQuickAdd) {
      return; // exit if our localized variable isn't available.
  }

  // Add fields for the allergen title and image directly above the post table.
  var fieldsHTML = `
      <div id="allergenQuickAddFields">
          <h3>Quick Add Allergen</h3>
          <label style="font-weight: bold;" for="allergenTitle"><strong>Allergen Title:</strong></label>
          <input type="text" id="allergenTitle" name="allergenTitle" style="margin-right:20px;">

          <label for="allergenImage"><strong>Allergen Icon Image:</strong></label>
          <input type="button" id="uploadButton" value="Upload Image" class="button-secondary">
          <input type="hidden" id="allergenImage" name="allergenImage">

          <button type="button" id="quickAddButton" class="button-primary">Add Allergen</button>
      </div>
  `;

  // Remove the default "Add New" button
  $('.page-title-action').remove();

  // Append the custom fields above the filter links
  $('.subsubsub').before(fieldsHTML);

  $('#uploadButton').click(function(e) {
      e.preventDefault();

      if (mediaUploader) {
          mediaUploader.open();
          return;
      }

      mediaUploader = wp.media.frames.file_frame = wp.media({
          title: 'Choose Allergen Icon Image',
          button: {
              text: 'Choose Image'
          },
          multiple: false
      });

      mediaUploader.on('select', function() {
          var attachment = mediaUploader.state().get('selection').first().toJSON();
          $('#allergenImage').val(attachment.id);
      });

      mediaUploader.open();
  });

  $('#quickAddButton').on('click', function() {
      var title = $('#allergenTitle').val();
      var thumbnailId = $('#allergenImage').val();

      $.post(allergenQuickAdd.ajax_url, {
          action: 'allergen_quick_add',
          title: title,
          thumbnail_id: thumbnailId,
          _ajax_nonce: allergenQuickAdd.nonce
      }, function(response) {
          if (response.success) {
              alert(response.data.message);
              location.reload(); // Refresh the page to see the new allergen
          }
      });
  });

  $(document).on('click', '#set_featured_image', function(e) {
      e.preventDefault();

      if (mediaUploader) {
          mediaUploader.open();
          return;
      }

      mediaUploader = wp.media.frames.file_frame = wp.media({
          title: 'Choose Allergen Icon Image',
          button: {
              text: 'Choose Image'
          },
          multiple: false
      });

      mediaUploader.on('select', function() {
          var attachment = mediaUploader.state().get('selection').first().toJSON();
          $('#allergen_featured_image').val(attachment.id);
          $('#allergen_featured_preview').attr('src', attachment.url).show();
      });

      mediaUploader.open();
  });
    $(document).on('wp-updates-post', function(event, data) {
      if (data.success) {
          var postId = data.postID;
          var newImageUrl = $('#allergen_featured_image').data('thumbnail-url'); // Assuming you update this data attribute with the new image URL.
          $('tr#post-' + postId).find('.featured_image img').attr('src', newImageUrl);
      }
  });
});

jQuery(document).on('click', '.editinline', function() {
  var postId = jQuery(this).closest('tr').attr('id').replace('post-', '');
  var thumbSrc = jQuery('#' + postId + ' .featured_image img').attr('src');

  jQuery('#allergen_featured_preview').attr('src', thumbSrc);
  jQuery('#allergen_featured_image').data('thumbnail-url', thumbSrc);
});
