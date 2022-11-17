<?php


// CQRS - COMMAND QUERY
// DATA MAPPER (DOCTRINE, CYCLE)

namespace App\Http;

use App\User;
use App\UserRepository;
use App\Core\View\View;
use App\Core\Routing\Request;
use App\Core\Routing\Response;
use App\Core\Database\EntityManager;

class UserController
{
    public function all(): string|false
    {
        $userRepository = new UserRepository();
        $users = $userRepository->all();

        return View::render('users/index', [
            'users' => $users
        ]);
    }

    public function create(Request $request): string|false
    {
        return View::render('users/create');
    }

    public function add(Request $request): void
    {
        $formData = $request->getParsedBody();

        $newUser = new User(
            null,
            $formData['login'],
            password_hash($formData['password'], PASSWORD_DEFAULT),
            $formData['email'],
            1,
        );

        $entityManager = new EntityManager();

        $entityManager->persist($newUser);
        $entityManager->run();

        (new Response)->redirect('/users');
    }

    public function edit(Request $request): string|false
    {
        $userRepository = new UserRepository();
        $id = $request->getAttribute('id');

        $user = $userRepository->getById((int)$id);
        return View::render('users/update', [
            'user' => $user
        ]);

    }

    public function update(Request $request): void
    {
        $id = $request->getAttribute('id');
        $formData = $request->getParsedBody();
        $userRepository = new UserRepository();
        $user = $userRepository->getById($id);

        $user->login = $formData["login"];
        $user->password = password_hash($formData['password'], PASSWORD_DEFAULT);
        $user->email = $formData["email"];


        $entityManager = new EntityManager();

        $entityManager->persist($user);
        $entityManager->run();

        (new Response)->redirect('/users');
    }

    public function delete(Request $request): void
    {

        $id = $request->getAttribute('id');
        $userRepository = new UserRepository();
        $user = $userRepository->getById($id);

        $entityManager = new EntityManager();

        $entityManager->delete($user);
        $entityManager->run();

        (new Response)->redirect('/users');
    }

    public function show(Request $request): string|false
    {
        $id = $request->getAttribute("id");

        $user = (new UserRepository())->getById($id);

        return View::render('users/detail', [
            'user' => $user
        ]);
    }

    public function showAuthForm(): string|false
    {
        return View::render('users/sign_in');
    }

    public function authorization(Request $request): void
    {
        $parameters = $request->getParsedBody();
        $user = (new UserRepository())->getByEmail($parameters['email']);


        if (password_verify($parameters['password'], $user->password)) {
            $key = $this->randomString();
            setcookie('auth_key', $key);
            $user->authKey = $key;

            $manager = new EntityManager();
            $manager->persist($user);
            $manager->run();

            (new Response())->redirect("/users");
        } else {
            echo "<title> Wrong Password </title>";
            echo "<h1 align='center'><font face='sans-serif'> WRONG PASSWORD </font></h1>";
        }
    }

    private function randomString(): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randString = '';
        for ($i = 0; $i < 30; $i++) {
            $randString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randString;
    }
}