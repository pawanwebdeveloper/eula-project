@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h2>End-User License Management</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('eula.store') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $eula->id }}">
                            <div class="row mb-3">
                                <label for="version" class="col-md-2 col-form-label text-md-end">{{ __('Version') }}</label>

                                <div class="col-md-8">
                                    <input id="version" type="text" class="form-control @error('version') is-invalid @enderror" name="version" required value="{{ $eula->version }}">

                                    @error('version')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="content" class="col-md-2 col-form-label text-md-end">{{ __('Content') }}</label>

                                <div class="col-md-8">
                                    <input id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" required value="{{ $eula->content }}">

                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
