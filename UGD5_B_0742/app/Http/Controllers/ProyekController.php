<?php

namespace App\Http\Controllers;

use App\Models\Proyek;
use App\Models\Departemen;
use Exception;
use Illuminate\Http\Request;

class ProyekController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        $proyek = Proyek::get();
        $proyek = Proyek::paginate(5);

        return view('proyek.index', compact('proyek'));
    }

    public function create()
    {
       $departemen = Departemen::all();
       return view('proyek.create' , compact('departemen'));
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
            'nama_proyek'       => 'required',
            'id_departemen'     => 'required',
            'waktu_mulai'       => 'required',
            'waktu_selesai'     => 'required',
            'nilai_proyek'      => 'required',
            'status'            => 'required',
        ], [
            'id_departemen.required' => 'Departemen Tidak Boleh Kosong'
        ]);

        Proyek::create([
            'nama_proyek'       => $request->nama_proyek,
            'id_departemen'     => $request->id_departemen,
            'waktu_mulai'       => $request->waktu_mulai,
            'waktu_selesai'     => $request->waktu_selesai,
            'nilai_proyek'      => $request->nilai_proyek,
            'status'            => $request->status,
        ]);

        try{
           return $request;
            return redirect()->route('proyek.index')->with(['success' => 'Data Berhasil Disimpan']);
        } catch(Exception $e){
            return redirect()->route('proyek.index')->with(['success' => 'Data Berhasil Disimpan']);
        }
      }

      public function destroy($id)
      {
          try{
              $proyek = Proyek::find($id);
              $proyek->delete();
              return redirect()->route('proyek.index')->with(['success' => 'Data Berhasil Dihapus!']);
          }catch(Exception $e){
              return redirect()->route('proyek.index')->with(['error' => 'Data Berhasil dihapus']);
      }
  }

}
