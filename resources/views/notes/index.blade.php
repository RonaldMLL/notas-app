@extends('layout')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Mis Notas</h1>
        <a href="{{ route('notes.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
            + Nueva Nota
        </a>
    </div>

    <div class="grid grid-cols-1 gap-4">
        @foreach ($notes as $note)
            <div class="border border-gray-200 rounded p-4 hover:shadow-lg transition duration-300">
                <h2 class="text-xl font-semibold mb-2">{{ $note->title }}</h2>
                <p class="text-xs text-gray-400 mb-2">
                    {{ $note->created_at->diffForHumans() }}
                </p>
                <p class="text-gray-600 mb-4">{{ Str::limit($note->content, 100) }}</p>

                <div class="flex space-x-2">
                    <a href="{{ route('notes.show', $note->id) }}" class="text-blue-500 hover:underline">Ver</a>
                    <a href="{{ route('notes.edit', $note->id) }}" class="text-yellow-500 hover:underline">Editar</a>
                    
                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('¿Borrar?')">Borrar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection