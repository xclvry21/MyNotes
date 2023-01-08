<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Note;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    private $adminModel;
    private $userModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
        $this->userModel = new User();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note_count = Note::get()->count();
        $tag_count = Tag::get()->count();
        $user_count = User::get()->count();
        $admin_count = Admin::get()->count();

        return view('admin.index', [
            'title' => 'Dashboard',
            'note_count' => $note_count,
            'tag_count' => $tag_count,
            'user_count' => $user_count,
            'admin_count' => $admin_count
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin.admin_create', [
            'title' => 'Create Admin'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastRow = DB::table('admins')->latest('id')->first();

        $image = $request->file('profile_image');
        $data = $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6',
            ],
        );

        if ($image) {
            $origName = $request->file('profile_image')->getClientOriginalName();

            //filename to store -> for uniqueness
            $filenameToStore = ($lastRow->id + 1) . '_' . date('YmdHi') . '_' . $origName;

            $request->file('profile_image')->storeAs('public/admin_images', $filenameToStore);
            $data['profile_image_name'] = $filenameToStore;
        } else {
            $data['profile_image_name'] = null;
        }

        $this->adminModel->admin_create($data);

        return redirect()->route('admin.register_form')->with('success', "New admin added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $admin = Admin::find($request->id);
        return response()->json($admin);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $currentData = Admin::findOrFail($request->id);

        //create first the folder
        $destination = '/storage/admin_images/';
        $path = public_path() . $destination;

        //delete the file
        File::delete($path . $currentData->profile_image);

        $currentData->delete();

        return redirect()->route('admin.list');
    }

    public function login_form()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if (Auth::guard('admin')->attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ])) {
            return redirect()->route('admin.dashboard')->with('success', "You've login successfully");
        } else {
            return back()->with('error', 'Invalid credentials');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin_login_form')->with('success', "You've logout successfully");
    }

    public function admin_list()
    {
        return view('admin.admin.admin_all', [
            'title' => 'Admin List',
            'admins' => Admin::latest()->get(),
        ]);
    }

    public function user_list()
    {
        return view('admin.user.user_all', [
            'title' => 'User List',
            'users' => User::latest()->get()
        ]);
    }

    public function show_user(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $user['note_count'] = Note::where([
            'user_id' => $id,
            'is_archive' => 0,
            'is_trash' => 0
        ])->latest()->get()->count();
        $user['tag_count'] = Tag::where([
            'user_id' => $id,
        ])->latest()->get()->count();

        return response()->json($user);
    }

    // setups settings
    public function edit_profile()
    {
        return view('admin.setting.setting_edit_profile', [
            'title' => 'Profile Edit',
            'auth_user' => Auth::guard('admin')->user()
        ]);
    }

    public function update_profile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $image = $request->file('profile_image');
        $data = $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
            ],
        );

        if ($image) {
            //filename to store -> for uniqueness
            $filenameToStore = ($admin->id) . '_' . date('YmdHi') . '.' . $image->getClientOriginalExtension();

            $request->file('profile_image')->storeAs('public/admin_images', $filenameToStore);
            $data['profile_image_name'] = $filenameToStore;
        } else {
            $data['profile_image_name'] = null;
        }

        $this->adminModel->admin_update($data, $admin->id);

        return redirect()->back()->with('success', "Your profile updated successfully");
    }

}
