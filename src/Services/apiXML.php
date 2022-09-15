<?php


namespace App\Services;

class apiXML
{
	//Lie le fichier XML
	public function xmlToList($file){
		return simplexml_load_file($file);
	}

	//Renvoie un objet Movie et créer les objests Director et Genre
	public function import(){ 
		$repMovie=$this->getDoctrine()->getRepository(Movie::class);
        $repGenre=$this->getDoctrine()->getRepository(Genre::class);
        $repDirector=$this->getDoctrine()->getRepository(Director::class);
        $genres=$repGenre->findAll();
        $directors=$repDirector->findAll();
		$newMovie= new Movie();
		$newMovie->setTitle($movie->title);
		$newMovie->setDescription($movie->description);
		$newMovie->setRuntime(intval($movie->runtime[0]));
		$newMovie->setRate(floatval($movie->rate));
		$newMovie->setYear(intval($movie->year[0]));
		$genreList=explode(',',$movie->genre);
		foreach($genreList as $genre){
			 $newGenre = new Genre();
			 $newGenre->setName($genre);
			 if(!in_array($newGenre, $genres)){
				 
				 $repGenre->add($newGenre);
			 }
			 $newMovie->addGenreList($newGenre);
		}
		$newDirector = new Director();
		$newDirector->setName($movie->director);
		if(!in_array($movie->director, $directors)){
			 
			 $repDirector->add($newDirector);
		}
		$newMovie->addDirector($newDirector);
		return $newMovie;
	}
}