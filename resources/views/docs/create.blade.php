@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('公文發文平台') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{route('docs.store')}}" method="post" id="doc_create">
                            <div class="form-group">
                                <label for="receiver">受文者</label>
                                <select name="receiver" id="receiver" class="form-control" multiple></select>
                            </div>

                            <div class="form-group">
                                <label for="date">發文日期</label>
                                <input type="date" name="date" id="date" value="{{date("Y-m-d")}}" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="serial_number">發文號</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="serial_number" id="serial_number" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" id="check_serial">Check</button>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="speed">速別</label>
                                <input type="text" name="speed" id="speed" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="confidentiality">密等</label>
                                <input type="text" name="confidentiality" id="confidentiality" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="subject">主旨</label>
                                <input type="text" name="subject" id="subject" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="explanation">說明</label>
                                <textarea name="explanation" id="explanation"></textarea>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
    <script>
        (function(global,ClassicEditor){
            global.DocMgr = global.DocMgr || {};
            ClassicEditor
                .create(document.querySelector('#explanation'))
                .then((editor)=>{
                    global.DocMgr.docEditor = editor
                })
                .catch(error => {
                    console.error(error);
                });
            global.DocMgr.alert = function(title,content){
                $('#dialog_title').text(title)
                $('#dialog_content').text(content)
                $('#dialog').modal()
            }
        })(window,ClassicEditor)
        $('#receiver').select2({
            ajax: {
                url: "{{route('users.query')}}",
                method: "POST",
                delay: 250,
                dataType: 'json'
            }
        });



        $("#doc_create").submit((e)=>{
            let editor = window.DocMgr.docEditor;
            let explanation = $(editor.getData())
            $('#explanation').html(explanation.html());
            return true;
        })
        $("#check_serial").click(()=>{
            DocMgr.alert('hi','hi2')
        })
    </script>
@endsection
