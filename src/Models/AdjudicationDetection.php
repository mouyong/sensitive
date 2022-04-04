<?php

namespace Mouyong\Sensitive\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjudicationDetection extends Model
{
    use HasFactory;

    const TYPE_USERINFO = 'userinfo';
    const TYPE_ARTICLE = 'article';
    const TYPE_MAP = [
        AdjudicationDetection::TYPE_USERINFO => '用户信息',
        AdjudicationDetection::TYPE_ARTICLE => '文章',
    ];

    const STATE_WAITING = 'waiting';
    const STATE_PASS = 'pass';
    const STATE_HIDDEN = 'failure';
    const STATE_MAP = [
        AdjudicationDetection::STATE_WAITING => '待检测',
        AdjudicationDetection::STATE_PASS => '通过',
        AdjudicationDetection::STATE_HIDDEN => '屏蔽',
    ];

    protected $fillable = [
        'type',
        'no',
        'result',
        'extra',
    ];

    protected $casts = [
        'extra' => 'json',
    ];
}
