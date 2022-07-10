<div class="card mb-3 border-0">
  <div class="card-body">
    <table class="table table-bordered mb-0 text-center align-middle">
      <tr>
        <th>租客姓名</th>
        <th>所属公寓</th>
        <th>联系电话</th>
        <th>租赁周期</th>
        <th>操作</th>
      </tr>
      <tr>
        <td>{{ $roomCustomer->name .'('. $roomCustomer->room->name . ')' }}</td>
        <td>{{ $roomCustomer->project->name }}</td>
        <td>{{ $roomCustomer->mobile_phone_number }}</td>
        <td>{{ date('Y-m-d', $roomCustomer->begin_date) }} ~ {{ date('Y-m-d', $roomCustomer->end_date) }}</td>
        <td>
          <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-primary btn-sm" type="button">修改</button>
            <button class="btn btn-primary btn-sm" type="button">删除</button>
            <button class="btn btn-primary btn-sm" type="button">续租</button>
            <button class="btn btn-primary btn-sm" type="button">换房</button>
            <button class="btn btn-primary btn-sm" type="button">退房</button>
          </div>
        </td>
      </tr>
    </table>
  </div>
</div>
