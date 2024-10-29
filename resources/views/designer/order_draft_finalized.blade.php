@extends('layouts.designer.mainlayout')

@section('title', 'Approved Drafts for Order')

@section('content')
    <div class="container">
        <h2>Approved Drafts for Order #{{ $order->id }}</h2>

        @if($approvedDrafts->isEmpty())
            <p>No approved drafts found for this order.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Price</th>
                    <th>Images</th>
                    <th>PDF</th>
                </tr>
                </thead>
                <tbody>
                @foreach($approvedDrafts as $draft)
                    <tr>
                        <td>{{ $draft->price }}</td>
                        <td>
                            @foreach(json_decode($draft->images) as $image)
                                <img src="{{ asset('storage/'.$image) }}" alt="Image" style="width: 100px;">
                            @endforeach
                        </td>
                        <td><a href="{{ asset('storage/'.$draft->pdf) }}" target="_blank">Download PDF</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>


    <div class="container">
        <h2>Create Order Draft Final</h2>
        <form action="{{ route('designer.order_draft_finalized.store', $order->id) }}" method="POST" enctype="multipart/form-data">
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
                <label for="pdf">Upload PDF</label>
                <input type="file" name="pdf" id="pdf" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="state">State</label>
                <select name="state" id="state" class="form-control" required>

                    <option value="finalized">Finalized</option>

                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
