<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="6" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color my draw-periode" colspan="5">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2) <td class="box-color my" colspan="3">{{ $value['type'] }}</td>
      <td class="box-value my-number prize{{ $key+1 }}" colspan="3">{{ $value['data'] }}</td>
      </tr>

      @endif

      @endforeach


      <tr>
        <td class="box-color my starter-my" colspan="6" style="text-align: center">4th Prize</td>
      </tr>


      @foreach (array_chunk($result->data[3]['data'],3) as $chunk)
      <tr>
        @foreach ($chunk as $item)
        <td class="box-value starter-number" colspan="2">{{ $item }}</td>
        @endforeach


      </tr>
      @endforeach

      <tr>
        <td colspan="5" class="img-livedraw"><img id="img20" title="Live Draw Togel my Tercepat serta terlengkap"
            alt="Live Draw Togel my Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-zsTq7P6Wao4/Xr6lo3XS7yI/AAAAAAAAKhY/PAC4bQA5YjEyaNS1B_E9zucVdVOPItQ0ACLcBGAsYHQ/s1600/Malaysia.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color my" colspan="6" style="text-align: center">5th Prize</td>
      </tr>

      @foreach (array_chunk($result->data[4]['data'],3) as $chunk)
      <tr>
        @foreach ($chunk as $item)
        <td class="box-value consol-number" colspan="2">{{ $item }}</td>
        @endforeach


      </tr>
      @endforeach



      {{-- <tr>
        <td class="box-color hk" colspan="4">
        </td>
      </tr> --}}
  </tbody>
</table>

{{-- {{ print_r($result) }} --}}
