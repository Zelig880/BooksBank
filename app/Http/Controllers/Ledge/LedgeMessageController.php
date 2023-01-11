<?php

namespace App\Http\Controllers\Ledge;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateLedgeMessageRequest;
use App\Models\LedgeMessage;
use Illuminate\Support\Facades\Auth;

class LedgeMessageController extends BaseController
{

    public function getMessagesByLedgeId(int $ledgeId)
    {
        $messages = LedgeMessage::query()->with(['ledge', 'user'])->where('ledge_id', '=', $ledgeId)->get();
        return $this->responseJson(true, 200, 'Ledge messages retrieved', $messages);
    }

    public function sendMessage(CreateLedgeMessageRequest $request)
    {
        $params = $request->validated();
        $params['user_id'] = Auth::id();
        $message = LedgeMessage::query()->create($params);

        return $this->responseJson(true, 200, 'Ledge message sent', $message);
    }

}
