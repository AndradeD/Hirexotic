CREATE TABLE login
(
  usuario text,
  senha text,
  tipo integer,  --0=cliente, 1=fornecedor, 2=funcionario
  session_id text,
  CONSTRAINT login_pkey PRIMARY KEY (usuario)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE login
  OWNER TO postgres;

CREATE TABLE cliente
(
  cpf bigint NOT NULL,
  nome text,
  sexo text,
  endereco text,
  telefone text,
  datanasc timestamp without time zone,
  usuario text,
  CONSTRAINT cliente_pkey PRIMARY KEY (cpf),
  CONSTRAINT cliente_usuario_fkey FOREIGN KEY (usuario)
      REFERENCES login (usuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE cliente
  OWNER TO postgres;


CREATE TABLE fornecedor
  (
    cnpj bigint NOT NULL,
    nome text,
    endereco text,
    telefone text,
    usuario text,
    CONSTRAINT fornecedor_pkey PRIMARY KEY (cnpj),
    CONSTRAINT fornecedor_usuario_fkey FOREIGN KEY (usuario)
        REFERENCES login (usuario) MATCH SIMPLE
        ON UPDATE NO ACTION ON DELETE NO ACTION
  )
  WITH (
    OIDS=FALSE
  );
  ALTER TABLE fornecedor
    OWNER TO postgres;


CREATE TABLE funcionario
(
  matricula SERIAL,
  nome text,
  sexo text,
  endereco text,
  telefone text,
  cargo text,
  cpf bigint,
  datanasc timestamp without time zone,
  usuario text,
  CONSTRAINT funcionario_pkey PRIMARY KEY (matricula),
  CONSTRAINT funcionario_usuario_fkey FOREIGN KEY (usuario)
      REFERENCES login (usuario) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE funcionario
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
  fornecedor_cnpj bigint,
  CONSTRAINT automovel_pkey PRIMARY KEY (id),
  CONSTRAINT automovel_fornecedor_id_fkey FOREIGN KEY (fornecedor_cnpj)
      REFERENCES fornecedor (cnpj) MATCH SIMPLE
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


CREATE TABLE aluguel
(
  id SERIAL,
  id_automovel bigint,
  cpf_cliente bigint,
  datainicio timestamp without time zone,
  datafim timestamp without time zone,
  pagamento text,
  valor double precision,
  homologada boolean,
  funcionario_homolog bigint,
  CONSTRAINT aluguel_pkey PRIMARY KEY (id),
  CONSTRAINT aluguel_id_automovel_fkey FOREIGN KEY (id_automovel)
      REFERENCES automovel (id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT aluguel_cpf_cliente_fkey FOREIGN KEY (cpf_cliente)
      REFERENCES cliente (cpf) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT aluguel_funcionario_homolog_fkey FOREIGN KEY (funcionario_homolog)
      REFERENCES funcionario (matricula) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE modelo
  OWNER TO postgres;

--Alguns dados

INSERT INTO login VALUES ('lucio', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 0);--senha = 1234 em sha1
INSERT INTO login VALUES ('hanzo', 'd2f75e8204fedf2eacd261e2461b2964e3bfd5be', 0);--senha = 2345 em sha1
INSERT INTO login VALUES ('genji', 'ae8fe380dd9aa5a7a956d9085fe7cf6b87d0d028', 0);--senha = 3456 em sha1

INSERT INTO login VALUES ('zarya', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

INSERT INTO login VALUES ('zenyatta', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2);

INSERT INTO cliente VALUES (11122233345, 'LUCIO', 'M', 'rua 1', '11111111', '01/01/2001', 'lucio');
INSERT INTO cliente VALUES (11122233346, 'HANZO', 'M', 'rua 2', '22222222', '02/02/2002', 'hanzo');
INSERT INTO cliente VALUES (11122233347, 'GENJI', 'M', 'rua 3', '33333333', '03/03/2003', 'genji');

INSERT INTO fornecedor VALUES (11122233345, 'ZARYA', 'rua 1', '11111111', 'zarya');

INSERT INTO funcionario VALUES (DEFAULT, 'ZENYATTA', 'rua 1', '11111111', 'gerente', 11122233345, 'M', '01/01/2001', 'zenyatta');

INSERT INTO modelo VALUES (DEFAULT, 'fusca', 'VV', 1998, 6, 160, 200, 2);
INSERT INTO modelo VALUES (DEFAULT, 'ferrari', 'VV', 2006, 6, 170, 210, 4);

INSERT INTO automovel VALUES (DEFAULT, 'kve1483', 1990, 'azul', 'gasolina', 250.00, 1, 11122233345, 'path qualquer');
INSERT INTO automovel VALUES (DEFAULT, 'lkg67233', 1990, 'branco', 'gasolina', 250.00, 1, 11122233345, 'path qualquer');
INSERT INTO automovel VALUES (DEFAULT, 'kve1483', 2010, 'preto', 'gasolina', 150.00, 2, 11122233345, 'path qualquer');

INSERT INTO aluguel VALUES (DEFAULT, 1, 11122233345, '22/09/2016','24/09/2016', 'credito', 200.00, FALSE, NULL );
