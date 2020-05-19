<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="5" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color sgm draw-periode" colspan="5">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2) <td class="box-color sgm" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value sgm-number prize{{ $key+1 }}" colspan="3">{{ $value['data'] }}</td>
      </tr>

      @endif

      @endforeach


      <tr>
        <td class="box-color sgm starter-sgm" colspan="5">Starter Prize</td>
      </tr>


      @foreach (array_chunk($result->data[3]['data'],5) as $chunk)
      <tr>
        @foreach ($chunk as $item)
        <td class="box-value starter-number">{{ $item }}</td>
        @endforeach


      </tr>
      @endforeach

      <tr>
        <td colspan="5" class="img-livedraw"><img id="img20" title="Live Draw Togel sgm Tercepat serta terlengkap"
            alt="Live Draw Togel sgm Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-SyQ6PME5R2o/Xr6lnhIThzI/AAAAAAAAKhQ/YgbnPZIsDzE0GSocD8OOewYB5M25A81KgCLcBGAsYHQ/s1600/1sgmetro.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color sgm" colspan="5">Consolation Prize</td>
      </tr>

      @foreach (array_chunk($result->data[4]['data'],5) as $chunk)
      <tr>
        @foreach ($chunk as $item)
        <td class="box-value consol-number">{{ $item }}</td>
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
