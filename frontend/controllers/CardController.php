<?php


namespace frontend\controllers;


use common\models\Card;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class CardController extends ActiveController
{
    public $modelClass = Card::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only']=['create','update','delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];
        return $behaviors;
    }

    /**
     * @param string $action
     * @param Card $model
     * @param array $params
     * @throws ForbiddenHttpException
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action,['update','delete','view']) && $model->created_by !== \Yii::$app->user->id){
            throw new ForbiddenHttpException("You don't have permission!!!");
        }
    }
}