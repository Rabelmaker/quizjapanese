@extends('layouts.layout')
@section('content')
    <div class="page-header">
        <div>
            <h2 class="main-content-title tx-24 mg-b-5">Tambah Kanji</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Kanji</li>
            </ol>
        </div>

    </div>
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('kanji.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="mode" value="add">
                        <div class="row row-sm">
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Character</label>
                                        <input class="form-control" name="character" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Onyomi</label>
                                        <input class="form-control" name="onyomi" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Kunyomi</label>
                                        <input class="form-control" name="kunyomi" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Meaning</label>
                                        <input class="form-control" name="meaning" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Category</label>
                                        <input class="form-control" name="category" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Level</label>
                                        <input class="form-control" name="level" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 col-xl-6">
                                <div class="">
                                    <div class="form-group">
                                        <label class="">Hint</label>
                                        <input class="form-control" name="hint" required="" type="text">
                                    </div>
                                </div>
                            </div>
                            <button class="btn ripple btn-main-primary btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
