<?php

namespace Mouyong\Sensitive;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Support\Arrayable;
use Mouyong\Sensitive\Models\AdjudicationDetection;
use Mouyong\Sensitive\Events\AdjudicationDetectionSubmited;

class SensitiveJobSubmiter
{
    protected array $data;
    protected Arrayable $extra;
    
    public function __construct(array $data)
    {
        $this->validate($data);
        $this->data = $data;

        $this->setExtra($data);
    }

    public function validate(array $data)
    {
        \validator()->validate($data, [
            'type' => ['required', Rule::in(array_keys(AdjudicationDetection::TYPE_MAP))], 
            'no' => 'required',
        ]);
    }

    public function setExtra(array $data)
    {
        $extra = match ($data['type']) {
            AdjudicationDetection::TYPE_ARTICLE => new Article($data),
            AdjudicationDetection::TYPE_ARTICLE => new UserInfo($data),
        };

        $this->extra = $extra;
    }

    public function addCheckJob()
    {
        $adjudicationDetection = AdjudicationDetection::create([
            'type' => $this->data['type'],
            'no' => $this->data['no'],
            'state' => AdjudicationDetection::STATE_WAITING,
            'extra' => $this->extra->toArray(),
        ]);

        event(new AdjudicationDetectionSubmited($adjudicationDetection));

        return $adjudicationDetection;
    }
}
