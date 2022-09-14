@extends('layouts.template_guru')
@section('contents')

<x-alert />
    <form action="{{ route('option.update' , $option->id) }}" method="POST">
        @csrf
           <div class="mb-3">
                <label>pertanyaan</label>
                <select class="form-control" name="pertanyaan_id" id="pertanyaan_id">
                    <option value="{{ $option->pertanyaan->question_text }}">{{ $option->pertanyaan->question_text }}</option>
                    {{-- @foreach($pertanyaan as $p)
                        <option value="{{ $p->id }}">{{ $p->question_text }}</option>
                    @endforeach --}}
                </select>
            </div>
        <input type="submit" class="btn btn-primary mt-2" value="save">
    </form>
@endsection