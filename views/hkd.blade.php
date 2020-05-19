<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="4" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color hkd draw-periode" colspan="4">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2) <td class="box-color hkd" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value  prize{{ $key+1 }}" colspan="2">{{ trim($value['value']) }}</td>
      </tr>

      @endif

      @endforeach


      <tr>
        <td class="box-color hkd starter-hkd" colspan="4" style="text-align: center">Starter Prize</td>
      </tr>


      <tr>
        @foreach ($result->data[3]['value'] as $key => $value)
        <td class="box-value starter-number" colspan="1">{{ $value }}</td>
        @endforeach
      </tr>

      <tr>
        <td colspan="4" class="img-livedraw"><img id="img20" title="Live Draw Togel hkd Tercepat serta terlengkap"
            alt="Live Draw Togel hkd Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-EOl0orJIoCQ/Xr6loHh8qVI/AAAAAAAAKhU/YTGGEGfhlXgklRKA5238u4QvSoC9iO0KgCLcBGAsYHQ/s1600/HK%2BSiang.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color hkd consol-hkd" colspan="4" style="text-align: center">Consolation Prize</td>
      </tr>

      @foreach (array_chunk($result->data[4]['value'],4) as $chunk)
      <tr>

        @foreach ($chunk as $item)
        <td class="box-value consol-number" colspan="1">{{ $item }}</td>

        @endforeach
      </tr>

      @endforeach



      {{-- <tr>
        <td class="box-color hkd" colspan="4">
        </td>
      </tr> --}}
  </tbody>
</table>

{{-- {{ print_r($result) }} --}}
