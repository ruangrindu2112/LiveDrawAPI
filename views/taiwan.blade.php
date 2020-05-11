<table class="livedraw-table">
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
    </tr> --}}
  </tbody>
</table>
