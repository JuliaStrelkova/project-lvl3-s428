@extends('layouts.main')
@section('title')
    {{ $domain['name'] }}
@endsection
@section('content')
    <h3 class="text-center">Domain information</h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Field Name</th>
            <th scope="col">Field Value</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">Id</th>
            <td>{{ $domain->id }}</td>
        </tr>
        <tr>
            <th scope="row">Created At</th>
            <td>{{ $domain->created_at }}</td>
        </tr>
        <tr>
            <th scope="row">Updated At</th>
            <td>{{ $domain->updated_at }}</td>
        </tr>
        <tr>
            <th scope="row">Name</th>
            <td>{{ $domain->name }}</td>
        </tr>
        <tr>
            <th scope="row">Content Length</th>
            <td>{{ $domain->content_length }}</td>
        </tr>
        <tr>
            <th scope="row">Code</th>
            <td>{{ $domain->code }}</td>
        </tr>
        <tr>
            <th scope="row">Header</th>
            <td>{{ $domain->h1 }}</td>
        </tr>
        <tr>
            <th scope="row">Keywords</th>
            <td>{{ $domain->keywords }}</td>
        </tr>
        <tr>
            <th scope="row">Description</th>
            <td>{{ $domain->description }}</td>
        </tr>
        <tr>
            <th scope="row">Body</th>
            <td>
                <a href="{{ $domain->body_url }}">download</a>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
