{{-- <table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="4" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color tw" colspan="4">{{ $result->periode }}</td>
</tr>


@foreach ($result->data as $key => $value)

<tr>
  <td class="box-color tw" colspan="2">{{ $value['type'] }}</td>
  <td class="box-value twnumber" colspan="2"><a>{{ $value['value'] }}</a></td>
</tr>

@endforeach





{{-- <tr>
        <td colspan="4" class="img-livedraw"><img id="img20" title="Live Draw Togel HK Tercepat serta terlengkap"
            alt="Live Draw Togel HK Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-2Di_UzrZrOo/Xn4xevxDnMI/AAAAAAAAAxc/2SYE2fXvVfIDUwsUUfhHwCgiRrR0Q0F_ACLcBGAsYHQ/s1600/logo-hongkong-pools.jpg">
        </td>
      </tr> --}}

{{-- <tr>
      <td class="box-color tw" colspan="4">
      </td>
    </tr>
  </tbody>
</table> --}}

<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="5" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color tw" colspan="5">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2) <td class="box-color tw" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value twnumber" colspan="3"><a>{{ $value['data'] }}</a></td>
      </tr>

      @endif

      @endforeach


      <tr>
        <td class="box-color tw starter-tw" colspan="5">Starter Prize</td>
      </tr>


      <tr>

        <td class="box-value tw-number" colspan="5">{{ $result->data[3]['data']  }}</td>

      </tr>

      <tr>
        <td colspan="5" class="img-livedraw"><img id="img20" title="Live Draw Togel Taiwan Tercepat serta terlengkap"
            alt="Live Draw Togel Taiwan Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-VLBZO29CZkQ/XrmW_qMqPzI/AAAAAAAAKdc/IQBKRZu3JGcIz8k9Axn3PczfuDGkezDcgCLcBGAsYHQ/s1600/Taiwan.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color tw consol-tw" colspan="5">Consolation Prize</td>
      </tr>

      <tr>


        <td class="box-value tw-number" colspan="5">{{ $result->data[4]['data'] }}</td>


      </tr>



      {{-- <tr>
        <td class="box-color hk" colspan="4">
        </td>
      </tr> --}}
  </tbody>
</table>

{{-- {{ print_r($result) }} --}}
