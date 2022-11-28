<?php

namespace App\Http\Controllers;

use App\Mail\PegawaiMail;
use App\Models\Pegawai;
use App\Models\Departemen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PegawaiController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        $pegawai = Pegawai::get();
        $pegawai = Pegawai::latest()->paginate(5);

        return view('pegawai.index', compact('pegawai'));
    }

    /**
     * create
     * 
     * @return void
     */

     public function create()
     {
        $departemen = Departemen::all();
        return view('pegawai.create' , compact('departemen'));
     }
     

     /**
      * store
      *
      * @param Request $request
      * @return void
      */

      public function store(Request $request)
      {
        $this->validate($request, [
            'nomor_induk_pegawai'   => 'required',
            'nama_pegawai'          => 'required|string|max:15',
            'id_departemen'         => 'required',
            'email'                 => 'required|regex:/[-0-9a-zA-Z.+]+@[-0-9a-zA-Z.+]+[.]+[a-zA-Z]{2,4}/',
            'telepon'               => 'required|min:6|max:7|regex:/[0]+[8]/',
            'gender'                => 'required',
            'gaji_pokok'            => 'required',
            'status'                => 'required',
        ], [
            'id_departemen.required' => 'Departemen Tidak Boleh Kosong'
        ]);

        Pegawai::create([
            'nomor_induk_pegawai'   => $request->nomor_induk_pegawai,
            'nama_pegawai'          => $request->nama_pegawai,
            'id_departemen'         => $request->id_departemen,
            'email'                 => $request->email,
            'telepon'               => $request->telepon,
            'gender'                => $request->gender,
            'gaji_pokok'            => $request->gaji_pokok,
            'status'                => $request->status,
        ]);

        try{
           return $request;
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan']);
        } catch(Exception $e){
            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Disimpan']);
        }
      }

      public function edit($id)
    {
        $pegawai = Pegawai::findorfail($id);
        $items = Departemen::find($id);
        return view('pegawai.edit', compact('pegawai', 'items'));
       
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'nomor_induk_pegawai'   => 'required',
            'nama_pegawai'          => 'required|string|max:15',
            'id_departemen'         => 'required',
            'email'                 => 'required|regex:/[-0-9a-zA-Z.+]+@[-0-9a-zA-Z.+]+[.]+[a-zA-Z]{2,4}/',
            'telepon'               => 'required|min:6|max:7|regex:/[0]+[8]/',
            'gender'                => 'required',
            'gaji_pokok'            => 'required',
            'status'                => 'required',
        ]);
        try{
            $pegawai = Departemen::find($id);
            $pegawai->nomor_induk_pegawai = $request->get('nomor_induk_pegawai');
            $pegawai->nama_pegawai = $request->get('nama_pegawai');
            $pegawai->id_departemen = $request->get('id_departemen');
            $pegawai->email = $request->get('email');
            $pegawai->telepon = $request->get('telepon');
            $pegawai->gender = $request->get('gender');
            $pegawai->gaji_pokok = $request->get('gaji_pokok');
            $pegawai->status = $request->get('status');
            $pegawai->save();

            return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Diedit!']);
        }catch(Exception $e){
            return redirect()->route('pegawai.index')->with(['error' => 'Data Berhasil Diedit']);
       
    }
}


      public function destroy($id)
      {
          try{
              $pegawai = Pegawai::find($id);
              $pegawai->delete();
              return redirect()->route('pegawai.index')->with(['success' => 'Data Berhasil Dihapus!']);
          }catch(Exception $e){
              return redirect()->route('pegawai.index')->with(['error' => 'Data Berhasil dihapus']);
      }
  }
}
