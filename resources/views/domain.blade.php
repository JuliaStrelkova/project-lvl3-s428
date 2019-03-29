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
        @foreach($domain as $field => $value)
            <tr>
                <th scope="row">{{ $field }}</th>
                <td>
                    @if ($field === 'body')
                        <a href="{{ $value }}">download</a>
                    @else
                        {{ $value }}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
