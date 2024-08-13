<div class="table-responsive text-nowrap">
    <table class="table" id="tablaInfo">
        <caption class="ms-4">Lista de Docentes</caption>
        <thead>
            <tr>
                <th>
                    <center>Acciones</center>
                </th>
                <th>Fecha Certificacion</th>
                <th>Rector Institucional</th>
                <th>N.Cedula Rector</th>
                <th>Coordinador</th>
                <th>N.Cedula Coordinador</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($listaInformacion) {
                foreach ($listaInformacion as $data) { ?>
                    <tr>
                        <td>
                            <center>
                                <button type="button" class="btn btn-icon btn-outline-secondary " onclick="gestionRegistroInfo(this);" title="Editar Registro" data-accion="editarRegistroInfo" data-id="<?php echo $data->id; ?>">
                                    <span class="tf-icons bx bx-edit-alt me-1"></span>
                                </button>
                            </center>
                        </td>
                        <td><?= $data->Fecha; ?></td>
                        <td><?= $data->Rector_Institucional; ?></td>
                        <td><?= $data->Cedula_Rector; ?></td>
                        <td><?= $data->Encargado_Certificacion; ?></td>
                        <td><?= $data->Cedula_Encargado; ?></td>
                    </tr>
                <?php
                } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="5" class="text-center">No hay datos</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>