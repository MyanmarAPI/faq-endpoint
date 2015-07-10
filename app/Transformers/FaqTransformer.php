<?php namespace App\Transformers;

use App\Transformers\Contracts\TransformerInterface;
use League\Fractal\TransformerAbstract;

/**
* Transformer class for the Faq API Application.
*
* @package Faq Endpoint
* @license
* @author Thet Paing Oo <thetpaing@hexcores.com>
*/
class FaqTransformer extends TransformerAbstract implements TransformerInterface{

	public function transform($faq)
    {
    	return [
            'id'      => (string)$faq->_id,
            'question'=> $faq->question,
            'answer'  => $faq->answer,
            'type'    => $faq->question_type,
            'basis'   => $faq->official_basis,
            'sections'=> $faq->sections,
            'url'     => $faq->url,
        ];
    }
	
}