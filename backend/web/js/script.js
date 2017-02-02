/**
 * Created by kayud on 21.08.2016.
 */
$(function(){
    $("#add_img_input").on('change', function(){
        addFile(this.files);
    });
    $('.button_add_img').click(function(){
        fileBrowse($(this).data('id'));
    });
    function fileBrowse(id) {
        var browseField = document.getElementById(id);
        browseField.click();
    }

    $('.js-input-field').on('blur', function(){
        var value = $(this).val();
        var field = $(this).data('field');
        $.ajax({
            url:'/admin/catalog/update',
            dataType:'json',
            type:'post',
            data:{'id':$('#prodId').data('id'), 'field':field, 'value':value},
            success: function(data){
                console.log(data);
            }
        });
    });
    $('.js-in-stock').on('change', function(){
        var value = $(this).val();
        var field = $(this).data('field');
        if (!$(this).is(':checked'))
            value = 0;
        $.ajax({
            url:'/admin/catalog/update',
            dataType:'json',
            type:'post',
            data:{'id':$('#prodId').data('id'), 'field':field, 'value':value},
            success: function(data){
                console.log(data);
            }
        });
    });



    function addFile(files) {
        //var id = $('span.cat').attr('id').split('cat_')[1];
        var file = files[0];
        var fd = new FormData();
        fd.append('filename', $('#add_img_input')[0].files[0]);
        fd.append('file', '');
        fd.append('product_id', $('#prodId').data('id'));
        fd.append('type', 'product');
        $.ajax({
            cache: false,
            type: 'POST',
            url: '/admin/catalog/upload',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                //appendData(data.id, data.filename, data.title, data.description);
                var html = '<div class="load-img"><img src="/uploads/products/' + data.id + '/' + data.filename + '"><div class="delete"><span>&times;</span></div></div>';
                $('.load-images-wrapper').append(html);
                $('#add_img_input').val('');

            },
            error: function(data) {
                console.log(data);
                $('#add_img_input').val('');
            }
        });
    }

    $('.input_selected_click').on('change', function(){
        //alert($(this).data('pos'));
        var pos = $(this).data('pos');
        var loader = $(this);
        var title = $('#imagesName').val();
        //var data = {'pos':, 'title':title};
        var fd = new FormData();
        fd.append('filename', loader[0].files[0]);
        fd.append('pos', pos);
        fd.append('file', '');
        fd.append('type', 'images');
        $.ajax({
            cache: false,
            type: 'POST',
            url: '/settings/upload',
            data: fd,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#add_img_' + pos + '_button').hide();
                var html = '';
                html += '<img src="/uploads/main/images/'+data.image+'" style="width:150px;float:left">'+
                    '<div class="close delete_img" data-pos="' + pos + '">+</div>';
                $('.item.img'+pos).append(html);
                //appendData(data.id, data.filename, data.title, data.description);
                loader.val('');

            },
            error: function(data) {
                console.log(data);
                loader.val('');
            }
        });
    });

    $('.js-tooltips').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        if (!$(this).parent().hasClass('tip')) {
            $(this).parent().addClass('tip').css('opacity', '1').find('.tooltips').fadeIn(400);
        }
        else {
            $(this).parent().css('opacity', '').find('.tooltips').fadeOut(400);
        }

    });
    $(document).click(function(event) {
        if ($(event.target).closest(".tooltips").length) return;
        $('.tooltips').fadeOut(400);
        $('.js-tooltips').parent().removeClass('tip').css('opacity', '');
        event.stopPropagation();
    });
    //sendNotification('Новый заказ', { body: 'Поступил новый заказ', tag: 'orders',icon : "/admin/images/cart.png" });
    setInterval(listenOrders, 5000);

    $('.selectpicker').selectpicker();
    $('.selectpicker').on('show.bs.select', function (e) {
        var dropdown = $(e.currentTarget).parents('.bootstrap-select').find('div.dropdown-menu');
        dropdown.slideDown(300);
    }).on('hide.bs.select', function(e){
        var dropdown = $(e.currentTarget).parents('.bootstrap-select').find('div.dropdown-menu');
        dropdown.slideUp(300);
    });

});
var notified = 0;
function listenOrders(){

        $.ajax({
            url: '/admin/orders/api',
            dataType: 'json',
            success: function (data) {

                if (data.notify) {
                    if (notified == 0) {
                        sendNotification('Новый заказ',
                            {
                                body: 'Поступил новый заказ',
                                tag: 'orders',
                                icon: "/admin/images/cart.png"
                            }, '/admin/orders/' + data.id);

                    }
                }


            }
        });

}
function sendNotification(title, options, href) {
// Проверим, поддерживает ли браузер HTML5 Notifications
    if (!("Notification" in window)) {
        alert('Ваш браузер не поддерживает HTML Notifications, его необходимо обновить.');
    }

// Проверим, есть ли права на отправку уведомлений
    else if (Notification.permission === "granted") {
// Если права есть, отправим уведомление
        var notification = new Notification(title, options);
        notified = 1;
        function clickFunc() {
            notification.close();
            location.href = href;
        }

        notification.onclick = clickFunc;
    }

// Если прав нет, пытаемся их получить
    else if (Notification.permission !== 'denied') {
        Notification.requestPermission(function (permission) {
// Если права успешно получены, отправляем уведомление
            if (permission === "granted") {
                var notification = new Notification(title, options);

            } else {
                alert('Вы запретили показывать уведомления'); // Юзер отклонил наш запрос на показ уведомлений
            }
        });
    } else {
// Пользователь ранее отклонил наш запрос на показ уведомлений
// В этом месте мы можем, но не будем его беспокоить. Уважайте решения своих пользователей.
    }
}