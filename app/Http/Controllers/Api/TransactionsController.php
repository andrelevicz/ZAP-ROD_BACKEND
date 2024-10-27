<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "GET /transactions";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return "CREAT /transactions" ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    $userId = auth()->payload()->get('user_id');

    // Use as informações como necessário
    return response()->json([
        'user_id' => $userId,
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "GET /transactions/$id";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
