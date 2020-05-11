<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="4" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color hk" colspan="4">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2) <td class="box-color tw" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value twnumber" colspan="3"><a>{{ $value['value'] }}</a></td>
      </tr>

      @endif

      @endforeach


      <tr>
        <td class="box-color hk starter-hk" colspan="4">Starter Prize</td>
      </tr>


      <tr>
        @foreach ($result->data[3]['value'] as $key => $value)
        <td class="box-value">{{ $value }}</td>
        @endforeach
      </tr>

      <tr>
        <td colspan="4" class="img-livedraw"><img id="img20" title="Live Draw Togel HK Tercepat serta terlengkap"
            alt="Live Draw Togel HK Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-5TWehTOBeN4/Xrl_UHnUlCI/AAAAAAAAKbY/F3rYEr_t82sXkwaBYb0avzqUDwVzb5rnQCLcBGAsYHQ/s320/Hongkong.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color hk consol-hk" colspan="4">Consolation Prize</td>
      </tr>

      @foreach (array_chunk($result->data[4]['value'],4) as $chunk)
      <tr>




        @foreach ($chunk as $item)
        <td class="box-value">{{ $item }}</td>

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
