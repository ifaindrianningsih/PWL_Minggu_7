@extends('mahasiswa.layout')

@section('content')

    <div class="container mt-5">

        <div class="row justify-content-center align-items-center">
            <div class="card" style="width: 24rem;">
                <div class="card-header">
                    Edit Mahasiswa
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="post" action="{{ route('mahasiswa.update', $mahasiswa->nim) }}" id="myForm">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="text" name="Email" class="form-control" id="Email" value="{{ $mahasiswa->email }}" aria-describedby="Email" >
                        </div>
                        <div class="form-group">
                            <label for="Nim">Nim</label>
                            <input type="text" name="Nim" class="form-control" id="Nim" value="{{ $mahasiswa->nim }}" aria-describedby="Nim" >
                        </div>
                        <div class="form-group">
                            <label for="Nama">Nama</label>
                            <input type="text" name="Nama" class="form-control" id="Nama" value="{{ $mahasiswa->nama }}" aria-describedby="Nama" >
                        </div>
                        <div class="form-group">
                            <label for="Tanggal_lahir">Tanggal lahir</label>
                            <input type="text" name="Tanggal_lahir" class="form-control" id="Tanggal_lahir" value="{{ $mahasiswa->tgl_lahir }}" aria-describedby="Tanggal_lahir" >
                        </div>
                        <div class="form-group">
                            <label for="Alamat">Alamat</label>
                            <input type="text" name="Alamat" class="form-control" id="Alamat" value="{{ $mahasiswa->alamat }}" aria-describedby="Alamat" >
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            {{-- <input type="kelas" name="kelas" class="form-control" id="kelas" value="{{ $mahasiswa->kelas->nama_kelas }}" aria-describedby="kelas" > --}}
                            <select name="kelas" id="kelas" class="form-control">
                                @foreach ($kelas as $kls)
                                    <option value="{{$kls->id}}" {{$mahasiswa->kelas_id == $kls->id ? 'selected' : ''}} >{{$kls->nama_kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Jurusan">Jurusan</label>
                            <input type="Jurusan" name="Jurusan" class="form-control" id="Jurusan" value="{{ $mahasiswa->jurusan }}" aria-describedby="Jurusan" >
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection