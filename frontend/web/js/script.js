/**
 * Created by kayud on 27.08.2016.
 */
$(function(){
    var scroll;
    $(window).scroll(function(){
        //console.log($(window).scrollTop());
        scroll = $(window).scrollTop();
        $('.side-menu').css('top', (scroll -1) + 'px');
        if (scroll >= 230){
            $('.body-desktop .js-brand-nav').fadeIn(400);
        }
        else
            $('.body-desktop  .js-brand-nav').fadeOut(400);
        //$(window).unbind('scroll');

    });
    $('.expand').hover(function(e){
        $('.expandable', this).stop(true).slideDown(400,'swing');
    }, function(e){
        $('.expandable', this).stop(true,true).slideUp(300,'swing');
    });
    $('body').on('click','.js-buy:not(.in-cart)', function(e){
        e.preventDefault();
        var id = $(this).data('product');
        var type = $(this).data('type');
        $(this).text("В корзине");
        $(this).addClass('in-cart');
        $.ajax({
            url: '/order/add',
            type: 'post',
            dataType: 'json',
            data:{'productid' : id, 'type': type},
            success: function(data){
                console.log(data);
                $('.basket-count').text(data.count);
                $('.basket .full-block-link').removeClass('hidden');
                $('.true-word').text(get_correct_str(data.count, "товар", "товара","товаров"));
                $('.basket').removeClass('empty').addClass('show');
                setTimeout(function(){
                    $('.basket').removeClass('show');
                }, 1500);
            },
            error: function(){

            }
        });
    }).on('click', '.js-buy.in-cart', function(e){
        e.preventDefault();
        location.href = '/order';
    });

    function get_correct_str(num, str1, str2, str3) {
        var val = eval(num);
        if (val > 10 && val < 20) { return str3 ;}
        else {
            val = eval(num) % 10;
            if (val == 1) { return str1;
            } else if (val > 1 && val < 5) { return str2;
            } else { return str3;}
        }
    }

        $('.item-count').on('focus', function(){
            $(this).parent().addClass('focus');
        }).on('blur', function(){
            $(this).parent().removeClass('focus');
        }).on('keyup', function(e) {
            if ($(this).val() > $(this).data('max')) {
                $(this).parent().addClass('error');
                $(this).parent().parent().find('.js-error').show();
                $(this).parent().find('.icon-minus').css('opacity', '1');
                $(this).parent().find('.icon-plus').css('opacity', '0.3');
            }
            else {
                $(this).parent().removeClass('error');
                $('.js-error').hide();
                if ($(this).val() == 1)
                    $(this).parent().find('.icon-minus').css('opacity', '0.3');
            }
            var field = $(this).parent().find('.count-minus').data('field');

            var value = $(this).val();
            var id = $(this).data('id');
            UpdateOrder('product', field, value, id);
            UpdateBasket();;
        });
    $('.count-plus').on('click' , function(e){
        var currentCount = $(this).parent().find('.item-count').val() * 1;
        var max = $(this).parent().find('.item-count').data('max');
        if (currentCount + 1 <= max) {
            $(this).parent().find('.item-count').val(currentCount + 1);
            if ($('body').hasClass('body-mobile') || $('body').hasClass('body-tablet'))
                $(this).parent().parent().parent().parent().find('.js-data-count').val(currentCount + 1 );
            else
                $(this).parent().parent().parent().find('.js-data-count').val(currentCount + 1 );
            $(this).parent().find('.icon-minus').css('opacity', '1');
        }
        else {
            $(this).parent().find('.item-count').val(currentCount);
            if ($('body').hasClass('body-mobile') || $('body').hasClass('body-tablet'))
                $(this).parent().parent().parent().parent().find('.js-data-count').val(currentCount );
            else
                $(this).parent().parent().parent().find('.js-data-count').val(currentCount);
            $(this).parent().find('.icon-plus').css('opacity', '0.3');
        }

        if (currentCount + 1 >= max)
            $(this).parent().find('.icon-plus').css('opacity', '0.3');


        var field =  $(this).data('field');
        var value =  $(this).parent().find('.item-count').val();
        var id = $(this).data('id');
        UpdateOrder('product', field, value, id);
        UpdateBasket();

    });

    $('.count-minus').on('click' , function(e){
        var currentCount = $(this).parent().find('.item-count').val() * 1;
        var min = 1;
        var max = $(this).parent().find('.item-count').data('max');

        if (currentCount - 1 <= max) {
            $(this).parent().removeClass('error');
            $(this).parent().parent().find('.js-error').hide();
        }
        if (currentCount - 1 >= min) {
            $(this).parent().find('.item-count').val(currentCount - 1);
            if ($('body').hasClass('body-mobile') || $('body').hasClass('body-tablet'))
                $(this).parent().parent().parent().parent().find('.js-data-count').val(currentCount -1 );
            else
                $(this).parent().parent().parent().find('.js-data-count').val(currentCount -1 );
        }
        else {
            $(this).parent().find('.item-count').val(currentCount);
            if ($('body').hasClass('body-mobile') || $('body').hasClass('body-tablet'))
                $(this).parent().parent().parent().parent().find('.js-data-count').val(currentCount );
            else
                $(this).parent().parent().parent().find('.js-data-count').val(currentCount );
            $(this).parent().find('.icon-minus').css('opacity', '0.3');
        }
        if (currentCount - 1 <= 1)
            $(this).parent().find('.icon-minus').css('opacity', '0.3');

        if (currentCount -1 >= min && currentCount - 1 < max)
            $(this).parent().find('.icon-plus').css('opacity', '1');

        var field =  $(this).data('field');
        var value =  $(this).parent().find('.item-count').val();
        var id = $(this).data('id');
        UpdateOrder('product', field, value, id);
        UpdateBasket();
    });

    var ias = jQuery.ias({
        container:  '.ias-catalog',
        item:       '.ias-item',
        pagination: '#pagination',
        next:       '.next a'
    });
    // Add a loader image which is displayed during loading
    ias.extension(new IASSpinnerExtension({
            html: '<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>'
        }
    ));
    $('.chosen-select').chosen();

    var maskList = $.masksSort($.masksLoad("/js/phone-codes.json"), ['#'], /[0-9]|#/, "mask");
    var maskOpts = {
        inputmask: {
            definitions: {
                '#': {
                    validator: "[0-9]",
                    cardinality: 1
                }
            },
            //clearIncomplete: true,
            showMaskOnHover: false,
            autoUnmask: false,
            clearMaskOnLostFocus: false
        },
        match: /[0-9]/,
        replace: '#',
        list: maskList,
        listKey: "mask",
        onMaskChange: function(maskObj, completed) {
            /*if (completed) {
             var hint = maskObj.name_ru;
             if (maskObj.desc_ru && maskObj.desc_ru != "") {
             hint += " (" + maskObj.desc_ru + ")";
             }
             $("#descr").html(hint);
             } else {
             $("#descr").html("Маска ввода");
             }*/
            $(this).attr("placeholder", $(this).inputmask("getemptymask"));
        }
    };
    $('#inputPhone').inputmasks(maskOpts);
    $('#inputCountry').on('change', function(){
        var code = $(this).val();
        $('#countryHidden').val(code);
        $('.js-pay').hide();
        $('.js-pay').each(function(){
            $('input', this).removeAttr('checked');
        });
        //$('.js-' + code.toLowerCase());
        var count = 0;
        var selected = false;
        $('.js-' + code.toLowerCase()).each(function(){
            count++;
            if (count == 1){
                selected = true;
                $('input', this).click();
            }
        }).show();
        if (!selected){
            $('#webmoney').click();
        }
        $.ajax({
            url: '/site/city',
            type: 'post',
            dataType: 'html',
            data: {'code' : code},
            success: function(data){
                $('#inputCity').html(data);
                $("#inputCity").trigger("chosen:updated").change();
                //changeCountry();
                //console.log(data);
            }
        });
        //console.log($(this).val());
    });
    $('#orderform input, #orderform textarea, #inputCity').on('change',function(){

        var order = $('#order-hash').val();
        var data = $('#orderform').serialize() + '&type=client&hash=' + order + '&unmasked=' + $('#inputPhone').inputmask('unmaskedvalue');

        //$.extend(data,{'type' : 'client', 'hash' : order});
        var url = '/order/clientupdate/';
        $.ajax({
            url: url,
            method: 'post',
            data: data,
            dataType: 'json',
            success: function (data) {
                //console.log(data);
            },
            error: function(data){
                //console.log(data);
            }
        });
    });
    $('.js-remove-item').on('click',function(e){
        var url = $(this).data('url');
        var remove_btn = $(this);
        var name = ""+$('.js-product_name').text()+"";
        var price = parseInt($('p.price').text());
        //var sku = $('.js-articul').text();
        $.ajax({
            url: url,
            type: 'POST',
            data: 'ajax=1',
            success: function(data){
                //$(this).parent().parent().remove();
                //console.log(data.error + " " + data.delete);
                //if (data.error == '0' && data.delete == '1')
                remove_btn.parent().parent().remove();

                //removeFromCart(sku, name, price);
                UpdateBasket();

            }
        });

    });
    $('input.search').on('focus', function(){
        $('.search_btn').addClass('focused');
    }).on('blur', function(){
        $('.search_btn').removeClass('focused');
    })
    $('.js-search').on('keyup', function(e){
        console.log(e.which);
        if ($(this).val().length > 3){
            //$('.search-results')


                $.ajax({
                    url: '/catalog/search',
                    dataType: 'html',
                    data: {'text': $(this).val()},
                    type: 'post',
                    beforeSend: function () {
                        $('.search-results').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>').slideDown(300);
                        //$('.search-results').slideDown(300);

                    },
                    success: function (data) {
                        $('.search-results').html(data);
                        //$('.search-results').addClass('scrollbar-inner').scrollbar()
                    }
                });

        }
        else {
            $('.search-results').slideUp(300);
        }
    }).on('focus', function(){
        if ($(this).val().length > 3) {
            $('.search-results').slideDown(300);
        }
    });
    //$('.search-results').addClass('scrollbar-outer').scrollbar();
    $(document).click(function(event) {
        if ($(event.target).closest(".js-search-wrapper").length) return;
        $('.search-results').slideUp(300);
        event.stopPropagation();
    });
});
function UpdateOrder(type, field, value, id) {

    var data = {
        type:type,
        field:field,
        value:value,
        id:id,
        ajax:1
    }
    $.ajax({
        url: '/order/update',
        type: 'POST',
        data: data,
        success: function(data){

        }
    });
}
function UpdateBasket() {
    var count = $('.cart_item').length;

    var all_summ = 0;
    var old_summ = 0;
    //$('.prod_counts').text(count + " " +get_correct_str(count, 'наряд', 'наряда', 'нарядов'));
    $('.cart-item').each(function () {
        var price = parseInt($(this).data('price'));

        var countC = parseInt($('.js-data-count', this).val());

        var summ = price * countC;
        //var old_sum = old_price * countC;
        //console.log(countC + ' ' + summ );
        //old_summ += old_sum;
        all_summ += summ;

        //var valute = get_correct_str(summ, 'рубль', 'рубля', 'рублей');
        /*summ = summ.toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');
         if($('.js-empty').length == 0)
         $('#create_order').removeAttr('disabled').removeClass('btn disabled');*/

    });
    $('.total').text(Math.floor(all_summ).toString().replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 '));
    console.log(all_summ);
}