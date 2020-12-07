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
            <form class="form" role="form" enctype="multipart/form-data" method="post" action="{{  URL("/admin/doc/insert")}}">
                <div class="card-body tab-content">
                    <div class="form-group floating-label">
                        <select class="form-control" name="doc_category_id">
                            @foreach($category as $value)

                                <option value="{{ $value->group }}">{{ $value->category_name }}</option>

                            @endforeach
                        </select>
                        <label for="post_category_id">Doc category</label>
                    </div>
                    @foreach($languages as $key =>$language)
                        @if($key == 0)
                            <div class="tab-pane active" id="{{$language->id}}">
                                <div class="form" role="form">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="language_id[]" value="{{$language->id}}">

                                    <div class="form-group floating-label">
                                        <input type="text" name="title[]" class="form-control" id="regular2">
                                        <label for="regular2">title</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <textarea  name="description[]" class="form-control" id="regular2"></textarea>
                                    </div>

                                    <div class="form-group floating-label">
                                        <input type="file" placeholder="PDF" name="files[]" class="form-control" id="pdf">
                                        <label for="pdf">FILES</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <input type="text" name="link[]" class="form-control" id="regular2">
                                        <label for="regular2">link</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <input type="text" name="other_link[]" class="form-control" id="other_link">
                                        <label for="other_link">other_link</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <input type="text" name="r_number[]" class="form-control" id="regular2">
                                        <label for="regular2">r_number</label>
                                    </div>

                                    <div class="form-group floating-label">
                                        <input type="date" name="r_date[]" class="form-control" id="regular2">
                                        <label for="regular2">r_date</label>
                                    </div>



                                </div>
                            </div>
                        @else
                            <div class="tab-pane" id="{{$language->id}}">
                                <div class="form" role="form">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="hidden" name="language_id[]" value="{{$language->id}}">

                                    <div class="form-group floating-label">
                                        <input type="text" name="title[]" class="form-control" id="regular2">
                                        <label for="regular2">title</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <textarea  name="description[]" class="form-control" id="regular2"></textarea>
                                    </div>

                                    <div class="form-group floating-label">
                                        <input type="file" placeholder="PDF" name="files[]" class="form-control" id="pdf">
                                        <label for="pdf">FILES</label>
                                    </div>


                                    <div class="form-group floating-label">
                                        <input type="text" name="link[]" class="form-control" id="regular2">
                                        <label for="regular2">link</label>
                                    </div>
                                    <div class="form-group floating-label">
                                        <input type="text" name="r_number[]" class="form-control" id="regular2">
                                        <label for="regular2">r_number</label>
                                    </div>

                                    <div class="form-group floating-label">
                                        <input type="date" name="r_date[]" class="form-control" id="regular2">
                                        <label for="regular2">r_date</label>
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
    </div><!--end .table-responsive -->



@endsection
