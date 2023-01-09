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
            'notes' => Note::where([
                'user_id' => Auth::user()->id,
                'is_archive' => 0,
                'is_trash' => 0
            ])->latest()->get(),
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

        if (!empty($data['title'])) {
            //tags
            if (isset($request->tag_ids)) {
                $data['tags'] = implode(",", $request->tag_ids);
            } else {
                $data['tags'] = null;
            }

            $data['body'] = encrypt($request->body);
            $data['user_id'] = Auth::user()->id;

            $this->noteModel->note_store($data);

            return redirect()->back()->with('success', "Note added successfully");
        } else {
            return redirect()->back()->with('error', "Title field must not be empty")->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $note = Note::findOrFail($request->id);

        if ($note->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        } else {
            return view('user.note.note_show', [
                'title' => 'Show Note',
                'tags' => Tag::where('user_id', Auth::user()->id)->latest()->get(),
                'note' => $note,
                'note_tags' => explode(",", $note->tags)
            ]);
        }
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
            return redirect()->back()->with('error', "Invalid action");
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
            return redirect()->back()->with('error', "Invalid action");
        } else {
            $this->noteModel->note_update($data, $request->id);
            return redirect()->back()->with('success', "Note updated successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $currentData = Note::findOrFail($request->id);

        if ($currentData->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        } else {
            $currentData->delete();
            return redirect()->back()->with('success', "Note has been permanently deleted");
        }
    }

    public function archives()
    {
        return view('user.note.note_archives', [
            'title' => 'Note Archives',
            'notes' => Note::where([
                'user_id' => Auth::user()->id,
                'is_archive' => 1,
                'is_trash' => 0
            ])->latest()->get(),
        ]);
    }

    public function archive(Request $request)
    {
        $currentData = Note::findOrFail($request->id);

        if ($currentData->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        } else {
            Note::where('id', $request->id)->update([
                'is_archive' => 1
            ]);
            return redirect()->back()->with('success', "Note archived successfully");
        }
    }

    public function unarchive(Request $request)
    {
        $currentData = Note::findOrFail($request->id);

        if ($currentData->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        } else {
            Note::where('id', $request->id)->update([
                'is_archive' => 0
            ]);
            return redirect()->back()->with('success', "Note unarchived successfully");
        }
    }

    public function delete(Request $request)
    {
        $currentData = Note::findOrFail($request->id);

        if ($currentData->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        } else {
            Note::where('id', $request->id)->update([
                'is_trash' => 1
            ]);
            return redirect()->back()->with('success', "Note deleted successfully");
        }
    }

    public function trash()
    {
        return view('user.note.note_trash', [
            'title' => 'Note Trash',
            'notes' => Note::where([
                'user_id' => Auth::user()->id,
                'is_trash' => 1
            ])->latest()->get(),
        ]);
    }

    public function restore(Request $request)
    {
        $currentData = Note::findOrFail($request->id);

        if ($currentData->user_id != Auth::user()->id) {
            return redirect()->back()->with('error', "Invalid action");
        } else {
            Note::where('id', $request->id)->update([
                'is_trash' => 0
            ]);
            return redirect()->back();
        }
    }
}
