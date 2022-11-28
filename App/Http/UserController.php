<?php


// CQRS - COMMAND QUERY
// DATA MAPPER (DOCTRINE, CYCLE)

namespace App\Http;

use App\Core\Routing\RoutesOperator;
use App\User;
use App\UserRepository;
use App\Core\View\View;
use App\Core\System\Helper;
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

    public function create(): string|false
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

    public function showRegForm()
    {
        return View::render('users/registration');
    }

    public function authorization(Request $request): void
    {
        $parameters = $request->getParsedBody();
        $user = (new UserRepository())->getByEmail($parameters['email']);

        $role = (new UserRepository())->getRoleName($user->roleId);
        $subDomain = RoutesOperator::extractSubDomain($_SERVER['HTTP_HOST']);

        if (password_verify($parameters['password'], $user->password) && $role == $subDomain) {
            $key = Helper::randomString(30);
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

    public function registration(Request $request): void
    {
        $parameters = $request->getParsedBody();

        $key = Helper::randomString(30);
        setcookie('auth_key', $key);

        $newUser = new User(
            null,
            $parameters['login'],
            password_hash($parameters['password'], PASSWORD_DEFAULT),
            $parameters['email'],
            1,
            (int) $parameters['role_id'],
            $key
        );

        $entityManager = new EntityManager();

        $entityManager->persist($newUser);
        $entityManager->run();
    }
}