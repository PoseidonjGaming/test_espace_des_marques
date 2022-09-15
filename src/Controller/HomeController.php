<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Movie;
use App\Entity\Genre;
use App\Entity\Director;
use App\Services\apiXML;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $rep = $this->getDoctrine()->getRepository(Movie::class);
        $movies=$rep->findAll();
        return $this->render('home/index.html.twig', [
            'movies' => $movies,
        ]);
    }
    /**
     * @Route("/import", name="import")
     */
    public function import(apiXML $api): Response
    {

        
        $listXml=$api->xmlToList($_FILES['fichierMovie']['tmp_name']);
        $repMovie=$this->getDoctrine()->getRepository(Movie::class);
        $repGenre=$this->getDoctrine()->getRepository(Genre::class);
        $repDirector=$this->getDoctrine()->getRepository(Director::class);
        $genres=$repGenre->findAll();
        $directors=$repDirector->findAll();
        $entityManager = $this->getDoctrine()->getManager();
        //ini_set('max_execution_time', 0);
        foreach($listXml as $movie){
           /*$movie= new Movie();
           $movie->setTitle($movie->title);
           $movie->setDescription($movie->description);
           $movie->setRuntime($movie->runtime);
           $movie->setRate(floatval($movie->rate));
           $movie->setYear($movie->year);
           $genreList=$movie->genre->split(',');
           foreach($genreList as $genre){
                if(!in_array($genre, $genres)){
                    $newGenre = new Genre();
                    $newGenre->setName($genre);
                    $repGenre->add($newGenre);
                }
                $movie->addGenreList($genre);
           }
           if(!in_array($movie->director, $directors)){
                $newDirector = new Director();
                $newDirector->setName($genre);
                $repDirector->add($newGenre);
           }
           $movie->setDirector($movie->director);
           $repMovie->add($movie);*/
           dump($movie);
        }

        //return $this->redirectToRoute('home');
        return $this->render('home/test.html.twig', [
            
        ]);
    }
}
