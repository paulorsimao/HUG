-- Tabela "Vistoria"
CREATE TABLE Vistoria (
  id_vistoria INT PRIMARY KEY,
  id_imovel INT,
  data_vistoria DATE,
  descricao TEXT,
  FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);