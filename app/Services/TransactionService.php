<?php
namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\Cores\BaseService;
use App\Services\Cores\ErrorService;
use App\Http\Requests\TransactionRequest;

class TransactionService extends BaseService
{
    private function generate_query_get(Request $request)
    {
        $column_search = ["transactions.created_at", "transactions.nama_barang", "transactions.jlh_barang", "transactions.total_harga", "transactions.product_code"];
        $column_order = [NULL, "transactions.created_at" , "transactions.nama_barang", "transactions.jlh_barang", "transactions.total_harga"];
        $order = ["transactions.id" => "DESC"];

        $results = Transaction::query()
            ->where(function ($query) use ($request, $column_search) {
                $i = 1;
                if (isset($request->search)) {
                    foreach ($column_search as $column) {
                        if ($request->search["value"]) {
                            if ($i == 1) {
                                $query->where($column, "LIKE", "%{$request->search["value"]}%");
                            } else {
                                $query->orWhere($column, "LIKE", "%{$request->search["value"]}%");
                            }
                        }
                        $i++;
                    }
                }
            });

        if (isset($request->order) && !empty($request->order)) {
            $results = $results->orderBy($column_order[$request->order["0"]["column"]], $request->order["0"]["dir"]);
        } else {
            $results = $results->orderBy(key($order), $order[key($order)]);
        }

        return $results;
    }

    public function get_list_paged(Request $request)
    {
        $results = $this->generate_query_get($request);
        if ($request->length != -1) {
            $limit = $results->offset($request->start)->limit($request->length);
            return $limit->get();
        }
    }

    public function get_list_count(Request $request)
    {
        return $this->generate_query_get($request)->count();
    }

    public function store(TransactionRequest $request)
    {
        try {
            $values = $request->validated();
            $transaction = Transaction::create($values);
            $response = \response_success_default("Berhasil melakukan transaksi!", $transaction->id, route("app.transactions.show", $transaction->id));
        } catch (\Exception $e) {
            ErrorService::error($e, "Gagal store user!");
            $response = \response_errors_default();
        }

        return $response;
    }
}