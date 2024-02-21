<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

     /**
   * Get list Transactions
   *
   * @param Request $request
   */
  public function get(Request $request)
  {
    $transactions = $this->transactionService->get_list_paged($request);
    $count = $this->transactionService->get_list_count($request);

    $data = [];
    $no = $request->start;

    foreach ($transactions as $transaction) {
      $no++;
      $row = [];
      $row[] = $no;
      $row[] = $transaction->created_at->format('d M Y');
      $row[] = $transaction->nama_barang;
      $row[] = $transaction->jlh_barang;
      $row[] = 'Rp ' . number_format($transaction->total_harga, 0, ',', '.');
      $button = "<a href='" . \route("app.transactions.show", $transaction->id) . "' class='btn btn-info btn-sm m-1'>Detail</a>";
      $button .= form_delete("formtransaction$transaction->id", route("app.transactions.destroy", $transaction->id));
      $row[] = $button;
      $data[] = $row;
    }

    $output = [
      "draw" => $request->draw,
      "recordsTotal" => $count,
      "recordsFiltered" => $count,
      "data" => $data
    ];

    return \response()->json($output, 200);
  }

    private TransactionService $transactionService;

    public function __construct()
    {
        $this->transactionService = new TransactionService;
    }

    /**
     * Get Detail Transaction Data
     */
    public function detail_trans(Request $request)
    {
        $product = null;
        if ($request->product_code) {
            $product = Product::where('product_code', $request->product_code)->first();
        }

        return response()->json([
            'product' => $product ?? []
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->view_admin('admin.transactions.index', 'List of Transactions', [], TRUE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view_admin('admin.transactions.create', 'Create new Transaction', []);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $response = $this->transactionService->store($request);
        return \response_json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        $data = [
            'transaction' => $transaction
        ];
        return $this->view_admin('admin.transactions.show', 'Detail of Transaction', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        $response = \response_success_default("Berhasil hapus transaksi!", FALSE, \route("app.transactions.index"));
        return \response_json($response);
    }
}
