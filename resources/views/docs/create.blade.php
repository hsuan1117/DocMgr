@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="form-group">
                                <label for="d_title" class="form-text">
                                    標題
                                </label>
                                <input id="d_title" class="form-control" >
                            </div>
                        </div>
                        {{ __('DOCS will be CREATED HERE') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
