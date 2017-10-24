<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use backend\models\ChangePasswordForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;

use yii\captcha\Captcha;
use lavrentiev\widgets\toastr\Notification;
use common\components\CommonFunction;
  use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error','request-password-reset','captcha','reset-password','my-profile'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','change-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            /*'error' => [
                'class' => 'yii\web\ErrorAction',
            ],*/
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fontFile'=> '@backend/web/fonts/captcha_font.ttf',
                'foreColor'=> 0x545351, //0xA09F9B,
                'backColor' => 0xE5E5E5,
                'padding' => 1,
                'height' => 38,
                'minLength' => 5,
                'maxLength' => 6,
                'offset' => 1,
                /*'width' => 120,*/
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    
        $data = Array();
        
        return $this->render('index',['data' => $data]);
        
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {   $this->layout='login';

        if (!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }



     public function actionRequestPasswordReset()
    {
        $this->layout='login';
        $model = new PasswordResetRequestForm();
        //Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {

                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    public function actionForgetpassword()
    {
         $this->layout='login';
         $model = new User();
        return $this->render('forget',['model' =>$model]);
    }
    public function actionResetPassword($token)
    {   $this->layout='login';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionChangePassword()
    {

        $this->layout = "dashboard";

        $model = new ChangePasswordForm(Yii::$app->user->identity->id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->validatePassword()) {
                if ($model->updatePassword()) {

                    Yii::$app->session->setFlash('success', 'Password Update Successfully');

                }
                else{
                    Yii::$app->session->setFlash('error', 'Error Occoured Please Try Again.');
                }

            }
            else {
                Yii::$app->session->setFlash('error', 'Invalid Current Password.');
            }
            return $this->redirect('@web/site/change-password');
        }

        return $this->render('change-password', [
            'model' => $model,
        ]);


    }
    //my profile
    public function actionMyProfile()
    {
        $this->layout = "dashboard";
        $model = new ProfileForm(Yii::$app->user->identity->id);
            $str = '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';
            $img['src'] = $str;
            $img['type'] = 'jpeg';
            $img['path'] = 'uploads/';
            $img['name'] = 'banner';
            $imageSave = $img['path'].$this->base64_to_jpeg($img);

        $model->username = Yii::$app->user->identity->username;    
        $model->email = Yii::$app->user->identity->email;
        $model->profile_picture = Yii::$app->user->identity->profile_picture;
    
        if ($model->load(Yii::$app->request->post())) {
               $data =  Yii::$app->request->post();
               
               $profileimage = CommonFunction::uploadFile($model,'profilepicture');
               
               $model->email = $data['ProfileForm']['email']; 
               $model->username = $data['ProfileForm']['username']; 

               if(!empty($profileimage))
               {
                $model->profile_picture = $profileimage;
               } 
                if ($model->updateProfile()) {
                    Yii::$app->session->setFlash('success', 'Profile Update Successfully');
                }
                else{
                    Yii::$app->session->setFlash('error', 'Error Occoured Please Try Again.');
                }
                return $this->redirect('@web/site/my-profile');

            }
       
            return $this->render('my-profile', [
            'model' => $model,
        ]);


    }

    /*Error page*/
   public function actionError()
    {
        if(Yii::$app->user->isGuest){
            $this->layout = 'error';
            $return_page = 'login';
        }
        else{
            $this->layout = 'dashboard';
            $return_page = 'index';
        }
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception,'return_page' => $return_page]);
        }
    }
    function base64_to_jpeg($img) {

    // open the output file for writing
        Yii::setAlias('@main', dirname(dirname(__DIR__)));
        $list = explode('/', $img['type']);
    
    
        $type = 'jpeg';
        $output_file = $img['name'].'.'.$type;
        $ifp = fopen( Yii::getAlias('@main/').$img['path'].$output_file, 'wb' );
        $ifp = fopen( Yii::getAlias('@main/').$img['path'].$output_file, 'wb' );
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] ==
        $data = explode( ',', $img['src'] );
        
        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( $data[ 0 ] ) );
        // clean up the file resourcefclose( $ifp ); 
         fclose( $ifp );
        return $output_file; 
    }   
}
