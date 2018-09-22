"use strict";


(function (  ){


    //Добавление нового статуса

    let AddNewStatusButton = document.querySelector('#AddNewStatus');

    if(AddNewStatusButton){

        AddNewStatusButton.addEventListener('click' , ()=>{

            let title = document.querySelector('#newStatusTitle').value;

            $.post(`${window.ServerAddress}?ctrl=Order&act=addStatus`, {
                'statusTitle': title
            },
             ( response )=>{

                console.log("RESPONSE" , response);

            });

        });

    }//if

} )();