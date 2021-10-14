<?php

namespace App\Http\Controllers\moderador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ArticleImage;
use Illuminate\Support\Facades\Storage;

class ArticleImageController extends Controller
{
    public function destroy(ArticleImage $imagen){
        $this->authorize('delete', $imagen);
        Storage::disk('public')->delete('/imageArticle/' .$imagen->nombre);
        $imagen->delete();
        $notificacion="La imagen se eliminó correctamente";
        return back()->with(compact('notificacion'));
    }
}
