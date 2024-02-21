<?php
namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Cores\BaseService;
use App\Services\Cores\ErrorService;
use App\Http\Requests\ProductRequest;

class ProductService extends BaseService
{
      private function generate_query_get(Request $request)
      {
            $column_search = ["products.product_name", "products.product_code",  "products.product_price_capital", "products.product_price_sell"];
            $column_order = [NULL, "products.product_name", "products.product_code",  "products.product_price_capital", "products.product_price_sell"];
            $order = ["products.id" => "DESC"];

            $results = Product::query()
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

      public function store(ProductRequest $request)
      {
            try {
                  $values = $request->validated();
                  $product = Product::create($values);
                  $response = \response_success_default("Berhasil menambahkan produk!", $product->id, route("app.products.show", $product->id));
            } catch (\Exception $e) {
                  ErrorService::error($e, "Gagal store user!");
                  $response = \response_errors_default();
            }

            return $response;
      }

      public function update(ProductRequest $request, Product $product)
      {
            try {
                  $product_id = $product->id;
                  $values = $request->validated();
                  
                  $product->update($values);
            
                  $response = \response_success_default("Berhasil update data product!", $product_id, route("app.products.show", $product->id));
                } catch (\Exception $e) {
                  ErrorService::error($e, "Gagal update product!");
                  $response = \response_errors_default();
                }
            
                return $response;
      }
}