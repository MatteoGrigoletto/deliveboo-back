@extends('layouts.admin')

@section('page-title')
    Modifica 
@endsection

@section('content')
    <div class="container mt-5">
        <h1>Modifica il tuo Ristorante</h1>
        <form action="{{ route('admin.restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('PUT')
            {{-- campo name --}}
            <div class="mb-3">
               <label for="name" class="form-label"><h6>Nome*</h6></label>
               <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome del tuo ristorante" value="{{ old('name', $restaurant->name) }}">
               @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo city --}}
            <div class="mb-3">
                <label for="city" class="form-label"><h6>Città*</h6></label>
                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Inserisci la città del tuo ristorante" value="{{old('city', $restaurant->city)}}">
                @error('city')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo indirizzo --}}
            <div class="mb-3">
                <label for="street_address" class="form-label"><h6>Indirizzo*</h6></label>
                <input type="text" class="form-control @error('street_address') is-invalid @enderror" id="street_address" name="street_address" placeholder="Inserisci l'indirizzo del tuo ristorante" value="{{old('street_address', $restaurant->street_address)}}">
                @error('street_address')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo codice postale --}}
            <div class="mb-3">
                <label for="postal_code" class="form-label"><h6>Codice Postale*</h6></label>
                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" placeholder="Inserisci il codice postale" value="{{old('postal_code', $restaurant->postal_code)}}">
                @error('postal_code')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo partita iva --}}
            <div class="mb-3">
                <label for="vat_number" class="form-label"><h6>Partita IVA*</h6></label>
                <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number" placeholder="Inserisci la partita IVA" value="{{ old('vat_number', $restaurant->vat_number) }}">
                @error('vat_number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo immagine --}}
            <div class="mb-3 w-25">
                <label for="image" class="form-label"><h6>Copertina Ristorante</h6></label>

                {{-- image preview --}}
                <div>
                    <img id="output" width="100" class="mb-2"/>
                    <script>
                        let loadFile = function(event) {
                            let reader = new FileReader();
                            reader.onload = function(){
                            let output = document.getElementById('output');
                            output.src = reader.result;
                            };
                            reader.readAsDataURL(event.target.files[0]);
                        };
                    </script>
                </div>
                {{-- /preview immagine  --}}
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $restaurant->image) }}" onchange="loadFile(event)">
            </div>
            {{-- campo cucine --}}
            <div class="mb-3">
                <h6>Cucine</h6>
                @foreach ($kitchens as $kitchen)
                    <div class="form-check form-check-inline">
                        @if( $errors->any() )
                            {{-- in caso di validazione fallita: --}}
                            <input class="form-check-input" type="checkbox" id="{{$kitchen->id}}" name="kitchens[]" value="{{$kitchen->id}}" {{ in_array($kitchen->id, old('kitchens', []) ) ? 'checked' : ''}}>
                        @else
                            {{-- per avere già flaggate le eventuali "kitchens" già associate: --}}
                            <input class="form-check-input " type="checkbox" id="{{ $kitchen->id }}" name="kitchens[]" value="{{ $kitchen->id }}" {{ $restaurant->kitchens->contains($kitchen->id) ? 'checked' : '' }}>
                        @endif
                            <label class="form-check-label" for="{{$kitchen->id}}">{{$kitchen->name}}</label>
                    </div>
                @endforeach
                @error('kitchens')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-success">Conferma</button>
                <a href="{{ route('admin.restaurants.index')}}" class="btn btn-primary">Ritorna al tuo ristorante</a>
            </div>
        </form>
    </div>
@endsection