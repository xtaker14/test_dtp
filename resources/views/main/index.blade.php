@extends('layouts.app')

@section('title')
List
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List Karyawan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('main.create') }}" title="Buat Karyawan Baru"> 
                    <i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No KTP</th>
            <th>Alamat</th>
            <th>Tanggal Buat</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($karyawan as $key)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $key->nama }}</td>
                <td>{{ $key->no_ktp }}</td>
                <td>{{ $key->alamat }}</td>
                <td>{{ date_format($key->creation_date, 'jS M Y') }}</td>
                <td>
                    <form action="{{ route('main.destroy', $key->id) }}" method="POST">

                        <a href="{{ route('main.edit', $key->id) }}">
                            <i class="fas fa-edit  fa-lg"></i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $karyawan->links() !!}

@endsection