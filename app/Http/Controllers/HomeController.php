<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentCompetition;
use App\Models\User;
use App\Models\Role;
use App\Models\CategoryCompetition;
use DB;

class HomeController extends Controller
{
    public function Index(Request $request) {
        $user = Auth::user();

        if ($user->role->name == 'mahasiswa') {
            $name = $request->get('name');
            $year = $request->get('year');
            $achievement = $request->get('achievement');
            $activity_level = $request->get('activity_level');
            // $category = $request->get('category');
    
            $data = StudentCompetition::where([['status', 1], ['student_id', $user->id]]);
    
            if (!empty($name)) {
                $data = $data->where('activity_name', 'like', '%' . $name . '%');
            }
    
            if (!empty($year)) {
                $data = $data->where('start_date', 'like', '%' . $year . '%');
            }

            // if (!empty($category)) {
            //     $data = $data->where('category', 'like', '%' . $category . '%');
            // }

            if (!empty($activity_level)) {
                $data = $data->where('activity_level', 'like', '%' . $activity_level . '%');
            }    
  
            if (!empty($achievement)) {
                $data = $data->where('achievement', 'like', '%' . $achievement . '%');
            }
    
            return view('MainViews.home', [
                'user' => $user,
                'title' => 'Home',
                'competitions' => $data->latest()
                ->paginate(50)
                ->withQueryString(),
                'name' => $name,
                'year' => $year,
                'activity_level' => $activity_level,
                'achievement' => $achievement,
            ]);
        } else {
            $study_program = $request->get('study_program');
            $date = $request->get('date');
            $achievement = $request->get('achievement');
            $category = $request->get('category');

            $data = DB::table('student_competitions as sc')
                    ->join('category_competitions as cc', 'sc.category_id', 'cc.id')
                    ->join('users as u', 'sc.student_id', 'u.id')
                    ->select('sc.achievement', 'u.faculty', 'cc.category')
                    ->where([['sc.deleted_at', null], ['cc.deleted_at', null], ['u.deleted_at', null], ['sc.status', 1]]);
            
            $users = User::where('role_id', Role::firstWhere('name', 'mahasiswa')->id);
            if (!empty($study_program)) {
                $data = $data->where('u.study_program', 'like', '%' . $study_program . '%');
                $users = $users->where('study_program', 'like', '%' . $study_program . '%');
            }
            
            if (!empty($achievement)) {
                $data = $data->where('sc.achievement', 'like', '%' . $achievement . '%');
            }

            if (!empty($category)) {
                $data = $data->where('cc.category', 'like', '%' . $category . '%');
            }
            
            if (!empty($date)) {
                $data = $data->where('u.semester', 'like', '%' . $date . '%');
                $users = $users->where('semester', 'like', '%' . $date . '%');
            }
            
            if ($user->role->name == 'wd3') {
                $data = $data->where('u.faculty', 'like', '%' . $user->faculty . '%');
                $users = $users->where('faculty', 'like', '%' . $user->faculty . '%');
            }

            return view('MainViews.homeAdmin', [
                'user' => $user,
                'studentCompetitions' => $data->get(),
                'users' => $users->get(),
                'categories' => CategoryCompetition::get(),
                'countAchievement' => $data->where('achievement', 'Juara 1')
                        ->orWhere('achievement', 'Juara 2')
                        ->orWhere('achievement', 'Juara 3')
                        ->count(),
                'title' => 'Home',
                'study_program' => $study_program,
                'date' => $date,
                'category' => $category,
                'achievement' => $achievement,
            ]);
        }
        
    }
}
