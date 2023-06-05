-- Tabela "Histórico"
CREATE TABLE historico (
  id_historico INT PRIMARY KEY,
  id_imovel INT,
  data_atualizacao DATE,
  descricao TEXT,
  FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);