<?php
namespace backend\models;
use yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;

/**
 * Password reset form
 */
class ChangePasswordForm extends Model
{
    public $current_password;
    public $password;
    public $password_repeat;

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
            ['current_password', 'required'],
            ['current_password', 'string', 'min' => 6],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
            ['password_repeat', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ]
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
    public function updatePassword()
    {
        $user=$this->_user;
        $user->setPassword($this->password);
        return $user->save(false);
    }
}
