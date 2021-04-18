<?php

namespace MorenoRafael\JsonApi;

use Illuminate\Database\Eloquent\Model;

abstract class Schema
{
    protected string $id;

    protected string $type;

    protected Model $model;

    protected array $relationships = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->id = $this->model->uuid;
    }

    abstract protected function attributes(): array;

    public function relationships(array $relationships): self
    {
        foreach ($relationships as $relationship) {
            $this->relationships[] = [
                $relationship => [
                    'data' => [
                        'type' => $relationship,
                        'id' => $this->model->{$relationship}->uuid,
                    ],
                ]
            ];
        }

        return $this;
    }

    public function get(): array
    {
        $schema = [
            'id' => $this->id,
            'type' => $this->type,
            'attributes' => $this->attributes(),
        ];

        if (count($this->relationships) > 0) {
            $schema['relationships'] = $this->relationships;
        }

        return $schema;
    }
}