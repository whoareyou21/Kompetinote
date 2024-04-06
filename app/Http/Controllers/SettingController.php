<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryCompetition;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $activity_type = $request->get('activity_type');
        $activity_level = $request->get('activity_level');
        $category = $request->get('category');

        $data = CategoryCompetition::Query();

        if (!empty($activity_type)) {
            $data = $data->where('activity_type', 'like', '%' . $activity_type . '%');
        }

        if (!empty($activity_level)) {
            $data = $data->where('activity_level', 'like', '%' . $activity_level . '%');
        }

        if (!empty($category)) {
            $data = $data->where('category', 'like', '%' . $category . '%');
        }

        return view('MainViews.Settings.index', [
            'user' => $user,
            'title' => 'Setting',
            'settings' => $data->latest()
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
        return view('MainViews.Settings.create', [
            'user' => $user,
            'title' => 'Setting'
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

        $insertData = new CategoryCompetition;
        $insertData->category = $request->category;
        $insertData->activity_type = $request->activity_type;
        $insertData->activity_level = $request->activity_level;
        $insertData->activity_name = $request->activity_name;
        $insertData->activity_year = $request->activity_year;
        $insertData->save();
        
        return redirect('/dashboard/settings')
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
        
        return view('MainViews.Settings.edit', [
            'user' => $user,
            'title' => 'Setting',
            'data' => CategoryCompetition::firstWhere('id', $id)
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

        if (!$updateData = CategoryCompetition::firstWhere('id', $id)) {
            return back()->with('error', 'Data tidak ditemukan!');
        }
        
        $updateData->category = $request->category;
        $updateData->activity_type = $request->activity_type;
        $updateData->activity_level = $request->activity_level;
        $updateData->activity_name = $request->activity_name;
        $updateData->activity_year = $request->activity_year;
        $updateData->save();
        
        return redirect('/dashboard/settings')
        ->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$categories = CategoryCompetition::firstWhere('id', $id)) {
            return back()->with('error', 'Data Tidak Ditemukan!');
        }

        $categories->delete();
        return response()->json(['url' => url('/dashboard/settings'), 'success' => 'Data Berhasil Dihapus!']);
    }
}
