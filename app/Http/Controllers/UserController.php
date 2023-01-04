<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note_count = Note::where('user_id', Auth::user()->id)->latest()->get()->count();
        $tag_count = Tag::where('user_id', Auth::user()->id)->latest()->get()->count();

        $archive_count = Note::where([
            'user_id' => Auth::user()->id,
            'is_archive' => 1
        ])->latest()->get()->count();

        $trash_count = Note::where([
            'user_id' => Auth::user()->id,
            'is_trash' => 1
        ])->latest()->get()->count();


        return view('user.index', [
            'title' => 'Dashboard',
            'note_count' => $note_count,
            'tag_count' => $tag_count,
            'archive_count' => $archive_count,
            'trash_count' => $trash_count
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function login(Request $request)
    {
        if (Auth::guard('web')->attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ])) {
            return redirect()->route('user.dashboard')->with('success', "You've login successfully");
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }

    public function login_form()
    {
        return view('user.login');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', "You've logout successfully");
    }
}
