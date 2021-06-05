<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Expense;

class ExpenseController extends Controller
{

    public function index()
    {
        $expense=Expense::orderBy('id','DESC')->get();
        return response()->json($expense);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
         'details' => 'required|max:255',
         'amount'=> 'required'
        ]);

           $expense = new Expense;
           $expense->details = $request->details;
           $expense->amount = $request->amount;
           $expense->expense_date = date('d/m/Y');
           $expense->save();
    }

    public function show($id)
    {
        $expense=Expense::findorfail($id);
         return response()->json($expense);
    }

    public function update(Request $request, $id)
    {
         $validatedData = $request->validate([
         'details' => 'required|max:255',
         'amount'=> 'required'
        ]);

        $data=array();
        $data['details']=$request->details;
        $data['amount']=$request->amount;
        DB::table('expenses')->where('id',$id)->update($data);
    }

    public function destroy($id)
    {
        DB::table('expenses')->where('id',$id)->delete();
    }
}
