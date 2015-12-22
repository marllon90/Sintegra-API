# Sintegra-API
API Sintegra ES

# Entendendo a API - Consulta

Esta API utiliza de funções CURL para obter os dados do Sintegra ES.

A classe Sintegra é responsável pela captura de dados do sistema Sintegra ES, são passados dois parâmetros via POST, "num_cnpj" e "botao". O parâmetro "botao" é constante "Consultar". O parâmetro "num_cnpj" é variável e se refere ao número do CNPJ que será consultado.

A classe Sintegra contém um único médodo chamado "getSintegraContent", este método recebe o CNPJ que será consultado e  devolve uma string contendo o conteúdo HTML da consulta como retono, a consulta é realizada via POST.

# Entendendo a API - Parser

A Classe Parser é responsável por "parsear" o conteúdo de retorno, ela possui 2 médotos "nodeContent" que basicamente localiza o conteúdo dentro de um DOM node.

O método "getSintegraES" é responsável por obter de fato os dados da página "resultado.php" do Sintegra ES. Um estudo de padrão mostrou que todo retorno de conteúdo (CNPJ, IE, Razão Social.) segue o padrão: "<td class='valor' ...> ...</td>"; logo em "getSintegraES" possui 3 parâmetros:

-> "$html" - String com o html que será anlisado.
-> "$element" - Elemento que contém o padrão desejado. Ex: td.
-> "$class" - Classe que será analisada "uma chave" para especificar de onde virá o conteúdo. Ex: valor.

Dentro de "getSintegraES" todo retorno é salvo dentro de uma tabela contendo as informações de retorno buscadas conforme o padrão descoberto.

O metódo devolve um booleano contendo informações se houve ou não sucesso na geração e gravação dos dados na tabela.


# Classes comuns

A api contém algums classes de limpeza, validação e conexão com o banco de dados, elas podem ser encontradas em "classes".

# Funcionamento 

Uma consulta só pode ser realizada por meio do CNPJ e chave de acesso.

A API previamente valida o CNPJ para evitar consultas que devolverão resultados nulos. Antes de verificar o sistema Sintegra ES o sistema consulta a base de dados para ver se já existe a informação, se existir recupera os registros do banco e exibe,se a informação não existir, consulta o sistema Sintegra ES, salva os dados em banco e exibe. Toda consulta necessita de uma chave de acesso, que pode ser gerada pela API. 


# Chave de Acesso.

A chave de acesso é única por email, é gerada pea combinação de email+timestamp com um hash sha256.

# Instalação

É necessário criar o banco, script "sintegra.sql"

As configurações de conexao podem sem feitas em app/config.ini.






