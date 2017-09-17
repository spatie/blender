<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Media extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'collection' => $this->collection_name,
            'fileName' => $this->file_name,
            'customProperties' => $this->custom_properties,
            'orderColumn' => $this->order_column,
            'thumbUrl' => strtolower($this->extension) === 'svg' ?
                $this->getUrl() :
                $this->getUrl('admin'),
            'originalUrl' => $this->getUrl(),
        ];
    }
}
