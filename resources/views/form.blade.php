@extends('layouts.main')

@section('title', 'Form')

@section('content')
    <form method="post" action="{{route('domains.store')}}" class="lead">
        <div class="form-group">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors as $error)
                    <li>{{ is_array($error) ? $error[0] : $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <label for="input-domains">Enter page url to analyze:</label>
            <input id="input-domains" class="form-control" type="text" name="domain" value=""
                   placeholder="https://some.domain.com/some-page">
            <input type="submit" class="btn btn-primary btn-lg" role="button"/>
        </div>

    </form>
@endsection