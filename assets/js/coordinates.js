"use strict";

//Установить в проект Leaflet map
//npm install leaflet

(function (  ){

    //Добавление новых координат
    let addCoordinatesButton = document.querySelector('#addCoordinates');

    if(addCoordinatesButton){

        addCoordinatesButton.addEventListener('click' , async function (  ){

            let nLatitude = document.querySelector('#latitude').value;
            let nLongitude = document.querySelector('#longitude').value;

            $.post(`${window.ServerAddress}?act=addNewCoordinates&ctrl=Coordinates`,
                {'latitude': nLatitude, 'longitude': nLongitude} ,
                function ( response ){
                console.log( 'response' , response );

                if(response.code === 200){
                    $('#errorMessage').fadeOut(100);
                    $('#successMessage').fadeIn( 100 ).delay(2500).fadeOut(100);
                }//else
                else{

                    $('#successMessage').fadeOut(100);
                    $('#errorMessage').text(response.message);

                    $('#errorMessage').fadeIn( 100 ).delay(2500).fadeOut(100);

                }//else

            } );

        } );

    }//if

    //Изменение координат
    let changeCoordinatesButton = document.querySelector('#changeCoordinates');

    if(changeCoordinatesButton){

        changeCoordinatesButton.addEventListener('click' , ()=>{

            let latitudeInput = document.querySelector('#latitude');

            let lat = latitudeInput.value.trim();
            let coordID = +latitudeInput.dataset.coordinatesId;

            if( !lat.match(/^[a-z0-9\sа-я]{2,50}$/i)){

                $('#successMessage').fadeOut(100);
                $('#errorMessage').fadeIn( 100 ).delay(2500).fadeOut(100);
                return;

            }//if

            let longitudeInput = document.querySelector('#longitude');

            let long = longitudeInput.value.trim();
            coordID = +longitudeInput.dataset.coordinatesId;

            if(!long.match(/^[a-z0-9\sа-я]{2,50}$/i)){

                $('#successMessage').fadeOut(100);
                $('#errorMessage').fadeIn( 100 ).delay(2500).fadeOut(100);
                return;

            }//if

            $.ajax( `${window.ServerAddress}?ctrl=Coordinates&act=saveCoordinates`, {
                method: 'post',
                data: {
                    'coordinatesID': coordID,
                    'latitude':lat,
                    'longitude':long
                },
                success: ( response )=>{

                    console.log('RESPONSE' , response);

                    if(response.code === 200){
                        $('#errorMessage').fadeOut(100);
                        $('#successMessage').fadeIn( 100 ).delay(2500).fadeOut(100);
                    }//else
                    else{

                        $('#successMessage').fadeOut(100);
                        $('#errorMessage').text(response.message);

                        $('#errorMessage').fadeIn( 100 ).delay(2500).fadeOut(100);

                    }//else

                }//success
            } );
        });
    }//if

    let latInput = document.querySelector('#latitude');
    let lngInput = document.querySelector('#longitude');

    let coords = [48.02, 37.8];

    if(latInput.value && lngInput.value){
        coords = [
            latInput.value,
            lngInput.value
        ];
    }//if

    //Настройка карты

    //Устанавливаем координаты (широта, долгота) и уровень зума
    var mymap = L.map('mapid').setView(coords, 13);

    //Загрузка и отображение (конкретизирует заданный шаблон URL)
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiYWxleC1vdnN5YW5pa292IiwiYSI6ImNqbWVnMDJzeTBtaGYzcG54bmV1Zmphd3AifQ.nhqw4J8iOd8IOJxJquCNdg', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
    }).addTo(mymap);

    //Добавляем маркер
    var marker = L.marker(coords).addTo(mymap);

    //Во время клика будут видны координаты
    var popup = L.popup();

    function onMapClick(e) {

        marker.setLatLng(e.latlng);

        console.log(marker);

        latInput.value = e.latlng.lat;
        lngInput.value = e.latlng.lng;

        popup
            .setLatLng(e.latlng)
            .setContent("Вы кликнули карту в точке " + e.latlng.toString())
            .openOn(mymap);

    }//onMapClick

    mymap.on('click', onMapClick);

} )();