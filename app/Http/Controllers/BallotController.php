<?php
/**
 * Ballot Endpoint
 * 
 * @package App\Http\Controllers
 * @author Li Jia Li <limonster.li@gmail.com>
 * Date: 7/9/15
 * Time: 6:06 PM
 */

namespace App\Http\Controllers;

use MongoDate;
use Carbon\Carbon;
use App\Model\Ballot;
use App\Transformers\BallotTransformer;

class BallotController extends Controller
{
    /**
     * Get Party by Year
     *
     * @return \Symfony\Component\HttpFoundation\Response
     **/
    public function getByType($type)
    {

        $model = new Ballot();

        $result = $model->where('type', $type)->paginate();

        $data = $this->transform($result, new BallotTransformer(), true);

        return response_ok($data);

    }

}