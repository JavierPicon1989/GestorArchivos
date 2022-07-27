<?php

namespace frontend\controllers;

use app\models\Archivos;
use frontend\models\ArchivosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use yii\web\UploadedFile;
use Yii;

/**
 * ArchivosController implements the CRUD actions for Archivos model.
 */
class ArchivosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new ArchivosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,           
        ]);        
    }
    public function actionDownload($id) 
    { 
    $model = $this->findModel($id);
    $path=Yii::getAlias('@webroot').'/'.$model->ruta;
    if (file_exists($path)) {

        return Yii::$app->response->sendFile($path);

    }else{
        throw new NotFoundHttpException("No se pudo encontrar el archivo {$model->ruta}");
    }
    }
    ///////////////////////////////////////////////
     public function actionFolder($id, $nombre, $id_subcarpeta)
    {
        $searchModel = new ArchivosSearch();
        $dataProvider = $searchModel->searchcarpeta
                ($this->request->queryParams,
                $id);
        
        $searchModelS = new \frontend\models\CarpetasSearch();
        $dataProviderS = $searchModelS->searchsubcarpeta
                ($this->request->queryParams,
                $id);
        
        
        return $this->render('folder', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelS' => $searchModelS,
            'dataProviderS' => $dataProviderS,
            'nombre' => $nombre,
            'idF' => $id,
            'id_subcarpeta' => $id_subcarpeta,
        ]);
    }
    
    public function actionView($id)
    {
        ////////////////////////////////////////////////////
        $cnx = Yii::$app->get('db');
        ////////////////////////////////////////////////////
         $sqlRuta= $cnx->createCommand('SELECT 
                               ruta
                            FROM
                                archivos
                            WHERE
                                id = :id', [':id' => $id])
                        ->queryAll();
                foreach ($sqlRuta as $ru){
                    $ruta = $ru['ruta'];
                }        
        
        return $this->redirect([$ruta, 'target' => '_blank']);
    }    
    
    
    
    ///////////////////////////////////////////////////////
    public function actionViewInCarpeta($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    ///////////////////////////////////////////////////////
    public function actionCreate($id_carpeta)
    {
        $model = new Archivos();
        
        $this->subirArchivo($model, $id_carpeta);
        
        return $this->render('create', [
            'model' => $model,
            'id_carpeta' => $id_carpeta,
        ]);
    }
    //////////////////////////////////////////////////////
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $this->subirArchivo($model);

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(file_exists($model->ruta)){            
            unlink($model->ruta);            
        }
                
        $model->delete();

        return $this->redirect(['/carpetas/index']);
    }

    /**
     * Finds the Archivos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_archivo Id Archivo
     * @return Archivos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    public function actionLista() {
        
        $model = Archivos::find();
        
        $paginacion = new Pagination([
            'defaultPageSize' => 1,
            'totalCount' => $model->count()
        ]);
        $archivos= $model->orderBy('nombre')->offset($paginacion->offset)->limit($paginacion->limit)->all();
        
        return $this->render('lista', ['archivos'=>$archivos, 'paginacion'=>$paginacion]);
        
    }
    
    
    protected function findModel($id)
    {
        if (($model = Archivos::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    
    public function nombreCarpeta($id_carpeta) {
        $data = \app\models\Carpetas::findOne($id_carpeta);
        
        return $data->nombre;
        
    }
    public function idsubCarpeta($id_carpeta) {
        $data = \app\models\Carpetas::findOne($id_carpeta);
        
        return $data->id_subcarpeta;
        
    }
    
    protected function subirArchivo(Archivos $model, $id_carpeta) {
        
        date_default_timezone_set("America/Argentina/La_Rioja");
        $fecha = date('Y-m-d');
        $isc= $this->idsubCarpeta($id_carpeta);
        if($isc == 0){        
        $nombre = $this->nombreCarpeta($id_carpeta);
        }else{
        $data = \app\models\Carpetas::findOne($isc);
        
        $nombre = $data->nombre.'/'.$this->nombreCarpeta($id_carpeta);    
        }
        if ($this->request->isPost) {
            if ($model->load($this->request->post())){
                $model->archivo= UploadedFile::getInstance($model, 'archivo');
                
                if($model->validate()){                  
                                        
                    if($model->archivo){
                        
                        if(file_exists($model->ruta)){
                            unlink($model->ruta);                            
                        }
                        
                      $rutaArchivo = 'uploads/'.$nombre.'/'.$fecha."_".$model->archivo->baseName.".".$model->archivo->extension;
                      
                          if($model->archivo->saveAs($rutaArchivo)){

                              $model->ruta=$rutaArchivo;

                          }
                    }
                    
                }
                if($model->save(false)){
                    
                    return $this->redirect(['/carpetas']);
                    
                }
                                
            }
        } else {
            $model->loadDefaultValues();
        }
    }
    
}
