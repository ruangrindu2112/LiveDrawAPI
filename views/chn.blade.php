<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="5" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color chn" colspan="5">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2) <td class="box-color chn" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value twnumber" colspan="3"><a>{{ $value['value'] }}</a></td>
      </tr>

      @endif

      @endforeach


      <tr>
        <td class="box-color chn " colspan="5">Starter Prize</td>
      </tr>


      <tr>
        @foreach ($result->data[3]['data'] as $key => $value)
        <td class="box-value chn-number">{{ $value }}</td>
        @endforeach
      </tr>

      <tr>
        <td colspan="5" class="img-livedraw"><img id="img20" title="Live Draw Togel CHN Tercepat serta terlengkap"
            alt="Live Draw Togel CHN Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-1TbfZ-02xnw/XrmLiLVmYXI/AAAAAAAAKcs/Kj3t7XUMHTYtM1v781rUpc_-Ewp3iXvDACLcBGAsYHQ/s1600/china.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color chn " colspan="5">Consolation Prize</td>
      </tr>

      <tr>
        @foreach ($result->data[4]['data'] as $key =>$value)

        <td class="box-value chn-number">{{ $value }}</td>

        @endforeach
      </tr>



      {{-- <tr>
        <td class="box-color hk" colspan="4">
        </td>
      </tr> --}}
  </tbody>
</table>

{{-- {{ print_r($result) }} --}}
