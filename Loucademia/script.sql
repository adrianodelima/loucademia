create table usuario (
    id serial not null,
    login varchar(30) not null unique,
    senha char(32) not null,
    nome varchar(255) not null,
    cpf char(14) not null unique,
    dataNascimento date not null,
    sexo varchar(255) not null,      --masculino, feminino, outro
    email varchar(255) not null,
    telefone varchar(255) not null,
    situacao varchar(255) not null,  --ativo, inativo, pendente
    tipo varchar(255) not null,      --aluno, recepcionista, instrutor
    rua varchar(255) not null,
    numero integer not null,
    complemento varchar(255),
    estado char(2) not null,
    cidade varchar(255) not null,
    cep char(9) not null
);

alter table usuario
add constraint pk_usuario primary key(id);

create table acesso (
    id_usuario integer not null,
    entrada timestamp not null,
    saida timestamp
);

alter table acesso
add constraint pk_acesso primary key(id_usuario, entrada),
add constraint fk_acesso foreign key(id_usuario) references usuario(id);

create table treino (
    id serial not null,
    nome varchar(255) not null unique,
    id_instrutor integer not null
);

alter table treino
add constraint pk_treino primary key(id),
add constraint fk_treino foreign key(id_instrutor) references usuario(id);

create table treino_usuario (
    id_usuario integer not null,
    id_treino integer not null,
    carga integer not null,
    qtd_repeticao integer not null,
    serie integer not null
);

alter table treino_usuario
add constraint pk_treino_usuario primary key(id_usuario, id_treino),
add constraint fk_treino_usuario_1 foreign key(id_usuario) references usuario(id),
add constraint fk_treino_usuario_2 foreign key(id_treino) references treino(id);

create table pagamento (
    id_usuario integer not null,
    data_pagamento date default current_date,
    valor double precision not null
);

alter table pagamento
add constraint pk_pagamento primary key(id_usuario, data_pagamento),
add constraint fk_pagamento foreign key(id_usuario) references usuario(id);