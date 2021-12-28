<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="{{ asset('mazer/css/bootstrap.css') }}">
     <link rel="stylesheet" href="{{ asset('mazer/vendors/bootstrap-icons/bootstrap-icons.css')}}">
     <title>Document</title>
     <style>
          main {
               position: relative;
               height: 100vh;
          }

          main .card {
               max-width: 400px;
               width: 100%;
               height: 600px;
          }

          .foter {
               position: absolute;
               bottom: 10px;
               right: 50%;
               transform: translateX(50%);
          }

          .inputgrup {
               position: relative;
          }

          .inputgrup i {
               position: absolute;
               top: 9px;
               right: 5%;
          }

          .inputgrup i:hover {
               cursor: pointer;
          }
     </style>
</head>

<body>
     <main class="d-flex justify-content-center align-items-center">
          <div class="card p-3 shadow">
               <div class="card-body">
                    <h1 class="text-center mt-5 text-primary">WELCOME</h1>
                    <h4 class="text-center mb-3">General Affair Apps</h4>
                    <div class="mt-5 p-3">
                         <form action="{{ route('login') }}" method="post">
                              @csrf
                              <div class="mb-3">
                                   <label for="username" class="form-label">Username</label>
                                   <input type="text" class="form-control" id="username" name="username">
                                   @error('username')
                                   <div class="form-text text-danger">{{ $message }}</div>
                                   @else
                                   <div class="form-text">Jangan Share Username Anda</div>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <label for="password" class="form-label">Password</label>
                                   <div class="inputgrup">
                                        <input type="password" class="form-control" id="password" name="password">
                                        <i id="see" class="bi bi-eye-slash-fill"></i>
                                        <div class="form-text">Sensitife case password</div>
                                   </div>

                              </div>
                              <button type="submit" class="btn btn-primary">Login</button>
                         </form>
                    </div>
                    <div class="foter"><small>Support By : IT @2022</small></div>
               </div>

          </div>
     </main>
</body>


<script src="{{ asset('mazer/js/bootstrap.bundle.min.js') }}"></script>
<script>
     const foter = document.querySelector('.foter')
     const see = document.querySelector('#see')
     const password = document.querySelector('#password')
     foter.onmouseover = function(){
          this.style.cursor = 'pointer';
     }

     see.onclick = function(e){
          if (password.getAttribute('type')=='password') {
               password.setAttribute('type','text')
               this.classList.remove('bi-eye-slash-fill')
               this.classList.add('bi-eye-fill')
          }else{
               password.setAttribute('type','password')
               this.classList.remove('bi-eye-fill')
               this.classList.add('bi-eye-slash-fill')
          }
          setTimeout(() => {
               password.setAttribute('type','password')
               this.classList.remove('bi-eye-fill')
               this.classList.add('bi-eye-slash-fill')
          }, 2000);
     }
</script>

</html>