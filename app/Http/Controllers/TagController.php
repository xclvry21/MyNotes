<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Note;
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
            'title' => 'Tag Settings',
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
        // return view('user.tag.tag_create', [
        //     'title' => 'Create Tag',
        //     'tags' => Tag::where('user_id', Auth::user()->id)->latest()->get()
        // ]);
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
        return redirect()->back()->with('success', "Tag added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $current_tag = Tag::find($request->id);

        if ($current_tag->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        } else {

            $all_notes = Note::where([
                'user_id' => Auth::user()->id,
                'is_archive' => 0,
                'is_trash' => 0
            ])->latest()->get();

            $archive_notes = Note::where([
                'user_id' => Auth::user()->id,
                'is_archive' => 1,
                'is_trash' => 0
            ])->latest()->get();

            $trash_notes = Note::where([
                'user_id' => Auth::user()->id,
                'is_trash' => 1
            ])->latest()->get();


            return view('user.tag.tag_show', [
                'title' => sprintf("Notes (%s)", $current_tag->title),
                'note_tag' => $this->filter_by_tag($all_notes, $request->id),
                'note_archive' => $this->filter_by_tag($archive_notes, $request->id),
                'note_trash' => $this->filter_by_tag($trash_notes, $request->id),
                'tags' => Tag::where('user_id', Auth::user()->id)->latest()->get(),
                'tag_id' => $request->id,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $tag = Tag::find($request->id);

        if ($tag->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        } else {
            return response()->json($tag);
        }
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
            return redirect()->back()->with('success', "Tag updated successfully");
        } else {
            return redirect()->back()->with('error', "Tag title must not be empty");
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

        return redirect()->back();
    }

    /**
     * It takes an array of objects and a tag id, and returns an array of objects that have that tag id
     * 
     * @param arr_obj an array of objects
     * @param tag_id the id of the tag you want to filter by
     * 
     * @return An array of objects.
     */
    public function filter_by_tag($arr_obj, $tag_id)
    {
        $filtered_notes = array();
        foreach ($arr_obj as $note) {
            $note_tags = explode(",", $note->tags);
            if (in_array($tag_id, $note_tags)) {
                array_push($filtered_notes, $note);
            }
        }

        return $filtered_notes;
    }
}
