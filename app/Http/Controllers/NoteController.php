<?php
namespace App\Http\Controllers;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- AGREGA ESTO
class NoteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Agregamos: where('user_id', auth()->id())
        // Esto dice: "Trae las notas DONDE el user_id sea igual al MÍO"
        $notes = Note::where('user_id', Auth::id()) 
                ->where(function($query) use ($search) {
                    if ($search) {
                        $query->where('title', 'like', '%'.$search.'%')
                              ->orWhere('content', 'like', '%'.$search.'%');
                                }
                })
                ->latest()
                ->paginate(5);
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
            'user_id'=>Auth::id(), // <--- AGREGA ESTO
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
