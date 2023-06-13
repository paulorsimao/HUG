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
    id_cliente int,
    tipo public.tipo_imovel NOT NULL,
    area DECIMAL(10,2),
    valor DECIMAL(10,2),
    descricao VARCHAR(255),
    id_seguradora INT,
    rua VARCHAR(100),
    numero INT,
    bairro VARCHAR(50),
    cidade VARCHAR(50),
    estado VARCHAR(50),
    cep VARCHAR(10),
    FOREIGN KEY (id_seguradora) REFERENCES seguradora(id_seguradora)
);
