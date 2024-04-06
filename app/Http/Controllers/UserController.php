<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;

class UserController extends Controller
{
    private $files_path;
    public function __construct()
    {
        $this->files_path = public_path('/img');
    }

    public function ShowProfile() {
        $user = Auth::user();

        $initial = substr($user->name, 0 , 1);

        if (str_contains($user->name, ' ')) {
            $name = explode(' ', $user->name);
            $initial = $name[0][0] . $name[count($name)-1][0];
        }

        return view('MainViews.profile', [
            'user' => $user,
            'title' => 'Profile',
            'initial' => $initial
        ]);
    }

    public function UpdateProfile(Request $request) {
        $user = Auth::user();
        $file_path = str_replace(' ', '', $user->id);
        $tempPath = $this->files_path . '/' . $file_path;
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        $user->name = $request->name;
        $user->campus_email = $request->campus_email;
        $user->phone_number = $request->phone_number;
        $user->faculty = $request->faculty;
        $user->semester = $request->semester;
        $user->account_number = $request->account_number;
        $user->nim = $request->nim;
        $user->password = empty($request->password) ? $user->password : bcrypt($request->password);
        $user->personal_email = $request->personal_email;
        $user->study_program = $request->study_program;
        $user->nik = $request->nik;

        if ($request->hasFile('profile_picture')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->profile_picture->getClientOriginalName());
            $user->profile_picture_path = $file_path . '/' . $fileFolder;
            $user->profile_picture_name = $request->profile_picture->getClientOriginalName();
            $request->profile_picture->move($tempPath, $fileFolder);
        }
        $user->save();
        
        return redirect('/dashboard/student/profile')
            ->with('success', 'Data Berhasil Dirubah!');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $name = $request->get('name');
        $role = $request->get('role');

        $data = User::where('id', '!=', $user->id);

        if (!empty($name)) {
            $data = $data->where('name', 'like', '%' . $name . '%');
        }

        if (!empty($role)) {
            $data = $data->where('role_id', 'like', '%' . $role . '%');
        }

        return view('MainViews.Users.index', [
            'user' => $user,
            'title' => 'User',
            'users' => $data->latest()
                ->paginate(50)
                ->withQueryString(),
            'roles' => Role::all(),
            'role_id' => $role,
            'name' => $name
        ]);
    }
    
    public function create()
    {
        $user = Auth::user();
        return view('MainViews.Users.create', [
            'user' => $user,
            'title' => 'User',
            'roles' => Role::all()
        ]);
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();
        $file_path = str_replace(' ', '', $request->nim);
        $tempPath = $this->files_path . '/' . $file_path;
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        $insertUser = new User;
        $insertUser->name = $request->name;
        $insertUser->campus_email = $request->campus_email;
        $insertUser->phone_number = $request->phone_number;
        $insertUser->faculty = $request->faculty;
        $insertUser->semester = $request->semester;
        $insertUser->account_number = $request->account_number;
        $insertUser->nim = $request->nim;
        $insertUser->password = bcrypt($request->password);
        $insertUser->personal_email = $request->personal_email;
        $insertUser->study_program = $request->study_program;
        $insertUser->nik = $request->nik;
        $insertUser->role_id = $request->role_id;

        if ($request->hasFile('profile_picture')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->profile_picture->getClientOriginalName());
            $insertUser->profile_picture_path = $file_path . '/' . $fileFolder;
            $insertUser->profile_picture_name = $request->profile_picture->getClientOriginalName();
            $request->profile_picture->move($tempPath, $fileFolder);
        }
        $insertUser->save();

        return redirect('/dashboard/users')
            ->with('success', 'User Berhasil Ditambahkan!');
    }
    
    public function edit($id)
    {
        $user = Auth::user();
        
        return view('MainViews.Users.edit', [
            'user' => $user,
            'title' => 'User',
            'data' => User::firstWhere('id', $id),
            'roles' => Role::all()
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $file_path = str_replace(' ', '', $request->nim);
        $tempPath = $this->files_path . '/' . $file_path;
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        if (!$updateUser = User::firstWhere('id', $id)) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        $updateUser->name = $request->name;
        $updateUser->campus_email = $request->campus_email;
        $updateUser->phone_number = $request->phone_number;
        $updateUser->faculty = $request->faculty;
        $updateUser->semester = $request->semester;
        $updateUser->account_number = $request->account_number;
        $updateUser->nim = $request->nim;
        $updateUser->password = empty($request->password) ? $updateUser->password : bcrypt($request->password);
        $updateUser->personal_email = $request->personal_email;
        $updateUser->study_program = $request->study_program;
        $updateUser->nik = $request->nik;
        $updateUser->role_id = $request->role_id;

        if ($request->hasFile('profile_picture')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->profile_picture->getClientOriginalName());
            $updateUser->profile_picture_path = $file_path . '/' . $fileFolder;
            $updateUser->profile_picture_name = $request->profile_picture->getClientOriginalName();
            $request->profile_picture->move($tempPath, $fileFolder);
        }
        $updateUser->save();

        return redirect('/dashboard/users')
            ->with('success', 'User Berhasil Dirubah!');
    }
    
    public function destroy($id)
    {
        if (!$user = User::firstWhere('id', $id)) {
            return back()->with('error', 'Data Tidak Ditemukan!');
        }

        $user->delete();
        return response()->json(['url' => url('/dashboard/users'), 'success' => 'Data Berhasil Dihapus!']);
    }
}
