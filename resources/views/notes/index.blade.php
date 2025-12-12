@extends('layout')

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Mis Notas</h1>
            <a href="{{ route('notes.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                + Nueva Nota
            </a>
        </div>

        <form action="{{ route('notes.index') }}" method="GET" class="flex gap-2">
            <input 
                type="text" 
                name="search" 
                placeholder="Buscar nota..." 
                value="{{ request('search') }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500"
            >
            <button type="submit" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                Buscar
            </button>
        </form>
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
    <div class="mt-6">
        {{ $notes->appends(['search' => request('search')])->links() }}
    </div>  
@endsection