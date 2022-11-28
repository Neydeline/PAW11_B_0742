<?php

namespace App\Http\Controllers;

use App\Mail\DepartemenMail; /* import model mail*/
use App\Models\Departemen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;
use App\Http\Resources\DepartemenResource;
use Illuminate\Support\Facades\Validator;

class DepartemenController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        // $departemen = Departemen::get();
        // $departemen = Departemen::paginate(5);
        // get departemen
        $departemen = Departemen::latest()->get();

        return new DepartemenResource(true, 'List Data Departemen', $departemen);
    }

    /**
     * create
     * 
     * @return void
     */
    public function create()
    {
        return view('departemen.create');
    }


    /**
     * store
     * 
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        //Validasi Formulir
        $validator = Validator::make($request->all(), [
            'nama_departemen' => 'required',
            'nama_manager'    => 'required',
            'jumlah_pegawai'  => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //Fungsi simpan data ke dalam database
        $departemen = Departemen::create([
            'nama_departemen'   => $request->nama_departemen,
            'nama_manager'      => $request->nama_manager,
            'jumlah_pegawai'    => $request->jumlah_pegawai
        ]);

        return new DepartemenResource(true, 'Data Departemen Berhasil Ditambahkan!', $departemen);
        // try{
        //     //Mengisi variabel yang akan ditampilkan pada view mail
        //     $content = [
        //         'body' => $request->nama_departemen,
        //     ];

        //     //Mengirim email ke emailtujuan@gmail.com
        //     Mail::to('neydeline07@gmail.com')->send(new DepartemenMail($content));

        //     return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Disimpan, email telah terkirim!']);
        // }catch(Exception $e){
        //     return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Disimpan, namun gagal mengirim email!']);
        // }
    }

    public function edit($id)
    {
        $departemen = Departemen::find($id);
        return view('departemen.edit', ['item'=>$departemen]);
       
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'nama_departemen' => 'required',
            'nama_manager'    => 'required',
            'jumlah_pegawai'  => 'required'
        ]);
        try{
            $departemen = Departemen::find($id);
            $departemen->nama_departemen = $request->get('nama_departemen');
            $departemen->nama_manager = $request->get('nama_manager');
            $departemen->nama_departemen = $request->get('jumlah_pegawai');
            $departemen->save();

            return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Diedit!']);
        }catch(Exception $e){
            return redirect()->route('departemen.index')->with(['error' => 'Data Berhasil Diedit']);
       
    }
}

    public function destroy($id)
    {
        try{
            $departemen = Departemen::find($id);
            $departemen->delete();
            return redirect()->route('departemen.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }catch(Exception $e){
            return redirect()->route('departemen.index')->with(['error' => 'Data Berhasil dihapus']);
    }
}
}
