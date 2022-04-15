{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
 --}}



 @extends('layouts.includes_site.Header')
 @section('titulo', 'Recuperar palavra passe!')
 @section('conteudo')
 
 
 
 
 
 
 
 
 
 
 <div class="basic-3 ">
     <div class="container">
         <div class="d-flex justify-content-center h-100">
             <div class="card  " style="width: 42%; min-width:340px;" >
              
                 <div class="py-4  d-flex justify-content-center mb-4">
                     <div class="brand_logo_container  ">
                         <img src="{{ asset('/site/images/logo/ZENGÁ ICONE VERMELHO.svg') }}" class="brand_logo " alt="Logo">
                     </div>
                    
                 </div>
                 <div class="py-4  d-flex justify-content-center pt-4">
                     {{-- <h2 class="card-text  text-center">Iniciar sessão</h2> --}}
                     <img src="{{ asset('/site/images/logo/letra.png') }}" width=200 class="" alt="Logo">
                 </div>
                 <div class="py-4">
                     <h2 class="card-text  text-center">Recuperar palavra passe</h2>
                 </div>
                {{-- <div class="d-flex justify-content-center ">
                 <img src="{{ asset('/site/images/logo/ZENGÁ LOGO HORIZONTAL 01.png') }}" class="w-75 h-100" alt="Logo" >
                </div> --}}
                    
               
                 <div class="card-body py-4 ">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                     <form action="{{ route('password.email') }}" method="POST">
                         @csrf
                         
                     
                        
                         <div class="row">
                           
                             <div class="form-group  col-sm-12  ">
                                 <label for="">E-mail:</label>
                                 <input type="email" placeholder="E-mail do cliente" class="form-control input"
                                     name="email" id="" required>
                             </div>
                       
                            
                      
                            
                            
                         </div>
                         <div class="d-flex justify-content-center mt-3 login_container">
                             <button type="submit" name="button" class="btn login_btn">Enviar</button>
                         </div>
                     </form>
 
                     
                 </div>
 
 
 
             </div>
         </div>
     </div> <!-- end of container -->
 </div>
 
 @endsection