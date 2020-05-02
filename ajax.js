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
            if (user!==null) {
                $(".c11").html("Вы вошли как " + user.name+' <a href="/unlogin.php"><button class="buttonIn">Выйти</button></a>');
                $('#myModal').modal('hide');
            } else {
                $('#auth_error').html("Неверные данные");
            }
        },
        error: function (response) { // Данные не отправлены
            $('#auth_error').html("Произошла ошибка");
        }
    });
}
