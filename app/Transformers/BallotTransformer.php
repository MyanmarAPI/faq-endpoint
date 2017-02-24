<?php namespace App\Transformers;

use App\Transformers\Contracts\TransformerInterface;
use League\Fractal\TransformerAbstract;

/**
* Transformer class for the Ballot API Application.
*
* @package Faq Endpoint
* @license
* @author Thet Paing Oo <thetpaing@hexcores.com>
*/
class BallotTransformer extends TransformerAbstract implements TransformerInterface{

	public function transform($data)
    {
    	return [
            'description' => $data->description,
            'file_url' => $data->file_url,
            'type' => $data->type
        ];
    }
	
}