<?php

namespace App\Http\Controllers\Auth;

use App\ADMIN\Repositories\PasswordResetRepository;
use App\ADMIN\Repositories\UserRepository;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RecoveryPasswordRequest;
use App\Mail\RecoveryPassword;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class LoginUserController
{
    public PasswordResetRepository $passwordResetRepository;
    public UserRepository $userRepository;
    public User $user;

    public function __construct()
    {
        $this->user = new User();
        $this->userRepository = new UserRepository();
        $this->passwordResetRepository = new PasswordResetRepository();
    }

    public function index(): View
    {
        return view("forms.authorize");
    }

    public function store(LoginUserRequest $request): RedirectResponse
    {
        $rememberMeFlag = !!$request->input('rememberMe');

        $validated = $request->validated();

        if (Auth::attempt($validated, $rememberMeFlag)) {
            return redirect(route("home"));
        }
        return redirect("/")
            ->withErrors(["message" => "Введен неверный логин или пароль"]);
    }

    public function destroy(): RedirectResponse
    {
        Auth::logout();
        return redirect(route("home"));
    }

    public function recovery(): View
    {
        return view("forms.recovery");
    }

    public function sendRecoveryMessage(RecoveryPasswordRequest $request)
    {
        $validated = $request->validated();

        $user = $this->userRepository->getUserByEmail($validated['email']);

        if (!empty($user->all())) {
            $accessToken = $this->user->generateAccessToken();
            $this->passwordResetRepository->addAccessTokenForRecovery($validated['email'], $accessToken);

            Mail::to($validated['email'])->send(new RecoveryPassword($user->all()[0]['name'], $accessToken));
            return redirect(route("authorize.recovery"))
                ->with(["message" => "Письмо с восстановлением пароля отправлено на указаную вами почту"]);
        }

        return redirect(route("authorize.recovery"))
            ->withErrors(["message" => "Проверьте правильность введённого Вами Email"]);
    }
}
