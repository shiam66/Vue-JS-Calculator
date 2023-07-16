<?php

namespace App\Http\Controllers\Admin;

use App\Courier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourierController extends Controller
{
    public function createCourier(Request $request){
        $this->validate($request,[
            'courierName'=>'required',
            'courierPhone'=>'required',
        ]);

        $courier = new Courier();
        $courier->courierName = $request->courierName;
        $courier->courierBranch = $request->courierBranch;
        $courier->courierAddress = $request->courierAddress;
        $courier->courierPhone = $request->courierPhone;
        $courier->courierEmail = $request->courierEmail;
        $courier->status = $request->status;
        $courier->save();

        return redirect('/so-admin/courier')->with('message','Courier info Save Successfully');
    }

    public function manageCourier(){
        $couriers = Courier::all();
        return view ('admin.orders.courier.addCourier', ['couriers'=>$couriers]);
    }

    public function editCourier($id){
        $courierById = Courier::where('id',$id)->first();
        return view('admin.orders.courier.editCourier', ['courierById'=>$courierById]);
    }

    public function updateCourier(Request $request){

        $courier = Courier::find($request->courierId);

        $courier->courierName = $request->courierName;
        $courier->courierBranch = $request->courierBranch;
        $courier->courierAddress = $request->courierAddress;
        $courier->courierPhone = $request->courierPhone;
        $courier->courierEmail = $request->courierEmail;
        $courier->status = $request->status;
        $courier->save();

        return redirect('/so-admin/courier')->with('updateMessage','Courier info Update Successfully');
    }

    public function deleteCourier($id){
        $courier = Courier::find($id);
        $courier->delete();
        return redirect('/so-admin/courier')->with('deleteMessage','Courier info Delete Successfully');
    }
}
