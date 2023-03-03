<?php

namespace app\controllers;

use app\models\Upload;
use app\models\UploadForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => new ActiveDataProvider([
                'query' => Upload::find(),
            ]),
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpload()
    {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->files = UploadedFile::getInstances($model, 'files');

            if ($model->upload()) {
                Yii::$app->session->setFlash('success', 'Success!');

                return $this->goHome();
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    protected function findModel($id)
    {
        if (($model = Upload::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
