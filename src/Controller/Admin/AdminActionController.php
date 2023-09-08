<?php

namespace App\Controller\Admin;

use App\Entity\Action;
use App\Form\ActionType;
use App\Repository\ActionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/action', name: 'app_admin_action')]
class AdminActionController extends AbstractController
{
    #[Route('/', name: '_lister')]
    public function lister(ActionRepository $actionRepository): Response
    {
        $actions = $actionRepository->findAll();
        

        return $this->render('admin/admin_action/index.html.twig', [
            'actions'=> $actions
        ]);
    }

    #[Route('/ajouter', name: '_ajouter')]
    #[Route('/modifier{id}', name: '_modifier')]
    public function editer(Request $request, EntityManagerInterface $entityManager, ActionRepository $actionRepository, int $id = null): response
    {
        if($id == null){
            $action = new Action();
        }else{
            $action = $actionRepository -> find($id);
        }

        $form = $this->createForm(ActionType::class,$action);

        $form->handleRequest($request);

       //Si le form est soumis et est valide

       if($form->isSubmitted() && $form->isValid()){

        //Traitement des données
        $entityManager->persist($action);
        $entityManager->flush();
        $this->addFlash('success', 'L\'action a été créé avec succès.');
        return $this->redirectToRoute('app_admin_action_lister');

       }
        return $this->render('admin/admin_action/editerAction.html.twig', [
            'form' => $form
        ]);
    }
    

    #[Route('/supprimer/{id}', name: '_supprimer')]
   public function supprimer(EntityManagerInterface $entityManager, ActionRepository $actionRepository, int $id): RedirectResponse
   {
        $action = $actionRepository -> find($id);
        $entityManager->remove($action);
        $entityManager->flush();
        $this->addFlash('success', 'L\'action a été supprimé avec succès.');
       return $this->redirectToRoute('app_admin_action_lister');
   }
}
