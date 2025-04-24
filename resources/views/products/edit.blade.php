@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le produit</h1>

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nom du produit</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}">
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control">{{ $product->description }}</textarea>
            </div>

            <div class="mb-3">
                <label>Prix</label>
                <input type="number" name="price" class="form-control" value="{{ $product->price }}">
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
