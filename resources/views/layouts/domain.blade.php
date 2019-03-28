@extends('layouts.main')
@section('title')
    {{ $name }}
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
            <th scope="row">{{ $id }}</th>
            <td>{{ $name }}</td>
            <td>{{ $createdAt }}</td>
            <td>{{ $updatedAt }}</td>
        </tr>
        </tbody>
    </table>
@endsection
