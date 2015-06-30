<?php namespace App\Model;

use MongoRegex;

use App\Model\AbstractModel;

use Illuminate\Support\Collection;

/**
* Model for the Faq API Application.
*
* @package Faq Endpoint
* @license
* @author Thet Paing Oo <thetpaing@hexcores.com>
*/
class FaqModel extends AbstractModel
{
    /**
     * model name
     * @return string
     */
    public function getCollectionName()
    {
        return 'faq_api';
    }

    /**
     * create faq model
     * @param  array  $data [description]
     * @return \Hexcores\MongoLite\Document|bool
     */
    public function create(array $data)
    {
        return $this->getCollection()->insert($data);
    }

    /**
     * change array to collection
     * @param  array  $array
     * @return Illuminate\Support\Collection
     */
    protected function changeCollection(array $array)
    {
    	return new Collection($array);
    }


    /**
     * get faq by type
     * @param  string  $type
     * @param  integer $limit
     * @param  integer $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByType($type, $limit =10 , $page = 1)
    {
        $faq = $this->changeCollection($this->getManyBy('question_type',$type));
        
        $results = $faq->forPage($page, $limit);

        return $this->changePaginater($limit, $results, $faq->count(), $page);
    }

    /**
     * get faq by section
     * @param  string  $section
     * @param  integer $limit
     * @param  integer $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getBySection($section, $limit =10 , $page = 1)
    {
        $faq = $this->changeCollection($this->like('sections',$section)->get());

        $results = $faq->forPage($page, $limit);

        return $this->changePaginater($limit, $results, $faq->count(), $page);
    }

    /**
     * get faq by question
     * @param  string  $question
     * @param  integer $limit
     * @param  integer $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getByQuestion($question, $limit = 10 , $page = 1 )
    {
        $faq = $this->changeCollection($this->like('question',$question)->get());

        $results = $faq->forPage($page, $limit);

        return $this->changePaginater($limit, $results, $faq->count(), $page);
    }
}