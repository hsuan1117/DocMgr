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
                            <form action="{{route('docs.store')}}" method="post">
                                <label for="receiver"></label>
                                <input type="text" name="receiver" id="receiver">

                                <label for="date"></label>
                                <input type="date" name="date" id="date">

                                <label for="serial_number"></label>
                                <input type="text" name="serial_number" id="serial_number">

                                <label for="speed"></label>
                                <input type="text" name="speed" id="speed">

                                <label for="confidentiality"></label>
                                <input type="text" name="confidentiality" id="confidentiality">

                                <label for="subject"></label>
                                <input type="text" name="subject" id="subject">

                                <label for="explanation"></label>
                                <textarea name="explanation" id="explanation">

                                </textarea>
                                <button>送出</button>
                                @csrf
                            </form>
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
