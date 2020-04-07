<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
  <!-- Default panel contents -->
  <div class="panel-heading">Mis Asistencias</div>
  <div class="panel-body">
  </div>
  <!-- Table -->
  <table class="table table-bordered table-hover tablaServicio">
    <thead style="background-color:">
        <th>Nombre</th>
        <th>folio</th>
        <th>fecha</th>
        <th>Mi aporte</th>
        <?php foreach($query->result() as $row){?>
            <tr>
                <td><?=$row->usuario_nombre.' '.$row->usuario_apellidop?></td>
                <td><?=$row->folio?></td>
                <td><?=$row->fecha_asistencia?></td>
                <td><?=$row->aporte?></td>
            </tr>
        <?php } ?>
    </thead>
  </table>
</div>
</div>
