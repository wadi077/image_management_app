<?php

namespace app\models;

use Yii;

use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $status
 */
class ImageUpload extends \yii\db\ActiveRecord
{

    public $photoNewName;
    //public $name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user_id', 'status'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['name'], 'safe'],
            [['name'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Image',
            'user_id' => 'User ID',
            'status' => 'Status',
        ];
    }

    public function upload()
    {
        if ( $this->validate() ) {
            
            $this->name->extension.'====';
            $this->photoNewName = md5($this->name->baseName.time()). '.' . $this->name->extension;
                        
            $this->name->saveAs('uploads/' . $this->photoNewName );
            
            Image::getImagine()->open('uploads/' . $this->photoNewName)->thumbnail(new Box(55, 100))->save('uploads/thumbs/' . $this->photoNewName , ['quality' => 100]);
            return $this->photoNewName;
        } else {
            return false;
        }
    }
}
