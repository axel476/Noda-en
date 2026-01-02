<?php

namespace App\Http\Controllers\Dsar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Privacy\DsarEvidence;
use App\Models\Privacy\DsarRequest;
use App\Models\Privacy\DocumentVersion;

class DsarEvidenceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'dsar_id' => 'required|exists:' . DsarRequest::class . ',dsar_id',
            'doc_ver_id' => 'required|exists:' . DocumentVersion::class . ',doc_ver_id',
            'description' => 'nullable|string',
        ]);

        DsarEvidence::create([
            'dsar_id' => $request->dsar_id,
            'doc_ver_id' => $request->doc_ver_id,
            'description' => $request->description,
            'attached_at' => now(),
        ]);

        return back()->with('exito', 'Evidencia agregada correctamente');
    }
}

