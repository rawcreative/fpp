@extends('layouts.outputs')

@section('content-class', 'outputs settings remap')


@section('main')

    <div class="page-content outputs">
        <header class="page-title">
            <h2>Re-map Channel Outputs</h2>
        </header>
        <div class="main">
            <div id="channel-outputs">
                <div class="remap-list">
                    <div class="header-row remap">
                        <span class="remap-source">Source</span>
                        <span class="remap-destination">Destination</span>
                        <span class="remap-size">Count</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop