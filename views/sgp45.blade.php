{{-- {{ print_r($result) }} --}}


<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="4" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color sgp45 draw-periode" colspan="4">{{ $result->periode }}</td>
    </tr>


    <tr>
      <td class="box-color sgp45" colspan="4">WINNING NUMBER</td>
    </tr>
    <tr>
      @for ($i = 0; $i < 4; $i++) <td class="box-value sgp45number">
        <span class="number">{{ $result->data[$i] }}</span>
        </td>
        @endfor


    </tr>
    <tr>
      @for ($i = 4; $i < 6; $i++) <td colspan="2" class="box-value sgp45number">
        <span class="number"> {{ $result->data[$i] }}</span>
        </td>
        @endfor

    </tr>
    <tr>
      <td colspan="4" class="img-livedraw"><img id="img20" title="Live Draw Togel Singapore45 Tercepat serta terlengkap"
          alt="Live Draw Togel Singapore45 Tercepat serta terlengkap"
          src="https://1.bp.blogspot.com/-nWrzLScwPmg/Xrl79AniaFI/AAAAAAAAKa4/UK1oES0tg38zGNGVAvw37zaalG8jDaoBACLcBGAsYHQ/s200/SG45.jpg">
      </td>
    </tr>
    <tr>
      <td class="box-color sgp45" colspan="4">Additional Number</td>
    </tr>
    <tr>
      <td class="box-value sgp45number" colspan="4"> {{ $result->data[6] }}</td>
    </tr>
  </tbody>
</table>
