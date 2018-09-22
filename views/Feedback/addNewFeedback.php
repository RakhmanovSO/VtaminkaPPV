<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
    <script defer src="assets/js/feedback.js" ></script>
    <h2>Отзывы </h2>

    <form class="col-8">
        <div class="form-group">
            <label for="userFullName">Полное имя</label>
            <input class="form-control" id="userFullName"/>
        </div>
        <div class="form-group">
            <label for="userEmail">Email</label>
            <input class="form-control" id="userEmail"/>
        </div>
        <div class="form-group">
            <label for="userPhone">Номер телефона</label>
            <input class="form-control" id="userPhone"/>
        </div>
        <div class="form-group">
            <label for="feedbackText">Отзыв</label>
            <textarea class="form-control" id="feedbackText" style="height: 200px"></textarea>
        </div>
        <div class="form-group">
            <div id="addFeedback" class="btn btn-primary form-control">Добавить</div>
        </div>

        <div id="nameErrorMessage" style="display: none" class="alert alert-danger">Ошибка добавления отзыва! Неверное имя!</div>
        <div id="emailErrorMessage" style="display: none" class="alert alert-danger">Ошибка добавления категории! Неверный email!</div>
        <div id="phoneErrorMessage" style="display: none" class="alert alert-danger">Ошибка добавления категории! Неверный номер телефона!</div>
        <div id="feedbackTextErrorMessage" style="display: none" class="alert alert-danger">Ошибка добавления категории! Неверный отзыв!</div>

        <div id="errorMessage" style="display: none" class="alert alert-success">Ошибка добавления отзыва!</div>
        <div id="successMessage" style="display: none" class="alert alert-success">Отзыв добавлен!</div>
    </form>