@extends('layouts.main')
@section('title', 'Domains list')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">CreatedAt</th>
            <th scope="col">UpdatedAt</th>
        </tr>
        </thead>
        <tbody>
        @foreach($domains as $domain)
            <tr>
                <th scope="row">{{ $domain->id }}</th>
                <td><a href="{{ route('domains.show', ['id' => $domain->id]) }}">{{ $domain->name }}</a></td>
                <td>{{ $domain->created_at }}</td>
                <td>{{ $domain->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @isset($prevPage)
        <a href="{{ route('domains.list', ['page' => $prevPage]) }}"
           class="btn btn-outline-secondary btn-sm"
           role="button">prev</a>
    @endisset

    @isset($nextPage)
        <a href="{{ route('domains.list', ['page' => $nextPage]) }}"
           class="btn btn-outline-secondary btn-sm"
           role="button">next</a>
    @endisset
@endsection
