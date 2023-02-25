function callbackCep(conteudo) {
  if (!("erro" in conteudo)) {
    if (conteudo.logradouro) {
      document.getElementById("rua").value = conteudo.logradouro;
    }
    if (conteudo.uf && conteudo.localidade) {
      document.getElementById("estados").value = conteudo.uf;

      const selectEstado = document.querySelector("#estados");
      const selectCidade = document.querySelector("#cidades");

      escolherCidade(
        selectEstado,
        selectCidade,
        conteudo.uf,
        conteudo.localidade
      );
    }
    if (conteudo.complemento) {
      document.getElementById("complemento").value = conteudo.complemento;
    }
  } else {
    alert("CEP não encontrado.");
  }
}

function pesquisaCep(valor) {
  var cep = valor.replace(/\D/g, "");

  if (cep != "") {
    var validacep = /^[0-9]{8}$/;

    if (validacep.test(cep)) {
      var script = document.createElement("script");

      script.src =
        "https://viacep.com.br/ws/" + cep + "/json/?callback=callbackCep";

      document.body.appendChild(script);
    } else {
      alert("Formato de CEP inválido.");
    }
  }
}

function escolherCidade(
  selectEstado,
  selectCidade,
  estadoSelecionado,
  cidadeSelecionada
) {
  if (selectEstado && selectCidade) {
    if (estadoSelecionado) {
      fetch(
        `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoSelecionado}/municipios?orderBy=nome`
      )
        .then((res) => res.json())
        .then((cidades) => {
          selectCidade.removeAttribute("disabled");

          cidades.map((cidade) => {
            const opcao = document.createElement("option");

            opcao.setAttribute("value", cidade.nome);

            if (cidadeSelecionada && cidadeSelecionada == cidade.nome) {
              opcao.selected = true;
            }

            opcao.textContent = cidade.nome;

            selectCidade.appendChild(opcao);
          });
        });
    }
  }
}
