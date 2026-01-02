@extends('layouts.app')

@section('title', 'Editar Curso de Capacitación - SGPD COAC')
@section('active_key', 'training')
@section('h1', 'Editar Curso de Capacitación')
@section('subtitle', 'Modificar curso de formación')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <form method="POST" action="{{ route('training.courses.update', $course) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-graduation-cap"></i> Nombre
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Nombre del curso" required maxlength="255">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="renewal_days" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-alt"></i> Renovación (días)
                </label>
                <input type="number" name="renewal_days" id="renewal_days" value="{{ old('renewal_days', $course->renewal_days) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Días para renovación" min="1">
                @error('renewal_days')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="mandatory_flag" value="1"
                           {{ old('mandatory_flag', $course->mandatory_flag) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-exclamation-triangle"></i> Curso obligatorio
                    </span>
                </label>
                @error('mandatory_flag')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('training.courses.index') }}"
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                    <i class="fas fa-times"></i> Cancelar
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700 transition-colors">
                    <i class="fas fa-save"></i> Actualizar Curso
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
