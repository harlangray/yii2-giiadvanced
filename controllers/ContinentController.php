<?php

namespace app\controllers;

use Yii;
use app\models\Continent;
use app\models\ContinentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;

/**
 * ContinentController implements the CRUD actions for Continent model.
 */
class ContinentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Continent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContinentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Continent model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Continent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Continent();
        $countryMods = [];
        
        if ($model->load(Yii::$app->request->post())){            
            
            $countryMods = Model::createMultiple(\app\models\Country::classname(), $countryMods);
            Model::loadMultiple($countryMods, Yii::$app->request->post());
            
                
            $valid = $model->validate();
                        $valid = Model::validateMultiple($countryMods) && $valid;
                        
            if ($valid) {
                if ($flag = $model->save(false)) {
                               
                foreach ($countryMods as $countryMod) {
                    $countryMod->cn_continent_id = $model->co_id;
                    if (!($flag = $countryMod->save(false))) {
                        break;
                    }
                }                
                                
                if ($flag) {
                    return $this->redirect(['view', 'id' => $model->co_id]);
                }                
            }

        }
            else{

            }   
        }
        return $this->render('create', [
            'model' => $model,
            'countryMods' => $countryMods,

        ]);
        
        
        /*
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->co_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        */
    }

    /**
     * Updates an existing Continent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $countryMods = $model->countries;
        
        if ($model->load(Yii::$app->request->post())){            
                    $oldcountryIDs = \yii\helpers\ArrayHelper::map($countryMods, 'cn_id', 'cn_id');
            $countryMods = Model::createMultiple(\app\models\Country::classname(), $countryMods);
            Model::loadMultiple($countryMods, Yii::$app->request->post());
            $deletedcountryIDs = array_diff($oldcountryIDs, array_filter(\yii\helpers\ArrayHelper::map($countryMods, 'cn_id', 'cn_id')));
            
                
            $valid = $model->validate();
                        $valid = Model::validateMultiple($countryMods) && $valid;
                        
            if ($valid) {
                if ($flag = $model->save(false)) {
                                if (! empty($deletedcountryIDs)) {
                    \app\models\Country::deleteAll(['cn_id' => $deletedcountryIDs]);
                }                
                foreach ($countryMods as $countryMod) {
                    if (!($flag = $countryMod->save(false))) {
                        break;
                    }
                }                
                                
                if ($flag) {
                    return $this->redirect(['view', 'id' => $model->co_id]);
                }                
            }

        }
            else{

            }   
        }
        return $this->render('update', [
            'model' => $model,
            'countryMods' => $countryMods,

        ]);
        
    }

    /**
     * Deletes an existing Continent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Continent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Continent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Continent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
