## Projeto Sistema de Seguros de Imóveis
# HUG - House Unforeseens Guardian

<div align="center">
  <img src="imagens/logo.jpg" alt="Logo">
</div>

### Grupo A

### Integrantes:
* [Arthur de Luca Honorato](https://github.com/arthurdelucahonorato)
* [Bruna Pacheco Peruch](https://github.com/brupperuch)
* [Guilherme Brito Pizzollo](https://github.com/guilhermebp030504)
* [Guilherme Machado Darabas](https://github.com/gmdarabas)
* [Paulo Roberto Simão](https://github.com/paulorsimao)
* [Renato Ribas Campos](https://github.com/renatoribascampos)
* [Rubens Scotti Junior](https://github.com/rubensscotti)
* [Stephan  Anthony  Marques](https://github.com/stephan-anthony)

### Modelo Físico:
<code>[Arquivo Fonte](https://dbdiagram.io/d/6488f767722eb77494e9558d)</code><br>
<div align="center">
  <img src="imagens/Modelo.png" alt="Modelo">
</div>

  
### Dicionário de Dados:
<code>[Excel](https://github.com/paulorsimao/HUG/tree/main/dicionario_hug.xlsx) ou [Tabela do Github (markdown)](https://github.com/paulorsimao/HUG/tree/main/dicionario_hug.md)</code>

### Scripts DDL Criação do Database:
<code>[Ver Scripts](https://github.com/paulorsimao/HUG/tree/main/sql)</code>

### Scripts Popula tabelas:
Banco de dados utilizado PostgreSql<br>
<p>Por conta da quantidade de dados, foi utilizado o comando pg_dump para poder popular as tabelas. Para restaurar pode ser usado o comando</p>

<code>psql -d segurosseg -U postgres -f dump_seguro.sql</code>

### Objetos de BD (stored procedure, triggers e functions):
<code>[Ver Objetos](./sql/objetos/)</code>
  
### Código do sistema:
JavaScript, PHP (Versão 7), PostegresSQL (Versão 14)<br>
<code>código fonte da aplicação</code>

### Perguntas de negócio:
1 - Quantos clientes terão suas apólices vencidas no período de 6 meses a partir da data atual, das seguradoras do estado de SP, RS e PR?
```sql
  select count(i.id_cliente), s.estado from apolice a 
  left join imovel i on i.id_imovel = a.id_imovel 
  left join seguradora s on s.id_seguradora = i.id_seguradora 
  where a.data_fim between current_date and (current_date + interval '6 months')
  and s.estado in ('SP', 'RS', 'PR')
  group by s.estado;

  /* index na data de finalização da apolice para poder filtrar por periodo de forma indexada */
  CREATE INDEX idx_fim_apolice ON public.apolice (data_fim)

  /* index para filtrar por estado da seguradora. obs: o postgres não utiliza este index pois a tabela é muito pequena */
  create index idx_estado_seguradora on public.seguradora (estado)
```
<br>

2 - Liste nome e valor das mobílias dos imóveis, do tipo apartamento, que ultrapassam o valor de 500K reais com apólices criadas no mês atual?
```sql
select id_mobilia, m.nome, m.valor from mobilia m 
left join imovel i on i.id_imovel = m.id_imovel 
where i.tipo = 'Apartamento'
and i.valor > 500000
and i.id_imovel in (
	select a.id_imovel from apolice a where extract (month from a.data_inicio) = extract(month from current_date)
)

CREATE INDEX idx_tipo_valor_imovel ON public.imovel (id_imovel, tipo, valor)
```
<br>

3 - liste os imóveis e a quantidade respectiva de mobílias por imóvel que cada cliente tem. Os clientes devem ter entre 30 e 40 anos e residir no estado de SC.
```sql
SELECT
    imovel.id_imovel,
    COUNT(mobilia.id_mobilia) AS quantidade_mobilia
FROM
    imovel
INNER JOIN
    cliente ON cliente.id_cliente = imovel.id_cliente
INNER JOIN
    pessoa ON pessoa.id_pessoa = cliente.id_pessoa
LEFT JOIN
    mobilia ON mobilia.id_imovel = imovel.id_imovel
WHERE
    pessoa.data_nasc BETWEEN '1993-06-26' AND '2003-06-26' -- 30 a 40 anos
    AND pessoa.estado = 'SC'
GROUP BY
    imovel.id_imovel;
```
<br>

4 - Informar o top 10 dos valores totais de prejuizo gerado por sinistros, agrupados por imóvel e trazendo as informações como, nome, cpf,
data de nascimento e telefone da pessoa responsável.
```sql
/* para esta query não foi necessário criação de indices adicionais
 * pois apenas usando cte para isolar os 10 maiores valores
 * o banco de dados já passou a utilizar todos os indices nos joins
 * assim executando apenas 1 seq_scan para a tabela de sinistros
 * */
with top_sinistros as (
	select 
		s.id_imovel,
		sum(s.valor_prejuizo) as soma,
		rank() over (order by sum(s.valor_prejuizo) desc) as rank_sinistro
	from sinistro s
	group by s.id_imovel 
	limit 10
) select 
	ts.soma, p.nome, p.cpf, p.telefone, i.id_imovel
from top_sinistros ts
left join imovel i on i.id_imovel = ts.id_imovel 
left join cliente c on c.id_cliente = i.id_cliente 
left join pessoa p on p.id_pessoa = c.id_pessoa
order by ts.rank_sinistro asc
```
