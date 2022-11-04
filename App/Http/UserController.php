<?php


// CQRS - COMMAND QUERY
// DATA MAPPER (DOCTRINE, CYCLE)

namespace App\Http;

use App\Core\Database\EntityManager;
use App\Core\Routing\Request;
use App\Core\View\View;
use App\User;
use App\UserRepository;

class UserController
{


    public function all() //array
    {
        $userRepository = new UserRepository();
        $users = $userRepository->all();

        return View::render('users/index', [
            'users' => $users
        ]);

        //return $users;
    }

    public function create(Request $request)
    {
        return View::render('users/create', []);
    }

    public function add(Request $request)
    {
        $formData = $request->getParsedBody();

        $newUser = new User(
            null,
            $formData['login'],
            $formData['password'],
            $formData['email'],
            1);
//        $userRepository = new UserRepository();
//        $userRepository->add($newUser);

        $entityManager = new EntityManager();

        $entityManager->persist($newUser);
        $entityManager->run();

        $this->all();
    }

    public function edit(Request $request)
    {
        $userRepository = new UserRepository();
        $id = $request->getAttribute('id');

        $user = $userRepository->getById((int) $id);
        return View::render('users/update', [
            'user' => $user
        ]);

    }

    public function update(Request $request)
    {
        $id = $request->getAttribute('id');
        $formData = $request->getParsedBody();
        $userRepository = new UserRepository();
        $user = $userRepository->getById($id);

        $user->login = $formData["login"];
        $user->password = $formData["password"];
        $user->email = $formData["email"];


        $entityManager = new EntityManager();

        $entityManager->persist($user);
        $entityManager->run();

        $this->all();
    }

    public function delete(Request $request)
    {

        $id = $request->getAttribute('id');
        $userRepository = new UserRepository();
        $user = $userRepository->getById($id);

        $entityManager = new EntityManager();

        $entityManager->delete($user);
        $entityManager->run();

        $this->all();
    }

    public function show(Request $request)
    {
        $id = $request->getAttribute("id");

        $user = (new UserRepository())->getById($id);

        return View::render('users/detail', [
            'user' => $user
        ]);
    }

}