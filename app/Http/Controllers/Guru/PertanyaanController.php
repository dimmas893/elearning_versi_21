<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Category_soal;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index()
    {
        $pertanyaan = Pertanyaan::with('category_soal')->get();
        $category_soal = Category_soal::all();
        return view('frontend.guru.pertanyaan.index', compact('pertanyaan', 'category_soal'));
    }

    public function store(Request $request)
    {
        $create = [
            'category_soal_id' => $request->category_soal_id,
            'question_text' => $request->question_text
        ];

        Pertanyaan::create($create);
        return back()->with('success', 'Berhasil Menambahkan Pertanyaan');
    }

    public function destroy($id)
    {
        $pertanyaan = Pertanyaan::destroy($id);
        return back()->with('success', 'berhasil menghapus');
    }

    public function filter(Request $request)
    {
        $category_soal = Category_soal::all();
        $pertanyaan = Pertanyaan::where('category_soal_id', 'like', '%' . $request->cari . '%')->get();
        return view('frontend.guru.pertanyaan.filter', compact('pertanyaan', 'category_soal'));
    }
}
