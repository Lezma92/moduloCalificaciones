 <div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Agregar Calificación</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="">
          <input type="hidden" id="matricula" name="matricula" value="">
          <input type="hidden" id="id_tipopuntos" name="id_tipopuntos" value="">
          <input type="hidden" id="id_actividad" name="id_actividad" value="">
          <input type="hidden" id="id_puntos" name="id_puntos" value="">
          <input type="hidden" id="accion" name="accion" value="">
          <div class="form-group">
            <label for="txtPuntos">Puntos: </label>
            <input type="number" value="" name="txtPuntos" id="txtPuntos" class="form-control input-sm" required>
          </div>
          <div class="form-group">
            <label for="textDescripcion">Comentario: </label>
            <textarea class="form-control" id="textComentario" rows="3" name="description-repo" maxlength="180" minlength="10" required></textarea>
          </div>
        </div>
        <p id="mensaje" style="color: #FF0000" value=""></p>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning" data-dismiss="modal" id="guardarPuntos" >guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>