<?php

namespace App\Http\Controllers;

use App\ADMIN\Repositories\PasswordResetRepository;
use App\ADMIN\Repositories\UserRepository;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class RecoveryPasswordController extends Controller
{

    public PasswordResetRepository $passwordResetRepository;
    public UserRepository $userRepository;

    public function __construct()
    {
        $this->passwordResetRepository = new PasswordResetRepository();
        $this->userRepository = new UserRepository();
    }

    public function store(Request $request): View
    {
        $email = $this->passwordResetRepository->checkIssetAccessToken($request->get('access_token'));
        if (!empty($email->all())) {
            return view('forms.changePassword')->with('email', $email->all()[0]['email']);
        }
        return view('specials.404');
    }

    public function changePassword(ForgotPasswordRequest $request): Redirector
    {
        $validated = $request->validated();

        $token = $this->passwordResetRepository->checkIssetTokenByEmail($validated['email'])->all();
        $user = $this->userRepository->checkIssetUserByEmail($validated['email'])->all();

        if (!empty($token) && !empty($user)) {
            $this->passwordResetRepository->deleteAccessTokenByEmailAddress($validated['email']);
            $this->userRepository->updatePasswordForUser($validated['email'], $validated['password']);
            return redirect(route('authorize.page'))->with('successRecoveryPassword', 'Пароль успешно изменен можете повторить попытку авторизации');
        }

        return redirect(route("authorize.forgotPassword"))->with('message', 'Произошла ошибка, введите действительный Email');
    }
}
