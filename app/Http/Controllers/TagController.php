<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    private $tagModel;

    public function __construct()
    {
        $this->tagModel = new Tag();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.tag.tag_all', [
            'title' => 'Tag List',
            'tags' => Tag::where('user_id', Auth::user()->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.tag.tag_create', [
            'title' => 'Create Tag'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);

        $data['user_id'] = Auth::user()->id;
        $this->tagModel->tag_store($data);
        return redirect()->route('tag.create')->with('success', "Tag added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $tag = Tag::find($request->id);

        if ($tag->user_id != Auth::user()->id) {
            return redirect()->route('tag.index')->with('error', "Invalid action");
        } else {
            return response()->json($tag);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = [
            'title' => $request->tag_title,
        ];

        if ($data['title']) {
            $this->tagModel->tag_update($data, $request->tag_id);
            return redirect()->route('tag.index')->with('success', "Tag updated successfully");
        } else {
            return redirect()->route('tag.index')->with('error', "Tag title must not be empty");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $currentData = Tag::findOrFail($request->id);
        $currentData->delete();

        return redirect()->route('tag.index');
    }
}
