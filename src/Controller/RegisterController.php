<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class RegisterController extends AbstractController
{
    public function __construct(private readonly UserRepository $repo)
    {
    }

    #[Route('/api/auth/register', name: 'app_register', methods: ['POST'])]
    public function index(Request $request, ValidatorInterface $validator): Response
    {
        $user = new User();

        $user->setName($request->get('name'));
        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));
        $user->setPassword($request->get('password'));

        // Validate the user data here if necessary
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        $this->repo->save($user, true);

        return $this->json([
            'message' => 'Registration endpoint is not implemented yet.',
        ]);
    }
}
