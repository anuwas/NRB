<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
	/**
	 * @var UploadedFile
	 */
	public $imageFile;

	public function rules()
	{
		return [
				[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
		];
	}

	public function upload()
	{
		$filename='';
		$rnd  = rand(0,9999);
		/* if ($this->validate()) {
			$filename=$rnd.'_'.$this->imageFile->baseName . '.' . $this->imageFile->extension;
			$this->imageFile->saveAs('uploads/' . $filename);
			chmod("uploads/".$filename, 775);
			return $filename;
		} else {
			return false;
		} */
		
		$filename=$rnd.'_'.$this->imageFile->baseName . '.' . $this->imageFile->extension;
		$this->imageFile->saveAs('uploads/event/' . $filename);
		chmod("uploads/event/".$filename, 775);
		
		
		return $filename;
	}
	
	public function galleryUpload(){
		$filename='';
		$rnd  = rand(0,9999);
		
		$filename=$rnd.'_'.$this->imageFile->baseName . '.' . $this->imageFile->extension;
		$this->imageFile->saveAs('uploads/gallery/' . $filename);
		chmod("uploads/gallery/".$filename, 775);
		
				
		return $filename;
	}
	
	public function featuregalleryUpload(){
		$filename='';
		$rnd  = rand(0,9999);
	
		$filename=$rnd.'_'.$this->imageFile->baseName . '.' . $this->imageFile->extension;
		$this->imageFile->saveAs('uploads/featuregallery/' . $filename);
		chmod("uploads/featuregallery/".$filename, 775);
	
	
		return $filename;
	}
}