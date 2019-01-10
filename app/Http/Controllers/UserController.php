<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
// use Naux\Mail\SendCloudTemplate;
// use Mail;
use App\Http\Requests\UserRegisterRequest;

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
}
