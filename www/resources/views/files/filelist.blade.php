<div class="file-list table-responsive">
    <table class="table table-condensed table-hover">
        <thead>
            <th width="75%">Filename</th>
            <th>Last Modified</th>
        </thead>
        <tbody>
            @forelse($files as $file)
                <tr>
                    <td>{{$file['name']}}</td>
                    <td>{{$file['last_modified']}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align: center;">No Files Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>