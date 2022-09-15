<?php


namespace App\Services;

class apiXML
{
	public function xmlToList($file){
		return simplexml_load_file($file);
	}
}