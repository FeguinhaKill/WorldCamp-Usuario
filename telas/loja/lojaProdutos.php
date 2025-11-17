<?php
session_start();
include '../../header.php';
include '../../database/db.class.php';
$db = new db();

$db->checkLogin();
?>
<?php

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    />

    <style>
      :root {
        --verde: #198754;
        --verde-escuro: #146c43;
        --texto: #212529;
      }

      html,
      body {
        height: 100%;
      }

      body {
        margin: 0;
        color: var(--texto);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        padding-bottom: 72px;
        background-color: #f5f8f6;
      }

      main {
        flex: 1 0 auto;
        padding-bottom: 2rem;
      }

      header.hero-min {
        background: linear-gradient(0deg, var(--verde-escuro), var(--verde));
        color: #fff;
        padding: 60px 0;
        text-align: center;
      }

      .btn-success {
        background-color: var(--verde);
        border-color: var(--verde-escuro);
      }

      .btn-success:hover {
        background-color: var(--verde-escuro);
        border-color: var(--verde-escuro);
      }

      .card img {
        object-fit: cover;
        height: 220px;
      }

      h1.Principal {
        text-align: center;
        font-family: "Lucida Handwriting", cursive;
        color: var(--verde);
        margin-top: 50px;
        margin-bottom: 50px;
      }

      .hero {
        background: url("https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80")
          center/cover no-repeat;
        color: white;
        text-align: center;
        padding: 6rem 2rem;
        border-radius: 10px;
      }

      .hero h1 {
        font-size: 3rem;
        font-weight: 700;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
      }

      .hero p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 1.5rem;
      }

      .badge.bg-success {
        background-color: var(--verde) !important;
      }

      .card-body ul {
        list-style-type: disc;
        padding-left: 1.5rem;
      }
    </style>

    <title>Loja - WorldCamp</title>
  </head>
  <body>

    <main class="container my-5">

      <section class="hero mb-5">
        <h1>Equipe-se para a Aventura!</h1>
        <p>
          Explore nossa linha de produtos WorldCamp: roupas, calçados e acessórios
          pensados para experiências de acampamento inesquecíveis.
        </p>
        <a href="#produtos" class="btn btn-lg btn-success">Ver Produtos</a>
      </section>

      
      <h1 class="Principal" id="produtos">Produtos em Destaque</h1>

      <div class="row mb-4">
      
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://www.google.com/aclk?sa=L&ai=DChsSEwj1gaGR3vmQAxVgXEgAHXbjC44YACICCAEQHRoCY2U&co=1&ase=2&gclid=Cj0KCQiArOvIBhDLARIsAPwJXOYom3Lt4sWnyxet9nfcsODcZHFNO8INOuD28mrQpfRhu2Vm3MGfOkcaAsA3EALw_wcB&cid=CAASWeRoDAmzw8jXqta2z72It-40MU5DUcIihZ7efh53D33XujXB6Hr7hGX466cmPvkStKCkjBSOJBUdCqHwaIupP82JuITx8Ol7rQUN1Bz2i0WaCBA_jtBTz0s1&cce=2&category=acrcp_v1_32&sig=AOD64_27CXosXAAC2vcNstiZdl79efuBkg&ctype=5&q=&nis=4&ved=2ahUKEwj0wJqR3vmQAxWbq5UCHeVwOToQwg8oAXoECAgQHA&adurl="
                 alt="Garrafa térmica WorldCamp" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Acessório</span>
              <h4 class="card-title">Garrafa Térmica WorldCamp</h4>
              <ul>
                <li>Conserva a temperatura por até 12h</li>
                <li>Corpo em aço inoxidável</li>
                <li>Ideal para trilhas longas</li>
              </ul>
              <p><strong>R$ 119,00</strong></p>
              <a href="#" class="btn btn-success w-100">
                <i class="fa-solid fa-cart-plus"></i> Comprar
              </a>
            </div>
          </div>
        </div>

 
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://www.google.com/aclk?sa=L&ai=DChsSEwiF_bvt3fmQAxXSQUgAHZ28C2wYACICCAEQGBoCY2U&co=1&ase=2&gclid=Cj0KCQiArOvIBhDLARIsAPwJXOZGu-MEyVASjJr7qNcz1Rj0ud8HK1Jc4JT-FGu0a1uDr0EI-qAI6c0aArAtEALw_wcB&cid=CAASWeRoIefisLv1kff4sUvvO-J7kU_qFwh8xIt9sNV-Ji_X501mLNa4qagwXAZy-gbm3NLwJcI7mOgMni1aWB_7BgiuX-2wqMfOi1swX9z9CAzND617FMcTylLd&cce=2&category=acrcp_v1_32&sig=AOD64_2TmYxMc2miuVDNBwaZAhUuNJ9LVg&ctype=5&q=&nis=4&ved=2ahUKEwiX2LXt3fmQAxWTl5UCHQTCLnoQ9aACKAB6BAgGEBY&adurl="
                 alt="Botas de chuva" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Calçado</span>
              <h4 class="card-title">Botas de Chuva Impermeáveis</h4>
              <ul>
                <li>Material resistente à água</li>
                <li>Solado antiderrapante</li>
                <li>Perfeitas para terrenos molhados</li>
              </ul>
              <p><strong>R$ 249,00</strong></p>
              <a href="#" class="btn btn-success w-100">
                <i class="fa-solid fa-cart-plus"></i> Comprar
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://www.google.com/imgres?q=jaqueta%20school%20eua&imgurl=https%3A%2F%2Fcdn.awsli.com.br%2F600x450%2F1276%2F1276466%2Fproduto%2F79255540%2F6d0a4d61fe.jpg&imgrefurl=https%3A%2F%2Fwww.college4ever.com.br%2Fjaqueta-college-americana-blue-yellow-letra-v-bordada-unissex%3Fsrsltid%3DAfmBOop5VdKFsC8dGf7kfO7_zxihXIxueChnmF6qRA1TYRtzs4ViSnhv&docid=SekNsMUlw91DoM&tbnid=-E2zPVUPLWEyHM&vet=12ahUKEwiuwMDQ3vmQAxXrp5UCHa3KLvkQM3oECFkQAA..i&w=450&h=450&hcb=2&ved=2ahUKEwiuwMDQ3vmQAxXrp5UCHa3KLvkQM3oECFkQAA"
                 alt="Jaqueta School WorldCamp" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Roupa</span>
              <h4 class="card-title">Jaqueta School WorldCamp</h4>
              <ul>
                <li>Proteção contra vento e chuva</li>
                <li>Tecido térmico leve</li>
                <li>Visual oficial do acampamento</li>
              </ul>
              <p><strong>R$ 329,00</strong></p>
              <a href="#" class="btn btn-success w-100">
                <i class="fa-solid fa-cart-plus"></i> Comprar
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="row mb-4">
 
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://www.google.com/aclk?sa=L&ai=DChsSEwjihc3e3vmQAxW4QUgAHdgxPSMYACICCAEQCxoCY2U&co=1&ase=2&gclid=Cj0KCQiArOvIBhDLARIsAPwJXOabryGpb1THVs1lsxVTRdWbw5VMvSdV1tfxfAbq507grgcn3mJIvcIaAh77EALw_wcB&cid=CAASWeRo4JkE4GBqH65_syYr-uyJVwBt5LzR4MeFgk6G3BSQsPel9j0cERd87tARomwfEYS5rEKdLr1cyRJQ5oWftPQFV6UOPLYzxhO2fI9nyMS3K-7J9IRAXoBO&cce=2&category=acrcp_v1_32&sig=AOD64_2zQ8QQqhmTsR65dn6aLok_DBxRxQ&ctype=5&q=&nis=4&ved=2ahUKEwj4gcje3vmQAxWApZUCHfEVHVEQ9aACKAB6BAgIEDI&adurl="
                 alt="Chapéu de acampamento" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Acessório</span>
              <h4 class="card-title">Chapéu de Acampamento</h4>
              <ul>
                <li>Proteção contra o sol</li>
                <li>Ajuste com cordão</li>
                <li>Estilo aventureiro WorldCamp</li>
              </ul>
              <p><strong>R$ 79,90</strong></p>
              <a href="#" class="btn btn-success w-100">
                <i class="fa-solid fa-cart-plus"></i> Comprar
              </a>
            </div>
          </div>
        </div>

    
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://www.google.com/aclk?sa=L&ai=DChsSEwiu6tSm3vmQAxX_WEgAHSB1PYcYACICCAEQHxoCY2U&co=1&ase=2&gclid=Cj0KCQiArOvIBhDLARIsAPwJXOY1Ssm4Wh3na2OJ9dx7qEv3tot0-gR5OMsKQ06GJcozCMm77ynO8V4aAmndEALw_wcB&cid=CAASWeRonDtvbDWToJ3eFd-yuEX9SM8YTE_6OBINRnJPMI0YCYy7twrFUyyCSiixzoE2lwGljneDqzSNd3T4e4S63bGMaawhJrqTyvkWfvubm1b1x5cLXLVNRJxP&cce=2&category=acrcp_v1_32&sig=AOD64_31Yp2d_qmQms0-n3JtT-hycbNq1Q&ctype=5&q=&nis=4&ved=2ahUKEwj_286m3vmQAxVfq5UCHdkrCKUQ9aACKAB6BAgNEA8&adurl="
                 alt="Camiseta personalizada" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Roupa</span>
              <h4 class="card-title">Camiseta Personalizada WorldCamp</h4>
              <ul>
                <li>Nome, turma ou frase personalizada</li>
                <li>Tecido leve e respirável</li>
                <li>Lembrança oficial do acampamento</li>
              </ul>
              <p><strong>R$ 89,90</strong></p>
              <a href="#" class="btn btn-success w-100">
                <i class="fa-solid fa-cart-plus"></i> Comprar
              </a>
            </div>
          </div>
        </div>

   
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="https://www.google.com/aclk?sa=L&ai=DChsSEwiNoPn43vmQAxXgaUgAHTrEFg0YACICCAEQAxoCY2U&co=1&ase=2&gclid=Cj0KCQiArOvIBhDLARIsAPwJXOaebok8eSxfjNPdHBOkOcMTqhWB394tcaoyqhFdgI8g7nEiv5lE1KoaAjOrEALw_wcB&cid=CAASWeRoptBtbSWoC17ZaxOAbGkRsEl9NK2drguCGyLH3YCWlYMRJRhyltnWTNhOn7oWUKoJoQSfNnQp-6lTG8zVSOgl-6Vo99XE_cI2t4wxm6R0XTYzSbABjObj&cce=2&category=acrcp_v1_32&sig=AOD64_1nVKs8NYs4UF1q1h9nHQ5n_6vmQA&ctype=5&q=&nis=4&ved=2ahUKEwj9m_T43vmQAxWaqZUCHW83GpQQ9aACKAB6BAgIEB4&adurl="
                 alt="Kit aleatório" class="card-img-top" />
            <div class="card-body">
              <span class="badge bg-success mb-2">Kit</span>
              <h4 class="card-title">Kit Aleatório WorldCamp</h4>
              <ul>
                <li>Contém de 3 a 5 itens surpresa</li>
                <li>Selecionados pela equipe WorldCamp</li>
                <li>Perfeito para quem gosta de novidade</li>
              </ul>
              <p><strong>R$ 159,00</strong></p>
              <a href="#" class="btn btn-success w-100">
                <i class="fa-solid fa-cart-plus"></i> Comprar
              </a>
            </div>
          </div>
        </div>
      </div>
    </main>

    <?php
    include '../footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

    <?php
include '../../footer.php';
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

</html>

