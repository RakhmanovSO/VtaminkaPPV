"use strict";


(function (  ){



    //Удаление заказа

    let removeButtons = document.querySelectorAll('.btn-danger');

    let orderID = -1;

    [].forEach.call( removeButtons , ( removeButton )=>{

        removeButton.addEventListener('click' , async function (  ){

            orderID = this.dataset.orderId;
            console.log(orderID);

            $('#removeOrderModal').modal();

        } )

    } );


    let confirmRemoveOrderButton = document.querySelector('#confirmRemoveOrder');

    if(confirmRemoveOrderButton){

        confirmRemoveOrderButton.addEventListener('click' , function (  ){

            if(  orderID === -1){
                return;
            }//if

            $.ajax( `${window.ServerAddress}?ctrl=Order&act=removeOrder`, {
                method: 'DELETE',
                data: {
                    'orderID': orderID
                },
                success: ( data , textStatus )=>{

                    $(`tr[data-order-id='${orderID}']`).remove();

                }
            } )

        } );

    }//if



    //Обновление
    let updateOrderButton = document.querySelector('#updateOrderButton');

    if(updateOrderButton){

        updateOrderButton.addEventListener('click' , ()=>{


            let orderId = document.getElementById('OrderId');
            let orderID = orderId.dataset.orderId;


            let userId = document.getElementById('UserName');
            let userID = userId.dataset.userId;



            let UserName = document.querySelector('#UserName');
            let userName = UserName.value.trim();

            let UserEmail = document.querySelector('#email');
            let userEmail = UserEmail.value.trim();


            let UserPhone = document.querySelector('#phone');
            let userPhone = UserPhone.value.trim();

            let DeliveryAddressOrder = document.querySelector('#аddress');
            let deliveryAddressOrder = DeliveryAddressOrder.value.trim();


            let CommentToTheOrder = document.querySelector('#comment');
            let commentToTheOrder = CommentToTheOrder.value.trim();


            //statusOrderId
            // let statusOrderOptions = document.querySelectorAll("#statusOrder option");
            // let selectOption = [].filter.call(statusOrderOptions , o => o.selected === true);
            //  let statusOrder = [].map.call( selectOption , o => o.value );
            // let statusOrderId = statusOrder[0];


            let statusOrderOptions  = document.getElementById("statusOrder");
            let statusID = statusOrderOptions.options[statusOrderOptions.selectedIndex].value;



            let productsIdList = [];   //  let orderDetailsID = ;

            let productsTable = document.getElementById('productsTable');

             let elem = productsTable.childElementCount;  // 5 - 1

            let i = 0;
            let count = elem - 1;

            while( i < count){

                let Id = productsTable.rows[i].dataset.productId;  // заменить во views  <tr data-orderdetails-id="<?= $product->orderDetailsID ?>">

                productsIdList.push(Id);

                i +=1;

               // console.log(  productsIdList );

            }// while



            $.ajax( `${window.ServerAddress}?ctrl=Order&act=saveOrder`, {
                method: 'post',
                data: {
                    'orderID': orderID,
                    'deliveryAddressOrder': deliveryAddressOrder,
                    'commentToTheOrder': commentToTheOrder,
                    'statusID': statusID,

                    'userName': userName,
                    'userEmail': userEmail,
                    'userPhone': userPhone,
                    'userID': userID

                   // 'orderDetailsID': JSON.stringify(productsIdList)

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

            } );  /// ajax


        });


    }// if  updateOrderButton



    // Удаление с табл. продукта из заказа.

    let deleteProductOnTableOrderButtons = document.querySelectorAll('.btn-danger');

    let orderDetailsID = -1;


    [].forEach.call( deleteProductOnTableOrderButtons , ( deleteProductOnTableOrderButtons ) => {

        deleteProductOnTableOrderButtons.addEventListener('click' , async function (  ){

            orderDetailsID = this.dataset.orderdetailsId;

            // console.log( orderDetailsID );

            $('#removeProductModal').modal();

        } );

    } );

    let confirmRemoveProductButton = document.querySelector('#confirmRemoveProduct');

    if(confirmRemoveProductButton){

        confirmRemoveProductButton.addEventListener('click' , function (  ){

            if( orderDetailsID === -1){
                return;
            }//if

            $.ajax( `${window.ServerAddress}?ctrl=Order&act=removeProductInOrder`, {
                method: 'DELETE',
                data: {
                    'orderDetailsID': orderDetailsID
                },
                success: ( data , textStatus )=>{

                    $(`tr[data-orderdetails-id ='${orderDetailsID}']`).remove();

                }
            } )

        } );

    } // if  confirmRemoveProductButton



} )();
