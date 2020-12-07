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
            <form class="form" role="form" enctype="multipart/form-data" method="post"
                  action="{{  URL("/admin/post/edit")}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="group" value="{{ $group }}">
                <div class="card-body tab-content">
                    @foreach($languages as $key =>$language)
                        @if($key == 0)
                            <div class="tab-pane active" id="{{$language->id}}">
                                <div class="form" role="form">

                                    <input type="hidden" name="language_id[]" value="{{$language->id}}">
                                    @foreach($model as $val)
                                        @if($val->language_id == $language->id)
                                            <div class="form-group floating-label">
                                                <select class="form-control" name="post_category_id">
                                                    @foreach($category as $value)
                                                        @if($val->post_category_group_id ==  $value->group)
                                                            <option value="{{ $value->group }}"
                                                                    selected>{{ $value->category_name }}</option>
                                                        @else
                                                            <option value="{{ $value->group }}">{{ $value->category_name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label for="post_category_id">Post category</label>
                                            </div>
                                            <div class="form-group floating-label">
                                                <input type="datetime-local" name="datetime"
                                                       value="{{\Carbon\Carbon::parse($val->datetime)->format('Y-m-d\TH:i')}}"
                                                       class="form-control" id="regular2">
                                            </div>
                                            <div class="form-group floating-label">
                                                <input type="text" name="title[]" class="form-control"
                                                       value="{{ $val->title }}" id="regular2">
                                                <label for="regular2">title</label>
                                            </div>
                                            <div class="form-group floating-label">
                                                <input type="text" name="decription[]" class="form-control"
                                                       value="{{ $val->decription }}" id="regular2">
                                                <label for="regular2">Decription</label>
                                            </div>

                                            <div class="form-group floating-label">
                                                <div><img width="100"
                                                          src="{{URL(App::getLocale().'/downloads?type=post&id='.$val->group) }}">
                                                </div>
                                                <input type="file" name="cover" class="form-control" value=""
                                                       id="regular2">
                                                <label for="regular2">Cover</label>
                                            </div>
                                            <div class="form-group floating-label">
                                                <select class="form-control" name="country_id" id="country">
                                                    @foreach($gcainfo as $value)
                                                        @if ($value->id == $val->gcainfo_id)
                                                            <option selected
                                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @else
                                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label for="country">Country</label>
                                            </div>

                                            <div class="form-group floating-label">
                                                <textarea name="content[]"
                                                          class="form-control">{{ $val->content }}</textarea>

                                                <label for="regular2">content</label>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        @else
                            <div class="tab-pane" id="{{$language->id}}">
                                <div class="form" role="form">

                                    <input type="hidden" name="language_id[]" value="{{$language->id}}">

                                    @foreach($model as $val)
                                        @if($val->language_id == $language->id)
                                            <div class="form-group floating-label">
                                                <input type="text" name="title[]" class="form-control"
                                                       value="{{ $val->title }}" id="regular2">
                                                <label for="regular2">title</label>
                                            </div>
                                            <div class="form-group floating-label">
                                                <input type="text" name="decription[]" class="form-control"
                                                       value="{{ $val->decription }}" id="regular2">
                                                <label for="regular2">Decription</label>
                                            </div>



                                            <div class="form-group floating-label">
                                                <textarea name="content[]"
                                                          class="form-control">{{ $val->content }}</textarea>

                                                <label for="regular2">content</label>
                                            </div>

                                        @endif
                                    @endforeach
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
    </div><!--end .table-responsive -->



@endsection
