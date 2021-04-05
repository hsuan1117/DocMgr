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
                                <label for="receiver">受文者</label>
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
                                <input id="d_title" class="form-control">
                            </div>
                        </div>
                        {{ __('DOCS will be CREATED HERE') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('other-scripts')
    <link href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/themes/excite-bike/jquery-ui.css" rel="stylesheet"/>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $('#receiver').autocomplete({
            source: function (request, response) {
                // request物件只有一個term屬性，對應使用者輸入的文字
                // response在你自行處理並獲取資料後，將JSON資料交給該函式處理，以便於autocomplete根據資料顯示列表
                $.ajax({
                    url: "{{route('users.query')}}",
                    type: "post",
                    dataType: "json",
                    data: {
                        "search": request.term
                    },
                    success: function (data) {
                        response($.map(data.results, function (item) {
                            return {
                                label: `${item.text} <${item.id}>`,
                                value: item.id
                            }
                        }));
                    }
                });
            }
        })
    </script>
@endsection
