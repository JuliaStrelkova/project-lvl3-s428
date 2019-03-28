@extends('layouts.main')
@section('title')
    {{ $domain->name }}
@endsection
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
        <tr>
            <th scope="row">{{ $domain->id }}</th>
            <td>{{ $domain->name }}</td>
            <td>{{ $domain->created_at }}</td>
            <td>{{ $domain->updated_at }}</td>
        </tr>
        </tbody>
    </table>
@endsection
