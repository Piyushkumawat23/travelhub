@extends('admin.layout.app')


@section('content')
    <div class="container-fluid">
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Edit Product</h3>
            </div>
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Brand</label>
                        <select name="brand_id" class="form-control">
                            <option value="">Select Brand</option>

                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}"
                                    {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="number" name="price" class="form-control" value="{{ $product->price }}"
                                    step="0.01" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Stock Quantity</label>
                                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Weight</label>
                        <input type="text" name="weight" class="form-control" value="{{ $product->weight }}">
                    </div>

                    <div class="form-group">
                        <label>Warranty</label>
                        <input type="text" name="warranty" class="form-control" value="{{ $product->warranty }}">
                    </div>
                    <div class="form-group">
                        <label>Product Video URL</label>
                        <input type="text" name="video_url" class="form-control" value="{{ $product->video_url }}">
                    </div>
                    <div class="form-group">
                        <label>Current Image</label><br>
                        @if ($product->thumbnail_image)
                            <img src="{{ asset('public/uploads/products/' . $product->thumbnail_image) }}" width="100">
                        @endif

                        <label class="mt-2">Change Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>


                    <div class="form-group">
                        <label>Gallery Images</label><br>

                        @foreach ($product->images as $img)
                            <img src="{{ asset('public/uploads/products/gallery/' . $img->image) }}" width="80">
                        @endforeach

                    </div>

                    <div class="form-group">
                        <label>Add More Images</label>
                        <input type="file" name="gallery_images[]" class="form-control" multiple>
                    </div>


                    <div class="form-group">
                        <label>Trending Product</label>
                        <select name="is_trending" class="form-control">
                            <option value="0" {{ $product->is_trending == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $product->is_trending == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>New Arrival</label>
                        <select name="is_new_arrival" class="form-control">
                            <option value="0" {{ $product->is_new_arrival == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $product->is_new_arrival == 1 ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ $product->meta_title }}">
                    </div>

                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3">{{ $product->meta_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Meta Keywords</label>
                        <textarea name="meta_keywords" class="form-control" rows="3">{{ $product->meta_keywords }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-dark">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
