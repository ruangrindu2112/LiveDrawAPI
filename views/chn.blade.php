<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="5" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color chn draw-periode" colspan="5">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2)
    <td class="box-color chn" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value chn-number prize{{ $key+1 }}" colspan="3">{{ $value['value'] }}</td>
      </tr>

      @endif

      @endforeach


      <tr>
        <td class="box-color chn " colspan="5">Starter Prize</td>
      </tr>


      <tr>
        @foreach ($result->data[3]['data'] as $key => $value)
        <td class="box-value starter-number">{{ $value }}</td>
        @endforeach
      </tr>

      <tr>
        <td colspan="5" class="img-livedraw"><img id="img20" title="Live Draw Togel CHN Tercepat serta terlengkap"
            alt="Live Draw Togel CHN Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-qQr3QVAZ93c/XrmMx8gAYCI/AAAAAAAAKc4/Xuiv2hRW_osL3xdYUkJN6LgZMlxk7sluwCLcBGAsYHQ/s1600/china.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color chn " colspan="5">Consolation Prize</td>
      </tr>

      <tr>
        @foreach ($result->data[4]['data'] as $key =>$value)

        <td class="box-value consol-number">{{ $value }}</td>

        @endforeach
      </tr>



      {{-- <tr>
        <td class="box-color hk" colspan="4">
        </td>
      </tr> --}}
  </tbody>
</table>

{{-- {{ print_r($result) }} --}}
