@extends('mahasiswa.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
                <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
            <div class="float-right my-2">
                <a class="btn btn-success" href="{{ route('mahasiswa.create') }}"> Input Mahasiswa</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Search form -->
    <form class="form" method="get" action="{{ route('cari') }}">
        <div class="form-group w-100 mb-3">
            <label for="search" class="d-block mr-2">Pencarian Data Mahasiswa</label>
            <input type="text" name="cari" class="form-control w-50 d-inline" id="cari" placeholder="Nama Mahasiswa">
            <button type="submit" class="btn btn-primary mb-1">Cari</button>
        </div>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>Email</th>
            <th>Nim</th>
            <th>Nama</th>
            <th>Tanggal lahir</th>
            <th>Alamat</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($paginate as $mhs)
        <tr>

            <td>{{ $mhs ->email }}</td>
            <td>{{ $mhs ->nim }}</td>
            <td>{{ $mhs ->nama }}</td>
            <td>{{ $mhs ->tgl_lahir }}</td>
            <td>{{ $mhs ->alamat }}</td>
            <td>{{ $mhs ->kelas->nama_kelas }}</td>
            <td>{{ $mhs ->jurusan }}</td>
            <td>
            <form action="{{ route('mahasiswa.destroy',['mahasiswa'=>$mhs->nim]) }}" method="POST">

                <a class="btn btn-info" href="{{ route('mahasiswa.show',$mhs->nim) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('mahasiswa.edit',$mhs->nim) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="pull-right">
        {{$paginate->links()}}
    </div>
@endsection