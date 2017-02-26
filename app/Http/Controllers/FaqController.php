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
    public function index(Request $request, $year = '2015')
    {

        $data = $this->transform($this->filter($request, $year), new FaqTransformer(), true);
        

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
    public function getFaqByQuestion(Request $request, $year = '2015')
    {
        $question = $request->input('q');

        if (!$question) {
            
            return response_missing('U need Question Parameters');
        }

        $this->model = $this->model->like('question',$question);

        if ($year == '2017') {
            $this->model = $this->model->where('election', '2017ByElection');
        } else {
            $this->model = $this->model->where('election', '2015GeneralElection');
        }

        $faq = $this->model->paginate();

        return response_ok($this->transform($faq, new FaqTransformer(), true));
    }

    /**
     * Filter For FAQ
     * @param  Illuminate\Http\Request $request
     * @return LengthAwarePaginator
     */
    protected function filter($request, $year)
    {
        if ($type = $request->input('type')) {

            switch ($type) {
                case 'yes_no':
                    $type = 'Yes/No';
                    break;
                
                case 'open_ended':
                    $type = 'Open-ended';
                    break;
            }

            $this->model = $this->model->where('question_type', $type);

        }

        if ($year == '2017') {
            $this->model = $this->model->where('election', '2017ByElection');
        } else {
            $this->model = $this->model->where('election', '2015GeneralElection');
        }

        if ($section = $request->input('section')) {

            $this->model = $this->model->like('article_or_section',$section);
        }

        if ($category = $request->input('category')) {
            
            $this->model = $this->model->like('question_category',$category);
        }

        if ($law = $request->input('source')) {

            $this->model = $this->model->like('law_or_source',$law);
        }

        return $this->model->paginate();
    }
}
