function popularSelecaoEstado(selectEstado, estadoSelecionado = null) {
  if (selectEstado) {
    fetch(
      "https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome"
    )
      .then((res) => res.json())
      .then((estados) => {
        estados.map((estado) => {
          const opcao = document.createElement("option");

          opcao.setAttribute("value", estado.sigla);

          if (estadoSelecionado && estadoSelecionado == estado.sigla) {
            opcao.selected = true;
          }
          opcao.textContent = estado.nome;

          selectEstado.appendChild(opcao);
        });
      });
  }
}

function popularSelecaoCidade(
  selectEstado,
  selectCidade,
  cidadeSelecionada = null,
  estadoSelecionado = null
) {
  if (selectEstado && selectCidade) {
    selectEstado.addEventListener("change", () => {
      let nodesSelectCities = selectCidade.childNodes;

      [...nodesSelectCities].map((node) => node.remove());

      let estado = selectEstado.options[selectEstado.selectedIndex].value;

      if (estado) {
        fetch(
          `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estado}/municipios?orderBy=nome`
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
    });

    if (cidadeSelecionada) {
      if (estadoSelecionado) {
        fetch(
          `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estadoSelecionado}/municipios?orderBy=nome`
        )
          .then((res) => res.json())
          .then((cidades) => {
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
}

popularSelecaoEstado();
popularSelecaoCidade();
