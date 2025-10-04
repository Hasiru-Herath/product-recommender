@extends('app')

@section('content')
<h2>{{ $product->name }}</h2>
<img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/150' }}" class="mb-3" width="200">
<p><strong>Price:</strong> ${{ $product->price }}</p>
<p><strong>Category:</strong> {{ $product->category }}</p>
<p><strong>Description:</strong> {{ $product->description }}</p>

<hr>
<h4>Recommended Products</h4>
<div class="row">
    @forelse($recommendations as $rec)
        <div class="col-md-3">
            <div class="card mb-3">
                <img src="{{ $rec->image ? asset('storage/'.$rec->image) : 'https://via.placeholder.com/150' }}" class="card-img-top">
                <div class="card-body">
                    <h6>{{ $rec->name }}</h6>
                    <p>${{ $rec->price }}</p>
                    <a href="{{ route('products.show', $rec->id) }}" class="btn btn-sm btn-info">View</a>
                </div>
            </div>
        </div>
    @empty
        <p>No recommendations available</p>
    @endforelse
</div>

<hr>
<h4>Recently Viewed</h4>
<ul>
    @foreach(session('recently_viewed', []) as $id)
        @php $recentProduct = \App\Models\Product::find($id); @endphp
        @if($recentProduct)
            <li><a href="{{ route('products.show', $recentProduct->id) }}">{{ $recentProduct->name }}</a></li>
        @endif
    @endforeach
</ul>
@endsection
