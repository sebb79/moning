<?php

namespace App\Controller;

use App\Repository\ActionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/action', name: 'app_action')]
class WalletController extends AbstractController
{
    #[Route('/', name: '_lister')]
    public function lister(ActionRepository $actionRepository): Response
    {
        $actions = $actionRepository->findAll();


        return $this->render('wallet/action.html.twig', [
            'actions'=> $actions
        ]);
    }
    #[Route('/{id}', name: '_voir', requirements: ['id' => '\d+'])]
    public function voir(ActionRepository $actionRepository, int $id): Response
    {
        return $this->render('action/voir.html.twig', [
            'action' => $actionRepository->find($id)
        ]);
    }
}
