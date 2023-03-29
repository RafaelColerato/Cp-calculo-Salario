<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calcular salário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body class="bg-secondary text-light">
  <div class="bg-danger">
    <div class="container p-3">
      <div class="display-3 text-center">Calcular salário</div>
    </div>
  </div>

  <div class="container d-flex flex-column align-items-center justify-content-center p-5">
    <form class="col-6 mb-5" method="POST">
      <div class="row mb-5">
        <label for="salario" class="form-label">Salário</label>
        <input type="number" class="form-control" id="salario" name="salario" value="0" min="0" />
      </div>

      <div class="row mb-5">
        <label for="dependentes" class="form-label">Dependentes</label>
        <input type="number" class="form-control" id="dependentes" name="dependentes" value="0" min="0" />
      </div>

      <div class="row mb-5">
        <label for="vend" class="form-label">Quantidade de Vendas</label>
        <input type="number" class="form-control" id="vend" name="vend" value="0" min="0" />
      </div>

      <div class="row gap-2 justify-content-center">
        <button type="submit" class="btn btn-primary col-4">
          Enviar
        </button>
      </div>
    </form>

    <?php 
    include "./rafaelcolerato-calculosalario.php";

    if (isset($_POST['salario']) && isset($_POST['dependentes']) && isset($_POST['vend'])) {
      $salario = $_POST['salario'];
      $dependentes = $_POST['dependentes'];
      $vend = $_POST['vend'];

      $inss = calcularINSS($salario);
      $irrf = calcularIRRF($salario);
      $liquido = round($salario, 2) - calcularINSS($salario) - calcularIRRF($salario, $dependentes);
      $acrescimo = $liquido + calcularAcrescimo($vend);

      echo '<strong>Cálculo Salario/Impostos/Bonus:<strong>
        <div>
          <p>
            <strong>Salário bruto:</strong>
            R$ ' . number_format($salario, 2, ',', '.') . '
          </p>
        </div>
        <div>
          <p>
            <strong>INSS:</strong>
            R$ ' . number_format($inss, 2, ',', '.') . '
          </p>
        </div>
        <div>
          <p>
            <strong>IRRF:</strong>
            R$ ' . number_format($irrf, 2, ',', '.') . '
          </p>
        </div>
        <div>
          <p>
            <strong>Salário Líquido:</strong>
            R$ ' . number_format($liquido, 2, ',', '.') . '
          </p>
        </div>
        <div>
        <p>
          <strong>Salário Líquido:</strong>
          R$ ' . number_format($liquido, 2, ',', '.') . '
        </p>
      </div>
      <div>
      <p>
        <strong>Salário c/ Acrescimo de Venda Realizada:</strong>
        R$ ' . number_format($acrescimo, 2, ',', '.') . '
      </p>
    </div>
      </div>
    ';
    }
    ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"></script>
</body>

</html>