<h1 align="center">Bem vindo, ao código de conversão de números para extenso</h1>

## Como começar?

Para usar a classe basta fazer o download do arquivo NumeroExtenso.php e adicionar em seu local de desenvolvimento.

**Exemplo:**

```PHP

$Util = new NumeroExtenso(informe o número);

$numero_extenso = $Util->show();

```
O método show retorna string com o número por exteso ou retorna FALSE caso ocorra algum erro.

Além do método show, também existe o método get_erro() onde você pode obter o erro caso exista.

**Exemplo:**

```PHP

$Util->get_erro();

```

## Docker

Foi criado uma imagem no Docker com o Apache, Php e a classe já instalado pronto para o uso, bastando apenas você baixar e instalar em seu local de trabalho, para instalar basta você utilizar o comando abaixo em seu terminal docker.

**Comando:**

```

docker run -d -p 8080:80 diogocardoso/projeto_certi 

```

## Testando o servidor

Após a instalação basta digitar a seguinte url:

```

http://localhost:8080/numero_extenso/?num=1515

```

