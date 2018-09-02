"use strict";


(function (  ){


    //Добавление новой категории
    let addCategoryButton = document.querySelector('#addCategory');

    if(addCategoryButton){

        addCategoryButton.addEventListener('click' , async function (  ){

            let categoryTitle = document.querySelector('#categoryTitle').value;

            if(!categoryTitle.match(/^[a-zа-я0-9_\s]{2,50}$/i)){

                $('#successMessage').fadeOut(100);
                $('#errorMessage').fadeIn( 100 ).delay(1500).fadeOut(100);

                return;
            }//if

            $.post(`${window.ServerAddress}?act=addNewCategory&ctrl=Category`,{'categoryTitle': categoryTitle} , function ( response ){
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

    //Удаление категории

    let removeButtons = document.querySelectorAll('.btn-danger');

    let categoryID = -1;

    [].forEach.call( removeButtons , ( removeButton )=>{

        removeButton.addEventListener('click' , async function (  ){

            categoryID = this.dataset.categoryId;
            console.log( categoryID );

            $('#removeCategoryModal').modal();

        } )

    } );

    let confirmRemoveCategoryButton = document.querySelector('#confirmRemoveCategory');

    if(confirmRemoveCategoryButton){

        confirmRemoveCategoryButton.addEventListener('click' , function (  ){

            if( categoryID === -1){
                return;
            }//if

            $.ajax( `${window.ServerAddress}?ctrl=Category&act=removeCategory`, {
                method: 'DELETE',
                data: {
                    'categoryID': categoryID
                },
                success: ( data , textStatus )=>{

                    $(`tr[data-category-id='${categoryID}']`).remove();

                }
            } )

        } );

    }//if

    //Обновление категории

} )();