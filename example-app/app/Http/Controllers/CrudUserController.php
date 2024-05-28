<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CrudUserController extends Controller
{



    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.update', ['user' => $user]);
    }

    public function postUpdateUser(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,id,' . $input['id'],
            'password' => 'required|min:6',
        ]);

        $user = User::find($input['id']);
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = $input['password'];
        $user->phonenumber = $input['phonenumber'];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }
        $user->save();

        return redirect("list")->withSuccess('You have signed-in');
    }


    public function readUser(Request $request)
    {
        $user_id = $request->get('id');
        $users = User::find($user_id);

        return view('crud_user.read', ['users' => $users]);
    }
    public function deleteUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::destroy($user_id);

        return redirect("list")->withSuccess('You have signed-in');
    }




    public function listUser()
    {
        if (Auth::check()) {
            $users = User::all();
            return view('crud_user.list', ['users' => $users]);
        }

        return redirect()->route('user.list')->with('success', 'Bạn không được phép truy cập');
    }



    public function login()
    {
        return view('crud_user.login');
    }

    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if ($credentials['email'] == "admin@gmail.com") {
                return redirect()->intended('list')->withSuccess('Signed in');
            }
            return redirect()->intended('home')
                ->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }
    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại trong hệ thống']);
        }

        // Đoạn mã ở đây có thể gửi email chứa đường link đặc biệt để người dùng có thể thiết lập lại mật khẩu,
        // hoặc chuyển hướng người dùng đến trang cập nhật mật khẩu trực tiếp.

        // Ví dụ: Chuyển hướng người dùng đến trang cập nhật mật khẩu với email của họ đã được truyền qua session.
        $request->session()->put('reset_email', $user->email);
        // return redirect()->route('update.password.form');
        return view('crud_user.forgot_password')->with('email', $user);
    }

    public function showUpdatePasswordForm(Request $request)
    {
        $email = $request->session()->get('reset_email');
        if (!$email) {
            return redirect()->route('login')->withErrors(['message' => 'Yêu cầu không hợp lệ']);
        }

        // return view('crud_user.update_password')->with('email', $email);
        return view('crud_user.forgot_password')->with('email', $email);
    }



    public function createUser()
    {
        return view('crud_user.create');
    }
    public function dashboard()
    {
        return view('dashboard');
    }



    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phonenumber' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);

            $data = $request->all();
            $check = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phonenumber' => $data['phonenumber'],
                'image' => $imageName,
            ]);
            $data['image'] = $imageName;
            //$check = $this->create($data);
            //$user = User::create($data);
            return redirect("login")->withSuccess('You have signed-in');
        }
    }
}
