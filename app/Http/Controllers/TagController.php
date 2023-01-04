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
        return view('user.tag.tag_create', [
            'title' => 'Create Tag',
            'tags' => Tag::where('user_id', Auth::user()->id)->latest()->get()
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
        $current_tag = Tag::find($request->id);

        if ($current_tag->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        } else {

            // filter all notes by tag_id
            $notes = Note::where([
                'user_id' => Auth::user()->id,
                'is_archive' => 0,
                'is_trash' => 0
            ])->latest()->get();

            $filter_tag_notes = array();
            foreach ($notes as $note) {
                $note_tags = explode(",", $note->tags);
                if (in_array($request->id, $note_tags)) {
                    array_push($filter_tag_notes, $note);
                }
            }

            $filter_archive_note = Note::where([
                'user_id' => Auth::user()->id,
                'is_archive' => 1,
                'is_trash' => 0
            ])->latest()->get();

            $filter_trash_note = Note::where([
                'user_id' => Auth::user()->id,
                'is_trash' => 1
            ])->latest()->get();



            return view('user.tag.tag_show', [
                'title' => sprintf("Notes (%s)", $current_tag->title),
                'note_tag' => $filter_tag_notes,
                'note_archive' => $filter_archive_note,
                'note_trash' => $filter_trash_note,
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
            return redirect()->route('tag.index')->with('error', "Invalid action");
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
