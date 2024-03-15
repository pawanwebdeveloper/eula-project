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
                        <p>This is your EULA text. Modify it as needed.</p>
                        <form method="POST" action="{{ url('/eula/accept') }}">
                            @csrf
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="acceptance" name="acceptance" required>
                                    <label class="form-check-label" for="acceptance">I have read and agree to the terms</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Accept</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
