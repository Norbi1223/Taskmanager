<?php

namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StoretaskController extends AbstractController
{
    #[Route('/save', name: 'save')]
    public function Storetask(EntityManagerInterface $entitymanager): Response
    {
        $task = new Task();
        $task->setTitle('Front-end');
        $task->setDescription('Make the Front-end');
        $task->setState(1);

        $entitymanager->persist($task);

        $entitymanager->flush();

        return $this->render('task/homepage.html.twig');
    }
}
