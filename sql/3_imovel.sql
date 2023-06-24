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

ALTER TABLE public.imovel ALTER COLUMN descricao SET DEFAULT '.';
ALTER TABLE public.imovel ALTER COLUMN rua SET DEFAULT '.';
ALTER TABLE public.imovel ALTER COLUMN bairro SET DEFAULT '.';
ALTER TABLE public.imovel ALTER COLUMN cidade SET DEFAULT '.';
ALTER TABLE public.imovel ALTER COLUMN estado SET DEFAULT '.';
ALTER TABLE public.imovel ALTER COLUMN cep SET DEFAULT '.';
ALTER TABLE public.imovel ALTER COLUMN numero SET DEFAULT 0;
ALTER TABLE public.imovel ALTER COLUMN area SET DEFAULT '0';
ALTER TABLE public.imovel ALTER COLUMN id_seguradora SET DEFAULT 0;
ALTER TABLE public.imovel ALTER COLUMN id_cliente SET DEFAULT 0;
ALTER TABLE public.imovel ALTER COLUMN valor SET DEFAULT 0;
ALTER TABLE public.imovel ALTER COLUMN tipo SET DEFAULT 'Casa';
