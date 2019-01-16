<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserRegisterRequest;
use Image;

class UserController extends Controller
{
    public function register()
    {
        return view('users.register');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        $data = [
            'confirm_code' => str_random(48),
            'avatar' => '/image/default-avatar-png'
        ];
        //保存用户数据
        $user = User::create(array_merge($request->all(), $data));
        $subject = 'Confirm Your Email';
        $view = 'email.register';
        $this->sendTo($user, $subject, $view, $data);
        return redirect('/');
    }

    public function confirmEmail($confirm_code)
    {
        $user = User::where('confirm_code', $confirm_code)->first();
        if (is_null($user)) {
            return redirect('/');
        }
        $user->is_confirm_code = 1;
        $user->coinfirm_code - str_random(48);
        $user->save();

        return redirect('user/login');
    }

    public function login()
    {
        return view('users.login');
    }

    public function signin(Requests\UserLoginRequest $request)
    {
        if (\Auth::attempt([
            'email'=>$request->get('email'),
            'password'=> $request->get('password'),
            'is_confirmed'=> 1
        ])) {
            return redirect('/');
        }
        \Session::flash('user_login_failed', '密码不正确或邮箱没验证');
        return redirect('/user/login')->withInput();
    }

    public function avatar()
    {
        return view('users.avatar');
    }

    public function changeAvatar(Request $request)
    {
        $file = $request->file('avatar');
        $input = array('image'=>$file);
        $rules = array(
            'image'=> 'image'
        );
        $validator = \Validator::make($input,$rules);
        if ($validator->fails()) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }
        $destinationPath = 'uploads/';
        $filename = \Auth::user()->id .'_'.time(). $file->getClientOriginalName();
        $file->move($destinationPath,$filename);
        Image::make($destinationPath.$filename)->fit(200)->save();
       
        return \Response::json([
            'success'=>true,
            'avatar'=> asset($destinationPath.$filename)
        ]);
    }

    public function cropAvatar(Request $request)
    {
        dd($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function sendTo($user, $subject, $view, $data = [])
    {
        \Mail::queue($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email)->subject($subject);
        });
    }

    public function logout()
    {
        \Auth::logout();
        return redirect('/');
    }
}
