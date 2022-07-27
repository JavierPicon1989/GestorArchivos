<?php

namespace app\models;

use Yii;

class Archivos extends \yii\db\ActiveRecord
{
    public $archivo;
   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'archivos';
    }

    public function rules()
    {
        return [
            [['id_carpeta', 'id_usuario'], 'integer'],
            [['fecha','hora', 'numeroMedidor', 'unidad', 'logo'], 'safe'],
            [['archivo'], 'file','extensions'=> 'jpg,png,pdf'],
            [['id_usuario','id_carpeta', 'numeroMedidor','unidad' ], 'required'],
            [['nombre'], 'string', 'max' => 255],
            [['id_carpeta'], 'exist', 'skipOnError' => true, 'targetClass' => Carpetas::className(), 'targetAttribute' => ['id_carpeta' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios
                ::className(), 'targetAttribute' => ['id_usuario' => 'id']],
            
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Archivo'),
            'id_carpeta' => Yii::t('app', 'Carpeta'),
            'nombre' => Yii::t('app', 'Nombre del archivo'),
            'fecha' => Yii::t('app', 'Fecha de creacion'),
            'hora' => Yii::t('app', 'Hora'),
            'archivo' => Yii::t('app', 'Archivo'),
            'id_usuario' => Yii::t('app', 'Id Usuario'),
            'numeroMedidor' => Yii::t('app', 'Número de Medidor'),
            'unidad' => Yii::t('app', 'Unidad'),
            'logo' => Yii::t('app', 'Logo'),
            
        ];
    }

    public function getCarpeta()
    {
        return $this->hasOne(Carpetas::className(), ['id_carpeta' => 'id_carpeta']);
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
    
    
}
