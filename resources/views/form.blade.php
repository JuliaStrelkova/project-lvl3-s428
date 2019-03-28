@extends('layouts.main')

@section('title', 'Form')

@section('content')
    <form method="post" action="{{route('domains.store')}}" class="lead">
        <div class="form-group">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors as $error)
                    <li>{{ $error[0] }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <label for="input-domains">Введите адрес сайта, для анализа:</label>
            <input id="input-domains" class="form-control" type="text" name="domain" value=""
                   placeholder="https://some.domain.com">
            <input type="submit" class="btn btn-primary btn-lg" role="button"/>
        </div>

    </form>
@endsection