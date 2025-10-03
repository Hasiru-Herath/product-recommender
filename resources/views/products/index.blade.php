@extends('app')

@section('content')
<h1>All Products</h1>
<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

<div class="row">
    @foreach($products as $product)
    <div class="col-md-3">
        <div class="card mb-3">
            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/150' }}" class="card-img-top">
            <div class="card-body">
                <h5>{{ $product->name }}</h5>
                <p>${{ $product->price }}</p>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">View</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
