<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function showSearch()
    {
        return view('search.index');
    }

    public function search(Request $request)
    {
        $users = User::search($request->search)->get();
        return response()->json($users);
    }

    public function getUser($id)
    {
        session()->flash('status', 'User Detail Retrived');
        $user = User::findOrFail($id);
        return view('search.index', compact('user'));
    }

    
}
