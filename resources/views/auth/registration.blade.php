<x-main :treeMenu="$treeMenu" :subMenu="$subMenu">
     <div class="container-fluid">
          <div class="card">
               <div class="card-body">
                    <div class="card-title">
                         <h5 class="mb-3">Registrasi</h5>
                         <div class="d-flex align-items-center">
                         </div>
                    </div>
               </div>
          </div>

          @if (session()->has('success'))
          <div class="alert alert-success" role="alert">
               Berhasil Menambahkan Data
          </div>
          @elseif (session()->has('eror'))
          <div class="alert alert-danger" role="alert">
               {{ session()->get('eror') }}
          </div>
          @endif
          <div class="card">
               <div class="card-body">
                    <div id="wrapper">
                         <div class="row g-5">
                              <div class="col">
                                   <form action="{{ route('register') }}" method="post">
                                        @csrf
                                        <div class="row mb-3">
                                             <label for="username" class="col-sm-2 col-form-label">Username</label>
                                             <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="username" name="username">
                                                  @error("username")
                                                  <small class="text-danger">{{ $message }}</small>
                                                  @enderror
                                             </div>
                                        </div>
                                        <div class="row mb-3">
                                             <label for="name" class="col-sm-2 col-form-label">Nama
                                                  Karyawan</label>
                                             <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="name" name="name">
                                                  @error("name")
                                                  <small class="text-danger">{{ $message }}</small>
                                                  @enderror
                                             </div>
                                        </div>
                                        <div class="row mb-3">
                                             <label for="password" class="col-sm-2 col-form-label">Password</label>
                                             <div class="col-sm-10">
                                                  <input type="text" class="form-control" id="password" name="password">
                                                  @error("password")
                                                  <small class="text-danger">{{ $message }}</small>
                                                  @enderror
                                             </div>
                                        </div>
                                        <div class="row mb-3">
                                             <label for="role" class="col-sm-2 col-form-label">Role</label>
                                             <div class="col-sm-10">
                                                  <select class="form-select" name="role"
                                                       aria-label="Default select example">
                                                       <option value="" selected>Select Role</option>
                                                       <option value="1">End User</option>
                                                       <option value="2">Kepala GA</option>
                                                       <option value="100">Demo</option>
                                                  </select>
                                                  @error("role")
                                                  <small class="text-danger">{{ $message }}</small>
                                                  @enderror
                                             </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Register</button>
                                   </form>
                              </div>
                              <div class="col">
                                   <table class="table">
                                        <thead>
                                             <tr>
                                                  <th scope="col">Username</th>
                                                  <th scope="col">Nama</th>
                                                  <th style="width: 15%;" scope="col">Role</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             @foreach ($users as $user)
                                             <tr>
                                                  <td>{{ $user->username }}</td>
                                                  <td>aziz nur ihsan</td>
                                                  <td>@if ($user->role == 1)
                                                       End User
                                                       @elseif ($user->role == 100)
                                                       Demo
                                                       @elseif ($user->role == 2)
                                                       Kepala
                                                       @endif</td>
                                             </tr>
                                             @endforeach
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</x-main>