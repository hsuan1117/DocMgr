@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('部門列表') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('departments.create')}}" class="btn btn-success">新增部門</a>
                        <br>
                        <div class="list-group">
                            @foreach($departments as $department)
                                <div class="list-group-item border-2">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1 text-dark font-weight-bold">{{$department->name}}</h5>
                                        <small>{{$department->created_at->diffForHumans()}}</small>
                                    </div>
                                    <div class="mb-1">
                                        <select id="users_{{$department->id}}" class="form-control" multiple></select>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('other-scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        (function(global){
            global.DocMgr = global.DocMgr || {};
            global.DocMgr.alert = function(title,content){
                $('#dialog_title').text(title)
                $('#dialog_content').text(content)
                $('#dialog').modal()
            }
            global.DocMgr.addSelected=function(id){
                var userSelect = $('#users');
                $.ajax({
                    type: 'POST',
                    url: "{{route('users.get')}}",
                    data:{
                        'id' : id
                    }
                }).then(function (data) {
                    var option = new Option(data.text, data.id, true, true);
                    userSelect.append(option).trigger('change');

                    userSelect.trigger({
                        type: 'select2:select',
                        params: {
                            data: data
                        }
                    });
                });
            }

        })(window)

        $(function(){
            let departments = {!! $departments->groupBy('id')->keys() !!};
            departments.forEach((id)=>{
                $('#users_'+id).select2({
                    ajax: {
                        url: "{{route('users.query')}}",
                        method: "POST",
                        delay: 250,
                        dataType: 'json'
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "{{route('users.departments.query')}}",
                    data:{
                        'id' : id
                    }
                }).then(function (res) {
                    res.forEach((data)=>{
                        var option = new Option(data.text, data.id, true, true);
                        $('#users_'+id).append(option).trigger('change');
                        $('#users_'+id).trigger({
                            type: 'select2:select',
                            params: {
                                data: data
                            }
                        });
                    })
                });
            })

        })
    </script>
    <style>
        .border-2 {
            border-width: 2px !important;
        }
    </style>

@endsection
