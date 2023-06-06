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
    id_endereco INT,
    tipo public.tipo_imovel NOT NULL,
    area DECIMAL(10,2),
    valor DECIMAL(10,2),
    descricao VARCHAR(255),
    id_seguradora INT,
    FOREIGN KEY (id_endereco) REFERENCES endereco(id_endereco),
    FOREIGN KEY (id_seguradora) REFERENCES seguradora(id_seguradora)
);