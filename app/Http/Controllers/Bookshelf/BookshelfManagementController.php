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
        $data = $this->user->bookshelf()->first();
        
        if($data) {
            $data->makeVisible(['address_line_1']);
        }
        return response()->json($data);
    }

    public function update(UpdateBookshelfRequest $request, $id)
    {
        return $this->user->bookshelf()->find($id)->update($request->validated());
    }
    
    public function create(UpdateBookshelfRequest $request)
    {
        return $this->user->bookshelf()->create($request->validated());
    }

}
