-- Tabela "Vistoria"
CREATE TABLE Vistoria (
  id_vistoria SERIAL PRIMARY KEY,
  id_imovel INT NOT NULL,
  data_vistoria DATE NOT NULL,
  descricao TEXT NOT NULL,
  FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);
