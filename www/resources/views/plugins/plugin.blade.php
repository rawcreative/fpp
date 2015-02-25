<div class="plugin-list-item list-item">
    <div class="inner">
        <table width="100%">
            <tbody>
            <td valign="top" align="left" width="140">
                <div class="thumb"><i class="icon ion-cube"></i></div>
            </td>
            <td valign="middle" align="left" class="list-item-details">
                <h3 class="list-item-title">{{ $plugin->name }}</h3>

                <p class="list-item-desc">{{ $plugin->description }}</p>
                <div class="list-item-links"></div>
            </td>
            <td valign="middle" align="left" width="10">

                <div class="text-center">
                    @if(!$plugin->isEnabled())
                    {!! Form::open(['route' => 'plugins.enable', 'method' => 'put']) !!}
                        <button type="submit" class="button enable">Enable</button>
                    @else
                    {!! Form::open(['route' => 'plugins.disable', 'method' => 'put']) !!}
                        <button type="submit" class="button disable">Disable</button>
                    @endif
                    <input type="hidden" name="slug" value="{{$plugin->getSlug()}}"/>
                    {!! Form::close() !!}
                    <form>
                        <button type="submit" class="button remove">Remove</button>
                    </form>
                </div>
            </td>
            </tbody>
        </table>
    </div>
</div>