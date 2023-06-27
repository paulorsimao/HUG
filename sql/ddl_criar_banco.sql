-- Tabela "pessoa"
CREATE TABLE pessoa (
    id_pessoa SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR (14) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(255),
    data_nasc DATE,
    rua VARCHAR(100),
    numero INT,
    bairro VARCHAR(50),
    cidade VARCHAR(50),
    estado VARCHAR(50),
    cep VARCHAR(10)
);

CREATE INDEX idx_pessoa_idade_estado ON pessoa(data_nasc, estado);

-- Tabela "seguradora"
CREATE TABLE seguradora (
    id_seguradora SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cnpj CHAR(18) UNIQUE NOT NULL,
    razao_social varchar(100) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(255),
    rua VARCHAR(100),
    numero INT,
    bairro VARCHAR(50),
    cidade VARCHAR(50),
    estado VARCHAR(50),
    cep VARCHAR(10)
);

-- indice para otimização de query
create index idx_estado_seguradora on seguradora (estado);

-- Tabela "Cliente"
CREATE TABLE cliente (
    id_cliente SERIAL PRIMARY KEY,
    id_pessoa INT NOT NULL,
    FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa)
);

CREATE INDEX idx_fk_cliente_pessoa ON cliente (id_pessoa);

-- Tabela "Corretor"
CREATE TABLE corretor (
    id_seguradora INT NOT NULL,
    id_pessoa INT NOT NULL,
    FOREIGN KEY (id_pessoa) REFERENCES pessoa(id_pessoa),
    FOREIGN KEY (id_seguradora) REFERENCES seguradora(id_seguradora)
);

ALTER TABLE corretor ADD PRIMARY KEY (id_seguradora, id_pessoa);

-- Tabela "Imóvel"
CREATE TYPE public.tipo_imovel AS ENUM (
    'Casa',
    'Apartamento',
    'Terreno',
    'Sala Comercial',
    'Depósito'
);

CREATE TABLE imovel (
    id_imovel SERIAL PRIMARY KEY,
    tipo public.tipo_imovel NOT NULL,
    area DECIMAL(10,2) NOT NULL,
    valor DECIMAL(15,2) NOT NULL,
    descricao VARCHAR(255),
    id_seguradora INT NOT NULL,
    id_cliente INT NOT NULL,
    rua VARCHAR(100),
    numero INT,
    bairro VARCHAR(50),
    cidade VARCHAR(50),
    estado VARCHAR(50),
    cep VARCHAR(10),
    FOREIGN KEY (id_seguradora) REFERENCES seguradora(id_seguradora),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente)
);

CREATE INDEX idx_fk_imovel_seguradora ON imovel(id_seguradora);
CREATE INDEX idx_fk_imovel_cliente ON imovel(id_cliente);

CREATE INDEX idx_tipo_valor_imovel ON imovel (id_imovel, tipo, valor);

-- Tabela "Mobília"
CREATE TABLE mobilia (
    id_mobilia SERIAL PRIMARY KEY,
    id_imovel INT NOT NULL,
    nome VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);

CREATE INDEX idx_fk_mobilia_imovel ON mobilia(id_imovel);

-- Tabela "Apólice"
CREATE TABLE apolice (
    id_apolice SERIAL PRIMARY KEY,
    id_imovel INT NOT NULL,
    id_corretor_pessoa INT NOT NULL,
    id_corretor_seguradora INT NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE NOT NULL,
    valor_cobertura DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel),
    FOREIGN KEY (id_corretor_seguradora, id_corretor_pessoa) REFERENCES corretor(id_seguradora, id_pessoa)
);

CREATE INDEX idx_fk_apolice_imovel ON apolice(id_imovel);
CREATE INDEX idx_fk_apolice_corretor ON apolice(id_corretor_seguradora, id_corretor_pessoa);
-- indice para otimização de query
CREATE INDEX idx_fim_apolice ON apolice (data_fim);
CREATE INDEX idx_inicio_apolice ON apolice (data_inicio);

-- Tabela "Sinistro"
CREATE TABLE sinistro (
    id_sinistro SERIAL PRIMARY KEY,
    id_imovel INT NOT NULL,
    data_ocorrencia DATE NOT NULL,
    descricao TEXT NOT NULL,
    valor_prejuizo DECIMAL(15,2) NOT NULL,
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);

CREATE INDEX idx_fk_sinistro_imovel ON sinistro (id_imovel);
CREATE INDEX idx_data_sinistro ON sinistro (data_ocorrencia);
-- Tabela "Vistoria"
CREATE TABLE Vistoria (
  id_vistoria SERIAL PRIMARY KEY,
  id_imovel INT NOT NULL,
  data_vistoria DATE NOT NULL,
  descricao TEXT NOT NULL,
  FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);

CREATE INDEX idx_fk_vistoria_imovel ON vistoria (id_imovel);

-- Tabela "Histórico"
CREATE TABLE historico (
  id_historico SERIAL PRIMARY KEY,
  id_imovel INT NOT NULL,
  data_atualizacao DATE NOT NULL,
  descricao VARCHAR (500) NOT NULL
);


--Trigger e funções
CREATE OR REPLACE FUNCTION registrar_historico()
RETURNS TRIGGER AS $$
DECLARE
    acao TEXT;
    descricao TEXT;
BEGIN
    IF TG_OP = 'UPDATE' THEN
        acao := 'Atualização de imóvel';
        descricao := 'Imóvel ID: ' || OLD.id_imovel || ' - ';

        IF OLD.tipo <> NEW.tipo THEN
            descricao := descricao || 'Tipo alterado de ' || OLD.tipo || ' para ' || NEW.tipo || '. ';
        END IF;

        IF OLD.area <> NEW.area THEN
            descricao := descricao || 'Área alterada de ' || OLD.area || ' para ' || NEW.area || '. ';
        END IF;

        IF OLD.valor <> NEW.valor THEN
            descricao := descricao || 'Valor alterado de ' || OLD.valor || ' para ' || NEW.valor || '. ';
        END IF;

        IF OLD.descricao <> NEW.descricao THEN
            descricao := descricao || 'Descrição alterada de ' || OLD.descricao || ' para ' || NEW.descricao || '. ';
        END IF;

        IF OLD.id_seguradora <> NEW.id_seguradora THEN
            descricao := descricao || 'Seguradora alterada de ' || OLD.id_seguradora || ' para ' || NEW.id_seguradora || '. ';
        END IF;

        IF OLD.rua <> NEW.rua THEN
            descricao := descricao || 'Rua alterada de ' || OLD.rua || ' para ' || NEW.rua || '. ';
        END IF;

        IF OLD.numero <> NEW.numero THEN
            descricao := descricao || 'Número alterado de ' || OLD.numero || ' para ' || NEW.numero || '. ';
        END IF;

        IF OLD.bairro <> NEW.bairro THEN
            descricao := descricao || 'Bairro alterado de ' || OLD.bairro || ' para ' || NEW.bairro || '. ';
        END IF;

        IF OLD.cidade <> NEW.cidade THEN
            descricao := descricao || 'Cidade alterada de ' || OLD.cidade || ' para ' || NEW.cidade || '. ';
        END IF;

        IF OLD.estado <> NEW.estado THEN
            descricao := descricao || 'Estado alterado de ' || OLD.estado || ' para ' || NEW.estado || '. ';
        END IF;

        IF OLD.cep <> NEW.cep THEN
            descricao := descricao || 'CEP alterado de ' || OLD.cep || ' para ' || NEW.cep || '. ';
        END IF;

    ELSIF TG_OP = 'DELETE' THEN
        acao := 'Exclusão de imóvel';
        descricao := 'Imóvel ID: ' || OLD.id_imovel;
    END IF;

    INSERT INTO historico (id_imovel, data_atualizacao, descricao)
    VALUES (OLD.id_imovel, CURRENT_DATE, descricao || acao);

    RETURN NULL;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER imovel_historico_trigger
AFTER UPDATE OR DELETE ON imovel
FOR EACH ROW
EXECUTE FUNCTION registrar_historico();

CREATE OR REPLACE FUNCTION public.relatorio_imoveis(data_inicial date DEFAULT NULL::date, data_final date DEFAULT NULL::date)
 RETURNS TABLE(id_imovel integer, descricao_imovel character varying, id_cliente integer, nome_cliente character varying, id_seguradora integer, nome_seguradora character varying, qtd_apolices bigint, valor_apolices numeric, qtd_sinistros bigint, valor_sinistros numeric)
 LANGUAGE plpgsql
AS $function$
BEGIN 
    RETURN QUERY
	
    WITH apolices AS (
        SELECT
            COUNT(a.id_apolice) AS qtd,
            SUM(a.valor_cobertura) AS valor,
            a.id_imovel
        FROM
            apolice a
        where
        	(data_inicial is null or a.data_inicio >= data_inicial)
    	and
        	(data_final is null or a.data_inicio <= data_final)
        GROUP BY
            a.id_imovel
    ),
    sinistros AS (
        SELECT
            COUNT(id_sinistro) AS qtd,
            SUM(s.valor_prejuizo) AS valor,
            s.id_imovel
        FROM
            sinistro s
        where
        	(data_inicial is null or s.data_ocorrencia >= data_inicial)
    	and
        	(data_final is null or s.data_ocorrencia <= data_final)
        GROUP BY
            s.id_imovel
    )
    SELECT 
        i.id_imovel,
        i.descricao,
        c.id_cliente,
        p.nome ,
        seg.id_seguradora ,
        seg.nome ,
        COALESCE(a.qtd, 0),
        COALESCE(a.valor, 0),
        COALESCE(s.qtd, 0),
        COALESCE(s.valor, 0)
    FROM 
        imovel i
    LEFT JOIN cliente c ON c.id_cliente = i.id_cliente
    left join pessoa p on p.id_pessoa = c.id_pessoa 
    LEFT JOIN seguradora seg ON seg.id_seguradora = i.id_seguradora 
    LEFT JOIN apolices a ON a.id_imovel = i.id_imovel 
    LEFT JOIN sinistros s ON s.id_imovel = i.id_imovel;
    
    RETURN;
END;
$function$
;