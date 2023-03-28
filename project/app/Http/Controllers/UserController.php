<?php

namespace App\Http\Controllers;

use App\ADMIN\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{

    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function index(int $userID): View
    {
        $user = $this->userRepository->getUserByIDs([$userID]);
        return view('profile.profile', ['user' => current($user)[0]]);
    }
}
