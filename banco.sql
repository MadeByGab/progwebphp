


CREATE TABLE IF NOT EXISTS public.usuario
(
    idusuario integer NOT NULL DEFAULT nextval('usuario_idusuario_seq'::regclass),
    username  character varying(50)  NOT NULL,
    password  character varying(32)  NOT NULL,
    status    boolean DEFAULT true,
    CONSTRAINT usuario_pkey PRIMARY KEY (idusuario)
);


CREATE SEQUENCE IF NOT EXISTS usuario_idusuario_seq
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;

ALTER TABLE public.usuario ALTER COLUMN idusuario
    SET DEFAULT nextval('usuario_idusuario_seq'::regclass);


INSERT INTO public.usuario (username, password, status)
VALUES ('admin', '123456', true)
ON CONFLICT DO NOTHING;



CREATE SEQUENCE IF NOT EXISTS produto_idproduto_seq
    START WITH 1 INCREMENT BY 1 NO MINVALUE NO MAXVALUE CACHE 1;

CREATE TABLE IF NOT EXISTS public.produto
(
    idproduto    integer NOT NULL DEFAULT nextval('produto_idproduto_seq'::regclass),
    produtonome  character varying(100) NOT NULL,
    produtopreco real    NOT NULL DEFAULT 0,
    produtofoto  character varying(150),
    produtostatus boolean DEFAULT false,
    CONSTRAINT produto_pkey PRIMARY KEY (idproduto)
);


INSERT INTO public.produto (produtonome, produtopreco, produtofoto, produtostatus) VALUES
    ('Notebook Dell', 3499.90, NULL, true),
    ('Mouse Sem Fio',   89.90, NULL, true),
    ('Teclado Mecânico', 349.00, NULL, false),
    ('Monitor 24"',    1299.00, NULL, true);
