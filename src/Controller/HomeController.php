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
        
        $entityManager = $this->getDoctrine()->getManager();
        ini_set('max_execution_time', 0);
        foreach($listXml as $movie){
          
           $repMovie->add(import());
           //dump($movie->year);
        }

        //return $this->redirectToRoute('home');
        return $this->render('home/test.html.twig', [
            
        ]);
    }
     /**
     * @Route("/detail_movie/{id}", name="detail_movie")
     */
    public function detail_movie($id): Response
    {
        $rep = $this->getDoctrine()->getRepository(Movie::class);
        $movie=$rep->find($id);
        return $this->render('movie/detail_movie.html.twig', [
            'movie' => $movie,
        ]);
    }
    
}
