@extends('index')

@if (session('success'))
    <script>
        alert('{{session('success')}}')
    </script>
@elseif(session('error'))
    <script>
        alert('{{session('error')}}')
    </script>
@endif

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Administrator</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $i => $admin)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>
                                        <img src="{{asset('img/admin/'.$admin->admin_foto)}}" alt="No Image" width="100">
                                    </td>
                                    <td>{{$admin->admin_nama}}</td>
                                    <td>{{$admin->admin_username}}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#adminedit{{$admin->admin_id}}">
                                            Ubah
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#admindelete{{$admin->admin_id}}">
                                            Hapus
                                        </button>

                                        <div class="modal fade" id="adminedit{{$admin->admin_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Ubah Data Administrator</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" enctype="multipart/form-data" action="{{route('adminupdate')}}">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$admin->admin_id}}">
                                                        <div class="form-group">
                                                          <label for="">Nama Administrator</label>
                                                          <input type="text" class="form-control" name="nama" value="{{$admin->admin_nama}}">
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Username</label>
                                                          <input type="text" class="form-control" name="username" value="{{$admin->admin_username}}">
                                                        </div>
                                                        <div class="form-group">
                                                          <img src="{{asset('img/admin/'.$admin->admin_foto)}}" alt="No Image" width="100">
                                                          <input type="text" class="form-control" name="fotolama" value="{{$admin->admin_foto}}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Foto</label>
                                                          <input type="file" class="form-control" name="foto">
                                                        </div>
                                                        <div class="form-group">
                                                          <label for="">Password</label>
                                                          <input type="password" class="form-control" name="password" value="{{$admin->admin_password}}">
                                                        </div>
                                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                          </div>
                                                    </form>
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="admindelete{{$admin->admin_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                              <div class="modal-content">
                                                <div class="modal-header">
                                                  <h5 class="modal-title" id="exampleModalLabel">Hapus Data Administrator</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>

                                                <div class="modal-body">
                                                    Yakin ingin menghapus data - {{$admin->admin_nama}}?
                                                </div>
                                                
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <a href="{{route('admindelete', $admin->admin_id)}}}" class="btn btn-primary">Hapus</a>
                                                </div>
                                                
                                              </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data Administrator</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" action="{{route('adminadd')}}">
                @csrf
                <div class="form-group">
                  <label for="">Nama Administrator</label>
                  <input type="text" class="form-control" name="nama">
                </div>
                <div class="form-group">
                  <label for="">Username</label>
                  <input type="text" class="form-control" name="username">
                </div>
                <div class="form-group">
                  <label for="">Foto</label>
                  <input type="file" class="form-control" name="foto">
                </div>
                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" class="form-control" name="password">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
            </form>
        </div>
        
      </div>
    </div>
  </div>

@endsection