<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentCompetition;
use App\Models\CategoryCompetition;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Str;

class CompetitionStudentController extends Controller
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

        $name = $request->get('name');
        $year = $request->get('year');
        $activity_level = $request->get('activity_level');
        $achievement = $request->get('achievement');

        $data = StudentCompetition::where('student_id', $user->id);

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

        return view('MainViews.StudentCompetition.index', [
            'user' => $user,
            'title' => 'Competition',
            'competitions' => $data->latest()
            ->paginate(50)
            ->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('MainViews.StudentCompetition.create', [
            'user' => $user,
            'title' => 'Competition',
            'categories' => CategoryCompetition::all(),
            'lectures' => User::where('role_id', Role::firstWhere('name', 'dosen')->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $file_path = str_replace(' ', '', $user->id);
        $tempPath = $this->files_path . '/' . $file_path;
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        if (!empty($request->supervisor_id)) {
            if (!$supervisor = User::firstWhere([['id', $request->supervisor_id], ['role_id', Role::firstWhere('name', 'dosen')->id]])) {
                return back()->with('error', 'Data dosen tidak ditemukan!');
            }
        }

        if (!$category = CategoryCompetition::firstWhere('id', $request->category_id)) {
            return back()->with('error', 'Data kompetisi tidak ditemukan!');
        }
        
        if (!Str::contains($request->start_date, $category->activity_year) && !Str::contains($request->end_date, $category->activity_year)) {
            return back()->with('error', 'Tahun Mulai / Selesai tidak sesuai dengan tahun kegiatan!');
        }

        $insertData = new StudentCompetition;
        $insertData->category_id = $request->category_id;
        $insertData->achievement = $request->achievement;
        $insertData->start_date = $request->start_date;
        $insertData->end_date = $request->end_date;
        $insertData->supervisor_id = $request->supervisor_id;
        $insertData->description = $request->description;
        $insertData->organizer_url = $request->organizer_url;
        $insertData->student_id = $user->id;
        $insertData->members = $request->members;
        $insertData->members_nim = $request->members_nim;
        $insertData->participant_number = $request->participant_number;

        if ($request->hasFile('assignment_letter')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->assignment_letter->getClientOriginalName());
            $insertData->assignment_letter_path = $file_path . '/' . $fileFolder;
            $insertData->assignment_letter_name = $request->assignment_letter->getClientOriginalName();
            $request->assignment_letter->move($tempPath, $fileFolder);
        }

        if ($request->hasFile('certificate')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->certificate->getClientOriginalName());
            $insertData->certificate_path = $file_path . '/' . $fileFolder;
            $insertData->certificate_name = $request->certificate->getClientOriginalName();
            $request->certificate->move($tempPath, $fileFolder);
        }

        if ($request->hasFile('handover')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->handover->getClientOriginalName());
            $insertData->handover_path = $file_path . '/' . $fileFolder;
            $insertData->handover_name = $request->handover->getClientOriginalName();
            $request->handover->move($tempPath, $fileFolder);
        }

        if ($request->hasFile('other_document')) {
            $fileFolder = sha1(date('YmdHis') . \Str::random(30)) . '.' . \File::extension($request->other_document->getClientOriginalName());
            $insertData->other_document_path = $file_path . '/' . $fileFolder;
            $insertData->other_document_name = $request->other_document->getClientOriginalName();
            $request->other_document->move($tempPath, $fileFolder);
        }
        $insertData->save();
        
        return redirect('/dashboard/student/competition')
        ->with('success', 'Data Berhasil Ditambahkan!');
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
        
        return view('MainViews.StudentCompetition.edit', [
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
        $updateData->student_id = $user->id;
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
        
        return redirect('/dashboard/student/competition')
        ->with('success', 'Data Berhasil Dirubah!');
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
        return response()->json(['url' => url('/dashboard/student/competition'), 'success' => 'Data Berhasil Dihapus!']);
    }
}
