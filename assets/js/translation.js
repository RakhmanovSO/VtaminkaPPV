"use strict";

(function (  )
{
    let addTranslateButton = document.querySelector('#addTranslate');
    let translationsTable = document.querySelector('#translationsTable');


    if(addTranslateButton)
    {
        addTranslateButton.addEventListener('click' , async function (  )
        {
            let langID = document.querySelector('#langID').value;
            let constantID = document.querySelector('#constantID').value;
            let Text = document.querySelector('#Text').value.trim();

            $.post(`${window.ServerAddress}?act=addNewTranslate&ctrl=Translations`,
                {
                    'langID': langID,
                    'constantID': constantID,
                    'Text': Text,
                } ,
                function ( response )

                {
                    console.log( 'response' , response );

                    if(response.code === 200){

                        let translation = response.data;
                        let constantListChildren = document.querySelector('#constantID').children;

                        let constantTitle = [].find.call(constantListChildren , opt => opt.selected === true  );
                        constantTitle = constantTitle.textContent;

                        let langsListChildren = document.querySelector('#langID').children;


                        let langTitle = [].find.call(langsListChildren , opt => opt.selected === true  );
                        langTitle = langTitle.textContent;

                        $('#errorMessage').fadeOut(100);
                        $('#successMessage').fadeIn( 100 ).delay(2500).fadeOut(100);

                        translationsTable.innerHTML += `
                                <tr>
                                    <td>${translation.translationID}</td>
                                    <td>${langTitle}</td>
                                    <td>${constantTitle}</td>
                                    <td>${Text}</td>
                                    <td><button data-translation-id="${translation.translationID}" class="btn btn-danger" >Remove</button></td>
                                    <td><a class="btn btn-primary" href="#">Update</a></td>
                                </tr>
                        `;

                    }//if
                    else {

                        $('#successMessage').fadeOut(100);
                        $('#errorMessage').text(response.message);

                        $('#errorMessage').fadeIn( 100 ).delay(2500).fadeOut(100);
                    }
                } );
        } );
    }

    let removeButtons = document.querySelectorAll('.btn-danger');

    let transID = -1;

    [].forEach.call( removeButtons , ( removeButton )=>{

        removeButton.addEventListener('click' , async function (  ){

            transID  = this.dataset.translationId ;
            console.log( transID );

            $('#removeTranslationModal').modal();
        } )

    } );

    let confirmRemoveTranslateButton = document.querySelector('#confirmRemoveTranslate');

    if(confirmRemoveTranslateButton){

        confirmRemoveTranslateButton.addEventListener('click' , function (  ){

            if( transID  === -1){
                return;
            }//if

            $.ajax( `${window.ServerAddress}?ctrl=Translations&act=removeTranslate`, {
                method: 'DELETE',
                data: {
                    'transID': transID
                },
                success: ( data , textStatus )=>{

                    $(`tr[data-translation-id='${transID}']`).remove();

                }

            } )

        } );

    }//if

} )();