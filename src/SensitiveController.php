<?php

namespace Mouyong\Sensitive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SensitiveController extends Controller
{
    public function check()
    {
        \request()->validate([
            'content' => 'required',
        ]);

        $content = \request()->content;

        $sensitive = new SensitiveFilter();

        $stripTagsContent = strip_tags($content);
        
        $isLegal = $sensitive->isLegal($stripTagsContent);
        $badWords = $sensitive->getBadWords($stripTagsContent);
        $replaceContent = $sensitive->replace($content);

        return response()->json([
            'code' => 0,
            'message' => 'success',
            'data' => [
                'is_legal' => $isLegal,
                'bad_words' => $badWords,
                'content_raw' => $content,
                'content_strip_tags' => $stripTagsContent,
                'content_replace_content' => $replaceContent,
            ]
        ]);
    }
}
