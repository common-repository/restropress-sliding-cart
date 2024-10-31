jQuery(document).ready(function( $ ) {
    'use strict';
    setInterval(function () {
        var data = {
            'action'    : 'get_cart_details',
            'security'  : rpsc_object.nonce
        };

        $.ajax({
            url: rpsc_object.ajax_url,
            type: 'post',
            data: data,
            success: function (response) {
                var subtotal = response.subtotal;
                var cartDetails = response.cart_details;
                var enable = response.set_enable;
                // Update subtotal and cartDetails
                $('#rpress-floating-cart-icon span sup').text(cartDetails); 
                $('#icon-bar').text(cartDetails); 
                if (enable === 1 && sidebarVisible) {
                    // If sidebar is visible, hide it
                    $("#sliding-cart-window").hide();
                    sidebarVisible = false;
                } else if (enable === 1 && !sidebarVisible) {
                    // If sidebar is not visible, show it
                    $("#sliding-cart-window").show();
                    sidebarVisible = true;
                }
            },
            error: function (error) {
                console.error('AJAX Error:', error);
            }
        });
    }, 1000);

    if ($('body .restropress').length > 0) {
        // There are elements with class 'example'
        $('#rpress-floating-cart-icon').show();
        $('.rp-cart-left-wrap').show();
    } else {
        // There are no elements with class 'example'
        $('#rpress-floating-cart-icon').hide();
        $('.rp-cart-left-wrap').hide();
        
    }
    // Toggle the visibility of .rpress-sidebar-cart when the icon is clicked
    $("#rpress-floating-cart-icon").on("click", function() {
      $('.rp-cart-left-wrap').trigger('click');
      adjustFoodItemsListWidth();  // Adjust the width when the icon is clicked
    });
    // Add an event handler to the close icon using jQuery
    $(".fa.fa-times .close-cart-ic").on("click", function() {
        adjustFoodItemsListWidth();  // Adjust the width when the close icon is clicked
    });
    function adjustFoodItemsListWidth() {
        const $foodItemsList = $('.rpress_fooditems_list');
        $foodItemsList.removeClass('rp-col-lg-8');
    }   
    $(".rp-cart-left-wrap").click( function() {
        $('body').css( 'overflow-y', 'hidden'); 
        $('.rp-cart-left-wrap').css('display', 'none');
    })
    $(".close-cart-ic").click( function() {
        $('body').css( 'overflow-y', 'auto');
        $('.rp-cart-left-wrap').css('display', 'block');
    })
    $(".rpress-clear-cart").on("click", function() {
        $('body').css( 'overflow-y', 'auto');
        $('.rp-cart-left-wrap').css('display', 'block');
    })
    
    
});






