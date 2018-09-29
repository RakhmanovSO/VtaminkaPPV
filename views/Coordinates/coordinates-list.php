<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>

    <script defer src="assets/js/coordinates.js" ></script>

    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
            integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
            crossorigin=""></script>

    <h2>Координаты</h2>

    <form class="col-12">
        <div class="form-group">
            <label for="latitude">Широта</label>
            <input class="form-control" value="<?= $this->view->coords->lat; ?>" id="latitude" />
        </div>
        <div class="form-group">
            <label for="longitude">Долгота</label>
            <input class="form-control" value="<?= $this->view->coords->lng; ?>" id="longitude" />
        </div>

        <div id="mapid"></div>

        <div class="form-group">
            <div id="addCoordinates" class="btn btn-primary form-control">Изменить</div>
        </div>
        <div id="errorMessage" style="display: none" class="alert alert-danger">Ошибка добавления координат!</div>
        <div id="successMessage" style="display: none" class="alert alert-success">Координаты добавлены!</div>
    </form>


    <div id="mapid"></div>

</main>
</div>
</div>