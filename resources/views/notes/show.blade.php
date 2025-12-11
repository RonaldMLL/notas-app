@extends('layout')

@section('content')
    <div class="mb-6">
        <div class="flex justify-between items-start">
            <h1 class="text-3xl font-bold text-gray-800">{{ $note->title }}</h1>
            
            <div class="flex space-x-2">
                <a href="{{ route('notes.edit', $note->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Editar
                </a>
                
                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300" onclick="return confirm('¿Estás seguro de querer eliminar esta nota?')">
                        Borrar
                    </button>
                </form>
            </div>
        </div>

        <p class="text-sm text-gray-500 mt-2">
            Creado {{ $note->created_at->diffForHumans() }} 
            @if($note->created_at != $note->updated_at)
                &bull; Editado {{ $note->updated_at->diffForHumans() }}
            @endif
        </p>
    </div>

    <hr class="border-gray-200 my-6">

    <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
        {{-- nl2br permite que los saltos de línea que escribiste en el textarea se respeten --}}
        {!! nl2br(e($note->content)) !!}
    </div>

    <div class="mt-8">
        <a href="{{ route('notes.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold flex items-center">
            &larr; Volver a la lista
        </a>
    </div>
@endsection