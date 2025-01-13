<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\FavoriteService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class FavoriteController extends Controller
{
    public function __construct(
        private readonly FavoriteService $favoriteService
    ) {
    }

    public function index(): View|Factory|Application
    {
        $favorites = $this->favoriteService->paginate(15);

        return view('favorites.index', compact('favorites'));
    }

    public function toggle(Product $product): RedirectResponse
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Войдите, чтобы добавить в избранное.');
        }

        $message = $this->favoriteService->addToFavorite($user, $product);
        return redirect()->back()->with('success', $message);
    }
}
