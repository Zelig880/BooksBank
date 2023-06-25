<?php

namespace App\Http\Controllers\Ledge;

use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateLedgeMessageRequest;
use App\Models\Ledge_Message;
use Illuminate\Support\Facades\Auth;

class LedgeMessageController extends BaseController
{

    public function getMessagesByLedgeId(int $ledgeId)
    {
        //SC88: ensure the current user is part of this ledge
        $messages = Ledge_Message::query()->with(['ledge', 'user'])->where('ledge_id', '=', $ledgeId)->get();
        return $this->responseJson(true, 200, 'Ledge messages retrieved', $messages);
    }

    public function sendMessage(CreateLedgeMessageRequest $request)
    {
        //SC88: ensure the current user is part of this ledge
        $params = $request->validated();
        $params['user_id'] = Auth::id();
        $message = Ledge_Message::query()->create($params);

        return $this->responseJson(true, 200, 'Ledge message sent', $message);
    }

}
