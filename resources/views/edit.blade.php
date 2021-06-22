@php $val = (int) request()->route('category'); @endphp
@extends('master')
@section('vue')
    <div id="app">
        <categories-edit :id="{{ $val ? $val : 0 }}"></categories-edit>
    </div>
@endsection

