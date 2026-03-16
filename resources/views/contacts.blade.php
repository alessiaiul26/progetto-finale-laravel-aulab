<x-layout>
    <div class="container-fluid">
        <div class="row h-100 justify-content-center align-items-center"> 
            {{-- !Messaggio successo INVIO EMAIL --}}
            @if(session()->has('emailSent'))
            <div class="alert alert-success text-center" role="alert">
                <h4 class="alert-heading text-center">Molto bene!</h4>
                <p class="text-center">{{ session('emailSent') }}</p>
                <hr>
                <p class="mb-0 text-center">Controlla Mail trap.</p>
            </div>
            @endif
            
            @if(session()->has('emailError'))
            <div class="alert alert-danger text-center" role="alert">
                <h4 class="alert-heading">Si è verificato un errore!</h4>
                <p>{{ session('emailError') }}</p>
                <hr>
                <p class="mb-0">Per favore, riprova più tardi.</p>
            </div>
            @endif
            
            <h2 class="text-center display-4 mt-5 feedback-title">CONTATTACI</h2>
            <div class="col-12 col-md-8 text-center w-25"> 
                
                
                
                {{-- @if ($errors->any())
                <div>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif --}}
                
                <form action="{{route('contactUs')}}" method="POST" class="mx-auto"> 
                    @csrf
                    <div class="mb-3">
                        <label for="user">Nome e cognome:</label>
                        <input type="text" name="user" id="name" required class="form-control"> 
                    </div>
                    <div class="mb-3">
                        <label for="email">Indirizzo email:</label>
                        <input type="email" name="email" id="email" required class="form-control"> 
                    </div>
                    <div class="mb-3">
                        <label for="message">La tua richiesta</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-dark mb-5">Invia</button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
