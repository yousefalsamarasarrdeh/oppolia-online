@extends('layouts.designer.mainlayout')

@section('title', 'Survey for Order')

@section('content')
    <div class="container">
        <h2>Create Order Draft</h2>
        <form action="{{ route('designer.order_draft.store', $order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="images">Upload Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple required>
            </div>

            <div class="form-group">
                <label for="measurements_images">Upload Measurement Images</label>
                <input type="file" name="measurements_images[]" id="measurements_images" class="form-control" multiple required>
            </div>

            <div class="form-group">
                <label for="pdf">Upload PDF</label>
                <input type="file" name="pdf" id="pdf" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="state">State</label>
                <select name="state" id="state" class="form-control" required>
                    <option value="draft">Draft</option>
                    <option value="finalized">Finalized</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
