@extends('layouts.app')

@section('title', 'Editar País - SGPD COAC')
@section('active_key', 'countries')
@section('h1', 'Editar País')
@section('subtitle', 'Modificar información del país')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Flash Messages -->
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
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('privacy.countries.update', $country->country_id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="iso_code" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-flag"></i> Código ISO
                </label>
                <input type="text" name="iso_code" id="iso_code" value="{{ old('iso_code', $country->iso_code) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Ej: EC, US, MX" required maxlength="10">
                @error('iso_code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-map-marker-alt"></i> Nombre del País
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $country->name) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Ej: Ecuador, Estados Unidos" required maxlength="255">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('privacy.countries.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times"></i> Cancelar
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save"></i> Actualizar País
                </button>
            </div>
        </form>
    </div>
</div>
@endsection