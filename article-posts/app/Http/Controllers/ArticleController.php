<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->query('limit', 15);
        $offset = $request->query('offset', 0);
        $data = Article::limit($limit)->offset($offset)->get();
        $message = 
            'Menampilkan seluruh article di database dengan paging pada parameter limit & offset.';
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'Title' => 'required|string|min:20|unique:posts',
                'Content' => 'required|string|min:200',
                'Category' => 'required|string|min:3',
                'Status' => 'required|string|in:Publish,Draft,Trash',
            ]);
            $article = Article::create([
                'Title' => $request->input('Title'),
                'Content' => $request->input('Content'),
                'Category' => $request->input('Category'),
                'Status' => $request->input('Status'),
            ]);
            return response()->json([
                'data' => $article,
                'message' => 'Membuat artikel baru'
            ], 201);
        }  catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal membuat artikel baru',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json([
                'message' => 'Artikel tidak ditemukan',
            ], 404); 
        }
        return response()->json([
            'data' => $article,
            'message' => 'Detail artikel'
        ], 200); 
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
        try {
            $article = Article::find($request->id);
            if (!$article) {
                return response()->json([
                    'message' => 'Artikel tidak ditemukan',
                ], 404);
            }
            $request->validate([
                'Title' => 'required|string|min:20|unique:posts,Title,' . $request->id,
                'Content' => 'required|string|min:200',
                'Category' => 'required|string|min:3',
                'Status' => 'required|string|in:Publish,Draft,Trash',
            ]);
            $article->Title = $request->input('Title');
            $article->Content = $request->input('Content');
            $article->Category = $request->input('Category');
            $article->Status = $request->input('Status');
            $article->save();
            return response()->json([
                'data' => $article,
                'message' => 'Artikel berhasil diperbarui'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal mengupdate artikel',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::find($id);
        if (!$article) {
            return response()->json([
                'message' => 'Artikel tidak ditemukan',
            ], 404);
        }
        $article->delete();
        return response()->json([
            'message' => 'Artikel berhasil dihapus'
        ], 200); 
    }

    public function trash(Request $request)
    {
        $article = Article::find($request->id);
        if (!$article) {
            return response()->json([
                'message' => 'Artikel tidak ditemukan',
            ], 404);
        }
        $article->update(['Status' => 'Trash']);
        return response()->json([
            'message' => 'Artikel berhasil ubah'
        ], 200); 
    }

    public function draft(Request $request)
    {
        $article = Article::find($request->id);
        if (!$article) {
            return response()->json([
                'message' => 'Artikel tidak ditemukan',
            ], 404);
        }
        $article->update(['Status' => 'Draft']);
        return response()->json([
            'message' => 'Artikel berhasil ubah'
        ], 200); 
    }

    public function publish(Request $request)
    {
        $article = Article::find($request->id);
        if (!$article) {
            return response()->json([
                'message' => 'Artikel tidak ditemukan',
            ], 404);
        }
        $article->update(['Status' => 'Publish']);
        return response()->json([
            'message' => 'Artikel berhasil ubah'
        ], 200); 
    }
}
