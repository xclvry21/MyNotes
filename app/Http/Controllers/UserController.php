<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note_count = Note::where([
            'user_id' => Auth::user()->id,
            'is_archive' => 0,
            'is_trash' => 0
        ])->latest()->get()->count();

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
            'password' => $request['password'],
            'email_verified_at' => null
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

    public function edit_profile()
    {
        return view('user.setting.setting_edit_profile', [
            'title' => 'Profile Edit',
            'tags' => Tag::where('user_id', Auth::user()->id)->latest()->get(),
            'auth_user' => Auth::user()
        ]);
    }

    public function update_profile(Request $request)
    {
        $user = Auth::user();

        $image = $request->file('profile_image');
        $data = $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
            ],
        );

        if ($image) {
            //filename to store -> for uniqueness
            $filenameToStore = ($user->id) . '_' . date('YmdHi') . '.' . $image->getClientOriginalExtension();

            $request->file('profile_image')->storeAs('public/user_images', $filenameToStore);
            $data['profile_image_name'] = $filenameToStore;
        } else {
            $data['profile_image_name'] = null;
        }

        $this->userModel->user_update($data, $user->id);

        return redirect()->back()->with('success', "Your profile updated successfully");
    }

    public function edit_password()
    {
        return view('user.setting.setting_edit_password', [
            'title' => 'Password Edit',
        ]);
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'password_confirmation' => 'required|same:new_password',
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->current_password, $hashedPassword)) {

            User::find(Auth::user()->id)->update([
                'password' => bcrypt($request->new_password),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->back()->with('success', "Your profile updated successfully");
        } else {
            return redirect()->back()->with('error', "Current password is incorrect");
        }
    }
}
