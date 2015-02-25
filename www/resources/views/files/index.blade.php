@extends('layouts.master')

@section('scripts')
    <script src="{{asset('js/vendor/dropzone.js')}}"></script>
@stop

@section('content-class', 'files')


@section('header')
    @include('files.header')
@stop

@section('content')
<div class="content">
    
    <section class="file-tabs">
        <div class="panel">
           
                <ul class="nav nav-tabs nav-tabs-simple" role="tablist">
                    <li class="active"><a href="#sequenceTab" data-toggle="tab" role="tab">Sequences</a></li>
                    <li><a href="#audioTab" data-toggle="tab" role="tab">Audio</a></li>
                    <li><a href="#videoTab" data-toggle="tab" role="tab">Video</a></li>
                    <li><a href="#effectsTab" data-toggle="tab" role="tab">Effects</a></li>
                    <li><a href="#scriptsTab" data-toggle="tab" role="tab">Scripts</a></li>
                    <li><a href="#logsTab" data-toggle="tab" role="tab">Logs</a></li>
                    <li><a href="#uploadsTab" data-toggle="tab" role="tab">Uploads</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane file-tab active" id="sequenceTab">
                        
                        @include('files.filelist', ['files' => $files['sequences'] ])
                       
                        <div class="info">
                            <p>Sequence files must be in the Falcon Pi Player .fseq format and may be converted from various other sequencer formats using xLights or Light-Elf. The Vixen 3 sequencer has the ability to directly export .fseq files.</p>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane file-tab " id="audioTab">
                        @include('files.filelist', ['files' => $files['music'] ])
                        <div class="info"><p>Audio files must be in MP3 or OGG format.</p></div>
                    </div>
                    <div role="tabpanel" class="tab-pane file-tab" id="videoTab">
                        @include('files.filelist', ['files' => $files['videos'] ])
                        <div class="info"><p>Video files must be in .mp4 or .mkv format. H264 video and AAC or MP3 audio are preferred because the video can be hardware accelerated on the Pi.</p></div>
                    </div>
                    <div role="tabpanel" class="tab-pane file-tab" id="effectsTab">
                        @include('files.filelist', ['files' => $files['effects'] ])
                        <div class="info"><p>Effects files are .fseq format files with an .eseq extension. These special sequence files contain only the channels for a specific effect and always start at channel 1 in the sequence file. The actual starting channel offset for the Effect is specified when you run it or configure the Effect in an Event.</p></div>
                    </div>
                    <div role="tabpanel" class="tab-pane file-tab" id="scriptsTab">
                        @include('files.filelist', ['files' => $files['scripts'] ])
                        <div class="info"><p>Scripts must have a .sh, .pl, .pm, .php, or .py extension. Scripts may be executed inside an event. These might be used in a show to trigger an external action such as sending a message to a RDS capable FM transmitter or a non-DMX/Pixelnet LED sign.</p></div>
                    </div>
                    <div role="tabpanel" class="tab-pane file-tab" id="logsTab">
                        @include('files.filelist', ['files' => $files['logs'] ])
                        <div class="info"><p>FPP logs may be viewed or downloaded for submission with bug reports.</p></div>
                    </div>
                    <div role="tabpanel" class="tab-pane file-tab" id="uploadsTab">
                        @include('files.filelist', ['files' => $files['upload'] ])
                        <div class="info"><p>The upload directory is used as temporary storage when uploading media and sequencee files. It is also used as permanent storage for other file formats which have no dedicated home.</p></div>
                    </div>
                </div>
          
        </div>
    </section>

    <section class="upload">
        <div class="panel">
            <div class="panel-heading">
                <div class="panel-title">Upload Files</div>
            </div>
            <div class="panel-body">
             {!! Form::open(['route' => 'files.upload', 'method' => 'POST', 'class' => 'dropzone']) !!}
             {!! Form::close() !!}
            </div>
        </div>
    </section>


</div>
@stop