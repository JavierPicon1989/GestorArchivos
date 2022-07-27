<?php

namespace frontend\controllers;

use app\models\Carpetas;
use frontend\models\CarpetasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\ArchivosSearch;


/**
 * CarpetasController implements the CRUD actions for Carpetas model.
 */
class CarpetasController extends Controller
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

    /**
     * Lists all Carpetas models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CarpetasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
       

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionIndexsub()
    {
        $searchModel = new CarpetasSearch();
        $dataProvider = $searchModel->searchsub($this->request->queryParams);
       

        return $this->render('indexsub', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Carpetas model.
     * @param int $id_carpeta Id Carpeta
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
                return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    ///////////////////////////////////////////////
    public function actionFolder($id, $nombre)
    {
        
        $searchModel = new ArchivosSearch();
        $dataProvider = $searchModel->searchcarpeta
                ($this->request->queryParams,
                $id);
    

        return $this->render('/archivos/folder', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'nombre' => $nombre,
        ]);
    }
    
    /**
     * Creates a new Carpetas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Carpetas();

        //if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                if($model->save()){
                    \yii::$app->session->setFlash("success", "Carpeta creada con exito!");
                    $this->crearCarpeta($model->nombre);
                }else{
                    \yii::$app->session->setFlash("error", "Ha ocurrido un error al crear la carpeta!");
                }
                
                return $this->redirect(['index', 'id' => $model->id]);
            }
            else{
        return $this->render('create', [
            'model' => $model,
        ]);
            }
    }
    
    public function actionCreate_sc($idSc)
    {
        $model = new Carpetas();

            if ($model->load($this->request->post()) ) {
                if($model->save()){
                    \yii::$app->session->setFlash("success", "Carpeta creada con exito!");
                    $this->crearSubcarpeta($model->nombre, $idSc);
                }else{
                    \yii::$app->session->setFlash("error", "Ha ocurrido un error al crear la carpeta!");
                }
                
                return $this->redirect(['index', 'id' => $model->id]);
            }
            else{
        return $this->render('create_sc', [
            'model' => $model,
            'idSc' => $idSc,
        ]);
            }
    }

   
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    
    protected function findModel($id)
    {
        if (($model = Carpetas::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    /////////////////////////////////////////////////////////////////////////////////
    protected function crearCarpeta($nombreCarpeta)
    {
        $carp = 'uploads/'.$nombreCarpeta;
        
             if(!is_dir($carp)){

                 $crear = mkdir($carp, 0777,true);
                 if($crear){
                 echo "Se creo el directorio $nombreCarpeta";
                 }
             }else{
                 echo "La carpeta $nombreCarpeta ya esxiste";
             }
     
    }
    protected function crearSubcarpeta($nombreCarpeta,$idSc)
    {
        $model = new Carpetas();
        $carpeta = $this->findModel($idSc);
        
        $carp = 'uploads/'.$carpeta->nombre;
        if(is_dir($carp)){
            $carp2 = $carp.'/'.$nombreCarpeta;
        
             if(!is_dir($carp2)){

                 $crear = mkdir($carp2, 0777,true);
                 if($crear){
                 echo "Se creo el directorio $nombreCarpeta";
                 }
             }else{
                 echo "La carpeta $nombreCarpeta ya esxiste";
             }
        }
     
    }
    
}
////////////////////////////////////////////////////////////////////////////////////





