<x-main :treeMenu="$treeMenu" :subMenu="$subMenu">
     @section('css')
     <style>
          .wrapper {
               margin-top: 12rem;
               position: relative;
               width: 100%;
               top: 0;
               left: 50%;
               transform: translate(-50%);
          }

          .harus::after {
               content: '*';
               color: red;
               margin-left: .3rem;
          }

          .gupinputan {
               position: relative;
          }

          .gupinputan i {
               position: absolute;
               top: 9px;
               right: 5%;
          }

          .gupinputan i:hover {
               cursor: pointer;
          }

          form {
               width: 25%;
          }

          @media (max-width: 767.98px) {
               .wrapper {
                    margin-top: 7rem;
               }

               form {
                    width: 85%;
               }
          }
     </style>
     @endsection


     @if (session()->has('success'))
     <div class="alert alert-success" role="alert">
          Berhasil Mengubah Data
     </div>
     @elseif (session()->has('eror'))
     <div class="alert alert-danger" role="alert">
          {{ session()->get('eror') }}
     </div>
     @endif


     <h1>Change Password</h1>
     <div class="d-flex justify-content-center align-items-center wrapper">
          <form action="{{ route('chpass.update', Auth::user()->id) }}" method="post">
               @method('put')
               @csrf
               <div class="mb-3">
                    <label for="username" class="form-label harus">Username</label>
                    <div class="gupinputan">
                         <input type="text" class="form-control" name="username" id="username"
                              aria-describedby="emailHelp" required readonly
                              value="{{ old('username',Auth::user()->username) }}">
                         @error('username')

                         <div id="emailHelp" class="form-text text-danger">{{ $message }}</div>
                         @enderror
                    </div>
               </div>
               <div class="mb-3">
                    <label for="current_password" class="form-label harus">Old Password</label>
                    <div class="gupinputan">
                         <input type="password" class="form-control" name="current_password" id="current_password"
                              required aria-describedby="curpassHelp">
                         <i class="see bi bi-eye-slash-fill"></i>
                         @error('current_password')
                         <div id="curpassHelp" class="form-text text-danger">{{ $message }}</div>
                         @enderror
                    </div>
               </div>
               <div class="mb-3">
                    <label for="password" class="form-label harus">New Password</label>
                    <div class="gupinputan">
                         <input type="password" class="form-control" name="password" id="password"
                              aria-describedby="passHelp" required>
                         <i class="see bi bi-eye-slash-fill"></i>
                         @error('password')
                         <div id="passHelp" class="form-text text-danger">{{ $message }}</div>
                         @else
                         <div id="passHelp" class="form-text text-warning">Password Menggunakan Sensitive Case</div>
                         @enderror
                    </div>
               </div>
               <div class="mb-3">
                    <label for="password_confirmation" class="form-label harus">Confirm Password</label>
                    <div class="gupinputan">
                         <input type="password" class="form-control" name="password_confirmation"
                              id="password_confirmation" aria-describedby="passHelp" required>
                         <i class="see bi bi-eye-slash-fill"></i>
                         @error('password_confirmation')
                         <div id="passHelp" class="form-text text-danger">{{ $message }}</div>
                         @enderror
                    </div>
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
          </form>
     </div>
     @section('javascript')
     <script>
          // const see = document.querySelectorAll('.see')
               window.onclick = function(e){
                    if (e.target.classList.contains('see')) { 
                         if (e.target.previousElementSibling.getAttribute('type')=='password') {
                                   e.target.previousElementSibling.setAttribute('type','text')
                                   e.target.removeAttribute('class')
                                   e.target.setAttribute('class','see bi-eye-fill')
                              }else{
                                   e.target.previousElementSibling.setAttribute('type','password')
                                   e.target.removeAttribute('class')
                                   e.target.setAttribute('class','see bi-eye-slash-fill')
                              }
                              setTimeout(() => {
                                   e.target.previousElementSibling.setAttribute('type','password')
                                   e.target.removeAttribute('class')
                                   e.target.setAttribute('class','see bi-eye-slash-fill')
                              }, 2000);
                         
                         // console.log(e.target.previousElementSibling);
                    }
               }

     </script>
     @endsection
</x-main>