<?php

namespace ZarulIzham\WasapOne\Http\Livewire;

use Livewire\Component;
use ZarulIzham\WasapOne\Facades\WasapOne;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class GenerateQR extends Component
{
    public function render()
    {
        $response = WasapOne::getQr()->json();

        if (! $response['data']['qr_string']) {
            $qr = 'Please refresh to get QR';
        } else {
            $qr = QrCode::size(200)
                ->style('round')
                ->eye('circle')
                ->color(22, 123, 106)
                ->generate($response['data']['qr_string']);
        }

        return view('wasap-one::livewire.generate-qr', compact('qr', 'response'));
    }
}