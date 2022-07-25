@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <a href="{{ route('write.review') }}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                </div>

                <div class="card-body">
                   <h4>Write a review</h4>
                   <div>
                        <form action="{{ route('store.website.review') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Customer Name</label>
                                <input type="text" class="form-control" name="name" readonly value="{{ Auth::user()->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Write a Review</label>
                                <textarea name="review" class="form-control" required></textarea>
                            </div>
                            <div>
                                <label for="">Rating</label>
                                <select name="rating" class="form-control">
                                    <option value="1">1 star</option>
                                    <option value="2">2 star</option>
                                    <option value="3">3 star</option>
                                    <option value="4">4 star</option>
                                    <option value="5">5 star</option>
                                </select> <br>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection