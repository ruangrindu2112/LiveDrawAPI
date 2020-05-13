<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="5" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color tw draw-periode" colspan="5">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2) <td class="box-color tw" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value twnumber prize{{ $key+1 }}" colspan="3">{{ $value['data'] }}</td>
      </tr>

      @endif

      @endforeach


      <tr>
        <td class="box-color tw starter-tw" colspan="5">{{ $result->data[3]['type']  }}</td>
      </tr>


      <tr>

        <td class="box-value starter-number" colspan="5">{{ $result->data[3]['data']  }}</td>

      </tr>

      <tr>
        <td colspan="5" class="img-livedraw"><img id="img20" title="Live Draw Togel Taiwan Tercepat serta terlengkap"
            alt="Live Draw Togel Taiwan Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-VLBZO29CZkQ/XrmW_qMqPzI/AAAAAAAAKdc/IQBKRZu3JGcIz8k9Axn3PczfuDGkezDcgCLcBGAsYHQ/s1600/Taiwan.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color tw consol-tw" colspan="5">{{ $result->data[4]['type'] }}</td>
      </tr>

      <tr>


        <td class="box-value consol-number" colspan="5">{{ $result->data[4]['data'] }}</td>


      </tr>



      {{-- <tr>
        <td class="box-color hk" colspan="4">
        </td>
      </tr> --}}
  </tbody>
</table>

{{-- {{ print_r($result) }} --}}
