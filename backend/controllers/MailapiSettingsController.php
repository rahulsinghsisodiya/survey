<?php

namespace backend\controllers;

use Yii;
use backend\models\GlobalSettings;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * GlobalSettingsController implements the CRUD actions for GlobalSettings model.
 */
class MailapiSettingsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * This function will show & save setting for sparkpost
     * like Sparkpost API Key & sending email address
     * @return mixed
     */
    public function actionIndex()
    {
        $settings = GlobalSettings::find()->all();

        if(Yii::$app->request->post('GlobalSettings')) {
            $postData['GlobalSettings'] = Yii::$app->request->post('GlobalSettings');
            foreach ($settings as $key => $model) {
                $modelData['GlobalSettings'] = $postData['GlobalSettings'][$key];
                if ($model->load($modelData)) {
                    if(!$model->save()){
                        break;
                    }
                }
            }
        }

        return $this->render('index', [
           'settings' => $settings,
        ]);
    }

    /**
     * Finds the GlobalSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GlobalSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GlobalSettings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
