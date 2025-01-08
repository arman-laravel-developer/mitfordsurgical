$(".addcart-button").click(function () {
    $(this).next().addClass("open");
    $(".add-to-cart-box .qty-input").val('1');
});

$('.add-to-cart-box').on('click', function () {
    var $qty = $(this).siblings(".qty-input");
    var currentVal = parseInt($qty.val());
    if (!isNaN(currentVal)) {
        $qty.val(currentVal + 1);
    }
});

$('.qty-left-minus').on('click', function () {
    var $qty = $(this).siblings(".qty-input");
    var _val = $($qty).val();
    if (_val == '1') {
        var _removeCls = $(this).parents('.cart_qty');
        $(_removeCls).removeClass("open");
    }
    var currentVal = parseInt($qty.val());
    var minVal = parseInt($qty.attr("min"));
    if (!isNaN(currentVal) && currentVal > minVal) {
        $qty.val(currentVal - 1);
    }
});

$('.qty-right-plus').click(function () {
    var $qty = $(this).prev();
    var currentVal = parseInt($qty.val());
    var maxVal = parseInt($qty.attr("max"));

    // Check if the current value is less than the max value before incrementing
    if (currentVal < maxVal) {
        $qty.val(currentVal + 1);
    }
});






