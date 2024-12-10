<?php

namespace ZarulIzham\WasapOne;

use Illuminate\Support\Facades\Http;

class WasapOne
{
    private $response;

    private $errorMessage;

    private $errorCode;

    public function sendMessage($message, $chatId, $isGroup = false)
    {
        $url = config('wasap-one.url').'/send-message';
        try {
            $this->response = Http::connectTimeout(15)
                ->withHeaders([
                    'Server-ID' => config('wasap-one.server_id'),
                ])
                ->withToken(config('wasap-one.token'))->post($url, [
                    'chat_id' => $chatId,
                    'message' => $message,
                    'is_group' => filter_var($isGroup, FILTER_VALIDATE_BOOLEAN),
                ]);
        } catch (\Throwable $th) {
            $this->errorCode = 500;
            $this->errorMessage = $th->getMessage();
        }

        return $this;
    }

    public function sendImage($imageUrl, $message, $chatId, $isGroup = false)
    {
        $url = config('wasap-one.url').'/send-message';
        try {
            $this->response = Http::connectTimeout(15)
                ->withHeaders([
                    'Server-ID' => config('wasap-one.server_id'),
                ])
                ->withToken(config('wasap-one.token'))->post($url, [
                    'chat_id' => $chatId,
                    'url' => $imageUrl,
                    'message' => $message,
                    'type' => 2,
                    'is_group' => filter_var($isGroup, FILTER_VALIDATE_BOOLEAN),
                ]);
        } catch (\Throwable $th) {
            $this->errorCode = 500;
            $this->errorMessage = $th->getMessage();
        }

        return $this;
    }

    public function sendMedia($mediaUrl, $message, $chatId, $isGroup = false, $filename = null)
    {
        $url = config('wasap-one.url').'/send-media';
        try {
            $this->response = Http::connectTimeout(15)
                ->withHeaders([
                    'Server-ID' => config('wasap-one.server_id'),
                ])
                ->withToken(config('wasap-one.token'))->post($url, [
                    'chat_id' => $chatId,
                    'url' => $mediaUrl,
                    'message' => $message,
                    'filename' => $filename ?? $message,
                    'is_group' => filter_var($isGroup, FILTER_VALIDATE_BOOLEAN),
                ]);
        } catch (\Throwable $th) {
            $this->errorCode = 500;
            $this->errorMessage = $th->getMessage();
        }

        return $this;
    }

    public function sendButton($buttonBody, array $buttons, $chatId, $isGroup = false)
    {
        $url = config('wasap-one.url').'/send-button';

        try {
            $this->response = Http::connectTimeout(15)
                ->withHeaders([
                    'Server-ID' => config('wasap-one.server_id'),
                ])
                ->withToken(config('wasap-one.token'))->post($url, [
                    'chat_id' => $chatId,
                    'message' => $buttonBody,
                    'buttons' => $buttons,
                    'is_group' => filter_var($isGroup, FILTER_VALIDATE_BOOLEAN),
                ]);
        } catch (\Throwable $th) {
            $this->errorCode = 500;
            $this->errorMessage = $th->getMessage();
        }

        return $this;
    }

    public function getQr()
    {
        $url = config('wasap-one.url').'/qr';

        try {
            $this->response = Http::connectTimeout(15)
                ->withHeaders([
                    'Server-ID' => config('wasap-one.server_id'),
                ])
                ->withToken(config('wasap-one.token'))->get($url);
        } catch (\Throwable $th) {
            $this->errorCode = 500;
            $this->errorMessage = $th->getMessage();
        }

        return $this;
    }

    public function restartServer()
    {
        $url = config('wasap-one.url').'/servers/restart';

        try {
            $this->response = Http::connectTimeout(15)
                ->withHeaders([
                    'Server-ID' => config('wasap-one.server_id'),
                ])
                ->withToken(config('wasap-one.token'))->get($url);
        } catch (\Throwable $th) {
            $this->errorCode = 500;
            $this->errorMessage = $th->getMessage();
        }

        return $this;
    }

    public function isRegistered($phoneNumber)
    {
        $url = config('wasap-one.url')."/chats/$phoneNumber/is-registered";

        try {
            $this->response = Http::connectTimeout(15)
                ->withHeaders([
                    'Server-ID' => config('wasap-one.server_id'),
                ])
                ->withToken(config('wasap-one.token'))->get($url);

            return $this->response->json()['is_registered'];
        } catch (\Throwable $th) {
            $this->errorCode = 500;
            $this->errorMessage = $th->getMessage();

            return false;
        }
    }

    public function body()
    {
        return $this->response->body();
    }

    public function json()
    {
        return $this->errorMessage ? ['error' => $this->errorMessage] : $this->response->json();
    }

    public function status()
    {
        return $this->errorCode ?? $this->response->status();
    }
}
