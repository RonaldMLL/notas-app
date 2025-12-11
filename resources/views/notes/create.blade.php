@extends('layout')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Crear nueva nota</h1>

    <form action="{{ route('notes.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="title" class="block text-gray-700 font-bold mb-2">Título:</label>
            <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
        </div>

        <div>
            <label for="content" class="block text-gray-700 font-bold mb-2">Contenido:</label>
            <textarea name="content" id="content" rows="5" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500"></textarea>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('notes.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Cancelar</a>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Guardar Nota</button>
        </div>
    </form>
@endsection