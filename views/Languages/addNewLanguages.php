<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
    <script defer src="assets/js/language.js" ></script>
    <h2>Добавить язык </h2>
    <form class="col-8">
        <div class="container">
            <h4 class="page-header">Выберите язык из списка:</h4>
            <div class="row">
                <div class="col-sm-3">
                    <select name="languages" id="langTag" >
                        <?php
                        foreach (ResourceBundle::getLocales('') as $loc)
                        {
                            echo '<option value="'.Locale::canonicalize($loc) .'">'.Locale::getDisplayName($loc).'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <br />
            <div class="form-group">
                <div id="addLanguage" class="btn btn-primary form-control">Добавить</div>
            </div>
            <div id="errorMessage" style="display: none" class="alert alert-danger">Ошибка добавления!</div>
            <div id="successMessage" style="display: none" class="alert alert-success">Язык добавлен!</div>
        </div>
    </form>