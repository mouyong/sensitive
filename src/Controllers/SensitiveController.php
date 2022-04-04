<?php

namespace Mouyong\Sensitive\Controllers;

use App\Http\Controllers\Controller;
use Mouyong\Sensitive\SensitiveJobSubmiter;
use Mouyong\Sensitive\Services\SensitiveFilter;
use ZhenMu\Support\Traits\ResponseTrait;

class SensitiveController extends Controller
{
    use ResponseTrait;

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

        return $this->success([
            'is_legal' => $isLegal,
            'bad_words' => $badWords,
            'content_raw' => $content,
            'content_strip_tags' => $stripTagsContent,
            'content_replace_content' => $replaceContent,
        ]);
    }

    public function submit()
    {
        $sensitiveSubmiter = new SensitiveJobSubmiter(\request()->all());

        $sensitiveSubmiter->addCheckJob();

        return \response()->json([
            'code' => 0,
            'message' => 'success',
            'data' => [],
        ]);
    }
}
