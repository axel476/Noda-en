@extends('layouts.app')

@section('title', 'Registro de Actividades de Tratamiento - SGPD COAC')
@section('active_key', 'rat')
@section('h1', 'Registro de Actividades de Tratamiento')
@section('subtitle', 'Gestión del Registro de Actividades de Tratamiento (RAT)')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="space-y-1">
            <h2 class="text-2xl font-bold text-gray-900">Actividades de Tratamiento</h2>
            <p class="text-sm text-gray-600">Lista de actividades registradas en el RAT</p>
        </div>
        <a href="{{ route('rat.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2 transition-colors">
            <i class="fas fa-plus"></i>
            Nueva Actividad
        </a>
    </div>

    <!-- Activities List -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 divide-y divide-gray-200">
        @forelse($activities as $a)
            <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4 hover:bg-gray-50">
                <!-- Info -->
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">
                        {{ $a->name }}
                    </h3>
                    <p class="text-sm text-gray-600">
                        ID: {{ $a->pa_id }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="flex gap-2">
                    <a href="{{ route('rat.edit', $a->pa_id) }}"
                       title="Editar actividad"
                       class="px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md flex items-center gap-2 transition-colors">
                        <i class="fas fa-edit"></i>
                        Editar
                    </a>

                    <form method="POST" action="{{ route('rat.destroy', $a->pa_id) }}"
                          class="inline-block" id="delete-form-{{ $a->pa_id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button"
                                onclick="confirmDelete({{ $a->pa_id }}, '{{ $a->name }}')"
                                class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md flex items-center gap-2 transition-colors">
                            <i class="fas fa-trash"></i>
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center">
                <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay actividades registradas</h3>
                <p class="text-gray-600">Comienza creando tu primera actividad de tratamiento.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
function confirmDelete(id, name) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `¿Deseas eliminar la actividad "${name}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}

@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session('success') }}',
        confirmButtonText: 'Aceptar',
        timer: 3000,
        timerProgressBar: true
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}',
        confirmButtonText: 'Aceptar'
    });
@endif
</script>
@endsection
