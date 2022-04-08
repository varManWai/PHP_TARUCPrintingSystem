<?php

//Author: Lai Man Wai

namespace App\Http\Requests;

use App\Rules\cashTenderRule;
use App\Rules\creditTypeRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class InputValidator extends FormRequest
{
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
        //postive Number
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:.\d+)?$/";
        if ($this->request->get('payType') == 'creditDebit') {
            return [
                'firstName' => 'required|min:3',
                'lastName' => 'required',
                'phoneNo' => 'required|numeric',
                'email' => 'required|email',
                'unitNo' => 'required',
                'strAddress' => 'required',
                'postCode' => 'required',
                'city' => 'required',
                'state' => 'required',

                'totalAmount' => 'required',
                'payType' => 'required',

                'cardType' => 'required_if:payType,creditDebit',
                'cardNum' => ['required_if:payType,creditDebit', new creditTypeRule($this->request->get('cardType'))],
                //'cardNum' => ['required', 'regex:/(^(5[1-5][0-9]{14}|2(22[1-9][0-9]{12}|2[3-9][0-9]{13}|[3-6][0-9]{14}|7[0-1][0-9]{13}|720[0-9]{12}))$)/'],

                'cardName' => 'required_if:payType,creditDebit',
                'expMonth' => 'required_if:payType,creditDebit',
                'expYear' => 'required_if:payType,creditDebit',
                'cvv' => 'required_if:payType,creditDebit| numeric',



            ];
        } else {
            return [
                'firstName' => 'required|min:3',
                'lastName' => 'required',
                'phoneNo' => 'required|numeric',
                'email' => 'required|email',
                'unitNo' => 'required',
                'strAddress' => 'required',
                'postCode' => 'required',
                'city' => 'required',
                'state' => 'required',

                'totalAmount' => 'required',
                'payType' => 'required',



                'receiver' => 'required_if:payType,cod',
                'cashTender' => ['required_if:payType,cod', new cashTenderRule($this->request->get('totalAmount'))]



            ];
        }
    }
}