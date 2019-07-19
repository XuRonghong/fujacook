<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Transaction;
use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Repositories\Api\MemberRepository;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    
    use RegistersUsers, Transaction;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(MemberRepository $memberRepository)
    {
        $this->middleware('guest');
        $this->memberRepository = $memberRepository;
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validator = Validator::make($data, [
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:members',
            'password'      => 'required|string|between:6,12|confirmed',
            'phone'         => 'required|string|max:10|regex:/^0[0-9]{9}+$/',
            'confirm_terms' => 'accepted',
        ]);
        
        if ($validator->fails()) {
            
            throw new HttpResponseException(response()->json([
                'result'        => '422',
                'error_message' => $validator->errors(),
            ]));
        }
    }
    
    private function register(Request $request)
    {
        $this->validator($request->all());
        $user = $this->create($request->all());
        
        return $this->registered($request, $user);
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return \App\Models\Member
     */
    protected function create(array $data)
    {
        return $this->memberRepository->create($data);
    }
    
    protected function registered(Request $request, $member)
    {
        $api_token         = str_random(64);
        $member->api_token = $api_token;
        $member->save();
        
        return response()->json([
            'result'    => '200',
            'member'    => $member,
            'api_token' => $api_token,
        ], 200);
    }
}