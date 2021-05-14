<?php

namespace common\models;

use Yii;
use yii\db\Query;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

/**
 * User model
 *
 * @property integer $id
 * @property string $fullname
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const STATUS_ATIVO = 'Ativo';
    const STATUS_INATIVO = 'Inativo';

    const SCENARIO_SENHA = 'SENHA';
    const SCENARIO_UPLOAD = 'UPLOAD';

    public $newPassword;
    public $currentPassword;
    public $newPasswordConfirm;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['created_by', 'updated_by'], 'integer'],
            ['email', 'email'],
            [['username', 'email'], 'unique'],
            [['fullname', 'created_at', 'updated_at'], 'safe'],
            [['currentPassword','newPassword','newPasswordConfirm'],'required', 'on' => self::SCENARIO_SENHA],
            ['currentPassword','validateCurrentPassword', 'on' => self::SCENARIO_SENHA],
            [['newPassword','newPasswordConfirm'], 'string', 'min' => 6, 'on' => self::SCENARIO_SENHA],
            [['newPassword','newPasswordConfirm'], 'filter', 'filter' => 'trim', 'on' => self::SCENARIO_SENHA],
            ['newPasswordConfirm','compare','compareAttribute'=>'newPassword','message'=>'A senha não pode ser diferente.', 'on' => self::SCENARIO_SENHA],
        ];
    }

    public function validateCurrentPassword()
    {
        if (!$this->verifyPassword($this->username, $this->currentPassword)) {
            $this->addError("currentPassword", "Senha Incorreta.");
        }
    }

    public function verifyPassword($username, $password)
    {
        $dbPassword = static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE])->password_hash;
        return Yii::$app->security->validatePassword($password, $dbPassword);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Nome Completo',
            'username' => 'Login',
            'email' => 'E-mail',
            'currentPassword' => 'Senha Atual',
            'newPassword' => 'Senha Nova',
            'newPasswordConfirm' => 'Senha Confirmação',
            'created_by' => 'Cadastrado Por',
            'created_at' => 'Cadastrado Em',
            'updated_by' => 'Alterado Por',
            'updated_at' => 'Alterado Em',
        ];
    }

    /**
     * @return \yii\db\Query
     */
    public function getAtribuicao($user_id)
    {
        return (new Query)->from('auth_assignment')->where(['user_id' => $user_id])->count();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * retorna o nome do usuario
     * @return string
     */
    public function getNomeUsuario($id)
    {
        if ($id) {
            $user = self::findOne(['id' => $id]);
            return !is_null($user) ? $user->username : null;
        } else {
            return null;
        }
    }

    public function getUserByRole(array $paper)
    {
        return (new Query)->from('auth_assignment')
            ->innerJoin('user', 'auth_assignment.user_id=user.id')
            ->where(['in', 'item_name', $paper])
            ->andWhere(['status'=>User::STATUS_ACTIVE])
            ->orderBy(['fullname' => SORT_ASC])
            ->groupBy('username')
            ->all();
    }

    public static function getPapersById($id)
    {
        $listaFilhos = [];

        $query = (new Query)->from('auth_assignment')->where(['user_id' => $id])->all();

        foreach ($query as $valor) {
            $listaFilhos[$valor['item_name']] = $valor['item_name'];
        }

        return $listaFilhos;
    }

    /**
     * 
     * @return boolean
     */
    public function isDeveloper() {
        // verifica se o usuario tem permissão para acessar a action requisitada.
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        return isset($roles['desenvolvedor']);
    }

    /**
     * 
     * @return boolean
     */
    public function isAdmin() {
        // verifica se o usuario tem permissão para acessar a action requisitada.
        $roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->id);
        return isset($roles['admin']);
    }

    /**
     * Lista os status
     */
    public function listarStatus()
    {
        return [10 => 'ATIVO', 0 => 'INATIVO'];
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->generateAuthKey();
        }
        return parent::beforeSave($insert);
    }

}
