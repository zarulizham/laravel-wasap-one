<div>
    @if ($response['data'] == null)
        <div>WasapONE having issues. Please contact support.</div>
    @elseif ($response['data']['state'] == 'CONNECTED')
        <div>
            @if (isset($response['data']['info']) && isset($response['data']['info']['pushname']))
                Hello <strong>{{ $response['data']['info']['pushname'] }}</strong>, you are on <strong>{{ $response['data']['info']['platform'] }}</strong>
            @else
                Hello, you have sucessfully connected to WasapONE.
            @endif
        </div>
    @else
        <h5 class="mb-3">Hello, scan qr to get started</h5>
        <div style="display: inline-block" wire:poll.5s wire:poll.keep-alive wire:poll.visible>
            {!! $qr !!}

            @if (!$response['data']['qr_string'])
                <form action="{{ route('servers.restart', auth()->user()->server) }}" method="post">
                    @csrf
                    <button class="btn btn-danger">Restart API Client</button>
                </form>
            @endif
        </div>
    @endif
</div>
