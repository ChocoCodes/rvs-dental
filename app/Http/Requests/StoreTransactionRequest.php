<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Ledger;
use Illuminate\Validation\Validator;

class StoreTransactionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ledger_id' => 'required|integer|exists:ledger,ledger_id',
            'credit_amount' => "required|numeric|min:0.01",
            'mode_of_payment' => 'sometimes|in:Cash,GCash,Card',
            'type' => 'required|in:Charge,Payment'
        ];
    }

    public function after(): array {
        return [
            function (Validator $validator) {
                if ($validator->errors()->hasAny(['ledger_id', 'credit_amount'])) {
                    return;
                }

                $ledger = Ledger::with('transactions')->find($this->ledger_id);
                $total = $ledger->transactions->sum('credit_amount');
                $remaining = $ledger->charged_price - $total;

                if ($remaining <= 0) {
                    $validator->errors()->add(
                        'credit_amount',
                        'This procedure has already been fully paid'
                    );
                    return;
                }

                $formatted = number_format($remaining, 2);

                if ((float) $this->credit_amount > $remaining) {
                    $validator->errors()->add(
                        'credit_amount',
                        "Credit amount must not exceed ₱{$formatted}."
                    );
                }
            }
        ];
    }

    public function messages(): array
    {
        return [
            'ledger_id.exists' => 'Ledger ID not found.',
            'ledger_id.required' => 'Ledger ID is required.',
            'credit_amount.required' => 'Credit amount is required.',
            'credit_amount.min' => 'Credit entered must not be negative.',
            'mode_of_payment.required' => 'Mode of payment is required.',
            'mode_of_payment.in' => 'Invalid mode of payment.',
            'type.required' => 'Type is required.',
            'type.in' => 'Invalid type.'
        ];
    }
}
