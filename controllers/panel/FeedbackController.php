<?php
/**
 * Created by PhpStorm.
 * User: Hegne
 * Date: 08.09.2018
 * Time: 19:58
 */

namespace controllers\panel;

use models\Feedback;

class FeedbackController extends BaseController
{
    public function feedbackListAction(  )
    {
        $this->view->feedbackList = Feedback::GetFeedbackList(5,0);

        return 'feedback-list';
    }//feedbackListAction

    public function addFeedbackAction(  )
    {
        return 'addNewFeedback';
    }//addFeedbackAction

    public function addNewFeedbackAction(  )
    {
        $userFullName = $this->request->getPostValue('userFullName');
        $userEmail = $this->request->getPostValue('userEmail');
        $userPhone = $this->request->getPostValue('userPhone');
        $feedbackText = $this->request->getPostValue('feedbackText');

        $response = array
        (
          'code' => '', 'data' => '', 'message' => ''
        );

        try
        {
            $result = Feedback::AddFeedback($userFullName, $userEmail, $userPhone, $feedbackText);

            $response['code'] = 200;
            $response['message'] = 'Отзыв добавлен!';
            $response['data'] = $result;
        }//try
        catch (\Exception $ex)
        {
            $response['code'] = 403;
            $response['message'] = $ex->getMessage();
            $response['data'] = array(
                'userFullName' => $userFullName,
                'userEmail' => $userEmail,
                'userPhone' => $userPhone,
                'feedbackText' => $feedbackText,
            );
        }//catch

        $this->json($response);
    }//addNewFeedbackAction
}//FeedbackController