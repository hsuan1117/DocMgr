<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\View;
use App\Models\User;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        date_default_timezone_set("Asia/Taipei");
        Carbon::setLocale('zh-TW');
        //Admin
        return View::make('departments.index')
            ->with('departments',Department::all()->sortByDesc('created_at'));

        //一般使用者
        /*
         * return View::make('departments.index')
            ->with('departments',$user->departments->sortByDesc('created_at'));
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $department = Department::create([
            'name' => $request->name
        ]);

        foreach($request->users as $user_id){
            $user = User::find($user_id);
            $user->departments()->attach($department);
            $user->save();
        }


        return redirect()->to(route('departments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }

    public function queryDepartmentUsers(Request $request){
        $users = Department::find($request->id)->users;
        $res = collect();
        foreach($users as $user){
            $res->push([
                'id' => $user->id,
                'text' => $user->name."(".$user->email.")"."<".$user->id.">"
            ]);
        }
        return response()->json($res);
    }
}
