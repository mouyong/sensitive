<?php

namespace Mouyong\Sensitive\Listeners;


use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mouyong\Sensitive\Services\SensitiveFilter;

class AdjudicationDetectionJob
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \Mouyong\Sensitive\Events\AdjudicationDetectionSubmited  $event
     * @return void
     */
    public function handle($event)
    {
        $adjudicationDetection = $event->adjudicationDetection;
        $content = $adjudicationDetection->content;

        $sensitive = new SensitiveFilter();

        $stripTagsContent = strip_tags($content);
        $isLegal = $sensitive->isLegal($stripTagsContent);
        $badWords = $sensitive->getBadWords($stripTagsContent);
        $replaceContent = $sensitive->replace($content);


        $adjudicationDetection->update([
            'extra' => [
                'is_legal' => $isLegal,
                'bad_words' => $badWords,
                'content_raw' => $content,
                'content_strip_tags' => $stripTagsContent,
                'content_replace_content' => $replaceContent,
            ],
        ]);
    }
}
