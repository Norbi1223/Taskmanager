<?php
namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ListtaskController extends AbstractController
{
    #[Route('',name:'homepage')]
    public function listtask(EntityManagerInterface $entityManager): Response
    {
        $tasks = $entityManager->getRepository(Task::class);
        if (!$tasks) {
            throw $this->createNotFoundException(
                'No task found'
            );
        }
        $listtasks = $tasks->findAll();
        return $this->render('task/homepage.html.twig',['tasks' => $listtasks]);
    }
}