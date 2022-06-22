<div class="card mb-3 border-0">
  <div class="card-body">
    <table class="table table-bordered mb-0 text-center">
      <tr>
        <th>租客姓名</th>
        <th>所属公寓</th>
        <th>联系电话</th>
        <th>租赁周期</th>
      </tr>
      <tr>
        <td>{{ $roomCustomer->name .'('. $roomCustomer->room->name . ')' }}</td>
        <td>{{ $roomCustomer->project->name }}</td>
        <td>{{ $roomCustomer->mobile_phone_number }}</td>
        <td>{{ date('Y-m-d', $roomCustomer->begin_date) }} ~ {{ date('Y-m-d', $roomCustomer->end_date) }}</td>
      </tr>
    </table>
  </div>
</div>
