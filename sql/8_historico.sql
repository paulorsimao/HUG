-- Tabela "Histórico"
CREATE TABLE historico (
  id_historico SERIAL PRIMARY KEY,
  id_imovel INT NOT NULL,
  data_atualizacao DATE NOT NULL,
  descricao VARCHAR (500) NOT NULL,
 -- FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);
