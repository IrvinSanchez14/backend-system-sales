<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{
    public function store(Request $request, Product $product, User $buyer)
    {
        dd($product->id);
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request, $rules);

        if ($buyer->id == $product->seller_id) {
            return $this->errorResponse('el buyer debe ser diferente al seller', 409);
        }

        if (!$buyer->isVerified()) {
            return $this->errorResponse('el buyer debe ser verificado por el user', 409);
        }

        if (!$product->seller->isVerified()) {
            return $this->errorResponse('el seller debe ser verificado por el usuario', 409);
        }

        if (!$product->isAvailable()) {
            return $this->errorResponse('el producto no esta disponible', 409);
        }

        if ($product->quantity < $request->quantity) {
            return $this->errorResponse('el producto no puede tener mas unidades para esta transaction', 409);
        }


        return DB::transaction(function () use ($request, $product, $buyer) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);


            return $this->showOne($transaction, 201);
        });
    }
}
