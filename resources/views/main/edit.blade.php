@extends('layouts.app')

@section('title')
Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Karyawan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('main.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ups!</strong> Ada beberapa masalah dengan masukan Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('main.update', $karyawan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-7 col-sm-7 col-md-7">
                <div class="form-group">
                    <strong>Nama *:</strong>
                    <input value="{{ $karyawan->nama }}" type="text" name="nama" class="form-control" placeholder="Nama">
                </div>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-7">
                <div class="form-group">
                    <strong>Alamat:</strong>
                    <textarea class="form-control" style="height:100px" name="alamat"
                        placeholder="Alamat">{{ trim($karyawan->alamat) }}</textarea>
                </div>
            </div>
            <div class="col-xs-7 col-sm-7 col-md-7">
                <div class="form-group">
                    <strong>No KTP *:</strong>
                    <input value="{{ $karyawan->no_ktp }}" type="number" name="no_ktp" class="form-control" placeholder="No KTP">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <div class="form-group">
                    <strong>
                        Pendidikan&nbsp;
                        {{-- <button type="button" class="btn-add btn btn-sm btn-success">
                            <i class="fa fa-plus"></i>
                        </button> --}}
                    </strong>
                    <table class="table table-pendidikan table-bordered" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <td style="width: 30%;">Nama Sekolah/Universitas *</td>
                                <td style="width: 30%;">Jurusan *</td>
                                <td style="width: 15%;">Tahun Masuk *</td>
                                <td style="width: 15%;">Tahun Lulus *</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendidikan as $key_pendidikan)
                                <tr>
                                    <td>
                                        <input type="hidden" name="pendidikan_id[]" value="{{ $key_pendidikan->id }}">
                                        <input value="{{ $key_pendidikan->nama_sekolah }}" name="nama_sekolah[]" type="text" class="form-control">
                                    </td>
                                    <td>
                                        <input value="{{ $key_pendidikan->jurusan }}" name="jurusan[]" type="text" class="form-control">
                                    </td>
                                    <td>
                                        <input value="{{ $key_pendidikan->tahun_masuk }}" name="tahun_masuk[]" type="number" class="form-control">
                                    </td>
                                    <td>
                                        <input value="{{ $key_pendidikan->tahun_lulus }}" name="tahun_lulus[]" type="number" class="form-control">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <div class="form-group">
                    <strong>
                        Pengalaman Kerja&nbsp;
                        {{-- <button type="button" class="btn-add btn btn-sm btn-success">
                            <i class="fa fa-plus"></i>
                        </button> --}}
                    </strong>
                    <table class="table table-pengalaman table-bordered" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <td style="width: 30%;">Perusahaan *</td>
                                <td style="width: 25%;">Jabatan *</td>
                                <td style="width: 10%;">Tahun *</td>
                                <td style="width: 25%;">Keterangan</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengalaman_kerja as $key_pengalaman)
                                <tr>
                                    <td>
                                        <input type="hidden" name="pengalaman_id[]" value="{{ $key_pengalaman->id }}">
                                        <input value="{{ $key_pengalaman->perusahaan }}" name="perusahaan[]" type="text" class="form-control">
                                    </td>
                                    <td>
                                        <input value="{{ $key_pengalaman->jabatan }}" name="jabatan[]" type="text" class="form-control">
                                    </td>
                                    <td>
                                        <input value="{{ $key_pengalaman->tahun }}" name="tahun[]" type="number" class="form-control">
                                    </td>
                                    <td>
                                        <input value="{{ $key_pengalaman->keterangan }}" name="keterangan[]" type="text" class="form-control">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection