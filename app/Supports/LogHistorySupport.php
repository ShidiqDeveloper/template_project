<?php namespace App\Supports;

      use App\Models\LogHistory;

class LogHistorySupport
{
  /**
   * For store log history
   *
   * @param string $action
   * @param string|array|null $old_data
   * @param string|array|null $new_data
   */
  public static function store($action, $old_data = null, $new_data = null)
  {
    $values = [
      "user_id" => auth()->user()->id,
      "user_name" => auth()->user()->name,
      "event" => $action,
      "url" => request()->fullUrl(),
      "payload" => json_encode(request()->all()),
    ];

    // If old data is array convert to json
    if (is_array($old_data)) {
      $values["old_data"] = json_encode($old_data);
    } else {
      $values["old_data"] = $old_data;
    }

    // If new data is array convert to json
    if (is_array($new_data)) {
      $values["new_data"] = json_encode($new_data);
    } else {
      $values["new_data"] = $new_data;
    }

    // Insert log history
    LogHistory::create($values);
  }
}
