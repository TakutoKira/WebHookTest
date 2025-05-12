<?php

namespace App\Http\Controllers;

use App\Services\GoogleChatService;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    protected $googleChatService;

    public function __construct(GoogleChatService $googleChatService)
    {
        $this->googleChatService = $googleChatService;
    }

    /**
     * Webhookテストページを表示
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('webhooktest');
    }

    /**
     * Webhookを送信する
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string'
        ]);

        $success = $this->googleChatService->sendMessage($validated['message']);

        // セッションに結果を保存
        $resultMessage = $success ?
            "メッセージが正常に送信されました。\n\n送信内容: {$validated['message']}" :
            "メッセージの送信に失敗しました。\n\n送信しようとした内容: {$validated['message']}";

        session()->flash('result', [
            'success' => $success,
            'message' => $resultMessage
        ]);

        return redirect()->route('webhook.index');
    }
}
