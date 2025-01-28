 /**=====================
     Fly Cart js
==========================**/
 $('.btn-cart').on('click', function () {
     if ($(window).width() > 768) {
         var cart = $('.shopping-summary');
     } else {
         var cart = $('.cart-fly-mobile');
     }
     var imgtodrag = $(this).parents('.product-box-4, .deal-box').find(".product-image img, .category-image img").eq(0);
     if (imgtodrag) {
         var imgclone = imgtodrag.clone()
             .offset({
                 top: imgtodrag.offset().top,
                 left: imgtodrag.offset().left
             })
             .css({
                 'opacity': '0.5',
                 'position': 'absolute',
                 'height': '130px',
                 'width': '130px',
                 'z-index': '1060'
             })
             .appendTo($('body'))
             .animate({
                 'top': cart.offset().top + 10,
                 'left': cart.offset().left + 10,
                 'width': 75,
                 'height': 75
             }, 1000, 'easeInOutExpo');
         // openCart()

         imgclone.animate({
             'width': 0,
             'height': 0,
             'z-index': 1060
         }, function () {
             $(this).detach()
         });
     }
 });
