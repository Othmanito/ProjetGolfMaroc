<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  {{ csrf_field() }}


	       <table class="table table-bordered table-hover table-striped" id="dataTables-example">

           <thead>
             <tr><th width="2%"> # </th><th width="25%">Article</th><th>Prix (HT)</th><th>Prix (TTC)</th><th width="10%">Autres</th></tr>
           </thead>

           <tbody>
             @if ( isset( $articles ) )
             @if( $articles->isEmpty() )
             <tr><td colspan="5" align="center">Aucun Article</td></tr>
             @else
             @foreach( $articles as $item )
             <tr class="odd gradeA" align="center">
               <td>{{ $loop->index+1 }}</td>
               <td>{{ $item->designation_c }}</td>

               <td>{{ $item->prix }}</td>
               <td>{{ ($item->prix)*1.2 }}</td>
               <td>
                 <form role="form" method="post"  action="{{ Route('direct.submitAdd',['param' => 'stock']) }}" name="form{{ $loop->index+1 }}">

                   <input type="number" min="0" step="1" name="quantite" placeholder="Quantite">

                 </form>
               </td>
             </tr>
             @endforeach
             @endif
             @endif
           </tbody>

           </table>
           <input type="submit" >


<hr>



<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>

<hr>


  <a href="#" title="Header" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Some content" >Hover over me</a>


<hr>

<div class="container">
  <h3>Popover Example</h3>
  <ul class="list-inline">
    <li><a href="#" title="Header left"   data-toggle="popover" data-placement="left" data-content="Content Left">Left</a></li>
    <li><a href="#" title="Header Top"    data-toggle="popover" data-placement="top" data-content="Content Top">Top</a></li>
    <li><a href="#" title="Header Bottom" data-toggle="popover" data-placement="bottom" data-content="Content Bottom">Bottom</a></li>
    <li><a href="#" title="Header Right"  data-toggle="popover" data-placement="right" data-content="ContentRight">Right</a></li>
  </ul>
</div>

<hr>

<script>

</script>


<script src="{{  asset('js/jquery.js') }}"></script>
<script src="{{  asset('js/bootstrap.js') }}"></script>

<script src="{{  asset('table/jquery.dataTables.js') }}"></script>
<script src="{{  asset('table/dataTables.bootstrap.js') }}"></script>
