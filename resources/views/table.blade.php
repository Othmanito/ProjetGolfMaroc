
<style src="{{  asset('table2/datatables.min.css') }}"></style>
<script src="{{  asset('table2/datatables.min.js') }}"></script>




<script type="text/javascript" charset="utf-8">

$(document).ready(function() {
// Setup - add a text input to each footer cell
$('#example tfoot th').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" class="form-control" placeholder="Rechercher par '+title+'" />' );
} );

// DataTable
var table = $('#example').DataTable();

// Apply the search
table.columns().every( function () {
    var that = this;
    $( 'input', this.footer() ).on( 'keyup change', function ()
    {if ( that.search() !== this.value ){that.search( this.value ).draw();}});
});
} );
</script>





<div class="table-responsive">
    <div class="col-lg-12">

        <table id="example" class="display" cellspacing="0" width="100%">

          <thead>
              <tr>
                  <th> # </th>
                  <th> Categorie </th>
                  <th>Description</th>
                  <th>Autres</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                  <th> # </th>
                  <th> Categorie </th>
                  <th>Description</th>
                  <th>Autres</th>
              </tr>
          </tfoot>

            <tbody>
                @if ( isset( $data ) )
                  @if( $data->isEmpty() )
                <tr>
                    <td colspan="4" align="center">Aucune Marque</td>
                </tr>
                @else
                  @foreach( $data as $item )
                  <tr>
                      <td>{{ $loop->index+1 }}</td>
                      <td>{{ $item->libelle }}</td>
                      <td>{{ $item->description }}</td>
                      <td>
                          <a href="{{ Route('direct.info',['p-table'=> 'categories', 'p_id'=> $item->id_categorie ]) }}" title="info sur la categorie"><i class="glyphicon glyphicon-eye-open"></i></a>
                          <a href="{{ Route('direct.updateForm',['p-table'=> 'categories', 'p_id'=> $item->id_categorie ]) }}" title="modifier la categorie"><i class="glyphicon glyphicon-pencil"></i></a>
                          <a onclick="return confirm('Êtes-vous sure de vouloir effacer la Categorie: {{ $item->libelle }} ?')" href="{{ Route('direct.delete',['p_table' => 'categories' , 'p_id' => $item->id_categorie ]) }}" title="effacer la categorie"><i class="glyphicon glyphicon-trash"></i></a>
                      </td>
                  </tr>

                @endforeach @endif @endif
            </tbody>
        </table>


    </div>
</div>



<script type="text/javascript">
    // For demo to fit into DataTables site builder...
    $('#example').removeClass('display').addClass('table table-striped table-bordered');
</script>
