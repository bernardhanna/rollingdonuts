Fix issue with 1e state
Attributes and box items show at cart
Merch products with different attributes should be added sepeprately
Merch and Box items should display on orders page
Woo Commerce emails imporve
Make sure orders are working as live site
Gift card set up
Fix to the checkout page delivery or pick up sometimes not showing possible non issue
Work in a way to modify box items
Add a way to create a custom box



function cw_woo_attribute()
{
    global $product;
    $attributes = $product->get_attributes();
    if (!$attributes) {
        return;
    }

    $nonce = wp_create_nonce('cw_add_to_cart_nonce');
    echo '<div class="custom-attributes" data-nonce="' . esc_attr($nonce) . '">';

    foreach ($attributes as $attribute) {
        if ($attribute->get_variation()) {
            continue;
        }
        $attribute_taxonomy = $attribute->get_taxonomy_object();
        $attribute_name = $attribute_taxonomy->attribute_label;

        echo "<div class='{$attribute->get_name()} attribute-container'>";
        echo "<strong class='text-mob-md-font font-reg420 text-black-full'>{$attribute_name}:</strong> <div class='color-name-display'></div>";

        if ($attribute->is_taxonomy() && ($attribute->get_name() == 'pa_color' || $attribute->get_name() == 'pa_colour')) {
            $terms = wp_get_post_terms($product->get_id(), $attribute->get_name(), 'all');

            foreach ($terms as $term) {
                $term_name = esc_html($term->name);
                $colorValue = strtolower($term_name); // Assumes names are valid CSS color values
                echo "<button type='button' class='attribute-button color-swatch' onclick='updateColorSelection(this, \"{$term_name}\")' style='background-color: {$colorValue}; width: 3rem; height: 3rem; border: 1px solid #ccc; border-radius: 50%; margin-right: 5px;'></button> ";
            }
        } else {
            // Handle non-color attributes
            $terms = wp_get_post_terms($product->get_id(), $attribute->get_name(), 'all');
            foreach ($terms as $term) {
                echo "<button type='button' class='attribute-button' data-attribute-name='{$attribute->get_name()}' data-attribute-value='" . esc_attr($term->slug) . "'>" . esc_html($term->name) . "</button> ";
            }
        }
        echo "</div>";
    }

    echo '</div>';

    // Inline JavaScript for single selection and display color name
    echo "<script>
        function updateColorSelection(element, colorName) {
            // Clear previous selections
            document.querySelectorAll('.color-swatch').forEach(btn => btn.classList.remove('selected'));
            // Mark the clicked swatch as selected
            element.classList.add('selected');
            // Update the display with the selected color name
            document.querySelector('.color-name-display').textContent = colorName;
        }
    </script>";
}
add_action('woocommerce_single_product_summary', 'cw_woo_attribute', 25);


<script>
document.addEventListener('DOMContentLoaded', function() {
    const attributeButtons = document.querySelectorAll('.attribute-button');

    attributeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const attributeName = this.dataset.attributeName;
            const buttons = document.querySelectorAll('.attribute-button[data-attribute-name="' + attributeName + '"]');

            // Remove 'selected' class from all buttons with the same attribute name
            buttons.forEach(function(btn) {
                btn.classList.remove('selected');
            });

            // Add 'selected' class to the clicked button
            this.classList.add('selected');
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const addToCartButton = document.querySelector('button.single_add_to_cart_button'); // Adjust based on your theme's markup
    const attributeContainers = document.querySelectorAll('.attribute-container');

    // Function to check if all attributes are selected
    function checkAllAttributesSelected() {
        let allSelected = true;
        attributeContainers.forEach(container => {
            if (!container.querySelector('.attribute-button.selected')) {
                allSelected = false;
            }
        });

        // Enable or disable the Add to Cart button based on attribute selection
        addToCartButton.disabled = !allSelected;
        if(allSelected) {
            addToCartButton.classList.remove('disabled');
        } else {
            addToCartButton.classList.add('disabled');
        }
    }

    // If there are no attribute containers, the product does not require attribute selection
    if (attributeContainers.length === 0) {
        addToCartButton.disabled = false;
        addToCartButton.classList.remove('disabled');
    } else {
        // Initially disable the "Add to Cart" button and add a 'disabled' class if there are attribute selections
        addToCartButton.disabled = true;
        addToCartButton.classList.add('disabled');

        // Bind click event to attribute buttons
        document.querySelectorAll('.attribute-button').forEach(button => {
            button.addEventListener('click', function() {
                const attributeName = this.dataset.attributeName;
                // Remove 'selected' class from siblings and add to the clicked button
                document.querySelectorAll(`.attribute-container .attribute-button[data-attribute-name="${attributeName}"]`).forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');

                // Re-evaluate whether all selections have been made
                checkAllAttributes  document.addEventListener('DOMContentLoaded', function() {
    // Target the variations form
    var form = document.querySelector('.variations_form');

    // Listen for the custom event triggered when a variation is selected
    form.addEventListener('found_variation', function(event) {
      var variation = event.detail.variation; // Access the variation data
      alert('Variation ID ' + variation.variation_id + ' selected. Price: ' + variation.display_price);
    });

    // Change an element's style based on the dropdown selection
    form.querySelectorAll('.variations select').forEach(function(select) {
      select.addEventListener('change', function() {
        var attributeSelected = this.value; // Get the selected attribute's value
        if (attributeSelected) {
          // Example action: change background color of a product container
          document.querySelector('.product').style.backgroundColor = '#f0f0f0';
        }
      });
    });
  });Selected();
            });
        });
    }
});
  document.addEventListener('DOMContentLoaded', function() {
    // Target the variations form
    var form = document.querySelector('.variations_form');

    // Listen for the custom event triggered when a variation is selected
    form.addEventListener('found_variation', function(event) {
      var variation = event.detail.variation; // Access the variation data
      alert('Variation ID ' + variation.variation_id + ' selected. Price: ' + variation.display_price);
    });

    // Change an element's style based on the dropdown selection
    form.querySelectorAll('.variations select').forEach(function(select) {
      select.addEventListener('change', function() {
        var attributeSelected = this.value; // Get the selected attribute's value
        if (attributeSelected) {
          // Example action: change background color of a product container
          document.querySelector('.product').style.backgroundColor = '#f0f0f0';
        }
      });
    });
  });
  document.addEventListener('DOMContentLoaded', function() {
    // Function to check if all attributes have been selected
    function checkIfAllAttributesSelected() {
        const allSelected = document.querySelectorAll('.attribute-container .attribute-button.selected').length === document.querySelectorAll('.attribute-container').length;
        document.querySelector('.single_add_to_cart_button').disabled = !allSelected;
        if (allSelected) {
            // Update hidden inputs
            document.querySelectorAll('.attribute-container').forEach(container => {
                const attributeName = container.dataset.attribute;
                const selectedValue = container.querySelector('.attribute-button.selected').dataset.attributeValue;
                document.querySelector('input[name="attribute_' + attributeName + '"]').value = selectedValue;
            });
        }
    }

    // Event listeners for your custom attribute buttons
    document.querySelectorAll('.attribute-button').forEach(button => {
        button.addEventListener('click', function() {
            const container = this.closest('.attribute-container');
            container.querySelectorAll('.attribute-button').forEach(btn => btn.classList.remove('selected'));
            this.classList.add('selected');
            checkIfAllAttributesSelected();
        });
    });
});
</script>
