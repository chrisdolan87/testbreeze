<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{

    public function view(Request $request)
    {
        $genres = Genre::latest()->get();

        // Get the logged-in user
        $user = Auth::user();

        $basket = $user->basket()->paginate(12);

        return view('basket', [
            'basket' => $basket,
            'genres' => $genres,
        ]);
    }

    public function store(Request $request, $book_id)
    {
        $user_id = Auth::user()->id;

        Basket::create([
            'user_id' => $user_id,
            'book_id' => $book_id,
            'quantity' => 1
        ]);

        return redirect()->back()->with('basket-added', 'Book added to basket!');
    }



    public function update($item_id, $action)
    {
        // Find the basket item
        $item = Basket::findOrFail($item_id);

        // Update the quantity based on the action
        if ($action === 'increase') {
            $item->quantity += 1;
        } elseif ($action === 'decrease' && $item->quantity > 1) {
            $item->quantity -= 1;
        }

        $item->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Basket updated successfully!');
    }




    public function destroy($book_id)
    {
        // Remove book from basket
        Basket::where('user_id', Auth::id())
            ->where('book_id', $book_id)
            ->delete();

        return redirect()->back()->with('basket-removed', 'Book removed from basket!');
    }
}
