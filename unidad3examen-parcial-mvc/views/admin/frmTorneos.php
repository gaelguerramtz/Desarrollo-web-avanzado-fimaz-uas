<?php
// Gael Guerra
    require_once("../admin/template/header.php");
?>

<div class="mx-auto p-5">
    <div class="card mx-auto">

        <div class="card header p-2">
            <i class="fa-solid fa-trophy"></i> 
            <span>CAPTURAR LA INFORMACION DEL TORNEO.</span>
        </div>

        <div class="card body p-3">
            <form action="torneosInsert.php" method="post">
                <div class="mb-3">
                    <label for="nombreTorneo" class="form-label">NOMBRE DEL TORNEO</label>
                    <input type="text" class= "form-control" name="txtNombreTorneo" id="nombreTorneo">
                </div>
                <div class="mb-3">
                    <label for="organizador" class="form-label">ORGANIZADOR (nombre completo)</label>
                    <input type="text" class= "form-control" name="txtOrganizador" id="organizador">
                </div>
                <div class="mb-3">
                    <label for="patrocinador" class="form-label">PATROCINADOR(ES)</label>
                    <textarea name="txtPatrocinador" id="patrocinadores" cols="30" rows="2" class="form-control"></textarea>
                    <span id="patrocinador" class="form-text">
                        Atencion: se puede separar con "," si hay mas de un patrocinador.
                    </span>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="sede" class="form-label">SEDE (cancha)</label>
                        <input type="text" class= "form-control" name="txtSede" id="sede">
                    </div>
                    <div class="col mb-3">
                        <label for="categoria" class="form-label">CATEGORIA</label>
                        <input list="lstCategorias" name="txtCategoria" id="categoria" class="form-control">
                        <datalist id="lstCategorias">
                            <option value="1ra. fuerza">
                            <option value="2da. fuerza">
                            <option value="Veteranos">
                            <option value="Libre">
                            <option value="Juvenil">
                            <option value="Femenil">
                            <option value="Emmpresarial">
                            <option value="Infantil">
                            <option value="Minibasket">
                        </datalist>
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="premio1" class="form-label">PREMIO 1ER. LUGAR</label>
                        <input type="text" name="txtPremio1" id="premio1" class="form-control">
                    </div>
                    <div class="col mb-3">
                        <label for="premio2" class="form-label">PREMIO 2DO. LUGAR</label>
                        <input type="text" name="txtPremio2" id="premio2" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="premio3" class="form-label">PREMIO 3ER. LUGAR</label>
                        <input type="text" name="txtPremio3" id="premio3" class="form-control">
                    </div>
                    <div class="col mb-3">
                        <label for="otroPremio" class="form-label">OTRO PREMIO (CAMPEON CANASTERO)</label>
                        <input type="text" name="txtOtroPremio" id="otroPremio" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="usuario" class="form-label">USUARIO</label>
                        <input type="text" name="txtUsuario" id="usuario" class="form-control">
                    </div>
                    <div class="col mb-3">
                        <label for="contrasena" class="form-label">CONTRASEÑA</label>
                        <input type="password" name="txtContrasena" id="contrasena" class="form-control">
                    </div>
                </div>
                <div class="col mb-3">
                    <button type="submit" class= "btn btn-primary">Guardar</button>
                    <a href="admin.php" class="btn btn-danger">Cancelar</a>
                </div>

            </form>
        </div>

        <div class="card footer text-body-secondary">
            FORMULARIO PARA REGISTRAR TORNEOS.
        </div>

    </div>
</div>

<?php
    require_once("../admin/template/footer.php");
?>