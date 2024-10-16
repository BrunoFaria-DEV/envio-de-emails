<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $shippingId = $this->shipping ? $this->shipping->id : null;

        return [
            'title' => 'required',
			'html' => 'required',
			'file' => 'mimes:csv,txt|max:2024',
			'newaccount' => 'required',
			'customer_account_id' => 'required_if:newaccount,false',
			'related' => 'required_if:newaccount,true',
			'customer_id' => 'required_if:related,true',
			'shipping_type' => 'required',
			'shipping_date' => 'required_if:shipping_type,S',
			'images.*' => 'mimes:jpg,jpeg,png,webp,bmp,gif|max:2024',
			'shipping_code' => 'required|max:30|regex:/^[A-Za-z0-9_-]+$/|unique:shippings,shipping_code,' . $shippingId
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '&#128073; O campo título é obrigatório.',
			'html.required' => '&#128073; O campo html é obrigatório.',

			'file.mimes' => '&#128073; Arquivo inválido, nescessário enviar arquivo csv ou txt.',
			'file.max' => '&#128073; Tamanho do arquivo excede :max Mb.',

			'newaccount' => '&#128073; Pelo menos uma opção deve ser selecionada no campo (Criar Nova Conta)',

			'related.required_if' => '&#128073; É necessário selecionar uma opção no campo (Vincular conta).',

			'customer_id.required_if' => '&#128073; É necessário selecionar um Cliente quando o campo (Vincular conta) está selecionado.',

			'customer_account_id.required_if' => '&#128073; A conta de disparo é obrigatória.',

			'shipping_type' => '&#128073; O tipo de disparo deve ser selecionado.',

			'shipping_date.required_if' => '&#128073; A data de disparo é obrigatória.',

			'images.*.mimes' => 'Apenas imagens no formato jpeg, png, webp, bmp e gif são aceitas.',
       		'images.*.max' => 'O tamanho máximo de cada imagem é de :max Mb',

			'shipping_code.required' => '&#128073; O Código de disparo é obrigatório.',
			'shipping_code.unique' => '&#128073; O Código de disparo já existe.',
        ];
    }
}
