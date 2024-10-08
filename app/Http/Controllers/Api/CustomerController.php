<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Customer::latest('id')->paginate(5);
        // dd($data);
        
        return response()->json($data); // data = [], status = HTTP response status code

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'avatar' => 'nullable|image|max:2048',
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('customers')
            ],
            'email' => 'required|email|max:100',
            'is_active' => ['nullable', Rule::in([0, 1])],
        ]);
        // Logic
        try {
            // Hoặc isset($data['avatar'])
            $customer = Customer::query()->create($data);
            return response()->json($data, 201);
        } catch (\Throwable $th) {
            // trong catch lưu log 
            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $th->getMessage()]
            );
            return response()->json([
                'message' => 'Lỗi hệ thống'
            ], 500);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            return response()->json($customer);
        } else {
            return response()->json('Không tồn tại ban ghi có ID =' . $id);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'avatar' => 'nullable|image|max:2000',
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('customers')->ignore($id)
            ],
            'email' => 'required|email|max:100',
            'is_active' => ['nullable', Rule::in([0, 1])],
        ]);
        // Logic

        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(
                ['message' => 'Không tồn tại ban ghi có ID =' . $id],
                404
            );
        }
        try {

            // $data['is_active'] = isset($data['is_active']) ? $data['is_active'] : 0;
            //  $data['is_active'] = ($data['is_active']) ??  0;
            $data['is_active'] ??= 0;

            // Hoặc isset($data['avatar'])
            if ($request->hasFile('avatar')) {
                $data['avatar'] = Storage::put('customers', $request->file('avatar'));
            }

            $currentAvatar = $customer->avatar; // Lưu lại giá trị hiện tại của bản ghi 

            $customer->update($data);
            // Sau khi update nếu lỗi, xóa ảnh
            if (
                $request->hasFile('avatar') // có upload
                && !empty($currentAvatar)  // có giá trị 
                && Storage::exists($currentAvatar) // file có tồn tại 
            ) {
                Storage::delete($currentAvatar); //xóa
            }
            return response()->json($customer);


        } catch (\Throwable $th) {
            // trong catch lưu log 
            Log::error(
                __CLASS__ . '@' . __FUNCTION__,
                ['error' => $th->getMessage()]
            );
            return response()->json([
                'message' => 'Lỗi hệ thống'
            ], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::destroy($id);
        return response()->json([], 204);
    }

    public function forceDestroy(string $id)
    {
        // Lấy ra xong xóa
        $customer = Customer::find($id);
        if ($customer) {
            $customer->forceDelete();
            return response()->json($customer);
        } else {
            return response()->json(
                ['message' => 'Không tồn tại ban ghi có ID =' . $id],
                404
            );
        }

    }
}
