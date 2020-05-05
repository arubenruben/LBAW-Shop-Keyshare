@if($data->price != $data->discount_price())
    <td class="text-center align-middle"><del><strong>${{$data->price}}</strong></del></del><strong  class="cl-green pl-2">${{$data->discount_price()}}</strong></td>
@else
    <td class="text-center align-middle"><strong>${{$data->price}}</strong></td>
@endif