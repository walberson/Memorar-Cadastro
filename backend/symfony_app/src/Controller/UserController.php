<?php

namespace App\Controller;


use App\Entity\UserSystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/users", methods={"GET"})
     */
    public function getUsers(){

        $users = $this->getDoctrine()
            ->getRepository(UserSystem::class)
            ->findAll();

        $serializer = $this->get('serializer');
        $data = $serializer->serialize($users, 'json');
        return new Response($data, 200, [
            'Access-Control-Allow-Origin' => 'http://localhost:8080'
        ]);

    }

    /**
     * @Route("/users", methods={"POST"})
     */
    public function postUsers(Request $request):Response
    {

        $user = new UserSystem();
        $user-> setName($request->get('name'));
        $user-> setPhone($request->get('phone'));
        $user-> setEmail($request->get('email'));
        $user-> setBirthDate(new \Datetime($request->get('birthDate')));
        $user-> setPassword($request->get('pass'));
        $user-> setCPF($request->get('cpf'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager ->persist($user);
        $entityManager->flush();


            return new Response ('Inserido com sucesso!', 200, [
                'Access-Control-Allow-Origin' => 'http://localhost:8080'
            ]);

    }

}