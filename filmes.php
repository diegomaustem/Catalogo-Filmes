<?php 


?>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Catálogo de filmes</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<script src="xmltojson.js"></script>
		<script>
			function getFilmes(){
				let xmlHttp = new XMLHttpRequest();
				xmlHttp.open('GET', 'http://localhost/Movie%20Ajax/filmes.json')

				xmlHttp.onreadystatechange = () => {
					if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
						
						let JSONFilmes = xmlHttp.responseText
						let objJSONFilmes = JSON.parse(JSONFilmes)

						enviaValorFront(objJSONFilmes)						
					}

					if(xmlHttp.readyState == 4 && xmlHttp.status == 404) {
						document.write('Arquivo não encontrado!');
					}
				}

				xmlHttp.send()
			}

			function enviaValorFront(jsonFilmes){
				let filme = jsonFilmes
								
				for (var f in filme.filmes) {
 
  					let item = filme.filmes[f]
  					console.log(item)
  					  
  					let row = document.createElement('div')
  					row.classeName = 'row'

  					let col = document.createElement('div')
  					col.classeName = 'col'

  					let p1 = document.createElement('p')
  					p1.innerHTML = '<strong>Título:</strong>' + item.titulo

  					let p2 = document.createElement('p')
  					p2.innerHTML = '<strong>Resumo:</strong>' + item.resumo

  					let genero = ''

  					for (let g in item.generos){

  						if(genero){
  							genero += ', '
  						}

  						genero += item.generos[g].genero
  					}

  					let p3 = document.createElement('p')
  					p3.innerHTML = '<strong>Gênero:</strong>' + genero

  					let elenco = ''

  					for (let e in item.elenco){

  						if(elenco){
  							elenco += ', '
  						}

  						elenco += item.elenco[e].ator
  					}

  					let p4 = document.createElement('p')
  					p4.innerHTML = '<strong>Elenco:</strong>' + elenco

  					let p5 = document.createElement('p')
  					p5.innerHTML = '<strong>Data de lançamento:</strong>' + item.dataLancamento.data + ' ('+ item.dataLancamento.pais +')'

   					let hr = document.createElement('hr')
		
					row.appendChild(col)
					col.appendChild(p1)
					col.appendChild(p2)
					col.appendChild(p3)
					col.appendChild(p4)
					col.appendChild(p5)
					col.appendChild(hr)

					document.getElementById('lista').appendChild(row)

				}

			}

			function clearView(){
				document.getElementById('lista').textContent = ''
			}
		</script>
	</head>
	<body>
		<nav class="navbar navbar-light bg-light mb-4">
			<div class="container">
				<div class="navbar-brand mb-0 h1">
					<h3>Catálogo de filmes</h3>
				</div>
				<div class="row">
					<div class="col">
						<div id="lista">

						</div>
					</div>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col">
					<button type="button" class="btn btn-success" onclick="getFilmes()">Listar filmes</button>
					<button type="button" class="btn btn-danger" onclick="clearView()">Limpar Tela</button>
				</div>
			</div>
		</div>
	</body>
</html>