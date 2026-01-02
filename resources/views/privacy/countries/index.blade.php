@extends('layouts.app')

@section('title', 'Países - SGPD COAC')
@section('active_key', 'countries')
@section('h1', 'Gestión de Países')
@section('subtitle', 'Administrar países para transferencias internacionales')

@section('content')
<div class="space-y-6">
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
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="space-y-1">
            <h2 class="text-2xl font-bold text-gray-900">Países</h2>
            <p class="text-sm text-gray-600">Lista de países disponibles para transferencias</p>
        </div>
        <a href="{{ route('privacy.countries.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2 transition-colors">
            <i class="fas fa-plus"></i>
            Nuevo País
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Código ISO
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nombre
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($countries as $country)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $country->iso_code }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $country->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('privacy.countries.edit', $country->country_id) }}"
                               class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form method="POST" action="{{ route('privacy.countries.destroy', $country->country_id) }}"
                                  class="inline-block" id="delete-form-{{ $country->country_id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                        onclick="confirmDelete({{ $country->country_id }}, '{{ $country->name }}')"
                                        class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: `¿Deseas eliminar el país "${name}"?`,
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
</script>
@endsection