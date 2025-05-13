<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index() {
        $data = Payment::select('employees.name', 'employees.nip', 'employees.position', 'employees.salary', 'payments.*')->join('employees', 'payments.employee_id', '=', 'employees.id')->paginate(10);
        
        $compact = compact(
            'data'
        );
        return view('page.payment.index', $compact);
    }

    public function create() {
        $urlFormAction  = route('payment.store');
        $action         = 'create';

        return view('page.payment.form' , compact('urlFormAction', 'action'));
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), Payment::FORM_VALIDATION_RULES);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Data Penggajian gagal ditambahkan!');
        }

        DB::beginTransaction();
        try {
            $validatedData = $validator->validated();

            // ambil data employee
            $paymentInsert = [];
            $employee = Employee::get();
            foreach ($employee as $key => $value) {
                $paymentInsert[] = [
                    'employee_id' => $value->id,
                    'month' => $validatedData['month'],
                    'year' => $validatedData['year']  
                ];
            }
            
            $insert = Payment::insert($paymentInsert);
            DB::commit();

            $toast = array(
                'message' => 'Data Penggajian berhasil ditambahkan',
                'alert-type' => 'success'
            );
            return redirect()->route('payment.index')->with($toast);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput()
                ->with('error', 'Data Penggajian gagal ditambahkan!');
        }
    }

    public function edit(string $id)
    {
        $data           = Payment::find($id);
        if (empty($data)) {
            abort(404);
        }
        $urlFormAction  = route('payment.update', ['id' => $id]);
        $action         = 'update';

        $compact = compact(
            'urlFormAction',
            'action',
            'data'
        );
        return view('page.payment.form', $compact);
    }

    public function update(Request $request, string $id)
    {
        $validationRules = Payment::FORM_VALIDATION_RULES;
        $validator = Validator::make($request->all(), $validationRules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Data Penggajiangagal diperbarui!');
        }
        
        DB::beginTransaction();
        try {
            $getData = Payment::find($request->id);
            $validatedData = $validator->validated();
            $getData->fill($validatedData);
            $getData->save();

            DB::commit();

            $toast = array(
                'message' => 'Karir berhasil diperbarui',
                'alert-type' => 'success'
            );
            return redirect()->route('payment.index')->with($toast);
        } catch (\Exception  $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput()
                ->with('error', 'Karir gagal diperbarui!');
        }
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $deleteData = Payment::find($id);
            $deleteData->delete();
            DB::commit();
            $toast = array(
                'message' => 'Data Penggajian berhasil dihapus',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($toast);
        } catch (\Exception  $e) {
            DB::rollBack();
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput()
                ->with('error', 'Data Penggajian gagal dihapus!');
        }
    }
}
