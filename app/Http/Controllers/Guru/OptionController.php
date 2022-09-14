<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Category_soal;
use App\Models\Option;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{
    public function index()
    {
        $pertanyaan = Pertanyaan::all();
        $category_soal = Category_soal::all();
        // $category_soal = Category_soal::all();
        $option = Option::with('pertanyaan')->get();
        return view('frontend.guru.option.index', compact('pertanyaan', 'option', 'category_soal'));
    }

    public function store(Request $request)
    {
        $create = [
            'pertanyaan_id' => $request->pertanyaan_id,
            'option_text' => $request->option_text,
            'points' => $request->points
        ];

        Option::create($create);
        return back()->with('success', 'berhasil menambah option');
    }

    public function edit($id)
    {

        $pertanyaan = Pertanyaan::all();
        $option = Option::FindOrFail($id);
        return view('frontend.guru.option.edit', compact('option', 'pertanyaan'));
    }

    public function update(Request $request, $id)
    {

        $option = Option::with('pertanyaan')->FindOrFail($id);
        $option->pertanyaan_id = $request->pertanyaan_id;
        $option->option_text = $request->option_text;
        $option->points = $request->points;
        $option->save();
        return view('frontend.guru.option.index', compact('option'));
    }

    public function filter(Request $request)
    {

        $category_soal = Category_soal::all();
        $option = DB::table('option')
            ->leftjoin('pertanyaan', 'option.pertanyaan_id', '=', 'pertanyaan.id')
            ->leftjoin('category_soal', 'pertanyaan.category_soal_id', '=', 'category_soal.id')
            ->where('option.pertanyaan_id', 'like', '%' . $request->cari . '%')
            ->where('pertanyaan.category_soal_id', 'like', '%' . $request->category . '%')
            ->select(
                'pertanyaan.question_text as question_text',
                'category_soal.name as category_soal_name',
                'option.option_text as option_text',
                'option.points as points',
                'option.id as id',
                'category_soal.id as category_id',
            )
            ->groupBy(
                'option.option_text',
                'pertanyaan.question_text',
                'category_soal.name',
                'option.points',
                'option.id',
                'category_soal.id'
            )
            ->limit(10)
            ->orderBy('pertanyaan.category_soal_id', 'desc')
            ->distinct()
            ->get();

        $pertanyaan = Pertanyaan::all();
        // $option = Option::where('pertanyaan_id', 'like', '%' . $request->cari . '%')->get();
        return view('frontend.guru.option.filter', compact('option', 'pertanyaan', 'category_soal'));
    }

    public function destroy($id)
    {
        $category = Option::destroy($id);
        return back()->with('success', 'berhasil menghapus');
    }
}
