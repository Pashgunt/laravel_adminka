<?php

namespace App\Http\Controllers\Auth;

use App\ADMIN\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegisterUserController extends Controller
{

    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): View
    {
        return view("forms.register");
    }

    public function verify(): View
    {
        return view("forms.verifyRegister");
    }

    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();

        $user = $this->userRepository->createUser($validated);

        event(new Registered($user));

        return redirect(route("verification.notice"));
    }

    public function verifyEmail(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect(route("home"));
    }

    public function sendEmailAgain(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
