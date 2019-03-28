@extends('layouts.main')

@section('title', 'Form')

@section('content')
    <form method="post" action="/domains" class="lead">
        <div class="form-group">
            <?php if (isset($errors) && count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
            <?php endif ?>
            <label for="input-domains">Введите адрес сайта, для анализа:</label>
            <input id="input-domains" class="form-control" type="text" name="domain" value=""
                   placeholder="https://some.domain.com">
            <input type="submit" class="btn btn-primary btn-lg" role="button"/>
        </div>

    </form>
@endsection