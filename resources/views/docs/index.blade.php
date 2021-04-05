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
                        <a href="{{route('docs.create')}}" class="btn btn-success">新增公文</a>
                        <br>
                        <div class="list-group">
                            @foreach($docs as $doc)
                                <div class="list-group-item border-2">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 text-dark font-weight-bold">{{$doc->subject}}</h5>
                                        <small>{{$doc->created_at->diffForHumans()}}</small>
                                    </div>
                                    <div class="mb-1">{!! $doc->explanation !!}</div>
                                    <small>發文日期: {{$doc->created_at->format('Y/m/d') }}</small>
                                    <a href="{{route('docs.show',$doc->id)}}">Word</a>
                                </div>

                                {{$doc}}
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('other-scripts')
    <style>
        .border-2 {
            border-width: 2px !important;
        }
    </style>
@endsection
