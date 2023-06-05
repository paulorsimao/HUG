-- Tabela "Mobília"
CREATE TABLE mobilia (
  id_mobilia INT PRIMARY KEY,
  id_imovel INT,
  nome VARCHAR(255),
  descricao TEXT,
  valor DECIMAL(10,2),
  FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);