<?php

namespace app\controllers\api;

use app\models\Upload;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UploadController extends Controller
{
    public function actionIndex()
    {
        $query = Upload::find();

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $uploads = $query->select(['id', 'filename'])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->asJson([
            'page' => $pagination->getPage() + 1,
            'list' => $uploads,
        ]);
    }

    public function actionView($id)
    {
        $model =  $this->findModel($id);

        return $this->asJson([
            'id' => $model->id,
            'filename' => $model->filename,
        ]);
    }

    public function actionCount()
    {
        return $this->asJson(['total' => Upload::find()->count()]);
    }

    protected function findModel($id)
    {
        if (($model = Upload::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
