<?php

namespace app\models;

use Yii;
use common\models\User as UserCommon;

class Usuarios extends \yii\db\ActiveRecord
{
    public $password;
    CONST STATUS_DELETED = 0;
    CONST STATUS_INACTIVE = 9;
    CONST STATUS_ACTIVE = 10;
    
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            ['password', 'required'],
            ['password', 'string', 'min' => 8],
            [['status', 'created_at', 'updated_at'], 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'verification_token' => Yii::t('app', 'Verification Token'),
        ];
    }
    public function signup() {

        if (!$this->validate()) {
            return null;
        }

        if($this->id != null){
            $user = UserCommon::find()->where(['id'=>$this->id])->one();
            if($this->password != null && $this->password != '' ){
            $user->setPassword($this->password);
            }
        }else{
            $user = new UserCommon();
            $user->setPassword($this->password);
        }
        
        $user->username = $this->username;
        $user->email = $this->email;
        //$user->status = $this->status;
       
        if($this->auth_key == null){
           $user->generateAuthKey();
        }
        if(!$user->save()){
             $this->addErrors($user->getErrors());
             return false;  
        }

       return true;
        
        
    }
    
    //public function rules{}

    /**
     * Gets query for [[Archivos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivos()
    {
        return $this->hasMany(Archivos::className(), ['id_usuario' => 'id']);
    }

    /**
     * Gets query for [[Carpetas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarpetas()
    {
        return $this->hasMany(Carpetas::className(), ['id_usuario' => 'id']);
    }
    public function getStatusArray(){

 	$array = [10=>Yii::t('app', 'Active'),9=>Yii::t('app', 'Inactive')];

 	return $array;

        }
        
    public function getStatusValue(){

        $value = "";

        if(array_key_exists($this->status, $this->getStatusArray())){

            $value = $this->getStatusArray()[$this->status];

        }    

            return $value;

        } 
}
