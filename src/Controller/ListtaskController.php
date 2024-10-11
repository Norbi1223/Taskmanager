<?php

namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Controller\FormController;
use Symfony\Component\HttpFoundation\Request;

class ListtaskController extends AbstractController
{
    #[Route('', name: 'homepage')]
    public function listtask(EntityManagerInterface $entityManager, Request $req): Response
    {
        $tasks = $entityManager->getRepository(Task::class);
        if (!$tasks) {
            throw $this->createNotFoundException('No task found');
        }
        $listtasks = $tasks->findAll();
        
        $task = new Task();
        
        $form = $this->createForm(FormController::class, $task);
        
        $form->handleRequest($req);        
        if ($form->isSubmitted() && $form->isValid()) { 
            $task = $form->getData();    
            $entityManager->persist($task);
    
            $entityManager->flush();

            return $this->redirectToRoute('task/homepage.html.twig');
        }
        return $this->render('task/homepage.html.twig', ['tasks' => $listtasks, 'form' => $form]);
    }
}
