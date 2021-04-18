<?php

namespace MorenoRafael\JsonApi\Traits;

class Apiable
{
    public function jsonApi()
    {
        $class = '\\App\\JsonApi\\' . class_basename($this);

        return new $class($this);
    }
}
