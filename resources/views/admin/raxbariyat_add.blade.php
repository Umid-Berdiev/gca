@extends("admin.layout.template")

@section("content")

<div class="card-body" style="background-color: white">

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="col-md-12">
    <div class="card-head">
      <ul class="nav nav-tabs" data-toggle="tabs">
        @foreach($languages as $key =>$language)
        @if($key == 0)
        <li class="active"><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
        @else
        <li><a href="#{{$language->id}}">{{$language->language_name}}</a></li>
        @endif

        @endforeach
      </ul>
    </div>
    <form class="form" role="form" enctype="multipart/form-data" method="post"
      action="{{  URL("/admin/raxbariyat/store")}}">
      <div class="card-body tab-content">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        @foreach($languages as $key =>$language)
        @if($key == 0)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="fio[]" class="form-control" id="regular2">
              <label for="regular2">fio</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="major[]" class="form-control" id="regular2">
              <label for="regular2">major</label>
            </div>

            <div class="form-group floating-label">
              <input type="text" name="qabul[]" class="form-control" id="regular2">
              <label for="regular2">qabul</label>
            </div>
            <h4>Short</h4>
            <div class="form-group floating-label">
              <textarea name="short[]" class="form-control" id="regular2"></textarea>
            </div>
            <h4>Vazifalar</h4>
            <div class="form-group floating-label">
              <textarea name="vazifa[]" class="form-control" id="regular2"></textarea>
            </div>


          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">
            <input type="hidden" name="language_ids[]" value="{{$language->id}}">
            <div class="form-group floating-label">
              <input type="text" name="fio[]" class="form-control" id="regular2">
              <label for="regular2">fio</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="major[]" class="form-control" id="regular2">
              <label for="regular2">major</label>
            </div>

            <div class="form-group floating-label">
              <input type="text" name="qabul[]" class="form-control" id="regular2">
              <label for="regular2">qabul</label>
            </div>
            <h4>Short</h4>
            <div class="form-group floating-label">
              <textarea name="short[]" class="form-control" id="regular2"></textarea>
            </div>
            <h4>Vazifalar</h4>
            <div class="form-group floating-label">
              <textarea name="vazifa[]" class="form-control" id="regular2"></textarea>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        <div class="form-group floating-label">
          <input type="text" name="tel" class="form-control" id="regular2">
          <label for="regular2">tel</label>
        </div>
        <div class="form-group floating-label">
          <input type="text" name="faks" class="form-control" id="regular2">
          <label for="regular2">faks</label>
        </div>
        <div class="form-group floating-label">
          <input type="email" name="email" class="form-control" id="regular2">
          <label for="regular2">email</label>
        </div>

        <div class="form-group floating-label">
          <input type="file" name="cover" class="form-control" id="regular2">
          <label for="regular2">cover</label>
        </div>
        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



@endsection