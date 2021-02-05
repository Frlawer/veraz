<fieldset>
    <div class="form-group">
        <label for="nombre">Nombre *</label>
          <input type="text" name="cliente_nombre" value="<?php echo htmlspecialchars($edit ? $customer['cliente_nombre'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Nombre" class="form-control" required="required" id = "nombre" >
    </div> 

    <div class="form-group">
        <label for="apellido">Apellido *</label>
        <input type="text" name="cliente_apellido" value="<?php echo htmlspecialchars($edit ? $customer['cliente_apellido'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Apelldio" class="form-control" required="required" id="apellido">
    </div> 


    <div class="form-group">
        <label for="dni">DNI</label>
            <input name="cliente_dni" value="<?php echo htmlspecialchars($edit ? $customer['cliente_dni'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="99000999" class="form-control"  type="text" id="dni">
    </div> 

    <div class="form-group">
        <label for="tel">Teléfono</label>
            <input name="cliente_tel" value="<?php echo htmlspecialchars($edit ? $customer['cliente_tel'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="987654321" class="form-control"  type="text" id="tel">
    </div> 
    
    <div class="form-group">
        <label for="email">Email</label>
            <input  type="email" name="cliente_email" value="<?php echo htmlspecialchars($edit ? $customer['cliente_email'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="E-Mail" class="form-control" id="email">
    </div>
    
    <div class="form-group">
        <label for="msj">Mensaje</label>
            <textarea name="cliente_msj" id="msj" cols="30" rows="10" value="<?php echo htmlspecialchars($edit ? $customer['cliente_msj'] : '', ENT_QUOTES, 'UTF-8'); ?>" class="form-control"></textarea>
    </div>

    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Guardar <span class="glyphicon glyphicon-send"></span></button>
    </div>            
</fieldset>
