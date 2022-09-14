<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Category_soal;
use Illuminate\Http\Request;

class Category_soalController extends Controller
{
    public function index()
    {
        $category_soal = Category_soal::all();
        return view('frontend.guru.category_soal.index', compact('category_soal'));
    }

    public function store(Request $request)
    {
        $create = [
            'name' => $request->name
        ];

        Category_soal::create($create);

        return back()->with('success', 'Menambah Data Category soal berhasil');
    }

    public function destroy($id)
    {

        $category = Category_soal::destroy($id);
        return back()->with('success', 'berhasil menghapus');
    }

    public function edit($id)
    {
        $category_soal = Category_soal::FindOrFail($id);
        return view('frontend.guru.category_soal.edit', compact('category_soal'));
    }

    public function update(Request $request, $id)
    {
        $category_soal_update = Category_soal::FindOrFail($id);
        $category_soal_update->name = $request->name;
        $category_soal_update->save();
        $category_soal = Category_soal::all();
        return view('frontend.guru.category_soal.index', compact('category_soal'));
    }

    public function filter(Request $request)
    {
        $category_soal = Category_soal::where('name', 'like', '%' . $request->cari . '%')->get();
        return view('frontend.guru.category_soal.filter', compact('category_soal'));
    }
}
