<?php
namespace backend\models;
use yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ProfileForm extends Model
{
    public $username;
    public $email;
    public $profilepicture;
    public $profile_picture;
   

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidParamException if token is empty or not valid
     */
    

    public function __construct($id, $config = [])
    {
        if (empty($id)) {
            throw new InvalidParamException('Id cannot be blank.');
        }
        $this->_user = User::findIdentity($id);
        if (!$this->_user) {
            throw new InvalidParamException('Invalid user id.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'string', 'min' => 5],
            ['email', 'required'],
            ['email', 'email'],

            ['profilepicture', 'file','extensions'=>'jpg, jpeg, png'],
            [['profilepicture'], 'file', 'skipOnEmpty' => true],
            ['profilepicture', 'safe'],

            
        ];
    }
    
    public function validatePassword()
    {
        $user = $this->_user;
        $check = Yii::$app->security->validatePassword($this->current_password,$user->password_hash);
        if(!$check)
        {            
            $this->addError('current_password', 'Invalid Current Password.');
            return false;
        }
        else
        {
            return true;
        }

    }
    /**
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function updateProfile()
    {
        $user=$this->_user;
        $user->email = $this->email; 
        $user->username = $this->username;
        if(!empty($this->profile_picture))
        {
         $user->profile_picture = $this->profile_picture;
        }
        
        return $user->save(false);
    }
}
