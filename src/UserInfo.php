<?php

namespace Mouyong\Sensitive;

use Illuminate\Contracts\Support\Arrayable;

class UserInfo implements Arrayable
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->validate($data);

        $this->data = $data;
    }

    public function validate(array $data)
    {
        \validator()->validate($data, [
            'username' => 'nullable|string',
            'avatar' => 'nullable|string',
            'nickname' => 'required|string',
        ]);
    }

    public function toArray()
    {
        return $this->data;
    }
}
