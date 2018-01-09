<?php
namespace Modules\Admin\Http\Requests\Tools;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
    
class CreateCustomPagesManagerRequest extends FormRequest
{
    
    /**
     * Create code in constructor so we can set validation rule
     * CustomPagesManagerRequest constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $timestamp = strtotime("now");
        $request->request->add(['created_by' => admin()->id, 'created_date' => $timestamp, 'modified_date' => $timestamp, 'modified_by' => admin()->id]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'        => 'required|string|min:3|max:125',
            'title'       => 'required|string|min:3|max:125',
            'template_id' => 'required|exists:templates,id',
            'content'     => 'required|string',
            'logo_image'  => 'mimes:jpeg,jpg,png|max:1000'
        ];
        return $rules;
    }

    /** {@inheritdoc} */
    public function attributes()
    {
        return [
            'name'       => 'Name',
            'title'   => 'Title',
            'template_id' => 'Template',
            'content' => 'Content',
            'logo_image' => "File Type is not valid"
        ];
    }
    
}
