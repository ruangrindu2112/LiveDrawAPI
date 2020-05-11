<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="5" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color cam" colspan="5">{{ $result->periode }}</td>
    </tr>


    @php
    $x = 1;
    @endphp
    @foreach ($result->data as $key => $value)

    @if ($key<=2 && $value!==null) <tr>
      <td class="box-color cam" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value cam-number" colspan="3"><a>{{ $value['value'] }}</a></td>
      </tr>

      @else
      <tr>
        <td class="box-color cam-number" colspan="5">{{ $value['type'] }}</td>


      </tr>
      <tr>
        @foreach ($value['value'] as $item)

        <td colspan="1" class="box-value camnumber">{{ $item }}</td>

        @endforeach
      </tr>
      @if ($x ==1)
      <td colspan="5" class="img-livedraw"><img id="img20" title="Live Draw Togel Cambodia Tercepat serta terlengkap"
          alt="Live Draw Togel Cambodia Tercepat serta terlengkap"
          src="https://1.bp.blogspot.com/--l74dDqar-o/Xrl-EUffxqI/AAAAAAAAKbE/2udb3JhFuWIOXQbFJNANluTiLjsluRHYACLcBGAsYHQ/s400/Cambodia.jpg">
      </td>
      @php
      $x++;
      @endphp
      @endif


      @endif


      @endforeach





      {{-- <tr>
        <td colspan="4" class="img-livedraw"><img id="img20" title="Live Draw Togel HK Tercepat serta terlengkap"
            alt="Live Draw Togel HK Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-2Di_UzrZrOo/Xn4xevxDnMI/AAAAAAAAAxc/2SYE2fXvVfIDUwsUUfhHwCgiRrR0Q0F_ACLcBGAsYHQ/s1600/logo-hongkong-pools.jpg">
        </td>
      </tr> --}}

      {{-- <tr>
      <td class="box-color cam" colspan="4">
      </td>
    </tr> --}}
  </tbody>
</table>

{{-- {{ var_dump($result) }} --}}
