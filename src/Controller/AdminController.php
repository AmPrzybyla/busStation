<?php

namespace App\Controller;


use App\Entity\Station;
use App\Repository\StationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{

    /**
     * @var StationRepository
     */
    private $stationRepository;

    public function __construct(StationRepository $stationRepository)
    {
        $this->stationRepository = $stationRepository;
    }

    /**
     * @Route("/list", name="admin_list")
     */
    public function listOfNotification()
    {
        return $this->render('admin/list.html.twig', ['notifications'=>$this->stationRepository->findBy([],['id'=>'DESC'])]);
    }

    /**
     * @Route("/listunread", name="admin_list_unread")
     */
    public function listOfUnreadNotification()
    {
        return $this->render('admin/list.html.twig', ['notifications'=>$this->stationRepository->findNotRead()]);
    }

    /**
     * @Route("/view/{id}", name="admin_view")
     */
    public function viewNotification(Station $station)
    {

        if($station->getReaded()==false){
            $eM= $this->getDoctrine()->getManager();
            $station->setReaded(true);
            $eM->flush();

        }
        return $this->render('admin/station.html.twig', ['station'=>$station]);

    }


}