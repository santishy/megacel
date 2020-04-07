<div class="col-md-12">
    <div class="text-center">
        <?=$paginacion?>
    </div>
    <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">Rendimiento de técnicos</div>
      <div class="panel-body">
          <div class="col-md-4">
              <h3>Corte por fechas</h3>
              <hr>
              <form action="<?=base_url()?>usuarios/redirectRendimiento" method="post">
                  <div class="form-group">
                      <button class="btn btn-default btn-block" style="color:blue;border:2px solid #00cccc">Obtener Rendimiento</button>
                  </div>
                  <hr>
                  <div class="form-group">
                      <label>Escoger Usuario</label>
                      <select class="form-control" name="usuario" style="color:#ff3333">
                          <?php foreach($usuarios->result() as $row){?>
                              <option value="<?=$row->iduser?>"
                                  <?php if($row->iduser==$this->session->userdata('usuario')) echo 'selected';?>>
                                    <?=$row->usuario_nombre.' '.$row->usuario_apellidop?>
                                </option>
                          <?php }?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>
                      <input type="radio" name="status" value="Terminado">
                      Terminados
                    </label>
                    <label>
                      <input type="radio" name="status" value="Entregado">
                      Entregados
                    </label>
                  </div>
                  <div class="form-group">
                    <label style="color:#009999;text-decoration:underline;">
                      <input type="radio" name="status" value="total">
                      Resultado General de los servicios entregados
                    </label>
                  </div>
                  <div class="form-group">
                      <label>De:</label>
                      <input name="inicio"  id="de" class="form-control" value="">
                  </div>
                  <div class="form-group">
                      <label>Hasta:</label>
                      <input name="fin" id="hasta"class="form-control" value="">
                  </div>

              </form>
          </div>
          <div class="col-md-8 caja-flex">
            <table class="table table-striped tabla-centrada">
            <thead>
              <th>Total</th>
              <th>Material</th>
              <th>Nom. Servicios</th>
              <th>Soporte R.</th>
              <th>Aporte D.</th>
              <th>Estado</th>
              <th>Rango</th>
            </thead>
            <tbody>
              <tr>
                <td>$<?=$total?></td>
                <td>$<?=$total_ref+$total_material?></td>
                <td><?=$numerosoporte?></td>
                <td><?=$asistencias?></td>
                <td><?=$asistencias?></td>
                <td><?=$this->session->userdata('status')?></td>
                <td><?=$inicio?> / <?=$fin?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-md-8">
        <hr>
        <h4 style="text-align:center;padding-top:2em;"><a href="<?=base_url()?>usuarios/asistencias"> Ver mis aportes</a></h4>  
        </div>
        
      </div>
    </div>
    <!-- Table -->
      <h3>Servicios a Equipos</h3>
      <table class="table table-hover table-striped tabla-centrada">
        <thead>
            <th>Nombre</th>
            <th>folio</th>
            <th>fecha</th>
            <th>Solución</th>
            <th>Soporte</th>
            <th>Refaccion</th>
            <th>Mano de obra</th>
            <th>total</th>
          </thead>
            <?php foreach($query->result() as $row){?>
                <tr>
                    <td><?=$row->usuario_nombre.' '.$row->usuario_apellidop?></td>
                    <td><?=$row->folio?></td>
                    <td><?=$row->fecha?></td>
                    <td><?=$row->solucion?></td>
                    <td><?=$row->soporte?></td>
                    <td><?=$row->refaccion?></td>
                    <td><?=$row->mano_obra?></td>
                    <td><?=$row->total?></td>
                </tr>
            <?php } ?>
        
      </table>
      <hr>
        <div class="text-center">
            <?=$paginacion?>
        </div>
</div>
