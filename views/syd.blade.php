<table class="livedraw-table">
  <tbody>
    <tr>
      <td colspan="5" class="img-livedraw"></td>
    </tr>
    <tr>
      <td class="box-color syd" colspan="5">{{ $result->periode }}</td>
    </tr>

    @foreach ($result->data as $key => $value )
    @if ($key<=2) <td class="box-color syd" colspan="2">{{ $value['type'] }}</td>
      <td class="box-value twnumber" colspan="3"><a>{{ $value['data'] }}</a></td>
      </tr>

      @endif

      @endforeach


      <tr>
        <td class="box-color syd starter-syd" colspan="5">Starter Prize</td>
      </tr>


      <tr>
        @foreach ($result->data[3]['data'] as $key => $value)
        <td class="box-value syd-number">{{ $value }}</td>
        @endforeach
      </tr>

      <tr>
        <td colspan="5" class="img-livedraw"><img id="img20" title="Live Draw Togel Sydney4d Tercepat serta terlengkap"
            alt="Live Draw Togel Sydney4d Tercepat serta terlengkap"
            src="https://1.bp.blogspot.com/-PP5HN5d7OGQ/XrmNsQYi2qI/AAAAAAAAKdE/rMWwZibeOc4QF96jHSEF4COw91pPBfROQCLcBGAsYHQ/s1600/sydney4d.jpg">
        </td>
      </tr>

      <tr>
        <td class="box-color syd consol-syd" colspan="5">Consolation Prize</td>
      </tr>

      <tr>
        @foreach ($result->data[4]['data'] as $key =>$value)

        <td class="box-value syd-number">{{ $value }}</td>

        @endforeach
      </tr>



      {{-- <tr>
        <td class="box-color hk" colspan="4">
        </td>
      </tr> --}}
  </tbody>
</table>

{{-- {{ print_r($result) }} --}}
