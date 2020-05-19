<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="5" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color qtr draw-periode" colspan="5">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2) <td class="box-color qtr" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value  prize{{ $key+1 }}" colspan="3">{{ $value['data'] }}</td>
      </tr>

      @endif

      @endforeach


      {{-- <tr>
        <td class="box-color qtr starter-qtr" colspan="5">Starter Prize</td>
      </tr> --}}


      {{-- <tr>
        @foreach ($result->data[3]['data'] as $key => $value)
        <td class="box-value starter-number" colspan="1">{{ $value }}</td>
      @endforeach
      </tr> --}}

      <tr>
        <td colspan="5" class="img-livedraw"><img id="img20" title="Live Draw Togel qtr Tercepat serta terlengkap"
            alt="Live Draw Togel qtr Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-I0gYYg-PuqY/Xr6lqWdVptI/AAAAAAAAKhc/gOhQLdPO6V8xFTCzfkXcDhPK3TOrdLYiwCLcBGAsYHQ/s1600/qatar.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color qtr consol-qtr" colspan="5">Consolation Prize</td>
      </tr>

      @foreach (array_chunk($result->data[3]['data'],5) as $chunk)
      <tr>

        @foreach ($chunk as $item)
        <td class="box-value consol-number" colspan="1">{{ $item }}</td>

        @endforeach
      </tr>

      @endforeach



      {{-- <tr>
        <td class="box-color qtr" colspan="4">
        </td>
      </tr> --}}
  </tbody>
</table>

{{-- {{ print_r($result) }} --}}
