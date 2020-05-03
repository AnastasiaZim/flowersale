$(document).ready(function () {
    $("#btn").click(
        function () {
            sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');
            return false;
        }
    );
});

function sendAjaxForm(result_form, ajax_form, url) {
    $.ajax({
        url: url, //url страницы (action_ajax_form.php)
        type: "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#" + ajax_form).serialize(),  // Сеарилизуем объект
        success: function (response) { //Данные отправлены успешно
            let user = JSON.parse(response);
            if (user !== null) {
                // $(".c11").html("Вы вошли как " + user.name + ' <a href="/unlogin.php"><button class="buttonIn">Выйти</button></a>');
                // $('#myModal').modal('hide');
                document.location.reload();
            } else {
                $('#auth_error').html("Неверные данные");
            }
        },
        error: function (response) { // Данные не отправлены
            $('#auth_error').html("Произошла ошибка");
        }
    });
}

function register() {
    $.ajax({
            url: '/register_ajax_form.php', //url страницы (action_ajax_form.php)
            type: "POST", //метод отправки
            dataType: "html", //формат данных
            data: $("#register_form").serialize(),  // Сеарилизуем объект
            success: function (response) { //Данные отправлены успешно
                let user = JSON.parse(response);
                if ('error' in user) {
                    $('#register_result').html(user.error);
                }
                else {
                    document.location.href = '/selfBox.php';
                    // $(".c11").html("Вы вошли как " + user.name + ' <a href="/unlogin.php"><button class="buttonIn">Выйти</button></a>');
                }

            },
            error: function () { // Данные не отправлены
                $('#register_result').html("Произошла ошибка");
            }
        }
    );
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function addProductToCookie(product) {
    let basket = getCookie('basket');
    let productId = product['id'];
    if (basket === undefined) {
        basket = {};
        basket[productId] = {product: product, count: 1};
    }
    else {
        basket = JSON.parse(basket);
        if (productId in basket && basket[productId] != null) {
            basket[productId]['count']++;
        }
        else {
            basket[productId] = {product: product, count: 1};
        }
    }
    document.cookie = "basket=" + JSON.stringify(basket);
    $('#count_in_basket').html('В корзине ' + basket[productId]['count']);
}

function createOrder(sum) {
    $.ajax({
            url: '/createOrder_ajax.php', //url страницы (action_ajax_form.php)
            type: "POST", //метод отправки
            dataType: "html", //формат данных
            success: function () { //Данные отправлены успешно
                document.cookie = "basket=[]";
                document.location.reload();
            }
        }
    );
}

function deleteBasketItem(basketItemId) {
    let basket = JSON.parse(getCookie('basket'));
    delete basket[basketItemId];
    document.cookie = "basket=" + JSON.stringify(basket);
    document.location.reload();
}

function deleteProduct(id) {
    $.ajax({
            url: '/delete.php', //url страницы (action_ajax_form.php)
            type: "POST", //метод отправки
            dataType: "html", //формат данных
            data: {id: id},
            success: function () { //Данные отправлены успешно
                document.location.reload();
            }
        }
    );
}

function createProduct(){
    $.ajax({
            url: '/action_edit.php', //url страницы (action_ajax_form.php)
            type: "POST", //метод отправки
            dataType: "html", //формат данных
            data: $("#edit_form").serialize(),  // Сеарилизуем объект
            success: function () { //Данные отправлены успешно
                document.location.href="/editor.php";
            }
        }
    );
}