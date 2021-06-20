# Exame LBAW

Por quem são identificadas as User stories? Stakeholders do projeto.

Qual das seguintes opções é uma desvantagem decorrente da utilização de stored
procedures? A incapacidade de reutilização noutros SGBD do código desenvolvido.

Qual dos seguintes representa um cenário ideal para um índice do tipo Hash? Num
campo de username, usado para encontrar um utilizador específico.

O que garante a propriedade da consistência na execução de uma transação numa
base de dados? A transação transforma a base de dados de um estado válido para
outro estado válido.

Uma FOREIGN KEY faz referência a atributos de uma segunda tabela. O que têm de
ser os atributos? UNIQUE.

Qual é o efeito da otimização da base de dados por desnormalização da terceira
forma normal? Acelera o desempenho do sistema.

O que se entende por sinais (critérios) independentes da interrogação de
pesquisa? Sinais que são calculados aquando da indexação dos documentos.

Na arquitetura da framework web do projeto de LBAW, o que deve acontecer no caso
de erro num recurso web de ação? Deve haver um redirecionamento para outro
recurso web.

Para que são usados os Wireflows? Descrever as interações principais com o
sistema.

O que inclui o estudo da carga do sistema usado no desenho do Esquema Físico? As
alterações SQL (UPDATE, DELETE) importantes e qual a sua frequência.

Para especificar o recurso web de resposta a um pedido AJAX, é imprescindível: A
especificação dos códigos de retorno ("Returns").

Do ponto de vista semântico, quais os elementos HTML que devem ser usados na
estruturação de um menu horizontal ou vertical? ul e li.

Composição quer dizer que se pai desaparecer, filhos tmb desaparecem. Agregação
não.

Em interações AJAX, que formato deve ser usado nas respostas enviadas pelo
servidor? As respostas a pedidos AJAX podem ser formatadas em HTML, XML ou JSON,
entre outros.

## Random

- **Business rules** - é ideias de como funciona: "A data de devolução tem de
  ser superior a uma data de empréstimo que ainda não tenha devolução registada"
- **Technical requirement** - é coisas como "sistema deve ser seguro"

## Design

- **Wireframes** - show page-level layout ideas (not good at describing
  interaction).
- **Flowcharts** - document complex workflows and user tasks (interactions).

## Indexes

B+ Tree index: É uma tree like data structure onde cada nó da árvore tem
pointers para outro nó e valores. Use partially full blocks to speed insertions
and deletions.  
Automaticamente reorganiza-se com small local changes. Não é necessário
reorganizar o file completo. Extra insertion, deletion, and space overhead.

Hash index: recebe key e dá hash (bucket). A hash function deve ser uniforme e
aleatoria. Bucket tem vários items diferentes e tem de ser searched
sequentially. Overflow buckets são chained together com linked lists. No sorting
ou range searches. Always secondary indexes.

Unique indexes: são criados automaticamente para UNIQUE e PK entries. Servem
para dar enforce a constraint.

GiST: pode dar falsos positivos. Best for dynamic data. Faster to update (3
times faster).  
GIN: faster querries e dá handle a large ammounts of data better (3 times
faster). Best for static data. Slower to update. These are good to make
full-text search (FTS) faster by indexing the pre-calculated ts_vector column.

### Choosing indexes

Workload:

- Querries mais importants (SELECT) e sua frequência.
- Updates mais importants (UPDATE, DELETE) e a sua frequência.
- Performance desejada para estas querries e updates.
- Estimativa do numero de tuplos em cada relacao (order of magnitude + estimated
  growth).

Quando é preciso ser fast:

- B+ tree index: allows searching, sorting, range search.
- Hash index: não dá range search nem sorting, mas searchs são muito fast.

### When to cluster

#### Cardinality

Cardinality: **uniqueness** of data values in a column. Usado para estimar
numero de rows retornadas por WHERE clauses

- High cardinality - primary key.
- Medium cardinality - last name in a customer table.
- Low cardinality - boolean column

#### Cluster

CLUSTER pode ser usado para ordenar uma tabela com base num index (só 1)

- Reduce the number of block reads:
  - numero de tuplos e alto e há muitos tuplos por bloco.
  - cardinalidade média.
- Permitir leitura sequencial de blocos:
  - normalmente em range searchs de colunas com baixa cardinalidade.
  - Nao interessa muito em SSDs.

## Denormalization

Aumentar performance de uma base de dados adicionando copias (redundantes) de
data. Pode ser feito usando formas normais alternativas (mais baixas).  
É importante manter a data redundante consistent, por exemplo, usando triggers.

IMP: materialized views são uma alternativa à desnormalização. Dão store ao
result de uma querry numa tabela e podem ser refreshed as needed.

## Transactions

PostgreSQL é **Read committed** por default.

```txt
| Isolation Level  | Dirty Read   | Nonrepeatable Read | Phantom Read |
|==================|==============|====================|==============|
| Read uncommitted | Possible     | Possible           | Possible     |
|------------------|--------------|--------------------|--------------|
| Read committed   | Not possible | Possible           | Possible     |
|------------------|--------------|--------------------|--------------|
| Repeatable read  | Not possible | Not possible       | Possible     |
|------------------|--------------|--------------------|--------------|
| Serializable     | Not possible | Not possible       | Not possible |
|------------------|--------------|--------------------|--------------|
```

## Information retrieval - Signals

- Static - can be computed during the indexing process.
- Query-dependent - are only available at query time.
