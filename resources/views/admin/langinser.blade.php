@extends("admin.layout.template")

@section("content")


    <div class="card-body" style="background-color: white">
        <div class="table-responsive">
            <div class="card">

                <div class="card-body tab-content">






                                <form class="form-horizontal" role="form" method="post" action="{{ URL("admin/language/insert") }}">

                                    <input type="hidden" value="{{ csrf_token() }}" name="_token">

                                    <div class="form-group">
                                        <label for="regular13" class="col-sm-2 control-label">@lang("laguage.language_name")</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="language_name" id="regular13"><div class="form-control-line"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="regular13" class="col-sm-2 control-label">@lang("laguage.language_prefix")</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="language_prefix" id="regular13"><div class="form-control-line"></div>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <button type="submit" class="btn btn-danger">@lang('language.save')</button>
                                    </div>

                                </form>


                </div>

            </div><!--end .card-body -->
        </div>
    </div><!--end .table-responsive -->



@endsection
