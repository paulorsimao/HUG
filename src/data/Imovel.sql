-- Tabela "Imóvel"
CREATE TABLE Imovel (
  id_imovel INT PRIMARY KEY,
  endereco VARCHAR(255),
  tipo VARCHAR(255),
  area DECIMAL(10,2),
  valor DECIMAL(10,2)
);