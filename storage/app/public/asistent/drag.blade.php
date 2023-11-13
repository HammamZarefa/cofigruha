@extends('layouts.admin_lte')

@section('content')
    <div class="container" style="width:100%">
        <div class="row">
            <div class="col-md-2" style="border: 1px solid rgba(0,0,0,.2);padding: 10px 15px;"> <!-- 20% width -->
                <ul id="draggable-list">
                    @foreach($informations as $information)
                        <li class="draggable-item" draggable="true"
                            data-type="{{$information->type}}" data-name="{{$information->code}}">
                            {{ $information->name }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-10"> <!-- 80% width -->
                <form id="form-drag" method="POST" action="" class="col-md-12">
                    @csrf

                    <div class="summernote col-md-12" id="html-editor"></div>

                    <input type="hidden" name="editor-content" id="editor-content">
                    <button class="submit-drag" type="submit" style="">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <style>
        #draggable-list{
            padding: 0;
            overflow-y: scroll;
            scrollbar-width: thin;
            scrollbar-color: #3c8dbc #222d321a;
            height: 400px;
        }
        #draggable-list::-webkit-scrollbar {
            height: 12px;
            width: 12px;
            background: #222d321a;
        }

            #draggable-list::-webkit-scrollbar-thumb {
                background: #3c8dbc;
                -webkit-border-radius: 1ex;
                -webkit-box-shadow: 0px 1px 2px #222d321a;
            }

            #draggable-list::-webkit-scrollbar-corner {
                background: #222d321a;
            }
        .note-editable{
            height:370px !important;
        }
        #form-drag .submit-drag{
            margin-top: 20px;
            background-color: #3c8dbc;
            color: #fff;
            border: none;
            padding: 5px 10px;
            font-weight: bold;
            border-radius: 3px;
            transition: .5s;
        }
        #form-drag .submit-drag:hover{
            background-color: #1b6591;
        }
    </style>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                height: 1000,
                focus: true,
                disableDragAndDrop:true,
            });
        });

        const draggableList = document.getElementById('draggable-list');
        const editor = document.getElementById('html-editor');

        draggableList.addEventListener('dragstart', (event) => {
            const type = event.target.getAttribute('data-type');
            const name = event.target.getAttribute('data-name');
            event.dataTransfer.setData('text/plain', JSON.stringify({ type, name }));
        });

        editor.addEventListener('dragover', (event) => {
            event.preventDefault();
        });

        editor.addEventListener('drop', (event) => {
            event.preventDefault();
            const data = event.dataTransfer.getData('text/plain');
            const elementData = JSON.parse(data);

            if (elementData.type === 'text') {
                const inputName = elementData.name;
                const inputHtml = `<input type="text" name="${inputName}" placeholder="${inputName}">`;

                // Use Summernote's insertNode function to insert the input
                const range = $(editor).summernote('createRange');
                range.insertNode($(inputHtml)[0]);
            }
        });
    </script>
@endsection