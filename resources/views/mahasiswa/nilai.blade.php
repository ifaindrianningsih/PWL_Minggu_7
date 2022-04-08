@extends('mahasiswa.Layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <h3>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG </h3>
        <h3>KARTU HASIL STUDI (KHS)</h3>
    </div>
    <br><br><br>
        <ul class="list-group list-group-flush">
            <table>
                <tr><strong>NAMA &nbsp;&nbsp;&nbsp;&nbsp;: {{$nilai->nama}}</strong></tr>
                <tr><strong>NIM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$nilai->nim}}</strong></tr>
                <tr><strong>KELAS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$nilai->kelas->nama_kelas}}</strong></tr>
            </table>

            <p></p><p></p>
                <table class="table table-bordered">
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Jam</th>
                        <th>Semester</th>
                        <th>Nilai</th>
                    </tr>
                    @foreach ($nilai->matakuliah as $nil)
                    <tr>
                        <td>{{$nil->nama_matkul}}</td>
                        <td>{{$nil->sks}}</td>
                        <td>{{$nil->jam}}</td>
                        <td>{{$nil->semester}}</td>
                        <td>{{$nil->pivot->nilai}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </ul>

        <a class="btn btn-success mt-3" href="{{ route('mahasiswa.index') }}">Kembali</a>
</div>
@endsection