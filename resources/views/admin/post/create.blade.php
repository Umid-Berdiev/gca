@extends("admin.layout.template")

@section("content")

<div class="card-body" style="background-color: white">
  <div class="col-md-12">
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
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
    <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{  URL("/admin/post/insert")}}">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <div class="card-body tab-content">
        @foreach($languages as $key =>$language)
        @if($key == 0)
        <div class="tab-pane active" id="{{$language->id}}">
          <div class="form" role="form">

            <input type="hidden" name="language_ids[]" value="{{$language->id}}">

            <div class="form-group floating-label">
              <select class="form-control" name="post_category_id">
                @foreach($category as $value)
                <option value="{{ $value->group }}">{{ $value->category_name }}</option>
                @endforeach
              </select>
              <label for="post_category_id">Post category</label>
            </div>
            <div class="form-group floating-label">
              <input type="datetime-local" name="datetime" class="form-control" id="regular2">
            </div>
            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="regular2">
              <label for="regular2">title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="decription[]" class="form-control" id="regular2">
              <label for="regular2">Decription</label>
            </div>

            <div class="form-group floating-label">
              <input type="file" name="cover" class="form-control" id="regular2">
              <label for="regular2">Cover</label>
            </div>
            <div class="form-group floating-label">
              <select class="form-control" name="country_id" id="country">
                @foreach($gcainfo as $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
                @endforeach
              </select>
              <label for="country">Country</label>
            </div>


          </div>
        </div>
        @else
        <div class="tab-pane" id="{{$language->id}}">
          <div class="form" role="form">

            <input type="hidden" name="language_ids[]" value="{{$language->id}}">


            <div class="form-group floating-label">
              <input type="text" name="titles[]" class="form-control" id="regular2">
              <label for="regular2">title</label>
            </div>
            <div class="form-group floating-label">
              <input type="text" name="decription[]" class="form-control" id="regular2">
              <label for="regular2">Decription</label>
            </div>



            <div class="form-group floating-label">
              <textarea name="content[]" class="form-control"></textarea>

              <label for="regular2">content</label>
            </div>


          </div>
        </div>
        @endif
        @endforeach
        <div class="card-actionbar-row">
          <button type="submit" class="btn btn-flat btn-primary ink-reaction">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
<!--end .table-responsive -->



@endsection