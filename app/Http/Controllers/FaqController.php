<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\FaqModel as Faq;
use App\Transformers\FaqTransformer;

/**
* Controller for the Faq API Application.
*
* @package Faq Endpoint
* @license
* @author Thet Paing Oo <thetpaing@hexcores.com>
*/
class FaqController extends Controller
{
    /**
     * $model
     * @var [type]
     */
	protected $model;

    /**
     * construct method
     * @param App\Transformers\FaqTransformer $faqTransformer
     * @param App\Model\FaqModel              $model          
     */
	function __construct(Faq $model)
	{
		$this->model = $model;
	}


    /**
     * Index Function for faq api ( get all faq by pagination)
     * @param  Illuminate\Http\Request $request
     * @return Hexcores\Api\Facades\Response
     */
    public function index(Request $request)
    {
        $data = $this->transform($this->filter($request), new FaqTransformer(), true);
        

        return response_ok($data);
    }


    /**
     * Get Faq By Id
     * @param  string $id
     * @return Hexcores\Api\Facades\Response
     */
    public function getFaq($id)
    {
    	$faq = $this->model->find($id);

        if (!$faq) {
            return response_missing();
        }

        return response_ok($this->transform($faq, new FaqTransformer()));
    }


    /**
     * Get Faq By Question
     * @param  Illuminate\Http\Request $request
     * @return Hexcores\Api\Facades\Response
     */
    public function getFaqByQuestion(Request $request)
    {
        $question = $request->input('q');

        if (!$question) {
            
            return response_missing('U need Question Parameters');
        }

        $faq = $this->model->like('question',$question)->paginate();

        return response_ok($this->transform($faq, new FaqTransformer(), true));
    }

    /**
     * Filter For FAQ
     * @param  Illuminate\Http\Request $request
     * @return LengthAwarePaginator
     */
    protected function filter($request)
    {
        if ($type = $request->input('type')) {

            $this->model = $this->model->where('question_type', $type);

        }

        if ($section = $request->input('section')) {

            $this->model = $this->model->like('sections',$section);
        }

        return $this->model->paginate();
    }
}
