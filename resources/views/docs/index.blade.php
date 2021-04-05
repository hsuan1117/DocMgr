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
                        <div class="list-group">
                            @foreach($docs as $doc)
                                <a href="#" class="list-group-item list-group-item-action active">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{$doc->subject}}</h5>
                                        <small>3 days ago</small>
                                    </div>
                                    <p class="mb-1">{{$doc->explanation}}</p>
                                    <small>發文日期: {{$doc->created_at->format('Y/m/d') }}</small>
                                </a>

                                {{$doc}}
                            @endforeach
                        </div>

                        <a href="{{route('docs.create')}}" class="btn btn-success">新增公文</a>
                        {{ __('DOCS will be LISTED HERE') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
