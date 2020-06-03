@if($data->price != $data->discount_price())
<td class="text-center align-middle"><del><strong>${{$data->price}}</strong></del>
    <strong class="cl-green pl-2">${{number_format($data->discount_price(), 2, '.', '')}}</strong></td>
@else
<td class="text-center align-middle"><strong>${{$data->price}}</strong></td>
@endif