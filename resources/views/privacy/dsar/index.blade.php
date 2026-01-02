@extends('layouts.app')

@section('title', 'Solicitudes DSAR - SGPD COAC')
@section('active_key', 'dsar')
@section('h1', 'Solicitudes de Derechos ARCO')
@section('subtitle', 'Gestión de solicitudes de derechos del titular de datos')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="space-y-1">
            <h2 class="text-2xl font-bold text-gray-900">Solicitudes DSAR</h2>
            <p class="text-sm text-gray-600">Lista de solicitudes de derechos del titular</p>
        </div>
        <a href="{{ route('dsar.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2 transition-colors">
            <i class="fas fa-plus"></i>
            Nueva Solicitud
        </a>
    </div>

    <!-- DSAR List -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 divide-y divide-gray-200">
        @forelse($dsars as $d)
            @php
                $daysLeft = \Carbon\Carbon::now()->diffInDays($d->due_at, false);
            @endphp

            <div class="p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4 hover:bg-gray-50">
                <!-- Info -->
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">
                        {{ $d->subject->full_name ?? 'Sin titular' }}
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($d->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($d->status === 'in_progress') bg-blue-100 text-blue-800
                            @elseif($d->status === 'completed') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $d->status_label }}
                        </span>
                        @if($d->evidences->count() > 0)
                            <span class="ml-2 text-blue-600 text-sm">
                                <i class="fas fa-paperclip"></i> {{ $d->evidences->count() }} evidencia(s)
                            </span>
                        @endif
                    </h3>
                    <p class="text-sm text-gray-600 mb-2">
                        Canal: {{ $d->channel }} | Vence: {{ $d->due_at->format('d/m/Y') }}
                    </p>
                    @if($daysLeft < 0)
                        <span class="text-red-600 text-sm font-medium">
                            <i class="fas fa-exclamation-triangle"></i> Vencido
                        </span>
                    @elseif($daysLeft <= 5)
                        <span class="text-yellow-600 text-sm font-medium">
                            <i class="fas fa-clock"></i> Próximo a vencer
                        </span>
                    @endif
                </div>

                <!-- Actions -->
                <div class="flex gap-2">
                    <a href="{{ route('dsar.edit', $d) }}"
                       class="px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md flex items-center gap-2 transition-colors">
                        <i class="fas fa-edit"></i>
                        Editar
                    </a>

                    <a href="{{ route('dsar.edit', $d) }}#evidences"
                       class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md flex items-center gap-2 transition-colors">
                        <i class="fas fa-paperclip"></i>
                        Evidencias
                    </a>
                </div>
            </div>
        @empty
            <div class="p-8 text-center">
                <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No hay solicitudes DSAR</h3>
                <p class="text-gray-600">Comienza creando tu primera solicitud de derechos ARCO.</p>
            </div>
        @endforelse
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
