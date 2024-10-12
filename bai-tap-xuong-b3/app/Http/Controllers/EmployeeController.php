<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'employees.';
    public function index()
    {
        $data = Employee::latest('id')->paginate(5);
        // dd($data);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('employees')
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('employees')
            ],
            'date_of_birth' => 'required|date|before:today',
            'hire_date' => 'required|date|after_or_equal:data_of_bỉth',
            'salary' => 'required|numeric|min:0',
            'is_active' => ['nullable', Rule::in([0, 1])],
            'department_id' => 'required|integer|exists:employees,department_id',
            'manager_id' => 'required|integer|exists:employees,manager_id',
            'address' => 'required',
            // 'profile_picture'=>'nullable|image',
        ]);
        //    logic
        try {
            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = Storage::put('employees', $request->file('profile_picture'));
            }
            Employee::query()->create($data);
            return redirect()
                ->route('employees.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            if (!empty($data['profile_picture']) && Storage::exists($data['profile_picture'])) {
                Storage::delete($data['profile_picture']);
            }
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        // dd($employee);
        return view(self::PATH_VIEW . __FUNCTION__, compact('employee'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employee'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('employees')->ignore($employee->id) // bỏ qua khi kiểm tra duy nhất
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('employees')->ignore($employee->id)
            ],
            'date_of_birth' => 'required|date|before:today',
            'hire_date' => 'required|date|after_or_equal:data_of_bỉth',
            'salary' => 'required|numeric|min:0',
            'is_active' => ['nullable', Rule::in([0, 1])],
            'department_id' => 'required|integer|exists:employees,department_id',
            'manager_id' => 'required|integer|exists:employees,manager_id',
            'address' => 'required',
            // 'profile_picture'=>'nullable|image|max:',
        ]);
        //    logic
        try {
            $data['is_active'] ??= 0;
            // if ($request->hasFile('profile_picture')) {
            //     $data['profile_picture'] = Storage::put('employees', $request->file('profile_picture'));
            // }
            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = $filePath = $request->file('profile_picture')->store('employees', 'public');
                //    dd($data);
                // $data['profile_picture'] = Storage::put('employees', $request->file('profile_picture'));
            }
            // Lưu ảnh cũ để sau khi update có thể xóa nếu cần
            $currentImage = $employee->profile_picture;
            $employee->update($data);
            // sau update nếu lỗi xóa ảnh 
            if (
                $request->hasFile('profile_picture')
                && !empty($currentImage)
                && Storage::exists($data['profile_picture'])
            ) {
                Storage::delete($currentImage);
            }

            return back()->with('success', true);

        } catch (\Throwable $th) {
            if (!empty($data['profile_picture']) && Storage::exists($data['profile_picture'])) {
                Storage::delete($data['profile_picture']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', true)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function forceDestroy(Employee $employee)
    {
        try {

            $employee->forceDelete();
            if (!empty($employee['profile_picture']) && Storage::exists($employee['profile_picture'])) {
                Storage::delete($employee['profile_picture']);
            }
            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', true)
                ->with('error', $th->getMessage());
        }
    }

}
