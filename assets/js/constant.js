"use strict";

(function (  )
{
    let addConstantsButton = document.querySelector('#addConstant');

    if(addConstantsButton)
    {
        addConstantsButton.addEventListener('click' , async function (  )
        {
            let constTitle = document.querySelector('#constTitle').value;

            if(!constTitle.match("^((^|[^A-Za-z]+)[A-Z][A-Za-z]*)*[^A-Za-z]*$"))
            {
                $('#successMessage').fadeOut(100);
                $('#errorMessage').fadeIn( 100 ).delay(1500).fadeOut(100);
                return;
            }

            $.post(`${window.ServerAddress}?act=addNewConst&ctrl=Constants`,
                {'constTitle': constTitle} ,
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

    let constID = -1;

    [].forEach.call( removeButtons , ( removeButton )=>{

        removeButton.addEventListener('click' , async function (  ){

            constID  = this.dataset.constId ;
            console.log( constID );

            $('#removeConstModal').modal();
        } )

    } );

    let confirmRemoveConstButton = document.querySelector('#confirmRemoveConst');

    if(confirmRemoveConstButton){

        confirmRemoveConstButton.addEventListener('click' , function (  ){

            if( constID  === -1){
                return;
            }//if

            $.ajax( `${window.ServerAddress}?ctrl=Constants&act=removeConst`, {
                method: 'DELETE',
                data: {
                    'constID ': constID
                },
                success: ( data , textStatus )=>{

                    $(`tr[data-const-id='${constID}']`).remove();

                }

            } )

        } );

    }//if

} )();