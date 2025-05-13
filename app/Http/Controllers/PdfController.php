<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePDF($id)
    {
        $employeePayment = Payment::select('employees.name', 'employees.nip', 'employees.position', 'employees.salary', 'payments.*')->join('employees', 'payments.employee_id', '=', 'employees.id')->find($id);
        $data = [
            'title' => 'Penggajian',
            'date' => date('m/d/Y'),
            'paymentData' => $employeePayment
        ];

        $pdf = Pdf::loadView('page.pdf.invoice', $data);
        return $pdf->download('invoice.pdf');
    }
}
