<?php

namespace App\Http\Controllers\Api\Auth;

use App\Repositories\Api\MemberProviderRepository;
use App\Repositories\Member\MemberRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Laravel\Socialite\Contracts\User as ProviderUser;
use Hash;

class FacebookLoginController extends LoginController
{
    /**
     * @var \App\Repositories\Member\MemberRepository|string
     */
    protected $memberRepository;

    protected $memberProviderRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MemberRepository $memberRepository, MemberProviderRepository $memberProviderRepo)
    {
        $this->memberRepository = $memberRepository;
        $this->memberProviderRepo = $memberProviderRepo;
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($memberProvider = $this->createOrGetMemberProvider($request)) {
            if ($member = $this->createOrGetMember($memberProvider)) {
                return $this->sendLoginResponse($member);
            }
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'uid' => 'required|string',
            'token' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'result'        => '422',
                'error_message' => $validator->errors(),
            ]));
        }
    }

    protected function createOrGetMember($memberProvider)
    {
        try {
            if ($memberProvider->member()->exists()) {
                $member = $memberProvider->member;
            } else {
                $member = $this->memberRepository->firstOrCreate(
                    ['email' => $memberProvider->email],
                    [
                        'name' => $memberProvider->name,
                        'password' => rand(1, 10000),
                        'avatar' => $memberProvider->avatar,
                        'phone' => '',
                        'confirm_terms' => 1,
                    ]
                );
                $memberProvider->member()->associate($member);
                $memberProvider->save();
            }

            return $member;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function createOrGetMemberProvider($providerUser)
    {
        $account = $this->memberProviderRepo->updateOrCreate(
            ['provider' => 'facebook', 'uid' => $providerUser->uid],
            [
                'email' => $providerUser->email,
                'token' => $providerUser->token,
                'name' => $providerUser->name,
                'avatar' => $providerUser->avatar,
                'raw' => $providerUser->raw,
            ]
        );
        return $account;
    }
}
