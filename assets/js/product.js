"use strict";

(function (  ){

    let addAttributeButton = document.querySelector('#addAttribute');

    if(addAttributeButton){

        addAttributeButton.addEventListener('click' , async function (  ){

            let attributeTitle = document.querySelector('#attributeTitle').value;

            if(!attributeTitle.match(/^[a-zа-я0-9_\s]{2,50}$/i)){

                $('#successMessage').fadeOut(100);
                $('#errorMessage').fadeIn( 100 ).delay(1500).fadeOut(100);

                return;
            }//if

            $.post(`${window.ServerAddress}?act=addNewAttribute&ctrl=Product`,{'attributeTitle': attributeTitle} , function ( response ){

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

    //Добавление товара
    let attributes = [];

    let attributesTable = document.querySelector('#attributesTable');
    let addAttributeToProductButton = document.querySelector('#addAttributeToProduct');
    let currentAttribute = {
        attributeTitle: '',
        attributeID: '',
        attributeValue: '',
    };


    document.querySelector('#productAttributes').addEventListener('change', function (  ){

        let exist = attributes.find( attr => attr.attributeID === this.value );


        if(exist){
            return;
        }//if

        currentAttribute.attributeID = this.value;
        currentAttribute.attributeTitle = document.querySelector(`option[value='${this.value}']`).dataset.attributeTitle;

        attributes.push( {
            attributeID: currentAttribute.attributeID,
            attributeTitle: currentAttribute.attributeTitle,
            attributeValue: ''
        } );

    } );

    if(addAttributeToProductButton){

        addAttributeToProductButton.addEventListener('click' , function (  ){

            let val = document.querySelector('#attributeValue').value;

            let exist = attributes.find( attr => attr.attributeID === currentAttribute.attributeID );

            exist.attributeValue = val;

            while(attributesTable.firstChild){
                attributesTable.removeChild( attributesTable.firstChild );
            }//while

            attributes.forEach( attr => {
                attributesTable.innerHTML += `
                    <td>${attr.attributeTitle}</td>
                    <td>${attr.attributeValue}</td>
                    <td>Удалить</td>
                `;
            } )

        } );

    }//if

} )();