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
            <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{  URL("/admin/links/update")}}">
                <input type="hidden" name="group" value="{{$category_id->group}}">
                <div class="card-body tab-content">
                    <div class="form-group floating-label">
                        <select class="form-control" name="links_category_id">
                            @foreach($category as $value)
                                @if($category_id->category_group == $value->group)
                                    <option value="{{ $value->group }}" selected>{{ $value->title }}</option>
                                @else
                                    <option value="{{ $value->group }}">{{ $value->title }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="form-group floating-label">
                            <input type="text" name="link" value="{{$category_id->link}}" class="form-control" id="regular2">
                            <label for="regular2">Link</label>
                        </div>
                        <label for="post_category_id">Link category</label>
                    </div>
                    @foreach($languages as $key =>$language)
                        @if($key == 0)
                            @foreach($model as $val)

                                @if($val->language_id ==$language->id)
                            <div class="tab-pane active" id="{{$language->id}}">
                                <div class="form" role="form">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="language_id[]" value="{{$language->id}}">
                                    <div class="form-group floating-label">
                                        <input type="text" name="title[]" value="{{$val->title}}" class="form-control" id="regular2">
                                        <label for="regular2">title</label>
                                    </div>
                                </div>
                            </div>
                                @endif
                            @endforeach
                        @else
                            @foreach($model as $val)

                                @if($val->language_id ==$language->id)
                            <div class="tab-pane" id="{{$language->id}}">
                                <div class="form" role="form">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="language_id[]" value="{{$language->id}}">
                                    <div class="form-group floating-label">
                                        <input type="text" name="title[]" value="{{$val->title}}" class="form-control" id="regular2">
                                        <label for="regular2">title</label>
                                    </div>
                                </div>
                            </div>
                                    @endif
                            @endforeach
                        @endif

                    @endforeach
                    <div class="form-group floating-label">
                        <img width="100" src="{{URL(App::getLocale().'/downloads?type=link&id='.$category_id->id) }}">
                        <input type="file" name="cover" class="form-control" id="regular2">
                        <label for="regular2">cover</label>
                    </div>
                    <div class="card-actionbar-row">
                        <button type="submit" class="btn btn-flat btn-primary ink-reaction">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div><!--end .table-responsive -->



@endsection
