<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class HighlightsSuperShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
	$map = [
            'videomaterial'
        ];
        $notMap = [
            'news', 'highlight', 'event', 'audiomaterial', 'biography'
        ];

/*	$map = [
            'news' => 'news',
            'biography' => 'biographies',
            'article' => 'articles',
            'videomaterial' => 'videomaterials',
            'audiomaterial' => 'audiomaterials',
            'podcast' => 'podcasts',
            'test' => 'tests',
            'afisha' => 'events'
        ];*/

//	$type=$map["{$this->highlightable_type}"];
//	$entity=DB::table("{$type}")->where('id','=',$this->highlightable_id)->first();
//	$title = $this->highlightable_type=='biography'?$entity->surname.' '.$entity->firstname.' '.$entity->patronymic:$entity->title;
        $user = $request->user();
        $arr = in_array($this->highlightable_type, $map) ? $this->highlightable->type : $this->highlightable_type;
        if ($arr == 'audiomaterial') {
            $arr = 'audiolecture';
        }
        return [
		'model_type' => $this->highlightable_type,
		'id'=>$this->id,
//		'title'=>$title,
//		'slug' =>$entity->slug,
//            'id' => $this->highlightable_id,
            'title' => $this->highlightable_type!='biography'?
                $this->highlightable->title:$this->highlightable->surname.' '.
                $this->highlightable->firstname.' '.
                $this->highlightable->patronymic,
            'slug' => $this->highlightable->slug,
//            'surname' => $this->highlightable->surname,
//            'lastname' => $this->highlightable->surname,
//            'patronymic' => $this->highlightable->surname,
        ];
    }
}
