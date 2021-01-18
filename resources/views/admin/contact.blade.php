@extends("admin.layout.template")

@section("content")

<div class="col-md-12" style="background-color: white;padding: 25px;">
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
        <div class="form-group">
            <form action="{{URL('admin/contact/search')}}" method="post">
                {{csrf_field()}}
                <div class="input-group">
                    <div class="input-group-content">
                        <input type="text" name="search" class="form-control" placeholder="SEARCH" id="groupbutton9">
                        <label for="groupbutton9"></label>
                    </div>
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </div>

                </div>
            </form>
        </div>
        <table class="table table-condensed no-margin">
            <thead>
                <tr>
                    <td width="80px">№</td>
                    <td width="80px">Fio</td>
                    <td width="80px">Email</td>
                    <td width="80px">Comment</td>
                    <td width="80px">Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $key=>$contact)
                <tr>
                    <td width="80px">{{ $key+1 }}</td>
                    <td width="80px">{{$contact->fio}}</td>
                    <td width="80px">{{$contact->email}}</td>
                    <td width="80px">{{$contact->comment}}</td>
                    <td>
                        <form style="display: flex; justify-content: flex-end" action="#" method="POST">
                            @csrf
                            @method('delete')
                            <button class="" type="submit" onclick="return confirm('Вы уверены?');">
                                <i class="fa fa-remove"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $contacts->links() }}
    </div>
</div>

@endsection