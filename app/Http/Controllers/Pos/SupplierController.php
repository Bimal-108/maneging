<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    public function SupplierAll(){
//        $suppliers = Supplier::all();
        $suppliers = Supplier::latest()->get();
        return view('backend.supplier.supplier_all', compact('suppliers'));
    }

    public function SupplierAdd(){
        return view('backend.supplier.supplier_add');
    }
    public function SupplierStore(Request $request){
        Supplier::insert([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Supplier Insert Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('supplier.all')->with($notification);
    }

    public function SupplierEdit($id){
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.supplier_edit', compact('supplier'));
    }

    public function SupplierUpdate(Request $request){
        $supplier_id = $request->id;

        Supplier::findOrFail($supplier_id)->update([
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'updated_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Supplier Update Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function SupplierDelete($id){
        Supplier::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('supplier.all')->with($notification);
    }
}
