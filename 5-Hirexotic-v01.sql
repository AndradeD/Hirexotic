CREATE TABLE pessoa
(
  id SERIAL,
  nome text,
  endereco text,
  telefone text,
  tipo integer,
  usuario text,
  senha text,
  session text,
  CONSTRAINT pessoa_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE pessoa
  OWNER TO postgres;

CREATE TABLE funcionario
(
  matricula SERIAL,
  cargo text,
  cpf bigint,
  sexo text,
  datanasc timestamp without time zone,
  pessoa_id bigint,
  CONSTRAINT funcionario_pkey PRIMARY KEY (matricula),
  CONSTRAINT funcionario_pessoa_id_fkey FOREIGN KEY (pessoa_id)
      REFERENCES pessoa (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE funcionario
  OWNER TO postgres;

CREATE TABLE cliente
(
  cpf bigint NOT NULL,
  sexo text,
  datanasc timestamp without time zone,
  pessoa_id bigint,
  CONSTRAINT cliente_pkey PRIMARY KEY (cpf),
  CONSTRAINT cliente_pessoa_id_fkey FOREIGN KEY (pessoa_id)
      REFERENCES pessoa (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cliente
  OWNER TO postgres;

CREATE TABLE fornecedor
(
  id SERIAL,
  cnpj bigint NOT NULL,
  pessoa_id bigint,
  CONSTRAINT fornecedor_pkey PRIMARY KEY (id),
  CONSTRAINT fornecedor_pessoa_id_fkey FOREIGN KEY (pessoa_id)
      REFERENCES pessoa (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE fornecedor
  OWNER TO postgres;

CREATE TABLE modelo
(
  id SERIAL,
  nome text,
  marca text,
  ano integer,
  numero_passageiros integer,
  velocidade integer,
  cilindrada integer,
  numero_portas integer,
  CONSTRAINT modelo_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE modelo
  OWNER TO postgres;

CREATE TABLE automovel
(
  id SERIAL,
  placa text,
  ano_fabricacao integer,
  cor text,
  combustivel text,
  preco_minimo double precision,
  modelo_id bigint,
  fornecedor_id bigint,
  CONSTRAINT automovel_pkey PRIMARY KEY (id),
  CONSTRAINT automovel_fornecedor_id_fkey FOREIGN KEY (fornecedor_id)
      REFERENCES fornecedor (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT automovel_modelo_id_fkey FOREIGN KEY (modelo_id)
      REFERENCES modelo (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE automovel
  OWNER TO postgres;
