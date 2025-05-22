@extends('layouts.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">List Kanji</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">List Kanji</li>
            </ol>
        </div>
        <div class="d-flex">
            <div class="justify-content-center">
                <a href="{{route('kanji.create')}}">
                    <button type="button" class="btn btn-success my-2 btn-icon-text">
                        <i class="fe fe-file-plus me-2"></i> Tambah Data
                    </button>
                </a>
            </div>
        </div>
    </div>
    <!-- Row -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="exportexample" class="table table-bordered border-t0 key-buttons text-nowrap w-100">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Character</th>
                                <th>Onyomi</th>
                                <th>Kunyomi</th>
                                <th>Meaning</th>
                                <th>Category</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($kanjis as $kanji)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$kanji->character}}</td>
                                    <td>{{$kanji->onyomi}}</td>
                                    <td>{{$kanji->kunyomi}}</td>
                                    <td>{{$kanji->meaning}}</td>
                                    <td>{{$kanji->category}}</td>
                                    <td>{{$kanji->level}}</td>
                                    <td>
                                        <a href="{{route('kanji.destroy',$kanji->id)}}">
                                            <button type="button" class="btn btn-outline-danger my-2 btn-icon-text">
                                                <i class="fe fe-trash-2"></i>
                                            </button>
                                        </a>
                                        <a href="{{route('kanji.edit',$kanji->id)}}">
                                            <button type="button" class="btn btn-outline-primary my-2 btn-icon-text">
                                                <i class="fe fe-edit-2"></i>
                                            </button>
                                        </a>
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
    <!-- End Row -->

@endsection

