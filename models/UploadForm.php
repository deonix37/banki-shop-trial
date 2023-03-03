<?php

namespace app\models;

use yii\base\Model;
use yii\helpers\BaseInflector;
use yii\helpers\FileHelper;

class UploadForm extends Model
{
    public $files;

    public function rules()
    {
        return [
            ['files', 'required'],
            ['files', 'image', 'maxFiles' => 5],
        ];
    }

    public function upload()
    {
        if (!$this->validate()) {
            return false;
        }

        FileHelper::createDirectory('uploads');

        foreach ($this->files as $file) {
            $upload = new Upload();
            $upload->filename = strtolower(
                BaseInflector::transliterate($file->baseName)
            ) . ".$file->extension";

            $exists = Upload::find()
                ->where(['filename' => $upload->filename])
                ->exists();

            if ($exists) {
                $upload->filename = uniqid() . "_$upload->filename";
            }

            if ($upload->save()) {
                $file->saveAs("uploads/$upload->filename");
            }
        }

        return true;
    }
}
