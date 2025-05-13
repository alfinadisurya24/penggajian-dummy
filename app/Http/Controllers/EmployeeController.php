<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $data = Employee::paginate(10);
        
        $compact = compact(
            'data'
        );
        return view('page.employee.index', $compact);
    }

    public function create() {
        $urlFormAction  = route('employee.store');
        $action         = 'create';

        return view('page.employee.form' , compact('urlFormAction', 'action'));
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), Employee::FORM_VALIDATION_RULES);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Data Pegawai gagal ditambahkan!');
        }

        DB::beginTransaction();
        try {
            $validatedData = $validator->validated();
            $insert = Employee::create($validatedData);
            DB::commit();

            $toast = array(
                'message' => 'Data Pegawai berhasil ditambahkan',
                'alert-type' => 'success'
            );
            return redirect()->route('employee.index')->with($toast);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput()
                ->with('error', 'Data Pegawai gagal ditambahkan!');
        }
    }

    public function edit(string $id)
    {
        $data           = Employee::find($id);
        if (empty($data)) {
            abort(404);
        }
        $urlFormAction  = route('employee.update', ['id' => $id]);
        $action         = 'update';

        $compact = compact(
            'urlFormAction',
            'action',
            'data'
        );
        return view('page.employee.form', $compact);
    }

    public function update(Request $request, string $id)
    {
        $validationRules = Employee::FORM_VALIDATION_RULES;
        $validator = Validator::make($request->all(), $validationRules);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Data Pegawaigagal diperbarui!');
        }
        
        DB::beginTransaction();
        try {
            $getData = Employee::find($request->id);
            $validatedData = $validator->validated();
            $getData->fill($validatedData);
            $getData->save();

            DB::commit();

            $toast = array(
                'message' => 'Karir berhasil diperbarui',
                'alert-type' => 'success'
            );
            return redirect()->route('employee.index')->with($toast);
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
            $deleteData = Employee::find($id);
            $deleteData->delete();
            DB::commit();
            $toast = array(
                'message' => 'Data Pegawai berhasil dihapus',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($toast);
        } catch (\Exception  $e) {
            DB::rollBack();
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput()
                ->with('error', 'Data Pegawai gagal dihapus!');
        }
    }
}
