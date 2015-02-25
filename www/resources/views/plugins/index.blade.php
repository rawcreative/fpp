@extends('layouts.master')

@section('content-class', 'plugins')
@section('header')
    @include('plugins.header')
@stop
@section('content')
<div class="content">
    @include('flash::message')
    <section class="installed-plugins plugin-section">
        <h4>Installed Plugins</h4>
        <div class="plugin-list installed">
           @foreach($installedPlugins as $plugin)
               @include('plugins.plugin', ['plugin' => $plugin])
            @endforeach
        </div>
    </section>
    <hr>
    <section class="available-plugins plugin-section">
        <h4>Available Plugins</h4>
        <div class="plugin-list available">

        </div>
    </section>
</div>
@stop
