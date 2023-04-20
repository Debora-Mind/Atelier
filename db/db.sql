create table if not exists configuracoes
(
    id        int auto_increment
        primary key,
    descricao longtext   not null,
    ativo     tinyint(1) not null,
    numero    int        null
)
    collate = utf8mb3_unicode_ci;

create table if not exists empresa
(
    id            int auto_increment
        primary key,
    descricao     longtext   not null,
    ativo         tinyint(1) not null,
    tema          int        null,
    logo          longblob   null,
    configuracoes json       null
)
    collate = utf8mb3_unicode_ci;

create table if not exists funcao
(
    id         int auto_increment
        primary key,
    descricao  varchar(255) not null,
    empresa_id int          null,
    constraint FK_6EDEF13D521E1991
        foreign key (empresa_id) references empresa (id)
            on delete cascade
)
    collate = utf8mb3_unicode_ci;

create index IDX_6EDEF13D521E1991
    on funcao (empresa_id);

create table if not exists funcionario
(
    id              int auto_increment
        primary key,
    empresa_id      int          null,
    nome            varchar(255) not null,
    cpf             varchar(255) not null,
    data_nascimento date         not null,
    matricula       varchar(255) null,
    valor_hora      double       null,
    constraint FK_7510A3CF521E1991
        foreign key (empresa_id) references empresa (id)
            on delete cascade
)
    collate = utf8mb3_unicode_ci;

create table if not exists faltas
(
    id             int auto_increment
        primary key,
    funcionario_id int  null,
    listaDeFaltas  json not null,
    constraint UNIQ_5CDFE14E642FEB76
        unique (funcionario_id),
    constraint FK_5CDFE14E642FEB76
        foreign key (funcionario_id) references funcionario (id)
)
    collate = utf8mb3_unicode_ci;

create index IDX_7510A3CF521E1991
    on funcionario (empresa_id);

create table if not exists layout
(
    id         int auto_increment
        primary key,
    empresa_id int  null,
    data       date not null,
    constraint FK_3A3A6BE2521E1991
        foreign key (empresa_id) references empresa (id)
            on delete cascade
)
    collate = utf8mb3_unicode_ci;

create index IDX_3A3A6BE2521E1991
    on layout (empresa_id);

create table if not exists modelo
(
    id           int auto_increment
        primary key,
    empresa_id   int          null,
    modelo       varchar(255) not null,
    producao     varchar(255) not null,
    sublote      int          not null,
    quantidade   int          not null,
    valor        double       not null,
    semana       int          not null,
    cod_barras   varchar(255) not null,
    data_entrada date         not null,
    data_saida   varchar(255) null,
    constraint FK_F0D76C46521E1991
        foreign key (empresa_id) references empresa (id)
            on delete cascade
)
    collate = utf8mb3_unicode_ci;

create index IDX_F0D76C46521E1991
    on modelo (empresa_id);

create table if not exists permissoes
(
    id        int auto_increment
        primary key,
    nome      varchar(255) not null,
    descricao longtext     not null
)
    collate = utf8mb3_unicode_ci;

create table if not exists relacao
(
    id        int auto_increment
        primary key,
    relacoes  json         not null,
    id_layout varchar(255) not null
)
    collate = utf8mb3_unicode_ci;

create table if not exists usuario
(
    id          int auto_increment
        primary key,
    funcionario int          null,
    usuario     varchar(255) not null,
    senha       varchar(255) not null,
    permissoes  json         null,
    empresa_id  int          null,
    constraint FK_2265B05D521E1991
        foreign key (empresa_id) references empresa (id)
            on delete cascade,
    constraint FK_2265B05D7510A3CF
        foreign key (funcionario) references funcionario (id)
)
    collate = utf8mb3_unicode_ci;

create index IDX_2265B05D521E1991
    on usuario (empresa_id);

create index IDX_2265B05D7510A3CF
    on usuario (funcionario);


