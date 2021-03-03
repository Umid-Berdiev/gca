@extends("admin.layout.template")


@section("content")
        @foreach($table as $value)

            <tr>
                {{ $value->language_name }}
            </tr>
            <tr>
                {{ $value->language_prefix }}
            </tr>

        @endforeach
@endsection