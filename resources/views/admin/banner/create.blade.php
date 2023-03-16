@extends('layouts.admin')

@section('styles')
<style>
   .picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}
 .picture {
  width: 800px;
  height: 400px;
  background-color: #999999;
  border: 4px solid #CCCCCC;
  color: #FFFFFF;
  /* border-radius: 50%; */
  margin: 5px auto;
  overflow: hidden;
  transition: all 0.2s;
  -webkit-transition: all 0.2s;
}
.picture:hover {
  border-color: #2ca8ff;
}
.picture input[type="file"] {
  cursor: pointer;
  display: block;
  height: 100%;
  left: 0;
  opacity: 0 !important;
  position: absolute;
  top: 0;
  width: 100%;
}
.picture-src {
  width: 100%;
  height: 100%;
}
</style>

@endsection

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">

        <div class="picture-container">
            <span class="maxsize"> El tamaño máximo de archivo subido no debe superar 2 MB</span>
            <div class="picture">

                <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>

                <input type="file" id="wizard-picture" name="portada" class=" {{$errors->first('portada') ? "is-invalid" : "" }} ">
                <div class="invalid-feedback" style="position: absolute;right: 0;bottom: -20px;">
                    {{ $errors->first('portada') }}
                </div>
            </div>


            <h6>{{__('message.Cover')}}</h6>

        </div>

      </div>

      <div class="form-group ml-5">
        <label for="título" class="col-sm-2 col-form-label">{{__('message.Title')}}</label>
        <div class="col-sm-7">
            <input type="text" name='título' class="form-control {{$errors->first('título') ? "is-invalid" : "" }} " value="{{old('título')}}" id="título" placeholder="título">
            <div class="invalid-feedback">
                {{ $errors->first('título') }}
            </div>
        </div>
    </div>

{{--    <div class="form-group ml-5">--}}
{{--        <label for="desc" class="col-sm-2 col-form-label">Desc</label>--}}
{{--        <div class="col-sm-7">--}}
{{--          <textarea name="desc" id="desc" cols="30" rows="10" class="form-control {{$errors->first('desc') ? "is-invalid" : "" }} " id="summernote">{{old('desc')}}</textarea>--}}
{{--          <div class="invalid-feedback">--}}
{{--            {{ $errors->first('desc') }}--}}
{{--        </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="form-group ml-5">--}}
{{--        <label for="link" class="col-sm-2 col-form-label">Link</label>--}}
{{--        <div class="col-sm-7">--}}
{{--          <input type="text" name='link' class="form-control {{$errors->first('link') ? "is-invalid" : "" }} " value="{{old('link')}}" id="link" placeholder="Link">--}}
{{--          <div class="invalid-feedback">--}}
{{--            {{ $errors->first('link') }}--}}
{{--        </div>--}}
{{--        </div>--}}
{{--      </div>--}}

    <div class="form-group ml-5">
        <div class="col-sm-3">
            <button type="submit" class="btn btn-primary">{{__('message.Create')}}</button>
        </div>
    </div>
  </form>
@endsection

@push('scripts')
<script>
    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
      readURL(this);
  });
  //Function to show image before upload
function readURL(input) {
  if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
          $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
      }
      reader.readAsDataURL(input.files[0]);
  }
}
</script>

@endpush
