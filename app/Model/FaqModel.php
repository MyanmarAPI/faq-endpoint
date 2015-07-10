<?php namespace App\Model;

use App\Model\AbstractModel;

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
}