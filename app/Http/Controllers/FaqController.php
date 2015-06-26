<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hexcores\Api\Facades\Response as ApiResponse;

use App\Model\FaqModel as Faq;
use App\Transformers\FaqTransformer;

/**
* Controller for the Faq API Application.
*
* @package Election Ddeveloper Website
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
     * $faqTransformer
     * @var [type]
     */
	protected $faqTransformer;

    /**
     * construct method
     * @param App\Transformers\FaqTransformer $faqTransformer
     * @param App\Model\FaqModel              $model          
     */
	function __construct(FaqTransformer $faqTransformer, Faq $model)
	{
		$this->faqTransformer = $faqTransformer;
		$this->model = $model;
	}


    /**
     * Index Function for faq api ( get all faq by pagination)
     * @param  Illuminate\Http\Request $request
     * @return Hexcores\Api\Facades\Response
     */
    public function index(Request $request)
    {
    	$limit = $request->input('limit') ? : 10;

    	$skip = $request->input('page') ? : 1;
        
        $faq = $this->model->paginate($limit, $skip);
        
    	if ($faq->isEmpty()) {

    		return ApiResponse::missing();
    	}

    	return ApiResponse::ok(
            $this->withPagination($faq,
                $this->faqTransformer->transformCollection($faq->all())
            ));
    }


    /**
     * Get Faq By Id
     * @param  string $id
     * @return Hexcores\Api\Facades\Response
     */
    public function getFaq($id)
    {
    	$faq = $this->model->get($id);

    	if (!$faq) {

    		return ApiResponse::missing();

    	}
    	return ApiResponse::ok($this->faqTransformer->transform($faq->toArray()));
    }


    /**
     * Get Faq by question type
     * @param  Illuminate\Http\Request $request
     * @return Hexcores\Api\Facades\Response
     */
    public function getFaqByType(Request $request)
    {
        $type = $request->input('type');

        $limit = $request->input('limit') ? : 10;

        $skip = $request->input('page') ? : 1;

        if ($type !== 'yes_no' && $type !== 'open_ended' || !$type) {

            return ApiResponse::missing('U need Type Parameters');

        }

        $faq = $this->model->getByType($type,$limit,$skip);

        if ($faq->isEmpty()) {

            return ApiResponse::missing();

        }

        return ApiResponse::ok(

            $this->withPagination($faq,

                $this->faqTransformer->transformCollection($faq->all())

            ));        

    }


    /**
     * Get Faq By Sections
     * @param  Illuminate\Http\Request $request
     * @return Hexcores\Api\Facades\Response
     */
    public function getFaqBySections(Request $request)
    {
        $section = $request->input('section');

        $limit = $request->input('limit') ? : 10;

        $skip = $request->input('page') ? : 1;

        if (!$section) {
            
            return ApiResponse::missing('U need Section Parameters');
        }

        $faq = $this->model->getBySection($section,$limit,$skip);

        if ($faq->isEmpty()) {

            return ApiResponse::missing();

        }

        return ApiResponse::ok(

            $this->withPagination($faq,

                $this->faqTransformer->transformCollection($faq->all())

            ));  

    }


    /**
     * Get Faq By Question
     * @param  Illuminate\Http\Request $request
     * @return Hexcores\Api\Facades\Response
     */
    public function getFaqByQuestion(Request $request)
    {
        $question = $request->input('question');

        $limit = $request->input('limit') ? : 10;

        $skip = $request->input('page') ? : 1;

        if (!$question) {
            
            return ApiResponse::missing('U need Question Parameters');
        }

        $faq = $this->model->getByQuestion($question,$limit,$skip);

        if ($faq->isEmpty()) {

            return ApiResponse::missing();

        }

        return ApiResponse::ok(

            $this->withPagination($faq,

                $this->faqTransformer->transformCollection($faq->all())

            ));  
    }
}
