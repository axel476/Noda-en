@extends('layouts.app')

@section('title', 'Editar Categoría de Datos - SGPD COAC')
@section('active_key', 'data_category')
@section('h1', 'Editar Categoría de Datos')
@section('subtitle', 'Modificar información de la categoría')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('privacy.data_category.update', $data_category->data_cat_id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-hashtag"></i> Código
                </label>
                <input type="text" name="code" id="code" value="{{ old('code', $data_category->code) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Ej: ID, CONTACT" required maxlength="50">
                @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-tag"></i> Nombre
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $data_category->name) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Ej: Identificación, Contacto" required maxlength="255">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-shield-alt"></i> ¿Es sensible?
                </label>
                <div class="space-y-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="is_sensitive" value="0" {{ old('is_sensitive', $data_category->is_sensitive) == 0 ? 'checked' : '' }}
                               class="text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">No</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="is_sensitive" value="1" {{ old('is_sensitive', $data_category->is_sensitive) == 1 ? 'checked' : '' }}
                               class="text-blue-600 focus:ring-blue-500">
                        <span class="ml-2">Sí</span>
                    </label>
                </div>
                @error('is_sensitive')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-file-alt"></i> Descripción (Opcional)
                </label>
                <textarea name="description" id="description" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                          placeholder="Descripción de la categoría">{{ old('description', $data_category->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('privacy.data_category.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times"></i> Cancelar
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save"></i> Actualizar Categoría
                </button>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: '{{ session('success') }}',
            confirmButtonText: 'Aceptar',
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '{{ session('error') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif
@endsection
