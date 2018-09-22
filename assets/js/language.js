"use strict";

(function (  )
{
    let addLanguageButton = document.querySelector('#addLanguage');

    if(addLanguageButton)
    {
        addLanguageButton.addEventListener('click' , async function (  )
        {
            let langTag = document.querySelector('#langTag').value;

            $.post(`${window.ServerAddress}?act=addNewLanguages&ctrl=Languages`,
                {'langTag': langTag} ,
                function ( response )
                {
                    console.log( 'response' , response );

                    if(response.code === 200)
                    {
                        $('#errorMessage').fadeOut(100);
                        $('#successMessage').fadeIn( 100 ).delay(2500).fadeOut(100);
                    }
                    else {

                        $('#successMessage').fadeOut(100);
                        $('#errorMessage').text(response.message);

                        $('#errorMessage').fadeIn( 100 ).delay(2500).fadeOut(100);
                     }
                } );
        } );
    }

    let removeButtons = document.querySelectorAll('.btn-danger');

    let langID = -1;

    [].forEach.call( removeButtons , ( removeButton )=>{

        removeButton.addEventListener('click' , async function (  ){

            langID  = this.dataset.langId ;
            console.log( langID );

            $('#removeLanguagesModal').modal();
        } )

    } );

    let confirmRemoveLanguageButton = document.querySelector('#confirmRemoveLanguage');

    if(confirmRemoveLanguageButton){

        confirmRemoveLanguageButton.addEventListener('click' , function (  ){

            if( langID  === -1){
                return;
            }//if

            $.ajax( `${window.ServerAddress}?ctrl=Languages&act=removeLanguages`, {
                method: 'DELETE',
                data: {
                    'langID ': langID
                },
                success: ( data , textStatus )=>{

                    $(`tr[data-lang-id='${langID}']`).remove();

                }

            } )

        } );

    }//if

} )();