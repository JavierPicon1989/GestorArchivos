<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carpetas".
 *
 * @property int $id_carpeta
 * @property int $id_usuario
 * @property string $nombre
 * @property string $fechaInsert
 *
 * @property Archivos[] $archivos
 * @property User $usuario
 */
class Carpetas extends \yii\db\ActiveRecord
{
    //public $tipoArchivo = "ima/folder.png";
    
    public static function tableName()
    {
        return 'carpetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'nombre','fechaInsert','hora'], 'required'],
            [['id_usuario', 'id_subcarpeta'], 'integer'],
            [['nombre', 'logo'], 'string', 'max' => 255],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['id_usuario' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id Carpeta'),
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'nombre' => Yii::t('app', 'Nombre de la carpeta'),
            'fechaInsert' => Yii::t('app', 'Fecha de creación'),
            'hora' => Yii::t('app', 'Hora'),
            'logo' => Yii::t('app', 'Logo'),
            'id_subcarpeta' => Yii::t('app', 'Sub carpeta'),
        ];
    }

    /**
     * Gets query for [[Archivos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArchivos()
    {
        return $this->hasMany(Archivos::className(), ['id' => 'id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'id_usuario']);
    }
    
     public function getCarpetas(){

        return ArrayHelper::map(Carpetas::find()->all(), 'id', 'nombre');

    }
    public function obtenerNombre($id){
        if($this->id_carpeta == $id){
            return $this->nombre;
        }
    }

}

    