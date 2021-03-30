<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Highlight;
class HighlightShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = $request->user();
//	$this
/*	$data = [];
	$elements = $this->highlightable;
	$i = 0;
	$arr = [];
	$arrw = [];
	foreach($elements as $element){
	    if($i<5){
		if($element->highlightable_type=='biography'){
			$arr =  ['id','slug','surname','firstname','patronymic'];
		}
		else{
			$arr = ['id','slug','title'];
		}
//		$arrw[]=HighlightResource::make($element->highlightable()->first());
		$el =  $element->highlightable()->get($arr)->first;
		$lan =[];
		$lan['id']=$el->id;
		$lan['slug']=$el->slug;
		$arrw[] = [
				'id' => $el->id->id,
				'slug' => $el->slug,
				//'model_type' => $element->highlightable_type,
                                //'title' => $element->highlightable_type=='biography'?$el->get('surname')->surname.' '.$el->firstname.' '.$el->patronymic:$el->title
			];
		$i++;
	    }
	}*/
        return [
            'model_type' => $this->type,
            'title' => $this->title,
	    'slug' => $this->slug,
            'announce' => $this->announce,
            'published_at' => $this->published_at,
            'count' => $this->highlightable->count(),
            'likes' => $this->countLikes(),
            'views' => $this->viewed,
            'has_like' => $user ? $this->checkLiked($user) : false,
            'has_bookmark' => $user ? $this->hasBookmark($user): false,
            'image' => [
                "model_type" => "image",
                "id" => 1294,
                "alt" => null,
                "src" => "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt.jpg",
                "preview" => "/images/articles/02/bwEmBMLhUWJBM5JT3VgHsDZ8NcVTWiytv99WSaxt_min.jpg",
                "original" => null,
                "order" => 1
            ],
//            'list' => HighlightsSuperShortResource::collection($this->highlightable),
//		'list' => HighlightsSuperShortResource::collection(Highlight::where('id','=',$this->id)->first()->highlightable)
//		'list' => Highlight::find($this->id)->first()->highlightable()
//		'list' => HighlightsSuperShortResource::collection(Highlight::where('id','=',$this->id)->first()->highlightable)
//		'list' => $arrw
        ];
    }
}
