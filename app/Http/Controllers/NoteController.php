<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;

class NoteController extends Controller
{
    private $noteModel;

    public function __construct()
    {
        $this->noteModel = new Note();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.note.note_all', [
            'title' => 'Note List',
            'notes' => Note::where('user_id', Auth::user()->id)->latest()->get(),
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
        return view('user.note.note_create', [
            'title' => 'Create Note',
            'tags' => Tag::where('user_id', Auth::user()->id)->latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNoteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required'
        ]);

        //tags
        if (isset($request->tag_ids)) {
            $data['tags'] = implode(",", $request->tag_ids);
        } else {
            $data['tags'] = null;
        }

        $data['body'] = encrypt($request->body);
        $data['user_id'] = Auth::user()->id;

        $this->noteModel->note_store($data);

        return redirect()->route('note.create')->with('success', "Note added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $note = Note::find($request->id);

        if ($note->user_id != Auth::user()->id) {
            return redirect()->route('tag.index')->with('error', "Invalid action");
        } else {
            return view('user.note.note_edit', [
                'title' => 'Edit Note',
                'tags' => Tag::where('user_id', Auth::user()->id)->latest()->get(),
                'note' => $note,
                'note_tags' => explode(",", $note->tags)
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNoteRequest  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $currentData = Note::findOrFail($request->id);
        $data = $request->validate([
            'title' => 'required'
        ]);

        //tags
        if (isset($request->tag_ids)) {
            $data['tags'] = implode(",", $request->tag_ids);
        } else {
            $data['tags'] = null;
        }

        $data['body'] = encrypt($request->body);

        if ($currentData->user_id != Auth::user()->id) {
            return redirect()->route('note.index')->with('error', "Invalid action");
        } else {
            $this->noteModel->note_update($data, $request->id);
            return redirect()->route('note.index')->with('success', "Note updated successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
