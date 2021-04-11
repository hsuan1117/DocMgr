@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('新增部門') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{route('departments.store')}}" method="post" id="doc_create">
                            <div class="form-group">
                                <label for="name">部門名稱</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="users">員工</label>
                                <select name="users[]" id="users" class="form-control" multiple></select>
                            </div>

                            <button type="submit" class="btn btn-primary">送出</button>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 提示框 -->
    <div class="modal fade" id="dialog" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dialog_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="dialog_content">

                </div>
                <!--
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>-->
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
        })(window)
        $('#users').select2({
            ajax: {
                url: "{{route('users.query')}}",
                method: "POST",
                delay: 250,
                dataType: 'json'
            }
        });

    </script>
@endsection
