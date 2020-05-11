<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="5" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color mgn" colspan="5">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2) <td class="box-color mgn" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value twnumber" colspan="3"><a>{{ $value['data'] }}</a></td>
      </tr>

      @endif

      @endforeach


      <tr>
        <td class="box-color mgn starter-mgn" colspan="5">Special Prize</td>
      </tr>


      @foreach (array_chunk($result->data[3]['data'],5) as $item)
      <tr>
        @foreach ($item as $value)

        <td class="box-value mgn-number">{{ $value }}</td>
        @endforeach

      </tr>
      @endforeach

      <tr>
        <td colspan="5" class="img-livedraw"><img id="img20" title="Live Draw Togel mgnney4d Tercepat serta terlengkap"
            alt="Live Draw Togel mgnney4d Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-xHHJw66eZU4/XrmVB2w5u2I/AAAAAAAAKdQ/FQY8d8vJ5IYJ3_QRaVrJIWu7Pdg0YLotQCLcBGAsYHQ/s1600/Magnum4D.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color mgn consol-mgn" colspan="5">Consolation Prize</td>
      </tr>


      @foreach (array_chunk($result->data[4]['data'],5) as $item)
      <tr>
        @foreach ($item as $value)

        <td class="box-value mgn-number">{{ $value }}</td>
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
