@extends('layouts.admin')

@section('page-title')
    Crea prodotto 
@endsection

@section('content')
    <div class="container pt-3">
        <h2 class="fw-semibold text-center mb-3">Crea un prodotto</h2>
        <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
            {{-- campo nome --}}
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold mb-2">Nome*</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome di questo prodotto" value="{{old('name')}}" maxlength="100" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo disponibilità --}}
            <div class="mb-3 w-25">
                <label for="is_available" class="form-label fw-semibold mb-2">Disponibilità*</label>
                <select name="is_available" id="is_available" class="form-select @error('is_available') is-invalid @enderror" required>
                    <option value="1" {{ old('is_available') == 1 ? 'selected' : ''}}>Disponibile</option>
                    <option value="0" {{ old('is_available') == 0 ? 'selected' : ''}}>Non disponibile</option>
                </select>
                @error('is_available')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo tipologia --}}
            <div class="mb-3 w-25">
                <label for="typology" class="form-label fw-semibold mb-2">Tipologia*</label>
                <select name="typology" id="typology" class="form-select @error('typology') is-invalid @enderror" required>
                    <option value="" disabled selected>Seleziona una tipologia</option>
                    <option value="panini" {{ old('typology') == 'panini' ? 'selected' : ''}}>Panini</option>
                    <option value="pizza" {{ old('typology') == 'pizza' ? 'selected' : ''}}>Pizza</option>
                    <option value="sushi" {{ old('typology') == 'sushi' ? 'selected' : ''}}>Sushi</option>
                    <option value="vegetariano" {{ old('typology') == 'vegetariano' ? 'selected' : ''}}>Vegetariano</option>
                    <option value="dessert" {{ old('typology') == 'dessert' ? 'selected' : ''}}>Dessert</option>
                    <option value="bevande" {{ old('typology') == 'bevande' ? 'selected' : ''}}>Bevande</option>
                    <option value="alcolici" {{ old('typology') == 'alcolici' ? 'selected' : ''}}>Alcolici</option>
                </select>
                @error('typology')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold mb-2">Descrizione prodotto*</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Descrivi il tuo prodotto..." minlength="10" maxlength="500" required>{{old('description')}}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo ingredienti --}}
            <div class="mb-3">
                <label for="ingredients" class="form-label fw-semibold mb-2 @error('ingredients') is-invalid @enderror">Elenco ingredienti*</label>
                <textarea class="form-control" id="ingredients" name="ingredients" rows="5" placeholder="Elenca gli ingredienti del tuo prodotto..." minlength="10" maxlength="500" required>{{old('ingredients')}}</textarea>
                @error('ingredients')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo prezzo --}}
             <div class="mb-3 w-25">
                <label for="price" class="form-label fw-semibold mb-2 @error('price') is-invalid @enderror">Prezzo*</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}" min="0" step=".01" max="99.99" placeholder="00,00" required>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo immagine --}}
            <div class="mb-3 w-50">
                <label for="image" class="form-label fw-semibold mb-0">Immagine prodotto</label> 
                {{-- preview immagine  --}}
                <div class="ms-lh-0">
                    <img id="output" width="150" class="my-2"/>
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
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image')}}" onchange="loadFile(event)">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success">Conferma</button>
                <a href="{{ route('admin.products.index')}}" class="btn btn-primary">Torna ai prodotti</a>
            </div>         
        </form>
    </div>
@endsection