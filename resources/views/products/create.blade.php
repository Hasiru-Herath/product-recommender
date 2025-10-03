@extends('app')

@section('content')
<h1>Add New Product</h1>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" class="form-control" id="category" name="category" required>
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" id="tags" name="tags">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" class="form-control-file" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection