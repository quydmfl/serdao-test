<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use App\UseCase\User\AddUseCase;
use App\UseCase\User\DeleteUseCase;
use App\UseCase\User\IndexUseCase;

class UserController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/user', name: 'user_index', methods: ['GET', 'POST'])]
    public function index(Request $request, IndexUseCase $indexUseCase, AddUseCase $addUseCase)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addUseCase($user->getFirstName(), $user->getLastName(), $user->getAddress());

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/index.html.twig', [
            'users' => $indexUseCase(),
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/delete/{id}', name: 'user_delete', methods: ['POST', 'DELETE'])]
    public function delete(int $id, DeleteUseCase $deleteUseCase)
    {
        if ($deleteUseCase($id)) {
            return $this->redirectToRoute('user_index');
        };

        return $this->redirectToRoute('user_index'); // Remove to show error
    }
}
