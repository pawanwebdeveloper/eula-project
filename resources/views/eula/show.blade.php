@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h2>End-User License Agreement</h2>
                    </div>
                    <div class="card-body">
                        <p>{{ $eula->content }}</p>
                        <form method="POST" action="{{ url('/eula/accept') }}">
                            @csrf
                            <input type="hidden" name="version" value="{{ $eula->version }}">
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="acceptance" name="acceptance" required>
                                    <label class="form-check-label" for="acceptance">I have read and agree to the terms of version: {{ $eula->version }}</label>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary" name="response" value="accept">Accept</button>
                                <button type="submit" class="btn btn-danger" name="response" value="reject">Reject</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
