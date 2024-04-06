<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentCompetition;
use App\Models\CategoryCompetition;
use App\Models\User;
use App\Models\Role;
use DB;
use PDF;
use Carbon\Carbon;

class DownloadFileController extends Controller
{
    public function DownloadFile(Request $request) {
        $user = Auth::user();
        
        $study_program = $request->get('study_program');
        $semester = $request->get('semester');
        $date = $request->get('date');
        $activity_type = $request->get('activity_type');
        $activity_level = $request->get('activity_level');
        $category = $request->get('category');

        $study_program = $request->get('study_program');
        $semester = $request->get('semester');
        $date = $request->get('date');
        $activity_type = $request->get('activity_type');
        $activity_level = $request->get('activity_level');
        $category = $request->get('category');

        $data = DB::table('student_competitions as sc')
                    ->join('users as u', 'sc.student_id', 'u.id')
                    ->join('category_competitions as cc', 'sc.category_id', 'cc.id')
                    ->select('sc.id', 'u.nim', 'u.name', 'cc.activity_name', 'sc.end_date', 'sc.achievement')
                    ->where([['sc.deleted_at', null], ['u.deleted_at', null], ['cc.deleted_at', null]]);
        if (!empty($study_program)) {
            $data = $data->where('u.study_program', 'like', '%' . $study_program . '%');
        }
        if (!empty($semester)) {
            $data = $data->where('u.semester', 'like', '%' . $semester . '%');
        }
        if (!empty($date)) {
            $data = $data->where('sc.end_date', 'like', '%' . $date . '%');
        }
        if (!empty($activity_type)) {
            $data = $data->where('cc.activity_type', 'like', '%' . $activity_type . '%');
        }
        if (!empty($activity_level)) {
            $data = $data->where('cc.activity_level', 'like', '%' . $activity_level . '%');
        }
        if (!empty($category)) {
            $data = $data->where('cc.category', 'like', '%' . $category . '%');
        }

        if ($user->role->name == 'dosen') {
            $data = $data->where('sc.supervisor_id', $user->id);
        } elseif ($user->role->name == 'wd3') {
            $data = $data->where('u.faculty', $user->faculty);
        }

        $pdf = PDF::loadview('MainViews.DownloadFiles.index', 
                                [
                                    'user' => $user,
                                    'competitions' => $data->orderBy('sc.created_at', 'ASC')->get(),
                                    'study_program' => $study_program,
                                    'semester' => $semester,
                                    'date' => $date,
                                    'activity_type' => $activity_type,
                                    'activity_level' => $activity_level,
                                    'category' => $category,
                                ]
                            );
        $position = 'portrait';
        $paperSize = 'a4';

        return $pdf->setPaper($paperSize, $position)->stream(Carbon::today()->format('dmY') . '.pdf');
    }

    public function DownloadFileStudent(Request $request) {
        $user = Auth::user();
        
        $name = $request->get('name');
        $year = $request->get('year');
        $activity_level = $request->get('activity_level');
        $achievement = $request->get('achievement');

        $data = StudentCompetition::where([['status', 1], ['student_id', $user->id]]);

        if (!empty($name)) {
            $data = $data->where('activity_name', 'like', '%' . $name . '%');
        }

        if (!empty($year)) {
            $data = $data->where('start_date', 'like', '%' . $year . '%');
        }

        if (!empty($activity_level)) {
            $data = $data->where('activity_level', 'like', '%' . $activity_level . '%');
        }

        if (!empty($achievement)) {
            $data = $data->where('achievement', 'like', '%' . $achievement . '%');
        }

        $pdf = PDF::loadview('MainViews.DownloadFiles.indexStudent', 
                                [
                                    'user' => $user,
                                    'competitions' => $data->orderBy('created_at', 'ASC')->get(),
                                    'name' => $name,
                                    'year' => $year,
                                    'activity_level' => $activity_level,
                                    'achievement' => $achievement
                                ]
                            );
        $position = 'portrait';
        $paperSize = 'a4';

        // return $pdf->setPaper($paperSize, $position)->stream('EXPORT REPORT_ BERANDA MAHASISWA (CATATAN PRESTASI MAHASISWA).pdf');
        return $pdf->setPaper($paperSize, $position)->stream('', array("Attachment" => false));
    }
}
