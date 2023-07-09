<?php

namespace App\Http\Controllers\Ledge;

use App\Enums\LedgeStatus;
use App\Jobs\SendEmail;
use App\Http\Controllers\BaseController;
use App\Http\Requests\CreateLedgeMessageRequest;
use App\Models\Ledge_Message;
use App\Models\Ledge;
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
        $params = $request->validated();
        $params['user_id'] = Auth::id();

        //SC88: Send email to user when new message is sent
        $ledge = Ledge::find($request->input('ledge_id'));

        if( $ledge->status === LedgeStatus::Completed ) {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        // we need to sent the email to the "other" person of the ledge
        if ( $ledge->lender_id === $params['user_id'] ){ 
            $emailToSend = $ledge->borrower->email;
        } elseif ( $ledge->borrower_id === $params['user_id'] ) {
            $emailToSend = $ledge->borrower->email;
        } else {
            return response()->json(['error' => 'Not authorized.'], 403);
        }

        $message = Ledge_Message::query()->create($params);

        SendEmail::dispatch('App\Mail\LedgeNewMessage', $ledge, $emailToSend);

        return $this->responseJson(true, 200, 'Ledge message sent', $message);
    }

}
