"use strict";

(function (  )
{
    let addFeedbackButton = document.querySelector('#addFeedback');

    if(addFeedbackButton)
    {
        addFeedbackButton.addEventListener('click', async function (  )
        {
            let userFullName = document.querySelector('#userFullName').value;

            if(!userFullName.match(/^[a-zа-я0-9_\s]{6,50}$/i))
            {
                $('#successMessage').fadeOut(100);
                $('#nameErrorMessage').fadeIn( 100 ).delay(1500).fadeOut(100);

                return;
            }//if

            let userEmail = document.querySelector('#userEmail').value;

            if(!userEmail.match(/^[a-z0-9_@.\s]{6,50}$/i))
            {
                $('#successMessage').fadeOut(100);
                $('#emailErrorMessage').fadeIn( 100 ).delay(1500).fadeOut(100);

                return;
            }//if

            let userPhone = document.querySelector('#userPhone').value;

            if(!userPhone.match(/^[0-9_\-\s]{10,20}$/i))
            {
                $('#successMessage').fadeOut(100);
                $('#phoneErrorMessage').fadeIn( 100 ).delay(1500).fadeOut(100);

                return;
            }//if

            let feedbackText = document.querySelector('#feedbackText').value;

            if(!feedbackText.match(/^[a-zа-я0-9_\-@.,\s]{10,200}$/i))
            {
                $('#successMessage').fadeOut(100);
                $('#feedbackTextErrorMessage').fadeIn( 100 ).delay(1500).fadeOut(100);

                return;
            }//if

            $.post
            (
                `${window.ServerAddress}?act=addNewFeedback&ctrl=Feedback`,
                {
                    'userFullName': userFullName,
                    'userEmail': userEmail,
                    'userPhone': userPhone,
                    'feedbackText': feedbackText
                },
               function ( response )
               {
                   console.log('response', response);

                   if(response.code === 203)
                   {
                       $('#nameErrorMessage').fadeOut(100);
                       $('#emailErrorMessage').fadeOut(100);
                       $('#phoneErrorMessage').fadeOut(100);
                       $('#feedbackText').fadeOut(100);

                       $('#successMessage').fadeIn( 100 ).delay(2500).fadeOut(100);
                   }//if
                   else
                   {
                       $('#successMessage').fadeOut(100);

                       $('#errorMessage').text(response.message);
                       $('#errorMessage').fadeIn( 100 ).delay(2500).fadeOut(100);
                   }//else
               }//function
            )
        })
    }//if
})();