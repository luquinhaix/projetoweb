<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Viagens</h1>
        <div class="btn-toolbar mb-0 mb-md-0">
            <button type="button" class="w-100 btn btn-primary" onclick='window.open("menu.php?modulo=cadastro_viagem&cd_viagem=0","_self");'>Novo</button>
        </div>
      </div>

    <table id="example"  style="width:100%">
        <thead>
            <tr>
                <th>Viagem</th>
                <th>Origem</th>
                <th>Destino</th>
                <th>Placa</th>
                <th>Carga</th>
                <th>Valor</th>
                <th>Início</th>
                <th>Fim</th>
            </tr>
        </thead>
        <tbody>
        <?php
          include "conecta.php";
          $SQL = "select * from viagens order by cd_viagem";
          $RSS = mysqli_query($conexao,$SQL)or print(mysqli_error());
          while($RS = mysqli_fetch_array($RSS))
          {
            echo "<tr onClick='Clica(".$RS["cd_viagem"].")' >";
            echo "<td>".$RS["cd_viagem"]."</td>";
            echo "<td>".$RS["ds_origem"]."</td>";
            echo "<td>".$RS["ds_destino"]."</td>";
            echo "<td>".$RS["ds_placa_viagem"]."</td>";
            echo "<td>".$RS["ds_carga"]."</td>";
            echo "<td>".$RS["ds_valor"]."</td>";
            echo "<td>".$RS["dt_inicio"]."</td>";
            echo "<td>".$RS["dt_fim"]."</td>";
            echo "</tr>";
          }
        ?>
        </tbody>
    </table>
  </main>

<script>
  $(document).ready(function () {
    $('#example').DataTable();
  });


function Clica(cd_viagem)
{
	window.open('menu.php?modulo=cadastro_viagem&cd_viagem='+cd_viagem, "_self");
}  
</script>
