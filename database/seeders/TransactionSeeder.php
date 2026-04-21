<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->insert([
            /*
                ledger_id:
                
                unpaid - 14 (ledger_id can be seen in 1 row only (charge only))
                full - 1, 2, 3, 4, 6, 7, 9, 11, 12, 13, 15, 16 (ledger_id can be seen in 2 rows (charge + full payment))
                partial = 5, 8, 10, 17 (ledger_id can be seen in 3 or more rows (charge + partial payment + final payment))
                
            */
            // 2026-01-10 09:15 - Ledger 1: Consultation charged ₱500
            [
                'ledger_id'       => 1,
                'mode_of_payment' => null,
                'debit_amount'    => 500.00,
                'credit_amount'   => 0.00,
                'running_balance' => 500.00,  
                'created_at'      => '2026-01-10 09:15:00',
                'updated_at'      => '2026-01-10 09:15:00',
                'type'            => 'Charge',
            ],

            // 2026-01-10 09:30 - Ledger 2: Prophylaxis charged ₱1,000
            [
                'ledger_id'       => 2,
                'mode_of_payment' => null,
                'debit_amount'    => 1000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1000.00, 
                'created_at'      => '2026-01-10 09:30:00',
                'updated_at'      => '2026-01-10 09:30:00',
                'type'            => 'Charge',
            ],

            // 2026-01-10 09:50 - Ledger 1: Patient pays ₱500 Cash
            [
                'ledger_id'       => 1,
                'mode_of_payment' => 'Cash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 500.00,
                'running_balance' => 0.00,    
                'created_at'      => '2026-01-10 09:50:00',
                'updated_at'      => '2026-01-10 09:50:00',
                'type'            => 'Payment',
            ],

            // 2026-01-10 09:55 - Ledger 2: Patient pays ₱1,000 Cash
            [
                'ledger_id'       => 2,
                'mode_of_payment' => 'Cash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 1000.00,
                'running_balance' => 0.00,  
                'created_at'      => '2026-01-10 09:55:00',
                'updated_at'      => '2026-01-10 09:55:00',
                'type'            => 'Payment',
            ],

            // 2026-01-13 10:10 - Ledger 3: X-ray charged ₱1,000
            [
                'ledger_id'       => 3,
                'mode_of_payment' => null,
                'debit_amount'    => 1000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1000.00,
                'created_at'      => '2026-01-13 10:10:00',
                'updated_at'      => '2026-01-13 10:10:00',
                'type'            => 'Charge',
            ],

            // 2026-01-13 10:30 - Ledger 4: Extraction charged ₱1,200
            [
                'ledger_id'       => 4,
                'mode_of_payment' => null,
                'debit_amount'    => 1200.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1200.00,
                'created_at'      => '2026-01-13 10:30:00',
                'updated_at'      => '2026-01-13 10:30:00',
                'type'            => 'Charge',
            ],

            // 2026-01-13 11:30 - Ledger 3: Patient pays ₱1,000 Cash
            [
                'ledger_id'       => 3,
                'mode_of_payment' => 'Cash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 1000.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-01-13 11:30:00',
                'updated_at'      => '2026-01-13 11:30:00',
                'type'            => 'Payment',
            ],

            // 2026-01-13 11:35 - Ledger 4: Patient pays ₱1,200 GCash
            [
                'ledger_id'       => 4,
                'mode_of_payment' => 'GCash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 1200.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-01-13 11:35:00',
                'updated_at'      => '2026-01-13 11:35:00',
                'type'            => 'Payment',
            ],

            // 2026-01-16 13:30 - Ledger 5: Filling charged ₱1,000
            [
                'ledger_id'       => 5,
                'mode_of_payment' => null,
                'debit_amount'    => 1000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1000.00,
                'created_at'      => '2026-01-16 13:30:00',
                'updated_at'      => '2026-01-16 13:30:00',
                'type'            => 'Charge',
            ],

            // 2026-01-16 14:00 - Ledger 5: Patient pays ₱500 Cash, PARTIAL (still owes ₱500)
            [
                'ledger_id'       => 5,
                'mode_of_payment' => 'Cash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 500.00,
                'running_balance' => 500.00, 
                'created_at'      => '2026-01-16 14:00:00',
                'updated_at'      => '2026-01-16 14:00:00',
                'type'            => 'Payment',
            ],

            // 2026-01-22 10:45 - Ledger 6: Prophylaxis (Mod) charged ₱1,500
            [
                'ledger_id'       => 6,
                'mode_of_payment' => null,
                'debit_amount'    => 1500.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1500.00,
                'created_at'      => '2026-01-22 10:45:00',
                'updated_at'      => '2026-01-22 10:45:00',
                'type'            => 'Charge',
            ],

            // 2026-01-22 11:00 - Ledger 7: Fluoride Cleaning charged ₱2,500
            [
                'ledger_id'       => 7,
                'mode_of_payment' => null,
                'debit_amount'    => 2500.00,
                'credit_amount'   => 0.00,
                'running_balance' => 2500.00,
                'created_at'      => '2026-01-22 11:00:00',
                'updated_at'      => '2026-01-22 11:00:00',
                'type'            => 'Charge',
            ],

            // 2026-01-22 11:30 - Ledger 6: Patient pays ₱1,500 GCash
            [
                'ledger_id'       => 6,
                'mode_of_payment' => 'GCash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 1500.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-01-22 11:30:00',
                'updated_at'      => '2026-01-22 11:30:00',
                'type'            => 'Payment',
            ],

            // 2026-01-22 11:35 - Ledger 7: Patient pays ₱2,500 GCash
            [
                'ledger_id'       => 7,
                'mode_of_payment' => 'GCash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 2500.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-01-22 11:35:00',
                'updated_at'      => '2026-01-22 11:35:00',
                'type'            => 'Payment',
            ],

            // 2026-02-03 09:30 - Ledger 8: Whitening charged ₱25,000
            [
                'ledger_id'       => 8,
                'mode_of_payment' => null,
                'debit_amount'    => 25000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 25000.00,
                'created_at'      => '2026-02-03 09:30:00',
                'updated_at'      => '2026-02-03 09:30:00',
                'type'            => 'Charge',
            ],

            // 2026-02-03 10:45 - Ledger 8: Patient pays ₱12,500 Card, PARTIAL (still owes ₱12,500)
            [
                'ledger_id'       => 8,
                'mode_of_payment' => 'Card',
                'debit_amount'    => 0.00,
                'credit_amount'   => 12500.00,
                'running_balance' => 12500.00, 
                'created_at'      => '2026-02-03 10:45:00',
                'updated_at'      => '2026-02-03 10:45:00',
                'type'            => 'Payment',
            ],

            // 2026-02-10 10:15 - Ledger 9: X-ray charged ₱1,000
            [
                'ledger_id'       => 9,
                'mode_of_payment' => null,
                'debit_amount'    => 1000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1000.00,
                'created_at'      => '2026-02-10 10:15:00',
                'updated_at'      => '2026-02-10 10:15:00',
                'type'            => 'Charge',
            ],

            // 2026-02-10 10:30 - Ledger 10: Jacket Crown charged ₱15,000
            [
                'ledger_id'       => 10,
                'mode_of_payment' => null,
                'debit_amount'    => 15000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 15000.00,
                'created_at'      => '2026-02-10 10:30:00',
                'updated_at'      => '2026-02-10 10:30:00',
                'type'            => 'Charge',
            ],

            // 2026-02-10 12:00 - Ledger 9: Patient pays ₱1,000 Cash
            [
                'ledger_id'       => 9,
                'mode_of_payment' => 'Cash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 1000.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-02-10 12:00:00',
                'updated_at'      => '2026-02-10 12:00:00',
                'type'            => 'Payment',
            ],

            // 2026-02-10 12:05 - Ledger 10: Patient pays ₱7,500 Card, PARTIAL (still owes ₱7,500)
            [
                'ledger_id'       => 10,
                'mode_of_payment' => 'Card',
                'debit_amount'    => 0.00,
                'credit_amount'   => 7500.00,
                'running_balance' => 7500.00,  
                'created_at'      => '2026-02-10 12:05:00',
                'updated_at'      => '2026-02-10 12:05:00',
                'type'            => 'Payment',
            ],

            // 2026-02-20 14:00 - Ledger 11: Consultation charged ₱500
            [
                'ledger_id'       => 11,
                'mode_of_payment' => null,
                'debit_amount'    => 500.00,
                'credit_amount'   => 0.00,
                'running_balance' => 500.00,
                'created_at'      => '2026-02-20 14:00:00',
                'updated_at'      => '2026-02-20 14:00:00',
                'type'            => 'Charge',
            ],

            // 2026-02-20 14:30 - Ledger 12: Prophylaxis (Min) charged ₱1,000
            [
                'ledger_id'       => 12,
                'mode_of_payment' => null,
                'debit_amount'    => 1000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1000.00,
                'created_at'      => '2026-02-20 14:30:00',
                'updated_at'      => '2026-02-20 14:30:00',
                'type'            => 'Charge',
            ],

            // 2026-02-20 15:00 - Ledger 11: Patient pays ₱500 Cash
            [
                'ledger_id'       => 11,
                'mode_of_payment' => 'Cash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 500.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-02-20 15:00:00',
                'updated_at'      => '2026-02-20 15:00:00',
                'type'            => 'Payment',
            ],

            // 2026-02-20 15:05 - Ledger 12: Patient pays ₱1,000 Cash
            [
                'ledger_id'       => 12,
                'mode_of_payment' => 'Cash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 1000.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-02-20 15:05:00',
                'updated_at'      => '2026-02-20 15:05:00',
                'type'            => 'Payment',
            ],

            // 2026-03-05 10:15 - Ledger 13: X-ray charged ₱1,000
            [
                'ledger_id'       => 13,
                'mode_of_payment' => null,
                'debit_amount'    => 1000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1000.00,
                'created_at'      => '2026-03-05 10:15:00',
                'updated_at'      => '2026-03-05 10:15:00',
                'type'            => 'Charge',
            ],

            // 2026-03-05 10:45 - Ledger 14: Filling charged ₱1,000, NO PAYMENT (UNPAID)
            [
                'ledger_id'       => 14,
                'mode_of_payment' => null,
                'debit_amount'    => 1000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1000.00, 
                'created_at'      => '2026-03-05 10:45:00',
                'updated_at'      => '2026-03-05 10:45:00',
                'type'            => 'Charge',
            ],

            // 2026-03-05 11:30 - Ledger 13: Patient pays ₱1,000 GCash
            [
                'ledger_id'       => 13,
                'mode_of_payment' => 'GCash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 1000.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-03-05 11:30:00',
                'updated_at'      => '2026-03-05 11:30:00',
                'type'            => 'Payment',
            ],

            // 2026-03-18 09:30 - Ledger 15: Sealant charged ₱1,000
            [
                'ledger_id'       => 15,
                'mode_of_payment' => null,
                'debit_amount'    => 1000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1000.00,
                'created_at'      => '2026-03-18 09:30:00',
                'updated_at'      => '2026-03-18 09:30:00',
                'type'            => 'Charge',
            ],

            // 2026-03-18 10:00 - Ledger 15: Patient pays ₱1,000 Cash
            [
                'ledger_id'       => 15,
                'mode_of_payment' => 'Cash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 1000.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-03-18 10:00:00',
                'updated_at'      => '2026-03-18 10:00:00',
                'type'            => 'Payment',
            ],

            // 2026-04-02 10:15 - Ledger 16: X-ray charged ₱1,000
            [
                'ledger_id'       => 16,
                'mode_of_payment' => null,
                'debit_amount'    => 1000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 1000.00,
                'created_at'      => '2026-04-02 10:15:00',
                'updated_at'      => '2026-04-02 10:15:00',
                'type'            => 'Charge',
            ],

            // 2026-04-02 10:30 - Ledger 17: Root Canal charged ₱8,000
            [
                'ledger_id'       => 17,
                'mode_of_payment' => null,
                'debit_amount'    => 8000.00,
                'credit_amount'   => 0.00,
                'running_balance' => 8000.00, 
                'created_at'      => '2026-04-02 10:30:00',
                'updated_at'      => '2026-04-02 10:30:00',
                'type'            => 'Charge',
            ],

            // 2026-04-02 13:00 - Ledger 16: Patient pays ₱1,000 Cash
            [
                'ledger_id'       => 16,
                'mode_of_payment' => 'Cash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 1000.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-04-02 13:00:00',
                'updated_at'      => '2026-04-02 13:00:00',
                'type'            => 'Payment',
            ],

            // 2026-04-02 13:05 - Ledger 17: Patient pays ₱2,000 GCash, PARTIAL (still owes ₱6,000)
            [
                'ledger_id'       => 17,
                'mode_of_payment' => 'GCash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 2000.00,
                'running_balance' => 6000.00,
                'created_at'      => '2026-04-02 13:05:00',
                'updated_at'      => '2026-04-02 13:05:00',
                'type'            => 'Payment',
            ],

            // 2026-04-10 14:20 - Ledger 17: Patient pays remaining ₱6,000 GCash
            [
                'ledger_id'       => 17,
                'mode_of_payment' => 'GCash',
                'debit_amount'    => 0.00,
                'credit_amount'   => 6000.00,
                'running_balance' => 0.00,  
                'created_at'      => '2026-04-10 14:20:00',
                'updated_at'      => '2026-04-10 14:20:00',
                'type'            => 'Payment',
            ],

            // 2026-04-15 10:00 - Ledger 8: Patient pays remaining ₱12,500
            [
                'ledger_id'       => 8,
                'mode_of_payment' => 'Card',
                'debit_amount'    => 0.00,
                'credit_amount'   => 12500.00,
                'running_balance' => 0.00,
                'created_at'      => '2026-04-15 10:00:00',
                'updated_at'      => '2026-04-15 10:00:00',
                'type'            => 'Payment',
            ],
        ]);
    }
}