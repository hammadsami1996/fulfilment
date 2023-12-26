<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Courier;
use App\Models\Customer;
use App\Models\Finance_transaction;
use App\Models\Finance_transaction_master;
use App\Models\Order;
use App\Models\Purchase;
use App\Models\Status;
use App\Models\StatusLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Status::where('head', request('head'))->where('id', '!=', request('id'))->orderBy('id')->search();
        return response()->json(['data' => $results]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Status $status)
    {
        //
    }

    public function updatestatus(Request $request)
    {
        $data = Order::findOrFail($request->ids);
        $logs = new StatusLog();

        $logs->order_id = $request->ids;
        $logs->updated_sts = $request->name;
        $logs->previous_sts = $data->status_id;
        $logs->user_id = auth()->user()->id;
        $logs->date = Carbon::now();
        $logs->save();

        $data->status_id = $request->id;
        $data->save();
        return response()->json(["saved" => true, "id" => $data->id]);
    }

    public function updated_status(Request $request)
    {
        $data = Purchase::where('id', $request->ids)->first();
        $data->status_id = $request->id;
        $data->save();
        return response()->json(["saved" => true, "id" => $data->id]);
    }

    public function searches()
    {
        $id = request('id');
        $head = request('head');

        $headId = Status::where('id', $id)->value('head_id');
        $headIdArray = explode(',', $headId);

        $results = Status::where('head', $head)
            ->where('id', '!=', $id)
            ->whereIn('id', $headIdArray)
            ->orderBy('id')
            ->get();  // Assuming you want to fetch results, not using a non-standard 'search' method

        return response()->json(['data' => $results]);
    }
    public function bulk_status(Request $request)
    {
        $recentFinanceTransactionId = 0;
        $selectedItems = $request->selectedItems; // An array of item IDs
        $statusData = $request->selectedstatus; // Status data to be applied to all items

        foreach ($selectedItems as $itemId) {
            // Create an array with the updated status data for the specific item
            $data = [
                'id' => $statusData['id'], // Use the item ID
                'name' => $statusData['name'],
                'created_at' => $statusData['created_at'],
                'update_at' => $statusData['update_at'],
                'color' => $statusData['color'],
                'head' => $statusData['head'],
                'head_id' => $statusData['head_id'],
                'text' => $statusData['text'],
                'ids' =>$itemId, // Include 'ids' if needed
            ];
            // Perform the updatestatus operation with the $data array
            $this->updatestatus(new Request($data));
        }
        $statusides = Status::where('sales_on','=',1)->first();
        $s_id = $statusides->id;
        $orders = Order::where('status_id', $s_id)->get();
    
    foreach ($orders as $order) {
        // Retrieve account details for the order
        $account = Account::find($order->account_id);
    
        // Check if a record with the same reference number already exists in Finance_transaction
        $existingFinanceMaster = Finance_transaction_master::where('reference_no', $order->id)->first();
    
        if (!$existingFinanceMaster) {
            $finanace_master = new Finance_transaction_master();
            $finanace_master->voucher_date = today();  
            $finanace_master->reference_no = $order->id;
            $finanace_master->voucher_type = "sale";
            $finanace_master->voucher_number = 'JV-' . mt_rand(100000, 999999);
            $finanace_master->debit = $order->total;
            $finanace_master->credit = $order->total;
            $finanace_master->detail_remarks = "sale order remarks";
            $finanace_master->save();
            $recentFinanceTransactionId = $finanace_master->id;
            $recentFinanceTransactionNumber = $finanace_master->voucher_number;
        }
            // Check if the account details are available
            if ($account) {
                // Check if a record with the same reference number already exists in Finance_transaction_master
                $existingFinance = Finance_transaction::where('reference_no', $order->id)->first();
    
                if (!$existingFinance) {
                    $finanace = new Finance_transaction();
                    $finanace->voucher_date = today();  
                    $finanace->reference_no = $order->id;
                    $finanace->voucher_type = "sale";
                    $finanace->debit = $order->total;
                    $finanace->credit = $order->total;
                    $finanace->voucher_number = $recentFinanceTransactionNumber;
                    $finanace->master_remarks = "sale order remarks";
                    $finanace->finance_transaction_master_id = $recentFinanceTransactionId;

                    // Save the account details in Finance_transaction_master
                    $finanace->account_id = $account->id;
                    $finanace->save();
                
                    // Retrieve courier details for the order
                    $customer = Customer::find($order->courier_id);
                    $accountes = $customer->account_id;
                    // $courier = Customer::where('is_courier','=', 1)->first();
                    if ($accountes) {
                        // Retrieve account details for the courier
                        $courierAccount = Account::find($accountes);
    
                        if ($courierAccount) {
                          
                            $finanace2 = new Finance_transaction();
                            $finanace2->voucher_date = today();  
                            $finanace2->reference_no = $order->id;
                            $finanace2->voucher_type = "sale";
                            $finanace2->debit = $order->total;
                            $finanace2->credit = $order->total;
                            $finanace2->voucher_number = $recentFinanceTransactionNumber;
                            $finanace2->master_remarks = "sale order remarks";
                            $finanace2->finance_transaction_master_id = $recentFinanceTransactionId;
                            $finanace2->account_id = $courierAccount->id;
                            $finanace2->account_title = $courierAccount->accounttitle;
                            $finanace2->save();
                        }
                    }  
            }

        }   
    }
        return response()->json(['response'=> true]);
    }

}
