<?php

namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('notes.index', compact('notes'));
    }
    public function create()
    {
        return view('notes.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'content'=>'required',
        ]);
        Note::create([
            'title'=>$request->title,
            'content'=>$request->content,
        ]);
        return redirect()->route('notes.index');
    }
    public function show($id)
    {
        $note = Note::find($id);
        return view('notes.show', compact('note'));
    }
    public function edit($id)
    {
        $note = Note::find($id);
        return view('notes.edit', compact('note'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'content'=>'required',
        ]);
        $note = Note::find($id);
        $note->update([
            'title'=>$request->title,
            'content'=>$request->content,
        ]);
        return redirect()->route('notes.index');
    }
    public function destroy($id)
    {
        $note = Note::find($id);
        $note->delete();
        return redirect()->route('notes.index');
    }
}
