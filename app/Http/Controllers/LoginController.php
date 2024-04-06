<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    private $files_path;
    public function __construct()
    {
        $this->files_path = public_path('/img');
    }

    public function Index()
    {
        return view('login.index', [
            'title' => 'Login'
        ]);
    }

    public function Login(Request $request) 
    {
        $credentials = $request->validate([
            'campus_email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            if ($user->role->name != 'dosen') {
                return redirect()->intended('/');
            }
            else {
                return redirect()->route('/dashboard/reports');
            }
        }

        return back()->with('loginError', 'email atau Password Salah!');
    }

    public function Register()
    {
        return view('login.register', [
            'title' => 'Register'
        ]);
    }

    public function Create(Request $request)
    {
        $file_path = str_replace(' ', '', $request->nim);
        $tempPath = $this->files_path . '/' . $file_path;
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        $user = new User;
        $user->name = $request->name;
        $user->campus_email = $request->campus_email;
        $user->phone_number = $request->phone_number;
        $user->faculty = $request->faculty;
        $user->semester = $request->semester;
        $user->account_number = $request->account_number;
        $user->nim = $request->nim;
        $user->password = bcrypt($request->password);
        $user->personal_email = $request->personal_email;
        $user->study_program = $request->study_program;
        $user->nik = $request->nik;
        $user->created_by = $request->name;
        $user->updated_by = $request->name;
        $user->role_id = Role::firstWhere('name', 'mahasiswa')->id;

        if ($request->hasFile('profile_picture')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->profile_picture->getClientOriginalName());
            $user->profile_picture_path = $file_path . '/' . $fileFolder;
            $user->profile_picture_name = $request->profile_picture->getClientOriginalName();
            $request->profile_picture->move($tempPath, $fileFolder);
        }
        $user->save();

        return redirect('/login')
            ->with('success', 'Akun Berhasil Dibuat!');
    }

    public function Logout(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['url' => url('/'), 'success' => 'Berhasil Logout!']);
    }
}
