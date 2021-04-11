<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    /**
     * 搜尋用戶
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function query(Request $request){
        $term = $request->term;
        $users = User::where('email', 'like', '%' . $term . '%')
            ->orWhere('name', 'like', '%' . $term . '%')
            ->orWhere('id', 'like', '%' . $term . '%')
            ->get();
        $res = collect();
        foreach($users as $user){
            $res->push([
                'id' => $user->id,
                'text' => $user->name."(".$user->email.")"."<".$user->id.">"
            ]);
        }
        return response()->json([
            'results'=>$res
        ]);
    }

    /**
     * 取得用戶
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser(Request $request){
        $id = $request->id;
        $user = User::find($id)->first();

        return response()->json([
            'id' => $user->id,
            'text' => $user->name."(".$user->email.")"."<".$user->id.">"
        ]);
    }
}
