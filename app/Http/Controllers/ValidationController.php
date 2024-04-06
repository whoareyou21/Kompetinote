<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentCompetition;
use App\Models\CategoryCompetition;
use App\Models\Role;
use App\Models\User;
use DB;
use File;
use PDF;
use ZipArchive;

class ValidationController extends Controller
{
    private $files_path;
    public function __construct()
    {
        $this->files_path = public_path('/files/competition');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $study_program = $request->get('study_program');
        $semester = $request->get('semester');
        $date = $request->get('date');
        $activity_type = $request->get('activity_type');
        $activity_level = $request->get('activity_level');
        $category = $request->get('category');
        $achievement = $request->get('achievement');

        $data = DB::table('student_competitions as sc')
            ->join('users as u', 'sc.student_id', 'u.id')
            ->join('category_competitions as cc', 'sc.category_id', 'cc.id')
            ->select('sc.id', 'u.name', 'cc.activity_name', 'sc.end_date', 'sc.achievement')
            ->where([['sc.deleted_at', null], ['u.deleted_at', null], ['cc.deleted_at', null], ['sc.status', 0]]);
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
        if (!empty($achievement)) {
            $data = $data->where('sc.achievement', 'like', '%' . $achievement . '%');
        }
        if (!empty($category)) {
            $data = $data->where('cc.category', 'like', '%' . $category . '%');
        }

        if ($user->role->name == 'dosen') {
            $data = $data->where([['sc.achievement', 'Pendaftar'], ['supervisor_id', $user->id]]);
        }
        else {
            $data = $data->where('sc.achievement', '!=' , 'Pendaftar');
        }

        return view('MainViews.BiroCompetition.index', [
            'user' => $user,
            'title' => 'Competition',
            'competitions' => $data->orderBy('sc.created_at', 'ASC')
                ->paginate(50)
                ->withQueryString(),
            'study_program' => $study_program,
            'semester' => $semester,
            'date' => $date,
            'activity_type' => $activity_type,
            // 'activity_level' => $activity_level,
            'achievement' => $achievement,
            'category' => $category,
        ]);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        return view('MainViews.BiroCompetition.edit', [
            'user' => $user,
            'title' => 'Competition',
            'data' => StudentCompetition::firstWhere('id', $id),
            'categories' => CategoryCompetition::all(),
            'lectures' => User::where('role_id', Role::firstWhere('name', 'dosen')->id)->get()
        ]);
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
        $user = Auth::user();
        $file_path = str_replace(' ', '', $user->id);
        $tempPath = $this->files_path . '/' . $file_path;
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        if (!$updateData = StudentCompetition::firstWhere('id', $id)) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        if (!empty($request->supervisor_id)) {
            if (!$supervisor = User::firstWhere([['id', $request->supervisor_id], ['role_id', Role::firstWhere('name', 'dosen')->id]])) {
                return back()->with('error', 'Data dosen tidak ditemukan!');
            }
        }

        if (!$category = CategoryCompetition::firstWhere('id', $request->category_id)) {
            return back()->with('error', 'Data kompetisi tidak ditemukan!');
        }

        $updateData->category_id = $request->category_id;
        $updateData->achievement = $request->achievement;
        $updateData->start_date = $request->start_date;
        $updateData->end_date = $request->end_date;
        $updateData->supervisor_id = $request->supervisor_id;
        $updateData->description = $request->description;
        $updateData->organizer_url = $request->organizer_url;
        $updateData->members = $request->members;
        $updateData->members_nim = $request->members_nim;
        $updateData->participant_number = $request->participant_number;

        if ($request->hasFile('assignment_letter')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->assignment_letter->getClientOriginalName());
            $updateData->assignment_letter_path = $file_path . '/' . $fileFolder;
            $updateData->assignment_letter_name = $request->assignment_letter->getClientOriginalName();
            $request->assignment_letter->move($tempPath, $fileFolder);
        }

        if ($request->hasFile('certificate')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->certificate->getClientOriginalName());
            $updateData->certificate_path = $file_path . '/' . $fileFolder;
            $updateData->certificate_name = $request->certificate->getClientOriginalName();
            $request->certificate->move($tempPath, $fileFolder);
        }

        if ($request->hasFile('handover')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->handover->getClientOriginalName());
            $updateData->handover_path = $file_path . '/' . $fileFolder;
            $updateData->handover_name = $request->handover->getClientOriginalName();
            $request->handover->move($tempPath, $fileFolder);
        }

        if ($request->hasFile('other_document')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->other_document->getClientOriginalName());
            $updateData->other_document_path = $file_path . '/' . $fileFolder;
            $updateData->other_document_name = $request->other_document->getClientOriginalName();
            $request->other_document->move($tempPath, $fileFolder);
        }
        $updateData->save();

        return redirect('/dashboard/validations')
            ->with('success', 'Data Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$competition = StudentCompetition::firstWhere('id', $id)) {
            return back()->with('error', 'Data Tidak Ditemukan!');
        }

        $competition->delete();
        return response()->json(['url' => url('/dashboard/validations'), 'success' => 'Data Berhasil Dihapus!']);
    }

    public function DownloadFile($id)
    {
        if (!$competition = StudentCompetition::firstWhere('id', $id)) {
            return back()->with('error', 'Data Tidak Ditemukan!');
        }

        $zip = new ZipArchive();
        $fileName = $competition->category->category . '-' . $competition->leader->name . '.zip';
        $zip->open(public_path($fileName), ZipArchive::CREATE);
        if (!empty($competition->assignment_letter_path)) {
            $zip->addFile($this->files_path . '/' . $competition->assignment_letter_path, "Surat Penugasan - " . $competition->assignment_letter_name);
        }

        if (!empty($competition->certificate_path)) {
            $zip->addFile($this->files_path . '/' . $competition->certificate_path, "Sertifikat - " . $competition->certificate_name);
        }

        if (!empty($competition->handover_path)) {
            $zip->addFile($this->files_path . '/' . $competition->handover_path, "Surat Penyerahan - " . $competition->handover_name);
        }

        if (!empty($competition->other_document_path)) {
            $zip->addFile($this->files_path . '/' . $competition->other_document_path, "Dokumen Lain - " . $competition->other_document_name);
        }
        $zip->close();
        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }

    public function DownloadForm($id)
    {
        if (!$competition = StudentCompetition::firstWhere('id', $id)) {
            return back()->with('error', 'Data Tidak Ditemukan!');
        }

        $pdf = PDF::loadview('MainViews.DownloadFiles.indexFormStudent', 
                                [
                                    'competition' => $competition
                                ]
                            );
        $position = 'portrait';
        $paperSize = 'a4';

        // return $pdf->setPaper($paperSize, $position)->stream('EXPORT REPORT_ BERANDA MAHASISWA (CATATAN PRESTASI MAHASISWA).pdf');
        return $pdf->setPaper($paperSize, $position)->stream('', array("Attachment" => false));
    }

    public function UpdateStatus(Request $request, $id, $status)
    {
        $user = Auth::user();
        if (!$competition = StudentCompetition::firstWhere('id', $id)) {
            return back()->with('error', 'Data Tidak Ditemukan!');
        }

        if ($status == 'approve') {
            $competition->status = 1;
        } elseif ($status == 'reject') {
            $competition->status = 99;
            $competition->rejection_note = $request->rejection_note;
        }
        $competition->save();
        return response()->json(['url' => url('/dashboard/validations'), 'success' => 'Data Berhasil Diubah!']);
    }

    public function IndexReport(Request $request)
    {
        $user = Auth::user();

        $study_program = $request->get('study_program');
        $semester = $request->get('semester');
        $date = $request->get('date');
        $activity_type = $request->get('activity_type');
        $activity_level = $request->get('activity_level');
        $category = $request->get('category');
        $achievement = $request->get('achievement');

        $data = DB::table('student_competitions as sc')
            ->join('users as u', 'sc.student_id', 'u.id')
            ->join('category_competitions as cc', 'sc.category_id', 'cc.id')
            ->select('sc.id', 'u.name', 'u.nim', 'cc.activity_name', 'sc.end_date', 'sc.achievement')
            ->where([['sc.deleted_at', null], ['u.deleted_at', null], ['cc.deleted_at', null], ['sc.status', 1]]);
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
        if (!empty($achievement)) {
            $data = $data->where('sc.achievement', 'like', '%' . $achievement . '%');
        }
        if (!empty($category)) {
            $data = $data->where('cc.category', 'like', '%' . $category . '%');
        }

        if ($user->role->name == 'wd3') {
            $data = $data->where('u.faculty', $user->faculty);
        } else if ($user->role->name == 'dosen') {
            $data = $data->where('sc.supervisor_id', $user->id);
        }

        return view('MainViews.BiroReport.index', [
            'user' => $user,
            'title' => 'Competition',
            'competitions' => $data->orderBy('sc.created_at', 'ASC')
                ->paginate(50)
                ->withQueryString(),
            'study_program' => $study_program,
            'semester' => $semester,
            'date' => $date,
            'activity_type' => $activity_type,
            'activity_level' => $activity_level,
            'category' => $category,
            'achievement' => $achievement,
        ]);
    }
}
