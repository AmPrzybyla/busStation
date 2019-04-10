<?php

namespace App\Controller;


use App\Entity\File;
use App\Entity\Station;
use App\Form\StationType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyInfo\Tests\Extractor\ReflectionExtractorTest;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home_index")
     */
    public function index()
    {
        return $this->redirectToRoute('home_add_station');
    }

    /**
     * @Route("/addStation" , name="home_add_station")
     */
    public function addStation(Request $request)
    {

        $station= new Station();
        $form=$this->createForm(StationType::class, $station);

        $form->handleRequest($request);

        $station->setReaded(false);
        $station->setUserId(1);
       // dd($station);


        if($form->isSubmitted() && $form->isValid())
        {
            $em= $this->getDoctrine()->getManager();

            $files=new ArrayCollection();
            foreach($request->files->get('station')['attachFile'] as $file)
            {
                $fileName=md5(uniqid()).'.'.$file->guessExtension();

                $file->move($this->getParameter('file_directory'),$fileName);

                $fil=new File();
                $fil->setName($fileName);
                $fil->setStation($station);
                $files->add($fil);
            }
           // dd($station);
            $station->setFiles($files);
            $em->persist($station);
            $em->flush();

            return $this->redirect('/');

        }


        return $this->render('/home/add.html.twig',['form'=>$form->createView()]);
    }
}