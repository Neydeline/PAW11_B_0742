@extends('dashboard')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Proyek</h1>
                </div>

                <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ url('proyek')}}">Proyek</a>
                    </li>

                    <li class="breadcrumb-item active">Index</li>
                </ol>
            </div>

            <!-- /.col -->
        </div>
        
        <!-- /.row -->
    </div>

    <!-- /.container-fluid -->
    </div>

    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-0">
                            <a href="{{ route('proyek.create') }}" class="btn btn-md btn-success mb-3">Tambah Proyek</a>
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Nama Proyek</th>
                                        <th class="text-center">Departemen Penanggung Jawab</th>
                                        <th class="text-center">Waktu Mulai</th>
                                        <th class="text-center">Waktu Selesai</th>
                                        <th class="text-center">Nilai Proyek</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                    @forelse ($proyek as $item)
                                    <tr>
                                        <td class="text-center">{{ $item->nama_proyek }}</td>
                                        <td class="text-center">{{ $item->departemens-> nama_departemen }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d F Y')}}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d F Y')}}</td>
                                        <td class="text-center">{{"Rp. ".number_format ($item->nilai_proyek,0,'.', '.' )}}</td>
                                        <td class="text-center">{{ $item->status == 1? "Berjalan":"Selesai"}}</td>
                                        <td class="text-center">
                                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('proyek.destroy', $item->id) }}" method="POST">
                                                    <a href="{{ route('proyek.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>    
                                                </form>
                                        </td>
                                    </tr>

                                    @empty
                                    <div class="alert alert-danger">Data Proyek belum tersedia </div>
                                    
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                    {{$proyek->links()}}
                                </div>
                        </div>
                    </div>
                <!-- /.card-body -->
                </div>
            <!-- /.card -->
            </div>
        <!-- /.col-md-6 -->
        </div>
    <!-- /.row -->
    </div>
<!-- /.container-fluid -->
</div>

@endsection