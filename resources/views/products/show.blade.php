@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails du produit</h1>

        <!-- Affichage de la message de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p class="card-text"><strong>Prix:</strong> {{ $product->price }} €</p>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>

        <!-- Formulaire d'ajout à la wishlist -->
        <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
        @csrf
            <button class="btn btn-outline-primary">Ajouter à la wishlist ❤️</button>
        </form>

        <!-- Formulaire d'ajout d'avis (si connecté) -->
        @auth
            <h3>Laissez votre avis :</h3>
            <form action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <!-- Sélection de la note -->
                <label for="rating">Note :</label>
                <select name="rating" id="rating" class="form-select mb-2" required>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} ⭐</option>
                    @endfor
                </select>

                <!-- Commentaire facultatif -->
                <label for="comment">Votre commentaire :</label>
                <textarea name="comment" id="comment" class="form-control mb-2" placeholder="Ajoutez un commentaire (facultatif)"></textarea>

                <button class="btn btn-primary">Soumettre mon avis</button>
            </form>
        @endauth

        <!-- Affichage des avis -->
        <h4>Notes et avis des clients</h4>
        <p>Moyenne des avis : {{ number_format($product->reviews->avg('rating'), 1) }} ⭐</p>

        @foreach ($product->reviews as $review)
            <div class="border p-2 mb-2">
                <strong>{{ $review->user->name }}</strong> - {{ $review->rating }} ⭐
                <p>{{ $review->comment }}</p>
            </div>
        @endforeach
    </div>
@endsection
