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

    public function update(UpdateBookshelfRequest $request, $id)
    {
        return $this->user->bookshelves()->find($id)->update($request->validated());
    }

}
