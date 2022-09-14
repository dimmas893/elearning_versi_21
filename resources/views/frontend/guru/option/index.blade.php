@extends('layouts.template_guru')
@section('contents')
<div>
<x-alert />
            <div class="card card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <form action="{{ route('option.filter') }}" method="get" class="site-block-top-search" >
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                      <select class="form-control" name="category" id="category">
                                                            @foreach($category_soal as $p)
                                                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="submit" class="btn btn-primary" value="cari">
                                                    </div>
                                                </div>
                                                {{-- <a href="{{ route('kelas-masuk' ,encrypt($jadwal->id))}}" class="btn btn-success">Kembali</a> --}}
                                            </form>
                                            <form action="{{ route('option.filter') }}" method="get" class="site-block-top-search" >
                                                @csrf
                                                <div class="row mb-3">
                                                    <div class="col-6">
                                                        <select class="form-control" name="cari" id="cari">
                                                            @foreach($pertanyaan as $p)
                                                                <option value="{{ $p->id }}">{{ $p->question_text }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="submit" class="btn btn-primary" value="cari">
                                                    </div>
                                                </div>
                                                {{-- <a href="{{ route('kelas-masuk' ,encrypt($jadwal->id))}}" class="btn btn-success">Kembali</a> --}}
                                            </form>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-right">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create">
                                                    create
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">    
                                        <table class="table table-hover">
                                            <thead>
                                                <td>No</td>
                                                <td>pertanyaan</td>
                                                <td>category soal</td>
                                                <td>option text</td>
                                                <td>point</td>
                                                <td>Action</td>
                                            </thead>
                                            <tbody>
                                                {{-- <h1>semua ulangan tampil</h1> --}}
                                                @foreach($option as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p->pertanyaan->question_text }}</td>
                                                        <td>{{ $p->pertanyaan->category_soal->name }}</td>
                                                        <td>{{ $p->option_text }}</td>
                                                        <td>{{ $p->points }}</td>
                                                        <td>
                                                            <a href="{{ route('option.edit', $p->id) }}" class="btn btn-primary">edit</a>
                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">
                                                                delete
                                                            </button>
                                                            <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin menghapusnya ?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('option.destroy', $p->id) }}" method="DELETE">
                                                                        @csrf
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
                                                                        <input type="submit" class="btn btn-danger" value="deletes">
                                                                    </form>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Option Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('option.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label>pertanyaan</label>
                {{-- <input type="hidden" value=""> --}}
                <select class="form-control" name="pertanyaan_id" id="pertanyaan_id">
                    <option>---pilih pertanyaan---</option>
                    @foreach($pertanyaan as $p)
                        <option value="{{ $p->id }}">{{ $p->category_soal_id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Option text</label>
                <input type="text" class="form-control" placeholder="option text" name="option_text">
            </div>
            <div class="mb-3">
                <label>Points</label>
                <input type="integer" class="form-control" placeholder="masukan points" name="points">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

</div>
@endsection