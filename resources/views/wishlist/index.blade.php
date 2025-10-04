@extends('./app')

@section('content')
<h2>My Wishlist</h2>

<div class="row">
    @forelse($wishlist as $item)
        <div class="col-md-3">
            <div class="card mb-3">
                <!-- <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://via.placeholder.com/150' }}" class="card-img-top"> -->
                <div class="card-body">
                    <h5>{{ $item->product->name }}</h5>
                    <p>${{ $item->product->price }}</p>
                    <a href="{{ route('products.show', $item->product->id) }}" class="btn btn-sm btn-info">View</a>

                    <form action="{{ route('wishlist.remove', $item->product->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Remove ❌</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p>No items in your wishlist yet.</p>
    @endforelse
</div>
@endsection
