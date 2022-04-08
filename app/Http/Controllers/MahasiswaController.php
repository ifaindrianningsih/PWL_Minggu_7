<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;
use DB;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswa = DB::table('mahasiswa')->paginate(3); // Mengambil semua isi tabel
        // $posts = Mahasiswa::orderBy('nim', 'desc')->paginate(3);
        // return view('mahasiswa.index', compact('mahasiswa'));
        // with('i', (request()->input('page', 1) - 1) * 5);

        //yang semula Mahasiswa::all, diubah menjadi with() yang menyatakan relasi
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(3);
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa,'paginate'=>$paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('mahasiswa.create');
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswa.create',['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Email' => 'required',
            'Nim' => 'required',
            'Nama' => 'required',
            'Tanggal_lahir' => 'required',
            'Alamat' => 'required',
            'kelas' => 'required',
            'Jurusan' => 'required',
        ]);
        
        $mahasiswa = new Mahasiswa;
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->tgl_lahir = $request->get('Tanggal_lahir');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->jurusan = $request->get('Jurusan');
        //$mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        //fungsi eloquent untuk menambah data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        //$mahasiswa = Mahasiswa::find($nim);
        // $Mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();;
        // return view('mahasiswa.detail', compact('Mahasiswa'));
        
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        return view('mahasiswa.detail', ['mahasiswa' => $mahasiswa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        //$Mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->first();;
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswa.edit', compact('mahasiswa','kelas'));
    }

    public function update(Request $request, $nim)
    {
        //melakukan validasi data
        $validate=$request->validate([
            'Email' => 'required',
            'Nim' => 'required',
            'Nama' => 'required',
            'Tanggal_lahir' => 'required',
            'Alamat' => 'required',
            'kelas' => 'required',
            'Jurusan' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        //Mahasiswa::where('nim', $nim)->update($request->all());
        //$Mahasiswa = DB::table('mahasiswa')->where('nim', $nim)->update($validate);
        
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $nim)->first();
        $mahasiswa->email = $request->get('Email');
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->tgl_lahir = $request->get('Tanggal_lahir');
        $mahasiswa->alamat = $request->get('Alamat');
        $mahasiswa->jurusan = $request->get('Jurusan');
        //$mahasiswa->save();

        $kelas = new Kelas;
        $kelas->id = $request->get('kelas');

        //fungsi eloquent untuk menambah data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
        
        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Diupdate');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($nim)->delete();
        return redirect()->route('mahasiswa.index')
        -> with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function cari(Request $request)
	{
		$keyword = $request->cari;
        $paginate = Mahasiswa::where('nama', 'like', "%" . $keyword . "%")->paginate(3);
        return view('mahasiswa.index', compact('paginate'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function nilai($nim){
        $nilai = Mahasiswa::with('kelas', 'matakuliah')->find($nim);
        return view('mahasiswa.nilai',compact('nilai'));
    }


}
