| | | | | | | | |
|-|-|-|-|-|-|-|-|
|Tabela|Pessoas| | | | | | |
|Descrição|Tabela responsável por armazenar os dados das pessoas| | | | | | |
|Atributos| | | | | | | |
|Nome da Coluna| |Tipo do Dado|Valor min e max|Nulidade|PK|FK|Descrição|
|id_pessoa| |int|1 até 10000|NOT NULL|X| |Código de identificador da pessoa|
|nome| |varchar(100)|10 até 100|NOT NULL| | |Nome da pessoa|
|telefone | |varchar(20)|8 até 20|NOT NULL| | |Numero do telefone da pessoa|
|email| |varchar(40)|8 até 40|NULL| | |E-mail da pessoa|
|rua| |varchar(100)|8 até 100|NOT NULL| | |Rua|
|numero| |int|1 até 100000|NOT NULL| | |Numero da casa|
|bairro| |varchar(50)|2 até 50|NOT NULL| | |Bairro onde mora|
|cidade| |varchar(50)|2 até 50|NOT NULL| | |Cidade onde mora|
|estado| |varchar(50)|2 até 50|NOT NULL| | |Estado onde mora|
|cep| |varchar(10)|8 até 10|NOT NULL| | |Cep da rua|
| | | | | | | | |
| | | | | | | | |
|Tabela|seguradora| | | | | | |
|Descrição|Tabela responsável por armazenar os dados das seguradoras| | | | | | |
|Atributos| | | | | | | |
|Nome da Coluna| |Tipo do Dado|Valor min e max|Nulidade|PK|FK|Descrição|
|id_seguradora| |serial|1 até 10000|NOT NULL|X| |Código de identificador da pessoa|
|nome| |varchar(255)|2 até 255|NOT NULL| | |Nome da pessoa|
|cnpj| |char(14)|12 até 14|NOT NULL| | |CNPJ da seguradora|
|razao_social| |varchar(100)|5 até 100|NOT NULL| | |Razão social da seguradora|
|telefone | |varchar(20)|8 até 20|NOT NULL| | |Numero do telefone da seguradora|
|email| |varchar(40)|8 até 40|NULL| | |E-mail da seguradora|
|rua| |varchar(100)|8 até 100|NULL| | |Rua da |
|numero| |int|1 até 100000|NULL| | |Numero do estabelecimento|
|bairro| |varchar(50)|2 até 50|NULL| | |Bairro|
|cidade| |varchar(50)|2 até 50|NULL| | |Cidade|
|estado| |varchar(50)|2 até 50|NULL| | |Estado|
|cep| |varchar(10)|8 até 10|NULL| | |Cep da rua|
| | | | | | | | |
| | | | | | | | |
|Tabela|Cliente| | | | | | |
|Descrição|Tabela responsável por armazenar os dados dos clientes| | | | | | |
|Atributos| | | | | | | |
|Nome da Coluna| |Tipo do Dado|Valor min e max|Nulidade|PK|FK|Descrição|
|id_cliente| |serial|1 até 10000|NOT NULL| |X|Código de identificador de clientes|
|id_pessoa| |int|1 até 10000|NOT NULL| |X|Código de identificador da pessoa|
| | | | | | | | |
| | | | | | | | |
|Tabela|Corretor| | | | | | |
|Descrição|Tabela responsável por armazenar os dados dos corretores| | | | | | |
|Atributos| | | | | | | |
|Nome da Coluna| |Tipo do Dado|Valor min e max|Nulidade|PK|FK|Descrição|
|id_seguradora| |int|1 até 10000|NOT NULL| |X|Código de identificador da seguradora|
|id_pessoa| |int|1 até 10000|NOT NULL| |X|Código de identificador da pessoa|
| | | | | | | | |
| | | | | | | | |
|Tabela|imovel| | | | | | |
|Descrição|Tabela responsável por armazenar os dados dos imoveis| | | | | | |
|Atributos| | | | | | | |
|Nome da Coluna| |Tipo do Dado|Valor min e max|Nulidade|PK|FK|Descrição|
|id_imovel| |serial|1 até 10000|NOT NULL|X| |Código de identificador da pessoa|
|id_seguradora| |int|1 até 10000|NOT NULL| |X|Código de identificador da seguradora|
|tipo| |varchar(50)|2 até 50|NOT NULL| | |Tipo do imovel (ex: casa,apt,terreno,etc)|
|area| |decimal|1 até 1000000|NOT NULL| | |Aréa em m² do imovel|
|valor| |decimal|1 até 9999999|NOT NULL| | |Valor do imovel avaliado pela seguradora|
|descricao| |varchar(255)|20 até 255|NOT NULL| | |Descrição sobre o imovel|
|rua| |varchar(100)|8 até 100|NULL| | |Rua do imóvel|
|numero| |int|1 até 100000|NULL| | |Numero do imóvel|
|bairro| |varchar(50)|2 até 50|NULL| | |Bairro do imóvel|
|cidade| |varchar(50)|2 até 50|NULL| | |Cidade do imóvel|
|estado| |varchar(50)|2 até 50|NULL| | |Estado do imóvel|
|cep| |varchar(10)|8 até 10|NULL| | |Cep da rua|
| | | | | | | | |
| | | | | | | | |
|Tabela|mobilia| | | | | | |
|Descrição|Tabela responsável por armazenar os dados das mobílias| | | | | | |
|Atributos| | | | | | | |
|Nome da Coluna| |Tipo do Dado|Valor min e max|Nulidade|PK|FK|Descrição|
|id_mobilia| |serial|1 até 10000|NOT NULL|X| |Código de identificador da mobília|
|id_imovel| |int|1 até 10000|NOT NULL| |X|Código de identificador do imóvel|
|nome| |varchar(200)|2 até 200|NOT NULL| | |Nome da mobília|
|valor| |decimal|1 até 9999999|NOT NULL| | |Valor da mobília|
| | | | | | | | |
| | | | | | | | |
|Tabela|apolice| | | | | | |
|Descrição|Tabela responsável por armazenar os dados das apolices | | | | | | |
|Atributos| | | | | | | |
|Nome da Coluna| |Tipo do Dado|Valor min e max|Nulidade|PK|FK|Descrição|
|id_apolice| |serial|1 até 10000|NOT NULL|X| |Código de identificador da apólice|
|id_imovel| |int|1 até 10000|NOT NULL| |X|Código de identificador do imóvel|
|id_cliente| |int|1 até 10000|NOT NULL| |X|Código de identificador do cliente |
|data_inicio| |date|8 até 10|NOT NULL| | |Data de inicio da vigência |
|data_fim| |date|8 até 10|NOT NULL| | |Data do fiim da vigência |
|valor_cobertura| |decimal|1 até 9999999|NOT NULL| | |Valor da cobertura da vigência|
| | | | | | | | |
| | | | | | | | |
|Tabela|sinistro| | | | | | |
|Descrição|Tabela responsável por armazenar os dados dos sinistros| | | | | | |
|Atributos| | | | | | | |
|Nome da Coluna| |Tipo do Dado|Valor min e max|Nulidade|PK|FK|Descrição|
|id_sinistro| |int|1 até 10000|NOT NULL|X| |Código de identificador do sinistro|
|id_imovel| |int|1 até 10000|NOT NULL| |X|Código de identificador do imóvel|
|data_ocorrencia| |date|8 até 10|NOT NULL| | |Data da ocorrencia |
|descrição| |text|20 até 200|NOT NULL| | |Descrição da ocorrencia do sinistro|
|valor_prejuizo| |decimal|1 até 9999999|NOT NULL| | |Valor do prejuízo da ocorrencia|
| | | | | | | | |
| | | | | | | | |
|Tabela|vistoria| | | | | | |
|Descrição|Tabela responsável por armazenar os dados das vistorias| | | | | | |
|Atributos| | | | | | | |
|Nome da Coluna| |Tipo do Dado|Valor min e max|Nulidade|PK|FK|Descrição|
|id_vistoria| |int|1 até 10000|NOT NULL|X| |Código de identificador da vistoria|
|id_imovel| |int|1 até 10000|NOT NULL| |X|Código de identificador do imóvel|
|data_vistoria| |date|8 até 10|NOT NULL| | |Data da vistoria |
|descrição| |text|20 até 200|NOT NULL| | |Descrição da vistoria|
| | | | | | | | |
| | | | | | | | |
|Tabela|historico| | | | | | |
|Descrição|Tabela responsável por armazenar os dados dos históricos | | | | | | |
|Atributos| | | | | | | |
|Nome da Coluna| |Tipo do Dado|Valor min e max|Nulidade|PK|FK|Descrição|
|id_vistoria| |int|1 até 10000|NOT NULL|X| |Código de identificador da vistoria|
|id_imovel| |int|1 até 10000|NOT NULL| |X|Código de identificador do imóvel|
|data_vistoria| |date|8 até 10|NOT NULL| | |Data da vistoria |
|descrição| |text|20 até 150|NOT NULL| | |Descrição da vistoria|
