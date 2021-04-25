<?php

namespace App\Http\Controllers\Bookshelf;

use App\Http\Requests\Bookshelf\UpdateBookshelfRequest;
use Illuminate\Support\Facades\Auth;

class BookshelfManagementController
{

    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }
    
    /**
     * Get bookshelf of current user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function current()
    {
        return response()->json($this->user->bookshelf()->first());
    }

    public function update(UpdateBookshelfRequest $request, $id)
    {
        return $this->user->bookshelf()->find($id)->update($request->validated());
    }

}
